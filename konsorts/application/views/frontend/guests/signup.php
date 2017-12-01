<?php
$unique_id = time();
?>
<!--profile page css-->
<link href="<?php echo base_url(); ?>assets/pages/css/profile.min.css" rel="stylesheet" type="text/css" />
<section class="pricing membership-plans">
    <div class="container">
        <div class="portlet box blue">
            <div class="portlet-title">
                <div class="caption">
                    <i class="fa fa-user"></i>Guest Member Registration
                </div>
            </div>
            <div class="portlet-body">
                <div class="row add-guest">
                    <div class="col-md-12">
                        <!-- BEGIN PROFILE SIDEBAR -->
                        <div class="profile-sidebar">
                            <!-- PORTLET MAIN -->
                            <div class="portlet light profile-sidebar-portlet ">
                                <!-- SIDEBAR USERPIC -->
                                <!--<div class="">-->
                                <!--<div class="row">-->
                                <div class="col-md-12">
                                    <form action="<?php echo base_url('guests/upload_images'); ?>" class="dropzone dropzone-file-area" id="my-dropzone" >
                                        <input type="hidden" name="file_upload_unique_id" value="<?php echo $unique_id; ?>">
                                        <input type="hidden" name="image_type" value="profile">
                                        <!--<label>Upload Image</label>-->
                                        <h3 class="sbold">Click to upload</h3>
                                        <p> Upload Guest Member Profile Images </p>
                                    </form>
                                </div>
                                <div class="clearfix"></div>
                                <!--</div>-->
                                <!--</div>-->
                            </div>
                            <!-- END PORTLET MAIN -->
                            <!-- PORTLET MAIN -->

                            <!-- END PORTLET MAIN -->
                        </div>
                        <!-- END BEGIN PROFILE SIDEBAR -->
                        <!-- BEGIN PROFILE CONTENT -->
                        <div class="profile-content">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="portlet light ">
                                        <div class="portlet-body">
                                            <div class="portlet-body form">
                                                <form role="form" id="add_guest_member">
                                                    <input type="hidden" name="file_upload_unique_id" value="<?php echo $unique_id; ?>">
                                                    <!--<h3 class="block ">Guest Details</h3>-->
                                                    <div class="form-body">
                                                        <div class="row">
                                                            <div class="col-md-6">
                                                                <div class="form-group form-md-line-input form-md-floating-label">
                                                                    <input type="text" class="form-control"  placeholder="" name="first_name">
                                                                    <label>First Name <span class="required">*</span></label>
                                                                    <!--<span class="help-block">Some help goes here...</span>-->
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <div class="form-group form-md-line-input form-md-floating-label">
                                                                    <input type="text" class="form-control"  placeholder="" name="last_name">
                                                                    <label>Last Name<span class="required">*</span></label>
                                                                    <!--<span class="help-block">Some help goes here...</span>-->
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <div class="form-group form-md-line-input form-md-floating-label">
                                                                    <input type="text" class="form-control"  placeholder="" name="username">
                                                                    <label>Username<span class="required">*</span></label>
                                                                    <!--<span class="help-block">Some help goes here...</span>-->
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <div class="form-group form-md-line-input form-md-floating-label">
                                                                    <input type="email" class="form-control"  placeholder="" name="email">
                                                                    <label>Email Address<span class="required">*</span></label>
                                                                    <!--<span class="help-block">Some help goes here...</span>-->
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <div class="form-group form-md-line-input form-md-floating-label">
                                                                    <input type="password" class="form-control" id="password" placeholder="" name="password">
                                                                    <label>Password<span class="required">*</span></label>
                                                                    <!--<span class="help-block">Some help goes here...</span>-->
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <div class="form-group form-md-line-input form-md-floating-label">
                                                                    <input type="password" class="form-control" id="confirm_password" name="confirm_password">
                                                                    <label>Confirm Password<span class="required">*</span></label>
                                                                    <!--<span class="help-block">Some help goes here...</span>-->
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6" style="position:relative;">
                                                                <div class="form-group form-md-line-input form-md-floating-label">
                                                                    <input class="form-control dateofbirht" type="text" data-date-format="yyyy-mm-dd" value="" name="date_of_birth" />
                                                                    <label>Date of birth<span class="required">*</span></label>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <div class="form-group form-md-line-input ">
                                                                    <input type="file" class="form-control" multiple="multiple"  placeholder="" name="id_proofs[]">
                                                                    <label>Id Proofs<span class="required">*</span></label>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <div class="form-group form-md-line-input form-md-floating-label">
                                                                    <input type="text" class="form-control"  placeholder="" name="phone_number">
                                                                    <label>Phone Number<span class="required">*</span></label>
                                                                    <!--<span class="help-block">Some help goes here...</span>-->
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <div class="form-group form-md-line-input form-md-floating-label">
                                                                    <select class="form-control" name="gender">
                                                                        <option></option>
                                                                        <option value="Male">Male</option>
                                                                        <option value="Female">Female</option>
                                                                        <option value="Other">Other</option>
                                                                    </select>
                                                                    <label>Gender<span class="required">*</span></label>
                                                                </div>
                                                            </div>

                                                            <div class="col-md-6">
                                                                <div class="form-group form-md-line-input form-md-floating-label edited">
                                                                    <select class="form-control edited" name="country" id="dd-country" onchange="CommonFunctions.LoadStates(this.value);">
                                                                        <?php echo isset($country_options) ? $country_options : ""; ?>
                                                                    </select>
                                                                    <label>Country<span class="required">*</span></label>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <div class="form-group form-md-line-input form-md-floating-label edited">
                                                                    <select class="form-control edited" id="dd-state" onchange="CommonFunctions.LoadCities(this.value);" name="state">
                                                                        <option value="">Select State</option>
                                                                    </select>
                                                                    <label>State<span class="required">*</span></label>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <div class="form-group form-md-line-input form-md-floating-label edited">
                                                                    <select class="form-control edited" id="dd-city" name="city">
                                                                        <option value="">Select City</option>
                                                                    </select>
                                                                    <label>City<span class="required">*</span></label>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <div class="form-group form-md-line-input form-md-floating-label">
                                                                    <input type="text" class="form-control"  placeholder="" name="address">
                                                                    <label>Address<span class="required">*</span></label>
                                                                    <!--<span class="help-block">Some help goes here...</span>-->
                                                                </div>
                                                            </div>


                                                            <div class="col-md-6">
                                                                <div class="form-group form-md-line-input form-md-floating-label">
                                                                    <input type="text" class="form-control"  placeholder="" name="about_me">
                                                                    <label>About me</label>
                                                                    <!--<span class="help-block">Some help goes here...</span>-->
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <div class="form-group form-md-line-input form-md-floating-label">
                                                                    <input type="text" class="form-control"  placeholder="" name="other_interest">
                                                                    <label>Other interest</label>
                                                                    <!--<span class="help-block">Some help goes here...</span>-->
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <!--<hr>-->
                                                        <!--<br>-->
                                                        <div class="md-checkbox-inline">
                                                            <div class="md-checkbox">
                                                                <input type="checkbox" id="checkbox33" name="terms" value="1" class="md-check">
                                                                <label for="checkbox33">
                                                                    <span></span>
                                                                    <span class="check"></span>
                                                                    <span class="box"></span> I agreee with the <a href="#">terms and conditions</a> for Registration</label>
                                                            </div>
                                                        </div>
                                                        <br>
                                                        <a href="<?php echo base_url('admin/guests'); ?>" class="btn default">Cancel</a>
                                                        <button type="submit" class="btn green">Register</button>
                                                    </div>
                                                </form>
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
        </div>
    </div>
</section>
<script>
    $(document).ready(function () {
        GuestMembers.initAddUpdateGuestValidation("add_guest_member");
    });
</script>
<script src="<?php echo base_url(); ?>assets/custom_scripts/frontend/guest_members.js" type="text/javascript"></script>

