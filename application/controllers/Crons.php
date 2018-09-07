<?php
/**
 * Created by PhpStorm.
 * User: Huma
 * Date: 9/7/2018
 * Time: 4:58 PM
 */

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Crons extends CI_Controller
{
    public function updateSubscription()
    {
        $users = $this->db->select('member_id,status,email,first_name')->where('end_subscription_date <= "' . date('Y-m-d H:i:s') . '" AND end_subscription_date != "0000-00-00 00:00:00" AND status!="suspended"')->get('tb_members')->result_array();
        if (isset($users) && count($users) > 0) {
            foreach ($users as $user) {
                $member_email = $user['email'];
                $macros_data['$$$FIRST_NAME$$$'] = $user['first_name'];
                $email_template_info = get_email_template('member_suspended_subscription', $macros_data);
                if ($email_template_info) {
                    sendEmail($member_email, $email_template_info['template_subject'], $email_template_info['template_body']);
                    $this->db->set('status', 'suspended')->where('member_id', $user['member_id'])->update('tb_members');
                }

            }
        }
    }
}