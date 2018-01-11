<section class="pricing membership-plans">
    <div class="container">
        <div class="portlet box blue">
            <div class="portlet-title">
                <div class="caption">
                    <i class="fa fa-user"></i>Notifications
                </div>
            </div>
            <div class="portlet-body">
                <div class="tab-content">
                    <div class="tab-pane active" id="portlet_comments_1">
                        <!-- BEGIN: Comments -->
                        <div class="mt-comments">
                            <?php foreach($notifications as $notification){ 
                                
                            ?>
                            <div class="mt-comment">
                                <div class="mt-comment-img">
                                    <img src="<?php echo base_url($notification['image_path']."/".$notification['image']); ?>" /> </div>
                                <div class="mt-comment-body">
                                    <div class="mt-comment-info">
                                        <span class="mt-comment-author"><?php echo $notification['username']; ?></span>
                                        <span class="mt-comment-date"><?php echo date('j F, g:i a',strtotime($notification['created_on'])); ?></span>
                                    </div>
                                    <div class="mt-comment-text"> <?php echo $notification['notification_message']; ?> </div>
                                    <div class="mt-comment-details">
                                        <!--<span class="mt-comment-status mt-comment-status-pending">Pending</span>-->
                                        <ul class="mt-comment-actions">
                                            
                                            <li>
                                                <a href="javascript:Notifications.modal_add_notification('<?php echo $notification['notification_id']; ?>',1)">View</a>
                                            </li>
                                            <li>
                                                <a href="javascript:CommonFunctions.Delete('<?php echo $notification['notification_user_id']; ?>', 'tb_notification_users', 'notification_user_id', 'Are you sure you want to delete this notification?')">Delete</a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <?php } ?> 
                        </div>
                        <!-- END: Comments -->
                    </div>
                    
                </div>
            </div>
        </div>
    </div>
</section>
<script src="<?php echo base_url('assets/custom_scripts/frontend/notification.js'); ?>" type="text/javascript"></script>