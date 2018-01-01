<form id="form-update-subscription">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
        <h4 class="modal-title">Update Member Subscription</h4>
    </div>
    <div class="modal-body"> 
        <div class="portlet-body form">
            <div class="form-body">
                <input type="hidden" name="member_id" value="<?php echo isset($member_id) ? $member_id : ""; ?>">
                <input type="hidden" name="end_subscription_date" value="<?php echo isset($end_subscription_date) ? $end_subscription_date : ""; ?>">
                <div class="form-group">
                    <label>Category Name</label>
                    <input type="text" value="<?php echo isset($end_subscription_date) ? $end_subscription_date : date("Y-m-d H:i:s"); ?>" name="end_subscription_date" class="form-control datepicker-end-subscription-date">
                </div>
            </div>
        </div>
    </div>
    <div class="modal-footer">
        <button type="button" class="btn default" data-dismiss="modal">Close</button>
        <input type="submit" name="submit" value="Save Changes" class="btn green">
    </div>
</form>