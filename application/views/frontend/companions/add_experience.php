<form id="form-add-experience">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
        <h4 class="modal-title"><?php echo (isset($experience_data->member_experience_id) ? 'Edit Experience' : 'Add New Experience'); ?></h4>
    </div>
    <div class="modal-body"> 
        <div class="portlet-body form">
            <div class="form-body">
                <input type="hidden" name="member_experience_id" value="<?php echo isset($experience_data->member_experience_id) ? $experience_data->member_experience_id : ""; ?>">
                <div class="form-group">
                    <label>Title</label>
                    <input type="text" value="<?php echo isset($experience_data->title) ? $experience_data->title : ""; ?>" name="title" class="edited form-control">
                </div>
                
                <div class="form-group">
                    <label>Position</label>
                    <input type="text" value="<?php echo isset($experience_data->position) ? $experience_data->position : ""; ?>" name="position" class="edited form-control">
                </div>
                <div class="form-group">
                    <label>Start Year</label>
                    <input type="text" value="<?php echo isset($experience_data->start_date) ? $experience_data->start_date : ""; ?>" name="start_date" class="edited form-control">
                </div>
                <div class="form-group" id="end_year">
                    <label>End Year</label>
                    <input type="text" value="<?php echo isset($experience_data->end_date) ? $experience_data->end_date : ""; ?>" name="end_date" class="edited form-control">
                </div>
                
                <div class="md-checkbox-inline margin-top-20">
                    <div class="md-checkbox">
                        <input type="checkbox" <?php echo (isset($experience_data->end_date) && $experience_data->end_date == 'Present' ) ? "checked='checked'" : ""; ?> name="present" id="checkbox_present" class="md-check">
                        <label for="checkbox_present">
                            <span></span>
                            <span class="check"></span>
                            <span class="box"></span>
                            Present
                        </label>
                    </div>
                </div>
                
                <div class="md-checkbox-inline margin-top-20">
                    <div class="md-checkbox">
                        <input type="checkbox" <?php echo (isset($experience_data->pub_status) && $experience_data->pub_status) ? "checked='checked'" : ""; ?> name="pub_status" id="checkbox" class="md-check">
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
$(document).ready(function(){
        $('#checkbox_present').click(function(){
            if($(this).prop("checked") == true){
                $('#end_year').hide();
            }
            else if($(this).prop("checked") == false){
               $('#end_year').show();
            }
        });
    });
</script>