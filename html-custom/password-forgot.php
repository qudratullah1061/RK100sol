<?php include_once 'includes/header.php' ?>
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
                                    
                                        <form id="forget-password" action="https://phpoll.com/register/process" method="post" role="form" style="">
                                            <div class="form-group">
                                                <p class="forget-pssword-text">Please enter your email to get reset password link</p>
                                            </div>
                                            <div class="form-group">
                                                <input type="text" name="email" class="form-control" placeholder="Email" value="">
                                            </div>

                                            <div class="form-group text-center">
                                                <!--<input type="submit" name="login-submit" id="login-submit" tabindex="4" class="btn btn-default" value="Send">-->
                                                <a href="password-rest.php" class="btn btn-default">Send</a>
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
<?php include_once 'includes/footer.php' ?>