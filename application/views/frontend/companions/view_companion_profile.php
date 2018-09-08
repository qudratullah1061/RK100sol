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

        <!-- END PAGE BAR -->
        <!--<h1 class="page-title"> Service Member Profile | Account
            <small>Service member account page</small>
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
                            <img src="<?php echo file_exists($this->config->item('root_path') . $member_info['image_path'] . 'medium_' . $member_info['image']) ? base_url($member_info['image_path'] . 'medium_' . $member_info['image']) : base_url('uploads/member_images/profile/user.png'); ?>" class="img-responsive" alt="User Profile Pic">
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
                                    <!--                                    <div class="caption caption-md">
                                                                            <i class="icon-globe theme-font hide"></i>
                                                                            <span class="caption-subject font-blue-madison bold uppercase">Profile Info</span>
                                                                        </div>-->
                                    <ul class="nav nav-tabs">
                                        <li class="active" onclick="CommonFunctions.changeHash('#tab_1_1')">
                                            <a href="#tab_1_1" data-toggle="tab">Personal Info</a>
                                        </li>
                                        <li onclick="CommonFunctions.changeHash('#tab_1_2')">
                                            <a href="#tab_1_2" data-toggle="tab">Availabilities</a>
                                        </li>
                                        <li onclick="CommonFunctions.changeHash('#tab_1_3')">
                                            <a href="#tab_1_3"
                                               onclick="load_member_profile_images();load_member_id_proofs();"
                                               data-toggle="tab">Images</a>
                                        </li>
                                        <li onclick="CommonFunctions.changeHash('#tab_1_4')">
                                            <a href="#tab_1_4" data-toggle="tab">Portfolio</a>
                                        </li>
                                        <li onclick="CommonFunctions.changeHash('#tab_1_5')">
                                            <a href="#tab_1_5" data-toggle="tab">Languages</a>
                                        </li>
                                        <li onclick="CommonFunctions.changeHash('#tab_1_6')">
                                            <a href="#tab_1_6" data-toggle="tab">Education</a>
                                        </li>
                                        <li onclick="CommonFunctions.changeHash('#tab_1_7')">
                                            <a href="#tab_1_7" data-toggle="tab">Experience</a>
                                        </li>
                                        <li onclick="CommonFunctions.changeHash('#tab_1_8')">
                                            <a href="#tab_1_8" data-toggle="tab">Certification</a>
                                        </li>
                                        <li onclick="CommonFunctions.changeHash('#tab_1_9')">
                                            <a href="#tab_1_9" data-toggle="tab">Privacy</a>
                                        </li>
                                        <li onclick="CommonFunctions.changeHash('#tab_1_10')">
                                            <a href="#tab_1_10" data-toggle="tab">Promos</a>
                                        </li>
                                        <li onclick="CommonFunctions.changeHash('#tab_1_11')">
                                            <a href="#tab_1_11" data-toggle="tab">Subscription</a>
                                        </li>
                                    </ul>
                                </div>
                                <div class="portlet-body">
                                    <div class="tab-content">
                                        <!-- PERSONAL INFO TAB -->
                                        <div class="tab-pane active" id="tab_1_1">
                                            <form role="form" id="update_companion_member" method="post">
                                                <input type="hidden" name="member_id"
                                                       value="<?php echo $member_info['member_id']; ?>">
                                                <div class="form-group col-md-6">
                                                    <label class="control-label">Service Member ID<span
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
                                                    <label class="control-label">Other Interest</label>
                                                    <textarea class="form-control" rows="3" name="other_interest"
                                                              placeholder="Other Interest"><?php echo $member_info['other_interest']; ?></textarea>
                                                </div>
                                                <div class="form-group col-md-6">
                                                    <label class="control-label">About*</label>
                                                    <textarea class="form-control" rows="3" name="about_me"
                                                              placeholder="About Me"><?php echo $member_info['about_me']; ?></textarea>
                                                </div>
                                                <div class="clearfix"></div>
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
                                                               class="btn green"/>
                                                        <a href="<?php echo base_url('member/profile'); ?>"
                                                           class="btn default"> Cancel </a>
                                                    </div>
                                                </div>
                                                <div class="clearfix"></div>
                                            </form>

                                        </div>
                                        <!-- END PERSONAL INFO TAB -->

                                        <!-- Availabilities SETTINGS TAB -->
                                        <div class="tab-pane" id="tab_1_2">
                                            <table class="table table-striped table-hover table-bordered"
                                                   cellspacing="0" width="100%" id="categories_rate_tbl">
                                                <thead>
                                                    <tr>
                                                        <th style="display: none;"></th>
                                                        <th> Sub Category Name</th>
                                                        <th> Rate</th>
                                                        <th> Description</th>
                                                        <th> Is Active</th>
                                                        <th> Edit</th>
                                                        <th> Delete</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php foreach ($sub_category_rates as $rate) { ?>
                                                        <tr>
                                                            <td style="display: none;"><?php echo $rate['tb_member_category_id']; ?></td>
                                                            <td> <?php echo getSubCategoryNameById($rate['sub_category_id']); ?> </td>
                                                            <td> <?php echo $rate['rate']; ?> </td>
                                                            <td> <?php echo $rate['description']; ?> </td>
                                                            <td class="center"> <?php echo $rate['is_active']; ?> </td>
                                                            <td>
                                                                <a class="edit" href="javascript:void(0);"> <i
                                                                        class="fa fa-pencil-square-o"
                                                                        style="font-size: 15px;"></i> </a>
                                                            </td>
                                                            <td>
                                                                <a class="delete" href="javascript:;"> <i
                                                                        class="fa fa-trash-o"
                                                                        style="font-size: 15px;"></i> </a>
                                                            </td>
                                                        </tr>
                                                    <?php }
                                                    ?>
                                                </tbody>
                                            </table>
                                            <!-- Profile images start-->
                                            <form role="form"
                                                  action="<?php echo base_url('companions/update_companion_categories'); ?>"
                                                  id="form_update_member_categories">
                                                <input type="hidden" name="member_id"
                                                       value="<?php echo $member_info['member_id']; ?>">
                                                <div>
                                                    <?php
                                                    if (isset($categories) && count($categories) > 0) {
                                                        foreach ($categories as $category) {
                                                            ?>
                                                            <!--<div class="form-group form-md-line-input">-->
                                                            <h4 class="control-label col-md-12 font-blue-madison"> <?php echo $category['category_name']; ?></h4>
                                                            <div class="col-md-12">
                                                                <div class="md-checkbox-inline row">
                                                                    <!--get sub categories and loop through-->
                                                                    <?php
                                                                    $sub_categories = getSubCategoriesByCategoryId($category['category_id']);
                                                                    if ($sub_categories && count($sub_categories) > 0) {
                                                                        foreach ($sub_categories as $sub_cat) {
                                                                            $seleced = "";
                                                                            if (in_array($sub_cat['sub_category_id'], array_column($selected_categories, 'sub_category_id')) && in_array($category['category_id'], array_column($selected_categories, 'category_id'))) {
                                                                                $seleced = 'checked="checked"';
                                                                            }
                                                                            ?>
                                                                            <div class="col-md-6 form-group">
                                                                                <div class="md-checkbox">
                                                                                    <input type="checkbox" <?php echo $seleced; ?>
                                                                                           name='categories[]'
                                                                                           value="<?php echo $category['category_id'] . "::" . $sub_cat['sub_category_id']; ?>"
                                                                                           id="checkbox<?php echo $category['category_id'] . $sub_cat['sub_category_id']; ?>"
                                                                                           class="md-check">
                                                                                    <label for="checkbox<?php echo $category['category_id'] . $sub_cat['sub_category_id']; ?>">
                                                                                        <span></span>
                                                                                        <span class="check"></span>
                                                                                        <span class="box"></span> <?php echo $sub_cat['sub_category_name']; ?>
                                                                                    </label>
                                                                                </div>
                                                                            </div>
                                                                            <?php
                                                                        }
                                                                    }
                                                                    ?>
                                                                </div>
                                                            </div>
                                                            <div class='clearfix'></div>
                                                            <!--</div>-->
                                                            <?php
                                                        }
                                                    }
                                                    ?>
                                                </div>
                                                <div class="margin-top-20 text-right">
                                                    <input type='submit' name="submit" value="Save Changes"
                                                           class="btn green">
                                                    <a href="<?php echo base_url('member/profile'); ?>"
                                                       class="btn default"> Cancel </a>
                                                </div>
                                            </form>
                                        </div>
                                        <!-- Availabilities SETTINGS TAB end-->
                                        <!-- IMAGES SETTINGS TAB -->
                                        <div class="tab-pane" id="tab_1_3">
                                            <!-- Profile images start-->
                                            <div class="note note-info">
                                                <p>Upload Profile Images Here.</p>
                                            </div>
                                            <form class="form-horizontal text-center"
                                                  action="<?php echo base_url('profile/upload_images_member'); ?>"
                                                  method="post">
                                                <input type="hidden" name="member_id"
                                                       value="<?php echo $member_info['member_id']; ?>">
                                                <input type="hidden" name="member_type" value="companion">
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
                                                                               class="cbp-l-caption-buttonLeft btn red uppercase btn-xs"
                                                                               rel="nofollow">Delete</a>
                                                                            <a href="javascript:CommonFunctions.MakeProfileImage('<?php echo $image_info['image_id']; ?>', '<?php echo $image_info['member_id']; ?>')"
                                                                               class="cbp-l-caption-buttonLeft btn red uppercase btn-xs"
                                                                               rel="nofollow">Make profile</a>
                                                                            <a href="<?php echo base_url() . $image_info['image_path'] . $image_info['image']; ?>"
                                                                               class="cbp-lightbox cbp-l-caption-buttonRight btn red uppercase btn red uppercase"
                                                                               data-title="Konsorts.com">view larger</a>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="cbp-l-grid-projects-title uppercase text-center uppercase pic-caption-img text-center pic-caption-<?php echo $image_info['image_id']; ?>" <?php echo $image_info['is_profile_image'] ? "style='color:green;'" : ""; ?>>
                                                                Image <?php echo $counter++; ?></div>
                                                            <!--<div class="cbp-l-grid-projects-desc uppercase text-center uppercase text-center pic-caption-img "><?php // echo $image_info['is_profile_image'] ? "Profile Pic" : "";                                ?></div>-->
                                                        </div>
                                                        <?php
                                                    }
                                                }
                                                ?>
                                            </div>

                                            <!-- Profile images ends-->

                                            <!-- Id proof images start-->
                                            <div class="margin-top-20">
                                                <div class="note note-info">
                                                    <p>Upload ID Proof Images Here.</p>
                                                </div>
                                                <form class="form-horizontal text-center"
                                                      action="<?php echo base_url('profile/upload_images_member'); ?>"
                                                      method="post">
                                                    <input type="hidden" name="member_id"
                                                           value="<?php echo $member_info['member_id']; ?>">
                                                    <input type="hidden" name="member_type" value="companion">
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
                                                                             alt="Member ID Proof">
                                                                    </div>
                                                                    <div class="cbp-caption-activeWrap">
                                                                        <div class="cbp-l-caption-alignCenter">
                                                                            <div class="cbp-l-caption-body">
                                                                                <a href="javascript:CommonFunctions.Delete('<?php echo $image_info['image_id']; ?>', 'tb_member_images', 'image_id', 'Are you sure you want to delete this id proof?')"
                                                                                   class="cbp-l-caption-buttonLeft btn red uppercase btn-xs"
                                                                                   rel="nofollow">Delete</a>
                                                                                <a href="<?php echo base_url() . $image_info['image_path'] . $image_info['image']; ?>"
                                                                                   class="cbp-lightbox cbp-l-caption-buttonRight btn red uppercase btn red uppercase btn-xs"
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

                                        <!--Portfolio tab starts from here-->
                                        <div class="tab-pane" id="tab_1_4">
                                            <div id="" class="table-responsive">
                                                <div class="table-actions-wrapper margin-bottom-20">
                                                    <span> </span>
                                                    <a class="purple" data-title="Add Type"
                                                       href="javascript:Portfolios.modal_add_portfolio()"><i
                                                            class="fa fa-plus-circle"></i> Add portfolio</a>
                                                </div>
                                                <table id="portfolio_table"
                                                       class="table table-striped table-bordered table-hover table-checkable text-center dataTable no-footer"
                                                       cellspacing="0" width="100%">
                                                    <thead>
                                                        <tr>
                                                            <th>Image</th>
                                                            <th>Title</th>
                                                            <th>Country</th>
                                                            <th>State</th>
                                                            <th>City</th>
                                                            <th>Added On</th>
                                                            <!--<th>Updated On</th>-->
                                                            <th>Status</th>
                                                            <th>Actions</th>
                                                        </tr>
                                                    </thead>

                                                    <tbody>
                                                        <?php foreach ($portfolios as $portfolio) { ?>
                                                            <tr>
                                                                <td><img alt="Profile Image" class="img-circle"
                                                                         src="<?php echo base_url($portfolio['portfolio_image_path'] . 'small_' . $portfolio['portfolio_image']); ?>">
                                                                </td>
                                                                <td><?php echo $portfolio['portfolio_title']; ?></td>
                                                                <td><?php echo $portfolio['country_name']; ?></td>
                                                                <td><?php echo $portfolio['state_name']; ?></td>
                                                                <td><?php echo $portfolio['city_name']; ?></td>
                                                                <td><?php echo date('Y-m-d', strtotime($portfolio['created_on'])); ?></td>
                                                                <!--<td><?php // echo date('Y-m-d', strtotime($portfolio['updated_on']));                                ?></td>-->
                                                                <td>
                                                                    <div class="md-checkbox-inline">
                                                                        <div class="md-checkbox">
                                                                            <input type="checkbox" disabled="disabled"
                                                                                   id="checkbox<?php echo $portfolio['portfolio_id']; ?>" <?php echo($portfolio['is_active'] ? "checked='checked'" : ""); ?>
                                                                                   class="md-check">
                                                                            <label for="checkbox<?php echo $portfolio['portfolio_id']; ?>">
                                                                                <span></span>
                                                                                <span class="check"></span>
                                                                                <span class="box"></span>
                                                                            </label>
                                                                        </div>
                                                                    </div>
                                                                </td>
                                                                <td><a class="btn btn-xs default btn-editable"
                                                                       onclick="Portfolios.modal_add_portfolio(<?php echo $portfolio['portfolio_id']; ?>)">Edit</a>
                                                                    <a class="btn btn-xs default btn-editable"
                                                                       onclick="CommonFunctions.Delete(<?php echo $portfolio["portfolio_id"]; ?>, 'tb_member_portfolios', 'portfolio_id', 'Portfolio will be permanently deleted without further warning. Do you really want to delete this portfolio image?');">Delete</i></a>
                                                                </td>
                                                            </tr>
                                                        <?php } ?>

                                                    </tbody>
                                                </table>
                                            </div>
                                            <!-- Profile images ends-->
                                            <!-- Id proof images start-->
                                        </div>
                                        <!--Portfolio tabs ends here-->
                                        <!--Languages tab starts from here-->
                                        <div class="tab-pane" id="tab_1_5">
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


                                        <div class="tab-pane" id="tab_1_6">
                                            <div id="" class="table-responsive">
                                                <div class="table-actions-wrapper margin-bottom-20">
                                                    <span> </span>
                                                    <a class="purple" data-title="Add Type"
                                                       href="javascript:Degrees.modal_add_degree()"><i
                                                            class="fa fa-plus-circle"></i> Add Degree</a>
                                                </div>
                                                <table id="education_table"
                                                       class="table table-striped table-bordered table-hover text-center dataTable no-footer"
                                                       cellspacing="0" width="100%">
                                                    <thead>
                                                        <tr>
                                                            <th width="25%"> Title</th>
                                                            <th width="25%">Deg. Name</th>
                                                            <th width="10%">Start Date</th>
                                                            <th width="10%">End Date</th>

                                                            <th width="10%">Status</th>
                                                            <th width="10%">Actions</th>
                                                        </tr>
                                                    </thead>

                                                    <tbody>
                                                        <?php foreach ($degrees as $value) { ?>
                                                            <tr>

                                                                <td><?php echo $value['title']; ?></td>
                                                                <td><?php echo $value['degree_name']; ?></td>
                                                                <td><?php echo $value['start_date']; ?></td>
                                                                <td><?php echo $value['end_date']; ?></td>


                                                                <td>
                                                                    <div class="md-checkbox-inline">
                                                                        <div class="md-checkbox">
                                                                            <input type="checkbox" disabled="disabled"
                                                                                   id="checkbox<?php echo $value['member_degree_id']; ?>" <?php echo($value['pub_status'] == 1 ? "checked='checked'" : ""); ?>
                                                                                   class="md-check">
                                                                            <label for="checkbox<?php echo $value['member_degree_id']; ?>">
                                                                                <span></span>
                                                                                <span class="check"></span>
                                                                                <span class="box"></span>
                                                                            </label>
                                                                        </div>
                                                                    </div>
                                                                </td>
                                                                <td><a class="btn btn-xs default btn-editable"
                                                                       onclick="Degrees.modal_add_degree(<?php echo $value['member_degree_id']; ?>)">Edit</a>
                                                                    <a class="btn btn-xs default btn-editable"
                                                                       onclick="CommonFunctions.Delete(<?php echo $value["member_degree_id"]; ?>, 'tb_member_degrees', 'member_degree_id', 'Are you sure you want to delete ?');">Delete</a>
                                                                </td>
                                                            </tr>
                                                        <?php } ?>

                                                    </tbody>
                                                </table>
                                            </div>
                                            <!-- Profile images ends-->
                                            <!-- Id proof images start-->
                                        </div>


                                        <div class="tab-pane" id="tab_1_7">
                                            <div id="" class="table-responsive">
                                                <div class="table-actions-wrapper margin-bottom-20">
                                                    <span> </span>
                                                    <a class="purple" data-title="Add Type"
                                                       href="javascript:Experiences.modal_add_experience()"><i
                                                            class="fa fa-plus-circle"></i> Add Experience</a>
                                                </div>
                                                <table id="experience_table"
                                                       class="table table-striped table-bordered table-hover text-center dataTable no-footer"
                                                       cellspacing="0" width="100%">
                                                    <thead>
                                                        <tr>

                                                            <th>Title</th>
                                                            <th>Position</th>
                                                            <th>Start Date</th>
                                                            <th>End Date</th>


                                                            <th>Pub Status</th>
                                                            <th>Actions</th>
                                                        </tr>
                                                    </thead>

                                                    <tbody>
                                                        <?php foreach ($experiences as $value) { ?>
                                                            <tr>

                                                                <td><?php echo $value['title']; ?></td>
                                                                <td><?php echo $value['position']; ?></td>
                                                                <td><?php echo $value['start_date']; ?></td>
                                                                <td><?php echo $value['end_date']; ?></td>


                                                                <td>
                                                                    <div class="md-checkbox-inline">
                                                                        <div class="md-checkbox">
                                                                            <input type="checkbox" disabled="disabled"
                                                                                   id="checkbox<?php echo $value['member_experience_id']; ?>" <?php echo($value['pub_status'] == 1 ? "checked='checked'" : ""); ?>
                                                                                   class="md-check">
                                                                            <label for="checkbox<?php echo $value['member_experience_id']; ?>">
                                                                                <span></span>
                                                                                <span class="check"></span>
                                                                                <span class="box"></span>
                                                                            </label>
                                                                        </div>
                                                                    </div>
                                                                </td>
                                                                <td><a class="btn btn-xs default btn-editable"
                                                                       onclick="Experiences.modal_add_experience(<?php echo $value['member_experience_id']; ?>)">Edit</a>
                                                                    <a class="btn btn-xs default btn-editable"
                                                                       onclick="CommonFunctions.Delete(<?php echo $value["member_experience_id"]; ?>, 'tb_member_experience', 'member_experience_id', 'Are you sure you want to delete ?');">Delete</i></a>
                                                                </td>
                                                            </tr>
                                                        <?php } ?>

                                                    </tbody>
                                                </table>
                                            </div>
                                            <!-- Profile images ends-->
                                            <!-- Id proof images start-->
                                        </div>

                                        <div class="tab-pane" id="tab_1_8">
                                            <div id="" class="table-responsive">
                                                <div class="table-actions-wrapper margin-bottom-20">
                                                    <span> </span>
                                                    <a class="purple" data-title="Add Type"
                                                       href="javascript:Certifications.modal_add_certification()"><i
                                                            class="fa fa-plus-circle"></i> Add Certification</a>
                                                </div>
                                                <table id="certification_table"
                                                       class="table table-striped table-bordered table-hover text-center dataTable no-footer"
                                                       cellspacing="0" width="100%">
                                                    <thead>
                                                        <tr>

                                                            <th>Image</th>
                                                            <th>Title</th>
                                                            <th>Description</th>


                                                            <th>Pub Status</th>
                                                            <th>Actions</th>
                                                        </tr>
                                                    </thead>

                                                    <tbody>
                                                        <?php foreach ($certifications as $value) { ?>
                                                            <tr>
                                                                <td><img alt="Certification Image" class="img-circle"
                                                                         src="<?php echo base_url($value['certification_image_path'] . 'small_' . $value['certification_image']); ?>">
                                                                </td>
                                                                <td><?php echo $value['title']; ?></td>
                                                                <td><?php echo $value['description']; ?></td>


                                                                <td>
                                                                    <div class="md-checkbox-inline">
                                                                        <div class="md-checkbox">
                                                                            <input type="checkbox" disabled="disabled"
                                                                                   id="checkbox<?php echo $value['member_certification_id']; ?>" <?php echo($value['pub_status'] == 1 ? "checked='checked'" : ""); ?>
                                                                                   class="md-check">
                                                                            <label for="checkbox<?php echo $value['member_certification_id']; ?>">
                                                                                <span></span>
                                                                                <span class="check"></span>
                                                                                <span class="box"></span>
                                                                            </label>
                                                                        </div>
                                                                    </div>
                                                                </td>
                                                                <td><a class="btn btn-xs default btn-editable"
                                                                       onclick="Certifications.modal_add_certification(<?php echo $value['member_certification_id']; ?>)">Edit</a>
                                                                    <a class="btn btn-xs default btn-editable"
                                                                       onclick="CommonFunctions.Delete(<?php echo $value["member_certification_id"]; ?>, 'tb_member_certifications', 'member_certification_id', 'Are you sure you want to delete ?');">Delete</i></a>
                                                                </td>
                                                            </tr>
                                                        <?php } ?>

                                                    </tbody>
                                                </table>
                                            </div>
                                            <!-- Profile images ends-->
                                            <!-- Id proof images start-->
                                        </div>

                                        <!-- PRIVACY SETTINGS TAB -->
                                        <div class="tab-pane" id="tab_1_9">
                                            <form role="form" id="update_privacy_member">
                                                <table class="table table-light table-hover">
                                                    <input type="hidden" name="member_id"
                                                           value="<?php echo $member_info['member_id']; ?>">
                                                           <?php
                                                           if (isset($member_info['privacy_info']) && count($member_info['privacy_info']) > 0) {
                                                               foreach ($member_info['privacy_info'] as $privacy) {
                                                                   ?>
                                                            <tr>
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
                                        <div class="tab-pane" id="tab_1_10">
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

                                        <!-- Subscription TAB starts from here -->
                                        <div class="tab-pane" id="tab_1_11">
                                            <?php if (isset($error_msg) && trim($error_msg) != "") { ?>
                                                <div class="alert alert-danger">
                                                    <button type="button" class="close" data-dismiss="alert"
                                                            aria-hidden="true">×
                                                    </button>
                                                    <span><?php echo $error_msg; ?></span>
                                                </div>
                                            <?php } ?>
                                            <div class="form-group">
                                                <input type="hidden" name="member_id" id="member_id"
                                                       value="<?php echo $member_info['member_id']; ?>">
                                                <label>Select Membership Plan<span class="required">*</span></label>
                                                <select class="form-control payment_options" name="payment_amount">
                                                    <option value="">Select Membership Plan</option>
                                                    <?php
                                                    foreach ($plans as $plan) {
                                                        echo "<option data-plan-id='" . $plan['plan_id'] . "' data-currency='" . $plan['plan_currency'] . "' value='" . $plan['plan_price'] . "'>" . $plan['plan_name'] . " " . $plan['plan_price'] . " (" . $plan['plan_currency'] . ")" . "</option>";
                                                    }
                                                    ?>
                                                </select>
                                            </div>
                                            <div class="text-center">
                                                <div id="paypal-button-container"></div>
                                            </div>
                                        </div>
                                        <!-- Subscription TAB ends here-->
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
<script src="<?php echo base_url(); ?>assets/custom_scripts/frontend/companion-form-wizard.js"
type="text/javascript"></script>
<script src="<?php echo base_url(); ?>assets/global/plugins/jquery.sparkline.min.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>assets/custom_scripts/frontend/privacy_members.js"
type="text/javascript"></script>
<!-- BEGIN PAGE LEVEL SCRIPTS -->
<script src="<?php echo base_url(); ?>assets/global/plugins/cubeportfolio/js/jquery.cubeportfolio.js"
type="text/javascript"></script>
<script src="<?php echo base_url(); ?>assets/custom_scripts/admin/images_member.js" type="text/javascript"></script>
<!-- END PAGE LEVEL SCRIPTS -->
<script src="<?php echo base_url('assets/custom_scripts/frontend/portfolio.js'); ?>" type="text/javascript"></script>
<script src="<?php echo base_url('assets/custom_scripts/frontend/education.js'); ?>" type="text/javascript"></script>
<script src="<?php echo base_url('assets/custom_scripts/frontend/experience.js'); ?>" type="text/javascript"></script>
<script src="<?php echo base_url('assets/custom_scripts/frontend/certification.js'); ?>"
type="text/javascript"></script>
<script src="<?php echo base_url('assets/custom_scripts/frontend/languages.js'); ?>" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>assets/frontend/datatable/jquery.dataTables.min.js"
type="text/javascript"></script>
<script src="<?php echo base_url(); ?>assets/slim-image-cropper-test-master/slim/slim.kickstart.min.js"></script>
<script src="<?php echo base_url(); ?>assets/slim-image-cropper-test-master/scripts/scripts.js"></script>
<script type="text/javascript"
src="<?php echo base_url('assets/pages/'); ?>scripts/table-datatables-editable.js"></script>
<script src="https://www.paypalobjects.com/api/checkout.js"></script>
<script>
                                                       $(document).ready(function () {
                                                           FormWizard.handleCompanionValidation("update_companion_member");
                                                           FormWizard.handleMemberCategoriesUpdate("form_update_member_categories");
                                                           PrivacyMembers.initUpdatePrivacyValidation("update_privacy_member");
                                                           $("#portfolio_table").DataTable({"scrollX": false});
                                                           $("#language_table").DataTable({"scrollX": false});
                                                           $("#experience_table").DataTable({"scrollX": false});
                                                           $("#education_table").DataTable({"scrollX": false});
                                                           $("#certification_table").DataTable({"scrollX": false});
                                                           $("#location").geocomplete();
                                                       });
                                                       var price;
                                                       var plan_id;
                                                       var currency;
                                                       var initPaypalChk = false;
                                                       $(".payment_options").change(function () {
                                                           price = $(this).val();
                                                           currency = $(this).find(':selected').data('currency');
                                                           plan_id = $(this).find(':selected').data('plan-id');
                                                           if (!initPaypalChk) {
                                                               initPaypal();
                                                               initPaypalChk = true;
                                                           }
                                                       });

                                                       function initPaypal() {
                                                           paypal.Button.render({
                                                               env: 'sandbox', // sandbox | production

                                                               // PayPal Client IDs - replace with your own
                                                               // Create a PayPal app: https://developer.paypal.com/developer/applications/create
                                                               client: {
                                                                   sandbox: 'Adf_99ThxemIWJTyAN5YW3uJAUodR-tNgehq7BIKjTT631_LUZD8nl0DtJ5psvZ4S8GmQHDLZpnyaj2j',
                                                                   production: 'ASrI31ib95JJ_anCBtLqLeG4ufIx_AUn1lfOZbEfBdkVkpEwnqcaB8FG5zGz__L_E2dqo__YZ8inB_xf'
                                                               },

                                                               // Show the buyer a 'Pay Now' button in the checkout flow
                                                               commit: true,
                                                               // payment() is called when the button is clicked
                                                               payment: function (data, actions) {
                                                                   // Make a call to the REST api to create the payment
                                                                   return actions.payment.create({
                                                                       payment: {
                                                                           transactions: [
                                                                               {
                                                                                   amount: {total: price, currency: currency}
                                                                               }
                                                                           ]
                                                                       }
                                                                   });
                                                               },
                                                               onCancel: function (data, actions) {
                                                                   swal("Error!", "You have canceled the payment procedure, please pay your subscription charges in order to activate your account.", "warning");
                                                               },

                                                               onError: function (err) {
                                                                   swal("Error!", "Please select membership plan to pay with paypal.", "warning");
                                                               },
                                                               // onAuthorize() is called when the buyer approves the payment
                                                               onAuthorize: function (data, actions) {

                                                                   return actions.payment.get().then(function (data) {
                                                                       var member_id = $("#member_id").val();
                                                                       CommonFunctions.ExecutePayment(data, member_id, plan_id);
                                                                       // Make a call to the REST api to execute the payment
                                                                   });
                                                               }

                                                           }, '#paypal-button-container');
                                                       }
</script>