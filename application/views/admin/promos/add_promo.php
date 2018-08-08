<form id="form-add-promo">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
        <h4 class="modal-title">Add New Promo</h4>
    </div>
    <div class="modal-body">
        <div class="portlet-body form">
            <div class="form-body">
                <input type="hidden" name="promo_id"
                       value="<?php echo isset($promo_data->promo_id) ? $promo_data->promo_id : ""; ?>">
                <div class="form-group form-md-line-input form-md-floating-label">
                    <input type="text"
                           value="<?php echo isset($promo_data->promo_title) ? $promo_data->promo_title : ""; ?>"
                           name="promo_title" class="form-control">
                    <label>Promo Title</label>
                    <span class="help-block">Don't use special characters</span>
                </div>
                <div class="form-group form-md-line-input form-md-floating-label">
                    <input type="text"
                           value="<?php echo isset($promo_data->promo_code) ? $promo_data->promo_code : ""; ?>"
                           name="promo_code" class="form-control">
                    <input type="hidden"
                           value="<?php echo isset($promo_data->promo_code) ? $promo_data->promo_code : ""; ?>"
                           name="current_promo_code" class="form-control">
                    <label>Promo Code</label>
                </div>
                <div class="form-group form-md-line-input form-md-floating-label">
                    <input type="radio" <?php echo (!isset($promo_data) && $promo_data == '') ? "checked" : ''; ?>
                           name="promo_subscription_discount"
                           value="0" <?php echo (isset($promo_data->promo_subscription_discount) && $promo_data->promo_subscription_discount == '0') ? "checked" : ""; ?> />
                    Subscription
                    <input type="radio" name="promo_subscription_discount"
                           value="1" <?php echo (isset($promo_data->promo_subscription_discount) && $promo_data->promo_subscription_discount == '1') ? "checked" : ""; ?> />
                    Discount
                    <!--<label>Promos Subscription Discount</label>-->
                </div>
                <div class="form-group form-md-line-input form-md-floating-label">
                    <input type="radio" <?php echo (!isset($promo_data) && $promo_data == '') ? "checked" : ''; ?>
                           name="promo_valid_for"
                           value="1" <?php echo (isset($promo_data->promo_valid_for) && $promo_data->promo_valid_for == '1') ? "checked" : ""; ?> />
                    Guest
                    <input type="radio" name="promo_valid_for"
                           value="2" <?php echo (isset($promo_data->promo_valid_for) && $promo_data->promo_valid_for == '2') ? "checked" : ""; ?> />
                    Companion
                    <!--<label>Promos Subscription Discount</label>-->
                </div>
                <div class="form-group form-md-line-input form-md-floating-label">
                    <input type="text"
                           value="<?php echo isset($promo_data->promo_sub_dis_value) ? $promo_data->promo_sub_dis_value : ""; ?>"
                           name="promo_sub_dis_value" class="form-control">
                    <label id="promo_sub_dis_value">Value in days</label>
                </div>
                <div class="form-group form-md-line-input form-md-floating-label">
                    <input type="text"
                           value="<?php echo isset($promo_data->start_date) ? $promo_data->start_date : ""; ?>"
                           data-date-format="yyyy-mm-dd" name="start_date" class="form-control promo_dates">
                    <label>Start Date</label>
                </div>
                <div class="form-group form-md-line-input form-md-floating-label">
                    <input type="text" value="<?php echo isset($promo_data->end_date) ? $promo_data->end_date : ""; ?>"
                           data-date-format="yyyy-mm-dd" name="end_date" class="form-control promo_dates">
                    <label>End Date</label>
                </div>
                <div class="md-checkbox-inline">
                    <div class="md-checkbox">
                        <input type="checkbox" <?php echo (isset($promo_data->is_active) && $promo_data->is_active) ? "checked='checked'" : ""; ?>
                               name="is_active" id="checkbox" class="md-check">
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
    $(document).ready(function () {
        $('.promo_dates').datepicker();
        $('input[name="promo_subscription_discount"]').change(function () {
            var type = $(this).val();
            if (type == 0) {
                $('#promo_sub_dis_value').text('Value in days');
            } else if (type == 1) {
                $('#promo_sub_dis_value').text('Value in currency');
            }

        })
    });
</script>