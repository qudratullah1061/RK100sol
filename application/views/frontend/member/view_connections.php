<section class="profile_edit">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="portlet box blue">
                    <div class="portlet-title">
                        <div class="caption">
                            <i class="fa fa-user"></i>Connections
                        </div>
                    </div>
                    <div class="portlet-body">
                        <div class="tab-content">
                            <div class="tab-pane active" id="portlet_comments_1">
                                <!-- BEGIN: Comments -->
                                <div class="mt-comments">
                                    <?php
                                    if ($connections) {
                                        foreach ($connections as $connection) {
                                            ?>
                                            <div class="mt-comment" id="connection<?php echo $connection['id'] ?>">
                                                <div class="mt-comment-img">
                                                    <img src="<?php echo base_url($connection['image_path'] . "/" . $connection['image']); ?>"
                                                         alt="<?php echo $connection['first_name'] . ' ' . $connection['last_name']; ?>"/>
                                                </div>
                                                <div class="mt-comment-body">
                                                    <div class="mt-comment-info">
                                                        <span class="mt-comment-author"><?php echo $connection['first_name'] . ' ' . $connection['last_name']; ?>
                                                            <br><small><?php echo $connection['gender']; ?></small>
                                                        </span>
                                                        <span class="mt-comment-date"><?php echo date('j-F-Y g:i a', strtotime($connection['created_at'])); ?></span>
                                                    </div>
                                                    <div class="mt-comment-text"> <?php echo $connection['location']; ?> </div>
                                                    <div class="mt-comment-details">
                                                        <span class="mt-comment-status mt-comment-status-pending"><?php
                                                            if ($connection['status'] == 0) {
                                                                echo 'Connection Request';
                                                            } elseif ($connection['status'] == 1) {
                                                                echo 'Connected';
                                                            } else {
                                                                echo 'Rejected';
                                                            }
                                                            ?></span>
                                                        <ul class="mt-comment-actions">
                                                            <?php
                                                            if ($connection['status'] != 1 && $connection['user_id'] != $this->session->userdata('member_id')) {
                                                                ?>
                                                                <li>
                                                                    <a href="javascript:CommonFunctions.AcceptRequest('<?php echo $connection['id']; ?>', 'tb_member_connections', 'id', 'Are you sure you want to accept this connection request?')">Accept</a>
                                                                </li>
                                                            <?php }
                                                            if ($connection['status'] == 1) {
                                                                $userId = ($this->session->userdata('member_type') == 1) ? $connection['connection_id'] : $connection['user_id'];
                                                                ?>
                                                                <li>
                                                                    <a href="<?php echo site_url('member/profile/' . base64_encode($userId)) ?>"
                                                                       target="_blank">View</a>
                                                                </li>
                                                            <?php }
                                                            if ($connection['status'] != 2) {
                                                                ?>
                                                                <li>
                                                                    <a href="javascript:CommonFunctions.RejectRequest('<?php echo $connection['id']; ?>', 'tb_member_connections', 'id', 'Are you sure you want to reject this connection request?')">Reject</a>
                                                                </li>
                                                            <?php } ?>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                            <?php
                                        }
                                    } else {
                                        echo "No connection to view.";
                                    }
                                    ?>
                                </div>
                                <!-- END: Comments -->
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<script src="<?php echo base_url('assets/custom_scripts/frontend/notification.js'); ?>" type="text/javascript"></script>