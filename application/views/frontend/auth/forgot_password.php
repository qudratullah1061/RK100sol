<div class="login-page">
    <div class="outer">
        <div class="middle">
            <div class="inner">

                <div class="panel panel-login panel-reset">
                    <div class="panel-heading">
                        <a href="#" class="pointer-none" id="login-form-link"> Forgot Password</a>
                    </div>
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-lg-12">
                                <form id="forget-password" action="<?php echo base_url('auth/sendForgotPasswordEmail'); ?>" method="post" role="form" style="">
                                    <?php if (isset($email_msg)) { ?>
                                        <div class="alert alert-<?php echo $alert; ?>">
                                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                            <span><?php echo $email_msg; ?></span>
                                        </div>
                                    <?php } ?>
                                    <div class="form-group">
                                        <p class="forget-pssword-text">Please enter your email to get reset password link</p>
                                    </div>
                                    <div class="form-group">
                                        <input type="text" required="required" name="email" class="form-control" placeholder="Email" value="">
                                    </div>

                                    <div class="form-group row">
                                        <div class="col-md-4"><input type="submit" name="login-submit" id="login-submit" tabindex="4" class="btn btn-default" value="Send Email"></div>
                                        <div class="col-md-8 text-right"><a href="<?php echo base_url('auth/login'); ?>" class="forgot-password">Login</a></div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>
