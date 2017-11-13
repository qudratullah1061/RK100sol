<?php

/*
 * * Admin model
 * * Model to save/update/delete Admin Users
 */
include_once(APPPATH . 'models/Abstract_model.php');

class Misc_model extends Abstract_model {

    //Model Constructor
    function __construct() {
        // inherited from base class.
        $this->table_name = "tb_companions";
        parent::__construct();
    }

    public function getActivities($condition = '', $offset = -1, $limit = 10, $order_by = '') {
        $sql = "SELECT * FROM tb_activities";
        $sql_count = "SELECT count(tb_activities.activity_id) as total FROM tb_activities ";

        if ($condition != '') {
            $sql .= " WHERE " . $condition;
            $sql_count .= " WHERE " . $condition;
        }

        if (trim($order_by) != '') {
            $sql .= $order_by;
        } else {
            $sql .= " ORDER BY tb_activities.activity_id DESC ";
        }
        if ($offset >= 0 && $limit != -1) {
            $sql .= " LIMIT " . ($offset) . ', ' . $limit;
        }
        $count = $this->db->query($sql_count)->result('array');
        $results = $this->db->query($sql)->result('array');
        $results_array = array();
        $results_array['records'] = $results;
        $results_array['query'] = $sql;
        $results_array['total'] = $count[0]['total'];
        return $results_array;
    }

    public function DeleteRecord($unique_id, $table, $column) {
        $this->table_name = $table;
        return $this->deleteBy($column, $unique_id);
    }

}
