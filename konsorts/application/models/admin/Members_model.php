<?php

/*
 * * Admin model
 * * Model to save/update/delete Admin Users
 */
include_once(APPPATH . 'models/Abstract_model.php');

class Members_model extends Abstract_model {

    //Model Constructor
    function __construct() {
        // inherited from base class.
        $this->table_name = "tb_members";
        parent::__construct();
    }

    function get_member_by_id($member_id) {
        $sql = "SELECT `tb_member_images`.image, `tb_member_images`.image_path, `tb_member_images`.is_profile_image, `tb_member_images`.image_type, `tb_members`.* FROM `tb_members` " .
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

}
