<!-- BEGIN PAGE LEVEL PLUGINS -->
<link href="<?php echo base_url(); ?>assets/global/plugins/bootstrap-multiselect/css/bootstrap-multiselect.css" rel="stylesheet" type="text/css" />
<!-- END PAGE LEVEL PLUGINS -->
<!-- banner -->
<section class="wow fadeIn no-padding home-banner  xs-background-image-center" data-stellar-background-ratio="0.5" style="background-image:url('<?php echo base_url('assets/frontend/'); ?>img/home-banner.jpg');">
    <!-- <div class="opacity-extra-medium bg-black"></div> -->
    <div class="container home-panner-height xs-padding-15px-lr">
        <div class="row height-100">
            <div class="position-relative height-100">
                <div class="slider-typography">
                    <div class="slider-text-middle-main">
                        <div class="slider-text-middle">
                            <div class="col-lg-12 text-left">
                                <h4 class="text-white alt-font font-weight-700 open-sans xs-width-100">
                                    Contract a Service Member
                                </h4>
                                <p class="open-sans text-white">Community of independent service providers.</p>
                                <a href='<?php echo base_url('register'); ?>' class='btn btn-purple-white-border open-sans'> Hire Services </a>
                                <a href='<?php echo base_url('register'); ?>' class='btn btn-purple-white-border open-sans'> Offer Services </a>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<section class="wow fadeIn no-padding search-section">
    <div class="container">
        <div class="search-box">
            <form id="member-search-form" action="<?php echo base_url('home/searchmember'); ?>" method="get">
                <div class="col-1">
                    <div class='row  gutter-16'>
                        <div class="col-lg-4 col-md-4">
                            <div class="form-group">
                                <label for="search">Search By: State, Zip/Postal Code, Country</label>
                                <input type="text" name="location" id="location" class="placeholder-lightgray" placeholder="Example: Chittagong, 4000, Bangladesh" value="<?php echo isset($_GET['location']) ? $_GET['location'] : ""; ?>">
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-4">
                            <div class="form-group">
                                <label for="radius">Radius Range</label>
                                <input type="text" name="radius" id="radius" class="placeholder-lightgray" placeholder="Enter Kilometers Radius E.G: 100" value="<?php echo isset($_GET['radius']) ? $_GET['radius'] : ""; ?>">
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-4">
                            <div class="form-group">
                                <label for="radius">Available For:</label>
                                <div class="portlet-body">
                                    <select name="category_available[]" id="category_available" class="mt-multiselect btn btn-default" multiple="multiple" data-clickable-groups="true" data-collapse-groups="true" data-width="100%" data-action-onchange="true">
                                        <!--<option value="">Available For:</option>-->
                                        <?php foreach ($categories_data as $catDataRow) { ?>
                                            <optgroup label="<?php echo $catDataRow->category_name; ?>" <?php echo in_array($catDataRow->category_id, $selected_cat_ids) ? "selected='selected'" : ""; ?> class="<?php echo 'group-' . $catDataRow->category_id; ?>">
                                                <?php
                                                $sub_categories = getSubCategoriesByCategoryId($catDataRow->category_id);
                                                if ($sub_categories && count($sub_categories) > 0) {
                                                    foreach ($sub_categories as $sub_cat) {
                                                        ?>
                                                        <option <?php echo in_array($sub_cat['sub_category_id'], $selected_sub_cat_ids) ? "selected='selected'" : ""; ?> value="<?php echo $catDataRow->category_id; ?>:<?php echo $sub_cat['sub_category_id']; ?>"><?php echo $sub_cat['sub_category_name']; ?></option>
                                                        <?php
                                                    }
                                                }
                                                ?>
                                            </optgroup>
                                        <?php }
                                        ?>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-2 text-right">
                    <button id="project-contact-us-button" type="submit" class="btn btn-deep-purple font-weight-600 width-100 margin-25px-top btn-with-seperater">
                        <i class='fa fa-search'></i>
                        <span>SEARCH A MEMBER</span>
                    </button>
                </div>
            </form>
        </div>
    </div>
</section>
<section class="wow fadeIn gold-members">
    <div class="container">
        <p class="title-bar bg-purple text-white font-weight-600 text-center">
            <i class="fa fa-star"></i> Search Result
            <i class="fa fa-star"></i>
        </p>
        <div class="row">
            <div class="filter-content overflow-hidden xs-margin-15px-lr">
                <ul class="portfolio-grid work-6col gutter-large hover-option6 lightbox-portfolio">
                    <li class="grid-sizer"></li>

                    <!-- start portfolio item -->
                    <?php
                    $living_status = '';
                    if (count($members_list) > 0) {
                        foreach ($members_list as $members_list_row) {
                            ?>
                            <li class="grid-item wow fadeInUp last-paragraph-no-margin">
                                <div class="feature-box gold-box">
                                    <div class="content">
                                        <figure>
                                            <div class="portfolio-img  position-relative text-center overflow-hidden">
                                                <a href="#">
                                                    <img src="<?php echo base_url($members_list_row['image_path']) . $members_list_row['image']; ?>" alt="Profile Image" />
                                                </a>
                                            </div>
                                            <figcaption class="">
                                                <div class="portfolio-hover-main text-center">
                                                    <div class="portfolio-hover-box vertical-align-middle">
                                                        <div class="portfolio-hover-content position-relative">
                                                            <span class="line-height-normal font-weight-600 display-block lato"><?php echo $members_list_row['first_name'] . ' ' . $members_list_row['last_name']; ?> </span>
                                                            <p class=""><?php
                                                                if ($members_list_row['country'] != '') {
                                                                    $living_status .= $members_list_row['country'] . ', ';
                                                                }
                                                                if ($members_list_row['state'] != '') {
                                                                    $living_status .= $members_list_row['state'] . ', ';
                                                                }
                                                                if ($members_list_row['city'] != '') {
                                                                    $living_status .= $members_list_row['city'];
                                                                }
                                                                echo rtrim($living_status, ', ');
                                                                ?></p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </figcaption>
                                        </figure>
                                    </div>
                                </div>
                            </li>
                            <?php
                        }
                    } else {
                        ?>
                        <li class="grid-item wow fadeInUp last-paragraph-no-margin">
                            <div class="feature-box gold-box">
                                <div class="content">
                                    <figure>
                                        <p>No Record Found.</p>
                                    </figure>
                                </div>
                            </div>
                        </li>
                    <?php } ?>
                    <!-- end portfolio item -->
                </ul>
            </div>
        </div>
        <p class="title-bar bg-purple text-white font-weight-600 text-center">
            <i class="fa fa-star"></i> Search Result
            <i class="fa fa-star"></i>
        </p>
    </div>
</section>
<script src="<?php echo base_url(); ?>assets/global/plugins/bootstrap-multiselect/js/bootstrap-multiselect.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>assets/pages/scripts/components-bootstrap-multiselect.js" type="text/javascript"></script>
<script src="//maps.googleapis.com/maps/api/js?key=AIzaSyDVw_YgvMUxH6KawXzlwM9meU3HAUnbsLQ&libraries=places&language=en"></script>
<script src="<?php echo base_url(); ?>assets/geocode/jquery.geocomplete.js" type="text/javascript"></script>
<script src="<?php echo base_url('assets/custom_scripts/frontend/searchmember.js'); ?>" type="text/javascript"></script>
<script>
    $(document).ready(function () {
        SearchMember.validation_to_search();
    });
    $(function () {
        $("#location").geocomplete();
    });
</script>