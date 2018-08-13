<?php

$CI = &get_instance();

//admin navigation
function ActivateCurrentLink($main_tab, $child_tab)
{
    global $CI;
    if ($CI->selected_tab == $main_tab && $CI->selected_child_tab == $child_tab) {
        echo " active open ";
    }
}

function ActivateParentLink($main_tab)
{
    global $CI;
    if ($CI->selected_tab == $main_tab) {
        echo " active open ";
    }
}

//admin navigation ends
//frontend navigation
function ActivateLink($main_tab)
{
    global $CI;
    if ($CI->selected_tab == $main_tab) {
        echo " active open ";
    }
}

//frontend navigation
// frontend permission check
function CheckPermission($permission_data, $privacy_name)
{
    if ($permission_data) {
        foreach ($permission_data as $data) {
            if ($data['privacy_name'] == $privacy_name) {
                return $data['privacy_status'];
            }
        }
    }
}

// frontend permission check ended here.

function isAjax()
{
    header('Content-Type: application/json');
}

function GetAdminInfoWithId($UserId)
{
    global $CI;
    $user_info = $CI->db->get_where('tb_admin_users', array('admin_id' => $UserId))->result_array();
    if ($user_info) {
        return isset($user_info[0]) ? $user_info[0] : null;
    }
}

function GetAdminRolesPermissionWithId($UserId)
{
    global $CI;
    $sql = "SELECT roles.*, userInRoles.* FROM `tb_admin_user_roles` roles LEFT JOIN tb_admin_user_in_roles userInRoles ON (admin_user_role_id = role_id AND userInRoles.admin_user_id = $UserId)";
    return $CI->db->query($sql)->result_array();
}

function isAdminHasAccess($class, $method = "")
{
    $CI = &get_instance();
    $admin_id = $CI->session->userdata('admin_id');
    $roles_info = $CI->db->get_where('tb_admin_user_in_roles', array('admin_user_id' => $admin_id))->result_array();
    if ($roles_info && in_array('1', array_column($roles_info, 'role_id'))) {
        return true;
    } elseif ($roles_info && in_array('2', array_column($roles_info, 'role_id')) && (strtolower($class) == "blogs" || (strtolower($class) == 'misc' && strtolower($method) == 'deleterecord'))) {
        return true;
    }
    return false;
}

function RedirectAdminToAppropriatePage()
{
    $CI = &get_instance();
    $admin_id = $CI->session->userdata('admin_id');
    $roles_info = $CI->db->get_where('tb_admin_user_in_roles', array('admin_user_id' => $admin_id))->result_array();
    if ($roles_info && in_array('2', array_column($roles_info, 'role_id'))) {
        redirect(base_url('admin/blogs/view_blogs'));
    }
    redirect(base_url('admin/admin_dashboard'));
}

function validatePromoCode($promo_code, $userType)
{
    // check promo code exist.
    global $CI;
    $promo_code_info = $CI->db->get_where('tb_promos', array('promo_code' => $promo_code))->result_array();
    if (count($promo_code_info) > 0) {
        // check is active and promo code is valid for end date
        $start_date = $promo_code_info[0]['start_date'];
        $promo_valid_for = $promo_code_info[0]['promo_valid_for'];
        $end_date = $promo_code_info[0]['end_date'];
        $current_date = date("Y-m-d");
        $is_active = $promo_code_info[0]['is_active'];
        $promo_subscription_discount = $promo_code_info[0]['promo_subscription_discount'];
        $promo_subscription_discount_value = $promo_code_info[0]['promo_sub_dis_value'];
        if ($promo_subscription_discount == 0 && $end_date >= $current_date && $start_date <= $current_date && $is_active && $promo_valid_for == $userType) {
            return array("promo_type" => "sub", "value" => $promo_subscription_discount_value);
        } elseif ($promo_subscription_discount == 1 && $end_date >= $current_date && $start_date <= $current_date && $is_active && $promo_valid_for == $userType) {
            return array("promo_type" => "discount", "value" => $promo_subscription_discount_value);
        }
    }
    return false;
}

function IsPromoCodeAlreadyUsed($promo_code, $member_id)
{
    // check promo code exist.
    global $CI;
    $promo_code_info = $CI->db->get_where('tb_promos_used_by_members', array('promo_code' => $promo_code, "member_id" => $member_id))->result_array();
    if (count($promo_code_info) > 0) {
        return true;
    }
    return false;
}

function IsPromoCodeApplied($member_id)
{
    // check promo code exist.
    global $CI;
    $promo_code_info = $CI->db->get_where('tb_promos_used_by_members', array('created_on' => date('Y-m-d'), "member_id" => $member_id))->result_array();
    if (count($promo_code_info) > 0) {
        return $promo_code_info;
    }
//    return false;
}

function GetSubscriptionPlanName($plan_id)
{
    // check promo code exist.
    global $CI;
    $plan_info = $CI->db->get_where('tb_member_plans', array("plan_id" => $plan_id))->row_array();
    return ($plan_info['plan_name']) ? $plan_info['plan_name'] : 'Free Trail';
}

function getGeoCodes($address = "")
{
    // Google HQ
    if ($address != "") {
        $prepAddr = str_replace(' ', '+', $address);
        $geocode = file_get_contents('https://maps.google.com/maps/api/geocode/json?address=' . $prepAddr . '&sensor=false&key=AIzaSyB0Br2gkjBR3__xlPRrqP1TQhB8G2njLl8');
        $output = json_decode($geocode);

        $result_array = array();
        $result_array['latitude'] = "";
        $result_array['longitude'] = "";
        $result_array['country_long'] = "";
        $result_array['country_short'] = "";
        $result_array['state_long'] = "";
        $result_array['state_short'] = "";
        $result_array['district_long'] = "";
        $result_array['district_short'] = "";
        $result_array['city_long'] = "";
        $result_array['city_short'] = "";
        $result_array['street_long'] = "";
        $result_array['street_short'] = "";
        if ($output->status == "OK") {

            if (isset($output->results[0]->address_components) && count($output->results[0]->address_components) > 0) {
                foreach ($output->results[0]->address_components as $comp) {
                    if ($comp->types[0] == 'country') {
                        $result_array['country_long'] = isset($comp->long_name) ? $comp->long_name : "";
                        $result_array['country_short'] = isset($comp->short_name) ? $comp->short_name : "";
                    } else if ($comp->types[0] == 'administrative_area_level_1') {
                        $result_array['state_long'] = isset($comp->long_name) ? $comp->long_name : "";
                        $result_array['state_short'] = isset($comp->short_name) ? $comp->short_name : "";
                    } else if ($comp->types[0] == 'administrative_area_level_2') {
                        $result_array['district_long'] = isset($comp->long_name) ? $comp->long_name : "";
                        $result_array['district_short'] = isset($comp->short_name) ? $comp->short_name : "";
                    } else if ($comp->types[0] == 'locality') {
                        $result_array['city_long'] = isset($comp->long_name) ? $comp->long_name : "";
                        $result_array['city_short'] = isset($comp->short_name) ? $comp->short_name : "";
                    } else if ($comp->types[0] == 'political') {
                        $result_array['street_long'] = isset($comp->long_name) ? $comp->long_name : "";
                        $result_array['street_short'] = isset($comp->short_name) ? $comp->short_name : "";
                    }
                }
            }

            $result_array['latitude'] = isset($output->results[0]->geometry->location->lat) ? $output->results[0]->geometry->location->lat : "";
            $result_array['longitude'] = isset($output->results[0]->geometry->location->lng) ? $output->results[0]->geometry->location->lng : "";
        }
        return $result_array;
    }
}

function is_member_username_exist($username, $exclude_id)
{
    global $CI;
    $exclude_id = $exclude_id > 0 ? $exclude_id : -1;
    $CI->db->select('member_id');
    $CI->db->where(array('username' => $username, 'member_id!=' => $exclude_id));
    $result = $CI->db->get('tb_members')->result();
    if (!empty($result))
        return true;
    return false;
}

function replace_macros($template_message = "", $macros_data = array())
{
    $template_message = str_replace('$$$BASE_URL$$$', base_url(), $template_message);
    $template_message = str_replace('$$$FIRST_NAME$$$', (isset($macros_data['$$$FIRST_NAME$$$']) ? $macros_data['$$$FIRST_NAME$$$'] : ""), $template_message);
    $template_message = str_replace('$$$TITLE$$$', (isset($macros_data['$$$TITLE$$$']) ? $macros_data['$$$TITLE$$$'] : ""), $template_message);
    $template_message = str_replace('$$$MESSAGE$$$', (isset($macros_data['$$$MESSAGE$$$']) ? $macros_data['$$$MESSAGE$$$'] : ""), $template_message);
    $template_message = str_replace('$$$LAST_NAME$$$', (isset($macros_data['$$$LAST_NAME$$$']) ? $macros_data['$$$LAST_NAME$$$'] : ""), $template_message);
    $template_message = str_replace('$$$EMAIL$$$', (isset($macros_data['$$$EMAIL$$$']) ? $macros_data['$$$EMAIL$$$'] : ""), $template_message);
    $template_message = str_replace('$$$PHONE$$', (isset($macros_data['$$$PHONE$$$']) ? $macros_data['$$$PHONE$$$'] : ""), $template_message);
    $template_message = str_replace('$$$CONFIRM_REGISTRATION$$$', (isset($macros_data['$$$CONFIRM_REGISTRATION$$$']) ? $macros_data['$$$CONFIRM_REGISTRATION$$$'] : ""), $template_message);
    $template_message = str_replace('$$$CONFIRMATION_LINK$$$', (isset($macros_data['$$$CONFIRMATION_LINK$$$']) ? $macros_data['$$$CONFIRMATION_LINK$$$'] : ""), $template_message);
    return $template_message;
}

function get_email_template($template_name, $macros_data)
{
    if ($template_name) {
        global $CI;
        $template_info = $CI->db->get_where('tb_email_templates', array('template_name' => $template_name))->result_array();
        if ($template_info) {
            $template_subject = isset($template_info[0]['template_subject']) ? $template_info[0]['template_subject'] : "";
            $template_message = isset($template_info[0]['template_body']) ? $template_info[0]['template_body'] : "";
            $template_info[0]['template_body'] = replace_macros($template_message, $macros_data);
            $template_info[0]['template_subject'] = replace_macros($template_subject, $macros_data);
            return $template_info[0];
        }
        return array();
    }
}

function is_member_email_exist($email, $exclude_id)
{
    global $CI;
    $exclude_id = $exclude_id > 0 ? $exclude_id : -1;
    $CI->db->select('member_id');
    $CI->db->where(array('email' => $email, 'member_id!=' => $exclude_id));
    $result = $CI->db->get('tb_members')->result();
    if (!empty($result))
        return true;
    return false;
}

function reArrayFiles(&$file_post)
{
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

function GetAllCategories()
{
    global $CI;
    return $CI->db->get_where('tb_categories', array('is_active' => 1))->result_array();
}

function getSubCategoriesByCategoryId($categoryId)
{
    global $CI;
    return $CI->db->get_where('tb_sub_categories', array('is_active' => 1, 'category_id' => $categoryId))->result_array();
}

function getCategoryNameById($categoryId = 0)
{
    global $CI;
    $data_info = $CI->db->get_where('tb_categories', array('category_id' => $categoryId))->result_array();
    if ($data_info) {
        return $data_info[0]['category_name'];
    }
    return "";
}

function GetCountriesOption($selected_value = "")
{
    global $CI;
    $options = "<option></option>";
    $data_info = $CI->db->get('tb_countries')->result_array();
    if ($data_info) {
        foreach ($data_info as $info) {
            $options .= "<option value='" . $info['country_id'] . "' " . ($info['country_id'] == $selected_value ? 'selected=\"selected\"' : '') . ">" . ($info['country_name']) . "</option>";
        }
    }
    return $options;
}

function GetPromoCodesByUserType($userType)
{
    global $CI;
    return $CI->db->select('COUNT(promo_id) as total')->where('promo_valid_for', $userType)->where('is_active', 1)->where('end_date >= "' . date('Y-m-d') . '"')->get('tb_promos')->row()->total;
}

function GetStatesOption($country_id = 0, $selected_value = "")
{
    global $CI;
    $options = "<option value=''></option>";
    if ($country_id) {
        if ($country_id > 0) {
            $CI->db->where(array('country_id' => $country_id));
        }
        $data_info = $CI->db->get('tb_states')->result_array();
        if ($data_info) {
            foreach ($data_info as $info) {
                $options .= "<option value='" . $info['state_id'] . "' " . ($info['state_id'] == $selected_value ? 'selected=\"selected\"' : '') . ">" . ($info['state_name']) . "</option>";
            }
        }
    }
    return $options;
}

function GetCityOptions($state_id = 0, $selected_value = "")
{
    global $CI;
    $options = "<option></option>";
    if ($state_id) {
        if ($state_id > 0) {
            $CI->db->where(array('state_id' => $state_id));
        }
        $data_info = $CI->db->get('tb_cities')->result_array();
        if ($data_info) {
            foreach ($data_info as $info) {
                $options .= "<option value='" . $info['city_id'] . "' " . ($info['city_id'] == $selected_value ? 'selected=\"selected\"' : '') . ">" . ($info['city_name']) . "</option>";
            }
        }
    }
    return $options;
}

// receives multidimensional array
function delete_image_from_directory($images_info_array)
{
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

function upload_base_64_image($image_info, $file_path)
{
    global $CI;
    if ($image_info) {
        $image = isset($image_info->output->image) ? $image_info->output->image : "";
        $image_data_info = explode(";", $image);
        $img_extension_arr = explode("/", $image_data_info[0]);
        $extension = isset($img_extension_arr[1]) ? $img_extension_arr[1] : "png";

        $encoded_img = str_replace($image_data_info[0] . ";", '', $image);
        $encoded_img = str_replace('base64,', '', $encoded_img);
        $encoded_img = str_replace(' ', '+', $encoded_img);
        $data = base64_decode($encoded_img);

        $file_name = uniqid() . "." . $extension;
        $file = $file_path . $file_name;
        $success = file_put_contents($file, $data);
        return $success ? array('image_path' => $file_path, 'image_name' => $file_name, 'image_full_path' => $file_path . $file_name) : 'Unable to save the file.';
    }
}

function UploadImage($file_field_name, $upload_path, $create_thumb = false, $thump_options = array(), $watermark = FALSE, $unique_idetifier = "")
{
    global $CI;
    $config['upload_path'] = $CI->config->item('root_path') . $upload_path;
    $config['allowed_types'] = 'gif|jpg|png|jpeg';
    $config['max_size'] = 1000;
    $config['file_name'] = ($unique_idetifier != "" ? $unique_idetifier : time()) . $_FILES[$file_field_name]['name'];
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

function watermarkImage($source, $water_mark_image_name = "Transparent-K-250.png")
{
    global $CI;
    $CI->load->library('image_lib');
    $config['image_library'] = 'gd2';
    $config['source_image'] = $source;
    $config['quality'] = 100;
    $config['wm_overlay_path'] = $CI->config->item('root_path') . 'assets/watermark_img/' . $water_mark_image_name;
    $config['wm_type'] = 'overlay';
    $config['wm_opacity'] = 50;
    $config['wm_vrt_alignment'] = 'bottom';
    $config['wm_hor_alignment'] = 'left';
    $CI->image_lib->initialize($config);
    $CI->image_lib->watermark();
    $CI->image_lib->clear();
}

function CreateThumbnail($source, $destination, $thump_options, $water_mark = false)
{
    global $CI;
    $CI->load->library('image_lib');
    $config['image_library'] = 'gd2';
    $config['source_image'] = $source;
    $config['new_image'] = $destination;
    $config['quality'] = 100;
    $config['create_thumb'] = TRUE;
    $config['maintain_ratio'] = TRUE;
//    $config['master_dim'] = 'width';

    foreach ($thump_options as $options) {
        $config['width'] = $options['width'];
        $config['height'] = $options['height'];
        $config['thumb_marker'] = $options['prefix'];
        $CI->image_lib->initialize($config);
        $CI->image_lib->resize();
        $CI->image_lib->clear();
        if ($source != "") {
            // create watermark on thumnails.
            $source_array = explode("/", $source);
            $file_name = $source_array[count($source_array) - 1];
            $water_mark_image_name = "";
            if ($options['width'] >= 700) {
                $water_mark_image_name = "Transparent-K-350.png";
            } elseif ($options['width'] >= 500) {
                $water_mark_image_name = "Transparent-K-300.png";
            } elseif ($options['width'] >= 300) {
                $water_mark_image_name = "Transparent-K-150.png";
            } elseif ($options['width'] >= 150) {
                $water_mark_image_name = "Transparent-K-100.png";
            }
            if ($water_mark_image_name != "" && $water_mark) {
                watermarkImage($destination . $options['prefix'] . $file_name, $water_mark_image_name);
            }
        }
    }
//    if ($water_mark) {
//        // water mark original uploaded image.
//        watermarkImage($source,$water_mark_image_name);
//    }
}

function upload_temp_image($files, $unique_id, $image_type)
{
    global $CI;
    try {
        if ($files) {
            $uploaddir = $CI->config->item('root_path') . 'uploads/temp_images/';
            foreach ($files as $file) {
                $file_name = $unique_id . basename($file['name']);
                $uploadfile = $uploaddir . $file_name;
                move_uploaded_file($file['tmp_name'], $uploadfile);
// inset record in db
                $data = array('image' => $file_name, 'image_path' => str_replace($CI->config->item('root_path'), "", $uploaddir), 'unique_id' => $unique_id, 'image_type' => $image_type, 'created_on' => date("Y-m-d h:i:s"));
                $CI->db->insert('tb_temp_images_upload', $data);
            }
        }
        return 'success';
    } catch (Exception $ex) {
        return $ex->getMessage();
    }
}

function get_notifications($is_admin = 1, $member_id, $is_read = '')
{
    global $CI;
    $where = '';

    if ($is_read == 0 || $is_read == 1) {

        $where = ' AND tb_notification_users.is_read = ' . $is_read . '';
    }
    $CI->load->model('admin/notification_model', 'Notification_Model');
    $notifications = $CI->Notification_Model->get_all_notifications($is_admin, 'AND tb_notification_users.receiver_id = ' . $member_id . ' ' . $where . '');
    return $notifications;
}

function get_sub_comments($blog_id, $parent_id)
{
    global $CI;
    $CI->load->model('admin/blogs_model', 'Blogs_Model');
    $sub_comments = $CI->Blogs_Model->get_selected_comments($blog_id, $parent_id);
    return $sub_comments;
}

function delete_file_from_directory($file_path)
{
    global $CI;
    $complete_path = $CI->config->item('root_path') . $file_path;
    if (file_exists($complete_path)) {
        unlink($complete_path);
    }
}

function time_elapsed_string($datetime, $full = false)
{
    $now = new DateTime;
    $ago = new DateTime($datetime);
    $diff = $now->diff($ago);

    $diff->w = floor($diff->d / 7);
    $diff->d -= $diff->w * 7;

    $string = array(
        'y' => 'year',
        'm' => 'month',
        'w' => 'week',
        'd' => 'day',
        'h' => 'hr',
        'i' => 'min',
        's' => 'sec',
    );
    foreach ($string as $k => &$v) {
        if ($diff->$k) {
            $v = $diff->$k . ' ' . $v . ($diff->$k > 1 ? 's' : '');
        } else {
            unset($string[$k]);
        }
    }

    if (!$full)
        $string = array_slice($string, 0, 1);
    return $string ? implode(', ', $string) . ' ago' : 'just now';
}

function sendEmail($to, $subject, $message, $reply_to = "")
{
//    if ($reply_to != "") {
//        $header = "From:admin@konsorts.com \r\n Reply-to: $reply_to";
//    } else {
    $header = "From:admin@konsorts.com \r\n";
//    }
    $header .= "MIME-Version: 1.0\r\n";
    $header .= "Content-type: text/html\r\n";
    $retval = mail($to, $subject, $message, $header);
    if ($retval == true) {
        return true;
    } else {
        echo "Message could not be sent...";
        exit;
    }
}

function GetBlogDescription($blog_id)
{
    global $CI;
    $blog_data = $CI->db->get_where('tb_blog_descriptions', array('blog_id' => $blog_id))->result_array();
    if (!empty($blog_data)) {
        return $blog_data[0]['blog_description'];
    }
    return FALSE;
}

function limit_text($text, $limit)
{
    if (str_word_count($text, 0) > $limit) {
        $words = str_word_count($text, 2);
        $pos = array_keys($words);
        $text = substr($text, 0, $pos[$limit]) . '...';
    }
    return $text;
}

function GetBlogContent($cat_id)
{
    global $CI;
    $CI->load->model('admin/blogs_model', 'Blogs_Model');
    $blogs = $CI->Blogs_Model->get_all_blogs_as_per_category($cat_id);
    return $blogs;
}

function CountPromoCode($promo_code)
{
    global $CI;
    $CI->load->model('admin/Promos_model', 'Promos_model');
    $promos = $CI->Promos_model->get_all_used_promo_code($promo_code);
    return $promos->promo_code;
}

function getSubCategoryNameById($sub_category_id = 0)
{
    global $CI;
    $data_info = $CI->db->get_where('tb_sub_categories', array('sub_category_id' => $sub_category_id))->result_array();
    if ($data_info) {
        return $data_info[0]['sub_category_name'];
    }
    return "";
}

//taken from wordpress
function utf8_uri_encode($utf8_string, $length = 0)
{
    $unicode = '';
    $values = array();
    $num_octets = 1;
    $unicode_length = 0;

    $string_length = strlen($utf8_string);
    for ($i = 0; $i < $string_length; $i++) {

        $value = ord($utf8_string[$i]);

        if ($value < 128) {
            if ($length && ($unicode_length >= $length))
                break;
            $unicode .= chr($value);
            $unicode_length++;
        } else {
            if (count($values) == 0) $num_octets = ($value < 224) ? 2 : 3;

            $values[] = $value;

            if ($length && ($unicode_length + ($num_octets * 3)) > $length)
                break;
            if (count($values) == $num_octets) {
                if ($num_octets == 3) {
                    $unicode .= '%' . dechex($values[0]) . '%' . dechex($values[1]) . '%' . dechex($values[2]);
                    $unicode_length += 9;
                } else {
                    $unicode .= '%' . dechex($values[0]) . '%' . dechex($values[1]);
                    $unicode_length += 6;
                }

                $values = array();
                $num_octets = 1;
            }
        }
    }

    return $unicode;
}

//taken from wordpress
function seems_utf8($str)
{
    $length = strlen($str);
    for ($i = 0; $i < $length; $i++) {
        $c = ord($str[$i]);
        if ($c < 0x80) $n = 0; # 0bbbbbbb
        elseif (($c & 0xE0) == 0xC0) $n = 1; # 110bbbbb
        elseif (($c & 0xF0) == 0xE0) $n = 2; # 1110bbbb
        elseif (($c & 0xF8) == 0xF0) $n = 3; # 11110bbb
        elseif (($c & 0xFC) == 0xF8) $n = 4; # 111110bb
        elseif (($c & 0xFE) == 0xFC) $n = 5; # 1111110b
        else return false; # Does not match any model
        for ($j = 0; $j < $n; $j++) { # n bytes matching 10bbbbbb follow ?
            if ((++$i == $length) || ((ord($str[$i]) & 0xC0) != 0x80))
                return false;
        }
    }
    return true;
}

//function sanitize_title_with_dashes taken from wordpress
function generateSlug($title)
{
    $title = strip_tags($title);
    // Preserve escaped octets.
    $title = preg_replace('|%([a-fA-F0-9][a-fA-F0-9])|', '---$1---', $title);
    // Remove percent signs that are not part of an octet.
    $title = str_replace('%', '', $title);
    // Restore octets.
    $title = preg_replace('|---([a-fA-F0-9][a-fA-F0-9])---|', '%$1', $title);

    if (seems_utf8($title)) {
        if (function_exists('mb_strtolower')) {
            $title = mb_strtolower($title, 'UTF-8');
        }
        $title = utf8_uri_encode($title, 200);
    }

    $title = strtolower($title);
    $title = preg_replace('/&.+?;/', '', $title); // kill entities
    $title = str_replace('.', '-', $title);
    $title = preg_replace('/[^%a-z0-9 _-]/', '', $title);
    $title = preg_replace('/\s+/', '-', $title);
    $title = preg_replace('|-+|', '-', $title);
    $title = trim($title, '-');

    return $title;
}

if (!function_exists('push_notification')) {
    function push_notification($data, $action)
    {
        $CI = &get_instance();
        $CI->db->insert('tb_profile_notify', $data);
        $email_data['$$$TITLE$$$'] = ucfirst($action) . ' ' . $data['section_name'];
        $email_data['$$$MESSAGE$$$'] = $data['message'];
        $email = get_email_template('notification_to_admin', $email_data);
        sendEmail($CI->config->item('admin_email'), $email['template_subject'] . ' - ' . ucfirst($action) . ' ' . $data['section_name'], $email['template_body']);
    }
}

if (!function_exists('get_username')) {
    function get_username($ID)
    {
        $CI = &get_instance();
        return $CI->db->where('member_id', $ID)->get('tb_members')->row()->username;
    }
}

if (!function_exists('get_user_type')) {
    function get_user_type($ID)
    {
        $CI = &get_instance();
        return $CI->db->where('member_id', $ID)->get('tb_members')->row()->member_type;
    }
}

if (!function_exists('get_user_notifications')) {
    function get_user_notifications()
    {
        $CI = &get_instance();
        return $CI->db->where('is_read', 0)->order_by('created_at', 'desc')->get('tb_profile_notify')->result_array();
    }
}