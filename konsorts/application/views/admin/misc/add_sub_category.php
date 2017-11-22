<form id="form-add-sub_category">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
        <h4 class="modal-title">Add New Sub Category Option</h4>
    </div>
    <div class="modal-body"> 
        <div class="portlet-body form">
            <div class="form-body">
                <input type="hidden" name="category_id" value="<?php echo $category_id; ?>">
                <input type="hidden" name="sub_category_id" value="<?php echo isset($sub_category_data->sub_category_id) ? $sub_category_data->sub_category_id : ""; ?>">
                <div class="form-group form-md-line-input form-md-floating-label">
                    <input type="text" value="<?php echo isset($sub_category_data->sub_category_name) ? $sub_category_data->sub_category_name : ""; ?>" name="sub_category_name" class="form-control">
                    <label>Sub Category Name</label>
                    <span class="help-block">Don't use special characters</span>
                </div>
                <div class="md-checkbox-inline">
                    <div class="md-checkbox">
                        <input type="checkbox" <?php echo (isset($sub_category_data->is_active) && $sub_category_data->is_active) ? "checked='checked'" : ""; ?> name="is_active" id="checkbox" class="md-check">
                        <label for="checkbox">
                            <span></span>
                            <span class="check"></span>
                            <span class="box"></span>
                            Activate
                        </label>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal-footer">
        <button type="button" class="btn default" data-dismiss="modal">Close</button>
        <input type="submit" name="submit" value="Save Changes" class="btn green">
    </div>
</form>