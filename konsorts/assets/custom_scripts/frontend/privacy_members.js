var PrivacyMembers = function () {

    var handlePrivacySubmit = function (formId) {
        $("#" + formId).on('submit', function (e) {
            e.preventDefault();
            $.ajax({
                type: "POST",
                url: base_url + "misc/update_member_privacy",
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
                            window.location.reload();
                        }, 500);
                    } else {
                        toastr["error"](data.description, "Error!");
                    }
                }
            });
        });
    }

    return {
        initUpdatePrivacyValidation: function (formId) {
            handlePrivacySubmit(formId);
        }
    };
}();