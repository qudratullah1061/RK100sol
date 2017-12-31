<form id="form-add-language">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
        <h4 class="modal-title"><?php echo (isset($language_data->language_id) ? 'Edit Language' : 'Add New Language'); ?></h4>
    </div>
    <div class="modal-body"> 
        <div class="portlet-body form">
            <div class="form-body">
                <input type="hidden" name="language_id" value="<?php echo isset($language_data->language_id) ? $language_data->language_id : ""; ?>">
                <input type="hidden" name="member_id" value="<?php echo (isset($language_data->member_id) && $language_data->member_id > 0) ? $language_data->member_id : (isset($member_id) ? $member_id : 0); ?>">
                <div class="form-group form-md-line-input form-md-floating-label">
                    <input type="text" value="<?php echo isset($language_data->language_name) ? $language_data->language_name : ""; ?>" name="language_name" class="form-control edited">
                    <label>Language Name</label>
                    <span class="help-block">Don't use special characters</span>
                </div>
                <div class="form-group form-md-line-input form-md-floating-label">
                    <select class="form-control" name="language_level" id="language_level">
                        <option value="Elementary" <?php echo isset($language_data->language_level) && $language_data->language_level == "Elementary" ? "selected='selected'" : ""; ?>>Elementary</option>
                        <option value="Limited" <?php echo isset($language_data->language_level) && $language_data->language_level == "Limited" ? "selected='selected'" : ""; ?>>Limited</option>
                        <option value="Professional" <?php echo isset($language_data->language_level) && $language_data->language_level == "Professional" ? "selected='selected'" : ""; ?>>Professional</option>
                        <option value="Full Professional" <?php echo isset($language_data->language_level) && $language_data->language_level == "Full Professional" ? "selected='selected'" : ""; ?>>Full Professional</option>
                        <option value="Native or Bilingual" <?php echo isset($language_data->language_level) && $language_data->language_level == "Native or Bilingual" ? "selected='selected'" : ""; ?>>Native or Bilingual</option>
                        <option value="Conversational" <?php echo isset($language_data->language_level) && $language_data->language_level == "Conversational" ? "selected='selected'" : ""; ?>>Conversational</option>
                        <option value="Frank" <?php echo isset($language_data->language_level) && $language_data->language_level == "Frank" ? "selected:'selected'" : ""; ?>>Frank</option>
                    </select>
                </div>
                <div class="md-checkbox-inline margin-top-20">
                    <div class="md-checkbox">
                        <input type="checkbox" <?php echo (isset($language_data->is_active) && $language_data->is_active) ? "checked='checked'" : ""; ?> name="is_active" id="checkbox" class="md-check">
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