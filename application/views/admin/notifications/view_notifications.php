<div class="row">
    <div class="col-lg-12 col-xs-12 col-sm-12">
        <div class="portlet light ">
            <div class="portlet-title tabbable-line">
                <div class="note note-info">
                    <a class="purple" data-title="Add Type" href="javascript:Notifications.modal_add_notification()"><i class="fa fa-plus-circle"></i> Add Notification</a>
                </div>
                <div class="caption">
                    <i class="icon-bubbles font-dark hide"></i>
                    <span class="caption-subject font-dark bold uppercase">Admin Notifications Sent To Members</span>
                </div>
                <ul class="nav nav-tabs">
                    <li class="active">
                        <a href="#portlet_comments_1" data-toggle="tab"> Guests </a>
                    </li>
                    <li>
                        <a href="#portlet_comments_2" data-toggle="tab"> Companions </a>
                    </li>
                </ul>
            </div>
            <div class="portlet-body">
                <div class="tab-content">
                    <div class="tab-pane active" id="portlet_comments_1">
                        <!-- BEGIN: Comments -->
                        <div class="mt-comments">
                            <?php foreach($notifications as $notification){ 
                                if($notification['notification_for'] == 1  || $notification['notification_for'] == 3){
                            ?>
                            <div class="mt-comment">
                                <div class="mt-comment-img">
                                    <img src="<?php echo base_url($notification['image_path']."small_".$notification['image']); ?>" /> 
                                </div>
                                <div class="mt-comment-body">
                                    <div class="mt-comment-info">
                                        <span class="mt-comment-author"><?php echo $notification['username']; ?></span>
                                        <span class="mt-comment-date"><?php echo date('j F, g:i a',strtotime($notification['created_on'])); ?></span>
                                    </div>
                                    <div class="mt-comment-text"> <?php echo $notification['notification_message']; ?> </div>
                                    <div class="mt-comment-details">
                                        <span class="mt-comment-status mt-comment-status-approved">Delivered</span>
                                        <ul class="mt-comment-actions">
                                            <li>
                                                <a href="javascript:Notifications.modal_add_notification('<?php echo $notification['notification_id']; ?>')">Quick Edit</a>
                                            </li>
                                            <li>
                                                <a href="javascript:Notifications.modal_add_notification('<?php echo $notification['notification_id']; ?>',1)">View</a>
                                            </li>
                                            <li>
                                                <a href="javascript:CommonFunctions.Delete('<?php echo $notification['notification_id']; ?>', 'tb_notifications', 'notification_id', 'Are you sure you want to delete this notification?')">Delete</a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <?php } } ?> 
                        </div>
                        <!-- END: Comments -->
                    </div>
                    <div class="tab-pane" id="portlet_comments_2">
                        <!-- BEGIN: Comments -->
                        <div class="mt-comments">
                            <?php foreach($notifications as $notification){ 
                                if($notification['notification_for'] == 2 || $notification['notification_for'] == 3){
                            ?>
                            <div class="mt-comment">
                                <div class="mt-comment-img">
                                    <img src="<?php echo base_url($notification['image_path']."small_".$notification['image']); ?>" /> </div>
                                <div class="mt-comment-body">
                                    <div class="mt-comment-info">
                                        <span class="mt-comment-author"><?php echo $notification['username']; ?></span>
                                        <span class="mt-comment-date"><?php echo date('j F, g:i a',strtotime($notification['created_on'])); ?></span>
                                    </div>
                                    <div class="mt-comment-text"> <?php echo $notification['notification_message']; ?> </div>
                                    <div class="mt-comment-details">
                                        <span class="mt-comment-status mt-comment-status-approved">Delivered</span>
                                        <ul class="mt-comment-actions">
                                            <li>
                                                <a href="javascript:Notifications.modal_add_notification('<?php echo $notification['notification_id']; ?>')">Quick Edit</a>
                                            </li>
                                            <li>
                                                <a href="javascript:Notifications.modal_add_notification('<?php echo $notification['notification_id']; ?>',1)">View</a>
                                            </li>
                                            <li>
                                                <a href="javascript:CommonFunctions.Delete('<?php echo $notification['notification_id']; ?>', 'tb_notifications', 'notification_id', 'Are you sure you want to delete this notification?')">Delete</a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <?php } } ?> 
                        </div>
                        <!-- END: Comments -->
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="<?php echo base_url('assets/custom_scripts/admin/notification.js'); ?>" type="text/javascript"></script>