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

function GetCountriesOption($selected_value = "") {
    global $CI;
    $options = "<option value=''>Select Country</option>";
    $data_info = $CI->db->get('tb_countries')->result_array();
    if ($data_info) {
        foreach ($data_info as $info) {
            $options.="<option value='" . $info['country_id'] . "' " . ($info['country_id'] == $selected_value ? 'selected=\"selected\"' : '') . ">" . ($info['country_name']) . "</option>";
        }
    }
    return $options;
}

function GetStatesOption($country_id = 0, $selected_value = "") {
    global $CI;
    $options = "<option value=''>Select State</option>";
    if ($country_id > 0) {
        $CI->db->where(array('country_id' => $country_id));
    }
    $data_info = $CI->db->get('tb_states')->result_array();
    if ($data_info) {
        foreach ($data_info as $info) {
            $options.="<option value='" . $info['state_id'] . "' " . ($info['state_id'] == $selected_value ? 'selected=\"selected\"' : '') . ">" . ($info['state_name']) . "</option>";
        }
    }
    return $options;
}

function GetCityOptions($state_id = 0, $selected_value = "") {
    global $CI;
    $options = "<option value=''>Select City</option>";
    if ($state_id > 0) {
        $CI->db->where(array('state_id' => $state_id));
    }
    $data_info = $CI->db->get('tb_cities')->result_array();
    if ($data_info) {
        foreach ($data_info as $info) {
            $options.="<option value='" . $info['city_id'] . "' " . ($info['city_id'] == $selected_value ? 'selected=\"selected\"' : '') . ">" . ($info['city_name']) . "</option>";
        }
    }
    return $options;
}

function UploadImage($file_field_name, $upload_path, $create_thumb = false, $thump_options = array()) {
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
        if ($create_thumb) {
            CreateThumbnail($data['upload_data']['full_path'], $config['upload_path'], $thump_options);
        }
        $data['upload_data']['file_path'] = str_replace($CI->config->item('root_path'), "", $data['upload_data']['file_path']);
        $data['upload_data']['full_path'] = str_replace($CI->config->item('root_path'), "", $data['upload_data']['full_path']);
        return $data;
    }
}

function CreateThumbnail($source, $destination, $thump_options) {
    global $CI;
    $CI->load->library('image_lib');
    $config['image_library'] = 'gd2';
    $config['source_image'] = $source;
    $config['new_image'] = $destination;
    $config['quality'] = 100;
    $config['create_thumb'] = TRUE;
    $config['maintain_ratio'] = FALSE;
    foreach ($thump_options as $options) {
        $config['width'] = $options['width'];
        $config['height'] = $options['height'];
        $config['thumb_marker'] = $options['prefix'];
        $CI->image_lib->initialize($config);
        $CI->image_lib->resize();
        $CI->image_lib->clear();
    }
}

function delete_file_from_directory($file_path) {
    global $CI;
    $complete_path = $CI->config->item('root_path') . $file_path;
    if (file_exists($complete_path)) {
        unlink($complete_path);
    }
}
