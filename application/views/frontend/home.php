<!-- BEGIN PAGE LEVEL PLUGINS -->
<link href="<?php echo base_url(); ?>assets/global/plugins/bootstrap-multiselect/css/bootstrap-multiselect.css" rel="stylesheet" type="text/css" />
<!-- END PAGE LEVEL PLUGINS -->
<!-- banner -->
<section class="wow fadeIn no-padding home-banner  xs-background-image-center" data-stellar-background-ratio="0.5" style="background-image:url('<?php echo base_url('assets/frontend/'); ?>img/home-banner.jpg');">
    <!-- <div class="opacity-extra-medium bg-black"></div> -->
    <div class="container home-panner-height xs-padding-15px-lr">
        <div class="row height-100">
            <div class="position-relative height-100">
                <div class="slider-typography">
                    <div class="slider-text-middle-main">
                        <div class="slider-text-middle">
                            <div class="col-lg-12 text-left">
                                <h4 class="text-white alt-font font-weight-700 open-sans xs-width-100">
                                    Contract a Service Member
                                </h4>
                                <p class="open-sans text-white">Community of independent service providers.</p>
                                <a href='<?php echo base_url('register'); ?>' class='btn btn-purple-white-border open-sans'>Hire Services</a>
                                <a href='<?php echo base_url('register'); ?>' class='btn btn-purple-white-border open-sans'>Offer Services</a>
                                <a href='<?php echo base_url('profile/companion_signup/silver'); ?>' class='btn btn-purple-white-border open-sans margin-small-screen'>Promo Code Registration</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<section class="wow fadeIn no-padding search-section">
    <div class="container">
        <div class="search-box">
            <form id="member-search-form" action="<?php echo base_url('home/searchmember'); ?>" method="get">
                <div class="col-1">
                    <div class='row  gutter-16'>
                        <div class="col-lg-4 col-md-4">
                            <div class="form-group">
                                <label for="search">Search By: State, Zip/Postal Code, Country</label>
                                <input type="text" name="location" id="location" class="placeholder-lightgray" placeholder="Example: Chittagong, 4000, Bangladesh">
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-4">
                            <div class="form-group">
                                <label for="radius">Radius Range</label>
                                <input type="text" name="radius" id="radius" class="placeholder-lightgray" placeholder="Enter Kilometers Radius E.G: 100">
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-4">
                            <div class="form-group">
                                <label for="radius">Available For:</label>
                                <!--<div class="select-style select-medium">-->
                                <div class="portlet-body">
                                    <!--<select name="category_available" id="category_available" class="bg-transparent no-margin-bottom">-->
                                    <select name="category_available[]" id="category_available" class="mt-multiselect btn btn-default" multiple="multiple" data-clickable-groups="true" data-collapse-groups="true" data-width="100%" data-action-onchange="true">
                                        <!--<option value="">Available For:</option>-->
                                        <?php foreach ($categories_data as $catDataRow) { ?>
                                            <optgroup label="<?php echo $catDataRow->category_name; ?>" class="<?php echo 'group-' . $catDataRow->category_id; ?>">
                                                <?php
                                                $sub_categories = getSubCategoriesByCategoryId($catDataRow->category_id);
                                                if ($sub_categories && count($sub_categories) > 0) {
                                                    foreach ($sub_categories as $sub_cat) {
                                                        ?>
                                                        <option value="<?php echo $catDataRow->category_id; ?>:<?php echo $sub_cat['sub_category_id']; ?>"><?php echo $sub_cat['sub_category_name']; ?></option>
                                                        <?php
                                                    }
                                                }
                                                ?>
                                            </optgroup>
                                        <?php }
                                        ?>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-2 text-right">
                    <button id="project-contact-us-button" type="submit" class="btn btn-deep-purple font-weight-600 width-100 margin-25px-top btn-with-seperater">
                        <i class='fa fa-search'></i>
                        <span>SEARCH A MEMBER</span>
                    </button>
                </div>
            </form>
        </div>
    </div>
</section>
<section class="wow fadeIn cat-members">
    <div class="container">
        <div class="row">
            <div class="col-md-12 no-padding xs-padding-15px-lr">
                <div class="filter-content overflow-hidden">
                    <ul class="portfolio-grid work-6col gutter-large hover-option6 lightbox-portfolio">
                        <li class="grid-sizer"></li>
                        <!-- start portfolio item -->
                        <li class="grid-item wow zoomIn last-paragraph-no-margin" data-wow-delay="0.2s">
                            <figure>
                                <div class="portfolio-img bg-purple position-relative text-center overflow-hidden">
                                    <img src="<?php echo base_url('assets/frontend/'); ?>img/cat-1.jpg" alt="Fitness" />
                                    <div class="portfolio-icon">
                                        <a href="<?php echo base_url('fitness'); ?>">
                                            <i class="fa fa-link text-extra-dark-gray" aria-hidden="true"></i>
                                        </a>
                                    </div>
                                </div>
                                <figcaption class="bg-white">
                                    <div class="portfolio-hover-main text-center">
                                        <div class="portfolio-hover-box vertical-align-middle">
                                            <div class="portfolio-hover-content position-relative">
                                                <!--<span class="line-height-normal font-weight-600 text-normal alt-font text-purple text-uppercase display-block">Fitness</span>-->
                                                <a href="<?php echo base_url('fitness'); ?>" class="line-height-normal font-weight-600 text-normal alt-font text-purple text-uppercase display-block">Fitness</a>
                                            </div>
                                        </div>
                                    </div>
                                </figcaption>
                            </figure>
                        </li>
                        <!-- end portfolio item -->
                        <!-- start portfolio item -->
                        <li class="grid-item wow zoomIn last-paragraph-no-margin">
                            <figure>
                                <div class="portfolio-img bg-purple position-relative text-center overflow-hidden">
                                    <img src="<?php echo base_url('assets/frontend/'); ?>img/cat-2.jpg" alt="Tourism" />
                                    <div class="portfolio-icon">
                                        <a href="<?php echo base_url('tourism'); ?>">
                                            <i class="fa fa-link text-extra-dark-gray" aria-hidden="true"></i>
                                        </a>
                                    </div>
                                </div>
                                <figcaption class="bg-white">
                                    <div class="portfolio-hover-main text-center">
                                        <div class="portfolio-hover-box vertical-align-middle">
                                            <div class="portfolio-hover-content position-relative">
                                                <a href="<?php echo base_url('tourism'); ?>" class="line-height-normal font-weight-600 text-normal alt-font text-purple text-uppercase display-block">Tourism</a>
                                            </div>
                                        </div>
                                    </div>
                                </figcaption>
                            </figure>
                        </li>
                        <!-- end portfolio item -->
                        <!-- start portfolio item -->
                        <li class="grid-item wow zoomIn last-paragraph-no-margin" data-wow-delay="0.2s">
                            <figure>
                                <div class="portfolio-img bg-purple position-relative text-center overflow-hidden">
                                    <img src="<?php echo base_url('assets/frontend/'); ?>img/cat-3.jpg" alt="Social Occassion" />
                                    <div class="portfolio-icon">
                                        <a href="<?php echo base_url('social-occasion'); ?>">
                                            <i class="fa fa-link text-extra-dark-gray" aria-hidden="true"></i>
                                        </a>
                                    </div>
                                </div>
                                <figcaption class="bg-white">
                                    <div class="portfolio-hover-main text-center">
                                        <div class="portfolio-hover-box vertical-align-middle">
                                            <div class="portfolio-hover-content position-relative">
                                                <a href="<?php echo base_url('social-occasion'); ?>" class="line-height-normal font-weight-600 text-normal alt-font text-purple text-uppercase display-block">SOCIAL OCCASION</a>
                                            </div>
                                        </div>
                                    </div>
                                </figcaption>
                            </figure>
                        </li>
                        <!-- end portfolio item -->
                        <!-- start portfolio item -->
                        <li class="grid-item wow zoomIn last-paragraph-no-margin">
                            <figure>
                                <div class="portfolio-img bg-purple position-relative text-center overflow-hidden">
                                    <img src="<?php echo base_url('assets/frontend/'); ?>img/cat-4.jpg" alt="Fashion" />
                                    <div class="portfolio-icon">
                                        <a href="<?php echo base_url('fashion'); ?>">
                                            <i class="fa fa-link text-extra-dark-gray" aria-hidden="true"></i>
                                        </a>
                                    </div>
                                </div>
                                <figcaption class="bg-white">
                                    <div class="portfolio-hover-main text-center">
                                        <div class="portfolio-hover-box vertical-align-middle">
                                            <div class="portfolio-hover-content position-relative">
                                                <a href="<?php echo base_url('fashion'); ?>" class="line-height-normal font-weight-600 text-normal alt-font text-purple text-uppercase display-block">Fashion</a>
                                            </div>
                                        </div>
                                    </div>
                                </figcaption>
                            </figure>
                        </li>
                        <!-- end portfolio item -->
                        <!-- start portfolio item -->
                        <li class="grid-item wow zoomIn last-paragraph-no-margin" data-wow-delay="0.2s">
                            <figure>
                                <div class="portfolio-img bg-purple position-relative text-center overflow-hidden">
                                    <img src="<?php echo base_url('assets/frontend/'); ?>img/cat-5.jpg" alt="Hosting" />
                                    <div class="portfolio-icon">
                                        <a href="<?php echo base_url('hosting'); ?>">
                                            <i class="fa fa-link text-extra-dark-gray" aria-hidden="true"></i>
                                        </a>
                                    </div>
                                </div>
                                <figcaption class="bg-white">
                                    <div class="portfolio-hover-main text-center">
                                        <div class="portfolio-hover-box vertical-align-middle">
                                            <div class="portfolio-hover-content position-relative">
                                                <a href="<?php echo base_url('hosting'); ?>" class="line-height-normal font-weight-600 text-normal alt-font text-purple text-uppercase display-block">Hosting</a>
                                            </div>
                                        </div>
                                    </div>
                                </figcaption>
                            </figure>
                        </li>
                        <!-- end portfolio item -->
                        <!-- start portfolio item -->
                        <li class="grid-item wow zoomIn last-paragraph-no-margin">
                            <figure>
                                <div class="portfolio-img bg-purple position-relative text-center overflow-hidden">
                                    <img src="<?php echo base_url('assets/frontend/'); ?>img/cat-6.jpg" alt="Event Planning" />
                                    <div class="portfolio-icon">
                                        <a href="<?php echo base_url('event-planning'); ?>">
                                            <i class="fa fa-link text-extra-dark-gray" aria-hidden="true"></i>
                                        </a>
                                    </div>
                                </div>
                                <figcaption class="bg-white">
                                    <div class="portfolio-hover-main text-center">
                                        <div class="portfolio-hover-box vertical-align-middle">
                                            <div class="portfolio-hover-content position-relative">
                                                <a href="<?php echo base_url('event-planning'); ?>" class="line-height-normal font-weight-600 text-normal alt-font text-purple text-uppercase display-block">EVENT PLANNING</a>
                                            </div>
                                        </div>
                                    </div>
                                </figcaption>
                            </figure>
                        </li>
                        <!-- end portfolio item -->
                    </ul>
                </div>
            </div>
        </div>
        <!-- end feature box item -->
    </div>
</section>
<?php if (isset($gold_members) && count($gold_members) > 0) { ?>
    <section class="wow fadeIn gold-members">
        <div class="container">
            <p class="title-bar bg-purple text-white font-weight-600 text-center">
                <i class="fa fa-star"></i> GOLD MEMBERS
                <i class="fa fa-star"></i>
            </p>
            <div class="row">
                <div class="filter-content overflow-hidden xs-margin-15px-lr">
                    <ul class="portfolio-grid work-6col gutter-large hover-option6 lightbox-portfolio">
                        <li class="grid-sizer"></li>
                        <?php foreach ($gold_members as $gold) { ?>
                            <!--start portfolio item--> 
                            <li class="grid-item wow fadeInUp last-paragraph-no-margin">
                                <div class="feature-box gold-box">
                                    <div class="content">
                                        <figure>
                                            <div class="portfolio-img  position-relative text-center overflow-hidden">
                                                <a href="<?php echo $this->session->userdata('member_type') == 1 ? base_url('member/profile/' . base64_encode($members_list_row['member_id'])) : base_url('profile/memberInfo/' . base64_encode($members_list_row['member_id'])); ?>">
                                                    <img src="<?php echo file_exists($this->config->item('root_path').$gold['image_path'].'/medium_'.$gold['image']) ? base_url($gold['image_path'].'/medium_'.$gold['image']) : base_url('uploads/member_images/profile/profile.png');?>" alt="profile image" />
                                                </a>
                                            </div>
                                            <figcaption class="">
                                                <div class="portfolio-hover-main text-center">
                                                    <div class="portfolio-hover-box vertical-align-middle">
                                                        <div class="portfolio-hover-content position-relative">
                                                            <span class="line-height-normal font-weight-600 display-block lato"><?php echo $gold['first_name']; ?></span>
                                                            <p class=""><?php echo $gold['location']; ?></p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </figcaption>
                                        </figure>
                                    </div>
                                </div>
                            </li>
                            <!--end portfolio item--> 
                        <?php } ?>
                    </ul>
                </div>
            </div>
            <p class="title-bar bg-purple text-white font-weight-600 text-center">
                <i class="fa fa-star"></i> GOLD MEMBERS
                <i class="fa fa-star"></i>
            </p>
        </div>
    </section>
<?php } ?>
<section class="wow fadeIn bright-career no-padding">
    <div class="container">
        <div class='career-box'>
            <div class="row">
                <div class="col-md-6">
                    <h3 class="text-white">Looking For <span>a Bright Career</span></h3>
                    <p class="text-white text-small">As a Member you have a chance to start a Bright Career and Earn Real Cash! </p>
                    <p class="text-white text-small">At Konsorts, we aim to provide top notch quality tour guides, personal trainers and many more services. </p>
                    <p class="text-white text-small">Avail our services as a client or a member!</p>
                    <a href="#" class="btn btn-purple-white-border open-sans"> See More </a>
                </div>
                <div class="col-md-6">
                    <!--<iframe width="100%" src="https://www.youtube.com/embed/UBA0jauD-ig" frameborder="0" allowfullscreen></iframe>-->
                    <iframe width="100%" src="https://www.youtube.com/embed/OsFQXAWrNAw" frameborder="0" allowfullscreen></iframe>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="wow fadeIn works">
    <div class="container">

        <div class="row equalize xs-equalize-auto">
            <!-- start interactive banners item -->
            <div class="col-md-4 col-sm-6 col-xs-12 banner-style2 sm-margin-30px-bottom wow fadeIn works-box wow " >
                <figure> 
                    <div class="banner-image bg-black height-370px cover-background" style="background-image:url('<?php echo base_url('assets/frontend/'); ?>img/work-1.jpg');">
                        <div class="works-caption">
                            <div class="text-center padding-30px-tb">
                                <p>HOW KONSORTS WORKS?</p>
                            </div>   
                        </div>
                    </div>
                    <figcaption class="padding-30px-all bg-purple last-paragraph-no-margin">
                        <div class="display-table width-100 height-100">
                            <div class="display-table-cell vertical-align-middle text-left">
                                <p class="text-white">Whether you are a personal fitness trainer, an event organizer or require other services, Konsorts is an ideal pit stop for all your needs. So what makes us different? Among the burgeoning websites that cater specifically to traveling, specific services or services that are unique and difficult to find, Konsorts is the only platform...</p>
                                <a href="<?php echo base_url('how-it-works'); ?>" class="text-white font-weight-700">Read More</a>
                            </div>
                        </div>
                    </figcaption>
                </figure>
            </div>
            <div class="col-md-4 col-sm-6 col-xs-12 banner-style2 sm-margin-30px-bottom wow fadeIn works-box wow zoomIn">
                <figure> 
                    <div class="banner-image bg-black height-370px cover-background" style="background-image:url('<?php echo base_url('assets/frontend/'); ?>img/work-2.jpg');">
                        <div class="works-caption">
                            <div class="text-center padding-30px-tb">
                                <p>EARN EXTRA CASH</p>
                            </div>   
                        </div>
                    </div>
                    <figcaption class="padding-30px-all bg-purple last-paragraph-no-margin">
                        <div class="display-table width-100 height-100">
                            <div class="display-table-cell vertical-align-middle text-left">
                                <p class="text-white">Unlike many other earning websites, Konsorts helps you make money online without needing any prior experience in most cases. You get the opportunity to earn extra money on top of your daily wages. This is especially useful for people who are looking to break out of their daily grind and change career paths. Instead of dropping...</p>
                                <a href="<?php echo base_url('earn-extra-cash') ?>" class="text-white font-weight-700">Read More</a>
                            </div>
                        </div>
                    </figcaption>
                </figure>
            </div>
            <div class="col-md-4 col-sm-6 col-xs-12 banner-style2 sm-margin-30px-bottom wow fadeIn works-box wow">
                <figure> 
                    <div class="banner-image bg-black height-370px cover-background" style="background-image:url('<?php echo base_url('assets/frontend/'); ?>img/work-3.jpg');">
                        <div class="works-caption">
                            <div class="text-center padding-30px-tb">
                                <p>A SECURE COMMUNITY</p>
                            </div>   
                        </div>
                    </div>
                    <figcaption class="padding-30px-all bg-purple last-paragraph-no-margin">
                        <div class="display-table width-100 height-100">
                            <div class="display-table-cell vertical-align-middle text-left">
                                <p class="text-white">What if we told you that you could be a part of a market place that fulfills your every need? You could hire a chef, find travel companions, even walking partners within minutes? With Konsorts, we are shaping the way people do business. Gone are the days where it took hours of research and referrals to find what you were looking for...</p>
                                <a href="<?php echo base_url('secure-community') ?>" class="text-white font-weight-700">Read More</a>
                            </div>
                        </div>
                    </figcaption>
                </figure>
            </div>
            <!-- end interactive banners item -->
        </div>
    </div>
</section>
<section class="wow fadeIn pricing bg-light-gray">
    <div class="container">



        <p class="title-bar bg-purple text-white font-weight-600 text-center">
            <i class="fa fa-user"></i> KONSORTS MEMBERSHIP PLANS
            <i class="fa fa-user"></i>
        </p>


        <div class="row">
            <div class="pricing-box-style1">
                <!-- start pricing item -->
                <div class="col-md-3 col-sm-6 col-xs-12 text-center sm-margin-30px-bottom wow fadeInUp">
                    <div class="pricing-box price-box bg-eb">
                        <div class="bg-deep-lilace padding-10px-tb alt-font text-white font-weight-500 text-uppercase">Guest Member</div>
                        <div class="border-lr border-width-2 border-color-a1 padding-20px-top padding-10px-bottom">
                            <h4 class="text-light-black roboto font-weight-500 no-margin-bottom">$29.99</h4>
                            <span class='dark-gray seperator'></span>
                            <p class="roboto margin-5px-top text-light-black margin-0">1/Year</p>
                        </div>
                        <div class="border-lr border-bottom border-width-2 border-color-a1 padding-10px-all pricing-features sm-padding-20px-all border-top border-width-2px">
                            <div class="pricing-action sm-no-margin-top">
                                <a href="<?php echo base_url('profile/guest_signup'); ?>" class="btn btn-deep-purple btn-small mon">Become a Member</a>
                            </div>
                        </div>
                    </div>
                    <div class="text-left padding-40px-right margin-25px-top text-light-black">
                        <p class="margin-5px-bottom list-heading"><strong class="font-weight-600">Perks:</strong> (Guest Members)</p>
                        <ul class="list-style-5 custom-list no-padding text-extra-small">
                            <li>
                                Guest Members looking to contract a service from a member such as personal trainer, travel guide or any other member.
                            </li>
                        </ul>
                    </div>


                </div>
                <!-- end pricing item -->
                <!-- start pricing item -->
                <div class="col-md-3 col-sm-6 col-xs-12 text-center sm-margin-30px-bottom wow fadeInUp" data-wow-delay="0.4s">
                    <div class="pricing-box price-box bg-eb">
                        <div class="bg-nobel padding-10px-tb alt-font text-white font-weight-500 text-uppercase">SILVER MEMBER</div>
                        <div class="border-lr border-bottom border-width-2 border-color-a1 padding-20px-top padding-10px-bottom">
                            <h4 class="text-light-black roboto font-weight-500 no-margin-bottom">$59.99</h4>
                            <span class='dark-gray seperator'></span>
                            <p class="roboto margin-5px-top text-light-black margin-0">6/Months</p>
                            <span class="text-extra-small text-light-black roboto">30 Day Free Trial</span>
                        </div> 

                        <div class="border-lr border-width-2 border-color-a1 padding-20px-top padding-10px-bottom">
                            <h4 class="text-light-black roboto font-weight-500 no-margin-bottom">$99.99</h4>
                            <span class='dark-gray seperator'></span>
                            <p class="roboto margin-5px-top text-light-black margin-0">12/Months</p>
                            <span class="text-extra-small text-light-black roboto">30 Day Free Trial</span>
                        </div>
                        <!-- start pricing features -->
                        <div class="border-lr border-bottom border-width-2 border-color-a1 padding-10px-all pricing-features sm-padding-20px-all border-top border-width-2px">
                            <div class="pricing-action sm-no-margin-top">
                                <a href="<?php echo base_url('profile/companion_signup/silver'); ?>" class="btn btn-deep-purple btn-small mon">Become a Member</a>
                            </div>
                        </div>
                        <!-- end pricing features -->
                    </div>
                </div>
                <!-- end pricing item -->
                <!-- start pricing item -->
                <div class="col-md-3 col-sm-6 col-xs-12 text-center sm-margin-30px-bottom wow fadeInUp">
                    <div class="pricing-box price-box bg-eb">
                        <div class="bg-gold padding-10px-tb alt-font text-white font-weight-500 text-uppercase">GOLD MEMBER</div>
                        <div class="border-lr border-bottom border-width-2 border-color-a1 padding-20px-top padding-10px-bottom">
                            <h4 class="text-light-black roboto font-weight-500 no-margin-bottom">$89.99</h4>
                            <span class='dark-gray seperator'></span>
                            <p class="roboto margin-5px-top text-light-black margin-0">6/Months</p>
                            <span class="text-extra-small text-light-black roboto">30 Day Free Trial</span>
                        </div>
                        <div class="border-lr border-width-2 border-color-a1 padding-20px-top padding-10px-bottom">
                            <h4 class="text-light-black roboto font-weight-500 no-margin-bottom">$149.99</h4>
                            <span class='dark-gray seperator'></span>
                            <p class="roboto margin-5px-top text-light-black margin-0">12/Months</p>
                            <span class="text-extra-small text-light-black roboto">30 Day Free Trial</span>
                        </div>
                        <!-- start pricing features -->
                        <div class="border-lr border-bottom border-width-2 border-color-a1 padding-10px-all pricing-features sm-padding-20px-all border-top border-width-2px">
                            <div class="pricing-action sm-no-margin-top">
                                <a href="<?php echo base_url('profile/companion_signup/gold'); ?>" class="btn btn-deep-purple btn-small text-small mon">Become a Member</a>
                            </div>
                        </div>
                        <!-- end pricing features -->
                    </div>
                </div>
                <!-- end pricing item -->
                <!-- start pricing item -->
                <div class="col-md-3 col-sm-6 col-xs-12 text-center sm-margin-30px-bottom wow fadeInUp" data-wow-delay="0.6s">
                    <div class="text-left pricing-lists">
                        <div class="golder-silver-members">
                            <p class="margin-5px-bottom list-heading"><strong class="font-weight-600">Perks:</strong> (Silver Members)</p>
                            <ul class="list-style-5 custom-list no-padding text-extra-small">
                                <li>
                                    Silver Membership Plan give you the
                                    Opportunity to earn extra income on 
                                    konsorts.com
                                </li>
                            </ul>
                        </div>

                        <span class="seperator price-seperater" ></span>
                        <div class="golder-silver-members">
                            <p class="margin-5px-bottom list-heading"><strong class="font-weight-600">Perks:</strong> (Gold Members)</p>
                            <ul class="list-style-5 custom-list no-padding text-extra-small">
                                <li>Gold Membership Plan entitles you to be seen first when searched by Guest Members and highlights you on our Home Page.</li>
                                <li>Travel Option - displays your profile in multiple cities.</li>
                                <li>Availability Option - allows you to display when you are Available.</li>
                            </ul>
                        </div>

                        <!-- end pricing features -->

                    </div>
                </div>
                <!-- end pricing item -->
            </div>
        </div>
    </div>
</section>

<section class="guide bg-light-gray margin-60px-tb no-padding">
    <div class="container">
        <!--first guide-->
        <div class="row margin-60px-tb">

            <div class="col-md-5 col-md-push-7  col-sm-6 col-sm-push-6 guide-media wow bounceInRight" data-wow-offset="200" data-wow-duration="2s" >
                <img src="<?php echo base_url('assets/frontend/'); ?>img/guide-1.jpg" alt="Tour Guide">
            </div>
            <div class="col-md-7 col-md-pull-5 col-sm-6 col-sm-pull-6 guide-text left-box roboto-cond wow bounceInLeft" data-wow-offset="200" data-wow-duration="2s" data-wow-delay="0s">
                <h1>Find your perfect fitness buddy</h1>
                <p>Do you wish you could find a buddy to keep you company during your favorite activities? Or are you an active fitness enthusiasts who would like to make some extra money doing what you love?</p>


                <h2>1. I’m looking for a fitness partner</h2>
                <p>If you’re looking for someone to do your favorite activity with, you can search for buddies who are offering the service you’re interested in.</p>
                <p>You become a guest member and gain access to our worldwide database, full of interesting new people to meet. When one of them piques your interest, you can message them and start a chat!</p>
                <h2>2. I want to be a fitness partner</h2>
                <p>If you’re looking to make extra money, sign up to be a buddy and become a part of our community!</p>

                <p>You’ll be able to earn a supplementary income doing something you’d be doing anyway - and you’ll be able to make new friends at the same time.</p>

                <a href="<?php echo base_url('find-perfect-buddy'); ?>" class="btn btn-deep-purple btn-small">See More</a>
            </div>
        </div>
        <!--second guide-->
        <div class="row padding-60px-tb">

            <div class="col-md-5 col-sm-6 guide-media wow bounceInLeft" data-wow-offset="200" data-wow-duration="2s">
                <img src="<?php echo base_url('assets/frontend/'); ?>img/guide-2.jpg" alt="Tour Guide">
            </div>

            <div class="col-md-7 col-sm-6 guide-text right-box roboto-cond wow bounceInRight" data-wow-offset="200" data-wow-duration="2s">
                <h1>The Rewards of Hosting a Traveling Nomad</h1>
                <p>Living in a family environment can help make the travel experience of wandering nomads feel at home and give them that sense of security in an unfamiliar and new place. </p>
                <h2>1. Homestay hosting as an ideal hospitality business. </h2>
                <p>Homestay hosting is one of the most popular forms of hospitality and travel lodging alternatives to host travelers wandering from places to places.</p>

                <h2>2. Benefits of Homestay Hosting:</h2>

                <ul class="list-style-1">
                    <li>You can make a dream come true.</li>
                    <li>It can help you widen your horizon.</li>
                    <li>You can gain a lasting international connection.</li>
                    <li>The chance to family guests from other parts of the world.</li>
                </ul>

                <a href="<?php echo base_url('rewards-hosting-traveling'); ?>" class="btn btn-deep-purple btn-small">See More</a>
            </div>

        </div>
        <!--        <div class="row margin-60px-tb">
                    <div class="col-md-7 guide-text left-box roboto-cond wow bounceInLeft" data-wow-offset="200" data-wow-duration="2s">
                        <h1>Coaching (Article 3)</h1>
        
                        <h2>1. Post your project</h2>
                        <p>It's always free to post your project. Invite our freelancers to submit bids, or browse relevant freelancers and make an offer. You'll have replies to your job within minutes!</p>
        
                        <h2>2. Choose the perfect freelancer</h2>
        
                        <ul class="list-style-1">
                            <li>Browse freelancer profiles</li>
                            <li>Chat in real-time</li>
                            <li>Compare proposals and select the best one</li>
                            <li>Award your project and your freelancer goes to work</li>
                        </ul>
        
                        <h2>3. Pay when you are satisfied!</h2>
                        <p>Pay safely using our Milestone Payment system - release payments according to a schedule of goals you set, or pay only upon completion. You are in control, so you get to make the decisions.</p>
                        <a href="#" class="btn btn-deep-purple btn-small">See More</a>
                    </div>
                    <div class="col-md-5 guide-media wow bounceInRight" data-wow-offset="200" data-wow-duration="2s">
                        <img src="<?php // echo base_url('assets/frontend/');                                                                                ?>img/guide-3.jpg" alt="">
                    </div>
                </div>-->

    </div>
</section>
<!-- BEGIN PAGE LEVEL PLUGINS -->
<script src="<?php echo base_url(); ?>assets/global/plugins/bootstrap-multiselect/js/bootstrap-multiselect.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>assets/pages/scripts/components-bootstrap-multiselect.js" type="text/javascript"></script>
<script src="//maps.googleapis.com/maps/api/js?key=AIzaSyDVw_YgvMUxH6KawXzlwM9meU3HAUnbsLQ&libraries=places&language=en"></script>
<script src="<?php echo base_url(); ?>assets/geocode/jquery.geocomplete.js" type="text/javascript"></script>
<script src="<?php echo base_url('assets/custom_scripts/frontend/searchmember.js'); ?>" type="text/javascript"></script>
<!-- END PAGE LEVEL PLUGINS -->
<script>
    $(document).ready(function () {
        SearchMember.validation_to_search();
    });
    $(function () {
        $("#location").geocomplete();
    });
</script>
<style>
    /*    .pac-container{
            top:800px !important;
        }*/
</style>