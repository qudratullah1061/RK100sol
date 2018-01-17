<!-- BEGIN PAGE BAR -->
<div class="page-bar">
    <ul class="page-breadcrumb">
        <li>
            <a href="<?php echo base_url('admin/admin_dashboard'); ?>">Home</a>
            <i class="fa fa-circle"></i>
        </li>
        <li>
            <span>Requests</span>
        </li>
    </ul>
</div>
<!-- END PAGE BAR -->
<!-- BEGIN PAGE TITLE-->
<h3 class="page-title">Contact Us Requests</h3>
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
                        <a class="purple text-right" data-title="Add Type" href="javascript:Categories.modal_add_category()"><i class="fa fa-plus-circle"></i> Add new category</a>
                    </div>
                    <table id="contact_table" class="table table-striped table-bordered table-hover text-center dataTable no-footer" cellspacing="0" width="100%">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Phone</th>
                                <th>Subject</th>
                                <th>Is Read</th>
                                <th>Is Reply</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($contact_us_form as $value) { ?>
                                <tr>
                                    <td><?php echo $value->name; ?></td>
                                    <td><?php echo $value->email; ?></td>
                                    <td><?php echo $value->phone; ?></td>
                                    <td><?php echo $value->subject; ?></td>
                                    <td><?php echo ($value->is_read == 1 ? 'Yes' : 'No'); ?></td>
                                    <td><?php echo ($value->is_reply == 1 ? 'Yes' : 'No'); ?></td>
                                    <td><a class="btn btn-xs default btn-editable" onclick="Contact.modal_add_contact(<?php echo $value->contact_form_id; ?>)">View</a><a class="btn btn-xs default btn-editable" onclick="Contact.modal_add_contact_reply(<?php echo $value->contact_form_id; ?>)">Reply</a> </td>
                                </tr>
                            <?php } ?>

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <!-- End: life time stats -->
    </div>
</div>

<!-- End datatable-->
<!--<script src="<?php // echo base_url(); ?>assets/frontend/datatable/jquery.dataTables.min.js" type="text/javascript"></script>-->
<script src="<?php echo base_url('assets/custom_scripts/admin/contactus.js'); ?>" type="text/javascript"></script>
<script>
                                        $("#contact_table").DataTable({"scrollX": false});
</script>