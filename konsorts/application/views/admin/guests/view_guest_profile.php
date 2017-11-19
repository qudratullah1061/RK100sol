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
            <span><?php echo $member_info['username']; ?> Guest Profile</span>
        </li>
    </ul>
</div>
<!-- END PAGE BAR -->
<h1 class="page-title"> Guest Member Profile | Account
    <small>Guest account page</small>
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
                    <img src="<?php echo base_url($member_info['image_path'] . '/medium_' . $member_info['image']); ?>" class="img-responsive" alt=""> 
                </div>
                <!-- END SIDEBAR USERPIC -->
                <!-- SIDEBAR USER TITLE -->
                <div class="profile-usertitle">
                    <div class="profile-usertitle-name"><?php echo $member_info['first_name']; ?> <?php echo $member_info['last_name']; ?> </div>
                    <div class="profile-usertitle-job"> <?php echo $member_info['member_type'] == 1 ? "Guest" : "Companion"; ?> Member </div>
                </div>
                <!-- END SIDEBAR USER TITLE -->
                <!-- SIDEBAR BUTTONS -->
                <div class="profile-userbuttons">
                    <button type="button" class="btn btn-circle green btn-sm">Send Email</button>
                    <button type="button" class="btn btn-circle red btn-sm">Send Message</button>
                </div>
                <!-- END SIDEBAR BUTTONS -->
                <!-- SIDEBAR MENU -->
                <div class="profile-usermenu">
                    <!--Place for proper spacing-->
                </div>
                <!-- END MENU -->
            </div>
            <!-- END PORTLET MAIN -->
            <!-- PORTLET MAIN -->
            <div class="portlet light ">
                <!-- STAT -->
                <div class="row list-separated profile-stat">
                    <div class="col-md-12 col-sm-12 col-xs-12">
                        <div class="uppercase profile-stat-title"> 37 </div>
                        <div class="uppercase profile-stat-text"> Connected Members </div>
                    </div>
                </div>
                <!-- END STAT -->
                <div class="text-center">
                    <h4 class="profile-desc-title">About <?php echo ucfirst($member_info['username']); ?></h4>
                    <span class="profile-desc-text"> <?php echo $member_info['about_me']; ?> </span>
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
                                        <input type="hidden" name="admin_id" value="<?php echo $member_info['member_id']; ?>">
                                        <div class="form-group">
                                            <label class="control-label">Guest Member ID<span class="required">*</span></label>
                                            <input type="text" placeholder="Unique ID" disabled="disabled" value="<?php echo $member_info['member_unique_code']; ?>" class="form-control" /> 
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label">Username<span class="required">*</span></label>
                                            <input type="text" placeholder="Username" name="username" value="<?php echo $member_info['username']; ?>" class="form-control" /> 
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label">First Name<span class="required">*</span></label>
                                            <input type="text" placeholder="First Name" name="first_name" value="<?php echo $member_info['first_name']; ?>" class="form-control" /> 
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label">Last Name<span class="required">*</span></label>
                                            <input type="text" placeholder="Last Name" name="last_name" value="<?php echo $member_info['last_name']; ?>" class="form-control" /> 
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label">Email<span class="required">*</span></label>
                                            <input type="text" placeholder="Email" name="email" value="<?php echo $member_info['email']; ?>" class="form-control" /> 
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label">Phone number<span class="required">*</span></label>
                                            <input type="text" placeholder="Phone Number" name="phone_number" value="<?php echo $member_info['phone_number']; ?>" class="form-control" /> 
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
                                            <label class="control-label">Gender<span class="required">*</span><span class="required">*</span></label>
                                            <select class="form-control" name="gender">
                                                <option></option>
                                                <option value="Male" <?php echo $member_info['gender'] == "Male" ? "selected='selected'" : ""; ?>>Male</option>
                                                <option value="Female" <?php echo $member_info['gender'] == "Female" ? "selected='selected'" : ""; ?>>Female</option>
                                                <option value="Other" <?php echo $member_info['gender'] == "Other" ? "selected='selected'" : ""; ?>>Other</option>
                                            </select>

                                        </div>

                                        <div class="form-group">
                                            <label class="control-label">Date of birth<span class="required">*</span></label>
                                            <input class="form-control date-picker" size="16" type="text" data-date-format="yyyy-mm-dd" value="<?php echo $member_info['date_of_birth']; ?>" name="date_of_birth" />
                                        </div>

                                        <div class="form-group">
                                            <label class="control-label">Country<span class="required">*</span></label>
                                            <select class="form-control" name="country" id="dd-country" onchange="CommonFunctions.LoadStates(this.value);">
                                                <?php echo isset($country_options) ? $country_options : ""; ?>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label">State<span class="required">*</span></label>
                                            <select class="form-control edited" id="dd-state" onchange="CommonFunctions.LoadCities(this.value);" name="state">
                                                <?php echo isset($state_options) ? $state_options : ""; ?>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label">City<span class="required">*</span></label>
                                            <select class="form-control" id="dd-city" name="city">
                                                <?php echo isset($city_options) ? $city_options : ""; ?>
                                            </select>
                                        </div>


                                        <div class="form-group">
                                            <label class="control-label">Address<span class="required">*</span></label>
                                            <textarea class="form-control" rows="3" name="address" placeholder="Address"><?php echo $member_info['address']; ?></textarea>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label">About</label>
                                            <textarea class="form-control" rows="3" name="about_me" placeholder="About Me"><?php echo $member_info['about_me']; ?></textarea>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label">Other Interest</label>
                                            <textarea class="form-control" rows="3" name="other_interest" placeholder="Other Interest"><?php echo $member_info['other_interest']; ?></textarea>
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

<script>
    $(document).ready(function () {
        AdminUsers.initUpdateValidation("form-update-admin");
    });
</script>
<script src="<?php echo base_url(); ?>assets/global/plugins/jquery.sparkline.min.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>assets/pages/scripts/profile.min.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>assets/custom_scripts/admin/admin_users.js" type="text/javascript"></script>