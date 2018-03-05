<link href="<?php echo base_url(); ?>assets/global/plugins/bootstrap-multiselect/css/bootstrap-multiselect.css" rel="stylesheet" type="text/css" />
<!-- BEGIN PAGE BAR -->
<div class="page-bar">
    <ul class="page-breadcrumb">
        <li>
            <a href="<?php echo base_url('admin/admin_dashboard'); ?>">Home</a>
            <i class="fa fa-circle"></i>
        </li>
        <li>
            <span>Newsletters</span>
        </li>
    </ul>
</div>
<!-- END PAGE BAR -->
<!-- BEGIN PAGE TITLE-->
<h3 class="page-title">Send Newsletters</h3>
<!-- END PAGE TITLE-->
<!-- BEGIN Datatable-->
<div class="row">
    <form role="form" id="newsletters-data" class="form-horizontal">
        <div class="col-md-12">
            <div class="portlet box light">
                <div class="portlet-body">
                    <div class="form-group">
                        <label class="col-md-2 control-label">Emails for Newsletters</label>
                        <div class="col-md-10">
                            <select name="newsletter_email[]" id="newsletter_email" class="mt-multiselect btn btn-default" multiple="multiple" data-label="left" data-select-all="true" data-width="100%" data-filter="true" data-action-onchange="true">
                                <?php foreach ($newsletters as $news) { ?>
                                    <option value="<?php echo $news->newsletter_email; ?>"><?php echo $news->newsletter_email; ?></option>
                                <?php }
                                ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-2 control-label">Write Newsletter</label>
                        <div class="col-md-10">
                            <textarea type="text" name="write_newsletter" class="form-control summernote"></textarea>
                        </div>
                    </div>
                    <div class="form-actions">
                        <div class="row">
                            <div class="col-md-offset-3 col-md-9">
                                <button type="submit" class="btn btn-circle green">Submit</button>
                                <a href='<?php echo base_url('admin/newsletters/view_newsletters'); ?>' class="btn btn-circle grey-salsa btn-outline">Cancel</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </form>
</div>
<script src="<?php echo base_url(); ?>assets/global/plugins/bootstrap-multiselect/js/bootstrap-multiselect.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>assets/custom_scripts/admin/newsletters.js" type="text/javascript"></script>
<script>
    $(document).ready(function () {
        $('.summernote').summernote({height: 300});
        $('#newsletter_email').multiselect({enableFiltering: true, includeSelectAllOption: true, buttonClass: "mt-multiselect btn btn-default", dropLeft: true, buttonWidth: "100%"});
    });
</script>