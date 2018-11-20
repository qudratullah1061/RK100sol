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
  "@type" : "sc:Manifest",
  "@context" : "http://iiif.io/api/presentation/2/context.json",
  "@id" : "https://manifests.britishart.yale.edu/manifest/1273",
  "label" : "Thomas Creswick, 1811–1869, British, View on the Hudson River, ca. 1843, oil on mahogany, Yale Center for British Art, B1986.7.2, Paintings and Sculpture",
  "description" : "Support (PTG): 8 x 12 inches (20.3 x 30.5 cm)",
  "attribution" : "<span>Yale Center for British Art, Paul Mellon Fund,<br/>Public Domain</span>",
  "metadata" : [ {
    "label" : "Creator(s)",
    "value" : [ "Thomas Creswick, 1811–1869, British" ]
  }, {
    "label" : "Titles",
    "value" : [ "<span>View on the Hudson River</span>" ]
  }, {
    "label" : "Date",
    "value" : [ "ca. 1843" ]
  }, {
    "label" : "Medium",
    "value" : [ "<span>oil on mahogany</span>" ]
  }, {
    "label" : "Dimensions",
    "value" : [ "Support (PTG): 8 x 12 inches (20.3 x 30.5 cm)" ]
  }, {
    "label" : "Credit line",
    "value" : [ "Yale Center for British Art, Paul Mellon Fund" ]
  }, {
    "label" : "Institution",
    "value" : [ "Yale Center for British Art" ]
  }, {
    "label" : "Collection",
    "value" : [ "Paintings and Sculpture" ]
  }, {
    "label" : "Accession number",
    "value" : [ "B1986.7.2" ]
  } ],
  "logo" : "https://static.britishart.yale.edu/images/ycba_logo.jpg",
  "related" : [ {
    "@id" : "http://collections.britishart.yale.edu/vufind/Record/1665981",
    "label" : "catalog entry at the Yale Center for British Art",
    "format" : "text/html"
  } ],
  "seeAlso" : [ {
    "@id" : "https://manifests.britishart.yale.edu/lido/1273.xml",
    "format" : "text/xml",
    "profile" : "http://www.lido-schema.org/schema/v1.0/lido-v1.0.xsd"
  }, {
    "@id" : "http://collection.britishart.yale.edu/id/data/object/1273",
    "format" : "text/rdf+n3"
  } ],
  "sequences" : [ {
    "@id" : "https://manifests.britishart.yale.edu/sequence/1273",
    "@type" : "sc:Sequence",
    "label" : "default sequence",
    "viewingHint" : "individuals",
    "canvases" : [ {
      "images" : [ {
        "resource" : {
          "@type" : "dctypes:Image",
          "service" : {
            "profile" : "http://library.stanford.edu/iiif/image-api/1.1/conformance.html#level1",
            "@id" : "https://images.britishart.yale.edu/iiif/45160245-4771-49de-a9e5-7cf21e8cbb68",
            "@context" : "http://iiif.io/api/image/1/context.json"
          },
          "format" : "image/jpeg",
          "width" : 3785,
          "@id" : "https://images.britishart.yale.edu/iiif/45160245-4771-49de-a9e5-7cf21e8cbb68/full/full/0/native.jpg",
          "label" : "cropped to image, recto, unframed",
          "height" : 2528
        },
        "@type" : "oa:Annotation",
        "motivation" : "sc:painting",
        "@id" : "https://manifests.britishart.yale.edu/annotation/ba-obj-1273-0001-pub",
        "on" : "https://manifests.britishart.yale.edu/canvas/ba-obj-1273-0001-pub"
      } ],
      "@type" : "sc:Canvas",
      "width" : 3785,
      "@id" : "https://manifests.britishart.yale.edu/canvas/ba-obj-1273-0001-pub",
      "label" : "cropped to image, recto, unframed",
      "height" : 2528
    }, {
      "images" : [ {
        "resource" : {
          "@type" : "dctypes:Image",
          "service" : {
            "profile" : "http://library.stanford.edu/iiif/image-api/1.1/conformance.html#level1",
            "@id" : "https://images.britishart.yale.edu/iiif/73f4090a-e0a1-4edd-8e5a-a3d0fa8b20aa",
            "@context" : "http://iiif.io/api/image/1/context.json"
          },
          "format" : "image/jpeg",
          "width" : 3979,
          "@id" : "https://images.britishart.yale.edu/iiif/73f4090a-e0a1-4edd-8e5a-a3d0fa8b20aa/full/full/0/native.jpg",
          "label" : "recto, unframed",
          "height" : 3738
        },
        "@type" : "oa:Annotation",
        "motivation" : "sc:painting",
        "@id" : "https://manifests.britishart.yale.edu/annotation/ba-obj-1273-0001-bar",
        "on" : "https://manifests.britishart.yale.edu/canvas/ba-obj-1273-0001-bar"
      } ],
      "@type" : "sc:Canvas",
      "width" : 3979,
      "@id" : "https://manifests.britishart.yale.edu/canvas/ba-obj-1273-0001-bar",
      "label" : "recto, unframed",
      "height" : 3738
    } ]
  } ]
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
