<form id="form-add-degree">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
        <h4 class="modal-title"><?php echo (isset($degree_data->member_degree_id) ? 'Edit Degree' : 'Add New Degree'); ?></h4>
    </div>
    <div class="modal-body"> 
        <div class="portlet-body form">
            <div class="form-body">
                <input type="hidden" name="member_degree_id" value="<?php echo isset($degree_data->member_degree_id) ? $degree_data->member_degree_id : ""; ?>">
                <input type="hidden" value="<?php echo $member_id; ?>" name="member_id">
                <div class="form-group form-md-line-input form-md-floating-label">
                    <input type="text" value="<?php echo isset($degree_data->title) ? $degree_data->title : ""; ?>" name="title" class="edited form-control">
                    <label>Title</label>
                    <span class="help-block">Don't use special characters</span>
                </div>
                
                <div class="form-group form-md-line-input form-md-floating-label">
                    <input type="text" value="<?php echo isset($degree_data->degree_name) ? $degree_data->degree_name : ""; ?>" name="degree_name" class="edited form-control">
                    <label>Degree Name</label>
                    <span class="help-block">Don't use special characters</span>
                </div>
                
                
                <div class="form-group form-md-line-input form-md-floating-label">
                    <input type="text" value="<?php echo isset($degree_data->start_date) ? $degree_data->start_date : ""; ?>" name="start_date" class="edited form-control">
                    <label>Start Year</label>
                    
                </div>
                
                
                <div class="form-group form-md-line-input form-md-floating-label" id="end_year">
                    <input type="text" value="<?php echo isset($degree_data->end_date) ? $degree_data->end_date : ""; ?>" name="end_date" class="edited form-control">
                    <label>End Year</label>
                   
                </div>
                
                
                
                <div class="md-checkbox-inline margin-top-20">
                    <div class="md-checkbox">
                        <input type="checkbox" <?php echo (isset($degree_data->end_date) && $degree_data->end_date == 'Present' ) ? "checked='checked'" : ""; ?> name="present" id="checkbox_present" class="md-check">
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
                        <input type="checkbox" <?php echo (isset($degree_data->pub_status) && $degree_data->pub_status) ? "checked='checked'" : ""; ?> name="pub_status" id="checkbox" class="md-check">
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