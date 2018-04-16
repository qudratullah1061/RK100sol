<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
include_once(APPPATH . 'models/Abstract_model.php');

class Chat_model extends Abstract_model {

    //Model Constructor
    // inherited from base class.
    public $table_name;

    function __construct() {
        parent::__construct();
    }

    function getMembers($where = "") {
        $sql = "SELECT `tb_member_images`.image, `tb_member_images`.image_path, `tb_member_images`.is_profile_image, `tb_member_images`.image_type, `tb_members`.* FROM `tb_members` " .
                " LEFT JOIN `tb_member_images` ON `tb_member_images`.image_id = " .
                "(SELECT image_id " .
                " FROM `tb_member_images` " .
                " WHERE `tb_member_images`.member_id = `tb_members`.member_id AND `tb_member_images`.image_type = 'profile' ORDER BY `tb_member_images`.is_profile_image DESC Limit 0,1 )" .
                " $where " .
                " ORDER BY `tb_members`.member_id DESC";
        return $this->db->query($sql)->result('array');
    }

}
