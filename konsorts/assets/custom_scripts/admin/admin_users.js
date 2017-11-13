var AdminUsers = function () {

    var handleAdminSubmit = function (formId) {
        $.ajax({
            type: "POST",
            url: base_url + "admin/admin_dashboard/add_admin_user",
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
                    $('#datatable_adminusers').DataTable().ajax.reload();
                } else {
                    toastr["error"](data.description, "Error!");
                }
            }
        });
    }
    var handleValidationAdminUser = function (formId) {
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
                confirm_password: {
                    equalTo: "Password does not match confirm password field."
                }
            },
            rules: {
                first_name: {
                    required: true
                },
                last_name: {
                    required: true,
                },
                username: {
                    required: true,
                },
                email: {
                    required: true,
                    email: true
                },
                password: {
                    required: true,
                },
                confirm_password: {
                    required: true,
                    equalTo: "#password"
                },
                image: {
                    required: true,
                },
                about_me: {
                    required: true,
                },
//                url: true
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
                handleAdminSubmit(formId);
            }
        });
    };
    var show_modal_add_admin = function () {
        $.ajax({
            type: "POST",
            url: base_url + "admin/admin_dashboard/modal_add_admin",
            datatype: 'json',
            data: {},
            beforeSend: function ()
            {
                App.blockUI({target: 'body', animate: true});
            },
            complete: function () {
                App.unblockUI('body');
            },
            success: function (data) {
                if (data.key) {
                    $("#static-modal-popup-medium").html(data.value);
                    $("#static-modal-popup-medium").modal('show');
                    handleValidationAdminUser("form-add-admin");
                }
            }
        });
    };
    return {
        modal_add_admin: function () {
            show_modal_add_admin();
        },
    };
}();

