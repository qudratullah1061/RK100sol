<?php

//Extended for thumbnail prefix
class MY_Image_lib extends CI_Image_lib {

    public function initialize($props = array()) {
        parent::initialize($props);
        $xp = $this->explode_name($this->dest_image);

        $filename = $xp['name'];
        $file_ext = $xp['ext'];

        $this->full_dst_path = $this->dest_folder . $this->thumb_marker . $filename . $file_ext;
    }

}
