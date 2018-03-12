<script src="//maps.googleapis.com/maps/api/js?key=AIzaSyDVw_YgvMUxH6KawXzlwM9meU3HAUnbsLQ&libraries=places&language=en"></script>
<script src="<?php echo base_url(); ?>assets/geocode/jquery.geocomplete.js" type="text/javascript"></script>
<link href="<?php echo base_url(); ?>assets/slim-image-cropper-test-master/slim/slim.min.css" rel="stylesheet">
<link href="<?php echo base_url(); ?>assets/slim-image-cropper-test-master/styles/styles.css" rel="stylesheet">
<!-- BEGIN PAGE HEADER-->
<!--profile page css-->
<link href="<?php echo base_url(); ?>assets/pages/css/profile.min.css" rel="stylesheet" type="text/css" />
<!-- BEGIN PAGE BAR -->
<div class="page-bar">
    <ul class="page-breadcrumb">
        <li>
            <a href="<?php echo base_url('admin/dashboard'); ?>">Home</a>
            <i class="fa fa-circle"></i>
        </li>
        <li>
            <span>Add Guest</span>
        </li>
    </ul>
</div>
<!-- END PAGE BAR -->
<!-- END PAGE HEADER -->
<h1 class="page-title"> Guest Member Registration
    <small>Add new guest member in system.</small>
</h1>
<!-- END PAGE TITLE-->
<div class="portlet box blue">
    <div class="portlet-title">
        <div class="caption">
            <i class="fa fa-user"></i>Registration </div>
        <div class="tools">
            <a href="javascript:;" class="collapse"> </a>
            <!--<a href="javascript:;" class="reload"> </a>-->
            <a href="" class="fullscreen"> </a>
        </div>
    </div>
    <div class="portlet-body">
        <div class="row add-guest">
            <div class="col-md-12">
                <!-- BEGIN PROFILE SIDEBAR -->
                <div class="profile-sidebar">
                    <!-- PORTLET MAIN -->
                    <div class="row portlet light profile-sidebar-portlet ">
                        <!-- SIDEBAR USERPIC -->
                        <div>
                            <div class="form-group form-md-line-input">
                                <label class="control-label col-md-12"> Profile Image <span class="required">*</span></label>
                                <div class="col-md-12">
                                    <div class="frame profile-image">
                                        <input type="file" id="profile_images" required="required" name="profile_images[]" multiple="multiple" />
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div >
                            <div class="form-group form-md-line-input">
                                <label class="control-label col-md-12" style="margin-top: 50px;"> ID Proof <span class="required">*</span></label>
                                <div class="col-md-12">
                                    <div class="frame id-proof">
                                        <input type="file" id="id_proofs" required="required" name="id_proofs[]" multiple="multiple">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- SIDEBAR USERPIC -->
                        <div class="clearfix"></div>
                    </div>
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
                                            <div class="form-body">
                                                <h3 class="block ">Guest Details</h3>
                                                <div class="row">

                                                    <div class="form-group form-md-line-input">
                                                        <div class="portlet mt-element-ribbon light portlet-fit bordered">
                                                            <div class="ribbon ribbon-right ribbon-clip ribbon-shadow ribbon-border-dash-hor ribbon-color-success uppercase">
                                                                <div class="ribbon-sub ribbon-clip ribbon-right"></div> Promo Code.
                                                            </div>
                                                            <div class="portlet-title">
                                                                <div class="caption">
                                                                    <i class="fa fa-tag font-green"></i>
                                                                    <span class="caption-subject font-green bold uppercase">Do you have promo code? Enter it here.</span>
                                                                </div>
                                                            </div>
                                                            <div class="portlet-body"> 
                                                                <input type="text" name="promo_code" class="form-control" placeholder="Promo Code"> 
                                                            </div>
                                                        </div>

                                                    </div>

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
                                                            <label>Gender</label>
                                                        </div>
                                                    </div>

                                                    <div class="col-md-6">
                                                        <div class="form-group form-md-line-input form-md-floating-label">
                                                            <input type="text" name="location" id="location" placeholder="" class="location form-control">
                                                            <label>Location <span class="required">*</span></label>
                                                        </div>
                                                    </div>

                                                    <div class="col-md-6">
                                                        <div class="form-group form-md-line-input form-md-floating-label">
                                                            <input type="text" class="form-control"  placeholder="" name="address">
                                                            <label>Address<span class="required">*</span></label>
                                                            <!--<span class="help-block">Some help goes here...</span>-->
                                                        </div>
                                                    </div>

                                                    <div class="col-md-3">
                                                        <div class="form-group form-md-line-input form-md-floating-label">
                                                            <select name="years" class="form-control">
                                                                <?php
                                                                $cutoff = 1910;
                                                                $now = date('Y');
                                                                for ($i = $now; $i >= $cutoff; $i--) {
                                                                    ?>
                                                                    <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
                                                                <?php } ?>
                                                            </select>
                                                            <label>DOB Year</label>
                                                        </div>
                                                    </div>

                                                    <div class="col-md-3">
                                                        <div class="form-group form-md-line-input form-md-floating-label">
                                                            <select name="months" class="form-control">
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
                                                            <label>DOB Month</label>
                                                        </div>
                                                    </div>

                                                    <div class="col-md-3">
                                                        <div class="form-group form-md-line-input form-md-floating-label">
                                                            <select name="days" class="form-control">
                                                                <?php for ($d = 1; $d <= 31; $d++) { ?>
                                                                    <option value="<?php echo $d; ?>"><?php echo $d; ?></option>
                                                                <?php } ?>
                                                            </select>
                                                            <label>DOB Day</label>
                                                        </div>
                                                    </div>

                                                    <div class="col-md-3">
                                                        <div class="form-group form-md-line-input form-md-floating-label">
                                                            <input type="text" name="zipcode" id="zipcode" placeholder="" class="form-control">
                                                            <label>Zip Code</label>
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
                                                <!--                                        <hr>
                                                                                        <br>-->
                                                <!--                                                <div class="md-checkbox-inline">
                                                                                                    <div class="md-checkbox">
                                                                                                        <input type="checkbox" id="checkbox33" class="md-check">
                                                                                                        <label for="checkbox33">
                                                                                                            <span></span>
                                                                                                            <span class="check"></span>
                                                                                                            <span class="box"></span> I agreee with the <a href="#">terms and conditions</a> for Registration</label>
                                                                                                    </div>
                                                                                                </div>-->
                                                <!--<br>-->
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
<script src="<?php echo base_url(); ?>assets/slim-image-cropper-test-master/slim/slim.kickstart.min.js"></script>
<script src="<?php echo base_url(); ?>assets/slim-image-cropper-test-master/scripts/scripts.js"></script>
<script>
    $(document).ready(function () {
        GuestMembers.initAddUpdateGuestValidation("add_guest_member");
        $("#location").geocomplete();
    });
</script>
<script src="<?php echo base_url(); ?>assets/custom_scripts/admin/guest_members.js" type="text/javascript"></script>
