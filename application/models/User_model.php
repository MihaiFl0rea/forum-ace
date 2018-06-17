<?php

class User_model extends CI_Model
{

    public $status;
    public $roles;

    function __construct()
    {
        // Call the Model constructor
        parent::__construct();
        $this->status = $this->config->item('status');
        $this->roles = $this->config->item('roles');
    }

    public function insertUser($postData)
    {
        $string = array(
            'username' => $postData['username'],
            'email' => $postData['email'],
            'role' => $this->roles[1],
            'status' => $this->status[0]
        );
        $q = $this->db->insert_string('backend_user', $string);
        $this->db->query($q);
        return $this->db->insert_id();
    }

    public function isDuplicate($email, $usersTable)
    {
        $this->db->get_where($usersTable, array('email' => $email), 1);
        return $this->db->affected_rows() > 0 ? TRUE : FALSE;
    }

    public function insertToken($userId, $userType)
    {
        $token = substr(sha1(rand()), 0, 30);
        $date = date('Y-m-d');

        $string = array(
            'token' => $token,
            'user_id' => $userId,
            'user_type' => $userType,
            'created' => $date
        );
        $query = $this->db->insert_string('tokens', $string);
        $this->db->query($query);
        return $token . $userId;
    }

    public function isTokenValid($token, $usersTable)
    {
        $tkn = substr($token, 0, 30);
        $uid = substr($token, 30);

        $q = $this->db->get_where('tokens', array(
            'tokens.token' => $tkn,
            'tokens.user_id' => $uid), 1);

        if ($this->db->affected_rows() > 0) {
            $row = $q->row();

            $created = $row->created;
            $createdTS = strtotime($created);
            $today = date('Y-m-d');
            $todayTS = strtotime($today);

            if ($createdTS != $todayTS) {
                return false;
            }

            $user_info = $this->getUserInfo($row->user_id, $usersTable);
            return $user_info;

        } else {
            return false;
        }
    }

    public function getUserInfo($id, $usersTable)
    {
        $q = $this->db->get_where($usersTable, array('id' => $id), 1);
        if ($this->db->affected_rows() > 0) {
            $row = $q->row();
            return $row;
        } else {
            error_log('no user found getUserInfo(' . $id . ')');
            return false;
        }
    }

    public function updateUserInfo($post, $usersTable)
    {
        $data = array(
            'password' => $post['password'],
            'last_login' => date('Y-m-d h:i:s A'),
            'status' => $this->status[1]
        );
        $this->db->where('id', $post['user_id']);
        $this->db->update($usersTable, $data);
        $success = $this->db->affected_rows();

        if (!$success) {
            error_log('Unable to updateUserInfo(' . $post['user_id'] . ')');
            return false;
        }

        $user_info = $this->getUserInfo($post['user_id'], $usersTable);
        return $user_info;
    }

    public function checkLogin($post, $usersTable)
    {
        $this->load->library('password');
        $this->db->select('*');
        $this->db->where('email', $post['email']);
        $query = $this->db->get($usersTable);
        $userInfo = $query->row();

        if (!$this->password->validate_password($post['password'], $userInfo->password)) {
            error_log('Unsuccessful login attempt(' . $post['email'] . ')');
            return false;
        }

        $this->updateLoginTime($userInfo->id, $usersTable);

        unset($userInfo->password);
        return $userInfo;
    }

    public function updateLoginTime($id, $usersTable)
    {
        $this->db->where('id', $id);
        $this->db->update($usersTable, array('last_login' => date('Y-m-d h:i:s A')));
        return;
    }

    public function getUserInfoByEmail($email, $usersTable)
    {
        $query = $this->db->get_where($usersTable, array('email' => $email), 1);
        if ($this->db->affected_rows() > 0) {
            $row = $query->row();
            return $row;
        } else {
            error_log('no user found getUserInfo(' . $email . ')');
            return false;
        }
    }

    public function updatePassword($post, $usersTable)
    {
        $this->db->where('id', $post['user_id']);
        $this->db->update($usersTable, array('password' => $post['password']));
        $success = $this->db->affected_rows();

        if (!$success) {
            error_log('Unable to updatePassword(' . $post['user_id'] . ')');
            return false;
        }
        return true;
    }

}
