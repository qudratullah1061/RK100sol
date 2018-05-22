<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Chat extends Admin_Controller {

    public function __construct() {
        parent::__construct();
        $this->layout = 'admin/main';
        $this->load->model('admin/chat_model', 'Chat_Model');
        $this->load->model('admin/members_model', 'Members_Model');
    }

    function view_chat_list() {
//        echo "<pre>";
//        print_r($this->admin_info);
//        exit;
        $this->selected_tab = 'chat';
        $this->selected_child_tab = 'view_chat_list';
        $data['guest_members'] = $this->Chat_Model->getMembers(" WHERE tb_members.member_type = 1 ");
        $data['companion_members'] = $this->Chat_Model->getMembers(" WHERE tb_members.member_type = 2 ");
        $this->load->view('admin/chat/chat_list', $data);
    }

    function getUserInfoForChat() {
        $this->isAjax();
        $chat_id = $this->input->post('chat_id');
        $chat_ids = explode("-", $chat_id);
        $user1 = isset($chat_ids[0]) ? $chat_ids[0] : 0;
        $user2 = isset($chat_ids[1]) ? $chat_ids[1] : 0;
        $user1Info = array();
        $user2Info = array();
        if (strpos($chat_id, "a") !== false) {
            // get from admin table.   
            $user1_trunacted = str_replace("a", "", $user1);
            $this->db->select('first_name, last_name, username, image, image_path');
            $adminInfo = $this->db->get_where('tb_admin_users', array('admin_id' => $user1_trunacted))->result_array();
            if ($adminInfo) {
                $user1Info = isset($adminInfo[0]) ? $adminInfo[0] : null;
            }
        }
        // get from member table.
        $user2Info = $this->Members_Model->get_member_by_id($user2);
        if (!$user1Info) {
            $user1Info = $this->Members_Model->get_member_by_id($user1);
        }
        echo json_encode(array("error" => false, $user1 => $user1Info, $user2 => $user2Info));
        exit();
//        $user1 = $this->
    }

}
