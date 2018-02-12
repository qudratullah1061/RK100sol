<script src="//maps.googleapis.com/maps/api/js?key=AIzaSyDVw_YgvMUxH6KawXzlwM9meU3HAUnbsLQ&libraries=places&language=en"></script>
<script src="<?php echo base_url(); ?>assets/geocode/jquery.geocomplete.js" type="text/javascript"></script>
<link href="<?php echo base_url(); ?>assets/slim-image-cropper-test-master/slim/slim.min.css" rel="stylesheet">
<link href="<?php echo base_url(); ?>assets/slim-image-cropper-test-master/styles/styles.css" rel="stylesheet">
<section class="signup-full-cover-image">
    <div class="container">
        <div class="portlet light bordered" id="form_wizard_1">
            <div class="portlet-title">
                <div class="caption">
                    <i class=" icon-user purple"></i>
                    <span class="caption-subject purple bold uppercase"> Create Service Member -
                        <span class="step-title"> Step 1 of 3 </span>
                    </span>
                </div>
            </div>
            <div class="portlet-body form">
                <form class="form-horizontal" id="add_companion_member">
                    <div class="form-wizard">
                        <div class="form-body">
                            <input type="hidden" name='call_type' value="add">
                            <input type="hidden" name='plan_type' value="<?php echo isset($plan_type) ? $plan_type : ""; ?>">
                            <ul class="nav nav-pills nav-justified steps">
                                <li>
                                    <a href="#tab1" data-toggle="tab" class="step active">
                                        <span class="number"> 1 </span>
                                        <span class="desc">
                                            <i class="fa fa-check"></i> Login Details 
                                        </span>
                                    </a>
                                </li>
                                <li>
                                    <a href="#tab2" data-toggle="tab" class="step">
                                        <span class="number"> 2 </span>
                                        <span class="desc">
                                            <i class="fa fa-check"></i> Personal Details 
                                        </span>
                                    </a>
                                </li>
                                <li>
                                    <a href="#tab3" data-toggle="tab" class="step ">
                                        <span class="number"> 3 </span>
                                        <span class="desc">
                                            <i class="fa fa-check"></i> Further Details </span>
                                    </a>
                                </li>
                            </ul>
                            <div id="bar" class="progress progress-striped" role="progressbar">
                                <div class="progress-bar progress-bar-success"> </div>
                            </div>
                            <div class="tab-content">
                                <div class="alert alert-danger display-none">
                                    <button class="close" data-dismiss="alert"></button> Please enter valid data in below fields. 
                                </div>
                                <div class="alert alert-success display-none">
                                    <button class="close" data-dismiss="alert"></button> All data validated successfully! 
                                </div>
                                <div class="tab-pane active" id="tab1">
                                    <h3 class="block text-center">Login Details</h3>

                                    <div class="form-group form-md-line-input">
                                        <label class="control-label col-md-3">Username <span class="required">*</span></label>
                                        <div class="col-md-6">
                                            <input type="text" class="form-control form-md-line-input" name="username">
                                            <label></label>
                                        </div>
                                    </div>
                                    <div class="form-group form-md-line-input">
                                        <label class="control-label col-md-3"> Email <span class="required"> * </span> </label>
                                        <div class="col-md-6">
                                            <input type="email" name="email" id="email" class="form-control">
                                            <label></label>
                                        </div>
                                    </div>

                                    <div class="form-group form-md-line-input">
                                        <label class="control-label col-md-3">Confirm Email <span class="required"> * </span> </label>
                                        <div class="col-md-6">
                                            <input type="email" name="confirm_email" id="confirm_email" class="form-control">
                                            <label></label>
                                        </div>
                                    </div>
                                    <div class="form-group form-md-line-input">
                                        <label class="control-label col-md-3">Password<span class="required"> * </span> </label>
                                        <div class="col-md-6">
                                            <input type="password" name="password" id="password" class="form-control">
                                            <label></label>
                                        </div>
                                    </div>
                                    <div class="form-group form-md-line-input">
                                        <label class="control-label col-md-3">Confirm Password<span class="required"> * </span> </label>
                                        <div class="col-md-6">
                                            <input type="password" name="confirm_password" id="confirm_password" class="form-control">
                                            <label></label>
                                        </div>
                                    </div>

                                    <div class="form-group form-md-line-input">
                                        <label class="control-label col-md-3"> Profile Image <span class="required">*</span></label>
                                        <div class="col-md-6">
                                            <div class="frame profile-image">
                                                <input type="file" id="profile_images" required="required" name="profile_images[]" multiple="multiple" />
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group form-md-line-input">
                                        <label class="control-label col-md-3"> ID Proof <span class="required">*</span></label>
                                        <div class="col-md-6">
                                            <div class="frame id-proof">
                                                <input type="file" id="id_proofs" required="required" name="id_proofs[]" multiple="multiple">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane" id="tab2">
                                    <h3 class="block text-center">Personal Details</h3>
                                    <div class="form-group form-md-line-input">
                                        <label class="control-label col-md-3"> First Name <span class="required"> * </span> </label>
                                        <div class="col-md-6">
                                            <input type="text" class="form-control" name="first_name">
                                            <label></label>
                                        </div>
                                    </div>
                                    <div class="form-group form-md-line-input">
                                        <label class="control-label col-md-3"> Last Name <span class="required"> * </span> </label>
                                        <div class="col-md-6">
                                            <input type="text" class="form-control"  name="last_name">
                                            <label></label>
                                        </div>
                                    </div>

                                    <div class="form-group form-md-line-input">
                                        <label class="control-label col-md-3"> Telephone <span class="required"> * </span> </label>
                                        <div class="col-md-6">
                                            <input type="text" class="form-control" name="phone_number">
                                            <label></label>
                                        </div>
                                    </div>
                                    <div class="form-group form-md-line-input">
                                        <label class="control-label col-md-3"> Date of Birth <span class="required"> * </span> </label>
                                        <div class="col-md-6">
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <select name="years">
                                                        <?php
                                                        $cutoff = 1910;
                                                        $now = date('Y');
                                                        for ($i = $now; $i >= $cutoff; $i--) {
                                                            ?>
                                                            <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
                                                        <?php } ?>
                                                    </select>
                                                </div>
                                                <div class="col-md-4">
                                                    <select name="months">
                                                        <option value="01">January</option>
                                                        <option value="02">February</option>
                                                        <option value="03">March</option>
                                                        <option value="04">April</option>
                                                        <option value="05">May</option>
                                                        <option value="06">June</option>
                                                        <option value="07">July</option>
                                                        <option value="08">August</option>
                                                        <option value="09">September</option>
                                                        <option value="10">October</option>
                                                        <option value="11">November</option>
                                                        <option value="12">December</option>
                                                    </select>
                                                </div>
                                                <div class="col-md-4">
                                                    <select name="days">
                                                        <?php for ($d = 1; $d <= 31; $d++) { ?>
                                                            <option value="<?php echo $d; ?>"><?php echo $d; ?></option>
                                                        <?php } ?>
                                                    </select>
                                                </div>
                                            <!--<input type="text" class="form-control" data-date-format="yyyy-mm-dd" name="date_of_birth">-->
                                                <label></label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group form-md-line-input">
                                        <label class="control-label col-md-3"> Gender </label>
                                        <div class="col-md-6">
                                            <select class="form-control" name="gender">
                                                <option value="">Select Gender</option>
                                                <option value="Male">Male</option>
                                                <option value="Female">Female</option>
                                                <option value="Other">Other</option>
                                            </select>
                                            <label></label>
                                        </div>
                                    </div>

                                    <div class="form-group form-md-line-input">
                                        <label class="control-label col-md-3">Location <span class="required">*</span></label>
                                        <div class="col-md-6">
                                            <input type="text" name="location" id="location" class="location form-control form-md-line-input">
                                            <label></label>
                                        </div>
                                    </div>
                                    <div class="form-group form-md-line-input">
                                        <label class="control-label col-md-3">Zip Code</label>
                                        <div class="col-md-6">
                                            <input type="text" name="zipcode" id="zipcode" class="form-control form-md-line-input">
                                            <label></label>
                                        </div>
                                    </div>

                                    <!--                                    <div class="form-group form-md-line-input form-md-floating-label">
                                                                            <label class="control-label col-md-3">Country<span class="required">*</span></label>
                                                                            <div class="col-md-6">
                                                                                <select class="form-control" name="country" id="dd-country" onchange="CommonFunctions.LoadStates(this.value);">
                                    <?php // echo isset($country_options) ? $country_options : "";   ?>
                                                                                </select>
                                                                                <label></label>
                                                                            </div>
                                                                        </div>
                                                                        <div class="form-group form-md-line-input form-md-floating-label">
                                                                            <label class="control-label col-md-3">State<span class="required">*</span></label>
                                                                            <div class="col-md-6">
                                                                                <select class="form-control" id="dd-state" onchange="CommonFunctions.LoadCities(this.value);" name="state">
                                                                                    <option value="">Select State</option>
                                                                                </select>
                                                                                <label></label>
                                                                            </div>
                                                                        </div>
                                                                        <div class="form-group form-md-line-input form-md-floating-label">
                                                                            <label class="control-label col-md-3">City<span class="required">*</span></label>
                                                                            <div class="col-md-6">
                                                                                <select class="form-control" id="dd-city" name="city">
                                                                                    <option value="">Select City</option>
                                                                                </select>
                                                                                <label></label>
                                                                            </div>
                                                                        </div>-->
                                </div>
                                <div class="tab-pane" id="tab3">
                                    <h3 class="block text-center">Further Details</h3>

                                    <?php
                                    if (isset($categories) && count($categories) > 0) {
                                        foreach ($categories as $category) {
                                            ?>
                                            <div class="form-group form-md-line-input">
                                                <label class="control-label col-md-3"> <?php echo $category['category_name']; ?></label>
                                                <div class="col-md-6">
                                                    <div class="md-checkbox-inline row">
                                                        <!--get sub categories and loop through-->
                                                        <?php
                                                        $sub_categories = getSubCategoriesByCategoryId($category['category_id']);
                                                        if ($sub_categories && count($sub_categories) > 0) {
                                                            foreach ($sub_categories as $sub_cat) {
                                                                ?>
                                                                <div class="col-md-6">
                                                                    <div class="md-checkbox">
                                                                        <input type="checkbox" name='categories[]' value="<?php echo $category['category_id'] . "::" . $sub_cat['sub_category_id']; ?>" id="checkbox<?php echo $category['category_id'] . $sub_cat['sub_category_id']; ?>" class="md-check">
                                                                        <label for="checkbox<?php echo $category['category_id'] . $sub_cat['sub_category_id']; ?>">
                                                                            <span></span>
                                                                            <span class="check"></span>
                                                                            <span class="box"></span> <?php echo $sub_cat['sub_category_name']; ?></label>
                                                                    </div>
                                                                </div>
                                                                <?php
                                                            }
                                                        }
                                                        ?>
                                                    </div>
                                                </div>
                                            </div>
                                            <?php
                                        }
                                    }
                                    ?>

                                    <div class="form-group form-md-line-input">
                                        <label class="control-label col-md-3"> About Me <span class="required"> * </span> </label>
                                        <div class="col-md-6">
                                            <textarea  class="form-control" name="about_me" placeholder=""></textarea>
                                            <label for="form_control_1"></label>
                                            <!--<span class="help-block">Some help goes here...</span>-->
                                        </div>
                                    </div>

                                    <div class="form-group form-md-line-input">
                                        <label class="control-label col-md-3"> Other Specific Interest  </label>
                                        <div class="col-md-6">
                                            <input type="text" name='other_interest' class="form-control"  placeholder="">
                                            <label for="form_control_1"></label>
                                            <!--<span class="help-block">Some help goes here...</span>-->
                                        </div>
                                    </div>


                                </div>

                            </div>
                        </div>
                        <div class="form-actions">
                            <div class="row">
                                <div class="col-md-offset-3 col-md-9">
                                    <a href="javascript:;" class="btn default button-previous">
                                        <i class="fa fa-angle-left"></i> Back </a>
                                    <a href="javascript:;" class="btn btn-outline green button-next"> Continue
                                        <i class="fa fa-angle-right"></i>
                                    </a>
                                    <a href="javascript:;" class="btn green button-submit"> Submit
                                        <i class="fa fa-check"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>
<script src="<?php echo base_url(); ?>assets/global/plugins/bootstrap-wizard/jquery.bootstrap.wizard.min.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>assets/custom_scripts/frontend/companion-form-wizard.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>assets/slim-image-cropper-test-master/slim/slim.kickstart.min.js"></script>
<script src="<?php echo base_url(); ?>assets/slim-image-cropper-test-master/scripts/scripts.js"></script>
<script>
    $(function () {
        $("#location").geocomplete(
//                                                            {
//                                                        details: ".geo-details",
//                                                        detailsAttribute: "data-geo"
//                                                    }
                );
    });
</script>