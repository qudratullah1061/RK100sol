<?php
$unique_id = time();
?>
<!-- BEGIN PAGE LEVEL STYLES -->
<link href="<?php echo base_url(); ?>assets/pages/css/profile.css" rel="stylesheet" type="text/css" />
<!-- END PAGE LEVEL STYLES -->
<link href="<?php echo base_url(); ?>assets/global/plugins/cubeportfolio/css/cubeportfolio.css" rel="stylesheet" type="text/css" />
<link href="<?php echo base_url(); ?>assets/pages/css/portfolio.min.css" rel="stylesheet" type="text/css" />
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
            <?php
            $ribbon_clr = "ribbon-color-danger";
            $msg = "";
            if ($member_info['status'] == "active") {
                $ribbon_clr = "ribbon-color-success";
                $msg = "Account is active.";
            } elseif ($member_info['status'] == "pending") {
                $ribbon_clr = "ribbon-color-info";
                $msg = "Account is in pending mode. Please verify all provided information are valid than activate account from personal info tab.";
            } elseif ($member_info['status'] == "suspended") {
                $ribbon_clr = "ribbon-color-danger";
                $msg = "Account is suspended by admin. Please verify all provided information are valid than activate account from personal info tab.";
            }
            ?>
            <div class="mt-element-ribbon bg-color-white">
                <div class="ribbon ribbon-border-hor ribbon-clip <?php echo $ribbon_clr; ?> uppercase">
                    <div class="ribbon-sub ribbon-clip"></div><?php echo $member_info['status']; ?></div>
                <p class="ribbon-content"><?php echo $msg; ?></p>
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
                    <span class="profile-desc-text"><?php echo strlen($member_info['about_me']) > 450 ? substr($member_info['about_me'], 0, 450).'...' : $member_info['about_me']; ?></span>
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
                                <li onclick="">
                                    <a href="#tab_1_2" onclick="load_member_profile_images();load_member_id_proofs();" data-toggle="tab">Images</a>
                                </li>
                                <li>
                                    <a href="#tab_1_3" data-toggle="tab">Privacy Settings</a>
                                </li>
                            </ul>
                        </div>
                        <div class="portlet-body">
                            <div class="tab-content">
                                <!-- PERSONAL INFO TAB -->
                                <div class="tab-pane active" id="tab_1_1">
                                    <form role="form" id="update_guest_member" method="post">
                                        <input type="hidden" name="member_id" value="<?php echo $member_info['member_id']; ?>">
                                        <div class="form-group col-md-6">
                                            <label class="control-label">Guest Member ID<span class="required">*</span></label>
                                            <input type="text" placeholder="Unique ID" disabled="disabled" value="<?php echo $member_info['member_unique_code']; ?>" class="form-control" /> 
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label class="control-label">Account Status<span class="required">*</span></label>
                                            <select class="form-control" name="status">
                                                <option value="active" <?php echo $member_info['status'] == "active" ? "selected='selected'" : ""; ?>>Active</option>
                                                <option value="pending" <?php echo $member_info['status'] == "pending" ? "selected='selected'" : ""; ?>>Pending</option>
                                                <option value="suspended" <?php echo $member_info['status'] == "suspended" ? "selected='selected'" : ""; ?>>Suspended</option>
                                            </select>
                                        </div>
                                        <div class="clearfix"></div>
                                        <div class="form-group col-md-6">
                                            <label class="control-label">First Name<span class="required">*</span></label>
                                            <input type="text" placeholder="First Name" name="first_name" value="<?php echo $member_info['first_name']; ?>" class="form-control" /> 
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label class="control-label">Last Name<span class="required">*</span></label>
                                            <input type="text" placeholder="Last Name" name="last_name" value="<?php echo $member_info['last_name']; ?>" class="form-control" /> 
                                        </div>
                                        <div class="clearfix"></div>
                                        <div class="form-group col-md-6">
                                            <label class="control-label">Username<span class="required">*</span></label>
                                            <input type="text" placeholder="Username" name="username" value="<?php echo $member_info['username']; ?>" class="form-control" /> 
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label class="control-label">Email<span class="required">*</span></label>
                                            <input type="text" placeholder="Email" name="email" value="<?php echo $member_info['email']; ?>" class="form-control" /> 
                                        </div>
                                        <div class="clearfix"></div>
                                        <div class="form-group col-md-6">
                                            <label class="control-label">Password</label>
                                            <input type="password" placeholder="Password" id="password" name="password" value="" class="form-control" /> 
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label class="control-label">Confirm Password</label>
                                            <input type="password" placeholder="Confirm Password" id="confirm_password" name="confirm_password" value="" class="form-control" /> 
                                        </div>
                                        <div class="clearfix"></div>
                                        <div class="form-group col-md-6">
                                            <label class="control-label">Phone number<span class="required">*</span></label>
                                            <input type="text" placeholder="Phone Number" name="phone_number" value="<?php echo $member_info['phone_number']; ?>" class="form-control" /> 
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label class="control-label">Gender<span class="required">*</span></label>
                                            <select class="form-control" name="gender">
                                                <option></option>
                                                <option value="Male" <?php echo $member_info['gender'] == "Male" ? "selected='selected'" : ""; ?>>Male</option>
                                                <option value="Female" <?php echo $member_info['gender'] == "Female" ? "selected='selected'" : ""; ?>>Female</option>
                                                <option value="Other" <?php echo $member_info['gender'] == "Other" ? "selected='selected'" : ""; ?>>Other</option>
                                            </select>
                                        </div>
                                        <div class="clearfix"></div>
                                        <div class="form-group col-md-6">
                                            <label class="control-label">Date of birth<span class="required">*</span></label>
                                            <input class="form-control date-picker" size="16" type="text" data-date-format="yyyy-mm-dd" value="<?php echo $member_info['date_of_birth']; ?>" name="date_of_birth" />
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label class="control-label">Country<span class="required">*</span></label>
                                            <select class="form-control" name="country" id="dd-country" onchange="CommonFunctions.LoadStates(this.value);">
                                                <?php echo isset($country_options) ? $country_options : ""; ?>
                                            </select>
                                        </div>
                                        <div class="clearfix"></div>
                                        <div class="form-group col-md-6">
                                            <label class="control-label">State<span class="required">*</span></label>
                                            <select class="form-control edited" id="dd-state" onchange="CommonFunctions.LoadCities(this.value);" name="state">
                                                <?php echo isset($state_options) ? $state_options : ""; ?>
                                            </select>
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label class="control-label">City<span class="required">*</span></label>
                                            <select class="form-control" id="dd-city" name="city">
                                                <?php echo isset($city_options) ? $city_options : ""; ?>
                                            </select>
                                        </div>
                                        <div class="clearfix"></div>
                                        <div class="form-group col-md-12">
                                            <label class="control-label">Address<span class="required">*</span></label>
                                            <input type="text" placeholder="Address" name="address" value="<?php echo $member_info['address']; ?>" class="form-control" /> 
                                        </div>
                                        <div class="clearfix"></div>
                                        <div class="form-group col-md-12">
                                            <label class="control-label">About</label>
                                            <textarea class="form-control" rows="3" name="about_me" placeholder="About Me"><?php echo $member_info['about_me']; ?></textarea>
                                        </div>
                                        <div class="clearfix"></div>
                                        <div class="form-group col-md-12">
                                            <label class="control-label">Other Interest</label>
                                            <textarea class="form-control" rows="3" name="other_interest" placeholder="Other Interest"><?php echo $member_info['other_interest']; ?></textarea>
                                        </div>
                                        <div class="clearfix"></div>
                                        <div class="form-group col-md-12 text-right">
                                            <div class="margin-top-10">
                                                <input type="submit" name="submit" value="Save Changes" class="btn green"/>
                                                <a href="<?php echo base_url('admin/guests'); ?>" class="btn default"> Cancel </a>
                                            </div>
                                        </div>
                                        <div class="clearfix"></div>
                                    </form>

                                </div>
                                <!-- END PERSONAL INFO TAB -->
                                <!-- IMAGES SETTINGS TAB -->
                                <div class="tab-pane" id="tab_1_2">
                                    <!-- Profile images start-->
                                    <div>
                                        <form action="<?php echo base_url('admin/misc/upload_images_member'); ?>" class="dropzone dropzone-file-area" id="my-dropzone" >
                                            <input type="hidden" name="member_id" value="<?php echo $member_info['member_id']; ?>">
                                            <input type="hidden" name="file_upload_unique_id" value="<?php echo $unique_id; ?>">
                                            <input type="hidden" name="image_type" value="profile">
                                            <input type="hidden" name="image_dir" value="uploads/member_images/profile/">
                                            <h3 class="sbold">Click to upload</h3>
                                            <p> Upload Guest Member Profile Images </p>
                                        </form>

                                        <div id="load_member_profile_images" class="cbp margin-top-20">
                                            <?php
                                            if ($member_profile_pics && count($member_profile_pics) > 0) {
                                                $counter = 1;
                                                foreach ($member_profile_pics as $image_info) {
                                                    ?>
                                                    <div class="cbp-item graphic" id='pic-<?php echo $image_info['image_id']; ?>'>
                                                        <div class="cbp-caption">
                                                            <div class="cbp-caption-defaultWrap">
                                                                <img src="<?php echo base_url() . $image_info['image_path'] . 'large_' . $image_info['image']; ?>" alt=""> 
                                                            </div>
                                                            <div class="cbp-caption-activeWrap">
                                                                <div class="cbp-l-caption-alignCenter">
                                                                    <div class="cbp-l-caption-body">                                                                        
                                                                        <a href="javascript:CommonFunctions.Delete('<?php echo $image_info['image_id']; ?>', 'tb_member_images', 'image_id', 'Are you sure you want to delete this image?')" class="cbp-l-caption-buttonLeft btn red uppercase" rel="nofollow">Delete</a>
                                                                        <a href="javascript:CommonFunctions.MakeProfileImage('<?php echo $image_info['image_id']; ?>', '<?php echo $image_info['member_id']; ?>')" class="cbp-l-caption-buttonLeft btn red uppercase" rel="nofollow">Make profile</a>
                                                                        <a href="<?php echo base_url() . $image_info['image_path'] . $image_info['image']; ?>" class="cbp-lightbox cbp-l-caption-buttonRight btn red uppercase btn red uppercase" data-title="Konsorts.com">view larger</a>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="cbp-l-grid-projects-title uppercase text-center uppercase text-center pic-caption-img pic-caption-<?php echo $image_info['image_id']; ?>" <?php echo $image_info['is_profile_image'] ? "style='color:green;'" : ""; ?>>Image <?php echo $counter++; ?></div>
                                                    </div>
                                                    <?php
                                                }
                                            }
                                            ?>
                                        </div>
                                    </div>
                                    <!-- Profile images ends-->

                                    <!-- Id proof images start-->
                                    <div class="margin-top-20">
                                        <form action="<?php echo base_url('admin/guests/upload_images_member'); ?>" class="dropzone dropzone-file-area" id="my-dropzone" >
                                            <input type="hidden" name="member_id" value="<?php echo $member_info['member_id']; ?>">
                                            <input type="hidden" name="image_type" value="id_proof">
                                            <input type="hidden" name="image_dir" value="uploads/member_images/id_proofs/">
                                            <h3 class="sbold">Click to upload</h3>
                                            <p>Upload Guest Member Id Proofs</p>
                                        </form>

                                        <div id="load_member_id_proofs" class="cbp margin-top-20">
                                            <?php
                                            if ($member_id_proofs && count($member_id_proofs) > 0) {
                                                $counter = 1;
                                                foreach ($member_id_proofs as $image_info) {
                                                    ?>
                                                    <div class="cbp-item graphic" id='pic-<?php echo $image_info['image_id']; ?>'>
                                                        <div class="cbp-caption">
                                                            <div class="cbp-caption-defaultWrap">
                                                                <img src="<?php echo base_url() . $image_info['image_path'] . 'large_' . $image_info['image']; ?>" alt=""> 
                                                            </div>
                                                            <div class="cbp-caption-activeWrap">
                                                                <div class="cbp-l-caption-alignCenter">
                                                                    <div class="cbp-l-caption-body">                                                                        
                                                                        <a href="javascript:CommonFunctions.Delete('<?php echo $image_info['image_id']; ?>', 'tb_member_images', 'image_id', 'Are you sure you want to delete this id proof?')" class="cbp-l-caption-buttonLeft btn red uppercase" rel="nofollow">Delete</a>
                                                                        <a href="<?php echo base_url() . $image_info['image_path'] . $image_info['image']; ?>" class="cbp-lightbox cbp-l-caption-buttonRight btn red uppercase btn red uppercase" data-title="Konsorts.com">view larger</a>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="cbp-l-grid-projects-title uppercase text-center uppercase text-center">Id proof <?php echo $counter++; ?></div>
                                                    </div>
                                                    <?php
                                                }
                                            }
                                            ?>
                                        </div>
                                    </div>
                                    <!-- Id proof images ends-->
                                </div>
                                <!-- END IMAGES SETTINGS TAB -->
                                <!-- PRIVACY SETTINGS TAB -->
                                <div class="tab-pane" id="tab_1_3">
                                    <!--                                    <form id="privacy_form">
                                                                            <table class="table table-light table-hover">
                                                                                <tr>
                                                                                    <td> Account Status. </td>
                                                                                    <td>
                                                                                        <div class="mt-radio-inline">
                                                                                            <label class="mt-radio">
                                                                                                <input type="radio" name="status" <?php // echo $member_info['status'] == "active" ? "checked" : "";        ?> value="active" /> Active
                                                                                                <span></span>
                                                                                            </label>
                                                                                            <label class="mt-radio">
                                                                                                <input type="radio" name="status" checked="checked" value="pending" <?php // echo $member_info['status'] == "pending" ? "checked" : "";        ?>/> Pending
                                                                                                <span></span>
                                                                                            </label>
                                                                                            <label class="mt-radio">
                                                                                                <input type="radio" name="status" value="suspended" <?php // echo $member_info['status'] == "suspended" ? "checked" : "";        ?>/> Suspended
                                                                                                <span></span>
                                                                                            </label>
                                                                                        </div>
                                                                                    </td>
                                                                                </tr>
                                                                            </table>
                                                                            end profile-settings
                                                                            <div class="margin-top-10 text-right">
                                                                                <a href="javascript:;" class="btn green"> Save Changes </a>
                                                                                <a href="<?php // echo base_url('admin/guests');        ?>" class="btn default"> Cancel </a>
                                                                            </div>
                                                                        </form>-->
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
        GuestMembers.initAddUpdateGuestValidation("update_guest_member");
    });
</script>
<script src="<?php echo base_url(); ?>assets/global/plugins/jquery.sparkline.min.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>assets/custom_scripts/admin/guest_members.js" type="text/javascript"></script>
<!-- BEGIN PAGE LEVEL SCRIPTS -->
<script src="<?php echo base_url(); ?>assets/global/plugins/cubeportfolio/js/jquery.cubeportfolio.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>assets/custom_scripts/admin/images_member.js" type="text/javascript"></script>
<!-- END PAGE LEVEL SCRIPTS -->
