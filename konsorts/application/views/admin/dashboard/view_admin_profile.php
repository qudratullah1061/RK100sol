<!-- BEGIN PAGE LEVEL STYLES -->
<link href="<?php echo base_url(); ?>assets/pages/css/profile.css" rel="stylesheet" type="text/css" />
<!-- END PAGE LEVEL STYLES -->
<!-- BEGIN PAGE LEVEL PLUGINS -->
<link href="<?php echo base_url(); ?>assets/global/plugins/bootstrap-fileinput/bootstrap-fileinput.css" rel="stylesheet" type="text/css" />
<!-- END PAGE LEVEL PLUGINS -->
<!-- BEGIN PAGE HEADER-->
<!-- BEGIN PAGE BAR -->
<div class="page-bar">
    <ul class="page-breadcrumb">
        <li>
            <a href="<?php echo base_url('admin/dashboard'); ?>">Home</a>
            <i class="fa fa-circle"></i>
        </li>
        <li>
            <span><?php echo $admin_info['username']; ?> Profile</span>
        </li>
    </ul>
</div>
<!-- END PAGE BAR -->
<h1 class="page-title"> Admin Profile | Account
    <small>user account page</small>
</h1>
<!-- END PAGE TITLE-->
<!-- END PAGE HEADER-->
<div class="row">
    <div class="col-md-12">
        <!-- BEGIN PROFILE SIDEBAR -->
        <div class="profile-sidebar">
            <!-- PORTLET MAIN -->
            <div class="portlet light profile-sidebar-portlet ">
                <!-- SIDEBAR USERPIC -->
                <div class="profile-userpic">
                    <img src="<?php echo base_url($admin_info['image_path'] . '/medium_' . $admin_info['image']); ?>" class="img-responsive" alt=""> 
                </div>
                <!-- END SIDEBAR USERPIC -->
                <!-- SIDEBAR USER TITLE -->
                <div class="profile-usertitle">
                    <div class="profile-usertitle-name"><?php echo $admin_info['first_name']; ?> <?php echo $admin_info['last_name']; ?> </div>
                    <!--<div class="profile-usertitle-job"> Developer </div>-->
                </div>
                <!-- END SIDEBAR USER TITLE -->
                <!-- SIDEBAR BUTTONS -->
                <div class="profile-userbuttons">
                    <!--<button type="button" class="btn btn-circle green btn-sm">Follow</button>-->
                    <!--<button type="button" class="btn btn-circle red btn-sm">Message</button>-->
                </div>
                <!-- END SIDEBAR BUTTONS -->
                <!-- SIDEBAR MENU -->
                <div class="profile-usermenu">
                    <!--                    <ul class="nav">
                                            <li class="active">
                                                <a href="page_user_profile_1_account.html">
                                                    <i class="icon-settings"></i> Account Settings </a>
                                            </li>
                                        </ul>-->
                </div>
                <!-- END MENU -->
            </div>
            <!-- END PORTLET MAIN -->
            <!-- PORTLET MAIN -->
            <div class="portlet light ">
                <!-- STAT -->
                <!--                <div class="row list-separated profile-stat">
                                    <div class="col-md-4 col-sm-4 col-xs-6">
                                        <div class="uppercase profile-stat-title"> 37 </div>
                                        <div class="uppercase profile-stat-text"> Projects </div>
                                    </div>
                                    <div class="col-md-4 col-sm-4 col-xs-6">
                                        <div class="uppercase profile-stat-title"> 51 </div>
                                        <div class="uppercase profile-stat-text"> Tasks </div>
                                    </div>
                                    <div class="col-md-4 col-sm-4 col-xs-6">
                                        <div class="uppercase profile-stat-title"> 61 </div>
                                        <div class="uppercase profile-stat-text"> Uploads </div>
                                    </div>
                                </div>-->
                <!-- END STAT -->
                <div>
                    <h4 class="profile-desc-title">About <?php echo ucfirst($admin_info['username']); ?></h4>
                    <span class="profile-desc-text"> <?php echo $admin_info['about_me']; ?> </span>
                    <div class="margin-top-20 profile-desc-link">
                        <i class="fa fa-facebook"></i>
                        <a href="<?php echo $admin_info['facebook_link']; ?>">Facebook</a>
                    </div>
                    <div class="margin-top-20 profile-desc-link">
                        <i class="fa fa-twitter"></i>
                        <a href="<?php echo $admin_info['twitter_link']; ?>">Twitter</a>
                    </div>
                    <div class="margin-top-20 profile-desc-link">
                        <i class="fa fa-linkedin"></i>
                        <a href="<?php echo $admin_info['linkedin_link']; ?>">Linkedin</a>
                    </div>
                    <div class="margin-top-20 profile-desc-link">
                        <i class="fa fa-instagram"></i>
                        <a href="<?php echo $admin_info['instagram_link']; ?>">Instagram</a>
                    </div>
                </div>
            </div>
            <!-- END PORTLET MAIN -->
        </div>
        <!-- END BEGIN PROFILE SIDEBAR -->
        <!-- BEGIN PROFILE CONTENT -->
        <div class="profile-content">
            <div class="row">
                <div class="col-md-12">
                    <div class="portlet light ">
                        <div class="portlet-title tabbable-line">
                            <div class="caption caption-md">
                                <i class="icon-globe theme-font hide"></i>
                                <span class="caption-subject font-blue-madison bold uppercase">Profile Account</span>
                            </div>
                            <ul class="nav nav-tabs">
                                <li class="active">
                                    <a href="#tab_1_1" data-toggle="tab">Personal Info</a>
                                </li>
                                <li>
                                    <a href="#tab_1_2" data-toggle="tab">Privacy Settings</a>
                                </li>
                            </ul>
                        </div>
                        <div class="portlet-body">
                            <div class="tab-content">
                                <!-- PERSONAL INFO TAB -->
                                <div class="tab-pane active" id="tab_1_1">
                                    <form role="form" id="form-update-admin" method="post">
                                        <input type="hidden" name="admin_id" value="<?php echo $admin_info['admin_id']; ?>">
                                        <div class="form-group">
                                            <label class="control-label">Username</label>
                                            <input type="text" placeholder="Username" name="username" value="<?php echo $admin_info['username']; ?>" class="form-control" /> 
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label">First Name</label>
                                            <input type="text" placeholder="First Name" name="first_name" value="<?php echo $admin_info['first_name']; ?>" class="form-control" /> 
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label">Last Name</label>
                                            <input type="text" placeholder="Last Name" name="last_name" value="<?php echo $admin_info['last_name']; ?>" class="form-control" /> 
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label">Email</label>
                                            <input type="text" placeholder="Email" name="email" value="<?php echo $admin_info['email']; ?>" class="form-control" /> 
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label">Password</label>
                                            <input type="password" placeholder="Password" name="password" value="" class="form-control" /> 
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label">Confirm Password</label>
                                            <input type="password" placeholder="Confirm Password" name="confirm_password" value="" class="form-control" /> 
                                        </div>

                                        <div class="form-group">
                                            <label class="control-label">Facebook</label>
                                            <input type="text" placeholder="https://www.facebook.com" name="facebook_link" value="<?php echo $admin_info['facebook_link']; ?>" class="form-control"> 
                                        </div>

                                        <div class="form-group">
                                            <label class="control-label">Twitter</label>
                                            <input type="text" placeholder="https://www.twitter.com" name="twitter_link" value="<?php echo $admin_info['twitter_link']; ?>" class="form-control"> 
                                        </div>

                                        <div class="form-group">
                                            <label class="control-label">Linkedin</label>
                                            <input type="text" placeholder="https://www.linkedin.com" name="linkedin_link" value="<?php echo $admin_info['linkedin_link']; ?>" class="form-control"> 
                                        </div>

                                        <div class="form-group">
                                            <label class="control-label">Instagram</label>
                                            <input type="text" placeholder="https://www.instagram.com" name="instagram_link" value="<?php echo $admin_info['instagram_link']; ?>" class="form-control"> 
                                        </div>

                                        <div class="form-group">
                                            <label class="control-label">Profile Image</label>
                                            <input type="file" class="form-control" rows="3" name="image">
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label">About</label>
                                            <textarea class="form-control" rows="3" name="about_me" placeholder="About Me"><?php echo $admin_info['about_me']; ?></textarea>
                                        </div>
                                        <div class="margiv-top-10">
                                            <input type="submit" name="submit" value="Save Changes" class="btn green"/>
                                            <a href="<?php echo base_url('admin/admin_dashboard/admin_users'); ?>" class="btn default"> Cancel </a>
                                        </div>
                                    </form>
                                </div>
                                <!-- END PERSONAL INFO TAB -->
                                <!-- PRIVACY SETTINGS TAB -->
                                <div class="tab-pane" id="tab_1_2">
                                    <form action="#">
                                        <table class="table table-light table-hover">
                                            <tr>
                                                <td> All privacy settings will goes here. </td>
                                                <td>
                                                    <div class="mt-radio-inline">
                                                        <label class="mt-radio">
                                                            <input type="radio" name="optionsRadios1" value="option1" /> Yes
                                                            <span></span>
                                                        </label>
                                                        <label class="mt-radio">
                                                            <input type="radio" name="optionsRadios1" value="option2" checked/> No
                                                            <span></span>
                                                        </label>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td> Enim eiusmod high life accusamus terry richardson ad squid wolf moon </td>
                                                <td>
                                                    <div class="mt-radio-inline">
                                                        <label class="mt-radio">
                                                            <input type="radio" name="optionsRadios11" value="option1" /> Yes
                                                            <span></span>
                                                        </label>
                                                        <label class="mt-radio">
                                                            <input type="radio" name="optionsRadios11" value="option2" checked/> No
                                                            <span></span>
                                                        </label>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td> Enim eiusmod high life accusamus terry richardson ad squid wolf moon </td>
                                                <td>
                                                    <div class="mt-radio-inline">
                                                        <label class="mt-radio">
                                                            <input type="radio" name="optionsRadios21" value="option1" /> Yes
                                                            <span></span>
                                                        </label>
                                                        <label class="mt-radio">
                                                            <input type="radio" name="optionsRadios21" value="option2" checked/> No
                                                            <span></span>
                                                        </label>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td> Enim eiusmod high life accusamus terry richardson ad squid wolf moon </td>
                                                <td>
                                                    <div class="mt-radio-inline">
                                                        <label class="mt-radio">
                                                            <input type="radio" name="optionsRadios31" value="option1" /> Yes
                                                            <span></span>
                                                        </label>
                                                        <label class="mt-radio">
                                                            <input type="radio" name="optionsRadios31" value="option2" checked/> No
                                                            <span></span>
                                                        </label>
                                                    </div>
                                                </td>
                                            </tr>
                                        </table>
                                        <!--end profile-settings-->
                                        <div class="margin-top-10">
                                            <a href="javascript:;" class="btn red"> Save Changes </a>
                                            <a href="javascript:;" class="btn default"> Cancel </a>
                                        </div>
                                    </form>
                                </div>
                                <!-- END PRIVACY SETTINGS TAB -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- END PROFILE CONTENT -->
    </div>
</div>

<script src="<?php echo base_url(); ?>assets/global/plugins/jquery.sparkline.min.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>assets/pages/scripts/profile.min.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>assets/custom_scripts/admin/admin_users.js" type="text/javascript"></script>
<script>
    $(document).ready(function () {
        AdminUsers.initUpdateValidation("form-update-admin");
    });
</script>