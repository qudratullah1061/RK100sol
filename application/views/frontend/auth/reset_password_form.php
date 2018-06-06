<div class="login-page">
    <div class="outer">
        <div class="middle">
            <div class="inner">

                <div class="panel panel-login panel-reset">
                    <div class="panel-heading">
                        <a href="#" class="pointer-none" id="login-form-link"> Reset Password</a>
                    </div>
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-lg-12">

                                <form id="reset-password-form" action="<?php echo base_url('auth/update_password'); ?>" method="post" role="form">
                                    <?php if (isset($email_msg)) { ?>
                                        <div class="alert alert-<?php echo $alert; ?>">
                                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                            <span><?php echo $email_msg; ?></span>
                                        </div>
                                    <?php } ?>
                                    <?php if ($alert != "success") { ?>
                                        <input type='hidden' name="member_id" value="<?php echo isset($member_id) ? $member_id : 0; ?>">
                                        <input type='hidden' name="email_verification_code" value="<?php echo isset($email_verification_code) ? $email_verification_code : 0; ?>">
                                        <div class="form-group">
                                            <input type="password" name="password" class="form-control" placeholder="Password">
                                        </div>
                                        <div class="form-group">
                                            <input type="password" name="confirm_password" class="form-control" placeholder="Confirm Password">
                                        </div>

                                        <div class="form-group row">
                                            <div class="col-md-4"><input type="submit" name="reset-submit" id="reset-submit" class="btn btn-default" value="Reset"></div>
                                            <div class="col-md-8 text-right"><a href="<?php echo base_url('login'); ?>" class="forgot-password">Login</a></div>
                                        </div>
                                        <?php
                                    } else {
                                        echo "<div class='col-md-8 text-right'><a href='<?php echo base_url(\"login\"); ?>' class='btn btn-success'>Login</a></div>";
                                    }
                                    ?>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>

