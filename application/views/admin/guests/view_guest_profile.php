<script src="//maps.googleapis.com/maps/api/js?key=AIzaSyDVw_YgvMUxH6KawXzlwM9meU3HAUnbsLQ&libraries=places&language=en"></script>
<script src="<?php echo base_url(); ?>assets/geocode/jquery.geocomplete.js" type="text/javascript"></script>
<?php
$unique_id = time();
?>
<!-- BEGIN PAGE LEVEL STYLES -->
<link href="<?php echo base_url(); ?>assets/pages/css/profile.css" rel="stylesheet" type="text/css" />
<!-- END PAGE LEVEL STYLES -->
<link href="<?php echo base_url(); ?>assets/global/plugins/cubeportfolio/css/cubeportfolio.css" rel="stylesheet" type="text/css" />
<link href="<?php echo base_url(); ?>assets/pages/css/portfolio.min.css" rel="stylesheet" type="text/css" />
<link href="<?php echo base_url(); ?>assets/frontend/datatable/jquery.dataTables.min.css" rel="stylesheet" type="text/css"/>
<link href="<?php echo base_url(); ?>assets/slim-image-cropper-test-master/slim/slim.min.css" rel="stylesheet">
<link href="<?php echo base_url(); ?>assets/slim-image-cropper-test-master/styles/styles.css" rel="stylesheet">
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
                    <img src="<?php echo file_exists($this->config->item('root_path').($member_info['image_path'] . 'medium_' . $member_info['image'])) ? base_url($member_info['image_path'] . 'medium_' . $member_info['image']) : base_url('uploads/member_images/profile/user.png'); ?>" class="img-responsive" alt=""> 
                </div>
                <!-- END SIDEBAR USERPIC -->
                <!-- SIDEBAR USER TITLE -->
                <div class="profile-usertitle">
                    <div class="profile-usertitle-name"><?php echo $member_info['first_name']; ?> <?php echo $member_info['last_name']; ?> </div>
                    <div class="profile-usertitle-job"> <?php echo $member_info['member_type'] == 1 ? "Guest" : "Service"; ?> Member </div>
                </div>
                <!-- END SIDEBAR USER TITLE -->
                <!-- SIDEBAR BUTTONS -->
                <div class="profile-userbuttons">
                    <a class="btn btn-circle green btn-sm" href="mailto:<?php echo $member_info['email']; ?>">
                        Send Email
                    </a>
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

            <div class="mt-element-ribbon bg-color-white">
                <div class="ribbon ribbon-border-hor ribbon-clip <?php echo "ribbon-color-danger"; ?> uppercase">
                    <div class="ribbon-sub ribbon-clip"></div>
                    <?php echo $member_info['end_subscription_date']; ?>
                </div>
                <p class="ribbon-content">Account was created on <span class="bold italic" style="color:green;"><?php echo $member_info['subscription_date']; ?></span> and will expire on <span class="bold italic" style="color:red;"><?php echo $member_info['end_subscription_date']; ?></span>. Click <a style="color:purple; font-weight: bold;" href="javascript:UpdateSubscription.UpdateSubscriptionModal(<?php echo $member_info['member_id']; ?>,'<?php echo $member_info['end_subscription_date']; ?>')">here</a> if you want to update subscription date for current member.</p>
            </div>

            <!-- END PORTLET MAIN -->
            <!-- PORTLET MAIN -->
            <div class="portlet light ">
                <!-- STAT -->
                <!--                <div class="row list-separated profile-stat">
                                    <div class="col-md-12 col-sm-12 col-xs-12">
                                        <div class="uppercase profile-stat-title"> 37 </div>
                                        <div class="uppercase profile-stat-text"> Connected Members </div>
                                    </div>
                                </div>-->
                <!-- END STAT -->
                <div class="text-center">
                    <h4 class="profile-desc-title">About <?php echo ucfirst($member_info['username']); ?></h4>
                    <span class="profile-desc-text"><?php echo strlen($member_info['about_me']) > 450 ? substr($member_info['about_me'], 0, 450) . '...' : $member_info['about_me']; ?></span>
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
                                <li class="active" onclick="CommonFunctions.changeHash('#tab_1_1')">
                                    <a href="#tab_1_1" data-toggle="tab">Personal Info</a>
                                </li>
                                <li onclick="CommonFunctions.changeHash('#tab_1_2')">
                                    <a href="#tab_1_2" data-toggle="tab">Languages</a>
                                </li>
                                <li onclick="CommonFunctions.changeHash('#tab_1_3')">
                                    <a href="#tab_1_3" onclick="load_member_profile_images();load_member_id_proofs();" data-toggle="tab">Images</a>
                                </li>
                                <li onclick="CommonFunctions.changeHash('#tab_1_4')">
                                    <a href="#tab_1_4" data-toggle="tab">Privacy Settings</a>
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
                                            <label class="control-label">Gender<span class="required"></span></label>
                                            <select class="form-control" name="gender">
                                                <option></option>
                                                <option value="Male" <?php echo $member_info['gender'] == "Male" ? "selected='selected'" : ""; ?>>Male</option>
                                                <option value="Female" <?php echo $member_info['gender'] == "Female" ? "selected='selected'" : ""; ?>>Female</option>
                                                <option value="Other" <?php echo $member_info['gender'] == "Other" ? "selected='selected'" : ""; ?>>Other</option>
                                            </select>
                                        </div>
                                        <div class="clearfix"></div>
                                        <div class="form-group col-md-6">
                                            <label class="control-label">Date of birth<span class="required"></span></label>
                                            <input class="form-control date-picker" size="16" type="text" data-date-format="yyyy-mm-dd" value="<?php echo ($member_info['date_of_birth'] != '0000-00-00' ? $member_info['date_of_birth'] : ''); ?>" name="date_of_birth" />
                                        </div>
                                        <!--                                        <div class="form-group col-md-6">
                                                                                    <label class="control-label">Country<span class="required">*</span></label>
                                                                                    <select class="form-control" name="country" id="dd-country" onchange="CommonFunctions.LoadStates(this.value);">
                                        <?php // echo isset($country_options) ? $country_options : ""; ?>
                                                                                    </select>
                                                                                </div>
                                                                                <div class="clearfix"></div>
                                                                                <div class="form-group col-md-6">
                                                                                    <label class="control-label">State<span class="required">*</span></label>
                                                                                    <select class="form-control edited" id="dd-state" onchange="CommonFunctions.LoadCities(this.value);" name="state">
                                        <?php // echo isset($state_options) ? $state_options : ""; ?>
                                                                                    </select>
                                                                                </div>
                                                                                <div class="form-group col-md-6">
                                                                                    <label class="control-label">City<span class="required">*</span></label>
                                                                                    <select class="form-control" id="dd-city" name="city">
                                        <?php // echo isset($city_options) ? $city_options : ""; ?>
                                                                                    </select>
                                                                                </div>-->
                                        <div class="form-group col-md-6">
                                            <label class="control-label">Location<span class="required">*</span></label>
                                            <input type="text" name="location" id="location" value="<?php echo $member_info['location']; ?>" class="location form-control">
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
                                        <hr/>
                                        <div class="note note-info">
                                            <p> Social media information.</p>
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label class="control-label">Facebook Link</label>
                                            <input type="text" placeholder="Facebook" name="facebook" value="<?php echo $member_info['facebook']; ?>" class="form-control" /> 
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label class="control-label">Youtube Link</label>
                                            <input type="text" placeholder="Youtube" name="youtube" value="<?php echo $member_info['youtube']; ?>" class="form-control" />
                                        </div>
                                        <div class="clearfix"></div>
                                        <div class="form-group col-md-6">
                                            <label class="control-label">Linkedin</label>
                                            <input type="text" placeholder="linkedin" name="linkedin" value="<?php echo $member_info['linkedin']; ?>" class="form-control" /> 
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label class="control-label">Gmail</label>
                                            <input type="text" placeholder="Gmail" name="gmail" value="<?php echo $member_info['gmail']; ?>" class="form-control" /> 
                                        </div>
                                        <div class="clearfix"></div>
                                        <div class="form-group col-md-6">
                                            <label class="control-label">Twitter</label>
                                            <input type="text" placeholder="Twitter" name="twitter" value="<?php echo $member_info['twitter']; ?>" class="form-control" />
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label class="control-label">Instagram</label>
                                            <input type="text" placeholder="Instagram" name="instagram" value="<?php echo $member_info['instagram']; ?>" class="form-control" /> 
                                        </div>
                                        <div class="clearfix"></div>
                                        <div class="form-group col-md-6">
                                            <label class="control-label">Skype</label>
                                            <input type="text" placeholder="Skype" name="skype" value="<?php echo $member_info['skype']; ?>" class="form-control" />
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label class="control-label">Pinterest</label>
                                            <input type="text" placeholder="Pinterest" name="pintrest" value="<?php echo $member_info['pinterest']; ?>" class="form-control" /> 
                                        </div>
                                        <div class="clearfix"></div>
                                        <hr/>
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
                                
                                <!--Languages tab starts from here-->
                                <div class="tab-pane" id="tab_1_2">
                                    <div id="" class="table-responsive">
                                        <div class="table-actions-wrapper margin-bottom-20">
                                            <span> </span>
                                            <a class="purple" data-title="Add Type" href="javascript:Languages.modal_add_language(0,<?php echo $member_info['member_id']; ?>)"><i class="fa fa-plus-circle"></i> Add Language</a>
                                        </div>
                                        <table id="language_table" class="table table-striped table-bordered table-hover text-center dataTable no-footer" cellspacing="0" width="100%">
                                            <thead>
                                                <tr>
                                                    <th>Language</th>
                                                    <th>Proficiency</th>
                                                    <th>Added On</th>
                                                    <th>Updated On</th>
                                                    <th>Status</th>
                                                    <th>Actions</th>
                                                </tr>
                                            </thead>

                                            <tbody>
                                                <?php foreach ($language_data as $language) { ?>
                                                    <tr>
                                                        <td><?php echo $language['language_name']; ?></td>
                                                        <td><?php echo $language['language_level']; ?></td>
                                                        <td><?php echo date('Y-m-d', strtotime($language['created_on'])); ?></td>
                                                        <td><?php echo date('Y-m-d', strtotime($language['updated_on'])); ?></td>
                                                        <td>
                                                            <div class="md-checkbox-inline">
                                                                <div class="md-checkbox">
                                                                    <input type="checkbox" disabled="disabled" id="checkbox<?php echo $language['language_id']; ?>" <?php echo ($language['is_active'] ? "checked='checked'" : ""); ?> class="md-check">
                                                                    <label for="checkbox<?php echo $language['language_id']; ?>">
                                                                        <span></span>
                                                                        <span class="check"></span>
                                                                        <span class="box"></span>
                                                                    </label>
                                                                </div>
                                                            </div>
                                                        </td>
                                                        <td><a class="btn btn-xs default btn-editable" onclick="Languages.modal_add_language(<?php echo $language['language_id']; ?>,<?php echo $member_info['member_id']; ?>)">Edit</a> <a class="btn btn-xs default btn-editable" onclick="CommonFunctions.Delete(<?php echo $language["language_id"]; ?>, 'tb_member_languages', 'language_id', 'Language will be permanently deleted without further warning. Do you really want to delete this language from your profile?');">Delete</i></a></td>
                                                    </tr>
                                                <?php } ?>

                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <!--Languages tabs ends here-->
                                
                                <!-- IMAGES SETTINGS TAB -->
                                <div class="tab-pane" id="tab_1_3">
                                    <!-- Profile images start-->
                                    <div>
                                        <form class="form-horizontal text-center" action="<?php echo base_url('admin/guests/upload_images_member'); ?>" method="post">
                                            <input type="hidden" name="member_id" value="<?php echo $member_info['member_id']; ?>">
                                            <input type="hidden" name="member_type" value="guest">
                                            <div class="form-group form-md-line-input">
                                                <div class="col-md-12">
                                                    <div class="frame middle-elem profile-image">
                                                        <input type="file" id="profile_images" name='profile_images[]' />
                                                    </div>
                                                </div>
                                            </div>
                                            <input type="submit" name="submit" class="btn green" value="Submit">
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
                                        <form class="form-horizontal text-center" action="<?php echo base_url('admin/guests/upload_images_member'); ?>" method="post">
                                            <input type="hidden" name="member_id" value="<?php echo $member_info['member_id']; ?>">
                                            <input type="hidden" name="member_type" value="guest">
                                            <div class="form-group form-md-line-input">
                                                <div class="col-md-12">
                                                    <div class="frame middle-elem id-proof">
                                                        <input type="file" id="id_proofs" name='id_proofs[]' />
                                                    </div>
                                                </div>
                                            </div>
                                            <input type="submit" class="btn green" name="submit" value="Submit">
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
                                <div class="tab-pane" id="tab_1_4">
                                    <!--                                    <form id="privacy_form">
                                                                            <table class="table table-light table-hover">
                                                                                <tr>
                                                                                    <td> Account Status. </td>
                                                                                    <td>
                                                                                        <div class="mt-radio-inline">
                                                                                            <label class="mt-radio">
                                                                                                <input type="radio" name="status" <?php // echo $member_info['status'] == "active" ? "checked" : "";                        ?> value="active" /> Active
                                                                                                <span></span>
                                                                                            </label>
                                                                                            <label class="mt-radio">
                                                                                                <input type="radio" name="status" checked="checked" value="pending" <?php // echo $member_info['status'] == "pending" ? "checked" : "";                        ?>/> Pending
                                                                                                <span></span>
                                                                                            </label>
                                                                                            <label class="mt-radio">
                                                                                                <input type="radio" name="status" value="suspended" <?php // echo $member_info['status'] == "suspended" ? "checked" : "";                        ?>/> Suspended
                                                                                                <span></span>
                                                                                            </label>
                                                                                        </div>
                                                                                    </td>
                                                                                </tr>
                                                                            </table>
                                                                            end profile-settings
                                                                            <div class="margin-top-10 text-right">
                                                                                <a href="javascript:;" class="btn green"> Save Changes </a>
                                                                                <a href="<?php // echo base_url('admin/guests');                        ?>" class="btn default"> Cancel </a>
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
<script src="<?php echo base_url(); ?>assets/custom_scripts/admin/member_subscription_update.js" type="text/javascript"></script>
<!-- BEGIN PAGE LEVEL SCRIPTS -->
<script src="<?php echo base_url(); ?>assets/global/plugins/cubeportfolio/js/jquery.cubeportfolio.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>assets/custom_scripts/admin/images_member.js" type="text/javascript"></script>
<script src="<?php echo base_url('assets/custom_scripts/admin/languages.js'); ?>" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>assets/frontend/datatable/jquery.dataTables.min.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>assets/slim-image-cropper-test-master/slim/slim.kickstart.min.js"></script>
<script src="<?php echo base_url(); ?>assets/slim-image-cropper-test-master/scripts/scripts.js"></script>
<!-- END PAGE LEVEL SCRIPTS -->
<script>
    $(document).ready(function () {
        $("#language_table").DataTable();
        $("#location").geocomplete();
    });
</script>