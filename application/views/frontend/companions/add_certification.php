<form id="form-add-certification">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
        <h4 class="modal-title"><?php echo (isset($certification_data->member_certification_id) ? 'Edit Certification' : 'Add New Certification'); ?></h4>
    </div>
    <div class="modal-body"> 
        <div class="portlet-body form">
            <div class="form-body">
                <input type="hidden" name="member_certification_id" value="<?php echo isset($certification_data->member_certification_id) ? $certification_data->member_certification_id : ""; ?>">
                <div class="form-group">
                    <label>Title</label>
                    <input type="text" value="<?php echo isset($certification_data->title) ? $certification_data->title : ""; ?>" name="title" class="form-control">
                </div>
                <div class="form-group">
                    <label>Description</label>
                    <textarea name="description" class="form-control"><?php echo isset($certification_data->description) ? $certification_data->description : ""; ?></textarea>
                   
                </div>
                
                
                
                
                <div class="md-checkbox-inline margin-top-20">
                    <div class="md-checkbox">
                        <input type="checkbox" <?php echo (isset($certification_data->pub_status) && $certification_data->pub_status) ? "checked='checked'" : ""; ?> name="pub_status" id="checkbox" class="md-check">
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
