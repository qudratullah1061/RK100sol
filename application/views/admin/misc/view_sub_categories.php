<?php $MainCategoryName = getCategoryNameById($category_id); ?>
<!-- BEGIN PAGE BAR -->
<div class="page-bar">
    <ul class="page-breadcrumb">
        <li>
            <a href="<?php echo base_url('admin/admin_dashboard'); ?>">Home</a>
            <i class="fa fa-circle"></i>
        </li>
        <li>
            <a href="<?php echo base_url('admin/misc/view_categories'); ?>"><?php echo $MainCategoryName; ?></a>
            <i class="fa fa-circle"></i>
        </li>
        <li>
            <span>Sub Categories</span>
        </li>
    </ul>
</div>
<!-- END PAGE BAR -->
<!-- BEGIN PAGE TITLE-->
<h3 class="page-title"><?php echo $MainCategoryName; ?> sub categories listing</h3>
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
                        <a class="purple text-right" data-title="Add Sub Category" href="javascript:SubCategories.modal_add_sub_category(0,'<?php echo $category_id; ?>')"><i class="fa fa-plus-circle"></i> Add new sub category</a>
                    </div>
                    <table class="table table-striped table-bordered table-hover text-center" id="datatable_sub_categories">
                        <thead>
                            <tr role="row" class="heading">
                                <th width="25%"> Sub Category Name </th>
                                <th width="15%"> Created On </th>
                                <th width="15%"> Created By </th>
                                <th width="15%"> Updated On </th>
                                <th width="10%"> Status </th>
                                <th width="20%"> Actions </th>
                            </tr>
                            <tr role="row" class="filter">
                                <td>
                                    <input type="text" class="form-control form-filter input-sm" placeholder="Category Name" name="activity_name"> 
                                </td>
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
                                <td>
                                    <input type="text" class="form-control form-filter input-sm" placeholder="Name" name="created_by"> 
                                </td>
                                <td>
                                    <div class="input-group date date-picker-updatedon margin-bottom-5" data-date-format="yyyy-mm-dd">
                                        <input type="text" class="form-control form-filter input-sm" readonly name="updated_on" placeholder="Date">
                                        <span class="input-group-btn">
                                            <button class="btn btn-sm default" type="button">
                                                <i class="fa fa-calendar"></i>
                                            </button>
                                        </span>
                                    </div>
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
<!-- End datatable-->
<script src="<?php echo base_url('assets/custom_scripts/admin/sub_categories.js'); ?>" type="text/javascript"></script>
<script>
    $(document).ready(function () {
        DatatablesObj.InitSubCategoriesTable('datatable_sub_categories', '<?php echo $category_id; ?>');
    });
</script>