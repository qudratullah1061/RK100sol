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

function UploadImage($file_field_name, $upload_path) {
    global $CI;
    $config['upload_path'] = $CI->config->item('root_path') . $upload_path;
    $config['allowed_types'] = 'gif|jpg|png|jpeg';
    $config['max_size'] = 10000;
//    $config['max_width'] = 1024;
//    $config['max_height'] = 768;
    $CI->load->library('upload', $config);
    if (!$CI->upload->do_upload($file_field_name)) {
        $error = array('error' => $CI->upload->display_errors());
        return $error;
    } else {
        $data = array('upload_data' => $CI->upload->data());
        $data['upload_data']['file_path'] = str_replace($CI->config->item('root_path'), base_url(), $data['upload_data']['file_path']);
        $data['upload_data']['full_path'] = str_replace($CI->config->item('root_path'), base_url(), $data['upload_data']['full_path']);
        return $data;
    }
}

function CreateThumbnail($source, $destination, $width = 0, $height = 0) {
    $this->load->library('image_lib');
    $config['image_library'] = 'gd2';
    $config['source_image'] = $source;
    $config['new_image'] = $destination;
    $config['create_thumb'] = TRUE;
    $config['maintain_ratio'] = TRUE;
    if ($width > 0 && $height > 0) {
        $config['width'] = $width;
        $config['height'] = 50;
    }
    $this->image_lib->initialize($config);
    $this->image_lib->resize();
    $this->image_lib->clear();
}
