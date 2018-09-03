<script src="https://www.paypalobjects.com/api/checkout.js"></script>
<section class="pricing membership-plans">
    <div class="container">
        <div class="portlet box blue">
            <div class="portlet-title">
                <div class="caption">
                    <i class="fa fa-user"></i>Member Subscription Plans & Payment
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
                        <?php }
                        if (isset($discount_value) && $discount_value != "") { ?>
                            <div class="alert alert-success">
                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                <span>You've used discount promo code that is why you will save <?= number_format($discount_value,2) ." (".$plans[0]['plan_currency'].")"?> on subscription plans. </span>
                            </div>
                        <?php } ?>
                        <div class="form-group">
                            <input type="hidden" name="member_id" id="member_id" value="<?php echo $member_id; ?>">
                            <input type="hidden" name="get_type" id="get_type" value="<?php echo $type; ?>">
                            <label>Select Membership Plan<span class="required">*</span></label>
                            <select class="form-control payment_options" name="payment_amount">
                                <option value="">Select Membership Plan</option>
                                <?php
                                foreach ($plans as $plan) {
                                    if (isset($discount_value) && $discount_value != '') {
                                        echo "<option data-promo-used='1' data-currency='" . $plan['plan_currency'] . "' value='" . ($plan['plan_price'] - $discount_value) . "'>" . $plan['plan_name'] . " " . $plan['plan_price'] . " (" . $plan['plan_currency'] . ") - You saved ".number_format($discount_value,2)." (" . $plan['plan_currency'] . ")" . "</option>";
                                    } else {
                                        echo "<option data-promo-used='0' data-currency='" . $plan['plan_currency'] . "' value='" . $plan['plan_price'] . "'>" . $plan['plan_name'] . " " . $plan['plan_price'] . " (" . $plan['plan_currency'] . ")" . "</option>";
                                    }
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
    var price, currency, promo_used;
    var initPaypalChk = false;
    $(".payment_options").change(function () {
        price = $(this).val();
        currency = $(this).find(':selected').data('currency');
        promo_used = $(this).find(':selected').data('promo-used');
        if (!initPaypalChk) {
            initPaypal();
            initPaypalChk = true;
        }

    });

    function initPaypal() {
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
                                amount: {
                                    total: price, currency: currency
                                }
                            }
                        ]
                    }
                });
            },

            onCancel: function (data, actions) {
                swal("Error!", "You have canceled the payment procedure, please pay your subscription charges in order to activate your account.", "warning");
            },

            onError: function (err) {
                swal("Error!", "Please select membership plan to pay with paypal.", "warning");
                console.log(err);
            },
            // onAuthorize() is called when the buyer approves the payment
            onAuthorize: function (data, actions) {

                return actions.payment.get().then(function (data) {
                    var member_id = $("#member_id").val();
                    var type = $("#get_type").val();
                    CommonFunctions.ExecutePayment(data, member_id, type,promo_used);
                    // Make a call to the REST api to execute the payment
//                    return actions.payment.execute().then(function (e) {
//                        
//                    });
                });
            }

        }, '#paypal-button-container');
    }

</script>