var Categories = function () {

    var handleCategorySubmit = function (formId) {
        $.ajax({
            type: "POST",
            url: base_url + "admin/misc/add_update_category",
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
                    $('#datatable_categories').DataTable().ajax.reload(null, false);
                    $("#static-modal-popup-small").modal('hide');
                } else {
                    toastr["error"](data.description, "Error!");
                }
            }
        });
    }
    var handleValidationAddCategory = function (formId) {
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
                category_name: {
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
                handleCategorySubmit(formId);
            }
        });
    };
    var show_modal_category = function (edit_id) {
        $.ajax({
            type: "POST",
            url: base_url + "admin/misc/modal_category",
            datatype: 'json',
            data: {category_id: edit_id},
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
                    handleValidationAddCategory("form-add-category");
                }
            }
        });
    };

    return{
        modal_add_category: function (edit_id) {
            show_modal_category(edit_id);
        },
    }
}();