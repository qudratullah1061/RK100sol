<form id="form-add-contact">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
        <h4 class="modal-title"><?php echo (isset($contact_data->contact_form_id) ? 'View Contact Form' : ''); ?></h4>
    </div>
    <div class="modal-body"> 
        <div class="portlet-body form">
            <div class="form-body">
                <input type="hidden" name="contact_form_id" value="<?php echo isset($contact_data->contact_form_id) ? $contact_data->contact_form_id : ""; ?>">
               
                <div class="form-group form-md-line-input form-md-floating-label">
                    <input type="text" value="<?php echo isset($contact_data->name) ? $contact_data->name : ""; ?>" class="form-control edited" readonly>
                    <label>Name</label>
                    
                </div>
                <div class="form-group form-md-line-input form-md-floating-label">
                    <input type="text" value="<?php echo isset($contact_data->email) ? $contact_data->email : ""; ?>" class="form-control edited" readonly>
                    <label>Email</label>
                    
                </div>
               <div class="form-group form-md-line-input form-md-floating-label">
                    <input type="text" value="<?php echo isset($contact_data->phone) ? $contact_data->phone : ""; ?>" class="form-control edited" readonly>
                    <label>Phone</label>
                    
                </div>
                
                <div class="form-group form-md-line-input form-md-floating-label">
                    <input type="text" value="<?php echo isset($contact_data->subject) ? $contact_data->subject : ""; ?>" class="form-control edited" readonly>
                    <label>Subject</label>
                    
                </div>
                
                <div class="form-group form-md-line-input form-md-floating-label">
                    <textarea  class="form-control edited" readonly><?php echo isset($contact_data->comment) ? $contact_data->comment : ""; ?></textarea>
                    <label>Comment</label>
                    
                </div>
                
                <div class="form-group">
                    <label>Read Status</label>
                    <select class="form-control" name="is_read">
                        <option value="1" <?php echo isset($contact_data->is_read) && $contact_data->is_read == 1 ? "selected" : ""; ?>>Read</option>
                        <option value="0" <?php echo isset($contact_data->is_read) && $contact_data->is_read == 0 ? "selected" : ""; ?>>UnRead</option>
                    </select>
                </div>
               
            </div>
        </div>
    </div>
    <div class="modal-footer">
        <button type="button" class="btn default" data-dismiss="modal">Close</button>
        <input type="submit" name="submit" value="Save Changes" class="btn green">
    </div>
</form>