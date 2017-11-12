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
                        <a style="float:right;" class="purple" onclick="AdminUsers.modal_add_admin()" data-title="Add Type" href="javascript:void(0)"><i class="fa fa-plus-circle"></i> 
                            Add New User
                        </a>
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
<script>
    $(document).ready(function () {
        DatatablesObj.InitAdminTable('datatable_adminusers');
    });
</script>
<script src="<?php echo base_url(); ?>assets/custom_scripts/admin/admin_users.js" type="text/javascript"></script>