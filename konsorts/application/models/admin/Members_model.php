<?php

/*
 * * Admin model
 * * Model to save/update/delete Admin Users
 */
include_once(APPPATH . 'models/Abstract_model.php');

class Members_model extends Abstract_model {
    protected $is_error;
    public $member_exists;
    public $member_info;
    //Model Constructor
    function __construct() {
        // inherited from base class.
        $this->table_name = "tb_members";
        parent::__construct();
    }

    function get_member_by_id($member_id) {
        $sql = "SELECT `tb_countries`.country_name,`tb_states`.state_name,`tb_cities`.city_name,`tb_member_images`.image, `tb_member_images`.image_path, `tb_member_images`.is_profile_image, `tb_member_images`.image_type, `tb_members`.* FROM `tb_members` " .
                " LEFT JOIN `tb_countries` ON `tb_countries`.country_id = tb_members.country" .
                " LEFT JOIN `tb_states` ON `tb_states`.state_id = tb_members.state" .
                " LEFT JOIN `tb_cities` ON `tb_cities`.city_id = tb_members.city" .
                " LEFT JOIN `tb_member_images` ON `tb_member_images`.image_id = " .
                "   (SELECT image_id " .
                "      FROM `tb_member_images` " .
                "   WHERE `tb_member_images`.member_id = `tb_members`.member_id AND `tb_member_images`.image_type = 'profile' ORDER BY `tb_member_images`.is_profile_image DESC Limit 0,1 )" .
                " WHERE `tb_members`.member_id = " . $member_id;
        $member_info = $this->db->query($sql)->result_array();
        if ($member_info) {
            return isset($member_info[0]) ? $member_info[0] : array();
        }
    }
    
     function get_member_portfolio($member_id) {
        $sql = "SELECT `tb_countries`.country_name,`tb_states`.state_name,`tb_cities`.city_name,tb_member_portfolios.* FROM `tb_members` " .
                " LEFT JOIN `tb_countries` ON `tb_countries`.country_id = tb_members.country" .
                " LEFT JOIN `tb_states` ON `tb_states`.state_id = tb_members.state" .
                " LEFT JOIN `tb_cities` ON `tb_cities`.city_id = tb_members.city" .
                " LEFT JOIN `tb_member_portfolios` ON `tb_member_portfolios`.member_id = tb_members.member_id" .
              
                " WHERE `tb_members`.member_id = " . $member_id;
        return  $this->db->query($sql)->result_array();
       
    }
    
     public function IsMember($username = "", $password = "") {
        $this->is_error = FALSE;
        $this->member_exists = FALSE;
        if (trim($username) && trim($password)) {
            $password = sha1($password);
            $member = $this->db->query("SELECT * FROM $this->table_name WHERE ((email='{$username}' OR username='{$username}') AND password='{$password}') LIMIT 1");
            if ($member->num_rows() > 0) {
                $this->member_exists = TRUE;
                $this->member_info = $member->result_array();
            }
        }
    }

    public function member_login($username, $password) {
        $this->IsMember($username, $password);
        if (!$this->member_exists) {
            $this->is_error = 1;
        } else {
            $this->is_error = 0;
        }
        return array('error' => $this->is_error, 'member_info' => $this->member_info[0]);
    }

    function get_member_images_by_type($where) {
        if ($where) {
            return $this->db->get_where('tb_member_images', $where)->result_array();
        }
        return null;
    }

    public function getMembers($condition = '', $offset = -1, $limit = 10, $order_by = '') {
        $sql = "SELECT `tb_member_images`.image, `tb_member_images`.image_path, `tb_member_images`.is_profile_image, `tb_member_images`.image_type, `tb_members`.* FROM `tb_members` " .
                " LEFT JOIN `tb_member_images` ON `tb_member_images`.image_id = " .
                "(SELECT image_id " .
                " FROM `tb_member_images` " .
                " WHERE `tb_member_images`.member_id = `tb_members`.member_id AND `tb_member_images`.image_type = 'profile' ORDER BY `tb_member_images`.is_profile_image DESC Limit 0,1 )";
        $sql_count = "SELECT count(`tb_members`.member_id) as total FROM `tb_members` ";

        if ($condition != '') {
            $sql .= " WHERE " . $condition;
            $sql_count .= " WHERE " . $condition;
        }

        if (trim($order_by) != '') {
            $sql .= $order_by;
        } else {
            $sql .= " ORDER BY `tb_members`.member_id DESC ";
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

    public function add_member($data) {
        return $this->save($data);
    }

    public function update_member($edit_id, $data) {
        $this->updateBy('member_id', $edit_id, $data);
    }

    public function getTempImages($unique_id, $image_type) {
        return $this->db->get_where('tb_temp_images_upload', array('unique_id' => $unique_id, 'image_type' => $image_type))->result_array();
    }

    public function getPlans($plan_type) {
        return $this->db->get_where('tb_member_plans', array('plan_type' => $plan_type, 'is_active' => 1))->result_array();
    }

    public function get_all_selected_categories($member_id) {
        return $this->db->get_where('tb_member_categories', array('member_id' => $member_id))->result_array();
    }
    
    
    public function get_selected_categories($member_id) {
        $this->db->select('tb_categories.category_name,tb_categories.category_id');
        $this->db->from('tb_categories');
        $this->db->join('tb_member_categories','tb_member_categories.category_id = tb_categories.category_id');
        $this->db->where('tb_member_categories.member_id',$member_id);
        $this->db->group_by('tb_categories.category_id');
        return $this->db->get()->result_array();
        
    }
    
    
    public function get_selected_sub_categories($member_id) {
        $this->db->select('tb_sub_categories.sub_category_name,tb_sub_categories.sub_category_id');
        $this->db->from('tb_sub_categories');
        $this->db->join('tb_member_categories','tb_member_categories.sub_category_id = tb_sub_categories.sub_category_id');
        $this->db->where('tb_member_categories.member_id',$member_id);
        return $this->db->get()->result_array();
        
    }

    function AddUpdateMemberCategories($member_categories, $member_id,$added_by = 0) {
        if ($member_id) {
            // delete previous member ids
            if($this->session->userdata('admin_id'))
            {
                $added_by = $this->session->userdata('admin_id');
            }
            $this->table_name = 'tb_member_categories';
            $this->db->where('member_id', $member_id);
            $this->db->delete($this->table_name);
            if ($member_categories) {
                foreach ($member_categories as $category) {
                    $category_array = explode("::", $category);
                    $category_id = isset($category_array[0]) ? $category_array[0] : 0;
                    $sub_category_id = isset($category_array[1]) ? $category_array[1] : 0;
                    $data = array('member_id' => $member_id, 'category_id' => $category_id, 'sub_category_id' => $sub_category_id, 'created_on' => date("Y-m-d H:i:s"), 'created_by' => $added_by);
                    $this->save($data);
                }
            }
        }
    }

}
