<?php

class User_model extends CI_Model
{

    public $status;

    function __construct()
    {
        // Call the Model constructor
        parent::__construct();
        $this->status = $this->config->item('status');
        date_default_timezone_set('Europe/Bucharest');
    }

    public function insertUser($postData, $user_table)
    {
        $string = array(
            'email' => $postData['email'],
            'status' => $this->status[0],
            'register_date' => date('Y-m-d H:i:s')
        );

        if ($user_table == 'student') {
            $name = array(
                'first_name' => $postData['firstname'],
                'last_name' => $postData['lastname']
            );
        } else {
            $name = array(
                'name' => $postData['name']
            );
        }
        // add name in final insert array
        $string = array_merge($string, $name);
        // run query
        $q = $this->db->insert_string($user_table, $string);
        $this->db->query($q);
        // return the new record's id
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
            if (!$user_info) {
                return false;
            }
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
            log_message('error','no user found getUserInfo(' . $id . ')');
            return false;
        }
    }

    public function updateUserInfo($post, $usersTable)
    {
        $data = array(
            'password' => $post['password'],
            'last_login' => date('Y-m-d H:i:s'),
            'status' => $this->status[2]
        );
        $this->db->where('id', $post['user_id']);
        $this->db->update($usersTable, $data);
        $success = $this->db->affected_rows();

        if (!$success) {
            log_message('error','Unable to updateUserInfo(' . $post['user_id'] . ')');
            return false;
        }

        $user_info = $this->getUserInfo($post['user_id'], $usersTable);
        return $user_info;
    }

    public function approveUser($id, $usersTable)
    {
        $data = array(
            'status' => $this->status[1]
        );
        $this->db->where('id', $id);
        $this->db->update($usersTable, $data);
        $success = $this->db->affected_rows();

        if (!$success) {
            log_message('error','Unable to approveUser(' . $id . ', '. $usersTable .')');
            return false;
        }

        return true;
    }

    public function checkLogin($post, $usersTable, $frontLogin = false)
    {
        $this->load->library('password');
        $this->db->select('*');
        $this->db->where('email', $post['email']);
        $query = $this->db->get($usersTable);
        $userInfo = $query->row();
        // if front login, login company as well
        if (!$userInfo && $frontLogin) {
            $this->db->select('*');
            $this->db->where('email', $post['email']);
            $query = $this->db->get('company');
            $userInfo = $query->row();
        }

        if ($userInfo) {
            if (!$this->password->validate_password($post['password'], $userInfo->password)) {
                log_message('error','Unsuccessful login attempt(' . $post['email'] . ')');
                return false;
            }

            $this->updateLoginTime($userInfo->id, $usersTable);

            unset($userInfo->password);
            return $userInfo;
        }

        return false;
    }

    public function updateLoginTime($id, $usersTable)
    {
        $this->db->where('id', $id);
        $this->db->update($usersTable, array('last_login' => date('Y-m-d H:i:s')));
        return;
    }

    public function getUserInfoByEmail($email, $usersTable)
    {
        $query = $this->db->get_where($usersTable, array('email' => $email), 1);
        if ($this->db->affected_rows() > 0) {
            $row = $query->row();
            return $row;
        } else {
            log_message('error','no user found getUserInfo(' . $email . ')');
            return false;
        }
    }

    public function updatePassword($post, $usersTable)
    {
        $this->db->where('id', $post['user_id']);
        $this->db->update($usersTable, array('password' => $post['password']));
        $success = $this->db->affected_rows();

        if (!$success) {
            log_message('error','Unable to updatePassword(' . $post['user_id'] . ')');
            return false;
        }
        return true;
    }

    /*
     * Admin related methods ONLY!
     */

    /**
     * If user is company, check if has updated his profile and specified his company
     * @param $userType
     * @param $firmId
     * @return bool
     */
    public function hasFirmAssociated($userType, $companyId)
    {
        if ($userType == 'company') {
            $this->db->get_where('company', array('id_company' => $companyId), 1);
            if ($this->db->affected_rows() > 0) {
                return true;
            } else {
                return false;
            }
        }

        return true;
    }

    public function get_statistics()
    {
        // students
        $query = $this->db->get_where('student', array('status' => 'completed'));
        $students = count($query->result());

        // students ACE
        $query = $this->db->get_where('student', array('faculty' => 'ace', 'status' => 'completed'));
        $students_ace = count($query->result());

        // students Mate-Info
        $query = $this->db->get_where('student', array('faculty' => 'mate-info', 'status' => 'completed'));
        $students_mate = count($query->result());

        // comments of students
        $query = $this->db->get_where('article_comment', array('type_user' => 0));
        $students_comments = count($query->result());

        // companies
        $query = $this->db->get_where('company', array('status' => 'completed'));
        $companies = count($query->result());

        // companies from Craiova
        $query = $this->db->get_where('company', array('status' => 'completed', 'city' => 'Craiova'));
        $companies_cr = count($query->result());

        // companies from Bucuresti
        $query = $this->db->get_where('company', array('status' => 'completed', 'city' => 'Bucuresti'));
        $companies_buc = count($query->result());

        // the other remaining companies
        $companies_other = $companies - ($companies_cr + $companies_buc);

        // students
        $query = $this->db->get('article');
        $articles = count($query->result());

        // articles_companies
        $query = $this->db->get_where('article', array('type' => 0));
        $articles_companies = count($query->result());

        // articles_post
        $query = $this->db->get_where('article', array('type' => 1));
        $articles_posts = count($query->result());

        return array(
            '#students' => $students,
            'students_ace' => $students_ace,
            'students_mate' => $students_mate,
            'comments_students' => $students_comments,
            '#companies' => $companies,
            'companies_cr' => $companies_cr,
            'companies_buc' => $companies_buc,
            'companies_other' => $companies_other,
            '#articles' => $articles,
            'articles_companies' => $articles_companies,
            'articles_posts' => $articles_posts
        );
    }

}
