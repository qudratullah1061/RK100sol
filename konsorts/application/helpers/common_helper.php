<?php

$CI = &get_instance();

function ActivateCurrentLink($main_tab, $child_tab) {
    global $CI;
    if ($CI->selected_tab == $main_tab && $CI->selected_child_tab == $child_tab) {
        echo " active open ";
    }
}

function ActivateParentLink($main_tab) {
    global $CI;
    if ($CI->selected_tab == $main_tab) {
        echo " active open ";
    }
}

function GetAdminInfoWithId($UserId) {
    global $CI;
    $user_info = $CI->db->get_where('tb_admin_users', array('admin_id' => $UserId))->result_array();
    if ($user_info) {
        return isset($user_info[0]) ? $user_info[0] : null;
    }
}
