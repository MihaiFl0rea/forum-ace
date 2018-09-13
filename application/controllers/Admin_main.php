<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin_main extends CI_Controller
{

    public $status;
    private $usersTable;

    function __construct()
    {
        parent::__construct();
        $this->load->model('User_model', 'user_model', TRUE);
        $this->load->library('form_validation');
        $this->form_validation->set_error_delimiters('<div class="error">', '</div>');
        $this->status = $this->config->item('status');
        $this->usersTable = 'company';
    }

    public function index()
    {
        if (empty($this->session->userdata['id'])) {
            redirect(site_url() . 'admin/login/');
        }

        $this->load->model('Company_model', 'company_model', TRUE);
        $this->load->model('Student_model', 'student_model', TRUE);

        $this->load->view('admin/page_home', array('pending_companies' => $this->company_model->get_pending_companies(), 'pending_students' => $this->student_model->get_pending_students()));
    }

    public function register()
    {
        $this->form_validation->set_rules('name', 'Company name', 'required');
        $this->form_validation->set_rules('email', 'Email', 'required|valid_email');

        if ($this->form_validation->run() == FALSE) {
            $this->load->view('admin/page_register');
        } else {
            if ($this->user_model->isDuplicate($this->input->post('email'), $this->usersTable)) {
                $this->session->set_flashdata('flash_message', 'User email already exists');
                redirect(site_url() . 'admin/login');
            } else {
                // add company with pending status
                $clean = $this->security->xss_clean($this->input->post(NULL, TRUE));
                $this->user_model->insertUser($clean, $this->usersTable);

                $this->session->set_flashdata('flash_message', 'In curand veti primi un email cu instructiuni pentru incheierea procesului de inregistrare.');
                redirect(site_url() . 'admin/login');
            };
        }
    }

    public function approve_request()
    {
        $id = $this->input->post('id');
        $email = $this->input->post('email');
        $usersTable = $this->input->post('userTable');
        $user_approved = $this->user_model->approveUser($id, $usersTable);
        if ($user_approved) {
            $token = $this->user_model->insertToken($id, $usersTable);

            $qstring = $this->base64url_encode($token);
            // create link for wither admin or front
            $url = $usersTable == 'company' ? site_url() . 'admin/complete/token/' . $qstring : site_url() . 'complete/token/' . $qstring;
            $link = '<a href="' . $url . '">link</a>';

            echo $this->send_register_mail($email, $link);
        }
        echo false;
    }

    protected function send_register_mail($to_email, $link)
    {
        $from = 'admin@ace.ro';
        $subject = 'Bun venit la Forum A.C.E.';
        $message = '<strong>Accesati urmatorul link pentru inregistrare:</strong> ' . $link;
        $footer = '<strong>Forum A.C.E.</strong><br>';
        $footer .= '<strong>' . date('d M Y') . '</strong>';

        $this->load->helper('email');
        $body = get_email_template('', $message, $footer, 'Bun venit la Forum A.C.E.');
        return send_email($from, $to_email, $subject, $body);
    }

    protected function _islocal()
    {
        return strpos($_SERVER['HTTP_HOST'], 'local');
    }

    public function complete($token = false)
    {
        $token = base64_decode($token);
        $cleanToken = $this->security->xss_clean($token);

        $userInfo = $this->user_model->isTokenValid($cleanToken, $this->usersTable); //either false or array();

        if (!$userInfo) {
            $this->session->set_flashdata('flash_message', 'Token is invalid or expired');
            redirect(site_url() . 'admin/login');
        }
        $data = array(
            'name' => $userInfo->name,
            'email' => $userInfo->email,
            'user_id' => $userInfo->id,
            'token' => $this->base64url_encode($token)
        );

        $this->form_validation->set_rules('password', 'Password', 'required|min_length[5]');
        $this->form_validation->set_rules('passconf', 'Password Confirmation', 'required|matches[password]');

        if ($this->form_validation->run() == FALSE) {
            $this->load->view('admin/page_complete', $data);
        } else {
            $this->load->library('password');
            $post = $this->input->post(NULL, TRUE);

            $cleanPost = $this->security->xss_clean($post);

            $hashed = $this->password->create_hash($cleanPost['password']);
            $cleanPost['password'] = $hashed;
            unset($cleanPost['passconf']);
            $userInfo = $this->user_model->updateUserInfo($cleanPost, $this->usersTable);

            if (!$userInfo) {
                $this->session->set_flashdata('flash_message', 'There was a problem updating your record');
                redirect(site_url() . 'admin/login');
            }

            unset($userInfo->password);
            // just in case the last logged in user was the admin
            $this->session->set_userdata('role', 'company');
            foreach ($userInfo as $key => $val) {
                $this->session->set_userdata($key, $val);
            }
            redirect(site_url() . 'admin');
        }
    }

    public function login()
    {
        // if somehow the user is logged but he's accessing the login page, redirect him to home page
        if (!empty($this->session->userdata['id'])) {
            /*go to home page*/
            redirect(site_url() . 'admin');
        }

        $this->form_validation->set_rules('email', 'Email', 'required|valid_email');
        $this->form_validation->set_rules('password', 'Password', 'required');

        if ($this->form_validation->run() == FALSE) {
            $this->load->view('admin/page_login');
        } else {
            $post = $this->input->post();
            $clean = $this->security->xss_clean($post);

            // first check if user is admin
            if (!$userInfo = $this->user_model->checkLogin($clean, 'backend_user')) {
                // if not, check if company
                $userInfo = $this->user_model->checkLogin($clean, $this->usersTable);
            }

            if (!$userInfo) {
                $this->session->set_flashdata('flash_message', 'The login was unsuccessful');
                redirect(site_url() . 'admin');
            }
            foreach ($userInfo as $key => $val) {
                $this->session->set_userdata($key, $val);
            }
            redirect(site_url() . 'admin');
        }
    }

    public function logout()
    {
        $this->session->sess_destroy();
        redirect(site_url() . 'admin/login');
    }

    public function forgot()
    {
        $this->form_validation->set_rules('email', 'Email', 'required|valid_email');

        if ($this->form_validation->run() == FALSE) {
            $this->load->view('admin/page_forgot');
        } else {
            $email = $this->input->post('email');
            $clean = $this->security->xss_clean($email);
            $userType = 'admin';
            if (!$userInfo = $this->user_model->getUserInfoByEmail($clean, 'backend_user')) {
                $userType = 'company';
                $userInfo = $this->user_model->getUserInfoByEmail($clean, $this->usersTable);
            }

            if (!$userInfo) {
                $this->session->set_flashdata('flash_message', 'We can not find your email address');
                redirect(site_url() . 'admin/login');
            }

            if ($userInfo->status != $this->status[2]) { //if status is not completed
                $this->session->set_flashdata('flash_message', 'Your account is not in approved status');
                redirect(site_url() . 'admin/login');
            }

            //build token
            $token = $this->user_model->insertToken($userInfo->id, $userType);
            $qstring = $this->base64url_encode($token);
            $url = site_url() . 'admin/reset_password/token/' . $qstring;
            $link = '<a href="' . $url . '">link</a>';

            if ($this->send_forgot_pass_email($clean, $link)) {
                $this->session->set_flashdata('flash_message', 'Ati primit un email prin care va puteti reseta parola.');
            } else {
                $this->session->set_flashdata('flash_message', 'Va rugam sa reincercati!');
            }
            redirect(site_url() . 'admin/login');
            exit;
        }
    }

    protected function send_forgot_pass_email($to_email, $link)
    {
        $from = 'admin@ace.ro';
        $subject = 'Resetare parola';
        $message = '<strong>Resetarea parolei a fost ceruta pentru acest cont.</strong><br>';
        $message .= '<strong>Accesati urmatorul link:</strong> ' . $link;
        $footer = '<strong>Forum A.C.E.</strong><br>';
        $footer .= '<strong>' . date('d M Y') . '</strong>';

        $this->load->helper('email');
        $body = get_email_template('', $message, $footer, 'Resetare parola');
        return send_email($from, $to_email, $subject, $body);
    }

    public function reset_password($token = false)
    {
        $token = $this->base64url_decode($token);
        $cleanToken = $this->security->xss_clean($token);

        $table = 'backend_user';
        if (!$userInfo = $this->user_model->isTokenValid($cleanToken, $table)) {
            $table = $this->usersTable;
            $userInfo = $this->user_model->isTokenValid($cleanToken, $table); //either false or array();
        }

        if (!$userInfo) {
            $this->session->set_flashdata('flash_message', 'Token is invalid or expired');
            redirect(site_url() . 'admin/login');
        }
        $data = array(
            'name' => $userInfo->name,
            'email' => $userInfo->email,
            'token' => $this->base64url_encode($token)
        );

        $this->form_validation->set_rules('password', 'Password', 'required|min_length[5]');
        $this->form_validation->set_rules('passconf', 'Password Confirmation', 'required|matches[password]');

        if ($this->form_validation->run() == FALSE) {
            $this->load->view('admin/page_reset_password', $data);
        } else {
            $this->load->library('password');
            $post = $this->input->post(NULL, TRUE);
            $cleanPost = $this->security->xss_clean($post);
            $hashed = $this->password->create_hash($cleanPost['password']);
            $cleanPost['password'] = $hashed;
            $cleanPost['user_id'] = $userInfo->id;
            unset($cleanPost['passconf']);
            if (!$this->user_model->updatePassword($cleanPost, $table)) {
                $this->session->set_flashdata('flash_message', 'There was a problem updating your password');
            } else {
                $this->session->set_flashdata('flash_message', 'Your password has been updated. You may now login');
            }
            redirect(site_url() . 'admin/login');
        }
    }

    public function base64url_encode($data)
    {
        return rtrim(strtr(base64_encode($data), '+/', '-_'), '=');
    }

    public function base64url_decode($data)
    {
        return base64_decode(str_pad(strtr($data, '-_', '+/'), strlen($data) % 4, '=', STR_PAD_RIGHT));
    }

    public function get_user_profile()
    {
        $userSession = $this->session->userdata;
        if (empty($userSession['id'])) {
            redirect(site_url() . 'admin/login');
        }

        $this->load->view('admin/page_profile', array('user' => $userSession));
    }

}
