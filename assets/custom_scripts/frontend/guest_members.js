var GuestMembers = function () {

    var handleGuestSubmit = function (formId) {
        $.ajax({
            type: "POST",
            url: base_url + "profile/add_guest_user",
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
                    var redirect_path = 'profile/guest_payment/' + data.code;
                    if ('add_guest_member' == formId) {
                        setTimeout(function () {
                            window.location.href = base_url + redirect_path;
                        }, 500);
                    } else {
                        setTimeout(function () {
                            window.location.reload();
                        }, 500);
                    }
                } else {
                    toastr["error"](data.description, "Error!");
                }
            }
        });
    }

    var handleValidationAddUpdateGuestMember = function (formId) {
        var form = $('#' + formId);
        var error1 = $('.alert-danger', form);
        var success1 = $('.alert-success', form);
        var Rules = {};
        if ('add_guest_member' == formId) {
            Rules = {
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
                'profile_images[]': {
                    required: true,
                },
                phone_number: {
                    required: true,
                },
                location: {
                    required: true,
                },
                address: {
                    required: true,
                },
                terms: {
                    required: true
                }
            };
        } else if ('update_guest_member' == formId) {
            Rules = {
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
                },
                confirm_password: {
                    equalTo: "#password"
                },
                phone_number: {
                    required: true,
                },
                location: {
                    required: true,
                },
                address: {
                    required: true,
                },
                about_me: {
                    required: true
                },
                facebook: {
                    url: true
                },
                youtube: {
                    url: true
                },
                twitter: {
                    url: true
                },
                linkedin: {
                    url: true
                },
                instagram: {
                    url: true
                },
                pinterest: {
                    url: true
                },
            }
        }
        form.validate({
            errorElement: 'span', //default input error message container
            errorClass: 'help-block help-block-error', // default input error message class
            focusInvalid: false, // do not focus the last invalid input
            ignore: [], // validate all fields including form hidden input
            messages: {
                confirm_password: {
                    equalTo: "Password does not match confirm password field."
                },
                'terms': {
                    required: 'Please check terms option',
                },
            },
            rules: Rules,
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
        initAddUpdateGuestValidation: function (formId) {
            if ($(".dateofbirht").val() != "") {
                $(".dateofbirht").datepicker();
            } else {
                $(".dateofbirht").datepicker({ changeMonth: true, changeYear: true, showButtonPanel: true,dateFormat:"yy-mm-dd"});
            }
            $("#dd-country").select2({
                placeholder: "Select",
                allowClear: true,
                width: 'auto',
                theme: "bootstrap"
            });
            $("#dd-state").select2({
                placeholder: "Select",
                allowClear: true,
                width: 'auto',
                theme: "bootstrap"
            });
            $("#dd-city").select2({
                placeholder: "Select",
                allowClear: true,
                width: 'auto',
                theme: "bootstrap"
            });
            handleValidationAddUpdateGuestMember(formId);
        }
    };
}();