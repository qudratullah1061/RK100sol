<?php
$blogs = GetBlogContent($cat_id);
if (isset($blogs)) {
    foreach ($blogs as $blog) {
        ?>
        <div class=" swiper-slide wow zoomIn last-paragraph-no-margin">
            <figure>
                <div class="portfolio-img bg-purple position-relative text-center overflow-hidden">
                    <img src="<?php echo base_url($blog->blog_image_path . 'medium_' . $blog->blog_image); ?>" alt=""/>
                    <div class="portfolio-icon">
                        <a href="<?php echo base_url('blogs/blog_detail/' . $blog->blog_id); ?>"><i class="fa fa-link text-extra-dark-gray" aria-hidden="true"></i></a>
                    </div>
                </div>
                <figcaption class="">
                    <div class="portfolio-hover-main text-left">
                        <div class="portfolio-hover-box vertical-align-middle">
                            <div class="portfolio-hover-content position-relative">
                                <a href="<?php echo base_url('blogs/blog_detail/' . $blog->blog_id); ?>">
                                    <p class="text-white text-samll"><?php echo $blog->blog_title; //echo limit_text(GetBlogDescription($blog->blog_id), 20); ?></p>
                                </a>
                            </div>
                        </div>
                    </div>
                </figcaption>
            </figure>
        </div>
        <?php
    }
}
?>