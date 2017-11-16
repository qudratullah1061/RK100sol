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
        $sql = "SELECT activities.* , admins.username as admin_name FROM tb_activities as activities LEFT JOIN tb_admin_users as admins ON (activities.created_by = admins.admin_id)";
        $sql_count = "SELECT count(activities.activity_id) as total, activities.* , admins.username as admin_name FROM tb_activities as activities LEFT JOIN tb_admin_users as admins ON (activities.created_by = admins.admin_id)";

        if ($condition != '') {
            $sql .= " WHERE " . $condition;
            $sql_count .= " WHERE " . $condition;
        }
        if (trim($order_by) != '') {
            $sql .= $order_by;
        } else {
            $sql .= " ORDER BY activities.activity_id DESC ";
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

    public function add_activity($data) {
        $this->table_name = "tb_activities";
        return $this->save($data);
    }
    
    public function add_availability($data) {
        $this->table_name = "tb_availabilities";
        return $this->save($data);
    }

    public function get_activity($activity_id) {
        $this->table_name = 'tb_activities';
        $result = $this->getBy('activity_id', $activity_id);
        if ($result) {
            return isset($result[0]) ? $result[0] : array();
        }
    }
    
    public function get_availability($availability_id) {
        $this->table_name = 'tb_availabilities';
        $result = $this->getBy('availability_id', $availability_id);
        if ($result) {
            return isset($result[0]) ? $result[0] : array();
        }
    }

    public function update_activity($column, $row_id, $data) {
        $this->table_name = "tb_activities";
        return $this->updateBy($column, $row_id, $data);
    }

    public function update_availability($column, $row_id, $data) {
        $this->table_name = "tb_availabilities";
        return $this->updateBy($column, $row_id, $data);
    }

    public function getAvailabilities($condition = '', $offset = -1, $limit = 10, $order_by = '') {
        $sql = "SELECT availabilities.* , admins.username as admin_name FROM tb_availabilities as availabilities LEFT JOIN tb_admin_users as admins ON (availabilities.created_by = admins.admin_id)";
        $sql_count = "SELECT count(availabilities.availability_id) as total, availabilities.* , admins.username as admin_name FROM tb_availabilities as availabilities LEFT JOIN tb_admin_users as admins ON (availabilities.created_by = admins.admin_id)";

        if ($condition != '') {
            $sql .= " WHERE " . $condition;
            $sql_count .= " WHERE " . $condition;
        }
        if (trim($order_by) != '') {
            $sql .= $order_by;
        } else {
            $sql .= " ORDER BY availabilities.availability_id DESC ";
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

    public function DeleteRecord($unique_id, $table, $column) {
        $this->table_name = $table;
        return $this->deleteBy($column, $unique_id);
    }
    public function DeleteRecordDropZoneJs($table, $where_clause) {
        $this->table_name = $table;
        return $this->deleteByWhere($where_clause);
    }

}
