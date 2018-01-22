<script src="//maps.googleapis.com/maps/api/js?key=AIzaSyDVw_YgvMUxH6KawXzlwM9meU3HAUnbsLQ&libraries=places&language=en"></script>
<script src="<?php echo base_url(); ?>assets/geocode/jquery.geocomplete.js" type="text/javascript"></script>
<script src="<?php echo base_url('assets/custom_scripts/frontend/searchmember.js'); ?>" type="text/javascript"></script>
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
                                <a href='<?php echo base_url('auth/register'); ?>' class='btn btn-purple-white-border open-sans'> I want to HIRE </a>
                                <a href='<?php echo base_url('auth/register'); ?>' class='btn btn-purple-white-border open-sans'> I want to WORK </a>

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
                                <div class="select-style select-medium">
                                    <select name="category_available" id="category_available" class="bg-transparent no-margin-bottom">
                                        <option value="">Available For:</option>
                                        <?php foreach ($categories_data as $catDataRow) { ?>
                                            <option value="<?php echo $catDataRow->category_id; ?>"><?php echo $catDataRow->category_name; ?></option>
                                        <?php } ?>
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
                                    <img src="<?php echo base_url('assets/frontend/'); ?>img/cat-1.jpg" alt="" />
                                    <div class="portfolio-icon">
                                        <a href="single-project-page-01.html">
                                            <i class="fa fa-link text-extra-dark-gray" aria-hidden="true"></i>
                                        </a>
                                    </div>
                                </div>
                                <figcaption class="bg-white">
                                    <div class="portfolio-hover-main text-center">
                                        <div class="portfolio-hover-box vertical-align-middle">
                                            <div class="portfolio-hover-content position-relative">
                                                <span class="line-height-normal font-weight-600 text-normal alt-font text-purple text-uppercase display-block">Fitness</span>
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
                                    <img src="<?php echo base_url('assets/frontend/'); ?>img/cat-2.jpg" alt="" />
                                    <div class="portfolio-icon">
                                        <a href="single-project-page-01.html">
                                            <i class="fa fa-link text-extra-dark-gray" aria-hidden="true"></i>
                                        </a>
                                    </div>
                                </div>
                                <figcaption class="bg-white">
                                    <div class="portfolio-hover-main text-center">
                                        <div class="portfolio-hover-box vertical-align-middle">
                                            <div class="portfolio-hover-content position-relative">
                                                <span class="line-height-normal font-weight-600 text-normal alt-font text-purple text-uppercase display-block">Tourism</span>
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
                                    <img src="<?php echo base_url('assets/frontend/'); ?>img/cat-3.jpg" alt="" />
                                    <div class="portfolio-icon">
                                        <a href="single-project-page-01.html">
                                            <i class="fa fa-link text-extra-dark-gray" aria-hidden="true"></i>
                                        </a>
                                    </div>
                                </div>
                                <figcaption class="bg-white">
                                    <div class="portfolio-hover-main text-center">
                                        <div class="portfolio-hover-box vertical-align-middle">
                                            <div class="portfolio-hover-content position-relative">
                                                <span class="line-height-normal font-weight-600 text-normal alt-font text-purple text-uppercase display-block">SOCIAL OCCASION</span>
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
                                    <img src="<?php echo base_url('assets/frontend/'); ?>img/cat-4.jpg" alt="" />
                                    <div class="portfolio-icon">
                                        <a href="single-project-page-01.html">
                                            <i class="fa fa-link text-extra-dark-gray" aria-hidden="true"></i>
                                        </a>
                                    </div>
                                </div>
                                <figcaption class="bg-white">
                                    <div class="portfolio-hover-main text-center">
                                        <div class="portfolio-hover-box vertical-align-middle">
                                            <div class="portfolio-hover-content position-relative">
                                                <span class="line-height-normal font-weight-600 text-normal alt-font text-purple text-uppercase display-block">COACHING</span>
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
                                    <img src="<?php echo base_url('assets/frontend/'); ?>img/cat-5.jpg" alt="" />
                                    <div class="portfolio-icon">
                                        <a href="single-project-page-01.html">
                                            <i class="fa fa-link text-extra-dark-gray" aria-hidden="true"></i>
                                        </a>
                                    </div>
                                </div>
                                <figcaption class="bg-white">
                                    <div class="portfolio-hover-main text-center">
                                        <div class="portfolio-hover-box vertical-align-middle">
                                            <div class="portfolio-hover-content position-relative">
                                                <span class="line-height-normal font-weight-600 text-normal alt-font text-purple text-uppercase display-block">Hosting</span>
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
                                    <img src="<?php echo base_url('assets/frontend/'); ?>img/cat-6.jpg" alt="" />
                                    <div class="portfolio-icon">
                                        <a href="single-project-page-01.html">
                                            <i class="fa fa-link text-extra-dark-gray" aria-hidden="true"></i>
                                        </a>
                                    </div>
                                </div>
                                <figcaption class="bg-white">
                                    <div class="portfolio-hover-main text-center">
                                        <div class="portfolio-hover-box vertical-align-middle">
                                            <div class="portfolio-hover-content position-relative">
                                                <span class="line-height-normal font-weight-600 text-normal alt-font text-purple text-uppercase display-block">EVENT PLANNING</span>
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
<section class="wow fadeIn gold-members">
    <div class="container">
        <p class="title-bar bg-purple text-white font-weight-600 text-center">
            <i class="fa fa-star"></i> Search Result
            <i class="fa fa-star"></i>
        </p>


        <div class="row">
            <div class="filter-content overflow-hidden xs-margin-15px-lr">
                <ul class="portfolio-grid work-6col gutter-large hover-option6 lightbox-portfolio">
                    <li class="grid-sizer"></li>

                    <!-- start portfolio item -->
                    <li class="grid-item wow fadeInUp last-paragraph-no-margin">
                        <div class="feature-box gold-box">
                            <div class="content">
                                <figure>
                                    <div class="portfolio-img  position-relative text-center overflow-hidden">
                                        <a href="#">
                                            <img src="<?php echo base_url('assets/frontend/'); ?>img/gold-1.jpg" alt="" />
                                        </a>
                                    </div>
                                    <figcaption class="">
                                        <div class="portfolio-hover-main text-center">
                                            <div class="portfolio-hover-box vertical-align-middle">
                                                <div class="portfolio-hover-content position-relative">
                                                    <span class="line-height-normal font-weight-600 display-block lato">Jessie </span>
                                                    <p class="">Branding and Identity</p>
                                                </div>
                                            </div>
                                        </div>
                                    </figcaption>
                                </figure>
                            </div>
                        </div>
                    </li>
                    <!-- end portfolio item -->
                    <!-- start portfolio item -->
                    <li class="grid-item wow fadeInUp last-paragraph-no-margin">
                        <div class="feature-box gold-box">
                            <div class="content">
                                <figure>
                                    <div class="portfolio-img  position-relative text-center overflow-hidden">
                                        <a href="#">
                                            <img src="<?php echo base_url('assets/frontend/'); ?>img/gold-2.jpg" alt="" />
                                        </a>
                                    </div>
                                    <figcaption class="">
                                        <div class="portfolio-hover-main text-center">
                                            <div class="portfolio-hover-box vertical-align-middle">
                                                <div class="portfolio-hover-content position-relative">
                                                    <span class="line-height-normal font-weight-600 display-block lato">Stephanie Rouse </span>
                                                    <p class="">Canada, Nottingham</p>
                                                </div>
                                            </div>
                                        </div>
                                    </figcaption>
                                </figure>
                            </div>
                        </div>
                    </li>
                    <!-- end portfolio item -->
                    <!-- start portfolio item -->
                    <li class="grid-item wow fadeInUp last-paragraph-no-margin">
                        <div class="feature-box gold-box">
                            <div class="content">
                                <figure>
                                    <div class="portfolio-img  position-relative text-center overflow-hidden">
                                        <a href="#">
                                            <img src="<?php echo base_url('assets/frontend/'); ?>img/gold-3.jpg" alt="" />
                                        </a>
                                    </div>
                                    <figcaption class="">
                                        <div class="portfolio-hover-main text-center">
                                            <div class="portfolio-hover-box vertical-align-middle">
                                                <div class="portfolio-hover-content position-relative">
                                                    <span class="line-height-normal font-weight-600 display-block lato">Michael Nunez </span>
                                                    <p class="">United States, Caseyville</p>
                                                </div>
                                            </div>
                                        </div>
                                    </figcaption>
                                </figure>
                            </div>
                        </div>
                    </li>
                    <!-- end portfolio item -->
                    <!-- start portfolio item -->
                    <li class="grid-item wow fadeInUp last-paragraph-no-margin">
                        <div class="feature-box gold-box">
                            <div class="content">
                                <figure>
                                    <div class="portfolio-img  position-relative text-center overflow-hidden">
                                        <a href="#">
                                            <img src="<?php echo base_url('assets/frontend/'); ?>img/gold-4.jpg" alt="" />
                                        </a>
                                    </div>
                                    <figcaption class="">
                                        <div class="portfolio-hover-main text-center">
                                            <div class="portfolio-hover-box vertical-align-middle">
                                                <div class="portfolio-hover-content position-relative">
                                                    <span class="line-height-normal font-weight-600 display-block lato">Robert Cruz </span>
                                                    <p class="">Belgium, Malimont</p>
                                                </div>
                                            </div>
                                        </div>
                                    </figcaption>
                                </figure>
                            </div>
                        </div>
                    </li>
                    <!-- end portfolio item -->
                    <!-- start portfolio item -->
                    <li class="grid-item wow fadeInUp last-paragraph-no-margin">
                        <div class="feature-box gold-box">
                            <div class="content">
                                <figure>
                                    <div class="portfolio-img  position-relative text-center overflow-hidden">
                                        <a href="#">
                                            <img src="<?php echo base_url('assets/frontend/'); ?>img/gold-5.jpg" alt="" />
                                        </a>
                                    </div>
                                    <figcaption class="">
                                        <div class="portfolio-hover-main text-center">
                                            <div class="portfolio-hover-box vertical-align-middle">
                                                <div class="portfolio-hover-content position-relative">
                                                    <span class="line-height-normal font-weight-600 display-block lato">Michelle </span>
                                                    <p class="">Argentina, Crespo</p>
                                                </div>
                                            </div>
                                        </div>
                                    </figcaption>
                                </figure>
                            </div>
                        </div>
                    </li>
                    <!-- end portfolio item -->
                    <!-- start portfolio item -->
                    <li class="grid-item wow fadeInUp last-paragraph-no-margin">
                        <div class="feature-box gold-box">
                            <div class="content">
                                <figure>
                                    <div class="portfolio-img  position-relative text-center overflow-hidden">
                                        <a href="#">
                                            <img src="<?php echo base_url('assets/frontend/'); ?>img/gold-6.jpg" alt="" />
                                        </a>
                                    </div>
                                    <figcaption class="">
                                        <div class="portfolio-hover-main text-center">
                                            <div class="portfolio-hover-box vertical-align-middle">
                                                <div class="portfolio-hover-content position-relative">
                                                    <span class="line-height-normal font-weight-600 display-block lato">Jordan Guzman </span>
                                                    <p class="">Costa Rica, Brasil</p>
                                                </div>
                                            </div>
                                        </div>
                                    </figcaption>
                                </figure>
                            </div>
                        </div>
                    </li>
                    <!-- end portfolio item -->
                    <!-- start portfolio item -->
                    <li class="grid-item wow fadeInUp last-paragraph-no-margin">
                        <div class="feature-box gold-box">
                            <div class="content">
                                <figure>
                                    <div class="portfolio-img  position-relative text-center overflow-hidden">
                                        <a href="#">
                                            <img src="<?php echo base_url('assets/frontend/'); ?>img/gold-7.jpg" alt="" />
                                        </a>
                                    </div>
                                    <figcaption class="">
                                        <div class="portfolio-hover-main text-center">
                                            <div class="portfolio-hover-box vertical-align-middle">
                                                <div class="portfolio-hover-content position-relative">
                                                    <span class="line-height-normal font-weight-600 display-block lato">Jessie </span>
                                                    <p class="">Branding and Identity</p>
                                                </div>
                                            </div>
                                        </div>
                                    </figcaption>
                                </figure>
                            </div>
                        </div>
                    </li>
                    <!-- end portfolio item -->
                    <!-- start portfolio item -->
                    <li class="grid-item wow fadeInUp last-paragraph-no-margin">
                        <div class="feature-box gold-box">
                            <div class="content">
                                <figure>
                                    <div class="portfolio-img  position-relative text-center overflow-hidden">
                                        <a href="#">
                                            <img src="<?php echo base_url('assets/frontend/'); ?>img/gold-2.jpg" alt="" />
                                        </a>
                                    </div>
                                    <figcaption class="">
                                        <div class="portfolio-hover-main text-center">
                                            <div class="portfolio-hover-box vertical-align-middle">
                                                <div class="portfolio-hover-content position-relative">
                                                    <span class="line-height-normal font-weight-600 display-block lato">Stephanie Rouse </span>
                                                    <p class="">Canada, Nottingham</p>
                                                </div>
                                            </div>
                                        </div>
                                    </figcaption>
                                </figure>
                            </div>
                        </div>
                    </li>
                    <!-- end portfolio item -->
                    <!-- start portfolio item -->
                    <li class="grid-item wow fadeInUp last-paragraph-no-margin">
                        <div class="feature-box gold-box">
                            <div class="content">
                                <figure>
                                    <div class="portfolio-img  position-relative text-center overflow-hidden">
                                        <a href="#">
                                            <img src="<?php echo base_url('assets/frontend/'); ?>img/gold-9.jpg" alt="" />
                                        </a>
                                    </div>
                                    <figcaption class="">
                                        <div class="portfolio-hover-main text-center">
                                            <div class="portfolio-hover-box vertical-align-middle">
                                                <div class="portfolio-hover-content position-relative">
                                                    <span class="line-height-normal font-weight-600 display-block lato">Michael Nunez </span>
                                                    <p class="">United States, Caseyville</p>
                                                </div>
                                            </div>
                                        </div>
                                    </figcaption>
                                </figure>
                            </div>
                        </div>
                    </li>
                    <!-- end portfolio item -->
                    <!-- start portfolio item -->
                    <li class="grid-item wow fadeInUp last-paragraph-no-margin">
                        <div class="feature-box gold-box">
                            <div class="content">
                                <figure>
                                    <div class="portfolio-img  position-relative text-center overflow-hidden">
                                        <a href="#">
                                            <img src="<?php echo base_url('assets/frontend/'); ?>img/gold-10.jpg" alt="" />
                                        </a>
                                    </div>
                                    <figcaption class="">
                                        <div class="portfolio-hover-main text-center">
                                            <div class="portfolio-hover-box vertical-align-middle">
                                                <div class="portfolio-hover-content position-relative">
                                                    <span class="line-height-normal font-weight-600 display-block lato">Robert Cruz </span>
                                                    <p class="">Belgium, Malimont</p>
                                                </div>
                                            </div>
                                        </div>
                                    </figcaption>
                                </figure>
                            </div>
                        </div>
                    </li>
                    <!-- end portfolio item -->
                    <!-- start portfolio item -->
                    <li class="grid-item wow fadeInUp last-paragraph-no-margin">
                        <div class="feature-box gold-box">
                            <div class="content">
                                <figure>
                                    <div class="portfolio-img  position-relative text-center overflow-hidden">
                                        <a href="#">
                                            <img src="<?php echo base_url('assets/frontend/'); ?>img/gold-11.jpg" alt="" />
                                        </a>
                                    </div>
                                    <figcaption class="">
                                        <div class="portfolio-hover-main text-center">
                                            <div class="portfolio-hover-box vertical-align-middle">
                                                <div class="portfolio-hover-content position-relative">
                                                    <span class="line-height-normal font-weight-600 display-block lato">Michelle </span>
                                                    <p class="">Argentina, Crespo</p>
                                                </div>
                                            </div>
                                        </div>
                                    </figcaption>
                                </figure>
                            </div>
                        </div>
                    </li>
                    <!-- end portfolio item -->
                    <!-- start portfolio item -->
                    <li class="grid-item wow fadeInUp last-paragraph-no-margin">
                        <div class="feature-box gold-box">
                            <div class="content">
                                <figure>
                                    <div class="portfolio-img  position-relative text-center overflow-hidden">
                                        <a href="#">
                                            <img src="<?php echo base_url('assets/frontend/'); ?>img/gold-12.jpg" alt="" />
                                        </a>
                                    </div>
                                    <figcaption class="">
                                        <div class="portfolio-hover-main text-center">
                                            <div class="portfolio-hover-box vertical-align-middle">
                                                <div class="portfolio-hover-content position-relative">
                                                    <span class="line-height-normal font-weight-600 display-block lato">Jordan Guzman </span>
                                                    <p class="">Costa Rica, Brasil</p>
                                                </div>
                                            </div>
                                        </div>
                                    </figcaption>
                                </figure>
                            </div>
                        </div>
                    </li>
                    <!-- end portfolio item -->
                    <!-- start portfolio item -->
                    <li class="grid-item wow fadeInUp last-paragraph-no-margin">
                        <div class="feature-box gold-box">
                            <div class="content">
                                <figure>
                                    <div class="portfolio-img  position-relative text-center overflow-hidden">
                                        <a href="#">
                                            <img src="<?php echo base_url('assets/frontend/'); ?>img/gold-13.jpg" alt="" />
                                        </a>
                                    </div>
                                    <figcaption class="">
                                        <div class="portfolio-hover-main text-center">
                                            <div class="portfolio-hover-box vertical-align-middle">
                                                <div class="portfolio-hover-content position-relative">
                                                    <span class="line-height-normal font-weight-600 display-block lato">Jessie </span>
                                                    <p class="">Branding and Identity</p>
                                                </div>
                                            </div>
                                        </div>
                                    </figcaption>
                                </figure>
                            </div>
                        </div>
                    </li>
                    <!-- end portfolio item -->
                    <!-- start portfolio item -->
                    <li class="grid-item wow fadeInUp last-paragraph-no-margin">
                        <div class="feature-box gold-box">
                            <div class="content">
                                <figure>
                                    <div class="portfolio-img  position-relative text-center overflow-hidden">
                                        <a href="#">
                                            <img src="<?php echo base_url('assets/frontend/'); ?>img/gold-14.jpg" alt="" />
                                        </a>
                                    </div>
                                    <figcaption class="">
                                        <div class="portfolio-hover-main text-center">
                                            <div class="portfolio-hover-box vertical-align-middle">
                                                <div class="portfolio-hover-content position-relative">
                                                    <span class="line-height-normal font-weight-600 display-block lato">Stephanie Rouse </span>
                                                    <p class="">Canada, Nottingham</p>
                                                </div>
                                            </div>
                                        </div>
                                    </figcaption>
                                </figure>
                            </div>
                        </div>
                    </li>
                    <!-- end portfolio item -->
                    <!-- start portfolio item -->
                    <li class="grid-item wow fadeInUp last-paragraph-no-margin">
                        <div class="feature-box gold-box">
                            <div class="content">
                                <figure>
                                    <div class="portfolio-img  position-relative text-center overflow-hidden">
                                        <a href="#">
                                            <img src="<?php echo base_url('assets/frontend/'); ?>img/gold-15.jpg" alt="" />
                                        </a>
                                    </div>
                                    <figcaption class="">
                                        <div class="portfolio-hover-main text-center">
                                            <div class="portfolio-hover-box vertical-align-middle">
                                                <div class="portfolio-hover-content position-relative">
                                                    <span class="line-height-normal font-weight-600 display-block lato">Michael Nunez </span>
                                                    <p class="">United States, Caseyville</p>
                                                </div>
                                            </div>
                                        </div>
                                    </figcaption>
                                </figure>
                            </div>
                        </div>
                    </li>
                    <!-- end portfolio item -->
                    <!-- start portfolio item -->
                    <li class="grid-item wow fadeInUp last-paragraph-no-margin">
                        <div class="feature-box gold-box">
                            <div class="content">
                                <figure>
                                    <div class="portfolio-img  position-relative text-center overflow-hidden">
                                        <a href="#">
                                            <img src="<?php echo base_url('assets/frontend/'); ?>img/gold-16.jpg" alt="" />
                                        </a>
                                    </div>
                                    <figcaption class="">
                                        <div class="portfolio-hover-main text-center">
                                            <div class="portfolio-hover-box vertical-align-middle">
                                                <div class="portfolio-hover-content position-relative">
                                                    <span class="line-height-normal font-weight-600 display-block lato">Robert Cruz </span>
                                                    <p class="">Belgium, Malimont</p>
                                                </div>
                                            </div>
                                        </div>
                                    </figcaption>
                                </figure>
                            </div>
                        </div>
                    </li>
                    <!-- end portfolio item -->
                    <!-- start portfolio item -->
                    <li class="grid-item wow fadeInUp last-paragraph-no-margin">
                        <div class="feature-box gold-box">
                            <div class="content">
                                <figure>
                                    <div class="portfolio-img  position-relative text-center overflow-hidden">
                                        <a href="#">
                                            <img src="<?php echo base_url('assets/frontend/'); ?>img/gold-17.jpg" alt="" />
                                        </a>
                                    </div>
                                    <figcaption class="">
                                        <div class="portfolio-hover-main text-center">
                                            <div class="portfolio-hover-box vertical-align-middle">
                                                <div class="portfolio-hover-content position-relative">
                                                    <span class="line-height-normal font-weight-600 display-block lato">Michelle </span>
                                                    <p class="">Argentina, Crespo</p>
                                                </div>
                                            </div>
                                        </div>
                                    </figcaption>
                                </figure>
                            </div>
                        </div>
                    </li>
                    <!-- end portfolio item -->
                    <!-- start portfolio item -->
                    <li class="grid-item wow fadeInUp last-paragraph-no-margin">
                        <div class="feature-box gold-box">
                            <div class="content">
                                <figure>
                                    <div class="portfolio-img  position-relative text-center overflow-hidden">
                                        <a href="#">
                                            <img src="<?php echo base_url('assets/frontend/'); ?>img/gold-18.jpg" alt="" />
                                        </a>
                                    </div>
                                    <figcaption class="">
                                        <div class="portfolio-hover-main text-center">
                                            <div class="portfolio-hover-box vertical-align-middle">
                                                <div class="portfolio-hover-content position-relative">
                                                    <span class="line-height-normal font-weight-600 display-block lato">Jordan Guzman </span>
                                                    <p class="">Costa Rica, Brasil</p>
                                                </div>
                                            </div>
                                        </div>
                                    </figcaption>
                                </figure>
                            </div>
                        </div>
                    </li>
                    <!-- end portfolio item -->
                </ul>

            </div>
        </div>


        <p class="title-bar bg-purple text-white font-weight-600 text-center">
            <i class="fa fa-star"></i> Search Result
            <i class="fa fa-star"></i>
        </p>

    </div>
</section>
<script src="<?php echo base_url(); ?>assets/global/plugins/bootstrap-wizard/jquery.bootstrap.wizard.min.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>assets/custom_scripts/frontend/companion-form-wizard.js" type="text/javascript"></script>
<script>
    $(document).ready(function () {
        SearchMember.validation_to_search();
    });
    $(function () {
        $("#location").geocomplete();
    });
</script>