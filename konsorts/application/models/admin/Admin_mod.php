<?php

/*
 * * Admin model
 * * Model to save/update/delete Admin Users
 */
include_once(APPPATH . 'models/Abstract_model.php');

class Admin_mod extends Abstract_model {

    protected $is_error;
    public $admin_exists;
    public $admin_info;

    //Model Constructor
    function __construct() {
        // inherited from base class.
        $this->table_name = "tb_admin_users";
        parent::__construct();
    }

    public function IsAdmin($username = "", $password = "") {
        $this->is_error = FALSE;
        $this->admin_exists = FALSE;
        if (trim($username) && trim($password)) {
            $password = md5($password);
            $admin = $this->db->query("SELECT * FROM $this->table_name WHERE ((email='{$username}' OR username='{$username}') AND password='{$password}') LIMIT 1");
            if ($admin->num_rows() > 0) {
                $this->admin_exists = TRUE;
                $this->admin_info = $admin->result_array();
            }
        }
    }

    public function admin_login($username, $password) {
        $this->IsAdmin($username, $password);
        if (!$this->admin_exists) {
            $this->is_error = 1;
        } else {
            $this->is_error = 0;
        }
        return array('error' => $this->is_error, 'admin_info' => $this->admin_info[0]);
    }

//    public function checkNameExists($username, $admin_id) {
//        $this->db->select('admin_id');
//        if ($admin_id) {
//            $this->db->where(array('admin_id <>' => $admin_id, 'admin_username' => $username));
//        } else {
//            $this->db->where(array('admin_username' => $username));
//        }
//        $result = $this->db->get($this->table_name)->result();
//        if (!empty($result))
//            return true;
//        return false;
//    }
//
//    public function checkEmailExists($email, $admin_id) {
//        $this->db->select('admin_id');
//        if ($admin_id) {
//            $this->db->where(array('admin_id <>' => $admin_id, 'admin_email' => $email));
//        } else {
//            $this->db->where(array('admin_email' => $email));
//        }
//        $result = $this->db->get($this->table_name)->result();
//        if (!empty($result))
//            return true;
//        return false;
//    }

}
