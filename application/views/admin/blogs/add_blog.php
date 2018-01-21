<!-- BEGIN PAGE BAR -->
<div class="page-bar">
    <ul class="page-breadcrumb">
        <li>
            <a href="<?php echo base_url('admin/admin_dashboard'); ?>">Home</a>
            <i class="fa fa-circle"></i>
        </li>
        <li>
            <span>Blogs</span>
        </li>
    </ul>
</div>
<!-- END PAGE BAR -->
<!-- BEGIN PAGE TITLE-->
<h3 class="page-title">Add Blog</h3>
<!-- END PAGE TITLE-->
<!-- BEGIN Datatable-->
<div class="row">
    <div class="col-md-12">
        <div class="portlet light bordered">
            <div class="portlet-body form">
                <form role="form" id="blog-data" class="form-horizontal">
                    <input type="hidden" name="blog_id" value="<?php echo isset($blog_data->blog_id) ? $blog_data->blog_id : ""; ?>">
                    <div class="form-group">
                        <label class="col-md-2 control-label">Blog Title</label>
                        <div class="col-md-10">
                            <input name="blog_title" type="text" value="<?php echo isset($blog_data->blog_title) ? $blog_data->blog_title : ""; ?>" placeholder="Blog Title" class="form-control" />
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-2 control-label">Author Name</label>
                        <div class="col-md-10">
                            <input name="blog_author" type="text" value="<?php echo isset($blog_data->blog_author) ? $blog_data->blog_author : ""; ?>" placeholder="Author Name" class="form-control" />
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-2 control-label">About Author</label>
                        <div class="col-md-10">
                            <textarea name="blog_author_about" class="form-control" rows="3" placeholder="About Author"><?php echo isset($blog_data->blog_author_about) ? $blog_data->blog_author_about : ""; ?></textarea>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-2 control-label">Date</label>
                        <div class="col-md-10">
                            <input name="blog_date" value="<?php echo isset($blog_data->blog_date) ? $blog_data->blog_date : ""; ?>" data-date-format="yyyy-mm-dd" type="text" readonly="" class="form-control date-picker" />
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-2 control-label">Author Image</label>
                        <div class="col-md-10">
                            <?php if(isset($blog_data->author_image_path) && isset($blog_data->author_image)) { ?>
                                <img src="<?php echo base_url($blog_data->author_image_path.$blog_data->author_image); ?>" style="width: 50px; height: 50px; border-radius: 10px !important;">
                            <?php } ?>
                            <input name="author_image" type="file" class="form-control" />
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-2 control-label">Blog Image</label>
                        <div class="col-md-10">
                            <?php if(isset($blog_data->blog_image_path) && isset($blog_data->blog_image)) { ?>
                                <img src="<?php echo base_url($blog_data->blog_image_path.$blog_data->blog_image); ?>" style="width: 50px; height: 50px; border-radius: 10px !important;">
                            <?php } ?>
                            <input name="blog_image" type="file" class="form-control" />
                        </div>
                    </div>
                    <div class="md-checkbox-inline">
                        <div class="md-checkbox">
                            <input type="checkbox" <?php echo (isset($blog_data->is_active) && $blog_data->is_active) ? "checked='checked'" : ""; ?> name="is_active" id="checkbox" class="md-check">
                            <label for="checkbox">
                                <span></span>
                                <span class="check"></span>
                                <span class="box"></span>
                                Activate
                            </label>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-2 control-label">Select Tag</label>
                        <div class="col-md-10">
                            <select name="tag_id[]" multiple="" id="blog_tags" class="form-control">
                                <?php if(isset($tags_data)) { foreach ($tags_data as $tag) {
                                $selected = "";
                                if(isset($selected_tags) && $selected_tags != ''){
                                    $selected_tags = $selected_tags;
                                }else{
                                    $selected_tags = array();
                                }
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
                                    <div class="form-group form-md-line-input">
                                        <label class="control-label col-md-3"> <?php echo $category['category_name']; ?> <span class="required"> * </span> </label>
                                        <div class="col-md-6">
                                            <div class="md-checkbox-inline row">
                                                <!--get sub categories and loop through-->
                                                <?php
                                                $sub_categories = getSubCategoriesByCategoryId($category['category_id']);
                                                if ($sub_categories && count($sub_categories) > 0) {
                                                    foreach ($sub_categories as $sub_cat) {
                                                    $selected = "";
                                                    if(isset($selected_categories) && $selected_categories != ''){
                                                        $selected_categories = $selected_categories;
                                                    }else{
                                                        $selected_categories = array();
                                                    }
                                                    if (in_array($sub_cat['sub_category_id'], array_column($selected_categories, 'sub_category_id')) && in_array($category['category_id'], array_column($selected_categories, 'category_id'))) {
                                                        $selected = 'checked="checked"';
                                                    }
                                                        ?>
                                                        <div class="col-md-6">
                                                            <div class="md-checkbox">
                                                                <input <?php echo $selected; ?> type="checkbox" name='categories[]' value="<?php echo $category['category_id'] . "::" . $sub_cat['sub_category_id']; ?>" id="checkbox<?php echo $category['category_id'] . $sub_cat['sub_category_id']; ?>" class="md-check">
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
                                    </div>
                                    <?php
                                }
                            }
                            ?>

                    <!--Blog Data Start-->
                    <div class="portlet box grey-salsa">
                        <div class="portlet-title">
                            <div class="caption">
                                <i class="fa fa-plus"></i>Blog Data
                            </div>
                            <div class="tools">
                                <a href="javascript:;" class="collapse" data-original-title="" title=""> </a>
                            </div>
                        </div>
                        <div class="portlet-body form">
                            <div class="form-group">
                                <label class="col-md-1 control-label"></label>
                                <div class="col-md-10">
                                    <div class="mt-repeater">
                                        <div data-repeater-list="blog_data">
                                            <?php if(isset($blog_descriptions) && count($blog_descriptions) > 0){
                                                foreach ($blog_descriptions as $blog_des) { ?>
                                                <div data-repeater-item class="row">
                                                    <input type="hidden" name="blog_description_id[]" value="<?php echo isset($blog_des['blog_id']) ? $blog_des['blog_id'] : ""; ?>">
                                                    <div class="row">
                                                        <div class="col-md-4">
                                                            <label class="control-label">Image</label>
                                                            <?php if(isset($blog_des['blog_description_image_path']) && isset($blog_des['blog_description_image'])) { ?>
                                                                <img src="<?php echo base_url($blog_des['blog_description_image_path'].$blog_des['blog_description_image']); ?>" style="width: 50px; height: 50px; border-radius: 10px !important; margin-left: 50px;">
                                                            <?php } ?>
                                                            <input name="blog_description_image" type="file" class="form-control" />
                                                        </div>
                                                        <div class="col-md-7">
                                                            <label class="control-label">Blog Description</label>
                                                            <textarea name="blog_description" class="form-control" rows="3" placeholder="Description About Blog"><?php echo $blog_des['blog_description']; ?></textarea>
                                                        </div>
                                                    </div>
                                                    <div class="clearfix"></div>
                                                    <div class="row">
                                                        <div class="col-md-4">
                                                            <label class="control-label">Feature Image</label>
                                                            <?php if(isset($blog_des['blog_feature_image_path']) && isset($blog_des['blog_feature_image'])) { ?>
                                                                <img src="<?php echo base_url($blog_des['blog_feature_image_path'].$blog_des['blog_feature_image']); ?>" style="width: 50px; height: 50px; border-radius: 10px !important;">
                                                            <?php } ?>
                                                            <input name="blog_feature_image" type="file" class="form-control" />
                                                        </div>
                                                        <div class="col-md-7">
                                                            <label class="control-label">Feature Description</label>
                                                            <textarea name="blog_feature_description" class="form-control" rows="3" placeholder="Featured Description About Blog"><?php echo $blog_des['blog_feature_description']; ?></textarea>
                                                        </div>
    <!--                                                    <div class="col-md-1">-->
                                                            <label class="control-label"> </label>
                                                            <a href="javascript:;" data-repeater-delete class="btn btn-danger">
                                                                <i class="fa fa-close"></i>
                                                            </a>
                                                        <!--</div>-->
                                                    </div>
                                                </div>
                                            <?php } } else { ?>
                                            <div data-repeater-item class="row">
                                                    <input type="hidden" name="blog_description_id" value="<?php echo isset($blog_des->blog_id) ? $blog_des->blog_id : ""; ?>">
                                                    <div class="row">
                                                        <div class="col-md-4">
                                                            <label class="control-label">Image</label>
                                                            <input name="blog_description_image" type="file" class="form-control" />
                                                        </div>
                                                        <div class="col-md-7">
                                                            <label class="control-label">Blog Description</label>
                                                            <textarea name="blog_description" class="form-control" rows="3" placeholder="Descriptionn About Blog"></textarea>
                                                        </div>
                                                    </div>
                                                    <div class="clearfix"></div>
                                                    <div class="row">
                                                        <div class="col-md-4">
                                                            <label class="control-label">Feature Image</label>
                                                            <input name="blog_feature_image" type="file" class="form-control" />
                                                        </div>
                                                        <div class="col-md-7">
                                                            <label class="control-label">Feature Description</label>
                                                            <textarea name="blog_feature_description" class="form-control" rows="3" placeholder="Featured Descriptionn About Blog"></textarea>
                                                        </div>
    <!--                                                    <div class="col-md-1">-->
                                                            <label class="control-label"> </label>
                                                            <a href="javascript:;" data-repeater-delete class="btn btn-danger">
                                                                <i class="fa fa-close"></i>
                                                            </a>
                                                        <!--</div>-->
                                                    </div>
                                                </div>
                                            <?php } ?>
                                        </div>
                                        <hr>
                                        <a href="javascript:;" data-repeater-create class="btn btn-info mt-repeater-add">
                                            <i class="fa fa-plus"></i> Add More Blog Data</a>
                                        <br>
                                        <br>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--Blog Data Ends-->
                    <div class="form-actions">
                        <div class="row">
                            <div class="col-md-offset-3 col-md-9">
                                <button type="submit" class="btn btn-circle green">Submit</button>
                                <button type="button" class="btn btn-circle grey-salsa btn-outline">Cancel</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script src="<?php echo base_url(); ?>assets/global/plugins/jquery-repeater/jquery.repeater.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>assets/pages/scripts/form-repeater.min.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>assets/custom_scripts/admin/blogs.js" type="text/javascript"></script>
<script>
    $(document).ready(function(){
        Blogs.add_blog_validation("blog-data");    
    });
</script>