<script src="//maps.googleapis.com/maps/api/js?key=AIzaSyDVw_YgvMUxH6KawXzlwM9meU3HAUnbsLQ&libraries=places&language=en"></script>
<script src="<?php echo base_url(); ?>assets/geocode/jquery.geocomplete.js" type="text/javascript"></script>
<!-- BEGIN PAGE LEVEL STYLES -->
<link href="<?php echo base_url(); ?>assets/pages/css/profile.css" rel="stylesheet" type="text/css"/>
<!-- END PAGE LEVEL STYLES -->
<link href="<?php echo base_url(); ?>assets/global/plugins/cubeportfolio/css/cubeportfolio.css" rel="stylesheet"
      type="text/css"/>
<link href="<?php echo base_url(); ?>assets/pages/css/portfolio.min.css" rel="stylesheet" type="text/css"/>
<link href="<?php echo base_url(); ?>assets/frontend/datatable/jquery.dataTables.min.css" rel="stylesheet"
      type="text/css"/>
<link href="<?php echo base_url(); ?>assets/slim-image-cropper-test-master/slim/slim.min.css" rel="stylesheet">
<link href="<?php echo base_url(); ?>assets/slim-image-cropper-test-master/styles/styles.css" rel="stylesheet">
<!-- BEGIN PAGE HEADER-->
<!-- BEGIN PAGE BAR -->
<section class="profile_edit">
    <div class="container">
        <!--<h1 class="page-title"> Guest Member Profile | Account
            <small>Guest account page</small>
        </h1>-->
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
                            <img src="<?php echo base_url($member_info['image_path'] . '/medium_' . $member_info['image']); ?>"
                                 class="img-responsive" alt="Guest Member Image">
                        </div>
                        <!-- END SIDEBAR USERPIC -->
                        <!-- SIDEBAR USER TITLE -->
                        <div class="profile-usertitle">
                            <div class="profile-usertitle-name"><?php echo $member_info['first_name']; ?><?php echo $member_info['last_name']; ?> </div>
                            <div class="profile-usertitle-job"> <?php echo $member_info['member_type'] == 1 ? "Guest" : "Service"; ?>
                                Member
                            </div>
                        </div>
                        <!-- END SIDEBAR USER TITLE -->
                        <!-- SIDEBAR BUTTONS -->
                        <div class="profile-userbuttons">
                            <a class="btn btn-circle green btn-sm" href="mailto:<?php echo $member_info['email']; ?>">
                                Send Email
                            </a>
                            <!--<button type="button" class="btn btn-circle red btn-sm">Send Message</button>-->
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
                        <!--                        <div class="row list-separated profile-stat">
                                                    <div class="col-md-12 col-sm-12 col-xs-12">
                                                        <div class="uppercase profile-stat-title"> 37 </div>
                                                        <div class="uppercase profile-stat-text"> Connected Members </div>
                                                    </div>
                                                </div>-->
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
                                        <li class="active" onclick="CommonFunctions.changeHash('#tab_1_1')">
                                            <a href="#tab_1_1" data-toggle="tab">Personal Info</a>
                                        </li>
                                        <li onclick="CommonFunctions.changeHash('#tab_1_2')">
                                            <a href="#tab_1_2" data-toggle="tab">Languages</a>
                                        </li>
                                        <li onclick="CommonFunctions.changeHash('#tab_1_3')">
                                            <a href="#tab_1_3"
                                               onclick="load_member_profile_images();load_member_id_proofs();"
                                               data-toggle="tab">Images</a>
                                        </li>
                                        <li onclick="CommonFunctions.changeHash('#tab_1_4')">
                                            <a href="#tab_1_4" data-toggle="tab">Privacy Settings</a>
                                        </li>
                                        <li onclick="CommonFunctions.changeHash('#tab_1_5')">
                                            <a href="#tab_1_5" data-toggle="tab">Promos</a>
                                        </li>
                                    </ul>
                                </div>
                                <div class="portlet-body">
                                    <div class="tab-content">
                                        <!-- PERSONAL INFO TAB -->
                                        <div class="tab-pane active" id="tab_1_1">
                                            <form role="form" id="update_guest_member" method="post">
                                                <input type="hidden" name="member_id"
                                                       value="<?php echo $member_info['member_id']; ?>">
                                                <div class="form-group col-md-6">
                                                    <label class="control-label">Guest Member ID<span
                                                                class="required">*</span></label>
                                                    <input type="text" placeholder="Unique ID" disabled="disabled"
                                                           value="<?php echo $member_info['member_unique_code']; ?>"
                                                           class="form-control"/>
                                                </div>
                                                <div class="form-group col-md-6">
                                                    <label class="control-label">Username<span class="required">*</span></label>
                                                    <input type="text" placeholder="Username" name="username"
                                                           value="<?php echo $member_info['username']; ?>"
                                                           class="form-control"/>
                                                </div>
                                                <div class="clearfix"></div>
                                                <div class="form-group col-md-6">
                                                    <label class="control-label">First Name<span
                                                                class="required">*</span></label>
                                                    <input type="text" placeholder="First Name" name="first_name"
                                                           value="<?php echo $member_info['first_name']; ?>"
                                                           class="form-control"/>
                                                </div>
                                                <div class="form-group col-md-6">
                                                    <label class="control-label">Last Name<span
                                                                class="required">*</span></label>
                                                    <input type="text" placeholder="Last Name" name="last_name"
                                                           value="<?php echo $member_info['last_name']; ?>"
                                                           class="form-control"/>
                                                </div>
                                                <div class="clearfix"></div>
                                                <div class="form-group col-md-6">
                                                    <label class="control-label">Email<span
                                                                class="required">*</span></label>
                                                    <input type="text" placeholder="Email" name="email"
                                                           value="<?php echo $member_info['email']; ?>"
                                                           class="form-control"/>
                                                </div>
                                                <div class="form-group col-md-6">
                                                    <label class="control-label">Phone number<span
                                                                class="required">*</span></label>
                                                    <input type="text" placeholder="Phone Number" name="phone_number"
                                                           value="<?php echo $member_info['phone_number']; ?>"
                                                           class="form-control"/>
                                                </div>
                                                <div class="clearfix"></div>
                                                <div class="form-group col-md-6">
                                                    <label class="control-label">Password</label>
                                                    <input type="password" placeholder="Password" id="password"
                                                           name="password" value="" class="form-control"/>
                                                </div>
                                                <div class="form-group col-md-6">
                                                    <label class="control-label">Confirm Password</label>
                                                    <input type="password" placeholder="Confirm Password"
                                                           id="confirm_password" name="confirm_password" value=""
                                                           class="form-control"/>
                                                </div>
                                                <div class="clearfix"></div>
                                                <div class="form-group col-md-6">
                                                    <label class="control-label">Gender<span
                                                                class="required"></span></label>
                                                    <select class="form-control" name="gender">
                                                        <option></option>
                                                        <option value="Male" <?php echo $member_info['gender'] == "Male" ? "selected='selected'" : ""; ?>>
                                                            Male
                                                        </option>
                                                        <option value="Female" <?php echo $member_info['gender'] == "Female" ? "selected='selected'" : ""; ?>>
                                                            Female
                                                        </option>
                                                        <option value="Other" <?php echo $member_info['gender'] == "Other" ? "selected='selected'" : ""; ?>>
                                                            Other
                                                        </option>
                                                    </select>

                                                </div>

                                                <div class="form-group col-md-6">
                                                    <label class="control-label">Date of birth<span
                                                                class="required"></span></label>
                                                    <input class="form-control date-picker" size="16" type="text"
                                                           data-date-format="yyyy-mm-dd"
                                                           value="<?php echo($member_info['date_of_birth'] != '0000-00-00' ? $member_info['date_of_birth'] : ''); ?>"
                                                           name="date_of_birth"/>
                                                </div>
                                                <div class="clearfix"></div>
                                                <!--                                                <div class="form-group col-md-6">
                                                                                                    <label class="control-label">Country<span class="required">*</span></label>
                                                                                                    <select class="form-control" name="country" id="dd-country" onchange="CommonFunctions.LoadStates(this.value);">
                                                <?php // echo isset($country_options) ? $country_options : ""; ?>
                                                                                                    </select>
                                                                                                </div>
                                                                                                <div class="form-group col-md-6">
                                                                                                    <label class="control-label">State<span class="required">*</span></label>
                                                                                                    <select class="form-control edited" id="dd-state" onchange="CommonFunctions.LoadCities(this.value);" name="state">
                                                <?php // echo isset($state_options) ? $state_options : ""; ?>
                                                                                                    </select>
                                                                                                </div>
                                                                                                <div class="clearfix"></div>
                                                                                                <div class="form-group col-md-6">
                                                                                                    <label class="control-label">City<span class="required">*</span></label>
                                                                                                    <select class="form-control" id="dd-city" name="city">
                                                <?php // echo isset($city_options) ? $city_options : ""; ?>
                                                                                                    </select>
                                                                                                </div>-->
                                                <div class="form-group col-md-6">
                                                    <label class="control-label">Location<span class="required">*</span></label>
                                                    <input type="text" name="location" id="location"
                                                           value="<?php echo $member_info['location']; ?>"
                                                           class="location form-control">
                                                </div>
                                                <div class="form-group col-md-6">
                                                    <label class="control-label">Zip Code</label>
                                                    <input type="text" name="zipcode"
                                                           value="<?php echo $member_info['zipcode']; ?>" id="zipcode"
                                                           class="form-control">
                                                </div>
                                                <div class="clearfix"></div>
                                                <div class="form-group col-md-6">
                                                    <label class="control-label">Address<span class="required">*</span></label>
                                                    <input type="text" placeholder="Address" name="address"
                                                           value="<?php echo $member_info['address']; ?>"
                                                           class="form-control"/>
                                                </div>

                                                <div class="form-group col-md-6">
                                                    <label class="control-label">Other Interest</label>
                                                    <textarea class="form-control" rows="3" name="other_interest"
                                                              placeholder="Other Interest"><?php echo $member_info['other_interest']; ?></textarea>
                                                </div>
                                                <div class="clearfix"></div>
                                                <div class="form-group col-md-12">
                                                    <label class="control-label">About<span
                                                                class="required">*</span></label>
                                                    <textarea class="form-control" rows="3" name="about_me"
                                                              placeholder="About Me"><?php echo $member_info['about_me']; ?></textarea>
                                                </div>
                                                <hr/>
                                                <div class="note note-info">
                                                    <p> Social media information.</p>
                                                </div>
                                                <div class="form-group col-md-6">
                                                    <label class="control-label">Facebook Link</label>
                                                    <input type="text" placeholder="Facebook" name="facebook"
                                                           value="<?php echo $member_info['facebook']; ?>"
                                                           class="form-control"/>
                                                </div>
                                                <div class="form-group col-md-6">
                                                    <label class="control-label">Youtube Link</label>
                                                    <input type="text" placeholder="Youtube" name="youtube"
                                                           value="<?php echo $member_info['youtube']; ?>"
                                                           class="form-control"/>
                                                </div>
                                                <div class="clearfix"></div>
                                                <div class="form-group col-md-6">
                                                    <label class="control-label">Linkedin</label>
                                                    <input type="text" placeholder="linkedin" name="linkedin"
                                                           value="<?php echo $member_info['linkedin']; ?>"
                                                           class="form-control"/>
                                                </div>
                                                <div class="form-group col-md-6">
                                                    <label class="control-label">Gmail</label>
                                                    <input type="text" placeholder="Gmail" name="gmail"
                                                           value="<?php echo $member_info['gmail']; ?>"
                                                           class="form-control"/>
                                                </div>
                                                <div class="clearfix"></div>
                                                <div class="form-group col-md-6">
                                                    <label class="control-label">Twitter</label>
                                                    <input type="text" placeholder="Twitter" name="twitter"
                                                           value="<?php echo $member_info['twitter']; ?>"
                                                           class="form-control"/>
                                                </div>
                                                <div class="form-group col-md-6">
                                                    <label class="control-label">Instagram</label>
                                                    <input type="text" placeholder="Instagram" name="instagram"
                                                           value="<?php echo $member_info['instagram']; ?>"
                                                           class="form-control"/>
                                                </div>
                                                <div class="clearfix"></div>
                                                <div class="form-group col-md-6">
                                                    <label class="control-label">Skype</label>
                                                    <input type="text" placeholder="Skype" name="skype"
                                                           value="<?php echo $member_info['skype']; ?>"
                                                           class="form-control"/>
                                                </div>
                                                <div class="form-group col-md-6">
                                                    <label class="control-label">Pinterest</label>
                                                    <input type="text" placeholder="Pinterest" name="pintrest"
                                                           value="<?php echo $member_info['pinterest']; ?>"
                                                           class="form-control"/>
                                                </div>
                                                <div class="clearfix"></div>
                                                <hr/>
                                                <div class="form-group col-md-12 text-right">
                                                    <div class="margiv-top-10">
                                                        <input type="submit" name="submit" value="Save Changes"
                                                               class="btn green"/>&nbsp;&nbsp;
                                                        <a href="<?php echo base_url('member/profile'); ?>"
                                                           class="btn default"> Cancel </a>
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
                                                    <a class="purple" data-title="Add Type"
                                                       href="javascript:Languages.modal_add_language()"><i
                                                                class="fa fa-plus-circle"></i> Add Language</a>
                                                </div>
                                                <table id="language_table"
                                                       class="table table-striped table-bordered table-hover text-center dataTable no-footer"
                                                       cellspacing="0" width="100%">
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
                                                                        <input type="checkbox" disabled="disabled"
                                                                               id="checkbox<?php echo $language['language_id']; ?>" <?php echo($language['is_active'] ? "checked='checked'" : ""); ?>
                                                                               class="md-check">
                                                                        <label for="checkbox<?php echo $language['language_id']; ?>">
                                                                            <span></span>
                                                                            <span class="check"></span>
                                                                            <span class="box"></span>
                                                                        </label>
                                                                    </div>
                                                                </div>
                                                            </td>
                                                            <td><a class="btn btn-xs default btn-editable"
                                                                   onclick="Languages.modal_add_language(<?php echo $language['language_id']; ?>)">Edit</a>
                                                                <a class="btn btn-xs default btn-editable"
                                                                   onclick="CommonFunctions.Delete(<?php echo $language["language_id"]; ?>, 'tb_member_languages', 'language_id', 'Language will be permanently deleted without further warning. Do you really want to delete this language from your profile?');">Delete</i></a>
                                                            </td>
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
                                                <!--                                                <form action="<?php // echo base_url('profile/upload_images_member');       ?>" class="dropzone dropzone-file-area" id="my-dropzone" >
                                                    <input type="hidden" name="member_id" value="<?php // echo $member_info['member_id'];       ?>">
                                                    <input type="hidden" name="image_type" value="profile">
                                                    <input type="hidden" name="image_dir" value="uploads/member_images/profile/">
                                                    <h3 class="sbold">Click to upload</h3>
                                                    <p> Upload Guest Member Profile Images </p>
                                                </form>-->

                                                <form class="form-horizontal text-center"
                                                      action="<?php echo base_url('profile/upload_images_member'); ?>"
                                                      method="post">
                                                    <input type="hidden" name="member_id"
                                                           value="<?php echo $member_info['member_id']; ?>">
                                                    <input type="hidden" name="member_type" value="guest">
                                                    <div class="form-group form-md-line-input">
                                                        <div class="col-md-12">
                                                            <div class="frame middle-elem profile-image">
                                                                <input type="file" id="profile_images"
                                                                       name='profile_images[]'/>
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
                                                            <div class="cbp-item graphic"
                                                                 id='pic-<?php echo $image_info['image_id']; ?>'>
                                                                <div class="cbp-caption">
                                                                    <div class="cbp-caption-defaultWrap">
                                                                        <img src="<?php echo base_url() . $image_info['image_path'] . 'large_' . $image_info['image']; ?>"
                                                                             alt="Member Profile Image">
                                                                    </div>
                                                                    <div class="cbp-caption-activeWrap">
                                                                        <div class="cbp-l-caption-alignCenter">
                                                                            <div class="cbp-l-caption-body">
                                                                                <a href="javascript:CommonFunctions.Delete('<?php echo $image_info['image_id']; ?>', 'tb_member_images', 'image_id', 'Are you sure you want to delete this image?')"
                                                                                   class="cbp-l-caption-buttonLeft btn red uppercase"
                                                                                   rel="nofollow">Delete</a>
                                                                                <a href="javascript:CommonFunctions.MakeProfileImage('<?php echo $image_info['image_id']; ?>', '<?php echo $image_info['member_id']; ?>')"
                                                                                   class="cbp-l-caption-buttonLeft btn red uppercase"
                                                                                   rel="nofollow">Make profile</a>
                                                                                <a href="<?php echo base_url() . $image_info['image_path'] . $image_info['image']; ?>"
                                                                                   class="cbp-lightbox cbp-l-caption-buttonRight btn red uppercase btn red uppercase"
                                                                                   data-title="Konsorts.com">view
                                                                                    larger</a>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="cbp-l-grid-projects-title uppercase text-center uppercase text-center pic-caption-img pic-caption-<?php echo $image_info['image_id']; ?>" <?php echo $image_info['is_profile_image'] ? "style='color:green;'" : ""; ?>>
                                                                    Image <?php echo $counter++; ?></div>
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
                                                <!--                                                <form action="<?php // echo base_url('profile/upload_images_member');       ?>" class="dropzone dropzone-file-area" id="my-dropzone2" >
                                                    <input type="hidden" name="member_id" value="<?php // echo $member_info['member_id'];       ?>">
                                                    <input type="hidden" name="file_upload_unique_id" value="<?php // echo $unique_id;       ?>">
                                                    <input type="hidden" name="image_type" value="id_proof">
                                                    <input type="hidden" name="image_dir" value="uploads/member_images/id_proofs/">
                                                    <h3 class="sbold">Click to upload</h3>
                                                    <p>Upload Guest Member Id Proofs</p>
                                                </form>-->

                                                <form class="form-horizontal text-center"
                                                      action="<?php echo base_url('profile/upload_images_member'); ?>"
                                                      method="post">
                                                    <input type="hidden" name="member_id"
                                                           value="<?php echo $member_info['member_id']; ?>">
                                                    <input type="hidden" name="member_type" value="guest">
                                                    <div class="form-group form-md-line-input">
                                                        <div class="col-md-12">
                                                            <div class="frame middle-elem id-proof">
                                                                <input type="file" id="id_proofs" name='id_proofs[]'/>
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
                                                            <div class="cbp-item graphic"
                                                                 id='pic-<?php echo $image_info['image_id']; ?>'>
                                                                <div class="cbp-caption">
                                                                    <div class="cbp-caption-defaultWrap">
                                                                        <img src="<?php echo base_url() . $image_info['image_path'] . 'large_' . $image_info['image']; ?>"
                                                                             alt="Member Id Proof">
                                                                    </div>
                                                                    <div class="cbp-caption-activeWrap">
                                                                        <div class="cbp-l-caption-alignCenter">
                                                                            <div class="cbp-l-caption-body">
                                                                                <a href="javascript:CommonFunctions.Delete('<?php echo $image_info['image_id']; ?>', 'tb_member_images', 'image_id', 'Are you sure you want to delete this id proof?')"
                                                                                   class="cbp-l-caption-buttonLeft btn red uppercase"
                                                                                   rel="nofollow">Delete</a>
                                                                                <a href="<?php echo base_url() . $image_info['image_path'] . $image_info['image']; ?>"
                                                                                   class="cbp-lightbox cbp-l-caption-buttonRight btn red uppercase btn red uppercase"
                                                                                   data-title="Konsorts.com">view
                                                                                    larger</a>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="cbp-l-grid-projects-title uppercase text-center uppercase text-center">
                                                                    Id proof <?php echo $counter++; ?></div>
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
                                            <form role="form" id="update_privacy_member">
                                                <input type="hidden" name="member_id"
                                                       value="<?php echo $member_info['member_id']; ?>">
                                                <table class="table table-light table-hover">
                                                    <?php
                                                    if (isset($member_info['privacy_info']) && count($member_info['privacy_info']) > 0) {
                                                        foreach ($member_info['privacy_info'] as $privacy) {
                                                            ?>
                                                            <tr>
                                                                <!--<td class="hide"><input type="hidden" name="privacy_id[]" value="<?php // echo $privacy['privacy_id'];                            ?>"></td>-->
                                                                <td><?php echo "Show " . $privacy['privacy_label']; ?></td>
                                                                <td>
                                                                    <div class="mt-radio-inline">
                                                                        <label class="mt-radio">
                                                                            <input type="radio"
                                                                                   name="<?php echo $privacy['privacy_name']; ?>"
                                                                                   value="1" <?php echo $privacy['privacy_status'] == 1 ? "checked='checked'" : ""; ?> />
                                                                            Yes
                                                                            <span></span>
                                                                        </label>
                                                                        <label class="mt-radio">
                                                                            <input type="radio"
                                                                                   name="<?php echo $privacy['privacy_name']; ?>"
                                                                                   value="0" <?php echo $privacy['privacy_status'] == 0 ? "checked='checked'" : ""; ?>/>
                                                                            No
                                                                            <span></span>
                                                                        </label>
                                                                    </div>
                                                                </td>
                                                            </tr>
                                                            <?php
                                                        }
                                                    }
                                                    ?>
                                                </table>
                                                <!--end profile-settings-->
                                                <div class="margin-top-10">
                                                    <input type="submit" name="submit" value="Save Changes"
                                                           class="btn green"/>&nbsp;&nbsp;
                                                    <a href="<?php echo base_url('member/profile'); ?>"
                                                       class="btn default">Cancel</a>
                                                </div>
                                            </form>
                                        </div>
                                        <!-- END PRIVACY SETTINGS TAB -->

                                        <!-- Promo code TAB starts from here -->
                                        <div class="tab-pane" id="tab_1_5">
                                            <input type="hidden" name="member_id" id="promo_member_id"
                                                   value="<?php echo $member_info['member_id']; ?>">
                                            <div class="portlet mt-element-ribbon light portlet-fit bordered">
                                                <div class="ribbon ribbon-right ribbon-clip ribbon-shadow ribbon-border-dash-hor ribbon-color-success uppercase">
                                                    <div class="ribbon-sub ribbon-clip ribbon-right"></div>
                                                    Promo Code.
                                                </div>
                                                <div class="portlet-title">
                                                    <div class="caption">
                                                        <i class="fa fa-tag font-green"></i>
                                                        <span class="caption-subject font-green bold uppercase">Do you have promo code? Enter it here.</span>
                                                    </div>
                                                </div>
                                                <div class="portlet-body">
                                                    <input type="text" name="promo_code" id="promo_code"
                                                           class="form-control" placeholder="Promo Code">
                                                </div>
                                            </div>

                                            <!--end profile-settings-->
                                            <div class="margin-top-10">
                                                <a href="javascript:;" class="btn red"
                                                   onclick="CommonFunctions.SubmitPromoCode()"> Submit </a>
                                            </div>
                                        </div>
                                        <!-- Promo code TAB ends here-->
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- END PROFILE CONTENT -->
            </div>
        </div>
    </div>
</section>
<script>
    $(document).ready(function () {
        GuestMembers.initAddUpdateGuestValidation("update_guest_member");
        PrivacyMembers.initUpdatePrivacyValidation("update_privacy_member");
    });
</script>
<script src="<?php echo base_url(); ?>assets/global/plugins/jquery.sparkline.min.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>assets/custom_scripts/frontend/guest_members.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>assets/custom_scripts/frontend/privacy_members.js"
        type="text/javascript"></script>
<!-- BEGIN PAGE LEVEL SCRIPTS -->
<script src="<?php echo base_url(); ?>assets/global/plugins/cubeportfolio/js/jquery.cubeportfolio.js"
        type="text/javascript"></script>
<script src="<?php echo base_url(); ?>assets/custom_scripts/admin/images_member.js" type="text/javascript"></script>
<script src="<?php echo base_url('assets/custom_scripts/frontend/languages.js'); ?>" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>assets/frontend/datatable/jquery.dataTables.min.js"
        type="text/javascript"></script>
<script src="<?php echo base_url(); ?>assets/slim-image-cropper-test-master/slim/slim.kickstart.min.js"></script>
<script src="<?php echo base_url(); ?>assets/slim-image-cropper-test-master/scripts/scripts.js"></script>
<!-- END PAGE LEVEL SCRIPTS -->
<script>
    $(document).ready(function () {
        $("#language_table").DataTable();
        $("#location").geocomplete();
    });
</script>