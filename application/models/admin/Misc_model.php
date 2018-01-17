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

    public function getCategories($condition = '', $offset = -1, $limit = 10, $order_by = '') {
        $sql = "SELECT categories.* , admins.username as admin_name FROM tb_categories as categories LEFT JOIN tb_admin_users as admins ON (categories.created_by = admins.admin_id)";
        $sql_count = "SELECT count(categories.category_id) as total, categories.* , admins.username as admin_name FROM tb_categories as categories LEFT JOIN tb_admin_users as admins ON (categories.created_by = admins.admin_id)";

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

    public function add_category($data) {
        $this->table_name = "tb_categories";
        return $this->save($data);
    }
    
    public function add_contact($data) {
        $this->table_name = "tb_contact_form";
        return $this->save($data);
    }

    public function add_portfolio($data) {
        $this->table_name = "tb_member_portfolios";
        return $this->save($data);
    }

    public function get_portfolio($portfolio_id) {
        $this->table_name = 'tb_member_portfolios';
        $result = $this->getBy('portfolio_id', $portfolio_id);
        if ($result) {
            return isset($result[0]) ? $result[0] : array();
        }
    }

    public function update_portfolio($column, $row_id, $data) {
        $this->table_name = "tb_member_portfolios";
        return $this->updateBy($column, $row_id, $data);
    }

    public function add_sub_category($data) {
        $this->table_name = "tb_sub_categories";
        return $this->save($data);
    }

    public function get_category($category_id) {
        $this->table_name = 'tb_categories';
        $result = $this->getBy('category_id', $category_id);
        if ($result) {
            return isset($result[0]) ? $result[0] : array();
        }
    }

    public function get_sub_category($sub_category_id) {
        $this->table_name = 'tb_sub_categories';
        $result = $this->getBy('sub_category_id', $sub_category_id);
        if ($result) {
            return isset($result[0]) ? $result[0] : array();
        }
    }

    public function update_category($column, $row_id, $data) {
        $this->table_name = "tb_categories";
        return $this->updateBy($column, $row_id, $data);
    }

    public function update_sub_category($column, $row_id, $data) {
        $this->table_name = "tb_sub_categories";
        return $this->updateBy($column, $row_id, $data);
    }

    public function getSubCategories($condition = '', $offset = -1, $limit = 10, $order_by = '') {
        $sql = "SELECT sub_categories.* , admins.username as admin_name FROM tb_sub_categories as sub_categories LEFT JOIN tb_admin_users as admins ON (sub_categories.created_by = admins.admin_id)";
        $sql_count = "SELECT count(sub_categories.sub_category_id) as total, sub_categories.* , admins.username as admin_name FROM tb_sub_categories as sub_categories LEFT JOIN tb_admin_users as admins ON (sub_categories.created_by = admins.admin_id)";

        if ($condition != '') {
            $sql .= " WHERE " . $condition;
            $sql_count .= " WHERE " . $condition;
        }
        if (trim($order_by) != '') {
            $sql .= $order_by;
        } else {
            $sql .= " ORDER BY sub_categories.sub_category_id DESC ";
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

    function UpdateRecord($column, $row_id, $data) {
        $this->table_name = "tb_member_images";
        $this->updateBy($column, $row_id, $data);
    }

    function SelectByWhere($where_clause) {
        $this->table_name = "tb_member_images";
        return $this->getByWhere("", $where_clause);
    }
    function get_contact_forms() {
        $this->table_name = "tb_contact_form";
        return $this->getAll("","",'is_read',"ASC");
    }

    function saveRecord($table, $data) {
        $this->table_name = $table;
        return $this->save($data);
    }

    function getMemberPlanByPrice($where_clause) {
        $this->table_name = "tb_member_plans";
        return $this->getByWhere("", $where_clause);
    }

    function update_privacy($privacy_array, $member_id) {
        $this->table_name = "tb_members_privacy";
        if ($privacy_array) {
            foreach ($privacy_array as $privacy) {
                $where = array('privacy_name' => $privacy['privacy_name'], 'member_id' => $member_id);
                $privacy_data = array('privacy_status'=> $privacy['privacy_status'], 'updated_on' => date("Y-m-d H:i:s"));
                $this->updateByWhere($privacy_data, $where);
            }
        }
    }
    
     public function get_contact($contact_id) {
        $this->table_name = 'tb_contact_form';
        $result = $this->getBy('contact_form_id', $contact_id);
        return isset($result[0]) ? $result[0] : array();
    }
    
     public function update_contact($column, $row_id, $data) {
        $this->table_name = "tb_contact_form";
        return $this->updateBy($column, $row_id, $data);
    }

}
