<section class="profle">
    <div class="container">
        <div class="col-md-3 col-sm-4">
            <div class="profile-left wow fadeInUp">
                <div class="profile-personal">
                    <span class="status <?php echo ($member_info['is_online'] == 1 ? 'online' : 'offline'); ?>"><!-- + Note: remove class online if user is offline + -->
                        <?php echo ($member_info['is_online'] == 1 ? 'online' : 'offline'); ?>
                    </span>
                    <div class="profile-media">
                        <img src="<?php echo base_url($member_info['image_path'] . 'medium_' . $member_info['image']); ?>" alt="">
                    </div>
                    <div class="profile-info">
                        <p><?php echo $member_info['first_name']; ?> <?php echo ($member_info['last_name'] != '' ? $member_info['last_name'][0] : ''); ?>.</p>
                        <span> <i class="fa fa-map-marker"></i> <?php echo $member_info['country_name']; ?>, <?php echo $member_info['city_name']; ?> </span>
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
                        <a href="#" class="btn btn-deep-purple">Message</a>
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
                <div class="profile-social">
                    <h6>Social Media:</h6>
                    <ul>
                        <li class="enabled"><a href="#"><i class="fa fa-facebook-square"></i></a></li>
                        <li class="enabled"><a href="#"><i class="fa fa-youtube-square"></i></a></li>
                        <li><a href="#"><i class="fa fa-linkedin-square"></i></a></li>
                        <li><a href="#"><i class="fa fa-google-plus-square"></i></a></li>
                        <li class="enabled"><a href="#"><i class="fa fa-twitter-square"></i></a></li>
                        <li><a href="#"><i class="fa fa-instagram"></i></a></li>
                        <li><a href="#"><i class="fa fa-skype"></i></a></li>
                        <li class="enabled"><a href="#"><i class="fa fa-pinterest-square"></i></a></li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="col-md-9 col-sm-8">
            <div class="profile-right  wow fadeInUp">
                <div class="profile-intro">
                    <p><?php echo $member_info['about_me']; ?></p>
                </div>
                <div class="profile-reviews  wow fadeInUp">
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
    });
</script>