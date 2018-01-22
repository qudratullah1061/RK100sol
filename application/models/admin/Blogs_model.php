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
    
    public function getBlogsLists($condition = '', $offset = -1, $limit = 10, $order_by = '') {
        $sql = "SELECT blogs.* , admins.username as admin_name FROM tb_blogs as blogs LEFT JOIN tb_admin_users as admins ON (blogs.created_by = admins.admin_id)";
        $sql_count = "SELECT count(blogs.blog_id) as total, blogs.* , admins.username as admin_name FROM tb_blogs as blogs LEFT JOIN tb_admin_users as admins ON (blogs.created_by = admins.admin_id)";

        if ($condition != '') {
            $sql .= " WHERE " . $condition;
            $sql_count .= " WHERE " . $condition;
        }
        if (trim($order_by) != '') {
            $sql .= $order_by;
        } else {
            $sql .= " ORDER BY blogs.blog_id DESC ";
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
    
    //Working by Sufyan
    public function get_blog($blog_id) {
        $this->table_name = 'tb_blogs';
        $result = $this->getBy('blog_id', $blog_id);
        if ($result) {
            return isset($result[0]) ? $result[0] : array();
        }
    }
    
    public function add_blog($data) {
        $this->table_name = "tb_blogs";
        return $this->save($data);
    }
    
    public function update_blog($column, $row_id, $data) {
        $this->table_name = "tb_blogs";
        return $this->updateBy($column, $row_id, $data);
    }
    
    public function add_blog_des($data) {
        $this->table_name = "tb_blog_descriptions";
        return $this->save($data);
    }
    
    public function update_blog_des($column, $row_id, $data) {
        $this->table_name = "tb_blog_descriptions";
        return $this->updateBy($column, $row_id, $data);
    }
    
    public function get_all_tags() {
        $this->table_name = "tb_tags";
        return $this->getAll("is_active", 1);
    }
    
    public function get_all_active_blogs() {
        $this->table_name = "tb_blogs";
        return $this->getAll("is_active", 1);
    }
    
    function AddUpdateBlogCategories($blog_categories, $blog_id, $added_by = 0) {
        if ($blog_id) {
            // delete previous member ids
            if ($this->session->userdata('admin_id')) {
                $added_by = $this->session->userdata('admin_id');
            }
            $this->table_name = 'tb_blog_categories';
            $this->db->where('blog_id', $blog_id);
            $this->db->delete($this->table_name);
            if ($blog_categories) {
                foreach ($blog_categories as $category) {
                    $category_array = explode("::", $category);
                    $category_id = isset($category_array[0]) ? $category_array[0] : 0;
                    $sub_category_id = isset($category_array[1]) ? $category_array[1] : 0;
                    $data = array('blog_id' => $blog_id, 'category_id' => $category_id, 'sub_category_id' => $sub_category_id, 'created_on' => date("Y-m-d H:i:s"), 'created_by' => $added_by);
                    $this->save($data);
                }
            }
        }
    }
    
    function add_tags($tags, $blog_id, $added_by = 0) {
        if ($this->session->userdata('admin_id')) {
            $added_by = $this->session->userdata('admin_id');
        }
        $this->table_name = 'tb_blog_tags';
        $this->db->where('blog_id', $blog_id);
        $this->db->delete($this->table_name);
        if($tags){
            foreach ($tags as $tag_id) {
                $data = array('blog_id' => $blog_id, 'tag_id' => $tag_id, 'created_on' => date("Y-m-d H:i:s"), 'created_by' => $added_by);
                $this->save($data);
            }
        }
    }
    
    function get_all_selected_categories() {
        $this->db->select('COUNT(DISTINCT (tbc.blog_id)) AS count_blogs, tb_categories.*, tbc.blog_id');
        $this->db->from('tb_categories');
        $this->db->join('tb_blog_categories AS tbc', '(`tb_categories`.`category_id`=`tbc`.`category_id` AND `tb_categories`.`is_active` = 1)', 'left');
        $this->db->group_by('tb_categories.category_id');
        $query = $this->db->get();
//        echo $this->db->last_query();exit();
        return $query->result_array();
    }
    
    function get_all_blogs_as_per_category($category_id) {
        $this->db->select('tb_blogs.*');
        $this->db->from('tb_blog_categories AS tbc');
        $this->db->join('tb_blogs', 'tb_blogs.blog_id=tbc.blog_id');
        $this->db->where('tbc.category_id', $category_id);
        $this->db->where('tb_blogs.is_active', 1);
        $this->db->group_by('tb_blogs.blog_id'); 
        $query = $this->db->get();
        return $query->result();
    }
    function get_all_selected_tags($blog_id) {
        $this->db->select('COUNT(tbt.tag_id) AS count_tags, tbt.*, tb_tags.*');
        $this->db->from('tb_blog_tags AS tbt');
        $this->db->join('tb_tags', 'tb_tags.tag_id=tbt.tag_id');
        $this->db->where('tbt.blog_id', $blog_id);
        $this->db->where('tb_tags.is_active', 1);
        $this->db->group_by('tbt.tag_id'); 
        $query = $this->db->get();
        return $query->result_array();
    }
    
    function get_all_blogs_as_per_tag($tag_id) {
        $this->db->select('tb_blogs.*');
        $this->db->from('tb_blog_tags AS tbt');
        $this->db->join('tb_blogs', 'tb_blogs.blog_id=tbt.blog_id');
        $this->db->where('tbt.tag_id', $tag_id);
        $this->db->where('tb_blogs.is_active', 1);
        $this->db->group_by('tb_blogs.blog_id'); 
        $query = $this->db->get();
        return $query->result();
    }
    
    function search_by_keyword($keyword) {
        $this->db->select('tb_blogs.*');
        $this->db->from('tb_blog_descriptions AS tbd');
        $this->db->join('tb_blogs', 'tb_blogs.blog_id=tbd.blog_id');
        $this->db->or_like('blog_title',$keyword);
        $this->db->or_like('tbd.blog_description',$keyword);
        $this->db->where('tb_blogs.is_active', 1);
        $this->db->group_by('tb_blogs.blog_id'); 
        $query = $this->db->get();
        return $query->result();
    }
    
}
