<?php

/*
 * * Admin model
 * * Model to save/update/delete Admin Users
 */
include_once(APPPATH . 'models/Abstract_model.php');

class Notification_model extends Abstract_model {

    protected $is_error;
    public $member_exists;
    public $member_info;

    //Model Constructor
    function __construct() {
        // inherited from base class.
        $this->table_name = "tb_notifications";
        parent::__construct();
    }
    
    function get_all_notifications($is_admin = 1,$active_condition = "") {
        $join = '';
        $select = '';
        if($is_admin == 1)
        {
            $join = 'JOIN tb_admin_users on tb_admin_users.admin_id = tb_notification_users.sender_id';
            $select = ', tb_admin_users.username,tb_admin_users.image,tb_admin_users.image_path';
        }else{
            $join = 'JOIN tb_members on tb_members.member_id = tb_notification_users.sender_id';
            $select = ', tb_members.username';//need to add join with member images will add later when work on user notification
        }
        $sql = "SELECT tb_notifications.* ".$select." FROM tb_notifications " .
               "JOIN tb_notification_users on tb_notification_users.notification_id = tb_notifications.notification_id ".$join."" .
               " WHERE `tb_notifications`.is_admin_notification = 1 " . $active_condition ." Group By tb_notifications.notification_id";
        return $this->db->query($sql)->result_array();
    }

    public function get_notification($notification_id) {
        $this->table_name = 'tb_notifications';
        $result = $this->getBy('notification_id', $notification_id);
        return isset($result[0]) ? $result[0] : array();
    }

    public function add_notification($data) {
        $this->table_name = "tb_notifications";
        return $this->save($data);
    }

    public function update_notification($column, $row_id, $data) {
        $this->table_name = "tb_notifications";
        return $this->updateBy($column, $row_id, $data);
    }
    
    
    public function insert_users_notification($data) {
        $this->table_name = " tb_notification_users";
        return $this->insert_batch($data);
    }
    
    public function deleteNotificationUserBy($column,$id) {
        $this->table_name = " tb_notification_users";
        return $this->deleteBy($column,$id);
    }
    
    
    

}
