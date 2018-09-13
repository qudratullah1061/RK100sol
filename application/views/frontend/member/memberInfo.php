<section class="profle">
    <div class="container">
        <div class="row ">
            <div class="col-md-offset-2 col-md-8 col-sm-8">
                <div class="profile-left wow fadeInUp" style="visibility: visible; animation-name: fadeInUp;">
                    <h1 class="text-center text-purple font-weight-600 margin-20px-top">This member offers the following services</h1>
                    <div class="profile-personal memb-profile">
                        <div class="col-sm-6">
                            <a href="javascript:;" onclick="CommonFunctions.changeMode(this)" data-mode="1" data-member-id="117">
                                <!-- + Note: remove class online if user is offline + -->
                            </a>
                            <div class="profile-media">
                                <img src="<?php echo file_exists($this->config->item('root_path') . ($member_info['image_path']) . $member_info['image']) ? (base_url($member_info['image_path'] . $member_info['image'])) : base_url('uploads/member_images/profile/user.png'); ?>" alt="Profile Image" data-no-retina="">
                            </div>
                            <div class="profile-info">

                                <span> <i class="fa fa-map-marker"></i><?php echo $member_info['location']; ?></span>
                            </div>
                        </div>
                        <div class="member-offers text-left col-sm-6">
                            <ul>
                                <li class='margin-10px-bottom'>
                                    <h4 class="text-purple font-weight-700 margin-0 line-height-medium">Services:</h4>
                                    <p class="margin-0 font-weight-600"><?php echo $selected_categories ? $selected_categories : "No services added yet!"; ?></p>
                                </li>
                                <li class='margin-10px-bottom'>
                                    <h4 class="text-purple font-weight-700 margin-0 line-height-medium">Availability:</h4>
                                    <p class="margin-0 font-weight-600"> <i class="fa fa-check-circle <?php echo $member_info['is_online'] ? "online" : ""; ?>" aria-hidden="true"></i> Available </p>
                                </li>

                                <li class='margin-10px-bottom'>
                                    <h4 class="text-purple font-weight-700 margin-0 line-height-medium">Language</h4>
                                    <p class="margin-0 font-weight-600"> 
                                        <?php
                                        if ($data_languages) {
                                            foreach ($data_languages as $language) {
                                                echo $language['language_name'] . " (" . $language['language_level'] . ")<br/>";
                                            }
                                        }else{
                                            echo "No language specified yet!";
                                        }
                                        ?>
                                    </p>
                                </li>
                            </ul>
                            <div class="clearfix"></div>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                    <div class="contact-member text-center margin-35px-top margin-45px-top">
                        <h3  class="text-center text-purple font-weight-600 margin-0 line-height-normal">To contact this member</h3>
                        <a href="<?php echo base_url('profile/guest_signup'); ?>" class='btn btn-deep-purple font-weight-600 margin-lr-auto block text-normal btn-lg'>Become a Guest Member</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>