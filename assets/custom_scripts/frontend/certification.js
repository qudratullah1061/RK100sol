var Certifications = function () {

    var handleCertificationSubmit = function (formId) {
        
        $.ajax({
            type: "POST",
            url: base_url + "companions/add_update_certification",
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
                    $("#static-modal-popup-medium").modal('hide');
                    setTimeout(function(){
                        window.location.reload();
                        
                    },1000);
                } else {
                    toastr["error"](data.description, "Error!");
                }
            }
        });
    }
    var handleValidationAddCertification = function (formId) {
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
                title: {
                    required: true
                },
                description: {
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
            submitHandler: function () {
                handleCertificationSubmit(formId);
            }
        });
    };
    var show_modal_certification = function (edit_id) {
       
        $.ajax({
            type: "POST",
            url: base_url + "companions/modal_certification",
            datatype: 'json',
            data: {member_certification_id: edit_id},
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
//                    App.initMaterialDesign();
                    handleValidationAddCertification("form-add-certification");
                }
            }
        });
    };
    
    var show_certification = function (edit_id) {
       
        $.ajax({
            type: "POST",
            url: base_url + "companions/show_certification",
            datatype: 'json',
            data: {member_certification_id: edit_id},
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
                    $(".cbp-popup-close").click(function(){
                        $("#static-modal-popup").modal('hide');
                    });
                }
            }
        });
    };
    
    var show_skill_detail = function (member_id) {
       
        $.ajax({
            type: "POST",
            url: base_url + "member/show_skill_detail",
            datatype: 'json',
            data: {member_id: member_id},
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
                    $(".cbp-popup-close").click(function(){
                        $("#static-modal-popup").modal('hide');
                    });
                }
            }
        });
    };

    return{
        modal_add_certification: function (edit_id) {
            show_modal_certification(edit_id);
        },
        modal_show_certification: function (edit_id) {
            show_certification(edit_id);
        },
        modal_skill_detail: function (member_id) {
            show_skill_detail(member_id);
        }
    };
}();