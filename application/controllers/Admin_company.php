<?php
/**
 * Created by PhpStorm.
 * User: Mihai
 * Date: 8/23/2018
 * Time: 8:20 PM
 */
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin_company extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();

        if (empty($this->session->userdata['id'])) {
            redirect(site_url() . 'admin/login');
        }

        $this->load->library('form_validation');
        $this->form_validation->set_error_delimiters('<div class="text-danger">', '</div>');
        $this->load->model('Company_model', 'company_model', TRUE);
    }

    public function read($city = false)
    {
        $companies = $this->company_model->read($city);
        if ($city) {
            $this->load->view('admin/page_companies', array('template' => 'companies_by_city', 'companies' => $companies, 'city' => $city));
        } else {
            $this->load->view('admin/page_companies', array('template' => 'read', 'companies' => $companies));
        }
    }

    public function create()
    {
        $this->form_validation->set_rules('name', 'Nume companie', 'required');
        $this->form_validation->set_rules('email', 'Email', 'required');
        $this->form_validation->set_rules('password', 'Parola', 'required');
        $this->form_validation->set_rules('city', 'Oras', 'required');

        if ($this->form_validation->run() == FALSE) {
            $this->load->view('admin/page_companies', array('template' => 'create'));
        } else {
            $cleanPost = $this->security->xss_clean($this->input->post());
            $this->company_model->create($cleanPost, 'logo');
            redirect(site_url() . 'admin/companii');
        }
    }

    public function update($id = false)
    {
        $this->form_validation->set_rules('name', 'Nume companie', 'required');
        $this->form_validation->set_rules('email', 'Email', 'required');
        $this->form_validation->set_rules('city', 'Oras', 'required');

        if ($this->form_validation->run() == FALSE) {
            $company = $id ? $this->company_model->get_company_by_id($id) : false;
            $this->load->view('admin/page_companies', array('template' => 'update','company' => $company));
        } else {
            $cleanPost = $this->security->xss_clean($this->input->post());
            $this->company_model->update($id, $cleanPost, 'logo');
            redirect(site_url() . 'admin/companii');
        }
    }

    public function delete()
    {
        $this->company_model->delete($this->input->post('id'), $this->input->post('logo'));
    }
}

?>