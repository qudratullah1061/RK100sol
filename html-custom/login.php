<!doctype html>
<html class="no-js" lang="en">

    <head>
        <!-- title -->
        <title>Konsorts – Creative Agency, Corporate and Portfolio Multi-purpose Template</title>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width,initial-scale=1.0,maximum-scale=1" />
        <meta name="author" content="konsortsTeam">
        <link rel="shortcut icon" href="images/favicon.png">
        <link href="https://fonts.googleapis.com/css?family=Raleway:200,300,400,500,600,700,800,900" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css?family=Roboto+Condensed:300,400,700" rel="stylesheet">
        <link rel="stylesheet" href="css/font-awesome.min.css" />
        <link rel="stylesheet" href="css/bootstrap.min.css" />
        <link rel="stylesheet" href="css/login.css" />
    </head>
    <body>
        <div class="">
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
                                        <a href="membership-plans.php" id=""> <i class="fa fa-plus-circle"></i> Register</a>
                                    </div>
                                </div>
                                <!--<hr>-->
                            </div>
                            <div class="panel-body">
                                <div class="row">
                                    <div class="col-lg-12">
                                        <form id="login-form" action="https://phpoll.com/login/process" method="post" role="form" style="display: block;">
                                            <div class="form-group">
                                                <input type="text" name="username" id="username" tabindex="1" class="form-control" placeholder="Username" value="">
                                            </div>
                                            <div class="form-group">
                                                <input type="password" name="password" id="password" tabindex="2" class="form-control" placeholder="Password">
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


        <script type="text/javascript" src="js/jquery.js"></script>
        <script type="text/javascript" src="js/bootstrap.min.js"></script>
        <script type="text/javascript" src="js/login.js"></script>
    </body>
</html>