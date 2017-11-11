<div class="page-lock">
    <div class="page-logo">
        <a class="brand" href="index.html">
            <img src="<?php echo base_url(); ?>assets/pages/img/logo-big.png" alt="logo" /> </a>
    </div>
    <div class="page-body">
        <div class="lock-head"> Locked </div>
        <div class="lock-body">
            <div class="lock-cont">
                <div class="lock-item">
                    <div class="pull-left lock-avatar-block">
                        <img src="<?php echo base_url(); ?>assets/pages/media/profile/photo3.jpg" class="lock-avatar"> </div>
                </div>
                <div class="lock-item lock-item-full">
                    <form class="lock-form pull-left" action="<?php echo base_url('admin/admin_auth/verifyUnlock'); ?>" method="post">
                        <h4><?php echo isset($admin_info['username']) ? ucfirst($admin_info['username']) : ""; ?></h4>
                        <div class="alert alert-danger display-hide">
                            <button class="close" data-close="alert"></button>
                            <span> Enter valid password. </span>
                        </div>
                        <?php if (isset($login_error)) { ?>
                            <div class="alert alert-danger">
                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                <span><?php echo $login_error; ?></span>
                            </div>
                        <?php } ?>
                        <div class="form-group">
                            <input class="form-control placeholder-no-fix" type="password" autocomplete="off" placeholder="Password" name="password" /> 
                        </div>
                        <div class="form-actions">
                            <button type="submit" class="btn red uppercase">Login</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="lock-bottom">
            <a href="<?php echo base_url('admin/admin_auth/logout'); ?>"><?php echo "Not&nbsp;".(isset($admin_info) ? (ucfirst($admin_info['first_name']) . " " . ucfirst($admin_info['last_name']) . "?") : ""); ?></a>
        </div>
    </div>
</div>