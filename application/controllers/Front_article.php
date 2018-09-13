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
    public $recommended = array();
    public $categories = array();
    public $tags = array();

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

        // initiate class properties
        $this->recommended = $this->company_model->get_recommended_articles();
        $this->categories = $this->company_model->get_categories_articles();
        $this->tags = $this->company_model->get_tags_articles();
    }

    public function index()
    {
        // retrieve all articles
        $articles = $this->article_model->read_articles(true);
        // store the newest article
        $latest_article = $articles[0];
        // and remove it from the older ones
        unset($articles[0]);

        /*front page*/
        $this->load->view('index', array(
            'latest_article' => $latest_article,
            'articles' => $articles,
            'recommendations' => $this->recommended,
            'categories' => $this->categories,
            'tags' => $this->tags)
        );
    }

    public function get_article($id = false)
    {
        if ($id) {
            $article = $this->article_model->get_article_by_id($id);
            $name_company = $article['name_company'];
            $id_company = $article['id_company'];
            $company_articles = $this->company_model->get_articles_by_company($id_company);
            unset($company_articles[$article['id']]);
            $recommended = $this->recommended;
            unset($recommended[$article['id']]);
            $this->load->view('article', array(
                'article' => $article,
                'name_company' => $name_company,
                'company_articles' => $company_articles,
                'recommendations' => $recommended,
                'categories' => $this->categories,
                'tags' => $this->tags));
        } else {
            redirect(base_url() . 'acasa');
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

    public function get_articles_by_company($id_company)
    {
        if ($id_company) {
            $articles = $this->company_model->get_articles_by_company($id_company);
            $this->load->view('articles', array('template' => 'articles_by_company' , 'articles' => $articles, 'company' => $this->company_model->get_company_by_id($id_company)['name']));
        } else {
            redirect(base_url() . 'acasa');
        }
    }

    public function get_articles_by_category($id_category)
    {
        if ($id_category) {
            $articles = $this->article_model->get_articles_by_category($id_category);
            $this->load->view('articles', array('template' => 'articles_by_category', 'articles' => $articles, 'category' => $this->article_model->get_category_by_id($id_category)['name']));
        } else {
            redirect(base_url() . 'acasa');
        }
    }

    public function get_articles_by_tag($id_tag)
    {
        if ($id_tag) {
            $articles = $this->article_model->get_articles_by_tag($id_tag);
            $this->load->view('articles', array('template' => 'articles_by_tag', 'articles' => $articles, 'tag' => $this->article_model->get_tag_by_id($id_tag)['name']));
        } else {
            redirect(base_url() . 'acasa');
        }
    }
}

?>