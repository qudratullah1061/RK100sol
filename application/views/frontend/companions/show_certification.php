<div class="cbp-popup-wrap cbp-popup-singlePage cbp-popup-singlePage-open cbp-popup-transitionend adjust-scroll cbp-popup-singlePage-sticky cbp-popup-ready" data-action="" style="display: block;">
    <div class="cbp-popup-content">
        <div class="portfolio-content">
            <div class="cbp-l-project-title"><?php echo isset($certification_data->title) ? $certification_data->title : ""; ?></div>
            <div class="cbp-l-project-subtitle">By <?php echo isset($certification_data->issued_by) ? $certification_data->issued_by : ""; ?></div>
            <div class="cbp-slider cbp cbp-ready cbp-mode-slider">
                <div class="cbp-wrapper-outer">
                    <ul class="cbp-slider-wrap cbp-wrapper">
                        <li class="cbp-slider-item cbp-item center-align">
                            <div class="cbp-item-wrapper">
                                <a href="javascript:void(0)" class="cbp-lightbox">
                                    <img src="<?php echo isset($certification_data->certification_image_path) ? (base_url($certification_data->certification_image_path . "" . $certification_data->certification_image)) : ""; ?>" alt="">
                                </a>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="cbp-l-project-container">
                <div class="cbp-l-project-desc">
                    <div class="cbp-l-project-desc-title">
                        <span>Certification Description</span>
                    </div>
                    <div class="cbp-l-project-desc-text">
                        <?php echo isset($certification_data->description) ? $certification_data->description : ""; ?>
                    </div>
                </div>
                <div class="cbp-l-project-details">
                    <div class="cbp-l-project-details-title">
                        <span>Certification Details</span>
                    </div>
                    <ul class="cbp-l-project-details-list">
                        <li>
                            <strong>Issued By</strong><?php echo isset($certification_data->issued_by) ? $certification_data->issued_by : ""; ?></li>
                        <li>
                            <strong>Date</strong><?php echo isset($certification_data->year_issued) ? $certification_data->year_issued : ""; ?></li>
                        <li>
                            <strong>Type</strong><?php echo isset($certification_data->type_of_certification) ? $certification_data->type_of_certification : ""; ?>
                        </li>
                    </ul>
                    <a href="#" target="_blank" class="cbp-l-project-details-visit btn red uppercase" style="visibility: hidden;"></a>
                </div>
            </div>
        </div>
    </div>
    <div class="cbp-popup-loadingBox"></div>
    <div class="cbp-popup-navigation-wrap">
        <div class="cbp-popup-navigation">
            <div class="cbp-popup-close" title="Close (Esc arrow key)" data-action="close"></div>
            <!--<div class="cbp-popup-next" title="Next (Right arrow key)" data-action="next" style="display: block;"></div>-->
            <!--<div class="cbp-popup-prev" title="Previous (Left arrow key)" data-action="prev" style="display: block;"></div>-->
            <!--<div class="cbp-popup-singlePage-counter">1 of 2</div>-->
        </div>
    </div>
</div>