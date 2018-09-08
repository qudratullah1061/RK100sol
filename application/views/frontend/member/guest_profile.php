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
                            <img src="<?php echo file_exists($this->config->item('root_path') . (($member_info['image_path'] . 'medium_' . $member_info['image']))) ? base_url(($member_info['image_path'] . 'medium_' . $member_info['image'])) : base_url('uploads/member_images/profile/user.png'); ?>"
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
                               if ($this->session->userdata('member_id') != $member_info['member_id'] && $connected['status'] == 1) {
                                   ?>
                                <a href="javascript:;" class="btn btn-deep-pink btn-disable" id="connectionBtn">Connected</a>
                                <?php
                            }
                            if ($this->session->userdata('member_id') == $member_info['member_id']) {
                                ?>
                                <a href="<?php echo base_url('guests/get_guest_profile#tab_1_6') ?>"
                                   class="btn btn-deep-pink btn-lg">Renew Subscription</a>
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
                        </ul>
                        <div class="clearfix"></div>
                    </div>
                    <div class="profile-language">
                        <h6>Languages:</h6>
                        <?php
                        if (isset($data_languages) && count($data_languages) > 0) {
                            foreach ($data_languages as $language) {
                                echo "<p>" . $language['language_name'] . " (" . $language['language_level'] . ")</p>";
                            }
                        }
                        ?>
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
                                <p>Remaining Days:</p>
                                <span class="remainingDays"><?php echo expire(date("Y-m-d", strtotime($member_info['end_subscription_date']))); ?></span>
                            </li>
                            <li>
                                <p>Plan:</p>
                                <span><?php echo GetSubscriptionPlanName($member_info['current_plan_id']) ?></span>
                            </li>
                        </ul>
                    </div>
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
                </div>
            </div>
            <div class="col-md-9 col-sm-8">
                <div class="profile-right  wow fadeInUp">
                    <div class="profile-intro">
                        <h5>About Me</h5>
                        <p><?php echo $member_info['about_me']; ?></p>
                    </div>
                    <!--                <div class="profile-reviews  wow fadeInUp">
                                        <h5>Reviews:</h5>
                                        <ul>
                                            <li>
                                                <p class="title">Impressive Achievement, Realstic and Shocking.</p>
                                                <p class="date"> <i class="fa fa-calendar"></i> 11November, 2016</p>
                                                <div class="rating">
                                                    <div class="rateyo user_reviews-1"></div>
                                                    <div class="rateyo"></div>
                                                    <span class="profile-points">3.0</span>
                                                </div>
                                                <p class="description">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Vel risus commodo viverra maecenas accumsan lacus. </p>
                                            </li>
                                            <li>
                                                <p class="title">Highly Recommended!</p>
                                                <p class="date"> <i class="fa fa-calendar"></i> 12January, 2017</p>
                                                <div class="rating">
                                                    <div class="rateyo user_reviews-2"></div>
                                                    <div class="rateyo"></div>
                                                    <span class="profile-points">3.5</span>
                                                </div>
                                                <p class="description">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Vel risus commodo viverra maecenas accumsan lacus. </p>
                                            </li>
                                        </ul>
                                    </div>-->
                </div>
            </div>
        </div>
    </div>
</section>
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
        $(".user_reviews-1").rateYo({
            rating: 3,
            spacing: "3px",
            starWidth: "15px",
            readOnly: true,
            multiColor: {
                "startColor": "#942192", //RED
                "endColor": "#942192"  //GREEN
            }
        });
        $(".user_reviews-2").rateYo({
            rating: 3.5,
            spacing: "3px",
            starWidth: "15px",
            readOnly: true,
            multiColor: {
                "startColor": "#942192", //RED
                "endColor": "#942192"  //GREEN
            }
        });
    });
</script>