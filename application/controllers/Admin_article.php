<?php
/**
 * Created by PhpStorm.
 * User: Mihai
 * Date: 8/23/2018
 * Time: 8:20 PM
 */
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin_article extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();

        if (empty($this->session->userdata['id'])) {
            redirect(site_url() . 'admin/login');
        }

        $this->load->library('form_validation');
        $this->form_validation->set_error_delimiters('<div class="text-danger">', '</div>');
        $this->load->model('Article_model', 'article_model', TRUE);
    }

    public function read($id = false)
    {
        if (!$id) {
            $articles = $this->article_model->read_articles();
            $this->load->view('admin/page_articles', array('template' => 'read', 'articles' => $articles));
        } else {
            $article = $this->article_model->get_article_by_id($id);
            $this->load->view('admin/page_articles', array('template' => 'read_article', 'article' => $article));
        }
    }

    public function create()
    {
        $this->form_validation->set_rules('title', 'Titlu Articol', 'required');
        $this->form_validation->set_rules('article-body', 'Continut Articol', 'required');
        $this->form_validation->set_rules('type', 'Tip Articol', 'required');
        $this->form_validation->set_rules('categories[]', 'Categorii', 'required');
        $this->form_validation->set_rules('tags[]', 'Tag-uri', 'required');


        if ($this->form_validation->run() == FALSE) {
            $categories = $this->article_model->read_categories();
            $tags = $this->article_model->read_tags();
            $this->load->view('admin/page_articles', array('template' => 'create', 'categories' => $categories, 'tags' => $tags));
        } else {
            $cleanPost = $this->security->xss_clean($this->input->post());
            $this->article_model->create_article($this->session->userdata['id'], strtolower($this->session->userdata['name']), $cleanPost, 'poster');
            redirect(site_url() . 'admin/articole');
        }
    }

    public function update($id = false)
    {
        $this->form_validation->set_rules('title', 'Titlu Articol', 'required');
        $this->form_validation->set_rules('article-body', 'Continut Articol', 'required');
        $this->form_validation->set_rules('type', 'Tip Articol', 'required');
        $this->form_validation->set_rules('categories[]', 'Categorii', 'required');
        $this->form_validation->set_rules('tags[]', 'Tag-uri', 'required');

        if ($this->form_validation->run() == FALSE) {
            $article = $id ? $this->article_model->get_article_by_id($id) : false;
            $categories = $this->article_model->read_categories();
            $tags = $this->article_model->read_tags();
            $this->load->view('admin/page_articles', array('template' => 'update', 'article' => $article, 'categories' => $categories, 'tags' => $tags));
        } else {
            $cleanPost = $this->security->xss_clean($this->input->post());
            $this->article_model->update_article($id, strtolower($this->session->userdata['name']), $cleanPost, 'poster');
            redirect(site_url() . 'admin/articole');
        }
    }

    public function delete()
    {

    }

    /** Handling of Froala Editor's files and images */
    public function upload_image()
    {
        echo $this->article_model->upload_froala_image(strtolower($this->session->userdata['name']));
    }

    public function delete_image()
    {
        $cleanPost = $this->security->xss_clean($this->input->post());
        echo $this->article_model->delete_froala_image($cleanPost['src']);
    }

    public function upload_file()
    {
        echo $this->article_model->upload_froala_file(strtolower($this->session->userdata['name']));
    }

    public function delete_file()
    {
        $cleanPost = $this->security->xss_clean($this->input->post());
        echo $this->article_model->delete_froala_file($cleanPost['src']);
    }

    /** Article Categories */
    public function read_categories()
    {
        $categories = $this->article_model->read_categories();
        $this->load->view('admin/page_categories', array('template' => 'read', 'categories' => $categories));
    }

    public function create_category()
    {
        $this->form_validation->set_rules('name', 'Nume Categorie', 'required');

        if ($this->form_validation->run() == FALSE) {
            $this->load->view('admin/page_categories', array('template' => 'create'));
        } else {
            $cleanPost = $this->security->xss_clean($this->input->post());
            $this->article_model->create_category($cleanPost['name']);
            redirect(site_url() . 'admin/categorii-articole');
        }
    }

    public function update_category($id = false)
    {
        $this->form_validation->set_rules('name', 'Nume Categorie', 'required');

        if ($this->form_validation->run() == FALSE) {
            $category = $id ? $this->article_model->get_category_by_id($id) : false;
            $this->load->view('admin/page_categories', array('template' => 'update','category' => $category));
        } else {
            $cleanPost = $this->security->xss_clean($this->input->post());
            $this->article_model->update_category($id, $cleanPost['name']);
            redirect(site_url() . 'admin/categorii-articole');
        }
    }

    public function delete_category()
    {
        $this->article_model->delete_category($this->input->post('id'));
    }

    public function read_tags()
    {
        $tags = $this->article_model->read_tags();
        $this->load->view('admin/page_tags', array('template' => 'read', 'tags' => $tags));
    }

    /** Article Tags */
    public function create_tag()
    {
        $this->form_validation->set_rules('name', 'Nume Tag', 'required');

        if ($this->form_validation->run() == FALSE) {
            $this->load->view('admin/page_tags', array('template' => 'create'));
        } else {
            $cleanPost = $this->security->xss_clean($this->input->post());
            $this->article_model->create_tag($cleanPost['name']);
            redirect(site_url() . 'admin/taguri-articole');
        }
    }

    public function update_tag($id = false)
    {
        $this->form_validation->set_rules('name', 'Nume Tag', 'required');

        if ($this->form_validation->run() == FALSE) {
            $tag = $id ? $this->article_model->get_tag_by_id($id) : false;
            $this->load->view('admin/page_tags', array('template' => 'update','tag' => $tag));
        } else {
            $cleanPost = $this->security->xss_clean($this->input->post());
            $this->article_model->update_tag($id, $cleanPost['name']);
            redirect(site_url() . 'admin/taguri-articole');
        }
    }

    public function delete_tag()
    {
        $this->article_model->delete_tag($this->input->post('id'));
    }
}

?>