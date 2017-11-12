<!-- BEGIN PAGE HEADER-->
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
            <i class=" icon-layers font-red"></i>
            <span class="caption-subject font-red bold uppercase"> Form Wizard -
                <span class="step-title"> Step 1 of 4 </span>
            </span>
        </div>
        <div class="actions">
            <a class="btn btn-circle btn-icon-only btn-default" href="javascript:;">
                <i class="icon-cloud-upload"></i>
            </a>
            <a class="btn btn-circle btn-icon-only btn-default" href="javascript:;">
                <i class="icon-wrench"></i>
            </a>
            <a class="btn btn-circle btn-icon-only btn-default" href="javascript:;">
                <i class="icon-trash"></i>
            </a>
        </div>
    </div>
    <div class="portlet-body form">
        <form class="form-horizontal" action="#" id="submit_form" method="POST">
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
                            <button class="close" data-dismiss="alert"></button> You have some form errors. Please check below. </div>
                        <div class="alert alert-success display-none">
                            <button class="close" data-dismiss="alert"></button> Your form validation is successful! </div>
                        <div class="tab-pane active" id="tab1">
                            <h3 class="block text-center">Login Details</h3>
                            <div class="form-group form-md-line-input">
                                <label class="control-label col-md-3"> Username <span class="required"> * </span> </label>
                                <div class="col-md-6">
                                    <input type="text" class="form-control" id="form_control_1" placeholder="">
                                    <label for="form_control_1"></label>
                                    <!--<span class="help-block">Some help goes here...</span>-->
                                </div>
                            </div>
                            <div class="form-group form-md-line-input">
                                <label class="control-label col-md-3"> Email <span class="required"> * </span> </label>
                                <div class="col-md-6">
                                    <input type="email" class="form-control" id="form_control_1" placeholder="">
                                    <label for="form_control_1"></label>
                                </div>
                            </div>
                            <div class="form-group form-md-line-input">
                                <label class="control-label col-md-3">Confirm Email <span class="required"> * </span> </label>
                                <div class="col-md-6">
                                    <input type="email" class="form-control" id="form_control_1" placeholder="">
                                    <label for="form_control_1"></label>
                                </div>
                            </div>
                            <div class="form-group form-md-line-input">
                                <label class="control-label col-md-3">Password<span class="required"> * </span> </label>
                                <div class="col-md-6">
                                    <input type="email" class="form-control" id="form_control_1" placeholder="">
                                    <label for="form_control_1"></label>
                                </div>
                            </div>
                            <div class="form-group form-md-line-input">
                                <label class="control-label col-md-3">Confirm Password<span class="required"> * </span> </label>
                                <div class="col-md-6">
                                    <input type="email" class="form-control" id="form_control_1" placeholder="">
                                    <label for="form_control_1"></label>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane" id="tab2">
                            <h3 class="block text-center">Personal Details</h3>
                            <div class="form-group form-md-line-input">
                                <label class="control-label col-md-3"> First Name <span class="required"> * </span> </label>
                                <div class="col-md-6">
                                    <input type="text" class="form-control" id="form_control_1" placeholder="">
                                    <label for="form_control_1"></label>
                                </div>
                            </div>
                            <div class="form-group form-md-line-input">
                                <label class="control-label col-md-3"> Last Name <span class="required"> * </span> </label>
                                <div class="col-md-6">
                                    <input type="text" class="form-control" id="form_control_1" placeholder="">
                                    <label for="form_control_1"></label>
                                </div>
                            </div>
                            <div class="form-group form-md-line-input">
                                <label class="control-label col-md-3"> Nick Name <span class="required"> * </span> </label>
                                <div class="col-md-6">
                                    <input type="text" class="form-control" id="form_control_1" placeholder="">
                                    <label for="form_control_1"></label>
                                </div>
                            </div>
                            <div class="form-group form-md-line-input">
                                <label class="control-label col-md-3"> Telephone <span class="required"> * </span> </label>
                                <div class="col-md-6">
                                    <input type="text" class="form-control" id="form_control_1" placeholder="">
                                    <label for="form_control_1"></label>
                                </div>
                            </div>
                            <div class="form-group form-md-line-input">
                                <label class="control-label col-md-3"> Date of Birth <span class="required"> * </span> </label>
                                <div class="col-md-6">
                                    <input type="text" class="form-control" id="form_control_1" placeholder="">
                                    <label for="form_control_1"></label>
                                </div>
                            </div>
                            <div class="form-group form-md-line-input">
                                <label class="control-label col-md-3"> Gender <span class="required"> * </span> </label>
                                <div class="col-md-6">
                                    <select class="form-control" id="form_control_1">
                                        <option value=""></option>
                                        <option value="">Male</option>
                                        <option value="">Female</option>
                                        <option value="">Other</option>
                                    </select>
                                    <label for="form_control_1"></label>
                                </div>
                            </div>
                            <div class="form-group form-md-line-input">
                                <label class="control-label col-md-3"> Location <span class="required"> * </span> </label>
                                <div class="col-md-6">
                                    <input type="text" class="form-control" id="form_control_1" placeholder="">
                                    <label for="form_control_1"></label>
                                    <!--<span class="help-block">Some help goes here...</span>-->
                                </div>
                            </div>
                            <div class="form-group form-md-line-input">
                                <label class="control-label col-md-3"> Address <span class="required"> * </span> </label>
                                <div class="col-md-6">
                                    <input type="text" class="form-control" id="form_control_1" placeholder="">
                                    <label for="form_control_1"></label>
                                    <!--<span class="help-block">Some help goes here...</span>-->
                                </div>
                            </div>

                        </div>
                        <div class="tab-pane" id="tab3">
                            <h3 class="block text-center">Further Details</h3>
                            <div class="form-group form-md-line-input">
                                <label class="control-label col-md-3"> Upload image <span class="required"> * </span> </label>
                                <div class="col-md-6">
                                    <div  class="dropzone dropzone-file-area" id="my-dropzone" >
                                        <!--<label>*Upload Image</label>-->
                                        <h3 class="sbold">Click to upload</h3>
                                        <p> Lorem ipsum doller sit amet </p>
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
                                    <input type="text" class="form-control" id="form_control_1" placeholder="">
                                    <label for="form_control_1"></label>
                                    <!--<span class="help-block">Some help goes here...</span>-->
                                </div>
                            </div>
                            <div class="form-group form-md-line-input">
                                <label class="control-label col-md-3"> Describe yourself <span class="required"> * </span> </label>
                                <div class="col-md-6">
                                    <textarea  class="form-control" id="form_control_1" placeholder=""></textarea>
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
</div>
