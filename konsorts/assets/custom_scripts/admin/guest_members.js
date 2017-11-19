var GuestMembers = function () {

    var handleGuestSubmit = function (formId) {
        $.ajax({
            type: "POST",
            url: base_url + "admin/guests/add_guest_user",
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
                    setTimeout(function () {
                        window.location.href = base_url + 'admin/guests';
                    }, 500);
                } else {
                    toastr["error"](data.description, "Error!");
                }
            }
        });
    }

    var handleValidationAddGuestMember = function (formId) {
        var form = $('#' + formId);
        var error1 = $('.alert-danger', form);
        var success1 = $('.alert-success', form);
        form.validate({
            errorElement: 'span', //default input error message container
            errorClass: 'help-block help-block-error', // default input error message class
            focusInvalid: false, // do not focus the last invalid input
            ignore: "", // validate all fields including form hidden input
            messages: {
                confirm_password: {
                    equalTo: "Password does not match confirm password field."
                }
            },
            ignore: [],
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
                        'id_proofs[]': {
                            required: true,
                        },
                        phone_number: {
                            required: true,
                        },
                        gender: {
                            required: true,
                        },
                        date_of_birth: {
                            required: true,
                        },
                        country: {
                            required: true,
                        },
                        state: {
                            required: true,
                        },
                        city: {
                            required: true,
                        },
                        address: {
                            required: true,
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
                handleGuestSubmit(formId);
            }
        });

    };
    return {
        initAddGuestValidation: function (formId) {
            $(".date-picker").datepicker();
            handleValidationAddGuestMember(formId);
        }
    };
}();