<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Front_main extends CI_Controller
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
        $this->usersTable = 'student';
    }

    public function register()
    {
        $this->form_validation->set_rules('firstname', 'First Name', 'required');
        $this->form_validation->set_rules('lastname', 'Last Name', 'required');
        $this->form_validation->set_rules('email', 'Email', 'required|valid_email');

        if ($this->form_validation->run() == FALSE) {
            $this->load->view('register');
        } else {
            if ($this->user_model->isDuplicate($this->input->post('email'), $this->usersTable)) {
                $this->session->set_flashdata('flash_message', 'User email already exists');
                redirect(site_url() . 'login');
            } else {

                $clean = $this->security->xss_clean($this->input->post(NULL, TRUE));
                $this->user_model->insertUser($clean, $this->usersTable);

                $this->session->set_flashdata('flash_message', 'In curand veti primi un email cu instructiuni pentru incheierea procesului de inregistrare.');
                redirect(site_url() . 'login');
                /*$token = $this->user_model->insertToken($id, $this->usersTable);

                $qstring = $this->base64url_encode($token);
                $url = site_url() . 'main/complete/token/' . $qstring;
                $link = '<a href="' . $url . '">' . $url . '</a>';

                $this->send_register_mail($this->input->post('email'), $link);
                exit;*/
            };
        }
    }

    /*protected function send_register_mail($to_email, $link)
    {
        $from = 'admin@company.com';
        $subject = 'Welcome to our app';
        $message = '<strong>You have signed up with our website</strong><br>';
        $message .= '<strong>Please click:</strong> ' . $link;
        $footer = '<strong>Company Name</strong><br>';
        $footer .= '<strong>' . date('d M Y') . '</strong>';

        $this->load->helper('email');
        $body = get_email_template('Welcome to our app!', $message, $footer, 'Welcome');
        send_email($from, $to_email, $subject, $body, 'Frontmain');
    }*/

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
            redirect(site_url() . 'login');
        }
        $data = array(
            'firstName' => $userInfo->first_name,
            'email' => $userInfo->email,
            'user_id' => $userInfo->id,
            'token' => $this->base64url_encode($token)
        );

        $this->form_validation->set_rules('password', 'Password', 'required|min_length[5]');
        $this->form_validation->set_rules('passconf', 'Password Confirmation', 'required|matches[password]');

        if ($this->form_validation->run() == FALSE) {
            $this->load->view('complete', $data);
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
                redirect(site_url() . 'login');
            }

            unset($userInfo->password);

            foreach ($userInfo as $key => $val) {
                $this->session->set_userdata('front_' . $key, $val);
            }
            redirect(site_url() . 'acasa');
        }
    }

    public function login()
    {
        // if somehow the user is logged but he's accessing the login page, redirect him to home page
        if (!empty($this->session->userdata['front_id'])) {
            /*go to home page*/
            redirect(site_url() . 'acasa');
        }

        $this->form_validation->set_rules('email', 'Email', 'required|valid_email');
        $this->form_validation->set_rules('password', 'Password', 'required');

        if ($this->form_validation->run() == FALSE) {
            $this->load->view('login');
        } else {
            $post = $this->input->post();
            $clean = $this->security->xss_clean($post);

            $userInfo = $this->user_model->checkLogin($clean, $this->usersTable, true);

            if (!$userInfo) {
                $this->session->set_flashdata('flash_message', 'The login was unsuccessful');
                redirect(site_url() . 'login');
            }
            foreach ($userInfo as $key => $val) {
                $this->session->set_userdata('front_' . $key, $val);
            }
            redirect(site_url() . 'acasa');
        }
    }

    public function logout()
    {
        $this->session->sess_destroy();
        redirect(site_url() . 'login');
    }

    public function forgot()
    {
        $this->form_validation->set_rules('email', 'Email', 'required|valid_email');

        if ($this->form_validation->run() == FALSE) {
            $this->load->view('forgot');
        } else {
            $email = $this->input->post('email');
            $clean = $this->security->xss_clean($email);
            $userInfo = $this->user_model->getUserInfoByEmail($clean, $this->usersTable);

            if (!$userInfo) {
                $this->session->set_flashdata('flash_message', 'We can not find your email address');
                redirect(site_url() . 'login');
            }

            if ($userInfo->status != $this->status[2]) { //if status is not completed
                $this->session->set_flashdata('flash_message', 'Your account is not in approved status');
                redirect(site_url() . 'login');
            }

            //build token
            $token = $this->user_model->insertToken($userInfo->id, $this->usersTable);
            $qstring = $this->base64url_encode($token);
            $url = site_url() . 'reset_password/token/' . $qstring;
            $link = '<a href="' . $url . '">link</a>';

            if ($this->send_forgot_pass_email($clean, $link)) {
                $this->session->set_flashdata('flash_message', 'Ati primit un email prin care va puteti reseta parola.');
            } else {
                $this->session->set_flashdata('flash_message', 'Va rugam sa reincercati!');
            }
            redirect(site_url() . 'login');
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

        $userInfo = $this->user_model->isTokenValid($cleanToken, $this->usersTable); //either false or array();

        if (!$userInfo) {
            $this->session->set_flashdata('flash_message', 'Token is invalid or expired');
            redirect(site_url() . 'login');
        }
        $data = array(
            'firstName' => $userInfo->first_name,
            'email' => $userInfo->email,
            'token' => $this->base64url_encode($token)
        );

        $this->form_validation->set_rules('password', 'Password', 'required|min_length[5]');
        $this->form_validation->set_rules('passconf', 'Password Confirmation', 'required|matches[password]');

        if ($this->form_validation->run() == FALSE) {
            $this->load->view('reset_password', $data);
        } else {
            $this->load->library('password');
            $post = $this->input->post(NULL, TRUE);
            $cleanPost = $this->security->xss_clean($post);
            $hashed = $this->password->create_hash($cleanPost['password']);
            $cleanPost['password'] = $hashed;
            $cleanPost['user_id'] = $userInfo->id;
            unset($cleanPost['passconf']);
            if (!$this->user_model->updatePassword($cleanPost, $this->usersTable)) {
                $this->session->set_flashdata('flash_message', 'There was a problem updating your password');
            } else {
                $this->session->set_flashdata('flash_message', 'Your password has been updated. You may now login');
            }
            redirect(site_url() . 'login');
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
        if (!empty($this->session->userdata['front_faculty'])) {
            $this->load->view('profile', array('user' => $this->session->userdata));
        }
    }
}
