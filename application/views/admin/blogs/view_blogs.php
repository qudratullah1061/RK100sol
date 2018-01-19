<!-- BEGIN PAGE BAR -->
<div class="page-bar">
    <ul class="page-breadcrumb">
        <li>
            <a href="<?php echo base_url('admin/admin_dashboard'); ?>">Home</a>
            <i class="fa fa-circle"></i>
        </li>
        <li>
            <span>Blogs</span>
        </li>
    </ul>
</div>
<!-- END PAGE BAR -->
<!-- BEGIN PAGE TITLE-->
<h3 class="page-title">Blogs Listing</h3>
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
                        <a class="purple text-right" data-title="Add Tag" href="<?php echo base_url('admin/blogs/add_blog'); ?>"><i class="fa fa-plus-circle"></i> Add new Blog</a>
                    </div>
                    <table class="table table-striped table-bordered table-hover text-center" id="datatable_blogs">
                        <thead>
                            <tr role="row" class="heading">
                                <th width="30%"> Blog Title </th>
                                <th width="30%"> Author Name </th>
                                <!--<th width="30%"> Blog Date </th>-->
                                <th width="30%"> Blog Image </th>
                                <th width="30%"> Author Image </th>
                                <th width="11%"> Created On </th>
                                <!--<th width="11%"> Updated On </th>-->
                                <th width="11%"> Created By </th>
                                <th width="11%"> Status </th>
                                <th width="15%"> Actions </th>
                            </tr>
                            <tr role="row" class="filter">
                                <td>
                                    <input type="text" class="form-control form-filter input-sm" placeholder="Blog Title" name="blog_title"> 
                                </td>
                                <td>
                                    <input type="text" class="form-control form-filter input-sm" placeholder="Author Name" name="blog_author"> 
                                </td>
<!--                                <td>
                                    <div class="input-group date date-picker-createdon margin-bottom-5" data-date-format="yyyy-mm-dd">
                                        <input type="text" class="form-control form-filter input-sm" readonly name="blog_date" placeholder="Date">
                                        <span class="input-group-btn">
                                            <button class="btn btn-sm default" type="button">
                                                <i class="fa fa-calendar"></i>
                                            </button>
                                        </span>
                                    </div>
                                </td>-->
                                <td></td>
                                <td></td>
                                <td>
                                    <div class="input-group date date-picker-createdon margin-bottom-5" data-date-format="yyyy-mm-dd">
                                        <input type="text" class="form-control form-filter input-sm" readonly name="created_on" placeholder="Date">
                                        <span class="input-group-btn">
                                            <button class="btn btn-sm default" type="button">
                                                <i class="fa fa-calendar"></i>
                                            </button>
                                        </span>
                                    </div>
                                </td>
<!--                                <td>
                                    <div class="input-group date date-picker-updatedon margin-bottom-5" data-date-format="yyyy-mm-dd">
                                        <input type="text" class="form-control form-filter input-sm" readonly name="updated_on" placeholder="Date">
                                        <span class="input-group-btn">
                                            <button class="btn btn-sm default" type="button">
                                                <i class="fa fa-calendar"></i>
                                            </button>
                                        </span>
                                    </div>
                                </td>-->
                                <td>
                                    <input type="text" class="form-control form-filter input-sm" placeholder="Name" name="created_by"> 
                                </td>
                                <td>
                                    <select class="form-control form-filter input-sm" placeholder="Select Status" name="is_active">
                                        <option value="">All</option>
                                        <option value="1">Active</option>
                                        <option value="0">In Active</option>
                                    </select>
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
<script src="<?php echo base_url('assets/custom_scripts/admin/blogs.js'); ?>" type="text/javascript"></script>
<!-- End datatable-->
<script>
    $(document).ready(function () {
        DatatablesObj.InitBlogsTable('datatable_blogs');
    });
</script>