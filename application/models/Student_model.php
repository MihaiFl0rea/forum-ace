<?php
/**
 * Created by PhpStorm.
 * User: Mihai
 * Date: 6/17/2018
 * Time: 10:05 PM
 */

class Student_model extends CI_Model
{
    const STUDENTS_TABLE = 'student';
    const STATUS_PENDING = 'pending';
    const STATUS_COMPLETED = 'completed';

    public function read($faculty)
    {
        $this->db->select('*');
        $conditions = array('status' => $this::STATUS_COMPLETED);
        if ($faculty) {
            $conditions = array(
                'status' => $this::STATUS_COMPLETED,
                'faculty' => strtoupper($faculty)
            );
        }
        $this->db->where($conditions);
        $query = $this->db->get($this::STUDENTS_TABLE);
        $results = $query->result();

        if (!empty($results)) {
            foreach ($results as $result) {
                $data[strtolower($result->faculty)][] = array(
                    'id' => $result->id,
                    'name' => $result->last_name . ' ' . $result->first_name,
                    'faculty' => strtoupper($result->faculty),
                    'email' => $result->email,
                    'avatar' => $result->avatar,
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
            'first_name' => $post_data['first_name'],
            'last_name' => $post_data['last_name'],
            'email' => $post_data['email'],
            'faculty' => $post_data['faculty'],
            'password' => $hashed_password,
            'register_date' => date('Y-m-d H:i:s'),
            'status' => $this::STATUS_COMPLETED
        );

        if (!empty($_FILES[$input_file_name])) {
            $_FILES[$input_file_name]['name'] = strtolower($post_data['last_name']) . '-' . strtolower($post_data['first_name']) . '-' . $_FILES[$input_file_name]['name'];
            $upload_data = $this->do_upload($input_file_name);
            if (!empty($upload_data['upload_data'])) {
                $data_to_insert = array_merge($data_to_insert, array('avatar' => $upload_data['upload_data']['file_name']));
                // also create a thumbnail
//                $this->create_thumbnail($upload_data['upload_data']['file_name']);
            }
        }

        $this->db->insert($this::STUDENTS_TABLE, $data_to_insert);
    }

    public function update($id, $post_data, $input_file_name)
    {
        $data_to_update = array(
            'first_name' => $post_data['first_name'],
            'last_name' => $post_data['last_name'],
            'email' => $post_data['email'],
            'faculty' => $post_data['faculty'],
        );

        // password updated?
        if (!empty($post_data['password'])) {
            $this->load->library('password');
            $hashed_password = $this->password->create_hash($post_data['password']);
            $data_to_update = array_merge($data_to_update, array('password' => $hashed_password));
        }

        // logo updated?
        if (!empty($_FILES[$input_file_name])) {
            $_FILES[$input_file_name]['name'] = strtolower($post_data['last_name']) . '-' . strtolower($post_data['first_name']) . '-' . $_FILES[$input_file_name]['name'];
            $upload_data = $this->do_upload($input_file_name);
            if (!empty($upload_data['upload_data'])) {
                $data_to_update = array_merge($data_to_update, array('avatar' => $upload_data['upload_data']['file_name']));
                // remove old avatar, if any
                if (!empty($post_data['old-avatar']) && file_exists(assets_uploads_absolute_path() . $post_data['old-avatar'])) {
                    unlink(assets_uploads_absolute_path() . $post_data['old-avatar']);
                }
                // also create a thumbnail
//                $this->create_thumbnail($upload_data['upload_data']['file_name']);
            }
        }

        $this->db->where('id', $id);
        $this->db->update($this::STUDENTS_TABLE, $data_to_update);
    }

    public function delete($id, $avatar)
    {
        // first, delete the avatar file, if any
        if (!empty($avatar) && file_exists(assets_uploads_absolute_path() . $avatar)) {
            unlink(assets_uploads_absolute_path() . $avatar);
        }
        /// only then delete the record from db as well
        $this->db->where('id', $id);
        $this->db->delete($this::STUDENTS_TABLE);
    }

    private function do_upload($input_name){
        $config = array(
            'upload_path' => "./assets/uploads/avatars",
            'allowed_types' => "gif|jpg|png|jpeg",
            'overwrite' => TRUE,
            'max_size' => "2048000", // Can be set to particular file size , here it is 2 MB(2048 Kb)
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

    public function get_pending_students()
    {
        $this->db->select('*');
        $this->db->where('status', $this::STATUS_PENDING);
        $query = $this->db->get($this::STUDENTS_TABLE);
        $results = $query->result();

        if (!empty($results)) {
            foreach ($results as $result) {
                $data[] = array(
                    'id' => $result->id,
                    'first_name' => $result->first_name,
                    'last_name' => $result->last_name,
                    'email' => $result->email,
                    'register_date' => $result->register_date,
                    'status' => $result->status
                );
            }
        } else {
            $data = false;
        }

        return $data;
    }

    public function get_student_by_id($id_student)
    {
        $query = $this->db->get_where($this::STUDENTS_TABLE, array('id' => $id_student), 1);
        if ($this->db->affected_rows() > 0) {
            $result = $query->row();
            return array(
                'id' => $result->id,
                'last_name' => $result->last_name,
                'first_name' => $result->first_name,
                'faculty' => $result->faculty,
                'email' => $result->email,
                'avatar' => $result->avatar
            );
        } else {
            log_message('error','no student found get_student_by_id(' . $id_student . ')');
            return false;
        }
    }
}