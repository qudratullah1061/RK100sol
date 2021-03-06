<!doctype html>
<html class="no-js" lang="en">
    <head>
        <!-- Global site tag (gtag.js) - Google Analytics START -->
        <script async src="https://www.googletagmanager.com/gtag/js?id=UA-118719859-1"></script>
        <script>
            window.dataLayer = window.dataLayer || [];

            function gtag() {
                dataLayer.push(arguments);
            }

            gtag('js', new Date());

            gtag('config', 'UA-118719859-1');
        </script>
        <!-- Global site tag (gtag.js) - Google Analytics END -->
        <?php
        $title = "Konsorts - International Service Community";
        $description = "Konsorts is an international community of service providers.  We are a platform offering advertising space, support and security to members world wide.";
        //      categories start
        if ($this->selected_tab == "fitness") {
            $title = 'Konsorts - Fitness for a better life!';
            $description = 'Compare various personal fitness trainers in your area, search for a personal fitness trainer online.  Being a personal trainer allows you to free advertising.';
        } elseif ($this->selected_tab == "tourism") {
            $title = 'Konsorts - Tourism enriches your life!';
            $description = 'We promote experienced personal tour guides. Find the best tour guides or for travel assistance, we suggest a travel companion for hire for your next travel.';
        } elseif ($this->selected_tab == "social") {
            $title = 'Konsorts - Good company is enriching!';
            $description = 'We offer a variety of categories for social occasions, hire a chef.  Visiting?  Hire a dining companion or movie companion to get a local inside scoop!';
        } elseif ($this->selected_tab == "fashion") {
            $title = 'Konsorts - Look good, feel great!';
            $description = 'Why not hire a personal shopper or hire a shopping buddy?  A fashion consultant is well worth the money and saves time, especially when in a new city.';
        } elseif ($this->selected_tab == "hosting") {
            $title = 'Konsorts - Hosting is a hot travel trend';
            $description = 'Try a homestay host family on your next travel?   It is worth the security and most economical with a paid host family that host international guests.';
        } elseif ($this->selected_tab == "event") {
            $title = 'Konsorts - Peace of mind!';
            $description = 'Hire an event planner for a special day.  Event planners offer suggestions like best people to hire for wedding photography and much more.';
        } //        end
        elseif ($this->selected_tab == "blog") {
            $title = 'Konsorts - We Think Big!';
            $description = 'Our goal is to utilize our blog page as a tool to educate members and the general public about maximizing potential in the service industry.';
        } elseif ($this->selected_tab == "blog_detail") {
            $title = '' . $this->seo_title . '';
            $description = '' . $this->seo_description . '';
        } elseif ($this->selected_tab == "how_it_works") {
            $title = 'Konsorts -  Keeping it simple!';
            $description = 'Offer a service,  create a profile like you would a free classified Ad .  A guest members contacts you.   Perhaps a contract, your are in Business!';
        } elseif ($this->selected_tab == "earn_extra_cash") {
            $title = 'Konsorts -  Make Extra Money!';
            $description = 'A great forum for students, retired and those looking to earn extra cash.  Your passion may be a money machine.  Offer your services now.';
        } elseif ($this->selected_tab == "secure_community") {
            $title = 'Konsorts - Members need to be real!';
            $description = 'In order for a secure a safe community to thrive, every member must provide proof of identity by uploading photo identification.';
        } elseif ($this->selected_tab == "about") {
            $title = 'Konsorts -  Community that thinks big!';
            $description = 'Konsorts is continually expanding ideas to help others succeed.  Helping people grow through business is our Business!';
        } elseif ($this->selected_tab == "faq") {
            $title = 'Konsorts - Guest members are important!';
            $description = 'Every guest should be treated like royalty.  We hope to answer all questions related to services to better serve our guest members.';
        } elseif ($this->selected_tab == "terms") {
            $title = 'Konsorts - Rules ensure fairness!';
            $description = 'Our terms ensure normal behavior of members that ensure consistency.  We pride ourselves on being the best service platform on the internet.';
        } elseif ($this->selected_tab == "contact") {
            $title = 'Konsorts – We are ready to serve!';
            $description = 'Our office staff is always available to serve you and answer any questions you may have.  Kindly, contact us, if your service is not listed.';
        } elseif ($this->selected_tab == "login") {
            $title = 'Konsorts - Welcome to Konsorts Log In';
            $description = 'Difficulties logging on to your profile?  We will do our best to solve the issue.  You are very special to our community and are always welcome!';
        } elseif ($this->selected_tab == "register") {
            $title = 'Konsorts - Welcome to Konsorts!';
            $description = 'We pride ourselves on providing business support to our service members helping others become better service leaders in the industry.';
        } elseif ($this->selected_tab == "guest_signup") {
            $title = 'Konsorts - Guest Member Mission';
            $description = 'We believe that when you contract a service, you deserve to be treated just like a royal family member.  Excellent service is important!';
        } elseif ($this->selected_tab == "silver") {
            $title = 'Konsorts - Silver Service Members';
            $description = 'Thank You for choosing Konsorts to promote your business.  Our team supports you as you build new clientele, on a local or international level.';
        } elseif ($this->selected_tab == "gold") {
            $title = 'Konsorts - Gold Service Members';
            $description = 'Thank You for choosing Konsorts to promote your business.  Gold members are featured on our home page and on our special pages.';
        }
        ?>
        <!-- title -->
        <title><?php echo $title; ?></title>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
        <meta name="viewport" content="width=device-width,initial-scale=1.0,maximum-scale=1"/>
        <meta name="description" content="<?php echo $description; ?>">
        <!--meta link code start from here-->
        <meta property="og:title" content="Konsorts is a community of individuals offering services world wide.">
        <meta property="og:url" content="<?php echo base_url(); ?>">
        <meta property="og:type" content="website"/>
        <meta property="og:image" content="<?php echo base_url(); ?>assets/meta/FB-Cover-min.jpg">
        <meta property="og:description"
              content="Konsorts is a community of individuals offering services world wide. Welcome to konsorts.com and we wish you a very pleasant experience!">
        <meta name="twitter:card" content="summary_large_image">
        <meta name="twitter:site" content="<?php echo base_url(); ?>">
        <meta name="twitter:title" content="Community for Personal Trainers, Tour Guides and Platonic Companions!">
        <meta name="twitter:description"
              content="Konsorts is a community of individuals offering services world wide. Welcome to konsorts.com and we wish you a very pleasant experience!">
        <meta name="twitter:image" content="<?php echo base_url(); ?>assets/meta/FB-Cover-min.jpg">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
        <!--meta link code ends here-->
        <!-- favicon -->
        <script>
            var base_url = "<?php echo base_url(); ?>";
        </script>
        <link rel="shortcut icon" href="<?php echo base_url('assets/favicon.png'); ?>">
        <link rel="apple-touch-icon" href="<?php echo base_url('assets/frontend/'); ?>images/apple-touch-icon-57x57.png">
        <link rel="apple-touch-icon" sizes="72x72"
              href="<?php echo base_url('assets/frontend/'); ?>images/apple-touch-icon-72x72.png">
        <link rel="apple-touch-icon" sizes="114x114"
              href="<?php echo base_url('assets/frontend/'); ?>images/apple-touch-icon-114x114.png">
        <!-- animation -->
        <link rel="stylesheet" href="<?php echo base_url('assets/frontend/'); ?>css/animate.css"/>
        <!-- bootstrap -->
        <link rel="stylesheet" href="<?php echo base_url('assets/frontend/'); ?>css/bootstrap.min.css"/>
        <!-- et line icon -->
        <link rel="stylesheet" href="<?php echo base_url('assets/frontend/'); ?>css/et-line-icons.css"/>
        <!-- font-awesome icon -->
        <link rel="stylesheet" href="<?php echo base_url('assets/frontend/'); ?>css/font-awesome.min.css"/>
        <!-- web fonts -->
        <link href="https://fonts.googleapis.com/css?family=Lato:100,100i,300,300i,400,400i,700,700i,900,900i|Montserrat:100,100i,200,200i,300,300i,400,400i,500,500i,600,600i,700,700i,900|Open+Sans:300,300i,400,400i,600,600i,700,700i,800,800i"
              rel="stylesheet">
        <link href="https://fonts.googleapis.com/css?family=Roboto:300,300i,400,400i,500,700,900" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css?family=Raleway:200,300,400,500,600,700,800,900" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css?family=Roboto+Condensed:300,400,700" rel="stylesheet">
        <!-- themify icon -->
        <link rel="stylesheet" href="<?php echo base_url('assets/frontend/'); ?>css/themify-icons.css">
        <!-- swiper carousel -->
        <link rel="stylesheet" href="<?php echo base_url('assets/frontend/'); ?>css/swiper.min.css">
        <!-- justified gallery  -->
        <link rel="stylesheet" href="<?php echo base_url('assets/frontend/'); ?>css/justified-gallery.min.css">
        <!-- magnific popup -->
        <link rel="stylesheet" href="<?php echo base_url('assets/frontend/'); ?>css/magnific-popup.css"/>
        <!-- revolution slider -->
        <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/frontend/'); ?>revolution/css/settings.css"
              media="screen"/>
        <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/frontend/'); ?>revolution/css/layers.css">
        <link rel="stylesheet" type="text/css"
              href="<?php echo base_url('assets/frontend/'); ?>revolution/css/navigation.css">
        <!-- bootsnav -->
        <link rel="stylesheet" href="<?php echo base_url('assets/frontend/'); ?>css/bootsnav.css">
        <link rel="stylesheet" href="<?php echo base_url('assets/frontend/'); ?>css/jquery.rateyo.min.css">
        <!-- style -->
        <link rel="stylesheet" href="<?php echo base_url('assets/frontend/'); ?>css/style.css"/>
        <link rel="stylesheet" href="<?php echo base_url('assets/frontend/'); ?>css/login.css"/>
        <!--[if IE]>
        <script src="<?php echo base_url('assets/frontend/'); ?>js/html5shiv.js"></script>
        <![endif]-->

        <!--Q included files start-->
        <!--dropzone css start-->
        <link href="<?php echo base_url(); ?>assets/global/plugins/dropzone/dropzone.min.css" rel="stylesheet"
              type="text/css"/>
        <link href="<?php echo base_url(); ?>assets/global/plugins/dropzone/basic.min.css" rel="stylesheet"
              type="text/css"/>
        <!--dropzone css ends-->
        <!--sweet alert start-->
        <link href="<?php echo base_url(); ?>assets/global/plugins/bootstrap-sweetalert/sweetalert.css" rel="stylesheet"
              type="text/css"/>
        <!--sweet alert ends-->
        <!-- BEGIN datepicker-->
        <!--<link href="<?php // echo base_url();                                                                                                                                                                       ?>assets/global/plugins/bootstrap-datepicker/css/bootstrap-datepicker3.min.css" rel="stylesheet" type="text/css" />-->
        <!--datepicker ends-->
        <!--select2 start-->
        <link href="<?php echo base_url(); ?>assets/global/plugins/select2/css/select2.min.css" rel="stylesheet"
              type="text/css"/>
        <link href="<?php echo base_url(); ?>assets/global/plugins/select2/css/select2-bootstrap.min.css" rel="stylesheet"
              type="text/css"/>
        <!--select2 ends-->
        <!--toaster start-->
        <link href="<?php echo base_url(); ?>assets/global/plugins/bootstrap-toastr/toastr.min.css" rel="stylesheet"
              type="text/css"/>
        <!--toaster ends-->
        <!-- BEGIN THEME GLOBAL STYLES Metronic-->
        <link href="<?php echo base_url(); ?>assets/frontend/css/components_metronic.css" id="style_components"
              rel="stylesheet" type="text/css"/>
        <link href="<?php echo base_url(); ?>assets/global/css/plugins.min.css" rel="stylesheet" type="text/css"/>
        <link href="<?php echo base_url(); ?>assets/global/plugins/bootstrap-modal/css/bootstrap-modal-bs3patch.css"
              rel="stylesheet" type="text/css"/>
        <link href="<?php echo base_url(); ?>assets/global/plugins/bootstrap-modal/css/bootstrap-modal.css" rel="stylesheet"
              type="text/css"/>
        <!-- responsive css -->
        <!--Q included files emds-->

        <link rel="stylesheet" href="<?php echo base_url('assets/frontend/'); ?>css/responsive.css"/>
        <link rel="stylesheet" href="<?php echo base_url('assets/frontend/'); ?>css/custom.css"/>
        <!--jquery start-->
        <script type="text/javascript" src="<?php echo base_url('assets/frontend/'); ?>js/jquery.js"></script>
        <!--jquery ends-->
        <link href="<?php echo base_url(); ?>assets/global/plugins/jquery-ui/jquery-ui.min.css" rel="stylesheet"
              type="text/css"/>
        <script src="<?php echo base_url(); ?>assets/global/plugins/jquery-ui/jquery-ui.min.js" type="text/javascript"></script>
        <!-- Facebook Pixel Code -->
        <script>
            !function (f, b, e, v, n, t, s) {
                if (f.fbq)
                    return;
                n = f.fbq = function () {
                    n.callMethod ?
                            n.callMethod.apply(n, arguments) : n.queue.push(arguments)
                };
                if (!f._fbq)
                    f._fbq = n;
                n.push = n;
                n.loaded = !0;
                n.version = '2.0';
                n.queue = [];
                t = b.createElement(e);
                t.async = !0;
                t.src = v;
                s = b.getElementsByTagName(e)[0];
                s.parentNode.insertBefore(t, s)
            }(window, document, 'script',
                    'https://connect.facebook.net/en_US/fbevents.js');
            fbq('init', '121119488565870');
            fbq('track', 'PageView');
<?php
if (isset($registration_completed) && $registration_completed) {
    ?>
                fbq('track', 'CompleteRegistration');
    <?php
}
?>
        </script>
        <noscript>
    <img height="1" width="1"
         src="https://www.facebook.com/tr?id=121119488565870&ev=PageView
         &noscript=1"/>
    </noscript>
    <!-- End Facebook Pixel Code -->
</head>

<body>
    <!-- start header -->
    <header class="header-with-topbar">
        <!-- topbar -->

        <!-- end topbar -->
        <!-- start navigation -->
        <nav class="navbar navbar-default bootsnav navbar-fixed-top header-light bg-white  on no-full">
            <div class="container nav-header-container">
                <div class="row">
                    <!-- start logo -->
                    <div class="col-md-2 col-xs-5">
                        <a href="<?php echo base_url('home'); ?>" title="Konsorts" class="logo">
                            <img src="<?php echo base_url('assets/frontend/img/logo.png'); ?>"
                                 data-at2x="<?php echo base_url('assets/frontend/img/logo.png'); ?>" class="logo-dark"
                                 alt="Konsorts">
                            <img src="<?php echo base_url('assets/frontend/img/logo.png'); ?>"
                                 data-at2x="<?php echo base_url('assets/frontend/img/logo.png'); ?>" alt="Konsorts"
                                 class="logo-light default">
                        </a>
                    </div>
                    <!-- end logo -->
                    <div class="col-md-7 col-xs-2 width-auto pull-right accordion-menu">
                        <button type="button" class="navbar-toggle collapsed pull-right" data-toggle="collapse"
                                data-target="#navbar-collapse-toggle-1">
                            <span class="sr-only">toggle navigation</span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                        </button>
                        <div class="navbar-collapse collapse pull-right" id="navbar-collapse-toggle-1">
                            <ul id="accordion" class="nav navbar-nav navbar-left no-margin text-normal" data-in="fadeIn"
                                data-out="fadeOut">
                                <!-- start menu item -->
                                <li class="<?php echo ActivateLink('home'); ?>">
                                    <a href="<?php echo base_url(); ?>">Home</a>
                                </li>
                                <li class="<?php echo ActivateLink('about'); ?>">
                                    <a href="<?php echo base_url('about'); ?>">About</a>
                                </li>
                                <!--                                    <li class="<?php // echo ActivateLink('services');                                                                                                                                                         ?>">
                                        <a href="javascript:void(0);">Our Services</a>
                                    </li>-->
                                <li class="<?php echo ActivateLink('blog'); ?>">
                                    <a href="<?php echo base_url('blogs'); ?>" title="Blog">Blog</a>
                                </li>
                                <li class="<?php echo ActivateLink('contact'); ?>">
                                    <a href="<?php echo base_url('contact'); ?>">Contact Us</a>
                                </li>
                                <?php if (!isset($this->session->userdata['member_id'])) { ?>
                                    <li class="dropdown megamenu-fw <?php echo ActivateLink('login'); ?>">
                                        <a href="<?php echo base_url('login'); ?>">Log in</a>
                                        <!--<i class="fa fa-angle-down dropdown-toggle" data-toggle="dropdown" aria-hidden="true"></i>-->
                                        <!-- start sub menu -->
                                    </li>
                                    <li class="<?php echo ActivateLink('signup'); ?>">
                                        <div class="signup-link">
                                            <a href="<?php echo base_url('register'); ?>"
                                               class="btn btn-small btn-deep-purple lato font-weight-700"> SIGN UP </a>
                                        </div>

                                    </li>
                                <?php } else { ?>
                                    <li class="show-xs"><a href="<?php echo base_url('member/profile'); ?>"> Profile</a>
                                    </li>
                                    <li class="show-xs"><a
                                            href="<?php echo base_url(($this->session->userdata['member_info']['member_type'] == 1 ? 'guests/get_guest_profile' : 'companions/get_companion_profile')); ?>">
                                            Settings</a></li>
                                    <li class="show-xs"><a href="<?php echo base_url('chat/view_chat_list'); ?>"> Chat</a>
                                    </li>
                                    <li class="show-xs"><a href="<?php echo base_url('auth/logout'); ?>"> Log out</a></li>
                                    <?php
                                }
                                ?>
                            </ul>
                        </div>
                    </div>
                    <?php
                    if (isset($this->session->userdata['member_id'])) {
                        $notifications = get_notifications(1, $this->session->userdata['member_id'], 0);
                        $connections = GetConnectionsForUser($this->session->userdata['member_id'], $this->session->userdata('member_type'));
                        ?>
                        <div class="col-md-2 col-xs-5 width-auto header-right">
                            <div class="header-searchbar">
                                <div class="dropdown dropdown-extended dropdown-notification" id="header_notification_bar">
                                    <a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown"
                                       data-hover="dropdown" data-close-others="true">
                                        <i class="fa fa-bell-o"></i>
                                        <?php if (count($notifications) > 0) { ?>
                                            <span class="badge badge-default"><?php echo count($notifications); ?></span>
                                        <?php } ?>
                                    </a>
                                    <ul class="dropdown-menu">
                                        <li class="external">
                                            <h3>
                                                <span class="bold"><?php echo count($notifications); ?> pending</span>
                                                notifications
                                            </h3>
                                            <a href="<?php echo base_url('notifications/view_notifications'); ?>">View All</a>
                                        </li>
                                        <li>
                                            <ul class="dropdown-menu-list scroller" data-height="250" data-handle-color="#637283">
                                                <?php foreach ($notifications as $notification) { ?>
                                                    <li>
                                                        <a href="<?php echo base_url('notifications/view_notifications/' . $notification['notification_user_id']); ?>">
                                                            <span class="time"><?php echo time_elapsed_string($notification['updated_on']); ?></span>
                                                            <span class="details">
                                                                <span class="label label-sm label-icon label-success">
                                                                    <i class="fa fa-plus"></i>
                                                                </span> <?php echo substr($notification['notification_title'], 0, 9); ?><?php echo(strlen($notification['notification_title']) > 10 ? '...' : ''); ?> </span>
                                                        </a>
                                                    </li>
                                                <?php } ?>
                                            </ul>
                                        </li>
                                    </ul>
                                </div>
                                <div class="dropdown dropdown-extended dropdown-inbox" id="header_inbox_bar">
                                    <a href="<?php echo site_url('chat/view_chat_list') ?>">
                                        <i class="fa fa-envelope-o"></i>
                                        <span class="badge badge-default messages-count"></span>
                                    </a>
                                </div>
                                <?php
                                if (count($connections) > 0) {
                                    ?>
                                    <div class="dropdown dropdown-extended dropdown-inbox" id="header_connection_bar">
                                        <a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">
                                            <i class="fa fa-user-plus"></i>
                                            <?php
                                            $text = 'Connection';
                                            if (count($connections) > 1) {
                                                $text = 'Connections';
                                            }
                                            ?>
                                        </a>
                                        <ul class="dropdown-menu">
                                            <li class="external">
                                                <h3>You have <span class="bold"><?php echo count($connections) ?></span> <?php echo $text; ?>
                                                </h3>
                                                <a href="<?php echo site_url('member/connections') ?>">View All</a>
                                            </li>
                                            <li>
                                                <ul class="dropdown-menu-list scroller" data-height="250"
                                                    data-handle-color="#637283">
                                                        <?php foreach ($connections as $connection) { ?>
                                                        <li>
                                                            <a href="<?php echo site_url('member/connections#connection' . $connection['id']) ?>">
                                                                <span class="subject" style="margin-left: 0;">
                                                                    <span class="from">
                                                                        <?php
                                                                        if ($connection['status'] == 0) {
                                                                            if ($this->session->userdata('member_type') == 1) {
                                                                                echo 'New Connection Request sent ' . $connection['first_name'] . ' ' . $connection['last_name'];
                                                                            } else {
                                                                                echo 'New Connection Request from ' . $connection['first_name'] . ' ' . $connection['last_name'];
                                                                            }
                                                                        } elseif ($connection['status'] == 1) {
                                                                            echo 'You are connected with ' . $connection['first_name'] . ' ' . $connection['last_name'];
                                                                        } else {
                                                                            if ($this->session->userdata('member_type') == 1) {
                                                                                echo $connection['first_name'] . ' ' . $connection['last_name'] . ' have rejected your connection request.';
                                                                            } else {
                                                                                echo 'You have rejected the connection request from ' . $connection['first_name'] . ' ' . $connection['last_name'];
                                                                            }
                                                                        }
                                                                        ?>
                                                                    </span>
                                                                </span>
                                                                <span class="time"><?php echo time_elapsed_string($connection['created_at']); ?></span>
                                                            </a>
                                                        </li>
                                                    <?php }
                                                    ?>
                                                </ul>
                                            </li>
                                        </ul>
                                    </div>
                                <?php } ?>
                            </div>
                            <div class="dropdown">
                                <a type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true"
                                   aria-expanded="true">
                                    <img src="<?php echo $this->session->userdata['member_info']['image'] != '' && file_exists($this->config->item('root_path') . 'uploads/member_images/profile/' . $this->session->userdata['member_info']['image']) ? base_url($this->session->userdata['member_info']['image_path'] . $this->session->userdata['member_info']['image']) : base_url('uploads/member_images/profile/profile.png'); ?>"
                                         alt="">
                                         <?php echo $this->session->userdata['member_info']['first_name']; ?>
                                    <span class="fa fa-angle-down"></span>
                                </a>
                                <ul class="dropdown-menu" aria-labelledby="dropdownMenu1">
                                    <li><a href="<?php echo base_url('member/profile'); ?>"><i class="fa fa-user"></i>
                                            Profile</a></li>
                                    <li>
                                        <a href="<?php echo base_url(($this->session->userdata['member_info']['member_type'] == 1 ? 'guests/get_guest_profile' : 'companions/get_companion_profile')); ?>"><i class="fa fa-gear"></i> Settings</a></li>
                                    <li><a href="<?php echo base_url('auth/logout'); ?>"><i class="fa fa-sign-out"></i> Logout</a></li>
                                </ul>
                            </div>
                        </div>
                    <?php } ?>
                    <!-- <div class="col-md-2 col-xs-5 width-auto">
                        <div class="header-searchbar">
                            <a href="#search-header" class="header-search-form text-white">
                                <i class="fa fa-search search-button"></i>
                            </a>
    
                            <form id="search-header" method="post" action="search-result.html" name="search-header" class="mfp-hide search-form-result">
                                <div class="search-form position-relative">
                                    <button type="submit" class="fa fa-search close-search search-button"></button>
                                    <input type="text" name="search" class="search-input" placeholder="Enter your keywords..." autocomplete="off">
                                </div>
                            </form>
                        </div>
                        <div class="heder-menu-button sm-display-none">
                            <button class="navbar-toggle mobile-toggle right-menu-button" type="button" id="showRightPush">
                                <span></span>
                                <span></span>
                                <span></span>
                            </button>
                        </div>
                    </div> -->
                </div>
            </div>
        </nav>
        <!-- end navigation -->
    </header>
    <!-- end header -->
    {_yield}
    <!-- start footer -->
    <footer class="footer-standard bg-light-gray">
        <div class="footer-widget-area ">
            <div class="container">
                <div class="translater-wrapper">
                    <div class="translater-icon">
                        <i class="fa fa-google-plus-square"></i>
                        <i class="fa fa-angle-double-right"></i>
                    </div>
                    <div id="google_translate_element"></div>
                </div>

                <div class="row equalize xs-equalize-auto footer-top">
                    <div class="col-md-3 col-sm-6 col-xs-12 widget sm-margin-20px-bottom xs-text-center">
                        <a href="index.html" class="margin-15px-bottom display-inline-block"><img class="footer-logo"
                                                                                                  src="<?php echo base_url('assets/frontend/'); ?>img/logo.png"
                                                                                                  alt="Konsorts"></a>
                        <p class=" margin-0">Konsorts is a community of individuals offering personal services world wide,
                            like: Personal trainers, tour guides, international hosts, personal shoppers and many other
                            platonic services.</p>
                        <a href="<?php echo base_url('about'); ?>" class="text-purple font-weight-400 more-details">More
                            Details</a>
                    </div>
                    <!-- start additional links -->
                    <div class="col-md-2 col-sm-3 col-xs-6 min-height-140 widget sm-margin-20px-bottom xs-text-center padding-70px-left sm-padding-left-0">
                        <div class="widget-title">Konsorts</div>
                        <ul class="list-unstyled">
                            <li><a href="<?php echo base_url('home'); ?>">Home</a></li>
                            <li><a href="<?php echo base_url('about'); ?>">About</a></li>
                            <!--<li><a href="">Our Services</a></li>-->
                            <li><a href="<?php echo base_url('blogs'); ?>">Blogs</a></li>
                            <li><a href="<?php echo base_url('contact'); ?>">Contact Us</a></li>
                        </ul>
                    </div>
                    <!-- end additional links -->
                    <!-- start contact information -->
                    <div class="col-md-2 col-sm-3 col-xs-6 min-height-140  widget sm-margin-20px-bottom xs-text-center padding-70px-left sm-padding-left-0">
                        <div class="widget-title">About</div>
                        <ul class="list-unstyled">
                            <li><a href="<?php echo base_url('about'); ?>">About us</a></li>
                            <li><a href="<?php echo base_url('how-it-works'); ?>">How it Works</a></li>
                            <li><a href="<?php echo base_url('secure-community') ?>">Security</a></li>
                        </ul>
                    </div>
                    <!-- end contact information -->
                    <!-- start instagram -->
                    <div class="col-md-3 col-sm-3 col-xs-6  widget sm-margin-20px-bottom xs-text-center  padding-70px-left sm-padding-left-0">
                        <div class="widget-title">Terms</div>
                        <ul class="list-unstyled">
                            <li><a href="<?php echo base_url('terms'); ?>">Terms and Conditions</a></li>
                        </ul>
                    </div>
                    <div class="col-md-2 col-sm-3 col-xs-6 widget sm-margin-20px-bottom xs-text-center">
                        <div class="widget-title">Support</div>
                        <ul class="list-unstyled">
                            <li><a href="<?php echo base_url('faqs'); ?>">Faq</a></li>
                        </ul>
                    </div>
                    <!-- end instagram -->
                </div>

                <div class="padding-10px-tb xs-padding-20px-tb border-bottom border-top  footer-mid">

                    <div class="row">
                        <!-- start copyright -->
                        <?php $admin_info = GetAdminInfoWithId(1); ?>
                        <div class="col-md-6 col-sm-5 col-xs-12 text-left text-small xs-text-center">
                            <div class="social-icon-style-8 display-inline-block vertical-align-middle">
                                <ul class="small-icon no-margin-bottom">
                                    <li><span> Follow Us:</span></li>
                                    <li class="enabled"><a
                                            href="<?php echo isset($admin_info['facebook_link']) ? $admin_info['facebook_link'] : ""; ?>"><i
                                                class="fa fa-facebook-square"></i></a></li>
                                <!--<li class="enabled"><a href="<?php // echo isset($admin_info[0]['youtube_link']) ? $admin_info[0]['youtube_link'] : "";                                                                                                                                                                       ?>"><i class="fa fa-youtube-square"></i></a></li>-->
                                    <li>
                                        <a href="<?php echo isset($admin_info['linkedin_link']) ? $admin_info['linkedin_link'] : ""; ?>"><i
                                                class="fa fa-linkedin-square"></i></a></li>
                                <!--<li><a href="<?php // echo isset($admin_info[0]['facebook_link']) ? $admin_info[0]['google_link'] : "";                                                                                                                                                                       ?>"><i class="fa fa-google-plus-square"></i></a></li>-->
                                    <li class="enabled"><a
                                            href="<?php echo isset($admin_info['twitter_link']) ? $admin_info['twitter_link'] : ""; ?>"><i
                                                class="fa fa-twitter-square"></i></a></li>
                                    <li>
                                        <a href="<?php echo isset($admin_info['instagram_link']) ? $admin_info['instagram_link'] : ""; ?>"><i
                                                class="fa fa-instagram"></i></a></li>
                                </ul>
                            </div>
                        </div>
                        <div class="col-md-6 col-sm-7 col-xs-12 text-right text-small xs-text-center">
                            <form class="form-inline" id="form-add-newsletter">
                                <div class="form-group">
                                    <label for="email">Newsletter:</label>
                                    <input type="email" name="newsletter_email" class="form-control placeholder-83"
                                           id="newsletter_email" placeholder="Email">
                                </div>
                                <button type="submit" class="btn btn-deep-purple btn-small">Submit</button>
                            </form>
                        </div>
                        <!-- end copyright -->
                    </div>
                </div>
                <div class="copyright  footer-btm">
                    <p>Please read carefully our <a href="<?php echo base_url('terms'); ?>">Terms and Conditions</a>. </p>
                    <p>Copyright © 2016 - 2017 konsorts.com | All rights reserved.</p>
                </div>
            </div>
        </div>
        <!--@*Modal Start*@-->
        <div id="static-modal-popup" class="modal fade" data-width="70%" tabindex="-1" data-backdrop="static"
             data-keyboard="false"></div>
        <!--@*Modal End*@-->
        <!--@*Medium Modal Start*@-->
        <div id="static-modal-popup-medium" class="modal fade" data-width="45%" tabindex="-1" data-backdrop="static"
             data-keyboard="false"></div>
        <div id="static-modal-popup-connect" class="modal fade" data-width="45%" tabindex="-1" data-backdrop="static"
             data-keyboard="false">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                <h4 class="modal-title">Connection Request</h4>
            </div>
            <div class="modal-body">
                <div class="portlet-body">
                    <p>Are you sure you want to send connection request to this service member?</p>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn default" data-dismiss="modal">No</button>
                <button type="button" class="btn default" id="sendRequest" onclick="CommonFunctions.send_request(this);">
                    Yes
                </button>
            </div>
        </div>
        <!--@*Medium Modal End*@-->
        <!--@*Small Modal Start*@-->
        <div id="static-modal-popup-small" class="modal fade" tabindex="-1" data-backdrop="static"
             data-keyboard="false"></div>
        <!--@*Modal End*@-->
    </footer>

    <!-- end banner -->
    <!-- start scroll to top -->
    <a class="scroll-top-arrow" href="javascript:void(0);">
        <i class="ti-arrow-up"></i>
    </a>
    <!-- end scroll to top  -->
    <!-- javascript libraries -->

    <script type="text/javascript" src="<?php echo base_url('assets/frontend/'); ?>js/modernizr.js"></script>
    <script type="text/javascript" src="<?php echo base_url('assets/frontend/'); ?>js/bootstrap.min.js"></script>
    <script type="text/javascript" src="<?php echo base_url('assets/frontend/'); ?>js/jquery.easing.1.3.js"></script>
    <script type="text/javascript" src="<?php echo base_url('assets/frontend/'); ?>js/skrollr.min.js"></script>
    <script type="text/javascript" src="<?php echo base_url('assets/frontend/'); ?>js/smooth-scroll.js"></script>
    <script type="text/javascript" src="<?php echo base_url('assets/frontend/'); ?>js/jquery.appear.js"></script>
    <!-- menu navigation -->
    <script type="text/javascript" src="<?php echo base_url('assets/frontend/'); ?>js/bootsnav.js"></script>
    <script type="text/javascript" src="<?php echo base_url('assets/frontend/'); ?>js/jquery.nav.js"></script>
    <!-- animation -->
    <script type="text/javascript" src="<?php echo base_url('assets/frontend/'); ?>js/wow.min.js"></script>
    <!-- page scroll -->
    <script type="text/javascript" src="<?php echo base_url('assets/frontend/'); ?>js/page-scroll.js"></script>
    <!-- swiper carousel -->
    <script type="text/javascript" src="<?php echo base_url('assets/frontend/'); ?>js/swiper.min.js"></script>
    <!-- counter -->
    <script type="text/javascript" src="<?php echo base_url('assets/frontend/'); ?>js/jquery.count-to.js"></script>
    <!-- parallax -->
    <script type="text/javascript" src="<?php echo base_url('assets/frontend/'); ?>js/jquery.stellar.js"></script>
    <!-- magnific popup -->
    <script type="text/javascript"
    src="<?php echo base_url('assets/frontend/'); ?>js/jquery.magnific-popup.min.js"></script>
    <!-- portfolio with shorting tab -->
    <script type="text/javascript" src="<?php echo base_url('assets/frontend/'); ?>js/isotope.pkgd.min.js"></script>
    <!-- images loaded -->
    <script type="text/javascript" src="<?php echo base_url('assets/frontend/'); ?>js/imagesloaded.pkgd.min.js"></script>
    <!-- pull menu -->
    <script type="text/javascript" src="<?php echo base_url('assets/frontend/'); ?>js/classie.js"></script>
    <script type="text/javascript" src="<?php echo base_url('assets/frontend/'); ?>js/hamburger-menu.js"></script>
    <!-- counter  -->
    <script type="text/javascript" src="<?php echo base_url('assets/frontend/'); ?>js/counter.js"></script>
    <!-- fit video  -->
    <script type="text/javascript" src="<?php echo base_url('assets/frontend/'); ?>js/jquery.fitvids.js"></script>
    <!-- equalize -->
    <script type="text/javascript" src="<?php echo base_url('assets/frontend/'); ?>js/equalize.min.js"></script>
    <!-- skill bars  -->
    <script type="text/javascript" src="<?php echo base_url('assets/frontend/'); ?>js/skill.bars.jquery.js"></script>
    <!-- justified gallery  -->
    <script type="text/javascript" src="<?php echo base_url('assets/frontend/'); ?>js/justified-gallery.min.js"></script>
    <!--pie chart-->
    <script type="text/javascript" src="<?php echo base_url('assets/frontend/'); ?>js/jquery.easypiechart.min.js"></script>
    <!-- instagram -->
    <script type="text/javascript" src="<?php echo base_url('assets/frontend/'); ?>js/instafeed.min.js"></script>
    <!-- retina -->
    <script type="text/javascript" src="<?php echo base_url('assets/frontend/'); ?>js/retina.min.js"></script>
    <!-- revolution -->
    <script type="text/javascript"
    src="<?php echo base_url('assets/frontend/'); ?>revolution/js/jquery.themepunch.tools.min.js"></script>
    <script type="text/javascript"
    src="<?php echo base_url('assets/frontend/'); ?>revolution/js/jquery.themepunch.revolution.min.js"></script>
    <script type="text/javascript" src="<?php echo base_url('assets/frontend/'); ?>js/jquery.rateyo.min.js"></script>
    <script type="text/javascript" src="<?php echo base_url('assets/frontend/'); ?>js/login.js"></script>
    <script type="text/javascript" src="<?php echo base_url('assets/frontend/'); ?>js/main.js"></script>
    <!--Q included files start-->
    <!--Form Validation start-->
    <script src="<?php echo base_url(); ?>assets/global/plugins/jquery-validation/js/jquery.validate.min.js"
    type="text/javascript"></script>
    <script src="<?php echo base_url(); ?>assets/global/plugins/jquery-validation/js/additional-methods.min.js"
    type="text/javascript"></script>
    <!--Form Validation end-->
    <!--datepicker start-->
    <!--<script src="<?php // echo base_url();                                                                                                                                                                       ?>assets/global/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js" type="text/javascript"></script>-->
    <!--datepicker ends-->
    <!--select2 start-->
    <script src="<?php echo base_url(); ?>assets/global/plugins/select2/js/select2.full.min.js"
    type="text/javascript"></script>
    <!--select2 ends-->
    <!--toaster starts-->
    <script src="<?php echo base_url(); ?>assets/global/plugins/bootstrap-toastr/toastr.min.js"
    type="text/javascript"></script>
    <!--toaster ends-->
    <!-- BEGIN THEME GLOBAL SCRIPTS -->
    <script src="<?php echo base_url(); ?>assets/global/plugins/jquery-slimscroll/jquery.slimscroll.min.js" type="text/javascript"></script>
    <script src="<?php echo base_url(); ?>assets/global/plugins/jquery.blockui.min.js" type="text/javascript"></script>
    <script src="<?php echo base_url(); ?>assets/global/scripts/app.js" type="text/javascript"></script>
    <!-- END THEME GLOBAL SCRIPTS -->
    <!--dropzone-->
    <script src="<?php echo base_url(); ?>assets/global/plugins/dropzone/dropzone.min.js" type="text/javascript"></script>
    <script src="<?php echo base_url(); ?>assets/custom_scripts/frontend/form-dropzone.js" type="text/javascript"></script>
    <!--dropzone js-->
    <!--sweet alert js-->
    <script src="<?php echo base_url(); ?>assets/global/plugins/bootstrap-sweetalert/sweetalert.min.js"
    type="text/javascript"></script>
    <!--sweet alert js ends-->
    <!--Modal scripts-->
    <script src="<?php echo base_url(); ?>assets/global/plugins/bootstrap-modal/js/bootstrap-modalmanager.js"
    type="text/javascript"></script>
    <script src="<?php echo base_url(); ?>assets/global/plugins/bootstrap-modal/js/bootstrap-modal.js"
    type="text/javascript"></script>
    <!--Modal scripts end-->
    <script src="<?php echo base_url(); ?>assets/custom_scripts/frontend/common_functions.js"
    type="text/javascript"></script>
    <script src="<?php echo base_url(); ?>assets/custom_scripts/frontend/newsletters.js" type="text/javascript"></script>
    <!--<script src="https://www.gstatic.com/firebasejs/4.10.1/firebase.js"></script>-->
    <script src="https://www.gstatic.com/firebasejs/5.4.2/firebase.js"></script>
    <script src="<?php echo base_url('assets/custom_scripts/admin/chat.js'); ?>" type="text/javascript"></script>
    <script>
                    var senderID = '<?php echo $this->session->userdata('member_id'); ?>';
                    $(document).ready(function () {
                        GlobalPlugins.initToasterPlugin();
                        $('.translater-icon').on('click', function () {
                            $(this).parent('div').toggleClass('active');
                        });
                        $(document).mouseup(function (e) {
                            var container = $(".translater-wrapper");

                            // if the target of the click isn't the container nor a descendant of the container
                            if (!container.is(e.target) && container.has(e.target).length === 0) {
                                container.removeClass('active');
                            }
                        });
                        $(document).ready(function () {
                            Chat.init();
<?php if (isset($_GET['chat']) && $_GET['chat']) { ?>
                                var chatID = "<?php echo isset($_GET['chat']) ? $_GET['chat'] : ""; ?>";
                                $('.mt-comment-' + chatID).trigger('click');
<?php } ?>
                        });
                    });
    </script>
    <script type="text/javascript">
        function googleTranslateElementInit() {
            new google.translate.TranslateElement({
                pageLanguage: 'en',
                layout: google.translate.TranslateElement.InlineLayout.SIMPLE
            }, 'google_translate_element');
        }
    </script>
    <script type="text/javascript" src="//translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"></script>
</body>

</html>