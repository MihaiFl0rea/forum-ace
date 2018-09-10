<?php
/**
 * Created by PhpStorm.
 * User: Mihai
 * Date: 8/23/2018
 * Time: 8:20 PM
 */
defined('BASEPATH') OR exit('No direct script access allowed');

class Front_company extends CI_Controller
{
    function __construct()
    {
        parent::__construct();

        if (empty($this->session->userdata['front_id'])) {
            redirect(site_url() . 'login');
        }

        $this->load->model('Article_model', 'article_model', TRUE);
        $this->load->model('Company_model', 'company_model', TRUE);
        $this->load->library('form_validation');
        $this->form_validation->set_error_delimiters('<div class="error">', '</div>');
    }

    public function get_companies()
    {
        $companies = $this->company_model->get_companies();
        $this->load->view('companies', array('companies' => $companies));
    }
}

?>