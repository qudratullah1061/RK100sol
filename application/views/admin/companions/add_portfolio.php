<form id="form-add-portfolio">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
        <h4 class="modal-title"><?php echo (isset($portfolio->portfolio_id) ? 'Edit Portfolio' : 'Add New Portfolio'); ?></h4>
    </div>
    <div class="modal-body"> 
        <div class="portlet-body form">
            <div class="form-body">
                <input type="hidden" name="portfolio_id" value="<?php echo isset($portfolio_data->portfolio_id) ? $portfolio_data->portfolio_id : ""; ?>">
                <input type="hidden" name="member_id" value="<?php echo (isset($portfolio_data->member_id) && $portfolio_data->member_id > 0) ? $portfolio_data->member_id : (isset($member_id) ? $member_id : 0); ?>">
                <div class="form-group">
                    <input type="text" placeholder="Portfolio Title" value="<?php echo isset($portfolio_data->portfolio_title) ? $portfolio_data->portfolio_title : ""; ?>" name="portfolio_title" class="form-control">
                </div>
                <div class="form-group">
                    <label>Portfolio Type</label>
                    <input type="text" value="<?php echo isset($portfolio_data->portfolio_type) ? $portfolio_data->portfolio_type : ""; ?>" name="portfolio_type" class="form-control">
                </div>
                <div class="form-group form-md-line-input form-md-floating-label">
                    <select class="form-control country dd-country-portfolio" name="country" id="dd-country" onchange="CommonFunctions.LoadStates(this.value, '', 'dd-state-portfolio');">
                        <?php echo isset($country_options) ? $country_options : ""; ?>
                    </select>
                </div>
                <div class="form-group form-md-line-input form-md-floating-label">
                    <select class="form-control state dd-state-portfolio" id="dd-state" onchange="CommonFunctions.LoadCities(this.value, '', 'dd-city-portfolio');" name="state">
                        <option value="">Select State</option>
                        <?php echo isset($state_options) ? $state_options : ""; ?>
                    </select>
                </div>
                <div class="form-group form-md-line-input form-md-floating-label">
                    <select class="form-control city dd-city-portfolio" id="dd-city" name="city">
                        <option value="">Select City</option>
                        <?php echo isset($city_options) ? $city_options : ""; ?>
                    </select>
                </div>
                <?php if (isset($portfolio_data->portfolio_id)) { ?>
                    <div class="form-group form-md-line-input form-md-floating-label">
                        <img src="<?php echo base_url($portfolio_data->portfolio_image_path . 'medium_' . $portfolio_data->portfolio_image); ?>" class="image-thumbnail">

                    </div>
                <?php } ?>
                <div class="form-group form-md-line-input form-md-floating-label">
                    <input type="file"  name="portfolio_image" class="form-control">
                    <label></label>
                </div>
                <div class="md-checkbox-inline margin-top-20">
                    <div class="md-checkbox">
                        <input type="checkbox" <?php echo (isset($portfolio_data->is_active) && $portfolio_data->is_active) ? "checked='checked'" : ""; ?> name="is_active" id="checkbox" class="md-check">
                        <label for="checkbox">
                            <span></span>
                            <span class="check"></span>
                            <span class="box"></span>
                            Activate
                        </label>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal-footer">
        <button type="button" class="btn default" data-dismiss="modal">Close</button>
        <input type="submit" name="submit" value="Save Changes" class="btn green">
    </div>
</form>