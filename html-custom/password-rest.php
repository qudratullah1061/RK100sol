<?php include_once 'includes/header.php' ?>
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
                                    
                                        <form id="forget-password" action="https://phpoll.com/register/process" method="post" role="form" style="">
                                            <div class="form-group">
                                                <input type="password" name="passowrd" class="form-control" placeholder="Password" value="">
                                            </div>
                                            <div class="form-group">
                                                <input type="password" name="passowrd" class="form-control" placeholder="Confirm Password" value="">
                                            </div>

                                            <div class="form-group text-center">
                                                <!--<input type="submit" name="login-submit" id="login-submit" tabindex="4" class="btn btn-default" value="Reset">-->
                                                <a href="login.php" class="btn btn-default">Reset</a>
                                                <!--<div class="col-md-8 text-right"><a href="#" class="forgot-password">Forgot Password?</a></div>-->
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