<?php
/**
 * Created by PhpStorm.
 * User: Mihai
 * Date: 8/23/2018
 * Time: 8:20 PM
 */
defined('BASEPATH') OR exit('No direct script access allowed');

class Front_article extends CI_Controller
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

    public function index()
    {
        // retrieve all articles
        $articles = $this->article_model->read_articles(true);
        // store the newest article
        $latest_article = $articles[0];
        // and remove it from the older ones
        unset($articles[0]);

        $recommendations = $this->company_model->get_recommended_articles();
        $categories = $this->company_model->get_categories_articles();
        $tags = $this->company_model->get_tags_articles();

        /*front page*/
        $this->load->view('index', array(
            'latest_article' => $latest_article,
            'articles' => $articles,
            'recommendations' => $recommendations,
            'categories' => $categories,
            'tags' => $tags)
        );
    }

    public function get_article($id = false)
    {
        if ($id) {
            $article = $this->article_model->get_article_by_id($id);
            $this->load->view('article', array('article' => $article));
        } else {
            redirect(base_url() . 'home');
        }
    }

    public function add_comment()
    {
        $cleanPost = $this->security->xss_clean($this->input->post());
        echo $this->article_model->add_comment($cleanPost);
    }

    public function edit_comment()
    {
        $cleanPost = $this->security->xss_clean($this->input->post());
        echo $this->article_model->edit_comment($cleanPost);
    }

    public function delete_comment()
    {
        $cleanPost = $this->security->xss_clean($this->input->post());
        $this->article_model->delete_comment($cleanPost['id_comment']);
    }

    public function review_comment()
    {
        $cleanPost = $this->security->xss_clean($this->input->post());
        echo $this->article_model->review_comment($cleanPost);
    }

    public function delete_review_comment()
    {
        $cleanPost = $this->security->xss_clean($this->input->post());
        $this->article_model->delete_review_comment($cleanPost['id_review']);
    }
}

?>