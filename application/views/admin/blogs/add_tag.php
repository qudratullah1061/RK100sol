<form id="form-add-tag">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
        <h4 class="modal-title">Add New Tag</h4>
    </div>
    <div class="modal-body"> 
        <div class="portlet-body form">
            <div class="form-body">
                <input type="hidden" name="tag_id" value="<?php echo isset($tag_data->tag_id) ? $tag_data->tag_id : ""; ?>">
                <div class="form-group form-md-line-input form-md-floating-label">
                    <input type="text" value="<?php echo isset($tag_data->tag_name) ? $tag_data->tag_name : ""; ?>" name="tag_name" class="form-control">
                    <label>Tag Name</label>
                    <span class="help-block">Don't use special characters</span>
                </div>
                <div class="md-checkbox-inline">
                    <div class="md-checkbox">
                        <input type="checkbox" <?php echo (isset($tag_data->is_active) && $tag_data->is_active) ? "checked='checked'" : ""; ?> name="is_active" id="checkbox" class="md-check">
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