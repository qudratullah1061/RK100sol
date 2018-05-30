<?php // echo '<pre>'; print_r($blog_data);exit();                                        ?>
<!-- start page title section -->
<section class="wow fadeIn blog-banner" >
    <img src="<?php echo base_url('assets/frontend/img/k-Blog-Cover.png') ?>" alt="Blog Cover Image">
</section>
<!-- end page title section -->
<!-- start post content section -->
<!-- start page title section -->
<section class="wow fadeIn  padding-35px-tb page-title-small">
    <div class="container">
        <div class="row equalize xs-equalize-auto">
            <div class="col-lg-8 col-md-6 col-sm-6 col-xs-12 display-table">
                <div class="display-table-cell vertical-align-middle text-left xs-text-center">
                    <!-- start page title -->
                    <h1 class="alt-font text-extra-dark-gray font-weight-500 no-margin-bottom text-uppercase"><?php echo $blog->blog_title; ?></h1>
                    <!-- end page title -->
                </div>
            </div>
            <div class="col-lg-4 col-md-6 col-sm-6 col-xs-12 display-table text-right xs-text-left xs-margin-10px-top">
                <div class="display-table-cell vertical-align-middle breadcrumb text-small alt-font">
                    <!-- breadcrumb -->
                    <ul class="xs-text-center text-uppercase">
                        <li><a href="#" class="text-dark-gray"><?php echo date('d F Y', strtotime($blog->blog_date)); ?></a></li>
                        <li><span class="text-dark-gray">by <a href="#"><?php echo $blog->blog_author; ?></a></span></li>
                    </ul>
                    <!-- end breadcrumb -->
                </div>
            </div>
        </div>
    </div>
</section>
<!-- end page title section -->
<!-- start post content section --> 
<section>
    <div class="container">
        <div class="row">
            <main class="col-md-9 col-sm-12 col-xs-12 right-sidebar sm-margin-60px-bottom xs-margin-40px-bottom no-padding-left sm-no-padding-right">
                <?php
                if ($blog_descriptions) {
                    foreach ($blog_descriptions as $blog_desc) {
                        ?>
                        <div class="col-md-12 col-sm-12 col-xs-12 blog-details-text last-paragraph-no-margin">
                            <?php if ($blog_desc['blog_description_image'] != "") { ?>
                                <img src="<?php echo base_url($blog_desc['blog_description_image_path'] . 'large_' . $blog_desc['blog_description_image']) ?>" alt="Blog Description Image" class="width-100 margin-15px-bottom">
                            <?php } ?>
                            <!--                    <div class="col-sm-12 col-xs-12 no-padding text-right sm-text-center margin-25px-bottom">
                            
                                                    <div class="social-icon-style-6 text-right">
                            
                                                        <ul class="extra-small-icon">
                                                            <li><a class="likes-count" href="#" target="_blank"><i class="fa fa-heart text-deep-pink"></i><span class="text-small">300</span></a></li>
                                                            <li class="margin-10"><span class="text-dark-gray text-medium">Share Article &nbsp;&nbsp; </span></li>
                                                            <li><a class="facebook" href="https://facebook.com" target="_blank"><i class="fa fa-facebook"></i></a></li>
                                                            <li><a class="twitter" href="https://twitter.com" target="_blank"><i class="fa fa-twitter"></i></a></li>
                                                            <li><a class="pinterest" href="https://dribbble.com" target="_blank"><i class="fa fa-pinterest-p"></i></a></li>
                                                            <li><a class="pinterest" href="https://dribbble.com" target="_blank"><i class="fa fa-linkedin"></i></a></li>
                                                            <li><a class="google" href="https://google.com" target="_blank"><i class="fa fa-google-plus"></i></a></li>
                                                        </ul>
                                                    </div>
                                                </div>-->

                            <p><?php echo $blog_desc['blog_description']; ?></p>
                            <!--                    <blockquote class="border-color-deep-pink">
                                                    <p>Reading is not only informed by what’s going on with us at that moment, but also governed by how our eyes and brains work to process information. What you see and what you’re experiencing as you read these words is quite different.</p>
                                                    <footer>Jason Maria</footer>
                                                </blockquote>-->
                                                <!--<img src="https://placehold.it/900x600" alt="" class="width-100 margin-45px-bottom">-->
                            <!-- dropcaps -->
                            <!--<p><span class="first-letter first-letter-block bg-extra-dark-gray text-white">M</span>Lorem Ipsum is simply dummy text of the printing and typesetting industry. It has survived not only five centuries. Simply dummy text of the printing and typesetting industry. It has survived not only five centuries. There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which don't look even slightly believable. Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.</p>-->
                            <!-- end dropcaps -->
                            <?php if ($blog_desc['blog_feature_image'] != "") { ?>
                                <figure class="wp-caption alignleft"><img alt="Blog Feature Image" src="<?php echo base_url($blog_desc['blog_feature_image_path'] . 'medium_' . $blog_desc['blog_feature_image']) ?>"></figure>
                            <?php } ?>
                            <p><?php echo $blog_desc['blog_feature_description']; ?></p>
                        </div>
                        <?php
                    }
                }
                ?>
                <!--                <div class="col-md-12 col-sm-12 col-xs-12 margin-seven-bottom margin-eight-top">
                                    <div class="divider-full bg-medium-light-gray"></div>
                                </div>-->
                <!--                <div class="col-md-6 col-sm-12 col-xs-12 sm-text-center">
                                    <div class="tag-cloud margin-20px-bottom">
                                        <a href="blog-grid.html">Advertisement</a>
                                        <a href="blog-grid.html">Artistry</a>
                                        <a href="blog-grid.html">Blog</a>
                                        <a href="blog-grid.html">Conceptual</a>
                                    </div>
                                </div>
                                <div class="col-md-6 col-sm-12 col-xs-12 text-right sm-text-center">
                                    <div class="social-icon-style-6">
                                        <ul class="extra-small-icon">
                                            <li><a class="likes-count" href="#" target="_blank"><i class="fa fa-heart text-deep-pink"></i><span class="text-small">300</span></a></li>
                                            <li><a class="facebook" href="https://facebook.com" target="_blank"><i class="fa fa-facebook"></i></a></li>
                                            <li><a class="twitter" href="https://twitter.com" target="_blank"><i class="fa fa-twitter"></i></a></li>
                                            <li><a class="google" href="https://google.com" target="_blank"><i class="fa fa-google-plus"></i></a></li>
                                            <li><a class="pinterest" href="https://dribbble.com" target="_blank"><i class="fa fa-pinterest-p"></i></a></li>
                                        </ul>
                                    </div>
                                </div>-->
                <div class="col-md-12 col-sm-12 col-xs-12 margin-30px-top">
                    <div class="display-table width-100 border-all border-color-extra-light-gray padding-50px-all sm-padding-30px-all xs-padding-20px-all">
                        <div class="display-table-cell width-130px text-center vertical-align-top xs-margin-15px-bottom xs-width-100 xs-display-block xs-text-center">
                            <img src="<?php echo base_url($blog->author_image_path . 'medium_' . $blog->author_image); ?>" class="img-circle width-100px" alt="Author Image" />
                        </div>
                        <div class="padding-40px-left display-table-cell vertical-align-top last-paragraph-no-margin xs-no-padding-left xs-display-block xs-text-center">
                            <a href="#" class="text-extra-dark-gray text-uppercase alt-font font-weight-500 margin-10px-bottom display-inline-block text-small"><?php echo $blog->blog_author; ?></a>
                            <?php echo $blog->blog_author_about; ?>
                            <!--<a class="btn btn-very-small btn-black margin-20px-top">All author posts</a>-->
                        </div>
                    </div>
                </div>
                <div class="col-md-12 col-sm-12 col-xs-12 margin-eight-top">
                    <div class="divider-full bg-medium-light-gray"></div>
                </div>
                <div class="col-md-12 col-sm-12 col-xs-12 blog-details-comments">
                    <div class="width-100 margin-lr-auto text-center margin-80px-tb sm-margin-50px-tb xs-margin-30px-tb">
                        <div class="position-relative overflow-hidden width-100">
                            <span class="text-small text-outside-line-full alt-font font-weight-500 text-uppercase text-extra-dark-gray">Comments</span>
                        </div>
                    </div>
                    <ul class="blog-comment">
                        <?php // echo '<pre>';print_r($blog_comments);exit(); ?>
                        <?php
                        foreach ($blog_comments as $comment) {
                            if ($comment->parent_id == 0) {
                                ?>
                                <li>
                                    <div class="display-table width-100">
                                        <div class="display-table-cell width-100px xs-width-50px text-center vertical-align-top xs-display-block xs-margin-10px-bottom">
                                            <img src="https://placehold.it/149x149" class="img-circle width-85 xs-width-100" alt="Blog Comment Image" />
                                        </div>
                                        <div class="padding-40px-left display-table-cell vertical-align-top last-paragraph-no-margin xs-no-padding-left xs-display-block">
                                            <a href="javascript:void(0)" class="text-extra-dark-gray text-uppercase alt-font font-weight-500 text-small"><?php
                                                if ($comment->user_type == '3') {
                                                    $name = $comment->admin_username;
                                                } elseif ($comment->user_type == '1') {
                                                    $name = $comment->username;
                                                } elseif ($comment->user_type == '2') {
                                                    $name = $comment->anonymous_user_name;
                                                } echo $name;
                                                ?></a>
                                            <a href="#comments" data-comment-id="<?php echo $comment->blog_comment_id; ?>" id="child_comments" class="inner-link btn-reply text-uppercase alt-font text-extra-dark-gray">Reply</a>
                                            <?php if ($admin_id) { ?>
                                                <a onclick="CommonFunctions.Delete_Childs(<?php echo $comment->blog_comment_id; ?>, 'tb_blog_comments', 'blog_comment_id', 'This comment will be permanently deleted without further warning. Do you really want to delete this comment?');" class="inner-link btn-reply text-uppercase alt-font text-extra-dark-gray">Delete</a>
                                                <a href="javascript:void(0)" class="inner-link btn-reply text-uppercase alt-font text-extra-dark-gray edit_parent_comment">Edit</a>
                                            <?php } elseif ($member_id == $comment->user_id) { ?>
                                                <a onclick="CommonFunctions.Delete_Childs(<?php echo $comment->blog_comment_id; ?>, 'tb_blog_comments', 'blog_comment_id', 'This comment will be permanently deleted without further warning. Do you really want to delete this comment?');" class="inner-link btn-reply text-uppercase alt-font text-extra-dark-gray">Delete</a>
                                                <a href="javascript:void(0)" class="inner-link btn-reply text-uppercase alt-font text-extra-dark-gray edit_parent_comment">Edit</a>
                                            <?php } elseif ($anonymous_user_id == $comment->user_id) { ?>
                                                <a onclick="CommonFunctions.Delete_Childs(<?php echo $comment->blog_comment_id; ?>, 'tb_blog_comments', 'blog_comment_id', 'This comment will be permanently deleted without further warning. Do you really want to delete this comment?');" class="inner-link btn-reply text-uppercase alt-font text-extra-dark-gray">Delete</a>
                                                <a href="javascript:void(0)" class="inner-link btn-reply text-uppercase alt-font text-extra-dark-gray edit_parent_comment">Edit</a>
                                            <?php } ?>
                                            <div class="text-small text-medium-gray text-uppercase margin-10px-bottom"><?php echo date('d M Y, H:i', strtotime($comment->tbc_created_on)); ?></div>
                                            <div class="parent_comment_update" style="display: none;">
                                                <input type="hidden" class="blog_comment_id" name="blog_comment_id" value="<?php echo $comment->blog_comment_id; ?>"/>
                                                <textarea name="comment" class="comment"><?php echo $comment->comment ?></textarea>
                                                <button class="btn btn-info update_comment">Update Comment</button>
                                                <a href="javascript:void(0)" class="btn btn-info hide_update_comment">Close</a>
                                            </div>
                                            <div class="parent_comment">
                                                <p><?php echo $comment->comment; ?></p>
                                            </div>
                                        </div>
                                    </div>
                                    <?php
                                }
                                $fetch_sub_comments = get_sub_comments($comment->blog_id, $comment->blog_comment_id);
                                foreach ($fetch_sub_comments as $sub_comment) {
                                    ?>
                                    <ul class="child-comment">
                                        <li>
                                            <div class="display-table width-100">
                                                <div class="display-table-cell width-100px xs-width-50px text-center vertical-align-top xs-display-block xs-margin-10px-bottom">
                                                    <img src="https://placehold.it/149x149" class="img-circle width-85 xs-width-100" alt="Blog Sub Comment Image" />
                                                </div>
                                                <div class="padding-40px-left display-table-cell vertical-align-top last-paragraph-no-margin xs-no-padding-left xs-display-block">
                                                    <a href="javascript:void(0)" class="text-extra-dark-gray text-uppercase alt-font font-weight-500 text-small"><?php
                                                        if ($sub_comment->user_type == '3') {
                                                            $name = $sub_comment->admin_username;
                                                        } elseif ($sub_comment->user_type == '1') {
                                                            $name = $sub_comment->username;
                                                        } elseif ($sub_comment->user_type == '2') {
                                                            $name = $sub_comment->anonymous_user_name;
                                                        } echo $name;
                                                        ?></a>
                                                    <?php if ($admin_id) { ?>
                                                        <a onclick="CommonFunctions.Delete_Childs(<?php echo $sub_comment->blog_comment_id; ?>, 'tb_blog_comments', 'blog_comment_id', 'This comment will be permanently deleted without further warning. Do you really want to delete this comment?');" class="inner-link btn-reply text-uppercase alt-font text-extra-dark-gray">Delete</a>
                                                        <a href="javascript:void(0)" class="inner-link btn-reply text-uppercase alt-font text-extra-dark-gray edit_parent_comment">Edit</a>
                                                    <?php } elseif ($member_id == $sub_comment->user_id) { ?>
                                                        <a onclick="CommonFunctions.Delete_Childs(<?php echo $sub_comment->blog_comment_id; ?>, 'tb_blog_comments', 'blog_comment_id', 'This comment will be permanently deleted without further warning. Do you really want to delete this comment?');" class="inner-link btn-reply text-uppercase alt-font text-extra-dark-gray">Delete</a>
                                                        <a href="javascript:void(0)" class="inner-link btn-reply text-uppercase alt-font text-extra-dark-gray edit_parent_comment">Edit</a>
                                                    <?php } elseif ($anonymous_user_id == $sub_comment->user_id) { ?>
                                                        <a onclick="CommonFunctions.Delete_Childs(<?php echo $sub_comment->blog_comment_id; ?>, 'tb_blog_comments', 'blog_comment_id', 'This comment will be permanently deleted without further warning. Do you really want to delete this comment?');" class="inner-link btn-reply text-uppercase alt-font text-extra-dark-gray">Delete</a>
                                                        <a href="javascript:void(0)" class="inner-link btn-reply text-uppercase alt-font text-extra-dark-gray edit_parent_comment">Edit</a>
                                                    <?php } ?>
                                                    <div class="text-small text-medium-gray text-uppercase margin-10px-bottom"><?php echo date('d M Y, H:i', strtotime($sub_comment->tbc_created_on)); ?></div>
                                                    <div class="parent_comment_update" style="display: none;">
                                                        <input type="hidden" class="blog_comment_id" name="blog_comment_id" value="<?php echo $sub_comment->blog_comment_id; ?>"/>
                                                        <textarea name="comment" class="comment"><?php echo $sub_comment->comment ?></textarea>
                                                        <button class="btn btn-info update_comment">Update Comment</button>
                                                        <a href="javascript:void(0)" class="btn btn-info hide_update_comment">Close</a>
                                                    </div>
                                                    <div class="parent_comment">
                                                        <p><?php echo $sub_comment->comment; ?></p>
                                                    </div>
                                                </div>
                                            </div>
                                        </li>
                                    </ul>
                                <?php } ?>
                            </li>
                        <?php } ?>
                    </ul>
                </div>
                <div class="col-md-12 col-sm-12 col-xs-12 margin-eight-top" id="comments">
                    <div class="divider-full bg-medium-light-gray"></div>
                </div>
                <div class="col-md-12 col-sm-12 col-xs-12 margin-lr-auto text-center margin-80px-tb sm-margin-50px-tb xs-margin-30px-tb">
                    <div class="position-relative overflow-hidden width-100">
                        <span class="text-small text-outside-line-full alt-font font-weight-500 text-uppercase text-extra-dark-gray">Write A Comments</span>
                    </div>
                </div>
                <?php // echo $anonymous_user_id.'/'.$member_id;     ?>
                <form action="<?php echo base_url('blogs/blog_comment/' . $blog->blog_id); ?>" method="post">
                    <input type="hidden" name="parent_id" id="comment_parent_id" value=""/>
                    <?php if (!$member_id && !$anonymous_user_id && !$admin_id) { ?>
                        <div class="col-md-4 col-sm-12 col-xs-12">
                            <input type="text" name="anonymous_user_name" placeholder="Name *" class="medium-input">
                        </div>
                        <div class="col-md-4 col-sm-12 col-xs-12">
                            <input type="email" name="anonymous_user_email" placeholder="E-mail *" class="medium-input">
                        </div>
                    <?php } ?>
                    <div class="col-md-12 col-sm-12 col-xs-12">
                        <textarea placeholder="Enter your comment here.." name="comment" rows="8" class="medium-textarea"></textarea>
                    </div>
                    <div class="col-md-12 col-sm-12 col-xs-12 text-center">
                        <button class="btn btn-dark-gray btn-small margin-15px-top" type="submit">Send message</button>
                    </div>
                </form>
            </main>
            <aside class="col-md-3 col-sm-12 col-xs-12 pull-right">
                <div class="display-inline-block width-100 margin-45px-bottom xs-margin-25px-bottom">
                    <form action="<?php echo base_url('blogs/search_keyword'); ?>" method="post">
                        <div class="position-relative">
                            <select name="search_by_category">
                                <option value="">Please Select a Category!</option>
                                <?php foreach ($categories as $category) { ?>
                                    <option value="<?php echo $category['category_id']; ?>"><?php echo $category['category_name']; ?></option>
                                <?php } ?>
                            </select>
                            <input type="text" name="keyword" class="bg-transparent text-small no-margin border-color-extra-light-gray medium-input pull-left" placeholder="Enter your keywords...">
                            <button type="submit" class="bg-transparent  btn position-absolute right-0"><i class="fa fa-search no-margin-left"></i></button>
                        </div>  
                    </form>
                </div>
                <div class="margin-45px-bottom xs-margin-25px-bottom">
                    <div class="text-extra-dark-gray margin-20px-bottom alt-font text-uppercase text-small font-weight-500 aside-title"><span>About Me</span></div>
                    <a href="#"><img src="<?php echo base_url($blog->author_image_path . 'large_' . $blog->author_image); ?>" alt="Author Image" class="margin-25px-bottom"/></a>
                    <p><?php echo $blog->blog_author_about; ?></p>
                    <a class="btn btn-very-small btn-dark-gray text-uppercase" href="javascript:void(0)">About <?php echo $blog->blog_author; ?></a>
                </div>
                <!--                <div class="margin-50px-bottom">
                                    <div class="text-extra-dark-gray margin-20px-bottom alt-font text-uppercase font-weight-500 text-small aside-title"><span>Follow Us</span></div>
                                    <div class="social-icon-style-1 text-center">
                                        <ul class="extra-small-icon">
                                            <li><a class="facebook" href="https://facebook.com" target="_blank"><i class="fa fa-facebook"></i></a></li>
                                            <li><a class="twitter" href="https://twitter.com" target="_blank"><i class="fa fa-twitter"></i></a></li>
                                            <li><a class="google" href="https://google.com" target="_blank"><i class="fa fa-google"></i></a></li>
                                            <li><a class="dribbble" href="https://dribbble.com" target="_blank"><i class="fa fa-dribbble"></i></a></li>
                                            <li><a class="linkedin" href="https://linkedin.com" target="_blank"><i class="fa fa-linkedin "></i></a></li>
                                        </ul>
                                    </div>
                                </div>-->
                <div class="margin-45px-bottom xs-margin-25px-bottom">
                    <div class="text-extra-dark-gray margin-20px-bottom alt-font text-uppercase font-weight-500 text-small aside-title"><span>Categories</span></div>
                    <ul class="list-style-6 margin-50px-bottom text-small">
                        <?php foreach ($selected_categories as $category) { ?>
                            <li><a href="<?php echo base_url('blogs/blogs_as_per_categories/' . $category['category_id']); ?>"><?php echo $category['category_name']; ?></a><span><?php echo $category['count_blogs']; ?></span></li>
                        <?php } ?>
                    </ul>   
                </div>
                <div class="margin-45px-bottom xs-margin-25px-bottom">
                    <div class="text-extra-dark-gray margin-25px-bottom alt-font text-uppercase font-weight-500 text-small aside-title"><span>Tags</span></div>
                    <div class="tag-cloud">
                        <?php foreach ($selected_tags as $tag) { ?>
                            <a href="<?php echo base_url('blogs/blogs_as_per_tags/' . $tag['tag_id']); ?>"><?php echo $tag['tag_name']; ?></a>
                        <?php } ?>
                    </div>
                </div>
                <!--                <div class="margin-45px-bottom xs-margin-25px-bottom">
                                    <div class="text-extra-dark-gray margin-25px-bottom alt-font text-uppercase font-weight-500 text-small aside-title"><span>Newsletter</span></div>
                                    <div class="display-inline-block width-100">
                                        <form>
                                            <div class="position-relative">
                                                <input type="email" class="bg-transparent text-small no-margin border-color-extra-light-gray medium-input pull-left" placeholder="Enter your email...">
                                                <button type="submit" class="bg-transparent text-large btn position-absolute right-0 top-3"><i class="fa fa-envelope-o no-margin-left"></i></button>
                                            </div>   
                                        </form>
                                    </div>
                                </div>-->
                <!--                <div class="margin-45px-bottom xs-margin-25px-bottom">
                                    <div class="text-extra-dark-gray margin-25px-bottom alt-font text-uppercase font-weight-500 text-small aside-title"><span>Instagram</span></div>
                                    <div class="instagram-follow-api">
                                        <ul id="instaFeed-aside"></ul>
                                    </div>
                                </div>-->
                <!--                <div class="margin-45px-bottom xs-margin-25px-bottom">
                                    <a href="#"><img src="images/menu-banner-01.png" alt="" class="width-100"/></a>
                                </div>-->
            </aside>
        </div>
    </div>
</section>
<script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
<script>
  (adsbygoogle = window.adsbygoogle || []).push({
    google_ad_client: "ca-pub-7510668835582498",
    enable_page_level_ads: true
  });
</script>
<script>
    $(document).on('click', '#child_comments', function () {
        var idAttr = $(this).attr('data-comment-id');
        $("#comment_parent_id").val(idAttr);
    });
    $(document).on('click', '.edit_parent_comment', function () {
        $(".parent_comment_update").hide();
        $(this).closest('div').find(".parent_comment").hide();
        $(this).next().next().show();
    });
    $(document).on('click', '.hide_update_comment', function () {
        $(".parent_comment").show();
        $(".parent_comment_update").hide();
    });
    $('.update_comment').on('click', function () {
        var blog_comment_id = $(this).closest('div').find(".blog_comment_id").val();
        var comment = $(this).closest('div').find(".comment").val();
        var currentObj = $(this);
        $.ajax({
            url: base_url + "blogs/update_comment/",
            dataType: 'json',
            method: 'post',
            cache: false,
            data: {blog_comment_id: blog_comment_id, comment: comment},
            beforeSend: function () {
                App.blockUI({target: 'body', animate: true});
            },
            complete: function () {
                App.unblockUI('body');
            },
            success: function (data) {
                if (!data.error) {
                    //alert(comment);
                    $(".parent_comment_update").hide();
                    currentObj.parent().next(".parent_comment").html("<p>" + comment + "</p>");
                    $(".parent_comment").show();
                } else {
                    // exception message here.
                    swal("Error!", data.description, "error");
                }
            },
            error: function (xhr, desc, err) {
                toastr["error"](xhr.statusText, "Error.");
            }
        });
    });
</script>