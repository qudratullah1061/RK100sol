<form id="form-add-notification">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
        <h4 class="modal-title"><?php if($is_view == 1 ){ echo 'View Notification'; }else{ echo (isset($notification_data->notification_id) ? 'Edit Notification' : 'Add New Notification'); } ?></h4>
    </div>
    <div class="modal-body"> 
        <div class="portlet-body form">
            <div class="form-body">
                <input type="hidden" name="notification_id" value="<?php echo isset($notification_data->notification_id) ? $notification_data->notification_id : ""; ?>">
                <div class="form-group">
                    <label><?php echo isset($notification_data->notification_title) ? $notification_data->notification_title : ""; ?></label>
                    <p><?php echo isset($notification_data->notification_message) ? $notification_data->notification_message : ""; ?></p>
                </div>
                
                
                
                
                
                
            </div>
        </div>
    </div>
    
    <div class="modal-footer">
        <button type="button" class="btn default" data-dismiss="modal">Close</button>
       
    </div>
    
</form>
