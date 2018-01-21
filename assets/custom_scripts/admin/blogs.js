var Blogs = function () {

    var handleTagSubmit = function (formId) {
        $.ajax({
            type: "POST",
            url: base_url + "admin/blogs/add_update_tag",
            datatype: 'json',
            data: new FormData($("#" + formId)[0]),
            processData: false,
            contentType: false,
            beforeSend: function ()
            {
                App.blockUI({target: '.modal', animate: true});
            },
            complete: function () {
                App.unblockUI('.modal');
            },
            success: function (data) {
                if (!data.error) {
                    toastr["success"](data.description, "Success!");
                    $('#datatable_tags').DataTable().ajax.reload();
                    $("#static-modal-popup-small").modal('hide');
                } else {
                    toastr["error"](data.description, "Error!");
                }
            }
        });
    }

    var handleValidationAddTag = function (formId) {
        // for more info visit the official plugin documentation: 
        // http://docs.jquery.com/Plugins/Validation
        var form1 = $('#' + formId);
        var error1 = $('.alert-danger', form1);
        var success1 = $('.alert-success', form1);

        form1.validate({
            errorElement: 'span', //default input error message container
            errorClass: 'help-block help-block-error', // default input error message class
            focusInvalid: false, // do not focus the last invalid input
            ignore: "", // validate all fields including form hidden input
            messages: {

            },
            rules: {
                tag_name: {
                    required: true
                },
            },
            invalidHandler: function (event, validator) { //display error alert on form submit              
                success1.hide();
                error1.show();
                App.scrollTo(error1, -200);
            },
            errorPlacement: function (error, element) {
                if (element.is(':checkbox')) {
                    error.insertAfter(element.closest(".md-checkbox-list, .md-checkbox-inline, .checkbox-list, .checkbox-inline"));
                } else if (element.is(':radio')) {
                    error.insertAfter(element.closest(".md-radio-list, .md-radio-inline, .radio-list,.radio-inline"));
                } else {
                    error.insertAfter(element); // for other inputs, just perform default behavior
                }
            },
            highlight: function (element) { // hightlight error inputs
                $(element)
                        .closest('.form-group').addClass('has-error'); // set error class to the control group
            },
            unhighlight: function (element) { // revert the change done by hightlight
                $(element)
                        .closest('.form-group').removeClass('has-error'); // set error class to the control group
            },
            success: function (label) {
                label.closest('.form-group').removeClass('has-error'); // set success class to the control group
            },
            submitHandler: function (form) {
                handleTagSubmit(formId);
            }
        });
    };

    /* Start Blogs Data Handling */
    var handleBlogSubmit = function (formId) {
        $.ajax({
            type: "POST",
            url: base_url + "admin/blogs/add_update_blog",
            datatype: 'json',
            data: new FormData($("#" + formId)[0]),
            processData: false,
            contentType: false,
            beforeSend: function ()
            {
                App.blockUI({target: '.modal', animate: true});
            },
            complete: function () {
                App.unblockUI('.modal');
            },
            success: function (data) {
                if (!data.error) {
                    toastr["success"](data.description, "Success!");
                    $('#datatable_blogs').DataTable().ajax.reload();
                    $("#static-modal-popup-small").modal('hide');
                } else {
                    toastr["error"](data.description, "Error!");
                }
            }
        });
    }

    var validateAddBlog = function (formId) {
        // for more info visit the official plugin documentation: 
        // http://docs.jquery.com/Plugins/Validation
        var form1 = $('#' + formId);
        var error1 = $('.alert-danger', form1);
        var success1 = $('.alert-success', form1);
        $('#blog_tags').select2({
            multiple: true
        });

        $('.date-picker').datepicker();


        form1.validate({
            errorElement: 'span', //default input error message container
            errorClass: 'help-block help-block-error', // default input error message class
            focusInvalid: false, // do not focus the last invalid input
            ignore: "", // validate all fields including form hidden input
            messages: {

            },
            rules: {
                blog_title: {
                    required: true
                },
                blog_author: {
                    required: true
                },
                blog_author_about: {
                    required: true
                },
                blog_date: {
                    required: true
                },
                author_image: {
                    required: true
                },
                blog_image: {
                    required: true
                },
            },
            invalidHandler: function (event, validator) { //display error alert on form submit              
                success1.hide();
                error1.show();
                App.scrollTo(error1, -200);
            },
            errorPlacement: function (error, element) {
                if (element.is(':checkbox')) {
                    error.insertAfter(element.closest(".md-checkbox-list, .md-checkbox-inline, .checkbox-list, .checkbox-inline"));
                } else if (element.is(':radio')) {
                    error.insertAfter(element.closest(".md-radio-list, .md-radio-inline, .radio-list,.radio-inline"));
                } else {
                    error.insertAfter(element); // for other inputs, just perform default behavior
                }
            },
            highlight: function (element) { // hightlight error inputs
                $(element)
                        .closest('.form-group').addClass('has-error'); // set error class to the control group
            },
            unhighlight: function (element) { // revert the change done by hightlight
                $(element)
                        .closest('.form-group').removeClass('has-error'); // set error class to the control group
            },
            success: function (label) {
                label.closest('.form-group').removeClass('has-error'); // set success class to the control group
            },
            submitHandler: function (form) {
                handleBlogSubmit(formId);
            }
        });
    };

    /* End Blogs Data Handling */

    var show_modal_tag = function (edit_id) {
        $.ajax({
            type: "POST",
            url: base_url + "admin/blogs/modal_tag",
            datatype: 'json',
            data: {tag_id: edit_id},
            beforeSend: function ()
            {
                App.blockUI({target: 'body', animate: true});
            },
            complete: function () {
                App.unblockUI('body');
            },
            success: function (data) {
                if (data.key) {
                    $("#static-modal-popup-small").html(data.value);
                    $("#static-modal-popup-small").modal('show');
                    App.initMaterialDesign();
                    handleValidationAddTag("form-add-tag");
                }
            }
        });
    };
    var show_modal_categories = function (edit_id) {
        $.ajax({
            type: "POST",
            url: base_url + "admin/blogs/modal_categories",
            datatype: 'json',
            data: {blog_id: edit_id},
            beforeSend: function ()
            {
                App.blockUI({target: 'body', animate: true});
            },
            complete: function () {
                App.unblockUI('body');
            },
            success: function (data) {
                if (data.key) {
                    $("#static-modal-popup").html(data.value);
                    $("#static-modal-popup").modal('show');
                    $('#blog_tags').select2({
                        multiple: true,
                        width: "100%",
                    });
                    submitBlogCategoriesUpdate("form_update_blog_categories");
                }
            }
        });
    };

    var submitBlogCategoriesUpdate = function (formId) {
        $("#" + formId).on('submit', function (e) {
            e.preventDefault();
            $.ajax({
                type: "POST",
                url: base_url + "admin/blogs/update_blog_categories",
                datatype: 'json',
                data: new FormData($("#" + formId)[0]),
                processData: false,
                contentType: false,
                beforeSend: function ()
                {
                    App.blockUI({target: '#' + formId, animate: true});
                },
                complete: function () {
                    App.unblockUI('#' + formId);
                },
                success: function (data) {
                    if (!data.error) {
                        toastr["success"](data.description, "Success!");
                        $("#static-modal-popup").modal('hide');
                        
                    } else {
                        toastr["error"](data.description, "Error!");
                    }
                }
            });
        });
    }

    return{
        modal_add_tag: function (edit_id) {
            show_modal_tag(edit_id);
        },
        add_blog_validation: function (form_id) {
            validateAddBlog(form_id);
        },
        modal_view_categories: function (form_id) {
            show_modal_categories(form_id);
        },
    }
}();