<script src="https://www.paypalobjects.com/api/checkout.js"></script>
<section class="pricing membership-plans">
    <div class="container">
        <div class="portlet box blue">
            <div class="portlet-title">
                <div class="caption">
                    <i class="fa fa-user"></i>Guest Member Payment
                </div>
            </div>
            <div class="portlet-body">
                <div class="row">
                    <div class="col-md-6 col-md-offset-3">
                        <?php if (isset($error_msg) && trim($error_msg) != "") { ?>
                            <div class="alert alert-danger">
                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                <span><?php echo $error_msg; ?></span>
                            </div>
                        <?php } ?>
                        <div class="form-group">
                            <input type="hidden" name="member_id" id="member_id" value="<?php echo $member_id; ?>">
                            <label>Select Membership Plan<span class="required">*</span></label>
                            <select class="form-control payment_options" name="payment_amount">
                                <option value="">Select Membership Plan</option>
                                <?php
                                foreach ($plans as $plan) {
                                    echo "<option data-currency='" . $plan['plan_currency'] . "' value='" . $plan['plan_price'] . "'>" . $plan['plan_name'] . " " . $plan['plan_price'] . " (" . $plan['plan_currency'] . ")" . "</option>";
                                }
                                ?>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-6 col-md-offset-3 text-center">
                        <div id="paypal-button-container"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<script>
    $(".payment_options").change(function () {
        var price = $(this).val();
        var currency = $(this).find(':selected').data('currency');
//        console.log(price);
//        console.log(currency);
        paypal.Button.render({
            env: 'sandbox', // sandbox | production
            // PayPal Client IDs - replace with your own
            // Create a PayPal app: https://developer.paypal.com/developer/applications/create
            client: {
                sandbox: 'Adf_99ThxemIWJTyAN5YW3uJAUodR-tNgehq7BIKjTT631_LUZD8nl0DtJ5psvZ4S8GmQHDLZpnyaj2j',
                production: 'ASrI31ib95JJ_anCBtLqLeG4ufIx_AUn1lfOZbEfBdkVkpEwnqcaB8FG5zGz__L_E2dqo__YZ8inB_xf'
            },
            // Show the buyer a 'Pay Now' button in the checkout flow
            commit: true,
            // payment() is called when the button is clicked
            payment: function (data, actions) {
                // Make a call to the REST api to create the payment
                return actions.payment.create({
                    payment: {
                        transactions: [
                            {
                                amount: {total: price, currency: currency}
                            }
                        ]
                    }
                });
            },
            // onAuthorize() is called when the buyer approves the payment
            onAuthorize: function (data, actions) {

                return actions.payment.get().then(function (data) {
                    var member_id = $("#member_id").val();
                    CommonFunctions.ExecutePayment(data, member_id);
                    // Make a call to the REST api to execute the payment
//                    return actions.payment.execute().then(function (e) {
//                        
//                    });
                });
            }

        }, '#paypal-button-container');
    });
</script>