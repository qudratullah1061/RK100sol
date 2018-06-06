var FormWizard = function () {

    var handleCompanionSubmit = function (formId) {
        $.ajax({
            type: "POST",
            url: base_url + "profile/add_companion_user",
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
//                    var redirect_path = 'login';
                    var redirect_path = 'profile/thankyou';
                    if ('add_companion_member' == formId) {
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

    var submitMemberCategoriesUpdate = function (formId) {
        $("#" + formId).on('submit', function (e) {
            e.preventDefault();
            $.ajax({
                type: "POST",
                url: base_url + "companions/update_member_categories",
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
                            window.location.reload()
                        }, 1000);
                    } else {
                        toastr["error"](data.description, "Error!");
                    }
                }
            });
        });
    }


    var handleCompanionFormValidation = function (formId) {
        var form = $('#' + formId);
        var error1 = $('.alert-danger', form);
        var success1 = $('.alert-success', form);
        var Rules = {};
        if ('add_companion_member' == formId) {
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
                confirm_email: {
                    required: true,
                    email: true,
                    equalTo: "#confirm_email"
                },
                password: {
                    required: true,
                },
                confirm_password: {
                    required: true,
                    equalTo: "#password"
                },
                "profile_images[]": {
                    required: true,
                },
                'id_proofs[]': {
                    required: true,
                },
                phone_number: {
                    required: true,
                },
                years: {
                    required: true,
                },
                months: {
                    required: true,
                },
                days: {
                    required: true,
                },
                location: {
                    required: true,
                },
//                zipcode: {
//                    required: true,
//                },
//                state: {
//                    required: true,
//                },
//                city: {
//                    required: true,
//                },
                address: {
                    required: true,
                },
                about_me: {
                    required: true
                }
            };
        } else if ('update_companion_member' == formId) {
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
//                date_of_birth: {
//                    required: true,
//                },
                location: {
                    required: true,
                },
//                zipcode: {
//                    required: true,
//                },
//                state: {
//                    required: true,
//                },
//                city: {
//                    required: true,
//                },
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
            doNotHideMessage: true, //this option enables to show the error/success messages on tab switch.
            errorElement: 'span', //default input error message container
            errorClass: 'help-block help-block-error', // default input error message class
            focusInvalid: false, // do not focus the last invalid input
            messages: {
                confirm_password: {
                    equalTo: "Password does not match confirm password field."
                }
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
                $(element).closest('.form-group').addClass('has-error'); // set error class to the control group
            },
            unhighlight: function (element) { // revert the change done by hightlight
                $(element).closest('.form-group').removeClass('has-error'); // set error class to the control group
            },
            success: function (label) {
                label.closest('.form-group').removeClass('has-error'); // set success class to the control group
            },
            submitHandler: function (form) {
                handleCompanionSubmit(formId);
                //add here some ajax code to submit your form or just call form.submit() if you want to submit the form without ajax
            }

        });
    }

    return {
        //main function to initiate the module
        init: function () {
            $("input[name='date_of_birth']").datepicker({changeMonth: true, changeYear: true, showButtonPanel: true, dateFormat: "yy-mm-dd"});
//            $("#dd-country").select2({
//                placeholder: "Select",
//                allowClear: true,
//                width: '100%',
//                theme: "bootstrap"
//            });
//            $("#dd-state").select2({
//                placeholder: "Select",
//                allowClear: true,
//                width: '100%',
//                theme: "bootstrap"
//            });
//            $("#dd-city").select2({
//                placeholder: "Select",
//                allowClear: true,
//                width: '100%',
//                theme: "bootstrap"
//            });
            if (!jQuery().bootstrapWizard) {
                return;
            }
            handleCompanionFormValidation('add_companion_member');
            var form = $('#add_companion_member');
            var error = $('.alert-danger', form);
            var success = $('.alert-success', form);
            var handleTitle = function (tab, navigation, index) {
                var total = navigation.find('li').length;
                var current = index + 1;
                // set wizard title
                $('.step-title', $('#form_wizard_1')).text('Step ' + (index + 1) + ' of ' + total);
                // set done steps
                jQuery('li', $('#form_wizard_1')).removeClass("done");
                var li_list = navigation.find('li');
                for (var i = 0; i < index; i++) {
                    jQuery(li_list[i]).addClass("done");
                }

                if (current == 1) {
                    $('#form_wizard_1').find('.button-previous').hide();
                } else {
                    $('#form_wizard_1').find('.button-previous').show();
                }

                if (current >= total) {
                    $('#form_wizard_1').find('.button-next').hide();
                    $('#form_wizard_1').find('.button-submit').show();
                    //displayConfirm();
                } else {
                    $('#form_wizard_1').find('.button-next').show();
                    $('#form_wizard_1').find('.button-submit').hide();
                }
                App.scrollTo($('.page-title'));
            }

            // default form wizard
            $('#form_wizard_1').bootstrapWizard({
                'nextSelector': '.button-next',
                'previousSelector': '.button-previous',
                onTabClick: function (tab, navigation, index, clickedIndex) {
                    success.hide();
                    error.hide();
                    if (form.valid() == false) {
                        return false;
                    }

                    handleTitle(tab, navigation, clickedIndex);
                },
                onNext: function (tab, navigation, index) {
                    success.hide();
                    error.hide();
                    if (index == 1 && $("input[name='id_proofs[]']").val() == "") {
                        swal("Error!", "Please upload at least one id proof image.", "error");
                        return false;
                    } else {
                        $("#id_proofs-error").remove();
                    }
                    if (form.valid() == false) {
                        return false;
                    }

                    handleTitle(tab, navigation, index);
                },
                onPrevious: function (tab, navigation, index) {
                    success.hide();
                    error.hide();

                    handleTitle(tab, navigation, index);
                },
                onTabShow: function (tab, navigation, index) {
                    var total = navigation.find('li').length;
                    var current = index + 1;
                    var $percent = (current / total) * 100;
                    $('#form_wizard_1').find('.progress-bar').css({
                        width: $percent + '%'
                    });
                }
            });

            $('#form_wizard_1').find('.button-previous').hide();
            $('#form_wizard_1 .button-submit').click(function () {
                $("#add_companion_member").submit();
            }).hide();
        },
        handleCompanionValidation: function (formId) {
            handleCompanionFormValidation(formId);
        },
        handleMemberCategoriesUpdate: function (formId) {
            submitMemberCategoriesUpdate(formId);
        }
    };

}();

jQuery(document).ready(function () {
    FormWizard.init();
});