<?php
/**
 * Created by PhpStorm.
 * User: Mihai
 * Date: 8/23/2018
 * Time: 8:20 PM
 */
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin_student extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();

        if (empty($this->session->userdata['id'])) {
            redirect(site_url() . 'admin/login');
        }

        $this->load->library('form_validation');
        $this->form_validation->set_error_delimiters('<div class="text-danger">', '</div>');
        $this->load->model('Student_model', 'student_model', TRUE);
    }

    public function read($faculty = false)
    {
        $students = $this->student_model->read($faculty);
        if ($faculty) {
            $this->load->view('admin/page_students', array('template' => 'students_by_faculty', 'students' => $students, 'faculty' => $faculty));
        } else {
            $this->load->view('admin/page_students', array('template' => 'read', 'students' => $students));
        }
    }

    public function create()
    {
        $this->form_validation->set_rules('first_name', 'Prenume', 'required');
        $this->form_validation->set_rules('last_name', 'Nume', 'required');
        $this->form_validation->set_rules('password', 'Parola', 'required');
        $this->form_validation->set_rules('email', 'Email', 'required');
        $this->form_validation->set_rules('faculty', 'Facultate', 'required');

        if ($this->form_validation->run() == FALSE) {
            $this->load->view('admin/page_students', array('template' => 'create'));
        } else {
            $cleanPost = $this->security->xss_clean($this->input->post());
            $this->student_model->create($cleanPost, 'avatar');
            redirect(site_url() . 'admin/studenti');
        }
    }

    public function update($id = false)
    {
        $this->form_validation->set_rules('first_name', 'Prenume', 'required');
        $this->form_validation->set_rules('last_name', 'Nume', 'required');
        $this->form_validation->set_rules('email', 'Email', 'required');
        $this->form_validation->set_rules('faculty', 'Facultate', 'required');

        if ($this->form_validation->run() == FALSE) {
            $student = $id ? $this->student_model->get_student_by_id($id) : false;
            $this->load->view('admin/page_students', array('template' => 'update','student' => $student));
        } else {
            $cleanPost = $this->security->xss_clean($this->input->post());
            $this->student_model->update($id, $cleanPost, 'avatar');
            redirect(site_url() . 'admin/studenti');
        }
    }

    public function delete()
    {
        $this->student_model->delete($this->input->post('id'), $this->input->post('avatar'));
    }
}

?>