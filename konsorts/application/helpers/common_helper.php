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

function is_member_username_exist($username, $exclude_id) {
    global $CI;
    $exclude_id = $exclude_id > 0 ? $exclude_id : -1;
    $CI->db->select('member_id');
    $CI->db->where(array('username' => $username, 'member_id!=' => $exclude_id));
    $result = $CI->db->get('tb_members')->result();
    if (!empty($result))
        return true;
    return false;
}

function is_member_email_exist($email, $exclude_id) {
    global $CI;
    $exclude_id = $exclude_id > 0 ? $exclude_id : -1;
    $CI->db->select('member_id');
    $CI->db->where(array('email' => $email, 'member_id!=' => $exclude_id));
    $result = $CI->db->get('tb_members')->result();
    if (!empty($result))
        return true;
    return false;
}

function reArrayFiles(&$file_post) {
    $file_ary = array();
    $file_count = count($file_post['name']);
    $file_keys = array_keys($file_post);
    for ($i = 0; $i < $file_count; $i++) {
        foreach ($file_keys as $key) {
            $file_ary[$i][$key] = $file_post[$key][$i];
        }
    }
    return $file_ary;
}

function GetAllCategories() {
    global $CI;
    return $CI->db->get_where('tb_categories', array('is_active' => 1))->result_array();
}

function getSubCategoriesByCategoryId($categoryId) {
    global $CI;
    return $CI->db->get_where('tb_sub_categories', array('is_active' => 1, 'category_id' => $categoryId))->result_array();
}

function getCategoryNameById($categoryId = 0) {
    global $CI;
    $data_info = $CI->db->get_where('tb_categories', array('category_id' => $categoryId))->result_array();
    if ($data_info) {
        return $data_info[0]['category_name'];
    }
    return "";
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
    if ($country_id) {
        if ($country_id > 0) {
            $CI->db->where(array('country_id' => $country_id));
        }
        $data_info = $CI->db->get('tb_states')->result_array();
        if ($data_info) {
            foreach ($data_info as $info) {
                $options.="<option value='" . $info['state_id'] . "' " . ($info['state_id'] == $selected_value ? 'selected=\"selected\"' : '') . ">" . ($info['state_name']) . "</option>";
            }
        }
    }
    return $options;
}

function GetCityOptions($state_id = 0, $selected_value = "") {
    global $CI;
    $options = "<option value=''>Select City</option>";
    if ($state_id) {
        if ($state_id > 0) {
            $CI->db->where(array('state_id' => $state_id));
        }
        $data_info = $CI->db->get('tb_cities')->result_array();
        if ($data_info) {
            foreach ($data_info as $info) {
                $options.="<option value='" . $info['city_id'] . "' " . ($info['city_id'] == $selected_value ? 'selected=\"selected\"' : '') . ">" . ($info['city_name']) . "</option>";
            }
        }
    }
    return $options;
}

// receives multidimensional array
function delete_image_from_directory($images_info_array) {
    global $CI;
    if ($images_info_array) {
        foreach ($images_info_array as $image) {
            $file_path = $CI->config->item('root_path') . $image['image_path'] . $image['image'];
            $file_path_small = $CI->config->item('root_path') . $image['image_path'] . 'small_' . $image['image'];
            $file_path_medium = $CI->config->item('root_path') . $image['image_path'] . 'medium_' . $image['image'];
            $file_path_large = $CI->config->item('root_path') . $image['image_path'] . 'large_' . $image['image'];
            $file_path_Xlarge = $CI->config->item('root_path') . $image['image_path'] . 'Xlarge_' . $image['image'];
            if (file_exists($file_path)) {
                unlink($file_path);
            }
            if (file_exists($file_path_small)) {
                unlink($file_path_small);
            }
            if (file_exists($file_path_medium)) {
                unlink($file_path_medium);
            }
            if (file_exists($file_path_large)) {
                unlink($file_path_large);
            }
            if (file_exists($file_path_Xlarge)) {
                unlink($file_path_Xlarge);
            }
        }
    }
}

function UploadImage($file_field_name, $upload_path, $create_thumb = false, $thump_options = array(), $watermark = FALSE) {
    global $CI;
    $config['upload_path'] = $CI->config->item('root_path') . $upload_path;
    $config['allowed_types'] = 'gif|jpg|png|jpeg';
    $config['max_size'] = 10000;
    $config['file_name'] = time() . $_FILES[$file_field_name]['name'];
//    $config['max_width'] = 1024;
//    $config['max_height'] = 768;
    $CI->load->library('upload', $config);
    if (!$CI->upload->do_upload($file_field_name)) {
        $error = array('error' => $CI->upload->display_errors());
        return $error;
    } else {
        $data = array('upload_data' => $CI->upload->data());
        if ($create_thumb) {
            CreateThumbnail($data['upload_data']['full_path'], $config['upload_path'], $thump_options, $watermark);
        }
        $data['upload_data']['file_path'] = str_replace($CI->config->item('root_path'), "", $data['upload_data']['file_path']);
        $data['upload_data']['full_path'] = str_replace($CI->config->item('root_path'), "", $data['upload_data']['full_path']);
        return $data;
    }
}

function watermarkImage($source) {
    global $CI;
    $CI->load->library('image_lib');
    $config['image_library'] = 'gd2';
    $config['source_image'] = $source;
    $config['quality'] = 100;
    $config['wm_overlay_path'] = $CI->config->item('root_path') . 'assets/watermark_img/Transparent-K.png';
    $config['wm_type'] = 'overlay';
    $config['wm_opacity'] = 100;
    $config['wm_vrt_alignment'] = 'middle';
    $config['wm_hor_alignment'] = 'center';
    $CI->image_lib->initialize($config);
    $CI->image_lib->watermark();
    $CI->image_lib->clear();
}

function CreateThumbnail($source, $destination, $thump_options, $water_mark = false) {
    global $CI;
    if ($water_mark) {
        // water mark existing image first.
        watermarkImage($source);
    }
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
