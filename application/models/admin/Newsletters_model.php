<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
include_once(APPPATH . 'models/Abstract_model.php');

class Newsletters_model extends Abstract_model {

    //Model Constructor
    // inherited from base class.
    protected $table_name;

    function __construct() {
        parent::__construct();
    }
    
    public function get_newsletter($newsletter_id) {
        $this->table_name = 'tb_newsletters';
        $result = $this->getBy('newsletter_id', $newsletter_id);
        if ($result) {
            return isset($result[0]) ? $result[0] : array();
        }
    }
    
    public function getNewsletters($condition = '', $offset = -1, $limit = 10, $order_by = '') {
        $sql = "SELECT newsletters.* FROM tb_newsletters as newsletters";
        $sql_count = "SELECT count(newsletters.newsletter_id) as total, newsletters.* FROM tb_newsletters as newsletters";

        if ($condition != '') {
            $sql .= " WHERE " . $condition;
            $sql_count .= " WHERE " . $condition;
        }
        if (trim($order_by) != '') {
            $sql .= $order_by;
        } else {
            $sql .= " ORDER BY newsletters.newsletter_id DESC ";
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
    
    public function add_newsletter($data) {
        $this->table_name = "tb_newsletters";
        return $this->save($data);
    }
    
    public function get_all_newsletters() {
        $this->table_name = "tb_newsletters";
        return $this->getAll();
    }
    
}
