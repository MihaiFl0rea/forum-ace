<?php
/**
 * Created by PhpStorm.
 * User: Mihai
 * Date: 8/23/2018
 * Time: 8:25 PM
 */

// Add Froala Editor PHP SDK
require_once(APPPATH . 'third_party' . DIRECTORY_SEPARATOR . 'froala_editor' . DIRECTORY_SEPARATOR . 'lib' . DIRECTORY_SEPARATOR . 'FroalaEditor.php');

class Article_model extends CI_Model
{
    const TABLE_ARTICLE = 'article';
    const TABLE_ARTICLE_CATEGORY = 'article_category';
    const TABLE_ARTICLE_TAG = 'article_tag';
    const TABLE_ARTICLE_COMMENT = 'article_comment';
    const TABLE_ARTICLE_COMMENT_THUMB = 'article_comment_thumb';
    const TABLE_CATEGORY = 'category';
    const TABLE_TAG = 'tag';
    const TABLE_STUDENT = 'student';
    const TABLE_COMPANY = 'company';

    /** -------
     * Articles
     * --------*/
    public function read_articles($front = false)
    {
        $this->db->select('*');
        if ((empty($this->session->userdata['role'])
            || ($this->session->userdata['role'] != 'admin'))
            && !$front) {
            $this->db->where(array('id_company' => $this->session->userdata['id']));
        }
        $this->db->order_by('creation_date', 'desc');
        $query = $this->db->get($this::TABLE_ARTICLE);
        $results = $query->result();

        if (!empty($results)) {
            foreach ($results as $result) {
                $data[] = $this->map_article_data($result);
            }
        } else {
            $data = false;
        }

        return $data;
    }

    public function map_article_data($article)
    {
        $categories_and_tags = $comments = array();

        // check for any article category
        $this->db->select('*');
        $this->db->where(array('id_article' => $article->id_article));
        $query = $this->db->get($this::TABLE_ARTICLE_CATEGORY);
        $results = $query->result();

        if (!empty($results)) {
            $all = '';
            $categories_and_tags['categories'] = array();
            foreach ($results as $result) {
                array_push($categories_and_tags['categories'], $result->id_category);
                $all .= $this->get_category_by_id($result->id_category)['name'] . ', ';
            }
            $all = rtrim($all, ', ');
            $categories_and_tags['all_categories'] = $all;
        }

        // check for any article tag
        $this->db->select('*');
        $this->db->where(array('id_article' => $article->id_article));
        $query = $this->db->get($this::TABLE_ARTICLE_TAG);
        $results = $query->result();

        if (!empty($results)) {
            $all = '';
            $categories_and_tags['tags'] = array();
            foreach ($results as $result) {
                array_push($categories_and_tags['tags'], $result->id_tag);
                $all .= $this->get_tag_by_id($result->id_tag)['name'] . ', ';
            }
            $all = rtrim($all, ', ');
            $categories_and_tags['all_tags'] = $all;
        }

        // also, check for comments
        $this->db->select('*');
        $this->db->where(array('id_article' => $article->id_article));
        $this->db->order_by('creation_date', 'asc');
        $query = $this->db->get($this::TABLE_ARTICLE_COMMENT);
        $results = $query->result();
        // careful here, twisted logic incoming ...
        if (!empty($results)) {
            /** @var $already_responded - Keep in this array the comments which have been already marked as answers to another comments */
            $already_responded = array();
            foreach ($results as $result) {
                // details for user who made the comment (name and avatar)
                $user = $this->get_user_by_type($result->id_user, $result->type_user);
                // if current comment is a response to another
                if ($result->response_to != 0) { // #3
                    // if current comment is a response to another response
                    if (!empty($already_responded[$result->response_to])) { // 3rd possible case
                        // then add current comment as a response to the other response,
                        // hence a 5 dimension array which holds a 6th one :D
                        $comments[$already_responded[$result->response_to]]['responded'][$result->response_to]['responded'][$result->id_article_comment] = array(
                            'id_user' => $result->id_user,
                            'name_user' => $user['name'],
                            'avatar_user' => $user['avatar'],
                            'creation_date' => date('d.m.Y H:i', strtotime($result->creation_date)),
                            'body' => $result->body,
                            'reviews' => $this->get_comment_reviews($result->id_article_comment)
                            // and that's it, don't allow a 3rd level of responses!
                        );
                    } else { // 2nd possible case
                        // current comment is a response to another comment
                        $comments[$result->response_to]['responded'][$result->id_article_comment] = array(
                            'id_user' => $result->id_user,
                            'name_user' => $user['name'],
                            'avatar_user' => $user['avatar'],
                            'creation_date' => date('d.m.Y H:i', strtotime($result->creation_date)),
                            'body' => $result->body,
                            'reviews' => $this->get_comment_reviews($result->id_article_comment),
                            'responded' => array()
                        );
                        // mark current comment as response (key is current comment's id and value is the id of the comment to which this is the answer)
                        $already_responded[$result->id_article_comment] = $result->response_to;
                    }
                } else { // 1st possible case
                    // current comment is not a response
                    $comments[$result->id_article_comment] = array(
                        'id_user' => $result->id_user,
                        'name_user' => $user['name'],
                        'avatar_user' => $user['avatar'],
                        'creation_date' => date('d.m.Y H:i', strtotime($result->creation_date)),
                        'body' => $result->body,
                        'reviews' => $this->get_comment_reviews($result->id_article_comment),
                        'responded' => array()
                    );
                }
            }
        }

        $company = $this->get_company_by_id($article->id_company);

        return array_merge(array(
            'id' => $article->id_article,
            'title' => $article->title,
            'creation_date' => date('d.m.Y', strtotime($article->creation_date)),
            'creation_date_en' => date('M d, Y', strtotime($article->creation_date)),
            'body' => str_replace(array('<pre>','</pre>'), '', htmlspecialchars_decode($article->body)),
            'poster' => $article->poster,
            'type' => $article->type,
            'type_name' => $this->get_article_type($article->type),
            'id_company' => $company['id'],
            'name_company' => $company['name'],
            'logo_company' => $company['logo'],
            'city_company' => $company['city'],
            'comments' => $comments
        ), $categories_and_tags);
    }

    public function create_article($id_company, $company_name, $post_data, $input_file_name)
    {
        // insert data into `article` table
        $data_to_insert = array(
            'id_company' => $id_company,
            'creation_date' => date('Y-m-d H:i:s'),
            'body' => $post_data['article-body'],
            'title' => $post_data['title'],
            'type' => $post_data['type']
        );

        if (!empty($_FILES[$input_file_name])) {
            $_FILES[$input_file_name]['name'] = 'poster-' . $_FILES[$input_file_name]['name'];
            $upload_data = $this->do_upload($input_file_name, $company_name);
            if (!empty($upload_data['upload_data'])) {
                $data_to_insert = array_merge($data_to_insert, array('poster' => $upload_data['upload_data']['file_name']));
            }
        }

        $this->db->insert($this::TABLE_ARTICLE, $data_to_insert);
        $article_insert_id = $this->db->insert_id();

        // insert data into `article_category` table
        if (!empty($post_data['categories'])) {
            foreach ($post_data['categories'] as $category_id) {
                $this->db->insert($this::TABLE_ARTICLE_CATEGORY, array('id_article' => $article_insert_id, 'id_category' => $category_id));
            }
        }

        // insert data into `article_tag` table
        if (!empty($post_data['tags'])) {
            foreach ($post_data['tags'] as $tag_id) {
                $this->db->insert($this::TABLE_ARTICLE_TAG, array('id_article' => $article_insert_id, 'id_tag' => $tag_id));
            }
        }
    }

    public function update_article($id_article, $company_name, $post_data, $input_file_name)
    {
        // update data into `article` table
        $data_to_update = array(
            'body' => $post_data['article-body'],
            'title' => $post_data['title'],
            'type' => $post_data['type']
        );

        if (!empty($_FILES[$input_file_name])) {
            $_FILES[$input_file_name]['name'] = 'poster-' . $_FILES[$input_file_name]['name'];
            $upload_data = $this->do_upload($input_file_name, $company_name);
            if (!empty($upload_data['upload_data'])) {
                $data_to_update = array_merge($data_to_update, array('poster' => $upload_data['upload_data']['file_name']));
                // remove old poster, if any
                if (!empty($post_data['old-poster']) && file_exists(assets_files_absolute_path() . $company_name . DIRECTORY_SEPARATOR . $post_data['old-poster'])) {
                    unlink(assets_files_absolute_path() . $company_name . DIRECTORY_SEPARATOR . $post_data['old-poster']);
                }
            }
        }

        $this->db->where('id_article', $id_article);
        $this->db->update($this::TABLE_ARTICLE, $data_to_update);

        // update data into `article_category` table
        if (!empty($post_data['categories'])) {
            $existing_categories = $this->get_categories_by_article($id_article);
            foreach ($post_data['categories'] as $category_id) {
                // if current category is not found in the existing ones, then insert it
                if (!in_array($category_id, $existing_categories)) {
                    $this->db->insert($this::TABLE_ARTICLE_CATEGORY, array('id_article' => $id_article, 'id_category' => $category_id));
                }
            }
            foreach ($existing_categories as $category) {
                // otherwise, if the old existing category is not found anymore through the updated ones, delete it
                if (!in_array($category, $post_data['categories'])) {
                    $this->db->where(array('id_category' => $category, 'id_article' => $id_article));
                    $this->db->delete($this::TABLE_ARTICLE_CATEGORY);
                }
            }
        }

        // update data into `article_tag` table
        if (!empty($post_data['tags'])) {
            $existing_tags = $this->get_tags_by_article($id_article);
            foreach ($post_data['tags'] as $tag_id) {
                // if current tag is not found in the existing ones, then insert it
                if (!in_array($tag_id, $existing_tags)) {
                    $this->db->insert($this::TABLE_ARTICLE_TAG, array('id_article' => $id_article, 'id_tag' => $tag_id));
                }
            }
            foreach ($existing_tags as $tag) {
                // otherwise, if the old existing tag is not found anymore through the updated ones, delete it
                if (!in_array($tag, $post_data['tags'])) {
                    $this->db->where(array('id_tag' => $tag, 'id_article' => $id_article));
                    $this->db->delete($this::TABLE_ARTICLE_TAG);
                }
            }
        }
    }

    public function delete_article($id)
    {

    }

    public function get_article_by_id($id)
    {
        $this->db->select('*');
        $this->db->where('id_article', $id);
        $query = $this->db->get($this::TABLE_ARTICLE);
        $result = $query->row();

        return $this->map_article_data($result);
    }

    public function get_company_by_id($id)
    {
        $this->db->select('*');
        $this->db->where('id', $id);
        $query = $this->db->get($this::TABLE_COMPANY);
        $result = $query->row();

        return array('id' => $result->id, 'name' => $result->name, 'logo' => $result->logo, 'city' => $result->city);
    }

    public function get_article_type($id)
    {
        if ($id == '0') {
            return 'Anunt companie';
        } else {
            return 'Postare';
        }
    }

    public function get_categories_by_article($id_article)
    {
        $this->db->select('*');
        $this->db->where('id_article', $id_article);
        $query = $this->db->get($this::TABLE_ARTICLE_CATEGORY);
        $results = $query->result();

        $categories = array();
        if (!empty($results)) {
            foreach ($results as $result) {
                array_push($categories, $result->id_category);
            }
        }

        return $categories;
    }

    public function get_tags_by_article($id_article)
    {
        $this->db->select('*');
        $this->db->where('id_article', $id_article);
        $query = $this->db->get($this::TABLE_ARTICLE_TAG);
        $results = $query->result();

        $tags = array();
        if (!empty($results)) {
            foreach ($results as $result) {
                array_push($tags, $result->id_tag);
            }
        }

        return $tags;
    }

    public function get_user_by_type($id_user, $type_user)
    {
        // 0 = student, 1 = company
        if ($type_user == 0) {
            $this->db->select('*');
            $this->db->where('id', $id_user);
            $query = $this->db->get($this::TABLE_STUDENT);
            $result = $query->row();
            // return name
            return array(
                'name' => $result->last_name . ' ' . $result->first_name,
                'avatar' => assets_uploads_url() . $result->avatar
            );
        } else {
            $this->db->select('*');
            $this->db->where('id', $id_user);
            $query = $this->db->get($this::TABLE_COMPANY);
            $result = $query->row();
            // return name
            return array(
                'name' => $result->name,
                'avatar' => assets_uploads_url() . $result->logo
            );
        }
    }

    private function do_upload($input_name, $company_name){
        $dir_absolute_path = assets_files_absolute_path() . $company_name . DIRECTORY_SEPARATOR;
        if (!file_exists($dir_absolute_path) && !is_dir($dir_absolute_path)) {
            mkdir($dir_absolute_path);
        }
        $config = array(
            'upload_path' => "./assets/uploads/articles/" . $company_name,
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

    /** --------------------------------------
     * Handle Froala Editor's images and files
     * --------------------------------------- */
    public function upload_froala_image($company_name)
    {
        // Store the image.
        try {
            $dir_absolute_path = assets_files_absolute_path() . $company_name . DIRECTORY_SEPARATOR;
            if (!file_exists($dir_absolute_path) && !is_dir($dir_absolute_path)) {
                mkdir($dir_absolute_path);
            }
            $dir_relative_path = assets_uploads_files_url() . $company_name . '/';
            $response = FroalaEditor_Image::upload($dir_relative_path);
            return stripslashes(json_encode($response));
        }
        catch (Exception $e) {
            http_response_code(404);
        }
    }

    public function delete_froala_image($src)
    {
        // Delete the image.
        try {
            FroalaEditor_Image::delete($src);
            return stripslashes(json_encode('Success'));
        }
        catch (Exception $e) {
            http_response_code(404);
        }
    }

    public function upload_froala_file($company_name)
    {
        // Store the file.
        try {
            $dir_absolute_path = assets_files_absolute_path() . $company_name . DIRECTORY_SEPARATOR;
            if (!file_exists($dir_absolute_path) && !is_dir($dir_absolute_path)) {
                mkdir($dir_absolute_path);
            }
            $dir_relative_path = assets_uploads_files_url() . $company_name . '/';

            $uploadOptions = array(
                'fieldname' => 'file',
                'validation' => array(
                    'allowedExts' => array('txt', 'pdf', 'doc', 'mp3', 'mp4'),
                    'allowedMimeTypes' => array('text/plain', 'application/msword', 'application/x-pdf', 'application/pdf', 'audio/mpeg', 'video/mp4')
                )
            );

            $response = FroalaEditor_File::upload($dir_relative_path, $uploadOptions);
            // if uploaded file is not a video one (and presumably not an image either)
            if ($_FILES['file']['type'] != 'video/mp4') {
                // create full path towards the file itself in order to be downloadable
//                $response->link = $_SERVER['DOCUMENT_ROOT'] . $response->link;
            }
            return stripslashes(json_encode($response));
        }
        catch (Exception $e) {
            http_response_code(404);
        }
    }

    public function delete_froala_file($src)
    {
        // Delete the file.
        try {
            FroalaEditor_File::delete($src);
            return stripslashes(json_encode('Success'));
        }
        catch (Exception $e) {
            http_response_code(404);
        }
    }

    /** ---------------
     * Article comments
     * --------------- */

    public function add_comment($post_data)
    {
        $id_article = $post_data['id_article'];
        $comment = nl2br($post_data['comment']);
        $is_response = $post_data['is_response'];
        $type_user = !empty($this->session->userdata['front_faculty']) ? '0' : '1';
        $creation_date = date('Y-m-d H:i:s');
        $avatar = !empty($this->session->userdata['front_faculty']) ?
            $this->session->userdata['front_avatar'] : $this->session->userdata['front_logo'];
        $user_name = !empty($this->session->userdata['front_faculty']) ?
            $this->session->userdata['front_last_name'] . ' ' . $this->session->userdata['front_first_name'] : $this->session->userdata['front_name'];

        $data_to_insert = array(
            'id_article' => $id_article,
            'id_user' => $this->session->userdata['front_id'],
            'type_user' => $type_user, // 0 = student, 1 = company
            'creation_date' => $creation_date,
            'body' => $comment,
            'response_to' => $is_response
        );
        $this->db->insert($this::TABLE_ARTICLE_COMMENT, $data_to_insert);

        return json_encode(
            array(
                'id_comment' => $this->db->insert_id(),
                'avatar' => assets_uploads_url() . $avatar,
                'creation_date' => date('d.m.Y H:i', strtotime($creation_date)),
                'user_name' => $user_name,
                'comment' => $comment
            )
        );
    }

    public function edit_comment($post_data)
    {
        $id_comment = $post_data['id_comment'];
        $updated_comment = nl2br($post_data['updated_comment']);

        $this->db->where('id_article_comment', $id_comment);
        $this->db->update($this::TABLE_ARTICLE_COMMENT, array('body' => $updated_comment));

        return json_encode(
            array(
                'comment' => $updated_comment
            )
        );
    }

    public function delete_comment($id)
    {
        $this->db->where('id_article_comment', $id);
        $this->db->delete($this::TABLE_ARTICLE_COMMENT);
    }

    public function review_comment($post_data)
    {
        $type_user = !empty($this->session->userdata['front_faculty']) ? '0' : '1';
        $user_of_comment = $this->get_user_of_comment($post_data['id_comment']);
        // if the user that reviews is the one who made the comment

        if (($user_of_comment['id'] == $this->session->userdata['front_id'])
            && ($type_user == $user_of_comment['type'])) {
            // return empty response
            return false;
        }

        $data_to_insert = array(
            'id_comment' => $post_data['id_comment'],
            'type' => $post_data['review'],
            'id_user' => $this->session->userdata['front_id'],
            'type_user' => $type_user // 0 = student, 1 = company
        );

        $this->db->insert($this::TABLE_ARTICLE_COMMENT_THUMB, $data_to_insert);

        return json_encode(
            array(
                'id_review_comment' => $this->db->insert_id()
            )
        );
    }

    public function delete_review_comment($id)
    {
        $this->db->where('id_article_comment_thumb', $id);
        $this->db->delete($this::TABLE_ARTICLE_COMMENT_THUMB);
    }

    public function get_comment_reviews($id_comment)
    {
        $this->db->where('id_comment', $id_comment);
        $query = $this->db->get($this::TABLE_ARTICLE_COMMENT_THUMB);
        $results = $query->result();

        if (!empty($results)) {
            $data['thumbs_up'] = $data['thumbs_down'] = array();
            foreach ($results as $result) {
                $user = $this->get_user_by_type($result->id_user, $result->type_user);
                if ($result->type == 0) {
                    $data['thumbs_down'][$result->id_user] = array(
                        'name' => $user['name'],
                        'id_review' => $result->id_article_comment_thumb,
                        'type' => $result->type,
                        'id_user' => $result->id_user
                    );
                } else {
                    $data['thumbs_up'][$result->id_user] = array(
                        'name' => $user['name'],
                        'id_review' => $result->id_article_comment_thumb,
                        'type' => $result->type,
                        'id_user' => $result->id_user
                    );
                }
            }

            return $data;
        }
        return array(
            'thumbs_up' => array(),
            'thumbs_down' => array()
        );
    }

    public function get_user_of_comment($id_comment)
    {
        $this->db->where('id_article_comment', $id_comment);
        $query = $this->db->get($this::TABLE_ARTICLE_COMMENT);
        $result = $query->row();

        return array(
            'id' => $result->id_user,
            'type' => $result->type_user
        );
    }

    /** ------------------
     * Articles categories
     * ------------------- */
    public function read_categories()
    {
        $query = $this->db->get($this::TABLE_CATEGORY);
        $results = $query->result();

        if (!empty($results)) {
            foreach ($results as $result) {
                $data[] = array('id' => $result->id_category, 'name' => $result->name);
            }
        } else {
            $data = false;
        }

        return $data;
    }

    public function create_category($name)
    {
        $data = array('name' => $name);
        $this->db->insert($this::TABLE_CATEGORY, $data);
    }

    public function update_category($id, $name)
    {
        $this->db->where('id_category', $id);
        $this->db->update($this::TABLE_CATEGORY, array('name' => $name));
    }

    public function delete_category($id)
    {
        $this->db->where('id_category', $id);
        $this->db->delete($this::TABLE_CATEGORY);
    }

    public function get_category_by_id($id)
    {
        $this->db->select('*');
        $this->db->where('id_category', $id);
        $query = $this->db->get($this::TABLE_CATEGORY);
        $result = $query->row();

        return array('id' => $result->id_category, 'name' => $result->name);
    }

    /** ------------
     * Articles tags
     * ------------- */
    public function read_tags()
    {
        $query = $this->db->get($this::TABLE_TAG);
        $results = $query->result();

        if (!empty($results)) {
            foreach ($results as $result) {
                $data[] = array('id' => $result->id_tag, 'name' => $result->name);
            }
        } else {
            $data = false;
        }

        return $data;
    }

    public function create_tag($name)
    {
        $data = array('name' => $name);
        $this->db->insert($this::TABLE_TAG, $data);
    }

    public function update_tag($id, $name)
    {
        $this->db->where('id_tag', $id);
        $this->db->update($this::TABLE_TAG, array('name' => $name));
    }

    public function delete_tag($id)
    {
        $this->db->where('id_tag', $id);
        $this->db->delete($this::TABLE_TAG);
    }

    public function get_tag_by_id($id)
    {
        $this->db->select('*');
        $this->db->where('id_tag', $id);
        $query = $this->db->get($this::TABLE_TAG);
        $result = $query->row();

        return array('id' => $result->id_tag, 'name' => $result->name);
    }
}

?>