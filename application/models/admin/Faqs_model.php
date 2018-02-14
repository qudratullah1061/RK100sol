<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
include_once(APPPATH . 'models/Abstract_model.php');

class Faqs_model extends Abstract_model {

    //Model Constructor
    // inherited from base class.
    protected $table_name;

    function __construct() {
        parent::__construct();
    }
    
    public function get_faq($faq_id) {
        $this->table_name = 'tb_faqs';
        $result = $this->getBy('faq_id', $faq_id);
        if ($result) {
            return isset($result[0]) ? $result[0] : array();
        }
    }
    
    public function get_all_active_faqs() {
        $this->table_name = "tb_faqs";
        return $this->getAll("is_active", 1);
    }
    
    public function getFaqs($condition = '', $offset = -1, $limit = 10, $order_by = '') {
        $sql = "SELECT faqs.* , admins.username as admin_name FROM tb_faqs as faqs LEFT JOIN tb_admin_users as admins ON (faqs.created_by = admins.admin_id)";
        $sql_count = "SELECT count(faqs.faq_id) as total, faqs.* , admins.username as admin_name FROM tb_faqs as faqs LEFT JOIN tb_admin_users as admins ON (faqs.created_by = admins.admin_id)";

        if ($condition != '') {
            $sql .= " WHERE " . $condition;
            $sql_count .= " WHERE " . $condition;
        }
        if (trim($order_by) != '') {
            $sql .= $order_by;
        } else {
            $sql .= " ORDER BY faqs.faq_id DESC ";
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
    
    public function add_faq($data) {
        $this->table_name = "tb_faqs";
        return $this->save($data);
    }
    
    public function update_faq($column, $row_id, $data) {
        $this->table_name = "tb_faqs";
        return $this->updateBy($column, $row_id, $data);
    }
    
}
