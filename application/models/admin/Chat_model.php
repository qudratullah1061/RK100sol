<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
include_once(APPPATH . 'models/Abstract_model.php');

class Chat_model extends Abstract_model
{

    //Model Constructor
    // inherited from base class.
    public $table_name;

    function __construct()
    {
        parent::__construct();
    }

    function getMembers($where = "", $limit = '')
    {
        $sql = "SELECT `tb_member_images`.image, `tb_member_images`.image_path, `tb_member_images`.is_profile_image, `tb_member_images`.image_type, `tb_members`.* FROM `tb_members` " .
            " LEFT JOIN `tb_member_images` ON `tb_member_images`.image_id = " .
            "(SELECT image_id " .
            " FROM `tb_member_images` " .
            " WHERE `tb_member_images`.member_id = `tb_members`.member_id AND `tb_member_images`.image_type = 'profile' ORDER BY `tb_member_images`.is_profile_image DESC Limit 0,1 )" .
            " $where " .
            " ORDER BY `tb_members`.member_id DESC";
        if ($limit != '') $sql .= " Limit " . $limit;
        return $this->db->query($sql)->result('array');
    }

    function getConnections($type, $memberID)
    {
        if ($type == 1) {
            $sql = "SELECT tb_member_connections.*,tb_member_images.*, tb_members.first_name,tb_members.last_name,tb_members.location FROM  tb_members LEFT JOIN tb_member_connections ON tb_members.member_id = tb_member_connections.connection_id LEFT JOIN tb_member_images ON tb_member_images.image_id = (SELECT image_id FROM tb_member_images WHERE tb_member_images.member_id = tb_members.member_id AND tb_member_images.image_type = 'profile' ORDER BY tb_member_images.is_profile_image DESC Limit 0,1 ) WHERE tb_member_connections.user_id = $memberID AND tb_member_connections.status =1";
        } else {
            $sql = "SELECT tb_member_connections.*,tb_member_images.*, tb_members.first_name,tb_members.last_name,tb_members.location FROM  tb_members LEFT JOIN tb_member_connections ON tb_members.member_id = tb_member_connections.user_id LEFT JOIN tb_member_images ON tb_member_images.image_id = (SELECT image_id FROM tb_member_images WHERE tb_member_images.member_id = tb_members.member_id AND tb_member_images.image_type = 'profile' ORDER BY tb_member_images.is_profile_image DESC Limit 0,1 )  WHERE tb_member_connections.connection_id = $memberID AND tb_member_connections.status =1";
        }
        return $this->db->query($sql)->result_array();
    }

    function getAdminMembers()
    {
        $sql = "SELECT first_name, last_name,admin_id,image, image_path FROM tb_admin_users";
        $result = $this->db->query($sql)->result_array();
        return $result[0];
    }

}
