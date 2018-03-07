<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
include_once(APPPATH . 'models/Abstract_model.php');

class Promos_model extends Abstract_model {

    //Model Constructor
    // inherited from base class.
    protected $table_name;

    function __construct() {
        parent::__construct();
    }
    
    public function get_promo($promo_id) {
        $this->table_name = 'tb_promos';
        $result = $this->getBy('promo_id', $promo_id);
        if ($result) {
            return isset($result[0]) ? $result[0] : array();
        }
    }
    
    public function getPromos($condition = '', $offset = -1, $limit = 10, $order_by = '') {
        $sql = "SELECT promos.* , admins.username as admin_name FROM tb_promos as promos LEFT JOIN tb_admin_users as admins ON (promos.created_by = admins.admin_id)";
        $sql_count = "SELECT count(promos.promo_id) as total, promos.* , admins.username as admin_name FROM tb_promos as promos LEFT JOIN tb_admin_users as admins ON (promos.created_by = admins.admin_id)";

        if ($condition != '') {
            $sql .= " WHERE " . $condition;
            $sql_count .= " WHERE " . $condition;
        }
        if (trim($order_by) != '') {
            $sql .= $order_by;
        } else {
            $sql .= " ORDER BY promos.promo_id DESC ";
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
    
    public function get_all_used_promo_code($promo_code) {
        $this->db->select('COUNT(promo_code) AS promo_code');
        $this->db->from('tb_promos_used_by_members');
        $this->db->where('promo_code', $promo_code);
        $query = $this->db->get();
        return $query->row();
    }
    
    public function add_promo($data) {
        $this->table_name = "tb_promos";
        return $this->save($data);
    }
    
    public function update_promo($column, $row_id, $data) {
        $this->table_name = "tb_promos";
        return $this->updateBy($column, $row_id, $data);
    }
    
}
