<!-- BEGIN PAGE BAR -->
<div class="page-bar">
    <ul class="page-breadcrumb">
        <li>
            <a href="<?php echo base_url('admin/admin_dashboard'); ?>">Home</a>
            <i class="fa fa-circle"></i>
        </li>
        <li>
            <span>Admin Users</span>
        </li>
    </ul>
</div>
<!-- END PAGE BAR -->
<!-- BEGIN PAGE TITLE-->
<h3 class="page-title"> Admin Users </h3>
<!-- END PAGE TITLE-->
<!-- BEGIN Datatable-->
<div class="row">
    <div class="col-md-12">
        <!-- Begin: life time stats -->
        <div class="portlet light portlet-fit portlet-datatable bordered">
            <div class="portlet-body">
                <div class="table-container">
                    <div class="table-actions-wrapper">
                        <span> </span>
                        <a style="float:right;" class="addUser" onclick="show_add();" data-title="Add Type" href="javascript:void(0)"><i class="fa fa-plus-circle"></i> Add New User</a>
                    </div>
                    <table class="table table-striped table-bordered table-hover table-checkable text-center" id="datatable_adminusers">
                        <thead>
                            <tr role="row" class="heading">
                                <th width="15%"> Image </th>
                                <th width="10%"> Username </th>
                                <th width="10%"> First Name </th>
                                <th width="10%"> Last Name </th>
                                <th width="20%"> Email </th>
                                <th width="15%"> Updated On </th>
                                <th width="20%"> Actions </th>
                            </tr>
                            <tr role="row" class="filter">
                                <td></td>
                                <td>
                                    <input type="text" class="form-control form-filter input-sm" placeholder="Username" name="username"> 
                                </td>
                                <td>
                                    <input type="text" class="form-control form-filter input-sm" placeholder="First Name" name="first_name"> 
                                </td>
                                <td>
                                    <input type="text" class="form-control form-filter input-sm" placeholder="Last Name" name="last_name"> 
                                </td>
                                <td>
                                    <input type="text" class="form-control form-filter input-sm" placeholder="Email" name="email"> 
                                </td>
                                <td>
                                    <div class="input-group date date-picker margin-bottom-5" data-date-format="yyyy-mm-dd">
                                        <input type="text" class="form-control form-filter input-sm" readonly name="updated_on" placeholder="Updated On">
                                        <span class="input-group-btn">
                                            <button class="btn btn-sm default" type="button">
                                                <i class="fa fa-calendar"></i>
                                            </button>
                                        </span>
                                    </div>
                                </td>
                                <td>
                                    <div class="margin-bottom-5" style="float: left">
                                        <button class="btn btn-sm green btn-outline filter-submit margin-bottom">
                                            <i class="fa fa-search"></i> Search
                                        </button>
                                    </div>
                                    <button class="btn btn-sm red btn-outline filter-cancel">
                                        <i class="fa fa-times"></i> Reset
                                    </button>
                                </td>
                            </tr>
                        </thead>
                        <tbody> </tbody>
                    </table>
                </div>
            </div>
        </div>
        <!-- End: life time stats -->
    </div>
</div>
<!-- End datatable-->
<!--add new user modal-->
<div class="modal fade bs-modal-lg" id="addUser-" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                <h4 class="modal-title">Modal Title</h4>
            </div>
            <div class="modal-body"> Modal body goes here </div>
            <div class="modal-footer">
                <button type="button" class="btn dark btn-outline" data-dismiss="modal">Close</button>
                <button type="button" class="btn green">Save changes</button>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<div id="addUser" class="modal fade modal-lg rk-modal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                <h4 class="modal-title">Add New User</h4>
            </div>
            <div class="modal-body">
                <div class="portlet-body form">
                    <form role="form">
                        <div class="form-body">


                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group form-md-line-input">
                                        <input type="text" class="form-control" id="form_control_1" placeholder="First Name">
                                        <label for="form_control_1"></label>
                                        <!--<span class="help-block">Some help goes here...</span>-->
                                    </div>
                                    <div class="form-group form-md-line-input">
                                        <input type="text" class="form-control" id="form_control_1" placeholder="Last Name">
                                        <label for="form_control_1"></label>
                                        <!--<span class="help-block">Some help goes here...</span>-->
                                    </div>
                                    <div class="form-group form-md-line-input">
                                        <input type="text" class="form-control" id="form_control_1" placeholder="Username">
                                        <label for="form_control_1"></label>
                                        <!--<span class="help-block">Some help goes here...</span>-->
                                    </div>
                                    <div class="form-group form-md-line-input">
                                        <input type="email" class="form-control" id="form_control_1" placeholder="Email">
                                        <label for="form_control_1"></label>
                                        <!--<span class="help-block">Some help goes here...</span>-->
                                    </div>
                                    <div class="form-group form-md-line-input">
                                        <input type="email" class="form-control" id="form_control_1" placeholder="Password">
                                        <label for="form_control_1"></label>
                                        <!--<span class="help-block">Some help goes here...</span>-->
                                    </div>

                                </div>
                                <div class="col-md-6">
                                    <div class="form-group form-md-line-input">
                                        <input type="text" class="form-control" id="form_control_1" placeholder="Facebook Link">
                                        <label for="form_control_1"></label>
                                        <!--<span class="help-block">Some help goes here...</span>-->
                                    </div>
                                    <div class="form-group form-md-line-input">
                                        <input type="text" class="form-control" id="form_control_1" placeholder="Twitter Link">
                                        <label for="form_control_1"></label>
                                        <!--<span class="help-block">Some help goes here...</span>-->
                                    </div>
                                    <div class="form-group form-md-line-input">
                                        <input type="text" class="form-control" id="form_control_1" placeholder="Linkedin Link">
                                        <label for="form_control_1"></label>
                                        <!--<span class="help-block">Some help goes here...</span>-->
                                    </div>
                                    <div class="form-group form-md-line-input">
                                        <input type="text" class="form-control" id="form_control_1" placeholder="Instagram link">
                                        <label for="form_control_1"></label>
                                        <!--<span class="help-block">Some help goes here...</span>-->
                                    </div>
                                    <div class="form-group form-md-line-input">
                                        <input type="file" class="form-control" id="form_control_1" placeholder="Image">
                                        <label for="form_control_1"></label>
                                        <!--<span class="help-block">Some help goes here...</span>-->
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group form-md-line-input">
                                        <textarea class="form-control" placeholder="About Me"></textarea>
                                        <label for="form_control_1"></label>
                                        <!--<span class="help-block">Some help goes here...</span>-->
                                    </div>
                                </div>
                            </div>


                        </div>
                    </form>
                </div>

            </div>
            <div class="modal-footer">
                <button type="button" data-dismiss="modal" class="btn dark btn-outline">Close</button>
                <button type="button" class="btn green">Save changes</button>
            </div>
        </div>
    </div>
</div>
<script>
    $(document).ready(function () {
        DatatablesObj.InitAdminTable('datatable_adminusers');
        $(document).on('click', '.addUser', function () {
            $('#addUser').modal('show');
        });
//        function openModal() {
//            $('#addUser').modal('show');
//        }
    });
</script>