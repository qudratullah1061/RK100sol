<?php

/*
 * * Abstract Model
 * * All other models will be using this Abstract Model
 */

class Abstract_model extends CI_Model {

    protected $table_name = "";

    function __construct() {
        parent::__construct();
    }

    public function getBy($column, $value, $where_col = '', $where_val = '', $order_by_column = '', $order_by_value = '') {
        $where = array();
        if ($where_col != "") {
            $where = array($column => $value, $where_col => $where_val);
        } else {
            $where = array($column => $value);
        }
        if ($order_by_column != '' && $order_by_value != '') {
            $this->db->order_by($order_by_column, $order_by_value);
        }
        $query = $this->db->get_where($this->table_name, $where);
        return $query->result();
    }

    public function getByWhere($select = '', $where = '', $order_by_column = '', $order_by_value = '', $where_in_check = 0, $where_in_key = '', $where_in_value = '', $or_where = '', $limit = 0, $offset = 0) {
        if ($select != '') {
            $this->db->select($select);
        }

        if ($limit != 0) {
            $this->db->limit($limit, $offset);
        }

        if ($order_by_column != '' && $order_by_value != '') {
            $this->db->order_by($order_by_column, $order_by_value);
        }

        if ($where_in_check && $where_in_key != '' && $where_in_value != '') {
            $this->db->where_in($where_in_key, $where_in_value);
        }

        if ((count($where) > 0 && is_array($where)) || (!is_array($where) && $where != '' )) {
            $this->db->where($where);
        }

        if ((count($or_where) > 0 && is_array($or_where)) || (!is_array($or_where) && $or_where != '' )) {
            $this->db->or_where($or_where);
        }

        $query = $this->db->get($this->table_name);
        return $query->result_array();
    }

    public function getAll($where_column = '', $where_value = '', $order_by_column = '', $order_by_value = '', $limit = 0, $offset = 0) {
        if ($where_column != '' && $where_value != '') {
            $this->db->where($where_column, $where_value);
        }
        if ($order_by_column != '' && $order_by_value != '') {
            $this->db->order_by($order_by_column, $order_by_value);
        }
        if ($limit != 0) {
            $this->db->limit($limit, $offset);
        }
        $query = $this->db->get($this->table_name);
        return $query->result();
    }

    public function save($data) {
        $this->db->insert($this->table_name, $data);
        return $this->db->insert_id();
    }

    public function update($row_id, $data) {
        $this->db->where('id', $row_id);
        return $this->db->update($this->table_name, $data);
    }

    public function updateBy($column, $row_id, $data) {
        $this->db->where($column, $row_id);
        $this->db->update($this->table_name, $data);
    }

    public function updateByWhere($data, $where) {
        $this->db->where($where);
        $this->db->update($this->table_name, $data);
    }

    public function delete($id) {
        $this->db->delete($this->table_name, array('id' => $id));
    }

    public function deleteBy($column, $id) {
        return $this->db->delete($this->table_name, array($column => $id));
    }

    public function deleteByWhere($where_clause) {
        return $this->db->delete($this->table_name, $where_clause);
    }

    public function deleteByWhereIN($ids_array = array()) {
        $this->db->where_in('blog_description_id', $ids_array);
        return $this->db->delete($this->table_name);
    }

    public function or_where($data) {
        $this->db->select('*');
        $this->db->or_where_in('role', $data);
        $query = $this->db->get($this->table_name);
        return $query->result();
    }

    public function getLimitedRows($column, $value, $where_col = '', $where_val = '', $offset = 0, $limit = 0, $order_by_column = '', $order_by_value = '') {
        $where = array();
        if ($where_col != '' && $where_val != '') {
            $where = array($column => $value, $where_col => $where_val);
        } else {
            $where = array($column => $value);
        }
        if ($order_by_column != '' && $order_by_value != '') {
            $this->db->order_by($order_by_column, $order_by_value);
        }
        $query = $this->db->get_where($this->table_name, $where, $limit, $offset);
        return $query->result();
    }

    public function getByJoin($select = '', $from_table = '', $join_array = array(), $where = '', $order_by_column = '', $order_by_value = '', $where_in_check = 0, $where_in_key = '', $where_in_value = '', $or_where = '', $limit = 0, $offset = 0) {
        if ($select != '') {
            $this->db->select($select);
        }

        if ($from_table != '') {
            $this->db->from($from_table);
        } else {
            $this->db->from($this->table_name);
        }
        if (count($join_array) > 0) {
            foreach ($join_array as $key => $v) {
                $this->db->join($v['table_name'], $v['join_on'], $v['join_type']);
            }
        }

        if ($limit != 0) {
            $this->db->limit($limit, $offset);
        }

        if ($order_by_column != '' && $order_by_value != '') {
            $this->db->order_by($order_by_column, $order_by_value);
        }

        if ($where_in_check && $where_in_key != '' && $where_in_value != '') {
            $this->db->where_in($where_in_key, $where_in_value);
        }

        if ((count($where) > 0 && is_array($where)) || (!is_array($where) && $where != '' )) {
            $this->db->where($where);
        }

        if ((count($or_where) > 0 && is_array($or_where)) || (!is_array($or_where) && $or_where != '' )) {
            $this->db->or_where($or_where);
        }

        $query = $this->db->get();
        return $query->result_array();
    }

    public function get_column($select, $where = '') {
        if ((count($where) > 0 && is_array($where)) || (!is_array($where) && $where != '' )) {
            $this->db->where($where);
        }

        if ($select == 'count') {
            return $this->db->count_all_results($this->table_name);
        } else {
            if ($select != '') {
                $this->db->select($select);
            }
            return $this->db->get($this->table_name)->row_array();
        }
    }

    public function get_specificcolumn($select, $where = '') {
        if ((count($where) > 0 && is_array($where)) || (!is_array($where) && $where != '' )) {
            $this->db->where($where);
        }

        if ($select == 'count') {
            return $this->db->count_all_results($this->table_name);
        } else {
            if ($select != '') {
                $this->db->select($select);
            }
            $result = $this->db->get($this->table_name)->row_array();
            if (!empty($result))
                return $result[$select];
            else
                return '';
        }
    }

    public function count_rows($where = array()) {
        $this->db->select('*')->from($this->table_name);
        if (!empty($where)) {
            $this->db->where($where);
        }
        return $this->db->get()->num_rows();
    }

    public function insert_batch($data) {
        return $this->db->insert_batch($this->table_name, $data);
    }

    public function update_batch($data, $update_by) {
        return $this->db->update_batch($this->table_name, $data, $update_by);
    }

}
