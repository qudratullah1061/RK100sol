<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Crons extends CI_Controller {

    public function __construct() {
        parent::__construct();
    }

    public function updateSubscription() {
        $response = array();
        $html = "";
        $users = $this->db->select('member_id,status,email,first_name')->where('end_subscription_date <= "' . date('Y-m-d H:i:s') . '" AND end_subscription_date != "0000-00-00 00:00:00" AND status!="suspended"')->get('tb_members')->result_array();
        if (isset($users) && count($users) > 0) {
            foreach ($users as $user) {
                $member_email = $user['email'];
                $macros_data['$$$FIRST_NAME$$$'] = $user['first_name'];
                $email_template_info = get_email_template('member_suspended_subscription', $macros_data);
                if ($email_template_info && $member_email == "qudratullah1061@gmail.com") {
                    $html .= "$member_email <br/>";
                    sendEmail($member_email, $email_template_info['template_subject'], $email_template_info['template_body']);
                    $this->db->set('status', 'suspended')->where('member_id', $user['member_id'])->update('tb_members');
                }
            }
            sendEmail("qudratullah1061@gmail.com", "Accounts Suspended.", "Following Email Accouts Are Suspended Due To Subscription Expired! (".count($users).")<br/>".$html);
            $response = array('error' => false, 'description' => "Cron Job Run Successfully!<br/>" . $html, 'code' => 200);
        } else {
            $response = array('error' => false, 'description' => "Cron Job Run Successfully! No record to suspend.", 'code' => 200);
        }
        echo json_encode($response);
        exit;
    }

}
