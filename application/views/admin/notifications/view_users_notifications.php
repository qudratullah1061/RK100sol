<style>
    .highlight-noti {
        background: antiquewhite;
    }
</style>
<div class="row">
    <div class="col-lg-12 col-xs-12 col-sm-12">
        <div class="portlet light " id="notiTabs">
            <div class="portlet-title tabbable-line">
                <div class="caption">
                    <i class="icon-bubbles font-dark hide"></i>
                    <span class="caption-subject font-dark bold uppercase">Members Settings Notifications</span>
                </div>
                <ul class="nav nav-tabs">
                    <li class="active">
                        <a href="#guestsNotifications" data-toggle="tab"> Guests </a>
                    </li>
                    <li>
                        <a href="#companionsNotifications" data-toggle="tab"> Companions </a>
                    </li>
                </ul>
            </div>
            <div class="portlet-body">
                <div class="tab-content">
                    <div class="tab-pane active" id="guestsNotifications">
                        <!-- BEGIN: Comments -->
                        <div class="mt-comments">
                            <?php foreach ($notifications as $notification) {
                                if ($notification['user_type'] == 1) {
                                    ?>
                                    <div class="mt-comment <?= (strpos($_GET['id'], $notification['notify_id'])) ? 'highlight-noti' : '' ?>"
                                         id="comment<?php echo $notification['notify_id']; ?>">
                                        <div class="mt-comment-body">
                                            <div class="mt-comment-info">
                                                <span class="mt-comment-author"><?php echo get_username($notification['member_id']); ?></span>
                                                <span class="mt-comment-date"><?php echo date('j F, g:i a', strtotime($notification['created_at'])); ?></span>
                                            </div>
                                            <div class="mt-comment-text"> <?php echo $notification['message']; ?> </div>
                                            <div class="mt-comment-details">
                                                <ul class="mt-comment-actions">
                                                    <li>
                                                        <a id="isDelete<?php echo $notification['notify_id']; ?>"
                                                           href="javascript:CommonFunctions.Delete('<?php echo $notification['notify_id']; ?>', 'tb_profile_notify', 'notify_id', 'Are you sure you want to delete this notification?')">Delete</a>
                                                    </li>
                                                    <?php
                                                    if ($notification['is_read'] == 0) {
                                                        ?>
                                                        <li>
                                                            <a id="isRead<?php echo $notification['notify_id']; ?>"
                                                               href="javascript:CommonFunctions.MarkRead('<?php echo $notification['notify_id']; ?>', 'tb_profile_notify', 'notify_id', 'Are you sure you want to mark this notification as read?')">Mark
                                                                Read</a>
                                                        </li>
                                                    <?php } ?>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                <?php }
                            } ?>
                        </div>
                        <!-- END: Comments -->
                    </div>
                    <div class="tab-pane" id="companionsNotifications">
                        <!-- BEGIN: Comments -->
                        <div class="mt-comments">
                            <?php foreach ($notifications as $notification) {
                                if ($notification['user_type'] == 2) { ?>
                                    <div class="mt-comment <?= (strpos($_GET['id'], $notification['notify_id'])) ? 'highlight-noti' : '' ?>"
                                         id="comment<?php echo $notification['notify_id']; ?>">
                                        <div class="mt-comment-body">
                                            <div class="mt-comment-info">
                                                <span class="mt-comment-author"><?php echo get_username($notification['member_id']); ?></span>
                                                <span class="mt-comment-date"><?php echo date('j F, g:i a', strtotime($notification['created_at'])); ?></span>
                                            </div>
                                            <div class="mt-comment-text"> <?php echo $notification['message']; ?> </div>
                                            <div class="mt-comment-details">
                                                <ul class="mt-comment-actions">
                                                    <li>
                                                        <a id="isDelete<?php echo $notification['notify_id']; ?>"
                                                           href="javascript:CommonFunctions.Delete('<?php echo $notification['notify_id']; ?>', 'tb_profile_notify', 'notify_id', 'Are you sure you want to delete this notification?')">Delete</a>
                                                    </li>
                                                    <?php
                                                    if ($notification['is_read'] == 0) {
                                                        ?>
                                                        <li>
                                                            <a id="isRead<?php echo $notification['notify_id']; ?>"
                                                               href="javascript:CommonFunctions.MarkRead('<?php echo $notification['notify_id']; ?>', 'tb_profile_notify', 'notify_id', 'Are you sure you want to mark this notification as read?')">Mark
                                                                Read</a>
                                                        </li>
                                                    <?php } ?>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                <?php }
                            } ?>
                        </div>
                        <!-- END: Comments -->
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="<?php echo base_url('assets/custom_scripts/admin/notification.js'); ?>" type="text/javascript"></script>
<script>
    $(document).ready(function () {
        var goto = "<?= $_GET['id']?>";
        $('html, body').animate({
            scrollTop: $('#' + goto).offset().top
        }, 2000);

        setTimeout(function () {
            $('#' + goto).removeClass('highlight-noti')
        }, 3000);
    })
</script>