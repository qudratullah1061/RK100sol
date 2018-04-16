<script src="<?php echo base_url(); ?>assets/global/plugins/jquery-slimscroll/jquery.slimscroll.min.js" type="text/javascript"></script>
<section class="profile_edit">
    <div class="container">
        <div class="row">
            <div class="col-lg-5 col-xs-12 col-sm-12">
                <div class="portlet light ">
                    <div class="portlet-title tabbable-line">
                        <div class="caption">
                            <div class="inputs">
                                <div class="portlet-input input-inline input-small ">
                                    <div class="input-icon right">
                                        <!--<i class="icon-magnifier"></i>-->
                                        <input type="text" class="form-control form-control-solid input-circle" placeholder="search..."> 
                                    </div>
                                </div>
                            </div>
                        </div>
                        <ul class="nav nav-tabs">
                            <li class="active">
                                <a href="#portlet_comments_1" data-toggle="tab"> Members </a>
                            </li>
                        </ul>
                    </div>
                    <div class="portlet-body">
                        <div class="tab-content">
                            <div class="tab-pane active" id="portlet_comments_1">
                                <!-- BEGIN: Comments -->
                                <div class="mt-comments scroller-div">
                                    <!--// repeat this node-->
                                    <div class="mt-comment mt-comment-0-<?php echo $this->session->userdata('member_info')['member_id']; ?>" onclick="Chat.getChatMessages('0-<?php echo $this->session->userdata('member_info')['member_id']; ?>')">
                                        <div class="mt-comment-img">
                                            <img src="<?php echo base_url('uploads/member_images/profile/profile.png'); ?>" /> 
                                        </div>
                                        <div class="mt-comment-body">
                                            <div class="mt-comment-info">
                                                <span class="mt-comment-author">Admin</span>
                                                <span class="mt-comment-date"><span class="badge badge-danger member-<?php echo $this->session->userdata('member_info')['member_id']; ?>"></span></span>
                                            </div>
                                            <div class="mt-comment-text">&nbsp;Canada</div>
                                        </div>
                                    </div>
                                    <!--// end of repeat this node-->
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
                        <div class="scroller-div">
                            <div class="general-item-list">
                                <!--repeat this block to repeat messages-->

                                <!--end repeat this block to repeat messages-->
                            </div>
                        </div>
                        <div class="chat-form">
                            <div class="input-cont">
                                <input class="form-control" onclick="Chat.sendChatMessage()" type="text" placeholder="Type a message here..."> </div>
                            <div class="btn-cont">
                                <span class="arrow"> </span>
                                <a href="" class="btn blue icn-only">
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
                                    $(document).ready(function () {
                                        Chat.init();
                                        $(".scroller-div").slimScroll({
                                            height: '300px',
                                            railVisible: true,
                                            allowPageScroll: true, // allow page scroll when the element scroll is ended
                                            wrapperClass: ($(this).attr("data-wrapper-class") ? $(this).attr("data-wrapper-class") : 'slimScrollDiv'),
                                        });
                                    });
</script>