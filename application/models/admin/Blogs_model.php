<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
include_once(APPPATH . 'models/Abstract_model.php');

class Blogs_model extends Abstract_model {

    //Model Constructor
    // inherited from base class.
    protected $table_name;

    function __construct() {
        parent::__construct();
    }

    public function getBlogs($condition = '', $offset = -1, $limit = 10, $order_by = '') {
        $sql = "SELECT tags.* , admins.username as admin_name FROM tb_tags as tags LEFT JOIN tb_admin_users as admins ON (tags.created_by = admins.admin_id)";
        $sql_count = "SELECT count(tags.tag_id) as total, tags.* , admins.username as admin_name FROM tb_tags as tags LEFT JOIN tb_admin_users as admins ON (tags.created_by = admins.admin_id)";

        if ($condition != '') {
            $sql .= " WHERE " . $condition;
            $sql_count .= " WHERE " . $condition;
        }
        if (trim($order_by) != '') {
            $sql .= $order_by;
        } else {
            $sql .= " ORDER BY categories.category_id DESC ";
        }
        if ($offset >= 0 && $limit != -1) {
            $sql .= " LIMIT " . ($offset) . ', ' . $limit;
        }
        //echo $sql; exit;
        $count = $this->db->query($sql_count)->result('array');
        $results = $this->db->query($sql)->result('array');
        $results_array = array();
        $results_array['records'] = $results;
        $results_array['query'] = $sql;
        $results_array['total'] = $count[0]['total'];
        return $results_array;
    }

    public function get_tag($category_id) {
        $this->table_name = 'tb_tags';
        $result = $this->getBy('tag_id', $category_id);
        if ($result) {
            return isset($result[0]) ? $result[0] : array();
        }
    }
    
    public function add_tag($data) {
        $this->table_name = "tb_tags";
        return $this->save($data);
    }
    
    public function update_tag($column, $row_id, $data) {
        $this->table_name = "tb_tags";
        return $this->updateBy($column, $row_id, $data);
    }

}
