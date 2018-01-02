<div class="login-page">
    <div class="outer">
        <div class="middle">
            <div class="inner">

                <div class="panel panel-login">
                    <div class="panel-heading">
                        <div class="row">
                            <div class="col-xs-6">
                                <a href="#" class="active" id="login-form-link"> <i class="fa fa-sign-in"></i> Login</a>
                            </div>
                            <div class="col-xs-6">
                                <a href="<?php echo base_url('auth/register'); ?>" id=""> <i class="fa fa-plus-circle"></i> Register</a>
                            </div>
                        </div>
                        <!--<hr>-->
                    </div>
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-lg-12">
                                <form class="login-form" action="<?php echo base_url('auth/verifyLogin'); ?>" method="post" role="form">
                                    <div class="alert alert-danger display-hide">
                                        <button class="close" data-close="alert"></button>
                                        <span> Enter any username and password. </span>
                                    </div>
                                    <?php if (isset($login_error)) { ?>
                                        <div class="alert alert-<?php echo $alert; ?>">
                                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                            <span><?php echo $login_error; ?></span>
                                        </div>
                                    <?php } ?>
                                    <div class="form-group">
                                        <input type="text" name="username" id="username" tabindex="1" class="form-control" placeholder="Username" value="<?php
                                        if (isset($post_data['username'])) {
                                            echo $post_data['username'];
                                        }
                                        ?>">
                                    </div>
                                    <div class="form-group">
                                        <input type="password" name="password" id="password" tabindex="2" class="form-control" placeholder="Password" value="<?php
                                        if (isset($post_data['password'])) {
                                            echo $post_data['password'];
                                        }
                                        ?>">
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-md-4"><input type="submit" name="login-submit" id="login-submit" tabindex="4" class="btn btn-default" value="Log In"></div>
                                        <div class="col-md-8 text-right"><a href="<?php echo base_url('auth/forgot_password'); ?>" class="forgot-password">Forgot Password?</a></div>
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
<script src="<?php echo base_url(); ?>assets/custom_scripts/frontend/login.js" type="text/javascript"></script>