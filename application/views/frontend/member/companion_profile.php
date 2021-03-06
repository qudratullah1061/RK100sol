<link href="<?php echo base_url(); ?>assets/global/plugins/cubeportfolio/css/cubeportfolio.css" rel="stylesheet"
      type="text/css"/>
<section class="profle">
    <div class="container">
        <div class="row">
            <div class="col-md-3 col-sm-4">
                <div class="profile-left wow fadeInUp">
                    <div class="profile-personal">
                        <a href="javascript:;" <?php echo $this->session->userdata('member_id') != $member_info['member_id'] ? '' : 'onclick="CommonFunctions.changeMode(this)"'; ?> data-mode="<?php echo $member_info['is_online'] ?>" data-member-id="<?php echo $member_info['member_id']; ?>">
                            <!-- + Note: remove class online if user is offline + -->
                            <span id="changeMode" class="status <?php echo($member_info['is_online'] == 1 ? 'online' : 'offline'); ?>">
                                <?php echo($member_info['is_online'] == 1 ? 'online' : 'offline'); ?>
                            </span>
                        </a>
                        <div class="profile-media">
                            <img src="<?php echo file_exists($this->config->item('root_path') . ($member_info['image_path'] . 'medium_' . $member_info['image'])) ? base_url($member_info['image_path'] . 'medium_' . $member_info['image']) : base_url('uploads/member_images/profile/user.png'); ?>"
                                 alt="Profile Image">
                        </div>
                        <div class="profile-info">
                            <p><?php echo CheckPermission($member_info['privacy_info'], 'first_name_privacy') ? $member_info['first_name'] : ""; ?> <?php echo CheckPermission($member_info['privacy_info'], 'last_name_privacy') ? (strlen($member_info['last_name']) > 0 ? $member_info['last_name'][0] : "") : ""; ?>
                                .</p>
                            <span> <i class="fa fa-map-marker"></i> <?php echo $member_info['country_name']; ?>
                                , <?php echo $member_info['city_name']; ?> </span>
                        </div>
                        <div class="profile-rating">
                            <span class="profile-points">0</span>
                            <!-- Ref site http://rateyo.fundoocode.ninja/-->
                            <div class="rateyo profile_reviews"></div>
                            <span class="profile-reviews-counter">
                                0 reviews
                            </span>
                        </div>
                        <br>
                        <div class="text-center">
                            <?php if ($this->session->userdata('member_id') != $member_info['member_id'] && $connected['status'] == 1) { ?>
                                <a href="<?php echo site_url('chat/view_chat_list?chat=' . min($this->session->userdata('member_id'), $member_info['member_id']) . '-' . max($this->session->userdata('member_id'), $member_info['member_id'])) ?>"
                                   class="btn btn-deep-purple">Message</a>
                                   <?php
                               }
                               if ($this->session->userdata('member_id') != $member_info['member_id']) {
                                   if (isset($connected['status']) && $connected['status'] == 1) {
                                       ?>
                                    <a href="javascript:;" class="btn btn-deep-pink btn-disable" id="connectionBtn">Connected</a>
                                <?php } elseif (isset($connected['status']) && $connected['status'] == 2) {
                                    ?>
                                    <a href="javascript:;" class="btn btn-deep-pink btn-disable" id="connectionBtn">Rejected</a>
                                    <?php
                                } elseif (isset($connected['status']) && $connected['status'] == 0) {
                                    ?>
                                    <a href="javascript:;" class="btn btn-deep-pink btn-disable" id="connectionBtn">Pending</a>
                                <?php } else { ?>
                                    <a href="javascript:;"
                                       onclick="CommonFunctions.modal_connect_request(<?php echo $member_info['member_id'] ?>,<?php echo $this->session->userdata('member_id') ?>);"
                                       class="btn btn-deep-purple" id="connectionBtn">Connect</a>
                                       <?php
                                   }
                               }

                               if ($this->session->userdata('member_id') == $member_info['member_id']) {
                                   ?>
                                <a href="<?php echo base_url('companions/get_companion_profile#tab_1_11') ?>" class="btn btn-deep-pink btn-block">Renew Subscription</a>
                                <p class="remainingDays"><?php echo expire(date("Y-m-d", strtotime($member_info['end_subscription_date']))); ?></p>
                            <?php }
                            ?>
                        </div>
                    </div>
                    <div class="profile-misc">
                        <ul>
                            <li>
                                <p>Registration Date:</p>
                                <span><?php echo date("d-M,Y", strtotime($member_info['created_on'])); ?></span>
                            </li>
                            <li>
                                <p>Date of Birth: </p>
                                <span><?php echo date("d-M,Y", strtotime($member_info['date_of_birth'])); ?></span>
                            </li>
                            <?php if (CheckPermission($member_info['privacy_info'], 'email_privacy') && $member_info['email'] != "") { ?>
                                <li>
                                    <p>Email:</p>
                                    <span><?php echo $member_info['email']; ?></span>
                                </li>
                            <?php } ?>
                            <?php if (CheckPermission($member_info['privacy_info'], 'phone_number_privacy') && $member_info['phone_number'] != "") { ?>
                                <li>
                                    <p>Phone Number:</p>
                                    <span><?php echo $member_info['phone_number']; ?></span>
                                </li>
                            <?php } ?>
                            <li>
                                <p>Availability: </p>
                                <span class="<?php echo($member_info['is_online'] == 1 ? 'online' : 'offline'); ?>"><i
                                        class="fa fa-check-circle"></i><?php echo($member_info['is_online'] == 1 ? 'Available' : 'Un Available'); ?></span>
                            </li>
                            <li>
                                <p>Travel Option:</p>
                                <span>Off</span>
                            </li>
                            <li>
                                <p>Available From:</p>
                            </li>
                            <li>
                                <p>Available To:</p>
                            </li>
                            <li>
                                <p>Location:</p>
                            </li>
                        </ul>
                        <div class="clearfix"></div>
                    </div>
                    <div class="profile-misc">
                        <h6>Subscription:</h6>
                        <ul>
                            <li>
                                <p>Purchased On:</p>
                                <span><?php echo date("d-M,Y", strtotime($member_info['subscription_date'])); ?></span>
                            </li>
                            <li>
                                <p>Expires On:</p>
                                <span><?php echo date("d-M,Y", strtotime($member_info['end_subscription_date'])); ?></span>
                            </li>
                            <li>
                                <p>Plan:</p>
                                <span><?php echo GetSubscriptionPlanName($member_info['current_plan_id']) ?></span>
                            </li>
                        </ul>
                    </div>
                    <?php if (isset($data_languages) && count($data_languages) > 0) { ?>
                        <div class="profile-language">
                            <?php
                            echo '<h6>Language:</h6>';
                            foreach ($data_languages as $language) {
                                echo "<p>" . $language['language_name'] . " (" . $language['language_level'] . ")</p>";
                            }
                            ?>
                        </div>
                    <?php } ?>
                    <div class="profile-social">
                        <h6>Social Media:</h6>
                        <ul>
                            <li class="<?php echo (CheckPermission($member_info['privacy_info'], 'facebook_privacy') && $member_info['facebook'] != "") ? "enabled" : "disabled"; ?>">
                                <a target="_blank"
                                   href="<?php echo (CheckPermission($member_info['privacy_info'], 'facebook_privacy') && $member_info['facebook'] != "") ? $member_info['facebook'] : "javascript:;"; ?>"><i
                                        class="fa fa-facebook-square"></i></a></li>
                            <li class="<?php echo (CheckPermission($member_info['privacy_info'], 'youtube_privacy') && $member_info['youtube'] != "") ? "enabled" : "disabled"; ?>">
                                <a target="_blank"
                                   href="<?php echo (CheckPermission($member_info['privacy_info'], 'youtube_privacy') && $member_info['youtube'] != "") ? $member_info['youtube'] : "javascript:;"; ?>"><i
                                        class="fa fa-youtube-square"></i></a></li>
                            <li class="<?php echo (CheckPermission($member_info['privacy_info'], 'linkedin_privacy') && $member_info['linkedin'] != "") ? "enabled" : "disabled"; ?>">
                                <a target="_blank"
                                   href="<?php echo (CheckPermission($member_info['privacy_info'], 'linkedin_privacy') && $member_info['linkedin'] != "") ? $member_info['linkedin'] : "javascript:;"; ?>"><i
                                        class="fa fa-linkedin-square"></i></a></li>
                            <li class="<?php echo (CheckPermission($member_info['privacy_info'], 'google_privacy') && $member_info['google'] != "") ? "enabled" : "disabled"; ?>">
                                <a target="_blank"
                                   href="<?php echo (CheckPermission($member_info['privacy_info'], 'google_privacy') && $member_info['google'] != "") ? $member_info['google'] : "javascript:;"; ?>"><i
                                        class="fa fa-google-plus-square"></i></a></li>
                            <li class="<?php echo (CheckPermission($member_info['privacy_info'], 'twitter_privacy') && $member_info['twitter'] != "") ? "enabled" : "disabled"; ?>">
                                <a target="_blank"
                                   href="<?php echo (CheckPermission($member_info['privacy_info'], 'twitter_privacy') && $member_info['twitter'] != "") ? $member_info['twitter'] : "javascript:;"; ?>"><i
                                        class="fa fa-twitter-square"></i></a></li>
                            <li class="<?php echo (CheckPermission($member_info['privacy_info'], 'instagram_privacy') && $member_info['instagram'] != "") ? "enabled" : "disabled"; ?>">
                                <a target="_blank"
                                   href="<?php echo (CheckPermission($member_info['privacy_info'], 'instagram_privacy') && $member_info['instagram'] != "") ? $member_info['instagram'] : "javascript:;"; ?>"><i
                                        class="fa fa-instagram"></i></a></li>
                            <li class="<?php echo (CheckPermission($member_info['privacy_info'], 'skype_privacy') && $member_info['skype'] != "") ? "enabled" : "disabled"; ?>">
                                <a target="_blank"
                                   href="<?php echo (CheckPermission($member_info['privacy_info'], 'skype_privacy') && $member_info['skype'] != "") ? $member_info['skype'] : "javascript:;"; ?>"><i
                                        class="fa fa-skype"></i></a></li>
                            <li class="<?php echo (CheckPermission($member_info['privacy_info'], 'pinterest_privacy') && $member_info['pinterest'] != "") ? "enabled" : "disabled"; ?>">
                                <a target="_blank"
                                   href="<?php echo (CheckPermission($member_info['privacy_info'], 'pinterest_privacy') && $member_info['pinterest'] != "") ? $member_info['pinterest'] : "javascript:;"; ?>"><i
                                        class="fa fa-pinterest-square"></i></a></li>
                        </ul>
                    </div>

                    <?php if (count($certifications) > 0) { ?>
                        <div class="profile-certification">
                            <div class="profile-cert-head">
                                <h6>Certification:</h6>
                            </div>
                            <?php
                            foreach ($certifications as $value) {
                                ?>
                                <div class="certification-odd">
                                    <a class=""
                                       href="javascript:Certifications.modal_show_certification(<?php echo $value['member_certification_id']; ?>)">
                                        <p><?php echo $value['title']; ?></p>
                                        <span><?php echo strlen($value['issued_by']) > 30 ? substr($value['issued_by'], 0, 30) . "..." : $value['issued_by']; ?></span>
                                    </a>
                                </div>
                                <?php
                            }
                            echo '</div>';
                        }
                        ?>

                        <?php
                        if (count($selected_sub_categories) > 0) {
                            ?>
                            <div class="profile-skills">
                                <ul class="pagination-skills">
                                    <li>
                                        <h6>My Skills</h6>
                                        <h6 style="float:right; cursor: pointer;"
                                            onclick="Certifications.modal_skill_detail(<?php echo $member_id; ?>)">
                                            Details</h6>
                                    </li>
                                    <?php foreach ($selected_sub_categories as $sub_category) { ?>
                                        <li><?php echo $sub_category['sub_category_name']; ?></li>
                                    <?php } ?>
                                </ul>
                            </div>
                            <div style="text-align:center;">
                                <button class="btn green prev" onclick="hideShowSkills('p')"><span><</span></button>
                                <button class="btn green next" onclick="hideShowSkills('n')"><span>></span></button>
                            </div>
                        <?php } ?>
                        <!--<div id="pagination_link"></div>-->
                    </div>
                </div>
                <div class="col-md-9 col-sm-8">
                    <div class="profile-right  wow fadeInUp">
                        <div class="profile-intro">
                            <h5><?php echo count($selected_categories) > 0 ? implode(', ', array_column($selected_categories, 'category_name')) : "About Me."; ?></h5>
                            <p><?php echo $member_info['about_me']; ?></p>
                        </div>
                        <?php
                        if (count($portfolios) > 0) {
                            ?>
                            <div class="profile-portfolio">
                                <h5>Portfolio:</h5>
                                <div class="row">
                                    <div class="col-md-12 no-padding xs-padding-15px-lr">
                                        <div class="filter-content overflow-hidden">
                                            <ul class="portfolio-grid work-4col gutter-large hover-option6 lightbox-portfolio">
                                                <?php
                                                $count_sec = 0.0;
                                                foreach ($portfolios as $portfolio) {
                                                    ?>

                                                    <li class="grid-sizer"></li>
                                                    <!-- start portfolio item -->
                                                    <li class="grid-item wow zoomIn last-paragraph-no-margin" <?php echo($count_sec == 0.0 ? '' : 'data-wow-delay="' . $count_sec . 's"'); ?>>
                                                        <figure>
                                                            <div class="portfolio-img bg-purple position-relative text-center overflow-hidden">
                                                                <img src="<?php echo base_url($portfolio['portfolio_image_path'] . $portfolio['portfolio_image']); ?>"
                                                                     alt="Profile Image"/>
                                                                <div class="portfolio-icon text-white text-left">
                                                                    <p><?php echo $portfolio['portfolio_title']; ?></p>
                                                                    <p><?php echo $portfolio['city_name']; ?>
                                                                        , <?php echo $portfolio['country_name']; ?></p>
                                                                    <span class="seperator bg-light-gray"></span>
                                                                    <h6><?php echo $portfolio['portfolio_type']; ?></h6>
                                                                </div>
                                                            </div>

                                                        </figure>
                                                    </li>
                                                    <!-- end portfolio item -->
                                                    <?php
                                                    $count_sec = $count_sec + 0.2;
                                                }
                                                ?>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <?php
                        } else {
                            ?>
                            <div class="profile-reviews profile-educatoin  wow fadeInUp">
                                <h5>Portfolio:</h5>
                                <p data-wow-delay='0.02s' class='no-item'>No portfolio item added yet.
                                    <?php
                                    if ($this->session->userdata('member_id') == $member_info['member_id']) {
                                        echo ' Please go to settings and than add portfolio items in your profile.';
                                    }
                                    ?></p>
                            </div>
                            <?php
                        }
                        ?>

                        <!--                <div class="profile-reviews  wow fadeInUp">
                                            <h5>Reviews:</h5>
                                            <ul>
                                                <li>
                                                    <p class="title">Impressive Achievement, Realstic and Shocking.</p>
                                                    <p class="date"> <i class="fa fa-calendar"></i> 11November, 2016</p>
                                                    <div class="rating">
                                                        <ul class="profile-stars">
                                                            <li><i  class="fa fa-star"></i></li>
                                                            <li><i  class="fa fa-star"></i></li>
                                                            <li><i  class="fa fa-star"></i></li>
                                                            <li><i  class="fa fa-star"></i></li>
                                                            <li><i  class="fa fa-star"></i></li>
                                                        </ul>
                                                        <div class="rateyo"></div>
                                                        <span class="profile-points">5.0</span>
                                                    </div>
                                                    <p class="description">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Vel risus commodo viverra maecenas accumsan lacus. </p>
                                                </li>
                                                <li>
                                                    <p class="title">Highly Recommended!</p>
                                                    <p class="date"> <i class="fa fa-calendar"></i> 12January, 2017</p>
                                                    <div class="rating">
                                                        <ul class="profile-stars">
                                                            <li><i  class="fa fa-star"></i></li>
                                                            <li><i  class="fa fa-star"></i></li>
                                                            <li><i  class="fa fa-star"></i></li>
                                                            <li><i  class="fa fa-star"></i></li>
                                                            <li><i  class="fa fa-star"></i></li>
                                                        </ul>
                                                        <div class="rateyo"></div>
                                                        <span class="profile-points">5.0</span>
                                                    </div>
                                                    <p class="description">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Vel risus commodo viverra maecenas accumsan lacus. </p>
                                                </li>
                                            </ul>
                                        </div>-->
                        <div class="profile-reviews profile-educatoin  wow fadeInUp">
                            <h5>Education:</h5>
                            <?php if (count($degrees) > 0) { ?>
                                <ul>
                                    <?php
                                    foreach ($degrees as $value) {
                                        ?>
                                        <li>
                                            <p class="title"><?php echo $value['title']; ?></p>
                                            <p><?php echo $value['degree_name']; ?></p>
                                            <p class="date"><i
                                                    class="fa fa-calendar"></i> <?php echo $value['start_date']; ?>
                                                - <?php echo $value['end_date']; ?></p>
                                        </li>
                                        <?php
                                    }
                                    ?>
                                </ul>
                                <?php
                            } else {
                                echo "<p data-wow-delay='0.02s'>No education item added yet.";
                                if ($this->session->userdata('member_id') == $member_info['member_id']) {
                                    echo ' Please go to settings and than add educational details in your profile.';
                                }
                                echo "</p>";
                            }
                            ?>
                        </div>
                        <div class="profile-reviews profile-educatoin  wow fadeInUp">
                            <h5>Work Experience:</h5>
                            <ul>
                                <?php
                                if (count($experiences) > 0) {
                                    foreach ($experiences as $value) {
                                        ?>
                                        <li>
                                            <p class="title"><?php echo $value['title']; ?></p>
                                            <p><?php echo $value['position']; ?></p>
                                            <p class="date"><i
                                                    class="fa fa-calendar"></i> <?php echo $value['start_date']; ?>
                                                - <?php echo $value['end_date']; ?></p>
                                        </li>
                                        <?php
                                    }
                                } else {

                                    echo "<p data-wow-delay='0.02s'>No experience item added yet.";
                                    if ($this->session->userdata('member_id') == $member_info['member_id']) {
                                        echo ' Please go to settings and than add experience details in your profile.';
                                    }
                                    echo "</p>";
                                }
                                ?>


                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
</section>
<script src="<?php echo base_url(); ?>assets/global/plugins/cubeportfolio/js/jquery.cubeportfolio.js"
type="text/javascript"></script>
<script src="<?php echo base_url('assets/custom_scripts/frontend/certification.js'); ?>"
type="text/javascript"></script>
<script>
                                $(function () {
                                    $(".profile_reviews").rateYo({
                                        rating: 0,
                                        spacing: "3px",
                                        starWidth: "15px",
                                        readOnly: true,
                                        multiColor: {
                                            "startColor": "#942192", //RED
                                            "endColor": "#942192"  //GREEN
                                        }
                                    });
                                    hideShowSkills('e');
                                });

                                var size_li = $(".pagination-skills li").size();
                                if (size_li <= 6) {
                                    $(".prev").hide();
                                    $(".next").hide();
                                }
                                var showItems = 5;
                                var current_counter = 5;

                                function hideShowSkills(btnClick) {

                                    if (btnClick == 'e') {
                                        $('.pagination-skills li:lt(' + showItems + ')').show();
                                        $('.pagination-skills li:gt(' + showItems + ')').hide();
                                        $(".prev").hide();
                                    }

                                    if (btnClick == 'n') {
                                        if (current_counter <= size_li) {
                                            $('.pagination-skills li:lt(' + (current_counter + 6) + ')').show();
                                            $('.pagination-skills li:lt(' + (current_counter + 1) + ')').hide();
                                            current_counter += 5;
                                        }
                                        if (current_counter >= size_li) {
                                            // hide next button.
                                            $(".next").hide();
                                        }
                                        $(".prev").show();
//                                    $('#myList li:lt(' + x + ')').show();
                                    }
                                    if (btnClick == 'p') {
                                        if (current_counter > 0) {
                                            $('.pagination-skills li:gt(' + (current_counter - 10) + ')').show();
                                            $('.pagination-skills li:gt(' + (current_counter - 5) + ')').hide();
//                                        $('.pagination-skills li:lt(' + (current_counter - 10) + ')').hide();
                                            current_counter -= 5;
                                        }
                                        if (current_counter <= 5) {
                                            // hide next button.
                                            $(".prev").hide();
                                        }
                                        $(".next").show();
                                    }
                                    $('.pagination-skills li').first().show();
                                }
</script>