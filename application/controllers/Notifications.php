<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Notifications extends FrontEnd_Controller {

    public function __construct() {
        parent::__construct();
        $this->layout = 'frontend/main';
        $this->load->model('admin/members_model', 'Members_Model');
        $this->load->model('admin/notification_model', 'Notification_Model');
    }

    function view_notifications($notification_id = '') {
        
        $member_id = $this->session->userdata['member_id'];
        $and_where = '';
        if($notification_id != '')
        {
            $and_where = ' AND tb_notification_users.notification_user_id = '.$notification_id.'';
        }
        $update = array();
        $update['is_read'] = 1;
        
        $this->Notification_Model->update_notification_user($update,'tb_notification_users.receiver_id = '.$member_id.' '.$and_where.'');
        
        $data['notifications'] = $this->Notification_Model->get_all_notifications(1,'AND tb_notification_users.receiver_id = '.$member_id.' '.$and_where.'');
        
        $this->load->view('frontend/notifications/view_notifications',$data);
    }
    
    function modal_notification() {
        $this->isAjax();
        $notification_id = $this->input->post('notification_id');
        $data['is_view'] = $this->input->post('is_view');
        $data['notification_data'] = $this->Notification_Model->get_notification($notification_id);
        $html = $this->load->view('frontend/notifications/add_notification', $data, TRUE);
        echo json_encode(array('key' => true, 'value' => $html));
        die();
    }

    function add_update_notification() {
        $this->isAjax();
        if ($this->input->post()) {
            $data = array();
            $edit_id = $this->input->post('notification_id');
            
            $this->form_validation->set_rules('notification_title', 'Notification Title', 'required|trim|strip_tags|xss_clean');
            $this->form_validation->set_rules('notification_message', 'Notification Message', 'required|trim|strip_tags|xss_clean');
            $this->form_validation->set_rules('notification_for', 'Notification For', 'required|trim|strip_tags|xss_clean');
           

            if ($this->form_validation->run() == FALSE) {
                $this->_response(true, validation_errors());
            } else {
                $data = array();
                $data['notification_title'] = $this->input->post('notification_title');
                $data['notification_message'] = $this->input->post('notification_message');
                $data['notification_for'] = $this->input->post('notification_for');
               
                $data['updated_on'] = $data['created_on'] = date("Y-m-d h:i:s");
                $data['updated_by'] = $data['created_by'] = $this->session->userdata('admin_id');
                $data['is_admin_notification'] = 1;
                if ($edit_id > 0) {
                    // unset created on
                    unset($data['created_on']);
                    unset($data['created_by']);
                }
                $result = false;
                

                if ($edit_id > 0) {
                    $this->Notification_Model->deleteNotificationUserBy('notification_id',$edit_id);
                    $this->Notification_Model->update_notification('notification_id', $edit_id, $data);
                    $result = true;
                } else {
                    $result = $this->Notification_Model->add_notification($data);
                }
                if ($result) {
                    $where_column = $where_value  = '';
                    if($this->input->post('notification_for') != 3)
                    {
                        $where_column = 'member_type';
                        $where_value  = $this->input->post('notification_for');
                    }
                    $members = $this->Members_Model->getAll($where_column,$where_value);
                    if(!empty($members))
                    {
                        $notify_members = array();
                        foreach($members as $member)
                        {
                            $notify_members[] = [
                                'notification_id' => ($edit_id > 0 ? $edit_id : $result),
                                'sender_id'       =>  $this->session->userdata('admin_id'),
                                'receiver_id'     =>  $member->member_id,
                                'is_read'         => 0
                            ];
                        }
                        
                        $this->Notification_Model->insert_users_notification($notify_members);
                    }
                    
                    $this->_response(false, "Changes saved successfully!");
                }
            }
        } else {
            redirect(base_url('admin/notifications'));
        }
    }

}
