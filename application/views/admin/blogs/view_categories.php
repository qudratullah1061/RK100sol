<form id="form_update_blog_categories">
    <input type="hidden" name="blog_id" value="<?php echo $blog_id; ?>">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
        <h4 class="modal-title">Selected Categories</h4>
    </div>
    <div class="modal-body">
        <div class="portlet-body form">
            <div class="form-body">
                <div class="form-group">
                    <label class="col-md-2 control-label">Select Tag</label>
                    <div class="col-md-10">
                        <select name="tag_id[]" multiple="" id="blog_tags" class="form-control">
                            <?php if(isset($tags_data)) { foreach ($tags_data as $tag) {
                                $selected = "";
                                if (in_array($tag->tag_id, array_column($selected_tags, 'tag_id'))) {
                                    $selected = 'selected="selected"';
                                } ?>
                                <option <?php echo $selected; ?> value="<?php echo $tag->tag_id; ?>"><?php echo $tag->tag_name; ?></option>
                            <?php } } ?>
                        </select>
                    </div>
                </div>
                <?php
                if (isset($categories) && count($categories) > 0) {
                    foreach ($categories as $category) {
                        ?>
                        <!--<div class="form-group form-md-line-input">-->
                        <h4 class="control-label col-md-12 margin-top-20"> <?php echo $category['category_name']; ?></h4>
                        <div class="col-md-12 margin-top-20">
                            <div class="md-checkbox-inline row">
                                <!--get sub categories and loop through-->
                                <?php
                                $sub_categories = getSubCategoriesByCategoryId($category['category_id']);
                                if ($sub_categories && count($sub_categories) > 0) {
                                    foreach ($sub_categories as $sub_cat) {
                                        $seleced = "";
                                        if (in_array($sub_cat['sub_category_id'], array_column($selected_categories, 'sub_category_id')) && in_array($category['category_id'], array_column($selected_categories, 'category_id'))) {
                                            $seleced = 'checked="checked"';
                                        }
                                        ?>
                                        <div class="col-md-6 form-group">
                                            <div class="md-checkbox">
                                                <input type="checkbox" <?php echo $seleced; ?> name='categories[]' value="<?php echo $category['category_id'] . "::" . $sub_cat['sub_category_id']; ?>" id="checkbox<?php echo $category['category_id'] . $sub_cat['sub_category_id']; ?>" class="md-check">
                                                <label for="checkbox<?php echo $category['category_id'] . $sub_cat['sub_category_id']; ?>">
                                                    <span></span>
                                                    <span class="check"></span>
                                                    <span class="box"></span> <?php echo $sub_cat['sub_category_name']; ?></label>
                                            </div>
                                        </div>
                                        <?php
                                    }
                                }
                                ?>
                            </div>
                        </div>
                        <div class='clearfix'></div>
                        <!--</div>-->
                        <?php
                    }
                }
                ?>
            </div>
        </div>
    </div>
    <div class="modal-footer">
        <button type="button" class="btn default" data-dismiss="modal">Close</button>
        <input type="submit" name="submit" value="Save Changes" class="btn green">
    </div>
</form>