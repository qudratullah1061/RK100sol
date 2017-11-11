<!-- BEGIN PAGE LEVEL STYLES -->
<link href="<?php echo base_url(); ?>assets/pages/css/profile.css" rel="stylesheet" type="text/css" />
<!-- END PAGE LEVEL STYLES -->
<!-- BEGIN PAGE LEVEL PLUGINS -->
<link href="<?php echo base_url(); ?>assets/global/plugins/bootstrap-fileinput/bootstrap-fileinput.css" rel="stylesheet" type="text/css" />
<!-- END PAGE LEVEL PLUGINS -->
<!-- BEGIN PAGE HEADER-->
<!-- BEGIN PAGE BAR -->
<div class="page-bar">
    <ul class="page-breadcrumb">
        <li>
            <a href="<?php echo base_url('admin/dashboard'); ?>">Home</a>
            <i class="fa fa-circle"></i>
        </li>
        <li>
            <span><?php echo $admin_info['username']; ?> Profile</span>
        </li>
    </ul>
</div>
<!-- END PAGE BAR -->
<h1 class="page-title"> Admin Profile | Account
    <small>user account page</small>
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
                    <img src="<?php echo base_url(); ?>assets/pages/media/profile/profile_user.jpg" class="img-responsive" alt=""> 
                </div>
                <!-- END SIDEBAR USERPIC -->
                <!-- SIDEBAR USER TITLE -->
                <div class="profile-usertitle">
                    <div class="profile-usertitle-name"><?php echo $admin_info['first_name']; ?> <?php echo $admin_info['last_name']; ?> </div>
                    <!--<div class="profile-usertitle-job"> Developer </div>-->
                </div>
                <!-- END SIDEBAR USER TITLE -->
                <!-- SIDEBAR BUTTONS -->
                <div class="profile-userbuttons">
                    <!--<button type="button" class="btn btn-circle green btn-sm">Follow</button>-->
                    <!--<button type="button" class="btn btn-circle red btn-sm">Message</button>-->
                </div>
                <!-- END SIDEBAR BUTTONS -->
                <!-- SIDEBAR MENU -->
                <div class="profile-usermenu">
                    <!--                    <ul class="nav">
                                            <li class="active">
                                                <a href="page_user_profile_1_account.html">
                                                    <i class="icon-settings"></i> Account Settings </a>
                                            </li>
                                        </ul>-->
                </div>
                <!-- END MENU -->
            </div>
            <!-- END PORTLET MAIN -->
            <!-- PORTLET MAIN -->
            <div class="portlet light ">
                <!-- STAT -->
                <div class="row list-separated profile-stat">
                    <div class="col-md-4 col-sm-4 col-xs-6">
                        <div class="uppercase profile-stat-title"> 37 </div>
                        <div class="uppercase profile-stat-text"> Projects </div>
                    </div>
                    <div class="col-md-4 col-sm-4 col-xs-6">
                        <div class="uppercase profile-stat-title"> 51 </div>
                        <div class="uppercase profile-stat-text"> Tasks </div>
                    </div>
                    <div class="col-md-4 col-sm-4 col-xs-6">
                        <div class="uppercase profile-stat-title"> 61 </div>
                        <div class="uppercase profile-stat-text"> Uploads </div>
                    </div>
                </div>
                <!-- END STAT -->
                <div>
                    <h4 class="profile-desc-title">About <?php echo ucfirst($admin_info['username']); ?></h4>
                    <span class="profile-desc-text"> <?php echo $admin_info['about_me']; ?> </span>
                    <div class="margin-top-20 profile-desc-link">
                        <i class="fa fa-facebook"></i>
                        <a href="<?php echo $admin_info['facebook_link']; ?>">www.facebook.com</a>
                    </div>
                    <div class="margin-top-20 profile-desc-link">
                        <i class="fa fa-twitter"></i>
                        <a href="<?php echo $admin_info['twitter_link']; ?>">www.twitter.com</a>
                    </div>
                    <div class="margin-top-20 profile-desc-link">
                        <i class="fa fa-linkedin"></i>
                        <a href="<?php echo $admin_info['linkedin_link']; ?>">www.linkedin.com</a>
                    </div>
                    <div class="margin-top-20 profile-desc-link">
                        <i class="fa fa-instagram"></i>
                        <a href="<?php echo $admin_info['instagram_link']; ?>">www.instagram.com</a>
                    </div>
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
                                <li>
                                    <a href="#tab_1_2" data-toggle="tab">Change Avatar</a>
                                </li>
                                <li>
                                    <a href="#tab_1_3" data-toggle="tab">Change Password</a>
                                </li>
                                <li>
                                    <a href="#tab_1_4" data-toggle="tab">Privacy Settings</a>
                                </li>
                            </ul>
                        </div>
                        <div class="portlet-body">
                            <div class="tab-content">
                                <!-- PERSONAL INFO TAB -->
                                <div class="tab-pane active" id="tab_1_1">
                                    <form role="form" action="#">

                                        <div class="form-group">
                                            <label class="control-label">Username</label>
                                            <input type="text" placeholder="Username" value="<?php echo $this->admin_info['username']; ?>" readonly="readonly" disabled="disabled" class="form-control" /> 
                                        </div>

                                        <div class="form-group">
                                            <label class="control-label">First Name</label>
                                            <input type="text" placeholder="First Name" value="<?php echo $admin_info['first_name']; ?>" class="form-control" /> 
                                        </div>

                                        <div class="form-group">
                                            <label class="control-label">Last Name</label>
                                            <input type="text" placeholder="Last Name" value="<?php echo $admin_info['last_name']; ?>" class="form-control" /> 
                                        </div>

                                        <div class="form-group">
                                            <label class="control-label">Email</label>
                                            <input type="text" placeholder="Email" value="<?php echo $admin_info['email']; ?>" class="form-control" /> 
                                        </div>

                                        <div class="form-group">
                                            <label class="control-label">Facebook</label>
                                            <input type="text" placeholder="https://www.facebook.com" value="<?php echo $admin_info['facebook_link']; ?>" class="form-control"> 
                                        </div>

                                        <div class="form-group">
                                            <label class="control-label">Twitter</label>
                                            <input type="text" placeholder="https://www.twitter.com" value="<?php echo $admin_info['twitter_link']; ?>" class="form-control"> 
                                        </div>

                                        <div class="form-group">
                                            <label class="control-label">Linkedin</label>
                                            <input type="text" placeholder="https://www.linkedin.com" value="<?php echo $admin_info['linkedin_link']; ?>" class="form-control"> 
                                        </div>

                                        <div class="form-group">
                                            <label class="control-label">Instagram</label>
                                            <input type="text" placeholder="https://www.instagram.com" value="<?php echo $admin_info['instagram_link']; ?>" class="form-control"> 
                                        </div>

                                        <div class="form-group">
                                            <label class="control-label">About</label>
                                            <textarea class="form-control" rows="3" placeholder="About Me"><?php echo $admin_info['about_me']; ?></textarea>
                                        </div>
                                        <div class="margiv-top-10">
                                            <a href="javascript:;" class="btn green"> Save Changes </a>
                                            <a href="javascript:;" class="btn default"> Cancel </a>
                                        </div>
                                    </form>
                                </div>
                                <!-- END PERSONAL INFO TAB -->
                                <!-- CHANGE AVATAR TAB -->
                                <div class="tab-pane" id="tab_1_2">
                                    <p> Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum
                                        eiusmod. </p>
                                    <form action="#" role="form">
                                        <div class="form-group">
                                            <div class="fileinput fileinput-new" data-provides="fileinput">
                                                <div class="fileinput-new thumbnail" style="width: 200px; height: 150px;">
                                                    <img src="http://www.placehold.it/200x150/EFEFEF/AAAAAA&amp;text=no+image" alt="" /> </div>
                                                <div class="fileinput-preview fileinput-exists thumbnail" style="max-width: 200px; max-height: 150px;"> </div>
                                                <div>
                                                    <span class="btn default btn-file">
                                                        <span class="fileinput-new"> Select image </span>
                                                        <span class="fileinput-exists"> Change </span>
                                                        <input type="file" name="..."> </span>
                                                    <a href="javascript:;" class="btn default fileinput-exists" data-dismiss="fileinput"> Remove </a>
                                                </div>
                                            </div>
                                            <div class="clearfix margin-top-10">
                                                <span class="label label-danger">NOTE! </span>
                                                <span>Attached image thumbnail is supported in Latest Firefox, Chrome, Opera, Safari and Internet Explorer 10 only </span>
                                            </div>
                                        </div>
                                        <div class="margin-top-10">
                                            <a href="javascript:;" class="btn green"> Submit </a>
                                            <a href="javascript:;" class="btn default"> Cancel </a>
                                        </div>
                                    </form>
                                </div>
                                <!-- END CHANGE AVATAR TAB -->
                                <!-- CHANGE PASSWORD TAB -->
                                <div class="tab-pane" id="tab_1_3">
                                    <form action="#">
                                        <div class="form-group">
                                            <label class="control-label">Current Password</label>
                                            <input type="password" class="form-control" /> </div>
                                        <div class="form-group">
                                            <label class="control-label">New Password</label>
                                            <input type="password" class="form-control" /> </div>
                                        <div class="form-group">
                                            <label class="control-label">Re-type New Password</label>
                                            <input type="password" class="form-control" /> </div>
                                        <div class="margin-top-10">
                                            <a href="javascript:;" class="btn green"> Change Password </a>
                                            <a href="javascript:;" class="btn default"> Cancel </a>
                                        </div>
                                    </form>
                                </div>
                                <!-- END CHANGE PASSWORD TAB -->
                                <!-- PRIVACY SETTINGS TAB -->
                                <div class="tab-pane" id="tab_1_4">
                                    <form action="#">
                                        <table class="table table-light table-hover">
                                            <tr>
                                                <td> Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus.. </td>
                                                <td>
                                                    <div class="mt-radio-inline">
                                                        <label class="mt-radio">
                                                            <input type="radio" name="optionsRadios1" value="option1" /> Yes
                                                            <span></span>
                                                        </label>
                                                        <label class="mt-radio">
                                                            <input type="radio" name="optionsRadios1" value="option2" checked/> No
                                                            <span></span>
                                                        </label>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td> Enim eiusmod high life accusamus terry richardson ad squid wolf moon </td>
                                                <td>
                                                    <div class="mt-radio-inline">
                                                        <label class="mt-radio">
                                                            <input type="radio" name="optionsRadios11" value="option1" /> Yes
                                                            <span></span>
                                                        </label>
                                                        <label class="mt-radio">
                                                            <input type="radio" name="optionsRadios11" value="option2" checked/> No
                                                            <span></span>
                                                        </label>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td> Enim eiusmod high life accusamus terry richardson ad squid wolf moon </td>
                                                <td>
                                                    <div class="mt-radio-inline">
                                                        <label class="mt-radio">
                                                            <input type="radio" name="optionsRadios21" value="option1" /> Yes
                                                            <span></span>
                                                        </label>
                                                        <label class="mt-radio">
                                                            <input type="radio" name="optionsRadios21" value="option2" checked/> No
                                                            <span></span>
                                                        </label>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td> Enim eiusmod high life accusamus terry richardson ad squid wolf moon </td>
                                                <td>
                                                    <div class="mt-radio-inline">
                                                        <label class="mt-radio">
                                                            <input type="radio" name="optionsRadios31" value="option1" /> Yes
                                                            <span></span>
                                                        </label>
                                                        <label class="mt-radio">
                                                            <input type="radio" name="optionsRadios31" value="option2" checked/> No
                                                            <span></span>
                                                        </label>
                                                    </div>
                                                </td>
                                            </tr>
                                        </table>
                                        <!--end profile-settings-->
                                        <div class="margin-top-10">
                                            <a href="javascript:;" class="btn red"> Save Changes </a>
                                            <a href="javascript:;" class="btn default"> Cancel </a>
                                        </div>
                                    </form>
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
<!-- BEGIN PAGE LEVEL PLUGINS -->
<script src="<?php echo base_url(); ?>assets/global/plugins/bootstrap-fileinput/bootstrap-fileinput.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>assets/global/plugins/jquery.sparkline.min.js" type="text/javascript"></script>
<!-- END PAGE LEVEL PLUGINS -->
<!-- BEGIN PAGE LEVEL SCRIPTS -->
<script src="<?php echo base_url(); ?>assets/pages/scripts/profile.min.js" type="text/javascript"></script>
<!-- END PAGE LEVEL SCRIPTS -->
<div id="static-modal-popup" class="modal fade" data-width="68%" tabindex="-1" data-backdrop="static" data-keyboard="false">
    <form id="form-create-budget" class="form-create-budget" method="post">
        <div class="form-body">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                <h4 class="modal-title">Create Budget</h4>
            </div>
            <div class="modal-body">
                <div class="note note-danger">
                    <p><i class="icon-info"></i>&nbsp;&nbsp;Please enter applicable data to create budget. </p>
                </div>
                <div class="row">
                    <div class="col-md-6 col-sm-12 col-xs-12">
                        <div class="form-group">
                            <label>Company</label>
                            <div class="input-icon right">
                                <i class="fa"></i>
                                <input type="text" maxlength="100" class="form-control" name="Company" value="National Cooperative Business Association" required />
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Budget Name</label>
                            <div class="input-icon right">
                                <i class="fa"></i>
                                <input type="text" maxlength="100" id="BudgetName" class="form-control" value="Annual Budget" name="Title" required />
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-6">
                                <label>Budget Start Date</label>
                                <div class="input-group date date-picker-budget-start" data-date-format="yyyy-mm-dd" data-date-viewmode="years">
                                    <input type="text" class="form-control" name="StartDate" value="@startDate" required>
                                    <span class="input-group-btn">
                                        <button class="btn default" type="button">
                                            <i class="fa fa-calendar"></i>
                                        </button>
                                    </span>
                                </div>
                            </div>
                            <div class="form-group col-md-6">
                                <label>Budget End Date</label>
                                <div class="input-group date date-picker-budget-end" data-date-format="yyyy-mm-dd" data-date-viewmode="years">
                                    <input type="text" class="form-control" readonly="readonly" name="EndDate" value="@endDate" required>
                                    <span class="input-group-btn">
                                        <button class="btn default" type="button">
                                            <i class="fa fa-calendar"></i>
                                        </button>
                                    </span>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-12">
                                <label class="control-label">Select Template</label>
                                <div class="input-icon right">
                                    <select class="form-control" id="TemplateId" required name="TemplateId">
                                        <option value="">Select Template</option>
                                        <option value="">@item.Title</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="form-group col-md-4">
                                <label>CLINs</label>
                                <div class="input-icon right">
                                    <select name="CLINCount" required class="form-control">
                                        <option value=""></option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group col-md-4">
                                <label># of Consultants</label>
                                <div class="input-icon right">
                                    <i class="fa"></i>
                                    <input type="text" max="100" min="0" value="0" placeholder="0 to 100" class="form-control" name="ConsultantsCount" required />
                                </div>
                            </div>
                            <div class="form-group col-md-4">
                                <label>Personnel</label>
                                <div class="input-icon right">
                                    <i class="fa"></i>
                                    <input type="text" max="100" min="1" class="form-control" placeholder="1 to 100" name="PersonnelsCount" required />
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6 col-sm-12 col-xs-12">

                        <div class="row">
                            <div class="form-group col-md-6">
                                <label>Budget Type</label>
                                <div class="input-icon right">
                                    <select name="BudgetType" class="form-control" id="BudgetType" required readonly="readonly">
                                        <option value="B">Annual Budget</option>
                                        <option value="E">Obligated Budget</option>
                                        <option value="C">Committment Budget</option>*@
                                    </select>
                                </div>
                            </div>
                            <div class="form-group col-md-6">
                                <label class="control-label">Select Country</label>
                                <div class="input-icon right">
                                    <select class="form-control" id="CountryId" required name="CountryId">
                                        <option value="">Select Country</option>
                                        <option value="@item.CountryId"></option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="form-group col-md-8">
                                <label>Department/Project</label>
                                <div class="input-icon right">
                                    <select class="form-control select2" name="DeptCode" required>
                                        <option value="@department.DeptCode">Some value</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <a href="javascript:DepartmentProject.init('.form-create-budget');" class="btn btn-xs blue btn-add-dept">
                                        <i class="fa fa-plus"></i>
                                        New Dept/Proj
                                    </a>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="form-group col-md-5">
                                <label>FY Start Month</label>
                                <div class="input-icon right">
                                    <select class="form-control" name="FYStartMonth" required>                                       
                                        <option value="@month.Key">Some value</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" data-dismiss="modal" class="btn btn-outline dark">Cancel</button>
                <button type="submit" class="btn blue">Create</button>
            </div>
        </div>
    </form>
</div>