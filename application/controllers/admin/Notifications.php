<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Notifications extends Admin_Controller {

    public function __construct() {
        parent::__construct();
        $this->layout = 'admin/main';
        $this->load->model('admin/notification_model', 'Notification_model');
        $this->load->model('admin/members_model', 'Members_Model');
    }

    function view_notifications() {
        $this->selected_tab = 'notifications';
        $this->selected_child_tab = 'view_notifications';
        $data['notifications'] = $this->Notification_model->get_all_notifications();
        
        $this->load->view('admin/notifications/view_notifications',$data);
    }
    
    function modal_notification() {
        $this->isAjax();
        $notification_id = $this->input->post('notification_id');
        $data['is_view'] = $this->input->post('is_view');
        $data['notification_data'] = $this->Notification_model->get_notification($notification_id);
        $html = $this->load->view('admin/notifications/add_notification', $data, TRUE);
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
                    $this->Notification_model->deleteNotificationUserBy('notification_id',$edit_id);
                    $this->Notification_model->update_notification('notification_id', $edit_id, $data);
                    $result = true;
                } else {
                    $result = $this->Notification_model->add_notification($data);
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
                        $notify_members[] = [
                                'notification_id' => ($edit_id > 0 ? $edit_id : $result),
                                'sender_id'       =>  $this->session->userdata('admin_id'),
                                'receiver_id'     =>  -1,
                                'is_read'         => 0
                        ];
                        foreach($members as $member)
                        {
                            $notify_members[] = [
                                'notification_id' => ($edit_id > 0 ? $edit_id : $result),
                                'sender_id'       =>  $this->session->userdata('admin_id'),
                                'receiver_id'     =>  $member->member_id,
                                'is_read'         => 0
                            ];
                        }
                        
                        $this->Notification_model->insert_users_notification($notify_members);
                    }
                    
                    $this->_response(false, "Changes saved successfully!");
                }
            }
        } else {
            redirect(base_url('admin/notifications'));
        }
    }

}
