<?php
/**
 * Created by PhpStorm.
 * User: Mihai
 * Date: 6/17/2018
 * Time: 10:05 PM
 */

class Company_model extends CI_Model
{
    const COMPANIES_TABLE = 'company';
    const ARTICLE_TABLE = 'article';
    const ARTICLE_COMMENT_TABLE = 'article_comment';
    const ARTICLE_COMMENT_THUMB_TABLE = 'article_comment_thumb';
    const ARTICLE_TAG_TABLE = 'article_tag';
    const ARTICLE_CATEGORY_TABLE = 'article_category';
    const CATEGORY_TABLE = 'category';
    const TAG_TABLE = 'tag';
    const STATUS_PENDING = 'pending';
    const STATUS_COMPLETED = 'completed';

    public function read($city)
    {
        $this->db->select('*');
        $conditions = array('status' => $this::STATUS_COMPLETED);
        if ($city) {
            $conditions = array(
                'status' => $this::STATUS_COMPLETED,
                'city' => ucfirst($city)
            );
        }
        $this->db->where($conditions);
        $query = $this->db->get($this::COMPANIES_TABLE);
        $results = $query->result();

        if (!empty($results)) {
            foreach ($results as $result) {
                $data[strtolower($result->city)][] = array( // save it like this for further statistics on home page
                    'id' => $result->id,
                    'name' => $result->name,
                    'city' => $result->city,
                    'logo' => $result->logo,
                    'email' => $result->email,
                    'address' => $result->address,
                    'register_date' => $result->register_date,
                    'status' => $result->status
                );
            }
        } else {
            $data = false;
        }

        return $data;
    }

    public function create($post_data, $input_file_name)
    {
        $this->load->library('password');
        $hashed_password = $this->password->create_hash($post_data['password']);
        $data_to_insert = array(
            'name' => $post_data['name'],
            'city' => $post_data['city'],
            'email' => $post_data['email'],
            'password' => $hashed_password,
            'register_date' => date('Y-m-d H:i:s'),
            'description' => !empty($post_data['description']) ? $post_data['description'] : '',
            'address' => !empty($post_data['address']) ? $post_data['address'] : '',
            'status' => $this::STATUS_COMPLETED
        );

        if (!empty($_FILES[$input_file_name])) {
            $_FILES[$input_file_name]['name'] = strtolower($post_data['name']) . '-' . $_FILES[$input_file_name]['name'];
            $upload_data = $this->do_upload($input_file_name);
            if (!empty($upload_data['upload_data'])) {
                $data_to_insert = array_merge($data_to_insert, array('logo' => $upload_data['upload_data']['file_name']));
                // also create a thumbnail
//                $this->create_thumbnail($upload_data['upload_data']['file_name']);
            }
        }

        $this->db->insert($this::COMPANIES_TABLE, $data_to_insert);
    }

    public function update($id, $post_data, $input_file_name)
    {
        $data_to_update = array(
            'name' => $post_data['name'],
            'city' => $post_data['city'],
            'email' => $post_data['email'],
            'description' => !empty($post_data['description']) ? $post_data['description'] : '',
            'address' => !empty($post_data['address']) ? $post_data['address'] : ''
        );

        // password updated?
        if (!empty($post_data['password'])) {
            $this->load->library('password');
            $hashed_password = $this->password->create_hash($post_data['password']);
            $data_to_update = array_merge($data_to_update, array('password' => $hashed_password));
        }

        // logo updated?
        if (!empty($_FILES[$input_file_name])) {
            $_FILES[$input_file_name]['name'] = strtolower($post_data['name']) . '-' . $_FILES[$input_file_name]['name'];
            $upload_data = $this->do_upload($input_file_name);
            if (!empty($upload_data['upload_data'])) {
                $data_to_update = array_merge($data_to_update, array('logo' => $upload_data['upload_data']['file_name']));
                // remove old logo, if any
                if (!empty($post_data['old-logo']) && file_exists(assets_uploads_absolute_path() . $post_data['old-logo'])) {
                    var_dump(assets_uploads_absolute_path() . $post_data['old-logo']);
                    unlink(assets_uploads_absolute_path() . $post_data['old-logo']);
                }
                // also create a thumbnail
//                $this->create_thumbnail($upload_data['upload_data']['file_name']);
            }
        }

        $this->db->where('id', $id);
        $this->db->update($this::COMPANIES_TABLE, $data_to_update);
    }

    public function delete($id, $logo)
    {
        // first, delete the logo file, if any
        if (!empty($logo) && file_exists(assets_uploads_absolute_path() . $logo)) {
            unlink(assets_uploads_absolute_path() . $logo);
        }
        /// only then delete the record from db as well
        $this->db->where('id', $id);
        $this->db->delete($this::COMPANIES_TABLE);
    }

    private function do_upload($input_name){
        $config = array(
            'upload_path' => "./assets/uploads/avatars",
            'allowed_types' => "gif|jpg|png|jpeg",
            'overwrite' => TRUE,
            'max_size' => "819200", // Can be set to particular file size , here it is 8 MB(8192 Kb)
            'max_height' => "1080",
            'max_width' => "1920"
        );
        $this->load->library('upload', $config);
        if($this->upload->do_upload($input_name)) {
            return array('upload_data' => $this->upload->data());
        } else {
            return array('error' => $this->upload->display_errors());
        }
    }

    private function create_thumbnail($image_name)
    {
        $config['image_library'] = 'gd2';
        $config['source_image'] = "./assets/uploads/avatars/" . $image_name;
        $config['new_image'] = "./assets/uploads/avatars/thumbnails/thumb-" . $image_name;
        $config['create_thumb'] = TRUE;
        $config['maintain_ratio'] = TRUE;
        $config['width']         = 75;
        $config['height']       = 50;

        $this->load->library('image_lib');
        $this->image_lib->initialize($config);
        $this->image_lib->clear();
        if (!$this->image_lib->resize()) {
            log_message('error', 'Thumbnail had not been created. Message: ' . $this->image_lib->display_errors());
        }

    }

    public function get_pending_companies()
    {
        $this->db->select('*');
        $this->db->where('status', $this::STATUS_PENDING);
        $query = $this->db->get($this::COMPANIES_TABLE);
        $results = $query->result();

        if (!empty($results)) {
            foreach ($results as $result) {
                $data[] = array(
                    'id' => $result->id,
                    'name' => $result->name,
                    'city' => $result->city,
                    'email' => $result->email,
                    'address' => $result->address,
                    'register_date' => $result->register_date,
                    'status' => $result->status
                );
            }
        } else {
            $data = false;
        }

        return $data;
    }

    public function get_company_by_id($id_company)
    {
        $query = $this->db->get_where($this::COMPANIES_TABLE, array('id' => $id_company), 1);
        if ($this->db->affected_rows() > 0) {
            $row = $query->row();
            return array(
                'id' => $row->id,
                'name' => $row->name,
                'city' => $row->city,
                'logo' => $row->logo,
                'description' => $row->description,
                'email' => $row->email,
                'address' => $row->address
            );
        } else {
            log_message('error','no company found get_company_by_id(' . $id_company . ')');
            return false;
        }
    }

    public function get_recommended_articles()
    {
        $observed_articles = $tracked_categories = $tracked_tags = $articles = array();
        $type_user = !empty($this->session->userdata['front_faculty']) ? '0' : '1';

        // get articles on which the current logged in user has commented
        $this->db->select('*');
        $this->db->where(array('id_user' => $this->session->userdata['front_id'], 'type_user' => $type_user));
        $query = $this->db->get($this::ARTICLE_COMMENT_TABLE);
        $results = $query->result();

        if (!empty($results)) {
            foreach ($results as $result) {
                array_push($observed_articles, $result->id_article);
            }
        }

        // get articles on which the current user has reviewed the addressed comments
        $this->db->select('*')
                ->from($this::ARTICLE_COMMENT_THUMB_TABLE)
                ->join($this::ARTICLE_COMMENT_TABLE, $this::ARTICLE_COMMENT_THUMB_TABLE . ".id_comment = " . $this::ARTICLE_COMMENT_TABLE . ".id_article_comment")
                ->where(array(
                    $this::ARTICLE_COMMENT_THUMB_TABLE . ".id_user" => $this->session->userdata['front_id'],
                    $this::ARTICLE_COMMENT_THUMB_TABLE . ".type_user" => $type_user)
                );
        $query = $this->db->get();
        $results = $query->result();

        if (!empty($results)) {
            foreach ($results as $result) {
                array_push($observed_articles, $result->id_article);
            }
        }

        if (!empty(array_unique($observed_articles))) {
            // get all categories of the above observed articles
            $this->db->select('*');
            $this->db->where_in('id_article', array(implode(',', array_unique($observed_articles))));
            $query = $this->db->get($this::ARTICLE_CATEGORY_TABLE);
            $results = $query->result();

            if (!empty($results)) {
                foreach ($results as $result) {
                    array_push($tracked_categories, $result->id_category);
                }
            }

            // get all tags of the above observed articles
            $this->db->select('*');
            $this->db->where_in('id_article', array(implode(',', array_unique($observed_articles))));
            $query = $this->db->get($this::ARTICLE_TAG_TABLE);
            $results = $query->result();

            if (!empty($results)) {
                foreach ($results as $result) {
                    array_push($tracked_tags, $result->id_tag);
                }
            }
        }

        if (!empty(array_unique($tracked_categories))) {
            // get all articles based on the above tracked categories and tags
            $this->db->select('*')
                ->from($this::ARTICLE_CATEGORY_TABLE)
                ->join($this::ARTICLE_TABLE, $this::ARTICLE_CATEGORY_TABLE . ".id_article = ".$this::ARTICLE_TABLE.".id_article")
                ->where_in($this::ARTICLE_CATEGORY_TABLE . ".id_category", array(implode(',', array_unique($tracked_categories))));
            $this->db->order_by($this::ARTICLE_TABLE . ".creation_date", 'desc');
            $query = $this->db->get();
            $results = $query->result();

            if (!empty($results)) {
                foreach ($results as $result) {
                    $articles[$result->id_article] = array(
                        'id' => $result->id_article,
                        'creation_date' => date('d.m.Y', strtotime($result->creation_date)),
                        'poster' => $result->poster,
                        'title' => $result->title
                    );
                }
            }
        }

        if (!empty(array_unique($tracked_tags))) {
            // get all articles based on the above tracked categories and tags
            $this->db->select('*')
                ->from($this::ARTICLE_TAG_TABLE)
                ->join($this::ARTICLE_TABLE, $this::ARTICLE_TAG_TABLE . ".id_article = ".$this::ARTICLE_TABLE.".id_article")
                ->where_in($this::ARTICLE_TAG_TABLE . ".id_tag", array(implode(',', array_unique($tracked_tags))));
            $this->db->order_by($this::ARTICLE_TABLE . ".creation_date", 'desc');
            $query = $this->db->get();
            $results = $query->result();

            if (!empty($results)) {
                foreach ($results as $result) {
                    $articles[$result->id_article] = array(
                        'id' => $result->id_article,
                        'creation_date' => date('d.m.Y', strtotime($result->creation_date)),
                        'poster' => $result->poster,
                        'title' => $result->title,
                        'company_name' => $this->get_company_by_id($result->id_company)['name']
                    );
                }
            }
        }

        return $articles;
    }

    /**
     * Get all categories of the current added articles
     */
    public function get_categories_articles()
    {
        $this->db->select('*')
            ->from($this::ARTICLE_CATEGORY_TABLE)
            ->join($this::CATEGORY_TABLE, $this::ARTICLE_CATEGORY_TABLE . ".id_category = " . $this::CATEGORY_TABLE . ".id_category");
        $query = $this->db->get();
        $results = $query->result();

        if (!empty($results)) {
            foreach ($results as $result) {
                if (!empty($data[$result->id_category])) {
                    $number_of_articles = $data[$result->id_category]['articles_number'] + 1;
                    $data[$result->id_category]['articles_number'] = $number_of_articles;
                } else {
                    $data[$result->id_category] = array(
                        'id_category' => $result->id_category,
                        'name' => $result->name,
                        'articles_number' => 1
                    );
                }
            }
            return $data;
        }
        return array();
    }

    /**
     * Get all tags of the current added articles
     */
    public function get_tags_articles()
    {
        $this->db->select('*')
            ->from($this::ARTICLE_TAG_TABLE)
            ->join($this::TAG_TABLE, $this::ARTICLE_TAG_TABLE . ".id_tag = " . $this::TAG_TABLE . ".id_tag");
        $query = $this->db->get();
        $results = $query->result();

        if (!empty($results)) {
            foreach ($results as $result) {
                $data[$result->id_tag] = array(
                    'id_tag' => $result->id_tag,
                    'name' => $result->name
                );
            }
            return $data;
        }
        return array();
    }
}