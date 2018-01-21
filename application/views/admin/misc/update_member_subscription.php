<form id="form-update-subscription">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
        <h4 class="modal-title">Update Member Subscription</h4>
    </div>
    <div class="modal-body"> 
        <div class="portlet-body form">
            <div class="form-body">
                <input type="hidden" name="member_id" value="<?php echo isset($member_id) ? $member_id : ""; ?>">
                <div class="form-group">
                    <label>End Subscription Date</label>
                    <input type="text" value="<?php echo isset($end_subscription_date) ? $end_subscription_date : date("Y-m-d H:i:s"); ?>" name="end_subscription_date" class="form-control datepicker-end-subscription-date">
                </div>

                <div class="form-group">
                    <div class="md-checkbox">
                        <input type="checkbox" <?php echo (isset($show_on_homepage) && $show_on_homepage == 1) ? "checked='checked'" : ""; ?> name='show_on_homepage' value="1" id="checkbox1" class="md-check">
                        <label for="checkbox1">
                            <span></span>
                            <span class="check"></span>
                            <span class="box"></span> Show on Homepage?</label>
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