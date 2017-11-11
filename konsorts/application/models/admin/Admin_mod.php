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

    public function getAdminUsers($condition = '', $offset = -1, $limit = 10, $order_by = '') {
        $sql = "SELECT * FROM tb_admin_users";
        $sql_count = "SELECT count(tb_admin_users.admin_id) as total FROM tb_admin_users ";

        if ($condition != '') {
            $sql .= " WHERE " . $condition;
            $sql_count .= " WHERE " . $condition;
        }

        if (trim($order_by) != '') {
            $sql .= $order_by;
        } else {
            $sql .= " ORDER BY boh_types.type_id DESC ";
        }
        if ($offset >= 0 && $limit != -1) {
            $sql .= " LIMIT " . ($offset) . ', ' . $limit;
        }
        $count = $this->db->query($sql_count)->result('array');
        $results = $this->db->query($sql)->result('array');
        $results_array = array();
        $results_array['admin_users'] = $results;
        $results_array['query'] = $sql;
        $results_array['total'] = $count[0]['total'];
        return $results_array;
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
