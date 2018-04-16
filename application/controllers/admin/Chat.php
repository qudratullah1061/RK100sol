<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Chat extends Admin_Controller {

    public function __construct() {
        parent::__construct();
        $this->layout = 'admin/main';
        $this->load->model('admin/chat_model', 'Chat_Model');
    }

    function view_chat_list() {
        $this->selected_tab = 'chat';
        $this->selected_child_tab = 'view_chat_list';
        $data['guest_members'] = $this->Chat_Model->getMembers(" WHERE tb_members.member_type = 1 ");
        $data['companion_members'] = $this->Chat_Model->getMembers(" WHERE tb_members.member_type = 2 ");
        $this->load->view('admin/chat/chat_list', $data);
    }

}
