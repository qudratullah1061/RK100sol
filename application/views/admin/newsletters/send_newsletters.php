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
<form role="form" id="newsletters-data" class="form-horizontal">
<div class="row">
    <div class="col-md-12">
        <div class="portlet light bordered">
            <div class="portlet-body form">
                    <div class="form-group">
                        <label class="col-md-2 control-label">Emails for Newsletters</label>
                        <div class="col-md-10">
                            <select name="newsletter_email[]" id="newsletter_email" class="mt-multiselect btn btn-default" multiple="multiple" data-clickable-groups="true" data-collapse-groups="true" data-width="100%" data-action-onchange="true">
                                <optgroup label="Select All" class="group-1">
                                <?php foreach ($newsletters as $news) { ?>
                                    <option value="<?php echo $news->newsletter_email; ?>"><?php echo $news->newsletter_email; ?></option>
                                <?php }
                                ?>
                                </optgroup>
                            </select>
                        </div>
                    </div>
                    <br>
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
</div>
    </form>
<script src="<?php echo base_url(); ?>assets/custom_scripts/admin/newsletters.js" type="text/javascript"></script>
<script>
$(document).ready(function() {
    $('.summernote').summernote();
});
</script>