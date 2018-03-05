<form id="form-add-faq">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
        <h4 class="modal-title">Add New Faq</h4>
    </div>
    <div class="modal-body"> 
        <div class="portlet-body form">
            <div class="form-body">
                <input type="hidden" name="faq_id" value="<?php echo isset($faq_data->faq_id) ? $faq_data->faq_id : ""; ?>">
                <div class="form-group">
                    <label>Faq Question</label>
                    <input type="text" value="<?php echo isset($faq_data->faq_question) ? $faq_data->faq_question : ""; ?>" name="faq_question" class="form-control">
                </div>
                <div class="form-group">
                    <label>Faq Answer</label>
                    <textarea rows="10" type="text" name="faq_answer" class="form-control summernote"><?php echo isset($faq_data->faq_answer) ? $faq_data->faq_answer : ""; ?></textarea>
                </div>
                <div class="md-checkbox-inline">
                    <div class="md-checkbox">
                        <input type="checkbox" <?php echo (isset($faq_data->is_active) && $faq_data->is_active) ? "checked='checked'" : ""; ?> name="is_active" id="checkbox" class="md-check">
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
<script>
$(document).ready(function() {
    $('.summernote').summernote({height: 300});
});
</script>