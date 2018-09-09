<!-- BEGIN PAGE BAR -->
<div class="page-bar">
    <ul class="page-breadcrumb">
        <li>
            <a href="<?php echo base_url('admin/admin_dashboard'); ?>">Home</a>
            <i class="fa fa-circle"></i>
        </li>
        <li>
            <span>Chat List</span>
        </li>
    </ul>
</div>
<!-- END PAGE BAR -->
<!-- BEGIN PAGE TITLE-->
<h3 class="page-title">Members Listing</h3>
<!-- END PAGE TITLE-->
<!-- BEGIN Datatable-->
<div class="row">
    <div class="col-lg-4 col-xs-12 col-sm-12">
        <div class="portlet light ">
            <div class="portlet-title tabbable-line">
                <div class="caption">
                    <div class="inputs">
                        <div class="portlet-input input-inline input-small ">
                            <div class="input-icon right">
                                <!--<i class="icon-magnifier"></i>-->
                                <input type="text" class="form-control form-control-solid input-circle"
                                       placeholder="search...">
                            </div>
                        </div>
                    </div>
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
                <div class="scroller tab-content" data-rail-visible1="0" data-handle-color="#D7DCE2" style="height: 450px;">
                    <div class="tab-pane active" id="portlet_comments_1">
                        <!-- BEGIN: Comments -->
                        <div class="mt-comments">
                            <?php
                            if (isset($guest_members) && count($guest_members) > 0) {
                                foreach ($guest_members as $guest) {
                                    ?>
                                    <!--// repeat this node-->
                                    <div class="mt-comment mt-comment-1a-<?php echo $guest['member_id']; ?>"
                                         onclick="Chat.getChatMessages('1a-<?php echo $guest['member_id']; ?>', 1)">
                                        <div class="mt-comment-img">
                                            <img src="<?php echo file_exists($this->config->item('root_path') . $guest['image_path'] . "small_" . $guest['image']) ? base_url($guest['image_path'] . "small_" . $guest['image']) : base_url('uploads/member_images/profile/profile.png'); ?>"/>
                                        </div>
                                        <div class="mt-comment-body">
                                            <div class="mt-comment-info">
                                                <span class="mt-comment-author"><?php echo $guest['first_name'] . " " . $guest['last_name']; ?></span>
                                                <span class="mt-comment-date"><span
                                                        class="badge badge-danger member-1a-<?php echo $guest['member_id']; ?>"></span></span>
                                            </div>
                                            <div class="mt-comment-text">&nbsp;<?php echo $guest['location']; ?></div>
                                        </div>
                                    </div>
                                    <!--// end of repeat this node-->
                                    <?php
                                }
                            }
                            ?>
                        </div>
                        <!-- END: Comments -->
                    </div>
                    <div class="tab-pane" id="portlet_comments_2">
                        <!-- BEGIN: Comments -->
                        <div class="mt-comments">
                            <?php
                            if (isset($companion_members) && count($companion_members) > 0) {
                                foreach ($companion_members as $companion) {
                                    ?>
                                    <!--// repeat this node-->
                                    <div class="mt-comment mt-comment-1a-<?php echo $companion['member_id']; ?>" onclick="Chat.getChatMessages('1a-<?php echo $companion['member_id']; ?>', 1)">
                                        <div class="mt-comment-img">
                                            <img alt="no image"
                                                 src="<?php echo file_exists($this->config->item('root_path') . $companion['image_path'] . "small_" . $companion['image']) ? base_url($companion['image_path'] . "small_" . $companion['image']) : base_url('uploads/member_images/profile/profile.png'); ?>"/>
                                        </div>
                                        <div class="mt-comment-body">
                                            <div class="mt-comment-info">
                                                <span class="mt-comment-author"><?php echo $companion['first_name'] . " " . $companion['last_name']; ?></span>
                                                <span class="mt-comment-date">
                                                    <span class="badge badge-danger member-1a-<?php echo $companion['member_id']; ?>"></span>
                                                </span>
                                            </div>
                                            <div class="mt-comment-text">&nbsp;<?php echo $companion['location']; ?></div>
                                        </div>
                                    </div>
                                    <!--// end of repeat this node-->
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
    <div class="col-lg-8 col-xs-12 col-sm-12">
        <div class="portlet light ">
            <div class="portlet-title">
                <div class="caption caption-md">
                    <i class="icon-bar-chart font-dark hide"></i>
                    <span class="caption-subject font-green-steel bold uppercase">User Conversation</span>
                    <!--<span class="caption-helper">45 pending</span>-->
                </div>
                <!--                <div class="inputs">
                                    <div class="portlet-input input-inline input-small ">
                                        <div class="input-icon right">
                                            <i class="icon-magnifier"></i>
                                            <input type="text" class="form-control form-control-solid input-circle" placeholder="search..."> 
                                        </div>
                                    </div>
                                </div>-->
            </div>
            <div class="portlet-body">
                <div class="scroller scroll-custom" start-at="bottom" data-always-visible="1" data-rail-visible1="0"
                     data-handle-color="#D7DCE2" style="height: 338px;">
                    <div class="general-item-list">
                        <!--Repeat items here-->
                    </div>
                </div>
                <div class="chat-form">
                    <div class="input-cont">
                        <input class="form-control msg-box" type="text" placeholder="Type a message here...">
                    </div>
                    <div class="btn-cont">
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
<script src="https://www.gstatic.com/firebasejs/4.10.1/firebase.js"></script>
<script src="<?php echo base_url('assets/custom_scripts/admin/chat.js'); ?>" type="text/javascript"></script>
<!-- End datatable-->
<script>
                            var senderID = '<?php echo $this->session->userdata('admin_id') ?>' + 'a';
                            $(document).ready(function () {
                                Chat.init();
<?php if (isset($_GET['chat']) && $_GET['chat']) { ?>
                                    var chatID = "<?php echo $_GET['chat'] ?>";
                                    $('.mt-comment-' + chatID).trigger('click');
<?php }
?>
                            });
</script>