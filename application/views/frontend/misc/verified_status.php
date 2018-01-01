<section class="wow fadeIn faq-header cover-background background-position-top top-space">
    <div class="opacity-medium bg-purple "></div>
    <div class="container">
        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12 display-table page-title-large">
                <div class="display-table-cell vertical-align-middle text-center padding-30px-tb">
                    <!-- start sub title -->
                    <!--<span class="display-block text-white opacity6 width-45 sm-width-100 center-col alt-font margin-10px-bottom">Frequently asked questions</span>-->
                    <!-- end sub title -->
                    <!-- start page title -->
                    <h1 class="alt-font text-white font-weight-500 no-margin-bottom"><?php echo ( $verified ? 'Success!' : 'Error!'); ?></h1>
                    <!-- end page title -->
                </div>
            </div>
        </div>
    </div>
</section>
<section class="wow fadeIn parallax contact-us" data-stellar-background-ratio="0.5" style="background-image:url('<?php echo base_url('assets/frontend/img/konsorts-form-bg.jpg'); ?>');">
    <!--<div class="opacity-full bg-black"></div>-->
    <div class="container">
        <div class="row">
            <!-- start contact-form head -->
            <div class="col-lg-5 col-md-6 col-sm-6 col-xs-12 center-col padding-30px-bottom sm-margin-40px-bottom xs-margin-30px-bottom text-center">
                <h5 class="alt-font text-white font-weight-500"><?php echo ( $verified ? 'Email verified successfully. Your account is now under review by admin of konsorts.com and will be approved within 24 hours. All provided information should be correct for verified accounts. <a style="color:blue;" href="' . base_url('auth/login') . '">Click here</a> to go to login page. Thanks.' : 'Email verification code is invalid. <a href="' . base_url() . '">Click here</a> to go to home page.'); ?></h5>
            </div>
            <!-- end contact-form head -->
        </div>
        <!-- start contact-form -->

    </div>
</section>