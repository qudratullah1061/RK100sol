<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Home extends CI_Controller {

    var $selected_tab = 'home';

    function __construct() {
        parent::__construct();
        $this->layout = 'frontend/main';
        $this->load->model('admin/misc_model', 'Misc_Model');
        $this->load->model('admin/members_model', 'Members_model');
    }
    
    function test(){
        echo '{
	"@context": "http://iiif.io/api/presentation/2/context.json",
	"@id": "http://75d1c2c1-699b-4b77-a211-30b81a86ca27",
	"@type": "sc:Manifest",
	"label": [
		"Test Label",
		{}
	],
	"metadata": [],
	"description": [
		{
			"@value": "Test Description.",
			"@language": "en"
		}
	],
	"license": "https://creativecommons.org/licenses/by/3.0/",
	"attribution": "Attributation Here.",
	"sequences": [
		{
			"@id": "http://9ce14675-0de6-473f-9abf-830c55191ad9",
			"@type": "sc:Sequence",
			"label": "Normal Sequence",
			"canvases": [
				{
					"@id": "http://f6b5dd1f-7dbc-4114-a31e-5889f3f5da89",
					"@type": "sc:Canvas",
					"label": "Empty canvas",
					"height": 5064,
					"width": 4080,
					"images": [
						{
							"@context": "http://iiif.io/api/presentation/2/context.json",
							"@id": "http://8a9898f1-3db3-4ed3-8e86-35644c908ff5",
							"@type": "oa:Annotation",
							"motivation": "sc:painting",
							"resource": {
								"@id": "https://bafdigital.iiifhosting.com//iiif/b7fb2cec6a8fda26604e0c5f1440b7b6467c7b066237cf6e4e9a00383075143d/full/full/0/default.jpg",
								"@type": "dctypes:Image",
								"format": "image/jpeg",
								"service": {
									"@context": "http://iiif.io/api/image/2/context.json",
									"@id": "https://bafdigital.iiifhosting.com//iiif/b7fb2cec6a8fda26604e0c5f1440b7b6467c7b066237cf6e4e9a00383075143d",
									"profile": [
										"http://iiif.io/api/image/2/level1.json",
										{
											"formats": [
												"jpg"
											],
											"qualities": [
												"native",
												"color",
												"gray"
											],
											"supports": [
												"regionByPct",
												"regionSquare",
												"sizeByForcedWh",
												"sizeByWh",
												"sizeAboveFull",
												"rotationBy90s",
												"mirroring"
											]
										}
									]
								},
								"height": 5064,
								"width": 4080
							},
							"on": "http://f6b5dd1f-7dbc-4114-a31e-5889f3f5da89"
						}
					],
					"related": ""
				},
				{
					"@id": "http://39f04a5d-651c-40e1-a160-0eb18160830d",
					"@type": "sc:Canvas",
					"label": "Lable of canvass here",
					"height": "7000",
					"width": "5000",
					"images": [
						{
							"@context": "http://iiif.io/api/presentation/2/context.json",
							"@id": "http://9a855662-fc82-4bc9-8c93-3f22b3bfc6e5",
							"@type": "oa:Annotation",
							"motivation": "sc:painting",
							"resource": {
								"@id": "https://bafdigital.iiifhosting.com//iiif/9a5e296eb64ee969e47c1df514d28c3aaabd6013c6b815547d595128dfc5476e/full/full/0/default.jpg",
								"@type": "dctypes:Image",
								"format": "image/jpeg",
								"service": {
									"@context": "http://iiif.io/api/image/2/context.json",
									"@id": "https://bafdigital.iiifhosting.com//iiif/9a5e296eb64ee969e47c1df514d28c3aaabd6013c6b815547d595128dfc5476e",
									"profile": [
										"http://iiif.io/api/image/2/level1.json",
										{
											"formats": [
												"jpg"
											],
											"qualities": [
												"native",
												"color",
												"gray"
											],
											"supports": [
												"regionByPct",
												"regionSquare",
												"sizeByForcedWh",
												"sizeByWh",
												"sizeAboveFull",
												"rotationBy90s",
												"mirroring"
											]
										}
									]
								},
								"height": 5064,
								"width": 4008
							},
							"on": "http://39f04a5d-651c-40e1-a160-0eb18160830d"
						}
					]
				}
			]
		}
	],
	"structures": [],
	"related": {
		"@id": "test.com",
		"label": "test label related",
		"format": "jpg"
	},
	"viewingDirection": "left-to-right"
}';
        exit;
        
    }

    function index() {
        if($this->uri->segment(1)){
            redirect(base_url());
        }
        $this->selected_tab = 'home';
        $categories_data = $this->Misc_Model->get_all_categories();
        $gold_members = $this->Members_model->get_gold_members_for_homepage();
        $data['categories_data'] = $categories_data;
        $data['gold_members'] = $gold_members;
//        echo "<pre>";
//        print_r($gold_members);
//        exit;
        $this->load->view('frontend/home', $data);
    }

    function searchmember() {
        $cat_id = '';
        $sub_cat_id = '';
        $sub_cat_id_str = '';
        $category_ids = array();
        $sub_category_ids = array();
        if (isset($_GET['location']) && $_GET['location'] != '') {
            $categories_data = $this->Misc_Model->get_all_categories();
            $data['categories_data'] = $categories_data;
            $geo_codes = getGeoCodes($_GET['location']);
            if (count($geo_codes) > 0) {
                $loc = $_GET['location'];
                $radius = $_GET['radius'];
                if(isset($_GET['category_available'])){
                    $cat_available = $_GET['category_available'];
                }
                //Start Categories and Sub Categories
                if (isset($cat_available)) {
                    foreach ($cat_available as $sel_cat) {
                        $selected_cat = explode(':', $sel_cat);
                        $category_ids[] = $selected_cat[0];
                        $sub_category_ids[] = $selected_cat[1];
                        $sub_cat_id_str .= $selected_cat[1] . ',';
                    }
                    $unique_cat_ids = array_unique($category_ids);
                    $unique_sub_cat_ids = array_unique($sub_category_ids);
                    $cat_id = implode(',', $unique_cat_ids);
                    $sub_cat_id = rtrim($sub_cat_id_str, ',');
                }
                //End
                $lat = isset($geo_codes['latitude']) ? $geo_codes['latitude'] : "";
                $lon = isset($geo_codes['longitude']) ? $geo_codes['longitude'] : "";
                $nearby_members_id = '';
                $members_list = array();
                if ($radius > 0 && $lat != "" && $lon != "") {
                    $distance_miles = $radius / 1.609344; //M
                    $nearby_members = $this->Members_model->SearchNearByMembers($lat, $lon, $distance_miles);
                    if (count($nearby_members) > 0) {
                        $nearby_members_id = '';
                        foreach ($nearby_members as $nearby_ids) {
                            if ($nearby_members_id != '') {
                                $nearby_members_id .= ',';
                            }
                            $nearby_members_id .= $nearby_ids['member_id'];
                        }
                        $members_list = $this->Members_model->search_members($cat_id, $sub_cat_id, $geo_codes, $nearby_members_id);
                    }
                } else {
                    $members_list = $this->Members_model->search_members($cat_id, $sub_cat_id, $geo_codes, $nearby_members_id);
//                    $members_list = $this->Members_model->search_members($cat_available, $geo_codes, $nearby_members_id);
                }
            }
            $data['members_list'] = $members_list;
            $data['selected_cat_ids'] = isset($unique_cat_ids) ? $unique_cat_ids : array();
            $data['selected_sub_cat_ids'] = isset($unique_sub_cat_ids) ? $unique_sub_cat_ids : array();
            $this->load->view('frontend/member/search', $data);
        } else {
            redirect(base_url());
        }
    }

    function not_found() {
        $this->load->view('frontend/page404');
    }

}
