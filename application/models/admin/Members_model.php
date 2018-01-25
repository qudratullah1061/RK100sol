<?php

/*
 * * Admin model
 * * Model to save/update/delete Admin Users
 */
include_once(APPPATH . 'models/Abstract_model.php');

class Members_model extends Abstract_model {

    protected $is_error;
    public $member_exists;
    public $member_info;

    //Model Constructor
    function __construct() {
        // inherited from base class.
        $this->table_name = "tb_members";
        parent::__construct();
    }

    function get_member_privacy($member_id) {
        $sql = "SELECT tb_members_privacy.* FROM tb_members_privacy WHERE tb_members_privacy.member_id = $member_id";
        $member_privacy_info = $this->db->query($sql)->result_array();
        if ($member_privacy_info) {
            return isset($member_privacy_info) ? $member_privacy_info : array();
        }
    }

    function get_member_by_id($member_id) {
        $sql = "SELECT `tb_countries`.country_name,`tb_states`.state_name,`tb_cities`.city_name,`tb_member_images`.image, `tb_member_images`.image_path, `tb_member_images`.is_profile_image, `tb_member_images`.image_type, `tb_members`.* FROM `tb_members` " .
                " LEFT JOIN `tb_countries` ON `tb_countries`.country_id = tb_members.country" .
                " LEFT JOIN `tb_states` ON `tb_states`.state_id = tb_members.state" .
                " LEFT JOIN `tb_cities` ON `tb_cities`.city_id = tb_members.city" .
                " LEFT JOIN `tb_member_images` ON `tb_member_images`.image_id = " .
                "   (SELECT image_id " .
                "      FROM `tb_member_images` " .
                "   WHERE `tb_member_images`.member_id = `tb_members`.member_id AND `tb_member_images`.image_type = 'profile' ORDER BY `tb_member_images`.is_profile_image DESC Limit 0,1 )" .
                " WHERE `tb_members`.member_id = " . $member_id;
        $member_info = $this->db->query($sql)->result_array();
        if ($member_info) {
            $member_privacy_info = $this->get_member_privacy($member_id);
            if ($member_privacy_info) {
                $member_info[0]['privacy_info'] = $member_privacy_info;
            }
            return isset($member_info[0]) ? $member_info[0] : array();
        }
    }

    // sarfraz.
//    function get_member_portfolio($member_id) {
//        $sql = "SELECT `tb_countries`.country_name,`tb_states`.state_name,`tb_cities`.city_name,tb_member_portfolios.* FROM `tb_members` " .
//                " LEFT JOIN `tb_countries` ON `tb_countries`.country_id = tb_members.country" .
//                " LEFT JOIN `tb_states` ON `tb_states`.state_id = tb_members.state" .
//                " LEFT JOIN `tb_cities` ON `tb_cities`.city_id = tb_members.city" .
//                " LEFT JOIN `tb_member_portfolios` ON `tb_member_portfolios`.member_id = tb_members.member_id" .
//                " WHERE `tb_members`.member_id = " . $member_id;
//        return $this->db->query($sql)->result_array();
//    }

    function get_member_portfolio($member_id, $active_condition = "") {
        $sql = "SELECT `tb_countries`.country_name,`tb_states`.state_name,`tb_cities`.city_name,tb_member_portfolios.* FROM `tb_member_portfolios` " .
                " LEFT JOIN `tb_countries` ON `tb_member_portfolios`.country = `tb_countries`.country_id " .
                " LEFT JOIN `tb_states` ON `tb_member_portfolios`.state = `tb_states`.state_id " .
                " LEFT JOIN `tb_cities` ON `tb_member_portfolios`.city = `tb_cities`.city_id " .
                " WHERE `tb_member_portfolios`.member_id = " . $member_id . " " . $active_condition;
        return $this->db->query($sql)->result_array();
    }

    function get_member_languages($member_id, $active_condition = "") {
        $sql = "SELECT * FROM tb_member_languages" .
                " WHERE `tb_member_languages`.member_id = " . $member_id . " " . $active_condition;
        return $this->db->query($sql)->result_array();
    }

    public function get_language($language_id) {
        $this->table_name = 'tb_member_languages';
        $result = $this->getBy('language_id', $language_id);
        return isset($result[0]) ? $result[0] : array();
    }

    public function add_language($data) {
        $this->table_name = "tb_member_languages";
        return $this->save($data);
    }

    public function update_language($column, $row_id, $data) {
        $this->table_name = "tb_member_languages";
        return $this->updateBy($column, $row_id, $data);
    }

    function get_member_degrees($member_id, $active_condition = "") {
        $sql = "SELECT * FROM tb_member_degrees" .
                " WHERE `tb_member_degrees`.member_id = " . $member_id . " " . $active_condition;
        return $this->db->query($sql)->result_array();
    }

    public function get_degree($degree_id) {
        $this->table_name = 'tb_member_degrees';
        $result = $this->getBy('member_degree_id', $degree_id);
        return isset($result[0]) ? $result[0] : array();
    }

    public function add_degree($data) {
        $this->table_name = "tb_member_degrees";
        return $this->save($data);
    }

    public function update_degree($column, $row_id, $data) {
        $this->table_name = "tb_member_degrees";
        return $this->updateBy($column, $row_id, $data);
    }

    function get_member_certification($member_id, $active_condition = "") {
        $sql = "SELECT * FROM tb_member_certifications" .
                " WHERE `tb_member_certifications`.member_id = " . $member_id . " " . $active_condition;
        return $this->db->query($sql)->result_array();
    }

    public function get_certification($certification_id) {
        $this->table_name = 'tb_member_certifications';
        $result = $this->getBy('member_certification_id', $certification_id);
        return isset($result[0]) ? $result[0] : array();
    }

    public function add_certification($data) {
        $this->table_name = "tb_member_certifications";
        return $this->save($data);
    }

    public function update_certification($column, $row_id, $data) {
        $this->table_name = "tb_member_certifications";
        return $this->updateBy($column, $row_id, $data);
    }

    function get_member_experiences($member_id, $active_condition = "") {
        $sql = "SELECT * FROM tb_member_experience" .
                " WHERE `tb_member_experience`.member_id = " . $member_id . " " . $active_condition;
        return $this->db->query($sql)->result_array();
    }

    public function get_experience($experience_id) {
        $this->table_name = 'tb_member_experience';
        $result = $this->getBy('member_experience_id', $experience_id);
        return isset($result[0]) ? $result[0] : array();
    }

    public function add_experience($data) {
        $this->table_name = "tb_member_experience";
        return $this->save($data);
    }

    public function update_experience($column, $row_id, $data) {
        $this->table_name = "tb_member_experience";
        return $this->updateBy($column, $row_id, $data);
    }

    public function IsMember($username = "", $password = "") {
        $this->is_error = FALSE;
        $this->member_exists = FALSE;
        if (trim($username) && trim($password)) {
            $password = md5($password);
            $member = $this->db->query("SELECT * FROM $this->table_name WHERE ((email='{$username}' OR username='{$username}') AND password='{$password}') LIMIT 1");
            if ($member->num_rows() > 0) {
                $this->member_exists = TRUE;
                $this->member_info = $member->result_array();
            }
        }
    }

    public function member_login($username, $password) {
        $this->IsMember($username, $password);
        if (!$this->member_exists) {
            return array('error' => 1, 'member_info' => null, 'error_message' => "Please enter valid username and password to login.");
        } else {
            // check is email verified by member. Otherwise show message to user to verify email first before login.
            if ($this->member_info[0]['subscription_date'] == "0000-00-00 00:00:00") {
                if ($this->member_info[0]['member_type'] == 1) {
                    redirect(base_url('profile/guest_payment/' . $this->member_info[0]['member_id'] . "/1"));
                } elseif ($this->member_info[0]['member_type'] == 2) {
                    return array('error' => 1, 'member_info' => $this->member_info[0], 'error_message' => "Your subscription date is not valid. Please contact with admin regarding this issue. Thanks.");
                }
            } elseif (strtotime($this->member_info[0]['end_subscription_date']) <= time()) {
                if ($this->member_info[0]['member_type'] == 1) {
                    redirect(base_url('profile/guest_payment/' . $this->member_info[0]['member_id'] . "/2"));
                } elseif ($this->member_info[0]['member_type'] == 2) {
                    return array('error' => 1, 'member_info' => $this->member_info[0], 'error_message' => "Your subscription has been expired. Please renew your subscription to use konsorts.com");
                }
            } elseif ($this->member_info[0]['is_email_verified'] == 0) {
                return array('error' => 1, 'member_info' => $this->member_info[0], 'error_message' => "Please verify email address before login to your account.");
            } elseif ($this->member_info[0]['status'] == "pending") {
                return array('error' => 1, 'member_info' => $this->member_info[0], 'error_message' => "Account is under review by admin and will be approved within 24 hours. We will notify you when account will be activated by admin. Thanks for your patience.");
            } elseif ($this->member_info[0]['status'] == "suspended") {
                return array('error' => 1, 'member_info' => $this->member_info[0], 'error_message' => "Account is suspended by admin. Admin will contact you with the reason why account is suspended. Or you can directly send email to admin. Thanks for your patience.");
            }
            //$this->is_error = 0;
            if ($this->member_info[0]['status'] == 'active')
                return array('error' => 0, 'member_info' => $this->member_info[0]);
        }
    }

    function get_member_images_by_type($where) {
        if ($where) {
            return $this->db->get_where('tb_member_images', $where)->result_array();
        }
        return null;
    }

    public function getMembers($condition = '', $offset = -1, $limit = 10, $order_by = '') {
        $sql = "SELECT `tb_member_images`.image, `tb_member_images`.image_path, `tb_member_images`.is_profile_image, `tb_member_images`.image_type, `tb_members`.* FROM `tb_members` " .
                " LEFT JOIN `tb_member_images` ON `tb_member_images`.image_id = " .
                "(SELECT image_id " .
                " FROM `tb_member_images` " .
                " WHERE `tb_member_images`.member_id = `tb_members`.member_id AND `tb_member_images`.image_type = 'profile' ORDER BY `tb_member_images`.is_profile_image DESC Limit 0,1 )";
        $sql_count = "SELECT count(`tb_members`.member_id) as total FROM `tb_members` ";

        if ($condition != '') {
            $sql .= " WHERE " . $condition;
            $sql_count .= " WHERE " . $condition;
        }

        if (trim($order_by) != '') {
            $sql .= $order_by;
        } else {
            $sql .= " ORDER BY `tb_members`.member_id DESC ";
        }
        if ($offset >= 0 && $limit != -1) {
            $sql .= " LIMIT " . ($offset) . ', ' . $limit;
        }
        $count = $this->db->query($sql_count)->result('array');
        $results = $this->db->query($sql)->result('array');
        $results_array = array();
        $results_array['records'] = $results;
        $results_array['query'] = $sql;
        $results_array['total'] = $count[0]['total'];
        return $results_array;
    }

    public function add_member($data) {
        return $this->save($data);
    }

    public function update_member($edit_id, $data) {
        $this->updateBy('member_id', $edit_id, $data);
    }

    public function getTempImages($unique_id, $image_type) {
        return $this->db->get_where('tb_temp_images_upload', array('unique_id' => $unique_id, 'image_type' => $image_type))->result_array();
    }

    public function getPlans($plan_type) {
        return $this->db->get_where('tb_member_plans', array('plan_type' => $plan_type, 'is_active' => 1))->result_array();
    }

    public function get_all_selected_categories($member_id) {
        return $this->db->get_where('tb_member_categories', array('member_id' => $member_id))->result_array();
    }

    public function get_selected_categories($member_id) {
        $this->db->select('tb_categories.category_name,tb_categories.category_id');
        $this->db->from('tb_categories');
        $this->db->join('tb_member_categories', 'tb_member_categories.category_id = tb_categories.category_id');
        $this->db->where('tb_member_categories.member_id', $member_id);
        $this->db->group_by('tb_categories.category_id');
        return $this->db->get()->result_array();
    }

    public function get_selected_sub_categories($member_id) {
        $this->db->select('tb_sub_categories.sub_category_name,tb_sub_categories.sub_category_id');
        $this->db->from('tb_sub_categories');
        $this->db->join('tb_member_categories', 'tb_member_categories.sub_category_id = tb_sub_categories.sub_category_id');
        $this->db->where('tb_member_categories.member_id', $member_id);
        return $this->db->get()->result_array();
    }

    function AddUpdateMemberCategories($member_categories, $member_id, $added_by = 0) {
        if ($member_id) {
            // delete previous member ids
            if ($this->session->userdata('admin_id')) {
                $added_by = $this->session->userdata('admin_id');
            }
            $this->table_name = 'tb_member_categories';
            $this->db->where('member_id', $member_id);
            $this->db->delete($this->table_name);
            if ($member_categories) {
                foreach ($member_categories as $category) {
                    $category_array = explode("::", $category);
                    $category_id = isset($category_array[0]) ? $category_array[0] : 0;
                    $sub_category_id = isset($category_array[1]) ? $category_array[1] : 0;
                    $data = array('member_id' => $member_id, 'category_id' => $category_id, 'sub_category_id' => $sub_category_id, 'created_on' => date("Y-m-d H:i:s"), 'created_by' => $added_by);
                    $this->save($data);
                }
            }
        }
    }

    public function search_members($cat_available, $geo_codes, $nearby_members_id) {
        $sql = "SELECT tb_members.* , tb_categories.*, tb_member_categories.*, tb_member_images.image, tb_member_images.image_path FROM tb_members"
                . " LEFT JOIN tb_member_categories ON (tb_members.member_id = tb_member_categories.member_id)"
                . " LEFT JOIN tb_member_images ON (tb_members.member_id = tb_member_images.member_id)"
                . " LEFT JOIN tb_categories ON (tb_member_categories.category_id = tb_categories.category_id) WHERE tb_members.member_type = 2";
        if ($cat_available != '') {
            $sql .= " AND tb_categories.category_id = $cat_available";
        }
        if ((isset($geo_codes['country_long']) && $geo_codes['country_long']) || (isset($geo_codes['country_short']) && $geo_codes['country_short'])) {
            $sql .= " AND (`country` = '" . $geo_codes["country_long"] . "' OR `country` = '" . $geo_codes["country_short"] . "') ";
        }
        if ((isset($geo_codes['city_long']) && $geo_codes['city_long']) || (isset($geo_codes['city_short']) && $geo_codes['city_short'])) {
            $sql .= " AND (`city` = '" . $geo_codes["city_long"] . "' OR `city` = '" . $geo_codes["city_short"] . "') ";
        }
        if ((isset($geo_codes['state_long']) && $geo_codes['state_long']) || (isset($geo_codes['state_short']) && $geo_codes['state_short'])) {
            $sql.= " AND (`state` = '" . $geo_codes["state_short"] . "' OR `state` = '" . $geo_codes["state_short"] . "') ";
        }
        if ($nearby_members_id != '') {
            $sql.= ' AND tb_members.member_id IN (' . $nearby_members_id . ')';
        }
        $sql .= ' GROUP BY tb_members.member_id ORDER BY tb_member_images.is_profile_image DESC';
        return $this->db->query($sql)->result('array');
    }

    public function SearchNearByMembers($lat, $lon, $radius) {
        $sql = 'SELECT distinct(member_id) FROM tb_members  WHERE (3958*3.1415926*sqrt((Latitude-' . $lat . ')*(Latitude-' . $lat . ') + cos(Latitude/57.29578)*cos(' . $lat . '/57.29578)*(Longitude-' . $lon . ')*(Longitude-' . $lon . '))/180) <= ' . $radius . ';';
        return $this->db->query($sql)->result('array');
    }

}
