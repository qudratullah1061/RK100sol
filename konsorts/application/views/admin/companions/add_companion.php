<!-- BEGIN PAGE BAR -->
<div class="page-bar">
    <ul class="page-breadcrumb">
        <li>
            <a href="<?php echo base_url('admin/dashboard'); ?>">Home</a>
            <i class="fa fa-circle"></i>
        </li>
        <li>
            <span>Add Companion</span>
        </li>
    </ul>
</div>
<!-- END PAGE BAR -->
<h1 class="page-title"> Companion Details
    <!--<small>material design bootstrap inputs, input groups, custom checkboxes and radio controls and more</small>-->
</h1>

<div class="portlet light bordered" id="form_wizard_1">
    <div class="portlet-title">
        <div class="caption">
            <i class=" icon-user purple"></i>
            <span class="caption-subject purple bold uppercase"> Create Companion -
                <span class="step-title"> Step 1 of 3 </span>
            </span>
        </div>
    </div>
    <div class="portlet-body form">
        <form class="form-horizontal" action="#" id="form-add-companion" method="POST">
            <div class="form-wizard">
                <div class="form-body">
                    <ul class="nav nav-pills nav-justified steps">
                        <li>
                            <a href="#tab1" data-toggle="tab" class="step active">
                                <span class="number"> 1 </span>
                                <span class="desc">
                                    <i class="fa fa-check"></i> Login Details </span>
                            </a>
                        </li>
                        <li>
                            <a href="#tab2" data-toggle="tab" class="step">
                                <span class="number"> 2 </span>
                                <span class="desc">
                                    <i class="fa fa-check"></i> Personal Details </span>
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
                                <label class="control-label col-md-3"> Nick Name <span class="required"> * </span> </label>
                                <div class="col-md-6">
                                    <input type="text" class="form-control"  name="nick_name">
                                    <label></label>
                                </div>
                            </div>
                            <div class="form-group form-md-line-input">
                                <label class="control-label col-md-3"> Telephone <span class="required"> * </span> </label>
                                <div class="col-md-6">
                                    <input type="text" class="form-control" name="telephone">
                                    <label></label>
                                </div>
                            </div>
                            <div class="form-group form-md-line-input">
                                <label class="control-label col-md-3"> Date of Birth <span class="required"> * </span> </label>
                                <div class="col-md-6">
                                    <input type="text" class="form-control" data-date-format="yyyy-mm-dd" name="date_of_birth">
                                    <label></label>
                                </div>
                            </div>
                            <div class="form-group form-md-line-input">
                                <label class="control-label col-md-3"> Gender <span class="required"> * </span> </label>
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

                            <div class="form-group form-md-line-input form-md-floating-label">
                                <label class="control-label col-md-3">Country<span class="required">*</span></label>
                                <div class="col-md-6">
                                    <select class="form-control" name="country" id="dd-country" onchange="CommonFunctions.LoadStates(this.value);">
                                        <?php echo isset($country_options) ? $country_options : ""; ?>
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
                            </div>
                            <div class="form-group form-md-line-input">
                                <label class="control-label col-md-3"> Address <span class="required"> * </span> </label>
                                <div class="col-md-6">
                                    <input type="text" class="form-control"  placeholder="">
                                    <label></label>
                                </div>
                            </div>

                        </div>
                        <div class="tab-pane" id="tab3">
                            <h3 class="block text-center">Further Details</h3>
                            <div class="form-group form-md-line-input">
                                <label class="control-label col-md-3"> Upload image <span class="required"> * </span> </label>
                                <div class="col-md-6">
                                    <div  class="dropzone dropzone-file-area" id="my-dropzone" >
                                        <label>*Upload Image</label>
                                        <h3 class="sbold">Click to upload</h3>
                                        <p> Profile Images </p>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group form-md-line-input">
                                <label class="control-label col-md-3"> Available for <span class="required"> * </span> </label>
                                <div class="col-md-6">
                                    <div class="md-checkbox-inline row">
                                        <div class="col-md-4">
                                            <div class="md-checkbox">
                                                <input type="checkbox" id="checkbox01" class="md-check">
                                                <label for="checkbox33">
                                                    <span></span>
                                                    <span class="check"></span>
                                                    <span class="box"></span> Loren</label>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="md-checkbox">
                                                <input type="checkbox" id="checkbox02" class="md-check">
                                                <label for="checkbox33">
                                                    <span></span>
                                                    <span class="check"></span>
                                                    <span class="box"></span> Ipsum</label>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="md-checkbox">
                                                <input type="checkbox" id="checkbox03" class="md-check">
                                                <label for="checkbox33">
                                                    <span></span>
                                                    <span class="check"></span>
                                                    <span class="box"></span> Doller</label>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="md-checkbox">
                                                <input type="checkbox" id="checkbox05" class="md-check">
                                                <label for="checkbox33">
                                                    <span></span>
                                                    <span class="check"></span>
                                                    <span class="box"></span> Lorem ipsum doller</label>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="md-checkbox">
                                                <input type="checkbox" id="checkbox04" class="md-check">
                                                <label for="checkbox33">
                                                    <span></span>
                                                    <span class="check"></span>
                                                    <span class="box"></span> Sit</label>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="md-checkbox">
                                                <input type="checkbox" id="checkbox04" class="md-check">
                                                <label for="checkbox33">
                                                    <span></span>
                                                    <span class="check"></span>
                                                    <span class="box"></span> Cricket</label>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="md-checkbox">
                                                <input type="checkbox" id="checkbox04" class="md-check">
                                                <label for="checkbox33">
                                                    <span></span>
                                                    <span class="check"></span>
                                                    <span class="box"></span> Hocky</label>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="md-checkbox">
                                                <input type="checkbox" id="checkbox05" class="md-check">
                                                <label for="checkbox33">
                                                    <span></span>
                                                    <span class="check"></span>
                                                    <span class="box"></span> Amet</label>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>
                            <div class="form-group form-md-line-input">
                                <label class="control-label col-md-3"> Other Specific Interest  </label>
                                <div class="col-md-6">
                                    <input type="text" class="form-control"  placeholder="">
                                    <label for="form_control_1"></label>
                                    <!--<span class="help-block">Some help goes here...</span>-->
                                </div>
                            </div>
                            <div class="form-group form-md-line-input">
                                <label class="control-label col-md-3"> Describe yourself <span class="required"> * </span> </label>
                                <div class="col-md-6">
                                    <textarea  class="form-control"  placeholder=""></textarea>
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
<script src="<?php echo base_url(); ?>assets/global/plugins/bootstrap-wizard/jquery.bootstrap.wizard.min.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>assets/custom_scripts/admin/companion-form-wizard.js" type="text/javascript"></script>