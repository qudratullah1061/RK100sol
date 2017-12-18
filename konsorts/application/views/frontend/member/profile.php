<section class="profle">
    <div class="container">
        <div class="col-md-3 col-sm-4">
            <div class="profile-left wow fadeInUp">
                <div class="profile-personal">
                    <span class="status <?php echo ($member_info['is_online'] == 1 ? 'online' : 'offline'); ?>"><!-- + Note: remove class online if user is offline + -->
                        <?php echo ($member_info['is_online'] == 1 ? 'online' : 'offline'); ?>
                    </span>
                    <div class="profile-media">
                        <img src="<?php echo base_url($member_info['image_path'].$member_info['image']);?>" alt="">
                    </div>
                    <div class="profile-info">
                        <p><?php echo $member_info['first_name'];?> <?php echo ($member_info['last_name'] != '' ? $member_info['last_name'][0] : '');?>.</p>
                        <span> <i class="fa fa-map-marker"></i> <?php echo $member_info['country_name'];?>, <?php echo $member_info['city_name'];?> </span>
                    </div>

                    <div class="profile-rating">
                        <span class="profile-points">3.4</span>
                        <!-- Ref site http://rateyo.fundoocode.ninja/-->
                        <div class="rateyo"></div>
                        <span class="profile-reviews-counter">
                            2 reviews
                        </span>
                    </div>
                    <br>
                    <div class="text-center">
                        <a href="#" class="btn btn-deep-purple">Message</a>
                    </div>
                </div>
                <div class="profile-misc">
                    <ul>
                        <li><p>Registration Date:</p>  <span><?php echo date("d-M,Y",strtotime($member_info['created_on'])); ;?></span></li>
                        <li><p>Date of Birth: </p><span><?php echo date("d-M,Y",strtotime($member_info['date_of_birth'])); ;?></span></li>
                        <li><p>Acalability: </p><span class="<?php echo ($member_info['is_online'] == 1 ? 'online' : 'offline'); ?>"> <i class="fa fa-check-circle"></i><?php echo ($member_info['is_online'] == 1 ? 'Available' : 'Un Available'); ?></span></li>
                        <li><p>Travel Option:</p> <span>Off</span></li>
                        <li><p>Available From:</p></li>
                        <li><p>Available To:</p></li>
                        <li><p>Location:</p></li>
                    </ul>
                    <div class="clearfix"></div>
                </div>
                <div class="profile-language">
                    <h6>Language:</h6>
                    <p>French (Native or Bilingual)</p>
                    <p>German (Conversational)</p>
                    <p>English (Frank)</p>
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
                <div class="profile-certification">
                    <div class="profile-cert-head"><h6>Certification:</h6></div>
                    <div class="certification-odd">
                        <a href="#">
                            <p>Fitness Trainer (2016)</p>
                            <span>Lorem Ipsum Foundation</span>                        
                        </a>
                    </div>
                    <div class="certification-odd">
                        <a href="#">
                            <p>Online Coaching (2017)</p>
                            <span>Lorem Ipsum Foundation</span>
                        </a>
                    </div>
                </div>
                <div class="profile-skills">
                    <ul>
                        <li><h6>My Skills</h6></li>
                        <?php foreach($selected_sub_categories as $sub_category){?>
                        
                        <li><?php echo $sub_category['sub_category_name']; ?></li>
                        
                        <?php } ?>
                        
                    </ul>
                </div>
            </div>
        </div>
        <div class="col-md-9 col-sm-8">
            <div class="profile-right  wow fadeInUp">
                <div class="profile-intro">
                    <h5><?php echo implode(',',array_column($selected_categories,'category_name'));?>.</h5>
                    <p><?php echo $member_info['about_me']; ?></p>
                </div>

                <div class="profile-portfolio">
                    <h5>Portfolio:</h5>
                    <div class="row">
                        <div class="col-md-12 no-padding xs-padding-15px-lr">
                            <div class="filter-content overflow-hidden">
                                <ul class="portfolio-grid work-4col gutter-large hover-option6 lightbox-portfolio">
                                    <li class="grid-sizer"></li>
                                    <!-- start portfolio item -->
                                    
                                    <?php 
                                    $count_sec = 0.0;
                                    foreach($portfolios as $portfolio){?>
                                    <li class="grid-item wow zoomIn last-paragraph-no-margin" <?php echo ($count_sec == 0.0 ? '' : 'data-wow-delay="'.$count_sec.'s"');?>>
                                        <figure>
                                            <div class="portfolio-img bg-purple position-relative text-center overflow-hidden">
                                                <img src="<?php echo base_url($portfolio['portfolio_image_path'].$portfolio['portfolio_image']);?>" alt=""/>
                                                <div class="portfolio-icon text-white text-left">
                                                    <p><?php echo $portfolio['portfolio_title']; ?></p>
                                                    <p><?php echo $portfolio['city_name']; ?>, <?php echo $portfolio['country_name']; ?></p>
                                                    <span class="seperator bg-light-gray"></span>
                                                    <h6>Travel Place</h6>
                                                </div>
                                            </div>

                                        </figure>
                                    </li>
                                    <?php $count_sec = $count_sec+ 0.2;
                                       }
                                       ?>
                                    
                                    <!-- end portfolio item -->
                                    <!-- start portfolio item -->
                                    
                                   
                                    <!-- end portfolio item -->
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="profile-reviews  wow fadeInUp">
                    <h5>Reviews:</h5>

                    <ul>
                        <li>
                            <p class="title">Impressive Achievement, Realstic and Shocking.</p>
                            <p class="date"> <i class="fa fa-calendar"></i> 11November, 2016</p>
                            <div class="rating">
                                <!--                                <ul class="profile-stars">
                                                                    <li><i  class="fa fa-star"></i></li>
                                                                    <li><i  class="fa fa-star"></i></li>
                                                                    <li><i  class="fa fa-star"></i></li>
                                                                    <li><i  class="fa fa-star"></i></li>
                                                                    <li><i  class="fa fa-star"></i></li>
                                                                </ul>-->
                                <div class="rateyo"></div>
                                <span class="profile-points">5.0</span>
                            </div>
                            <p class="description">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Vel risus commodo viverra maecenas accumsan lacus. </p>
                        </li>
                        <li>
                            <p class="title">Highly Recommended!</p>
                            <p class="date"> <i class="fa fa-calendar"></i> 12January, 2017</p>
                            <div class="rating">
                                <!--                                <ul class="profile-stars">
                                                                    <li><i  class="fa fa-star"></i></li>
                                                                    <li><i  class="fa fa-star"></i></li>
                                                                    <li><i  class="fa fa-star"></i></li>
                                                                    <li><i  class="fa fa-star"></i></li>
                                                                    <li><i  class="fa fa-star"></i></li>
                                                                </ul>-->
                                <div class="rateyo"></div>
                                <span class="profile-points">5.0</span>
                            </div>
                            <p class="description">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Vel risus commodo viverra maecenas accumsan lacus. </p>
                        </li>
                    </ul>
                </div>
                <div class="profile-reviews profile-educatoin  wow fadeInUp">
                    <h5>Education:</h5>

                    <ul>
                        <li>
                            <p class="title">HEC Lausanne - The Faculty of Business and Economics Faculty of the University of Lausanne</p>
                            <p>Executive Master of Science in Technology Management</p>
                            <p class="date"> <i class="fa fa-calendar"></i> 2004 - 2006</p>
                        </li>
                        <li>
                            <p class="title">Notre-Dame de Jamhour, Jesuit College - Lebanon</p>
                            <p>Executive Master of Science in Technology Management</p>
                            <p class="date"> <i class="fa fa-calendar"></i> 1984 - 1997</p>
                        </li>
                        <li>
                            <p class="title">University of Oxford !</p>
                            <p>Executive Master of Science in Technology Management</p>
                            <p class="date"> <i class="fa fa-calendar"></i> 2003 - 2004</p>
                        </li>
                    </ul>
                </div>
                <div class="profile-reviews profile-educatoin  wow fadeInUp">
                    <h5>Work Experience:</h5>
                    <ul>
                        <li>
                            <p class="title">International Consultant</p>
                            <p>CD Consulting</p>
                            <p class="date"> <i class="fa fa-calendar"></i> 2010 - Present</p>
                        </li>
                        <li>
                            <p class="title">International Consultant</p>
                            <p>CD Consulting</p>
                            <p class="date"> <i class="fa fa-calendar"></i> 2010 - Present</p>
                        </li>
                        <li>
                            <p class="title">Business Anylist</p>
                            <p>Consulting and Development Service</p>
                            <p class="date"> <i class="fa fa-calendar"></i> 2006 - 2007</p>
                        </li>

                    </ul>
                </div>
            </div>
        </div>
    </div>
</section>