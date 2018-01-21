<!-- start page title section -->
        <section class="wow fadeIn blog-banner" >
           <img src="<?php echo base_url('assets/frontend/img/k-Blog-Cover.png') ?>" >
        </section>
        <!-- end page title section -->
        <!-- start post content section -->
        <section class="wow fadeIn">
            <div class="container"> 
                <div class="row equalize xs-equalize-auto">
                    <!-- start post item -->
                    <?php foreach ($blogs as $blog) { ?>
                    <div class="col-lg-3 col-md-6 col-sm-6 col-xs-12 margin-80px-bottom sm-margin-50px-bottom xs-margin-30px-bottom wow fadeInUp">
                        <div class="blog-post blog-post-style2">
                            <div class="blog-post-images overflow-hidden margin-25px-bottom xs-margin-15px-bottom">
                                <a href="<?php echo base_url('blogs/blog_detail/'.$blog->blog_id); ?>">
                                    <img src="<?php echo base_url($blog->blog_image_path.'medium_'.$blog->blog_image) ?>" alt="">
                                </a>
                            </div>
                            <div class="post-details">
                                <a href="<?php echo base_url('blogs/blog_detail/'.$blog->blog_id); ?>" class="post-title text-medium text-extra-dark-gray width-90 display-block md-width-100"><?php echo $blog->blog_title; ?></a>
                                <div class="separator-line-horrizontal-full bg-medium-light-gray margin-20px-tb xs-margin-15px-tb"></div>
                                <div class="author">
                                    <img src="<?php echo base_url($blog->author_image_path.'small_'.$blog->author_image); ?>" alt="" class="border-radius-100">
                                    <span class="text-medium-gray text-uppercase text-extra-small padding-15px-left display-inline-block">by <a href="home-blog-grid.html" class="text-medium-gray"><?php echo $blog->blog_author; ?></a>&nbsp;&nbsp;|&nbsp;&nbsp;<?php echo date('d F Y', strtotime($blog->blog_date)); ?></span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php } ?>
                    <!-- end post item -->
                </div>
                <!-- start slider pagination -->
<!--                <div class=" text-center margin-100px-top sm-margin-50px-top wow fadeInUp">
                    <div class="pagination text-small text-uppercase text-extra-dark-gray">
                        <ul>
                            <li><a href="#"><i class="fa fa-long-arrow-left margin-5px-right xs-display-none"></i> Prev</a></li>
                            <li class="active"><a href="#">1</a></li>
                            <li><a href="#">2</a></li>
                            <li><a href="#">3</a></li>
                            <li><a href="#">Next <i class="fa fa-long-arrow-right margin-5px-left xs-display-none"></i></a></li>
                        </ul>
                    </div>
                </div>-->
                <!-- end slider pagination -->
            </div>
        </section>
        <!-- end post content section -->