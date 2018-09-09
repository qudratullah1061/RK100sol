<section class="profile_edit">
    <div class="container">
        <div class="row">
            <div class="col-lg-5 col-xs-12 col-sm-12">
                <div class="portlet light ">
                    <div class="portlet-title tabbable-line">
                        <div class="caption">
                            <span class="caption-subject font-green-steel bold uppercase">Connections</span>
                        </div>
                        <ul class="nav nav-tabs">
                            <li class="active">
                                <a href="#portlet_comments_1" data-toggle="tab"> Members </a>
                            </li>
                        </ul>
                    </div>
                    <div class="portlet-body">
                        <div class="tab-content">
                            <div class="tab-pane active scroller " id="portlet_comments_1" data-always-visible="1" data-rail-visible1="0" data-handle-color="#D7DCE2" data-height="350">
                                <!-- BEGIN: Comments -->
                                <div class="mt-comments">
                                    <!--// repeat this node-->
                                    <div class="mt-comment mt-comment-1a-<?php echo $this->session->userdata('member_info')['member_id']; ?>"
                                         onclick="Chat.getChatMessages('1a-<?php echo $this->session->userdata('member_info')['member_id']; ?>', 0)">
                                        <div class="mt-comment-img">
                                            <?php
                                            if (isset($admin['image_path']) && isset($admin['image'])) {
                                                $image = base_url($admin['image_path'] . "/" . $admin['image']);
                                            } else {
                                                $image = base_url('uploads/member_images/profile/profile.png');
                                            }
                                            ?>
                                            <img src="<?php echo $image; ?>" alt="Member Profile Image"/>
                                        </div>
                                        <div class="mt-comment-body">
                                            <div class="mt-comment-info">
                                                <span class="mt-comment-author"><?php echo $admin['first_name'] . " " . $admin['last_name']; ?>
                                                    (Admin)</span>
                                                <span class="mt-comment-date"><span
                                                        class="badge badge-danger member-<?php echo $this->session->userdata('member_info')['member_id']; ?>"></span></span>
                                            </div>
                                            <div class="mt-comment-text">&nbsp;Canada</div>
                                        </div>
                                    </div>
                                    <!--// end of repeat this node-->
                                    <?php
                                    if (isset($connections)) {
                                        foreach ($connections as $connection) {
                                            ?>
                                            <div class="mt-comment mt-comment-<?php echo min($connection['user_id'], $connection['connection_id']); ?>-<?php echo max($connection['user_id'], $connection['connection_id']); ?>"
                                                 onclick="Chat.getChatMessages('<?php echo min($connection['user_id'], $connection['connection_id']); ?>-<?php echo max($connection['user_id'], $connection['connection_id']); ?>', 0)">
                                                <div class="mt-comment-img">
                                                    <?php
                                                    if (isset($admin['image_path']) && isset($admin['image'])) {
                                                        $image = base_url($connection['image_path'] . "/" . $connection['image']);
                                                    } else {
                                                        $image = base_url('uploads/member_images/profile/profile.png');
                                                    }
                                                    ?>
                                                    <img src="<?php echo $image; ?>"
                                                         alt="<?php echo $connection['first_name'] . " " . $connection['last_name']; ?>"/>
                                                </div>
                                                <div class="mt-comment-body">
                                                    <div class="mt-comment-info">
                                                        <span class="mt-comment-author"><?php echo $connection['first_name'] . " " . $connection['last_name']; ?></span>
                                                        <span class="mt-comment-date"><span
                                                                class="badge badge-danger member-<?php
                                                                if ($this->session->userdata('member_type') == 1) {
                                                                    echo $connection['connection_id'];
                                                                } else {
                                                                    echo $connection['user_id'];
                                                                }
                                                                ?>"></span></span>
                                                    </div>
                                                    <div class="mt-comment-text">
                                                        &nbsp;<?php echo $connection['location']; ?></div>
                                                </div>
                                            </div>
                                            <?php
                                        }
                                    }
                                    ?>
                                </div>
                                <!-- END: Comments -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>


            <!--chat detail start here.-->
            <div class="col-lg-7 col-xs-12 col-sm-12">
                <div class="portlet light ">
                    <div class="portlet-title">
                        <div class="caption caption-md">
                            <i class="icon-bar-chart font-dark hide"></i>
                            <span class="caption-subject font-green-steel bold uppercase">User Conversation</span>
                            <!--<span class="caption-helper">45 pending</span>-->
                        </div>
                    </div>
                    <div class="portlet-body">
                        <div class="scroller scroll-custom" start-at="bottom" data-always-visible="1" data-rail-visible1="0" data-handle-color="#D7DCE2" data-height="350">
                            <div class="general-item-list">
                                <!--Repeat items here-->
                            </div>
                        </div>
                        <div class="chat-form">
                            <div class="input-cont">
                                <input class="form-control msg-box" type="text" placeholder="Type a message here...">
                            </div>
                            <div class="btn-cont" style="margin-top: -61px">
                                <span class="arrow"> </span>
                                <a href="javascript:;" onclick="Chat.sendChatMessage()" class="btn blue icn-only">
                                    <i class="fa fa-check icon-white"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!--chat detail ends here.-->
        </div>
    </div>

</section>
<script src="https://www.gstatic.com/firebasejs/4.10.1/firebase.js"></script>
<script src="<?php echo base_url('assets/custom_scripts/admin/chat.js'); ?>" type="text/javascript"></script>
<script>
                                    var senderID = '<?php echo $this->session->userdata('member_id') ?>';
                                    $(document).ready(function () {
                                        Chat.init();
<?php if ($_GET && $_GET['chat']) { ?>
                                            var chatID = "<?php echo $_GET['chat'] ?>";
                                            $('.mt-comment-' + chatID).trigger('click');
<?php } ?>
                                    });
</script>