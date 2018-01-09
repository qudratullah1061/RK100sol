<?php

$CI = &get_instance();

//admin navigation
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

//admin navigation ends
//frontend navigation
function ActivateLink($main_tab) {
    global $CI;
    if ($CI->selected_tab == $main_tab) {
        echo " active open ";
    }
}

//frontend navigation
// frontend permission check
function CheckPermission($permission_data, $privacy_name) {
    if ($permission_data) {
        foreach ($permission_data as $data) {
            if ($data['privacy_name'] == $privacy_name) {
                return $data['privacy_status'];
            }
        }
    }
}

// frontend permission check ended here.

function isAjax() {
    header('Content-Type: application/json');
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

function replace_macros($template_message = "", $macros_data = array()) {
    $template_message = str_replace('$$$BASE_URL$$$', base_url(), $template_message);
    $template_message = str_replace('$$$FIRST_NAME$$$', (isset($macros_data['$$$FIRST_NAME$$$']) ? $macros_data['$$$FIRST_NAME$$$'] : ""), $template_message);
    $template_message = str_replace('$$$LAST_NAME$$$', (isset($macros_data['$$$LAST_NAME$$$']) ? $macros_data['$$$LAST_NAME$$$'] : ""), $template_message);
    $template_message = str_replace('$$$EMAIL$$$', (isset($macros_data['$$$EMAIL$$$']) ? $macros_data['$$$EMAIL$$$'] : ""), $template_message);
    $template_message = str_replace('$$$CONFIRM_REGISTRATION$$$', (isset($macros_data['$$$CONFIRM_REGISTRATION$$$']) ? $macros_data['$$$CONFIRM_REGISTRATION$$$'] : ""), $template_message);
    $template_message = str_replace('$$$CONFIRMATION_LINK$$$', (isset($macros_data['$$$CONFIRMATION_LINK$$$']) ? $macros_data['$$$CONFIRMATION_LINK$$$'] : ""), $template_message);
    return $template_message;
}

function get_email_template($template_name, $macros_data) {
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
    $options = "<option></option>";
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
    $options = "<option value=''></option>";
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
    $options = "<option></option>";
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

function UploadImage($file_field_name, $upload_path, $create_thumb = false, $thump_options = array(), $watermark = FALSE, $unique_idetifier = "") {
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

function watermarkImage($source, $water_mark_image_name = "Transparent-K-250.png") {
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

function CreateThumbnail($source, $destination, $thump_options, $water_mark = false) {
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
            if ($water_mark_image_name != "") {
                watermarkImage($destination . $options['prefix'] . $file_name, $water_mark_image_name);
            }
        }
    }
//    if ($water_mark) {
//        // water mark original uploaded image.
//        watermarkImage($source,$water_mark_image_name);
//    }
}

function upload_temp_image($files, $unique_id, $image_type) {
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

function delete_file_from_directory($file_path) {
    global $CI;
    $complete_path = $CI->config->item('root_path') . $file_path;
    if (file_exists($complete_path)) {
        unlink($complete_path);
    }
}

function sendEmail($to, $subject, $message) {
    $header = "From:admin@konsorts.com \r\n";
    $header .= "MIME-Version: 1.0\r\n";
    $header .= "Content-type: text/html\r\n";
    $retval = mail($to, $subject, $message, $header);
    if ($retval == true) {
        return true;
    } else {
        echo "Message could not be sent...";
        exit;
    }
//    
//    global $CI;
//    require APPPATH . 'libraries/phpmailer_master/PHPMailerAutoload.php';
//    require $root_path . 'vendor/phpmailer/phpmailer/src/Exception.php';
//    require $root_path . 'vendor/phpmailer/phpmailer/src/PHPMailer.php';
//    require $root_path . 'vendor/phpmailer/phpmailer/src/SMTP.php';
    //require_once APPPATH . "/libraries/PhpMailer/class.phpmailer.php";
//PHPMailer Object
//    $mail = new PHPMailer();
//    //$mail->SMTPDebug = 3;
////Set PHPMailer to use SMTP.
//    $mail->isSMTP();
////Set SMTP host name                      
//    $mail->Host = "smtp.gmail.com";
////Set this to true if SMTP host requires authentication to send email
//    $mail->SMTPAuth = true;
////Provide username and password
//    $mail->Username = "itcomradetest@gmail.com";
//    $mail->Password = "itcomrade.us@123";
////If SMTP requires TLS encryption then set it
//    $mail->SMTPSecure = "tls";
////Set TCP port to connect to
//    $mail->Port = 587; //465;
//    $mail->From = "itcomradetest@gmail.com";
//    $mail->FromName = "Full Name";
//    $mail->addAddress($to); //addAddress($to, "Recepient Name");
//    $mail->isHTML(true);
//    $mail->Subject = $subject;
//    $mail->Body = $message;
////    $mail->AltBody = "This is the plain text version of the email content";
//    if (!$mail->send()) {
//        echo "Mailer Error: " . $mail->ErrorInfo;
//        exit;
//    }
//    return true;
}
