<!-- BEGIN PAGE HEADER-->
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
<h1 class="page-title"> Member Registration
    <!--<small>material design bootstrap inputs, input groups, custom checkboxes and radio controls and more</small>-->
</h1>
<!-- END PAGE TITLE-->
<!-- END PAGE HEADER-->
<div class="row add-guest">
    <div class="col-md-12">
        <!-- BEGIN PROFILE SIDEBAR -->
        <div class="profile-sidebar">
            <!-- PORTLET MAIN -->
            <div class="portlet light profile-sidebar-portlet ">
                <!-- SIDEBAR USERPIC -->
                <div class="">
                    <!--<div class="row">-->
                    <div class="col-md-12">
                        <form action="../assets/global/plugins/dropzone/upload.php" class="dropzone dropzone-file-area" id="my-dropzone" >
                            <!--<label>Upload Image</label>-->
                            <h3 class="sbold">Click to upload</h3>
                            <p> Lorem ipsum doller sit amet </p>
                        </form>
                    </div>
                    <div class="clearfix"></div>
                    <!--</div>-->

                </div>
                <!-- END SIDEBAR USERPIC -->
                <!-- SIDEBAR USER TITLE -->

                <!-- END SIDEBAR USER TITLE -->
                <!-- SIDEBAR BUTTONS -->

                <!-- END SIDEBAR BUTTONS -->
                <!-- SIDEBAR MENU -->

                <!-- END MENU -->
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
                                <form role="form">
                                    <div class="form-body">
                                        <h3 class="block ">Guest Details</h3>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group form-md-line-input form-md-floating-label">
                                                    <input type="text" class="form-control"  placeholder="" name="first_name">
                                                    <label for="form_control_1">First Name <span class="required">*</span></label>
                                                    <!--<span class="help-block">Some help goes here...</span>-->
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group form-md-line-input form-md-floating-label">
                                                    <input type="text" class="form-control"  placeholder="" name="last_name">
                                                    <label for="form_control_1">Last Name<span class="required">*</span></label>
                                                    <!--<span class="help-block">Some help goes here...</span>-->
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group form-md-line-input form-md-floating-label">
                                                    <input type="text" class="form-control"  placeholder="" name="username">
                                                    <label for="form_control_1">Username<span class="required">*</span></label>
                                                    <!--<span class="help-block">Some help goes here...</span>-->
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group form-md-line-input form-md-floating-label">
                                                    <input type="email" class="form-control"  placeholder="" name="email">
                                                    <label for="form_control_1">Email Address<span class="required">*</span></label>
                                                    <!--<span class="help-block">Some help goes here...</span>-->
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group form-md-line-input form-md-floating-label">
                                                    <input type="password" class="form-control"  placeholder="" name="password">
                                                    <label for="form_control_1">Password<span class="required">*</span></label>
                                                    <!--<span class="help-block">Some help goes here...</span>-->
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group form-md-line-input form-md-floating-label">
                                                    <input type="password" class="form-control"  placeholder="" name="confirm_password">
                                                    <label for="form_control_1">Confirm Password<span class="required">*</span></label>
                                                    <!--<span class="help-block">Some help goes here...</span>-->
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group form-md-line-input ">
                                                    <input type="file" class="form-control"  placeholder="" name="">
                                                    <label for="form_control_1">Id Proof<span class="required">*</span></label>
                                                    <!--<span class="help-block">Some help goes here...</span>-->
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group form-md-line-input form-md-floating-label">
                                                    <input type="text" class="form-control"  placeholder="" name="telephone">
                                                    <label for="form_control_1">Phone Number<span class="required">*</span></label>
                                                    <!--<span class="help-block">Some help goes here...</span>-->
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group form-md-line-input form-md-floating-label">
                                                    <select class="form-control" name="gender">
                                                        <option value=""></option>
                                                        <option value="">Male</option>
                                                        <option value="">Female</option>
                                                        <option value="">Other</option>
                                                    </select>
                                                    <label for="form_control_1">Gender<span class="required">*</span></label>
                                                    <div class="form_control_1"> </div>
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="form-group form-md-line-input form-md-floating-label">
                                                    <!--<label class="control-label col-md-3">Default Datepicker</label>-->

                                                    <input class="form-control date-picker" size="16" type="text" value="" name="date_of_birth" />
                                                    <label for="form_control_1">Date of birth<span class="required">*</span></label>
                                                    <!--<span class="help-block"> Select date </span>-->

                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="form-group form-md-line-input form-md-floating-label">
                                                    <select class="form-control" name="country">
                                                        <option value=""></option>
                                                        <option value="">USA</option>
                                                        <option value="">UAE</option>
                                                        <option value="">Other</option>
                                                    </select>
                                                    <label for="form_control_1">Country<span class="required">*</span></label>
                                                    <div class="form_control_1"> </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group form-md-line-input form-md-floating-label">
                                                    <input type="text" class="form-control"  placeholder="" name="state">
                                                    <label for="form_control_1">State<span class="required">*</span></label>
                                                    <!--<span class="help-block">Some help goes here...</span>-->
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group form-md-line-input form-md-floating-label">
                                                    <input type="text" class="form-control"  placeholder="" name="city">
                                                    <label for="form_control_1">City<span class="required">*</span></label>
                                                    <!--<span class="help-block">Some help goes here...</span>-->
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group form-md-line-input form-md-floating-label">
                                                    <input type="text" class="form-control"  placeholder="" name="address">
                                                    <label for="form_control_1">Address<span class="required">*</span></label>
                                                    <!--<span class="help-block">Some help goes here...</span>-->
                                                </div>
                                            </div>
                                            
                                            
                                            <div class="col-md-6">
                                                <div class="form-group form-md-line-input form-md-floating-label">
                                                    <input type="text" class="form-control"  placeholder="" name="about_me">
                                                    <label for="form_control_1">About me<span class="required">*</span></label>
                                                    <!--<span class="help-block">Some help goes here...</span>-->
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group form-md-line-input form-md-floating-label">
                                                    <input type="text" class="form-control"  placeholder="" name="other_interest">
                                                    <label for="form_control_1">Other interest<span class="required">*</span></label>
                                                    <!--<span class="help-block">Some help goes here...</span>-->
                                                </div>
                                            </div>
                                        </div>
                                        <!--                                        <hr>
                                                                                <br>-->
                                        <div class="md-checkbox-inline">
                                            <div class="md-checkbox">
                                                <input type="checkbox" id="checkbox33" class="md-check">
                                                <label for="checkbox33">
                                                    <span></span>
                                                    <span class="check"></span>
                                                    <span class="box"></span> I agreee with the <a href="#">terms and conditions</a> for Registration</label>
                                            </div>
                                        </div>
                                        <br>
                                        <button type="button" class="btn green">Register</button>

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
<script>
    $(document).ready(function ()
    {
       $(".date-picker").datepicker();
    });
</script>
