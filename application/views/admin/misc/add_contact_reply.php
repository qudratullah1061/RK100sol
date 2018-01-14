<form id="form-add-contact-reply">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
        <h4 class="modal-title"><?php echo (isset($contact_data->contact_form_id) ? 'Reply' : ''); ?></h4>
    </div>
    <div class="modal-body"> 
        <div class="portlet-body form">
            <div class="form-body">
                <input type="hidden" name="contact_form_id" value="<?php echo isset($contact_data->contact_form_id) ? $contact_data->contact_form_id : ""; ?>">
               
                
                <div class="form-group form-md-line-input form-md-floating-label">
                    <input type="text" value="<?php echo isset($contact_data->email) ? $contact_data->email : ""; ?>" class="form-control edited" readonly>
                    <label>Reply To</label>
                    
                </div>
               <div class="form-group form-md-line-input form-md-floating-label">
                    <input type="text" value="" class="form-control edited" name="title">
                    <label>Title</label>
                    
                </div>
                
               
                
                <div class="form-group form-md-line-input form-md-floating-label">
                    <textarea  class="form-control edited" name="message"></textarea>
                    <label>Message</label>
                    
                </div>
                
                
               
            </div>
        </div>
    </div>
    <div class="modal-footer">
        <button type="button" class="btn default" data-dismiss="modal">Close</button>
        <input type="submit" name="submit" value="Send Message" class="btn green">
    </div>
</form>