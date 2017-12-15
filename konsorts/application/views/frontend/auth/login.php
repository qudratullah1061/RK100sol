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
                                <!--<a href="#" id="register-form-link"> <i class="fa fa-plus-circle"></i> Register</a>-->
                                <a href="<?php echo base_url('auth/register'); ?>" id=""> <i class="fa fa-plus-circle"></i> Register</a>
                            </div>
                        </div>
                        <!--<hr>-->
                    </div>
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-lg-12">
                                
                                <form id="login-form" action="<?php echo base_url('auth/verifyLogin'); ?>" method="post" role="form" style="display: block;">
                                    
                                    <?php if (isset($login_error)) { ?>
                                        <div class="alert alert-<?php echo $alert; ?>">
                                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                            <span><?php echo $login_error; ?></span>
                                        </div>
                                    <?php } ?>
                                    <div class="form-group">
                                        <input type="text" name="username" id="username" tabindex="1" class="form-control" placeholder="Username" value="<?php if(isset($post_data['username'])){ echo $post_data['username']; } ?>">
                                    </div>
                                    <div class="form-group">
                                        <input type="password" name="password" id="password" tabindex="2" class="form-control" placeholder="Password" value="<?php if(isset($post_data['password'])){ echo $post_data['password']; } ?>">
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-md-4"><input type="submit" name="login-submit" id="login-submit" tabindex="4" class="btn btn-default" value="Log In"></div>
                                        <div class="col-md-8 text-right"><a href="password-forgot.php" class="forgot-password">Forgot Password?</a></div>
                                    </div>
                                </form>
                                <form id="register-form" action="https://phpoll.com/register/process" method="post" role="form" style="display: none;">
                                    <div class="form-group">
                                        <input type="text" name="username" id="username" tabindex="1" class="form-control" placeholder="Username" value="">
                                    </div>
                                    <div class="form-group">
                                        <input type="email" name="email" id="email" tabindex="1" class="form-control" placeholder="Email Address" value="">
                                    </div>
                                    <div class="form-group">
                                        <input type="password" name="password" id="password" tabindex="2" class="form-control" placeholder="Password">
                                    </div>
                                    <div class="form-group">
                                        <input type="password" name="confirm-password" id="confirm-password" tabindex="2" class="form-control" placeholder="Confirm Password">
                                    </div>
                                    <div class="form-group text-center">

                                        <input type="submit" name="register-submit" id="register-submit" tabindex="4" class=" btn btn-default" value="Register Now">

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