if (!String.prototype.startsWith) {
	String.prototype.startsWith = function(search, pos) {
		return this.substr(!pos || pos < 0 ? 0 : +pos, search.length) === search;
	};
}
//#region global plugins
var GlobalPlugins = function () {

    var initToaster = function () {
        toastr.options = {
            "closeButton": true,
            "debug": false,
            "positionClass": "toast-top-right",
            "onclick": null,
            "showDuration": "1000",
            "hideDuration": "1000",
            "timeOut": "5000",
            "extendedTimeOut": "1000",
            "showEasing": "swing",
            "hideEasing": "linear",
            "showMethod": "fadeIn",
            "hideMethod": "fadeOut"
        }
    };

    return {
        initToasterPlugin: function () {
            initToaster();
        },
    };

}();
//#region global plugins ends
//
//
//#region common functions
var CommonFunctions = function () {

    DeleteDropzoneFile = function (unique_id, file_name) {
        App.blockUI({target: '.dropzone-file-area', animate: true});
        var jqxhr = $.getJSON(base_url + "misc/delete_dropzone_temp_file", data = {
            unique_id: unique_id,
            file_name: file_name
        }, function (response) {
            //console.log("success", response);
            if (data.error) {
                swal("Error!", data.description, "error");
            }
        }).done(function (response) {
        }).fail(function (jqxhr, textStatus, error) {
            toastr["error"](response.description, "Error.");
        }).always(function (response) {
            //console.log("complete", response);
        });
        // Perform other work here ...
        // Set another completion function for the request above
        jqxhr.complete(function (response) {
            //console.log("second complete", response);
            App.unblockUI('.dropzone-file-area')
        });
    }

    function MarkAsProfileImage(image_id, member_id) {
        swal({
            title: "Confirmation!",
            text: "Do you really want to chane profile pic for this user?",
            type: "warning",
            closeOnConfirm: false,
            showCancelButton: true,
            confirmButtonClass: "btn-info",
            confirmButtonText: "Yes, make profile pic!",
        },
                function () {
                    $.ajax({
                        url: base_url + "misc/MarkAsProfileImage/",
                        dataType: 'json',
                        method: 'post',
                        cache: false,
                        data: {image_id: image_id, member_id: member_id},
                        beforeSend: function () {
                            App.blockUI({target: 'body', animate: true});
                        },
                        complete: function () {
                            App.unblockUI('body');
                        },
                        success: function (data) {
                            if (!data.error) {
                                swal({
                                    title: "Success",
                                    text: data.description,
                                    type: "success",
                                }, function () {
                                    $(".pic-caption-img").css("color", "#474747");
                                    $(".pic-caption-" + image_id).css("color", "green");
                                });
                            } else {
                                // exception message here.
                                swal("Error!", data.description, "error");
                            }
                        },
                        error: function (xhr, desc, err) {
                            toastr["error"](xhr.statusText, "Error.");
                        }
                    });
                });
    }

    var Delete = function (unique_id, table, column, msg) {

        swal({
            title: "Are you sure?",
            text: "Warning! " + msg,
            type: "warning",
            closeOnConfirm: false,
            showCancelButton: true,
            confirmButtonClass: "btn-danger",
            confirmButtonText: "Yes, delete it!",
        },
                function () {
                    $.ajax({
                        url: base_url + "misc/DeleteRecord/",
                        dataType: 'json',
                        method: 'post',
                        cache: false,
                        data: {unique_id: unique_id, table: table, column: column},
                        beforeSend: function () {
                            App.blockUI({target: 'body', animate: true});
                        },
                        complete: function () {
                            App.unblockUI('body');
                        },
                        success: function (data) {
                            if (!data.error) {
                                swal({
                                    title: "Deleted",
                                    text: data.description,
                                    type: "success",
                                }, function () {
                                    if (table == 'tb_member_portfolios' || table == 'tb_blog_comments' || table == 'tb_member_languages' || table == 'tb_member_experience' || table == 'tb_member_degrees' || table == 'tb_member_certifications' || table == 'tb_notifications' || table == 'tb_notification_users') {
                                        window.location.reload();
                                    } else if (table == 'tb_member_images') {
                                        $("#pic-" + unique_id).remove();
                                        $('#load_member_profile_images').cubeportfolio('destroy');
                                        $('#load_member_id_proofs').cubeportfolio('destroy');
                                        is_init_profile_images = false;
                                        load_member_profile_images();
                                        is_init_id_proof_images = false;
                                        load_member_id_proofs();
                                    } else if (table == "tb_promos") {
                                        $("#datatable_promos").DataTable().ajax.reload(null, false);
                                    }
                                });
                            } else {
                                // exception message here.
                                swal("Error!", data.description, "error");
                            }
                        },
                        error: function (xhr, desc, err) {
                            toastr["error"](xhr.statusText, "Error.");
                        }
                    });
                });
    };

    var AcceptRequest = function (unique_id, table, column, msg) {

        swal({
            title: "Are you sure?",
            text:  msg,
            type: "info",
            closeOnConfirm: false,
            showCancelButton: true,
            confirmButtonClass: "btn-danger",
            confirmButtonText: "Yes, Accept it!",
        },
                function () {
                    $.ajax({
                        url: base_url + "misc/AcceptRequest/",
                        dataType: 'json',
                        method: 'post',
                        cache: false,
                        data: {unique_id: unique_id, table: table, column: column},
                        beforeSend: function () {
                            App.blockUI({target: 'body', animate: true});
                        },
                        complete: function () {
                            App.unblockUI('body');
                        },
                        success: function (data) {
                            if (!data.error) {
                                swal({
                                    title: "Accepted",
                                    text: data.description,
                                    type: "success",
                                }, function () {
                                    window.location.reload();
                                });
                            } else {
                                // exception message here.
                                swal("Error!", data.description, "error");
                            }
                        },
                        error: function (xhr, desc, err) {
                            toastr["error"](xhr.statusText, "Error.");
                        }
                    });
                });
    };

    var RejectRequest = function (unique_id, table, column, msg) {

        swal({
            title: "Are you sure?",
            text: "Warning! " + msg,
            type: "warning",
            closeOnConfirm: false,
            showCancelButton: true,
            confirmButtonClass: "btn-danger",
            confirmButtonText: "Yes, Reject it!",
        },
                function () {
                    $.ajax({
                        url: base_url + "misc/RejectRequest/",
                        dataType: 'json',
                        method: 'post',
                        cache: false,
                        data: {unique_id: unique_id, table: table, column: column},
                        beforeSend: function () {
                            App.blockUI({target: 'body', animate: true});
                        },
                        complete: function () {
                            App.unblockUI('body');
                        },
                        success: function (data) {
                            if (!data.error) {
                                swal({
                                    title: "Rejected",
                                    text: data.description,
                                    type: "success",
                                }, function () {
                                    window.location.reload();
                                });
                            } else {
                                // exception message here.
                                swal("Error!", data.description, "error");
                            }
                        },
                        error: function (xhr, desc, err) {
                            toastr["error"](xhr.statusText, "Error.");
                        }
                    });
                });
    };

    var Delete_Childs = function (unique_id, table, column, msg) {

        swal({
            title: "Are you sure?",
            text: "Warning! " + msg,
            type: "warning",
            closeOnConfirm: false,
            showCancelButton: true,
            confirmButtonClass: "btn-danger",
            confirmButtonText: "Yes, delete it!",
        },
                function () {
                    $.ajax({
                        url: base_url + "misc/DeleteChilds/",
                        dataType: 'json',
                        method: 'post',
                        cache: false,
                        data: {unique_id: unique_id, table: table, column: column},
                        beforeSend: function () {
                            App.blockUI({target: 'body', animate: true});
                        },
                        complete: function () {
                            App.unblockUI('body');
                        },
                        success: function (data) {
                            if (!data.error) {
                                swal({
                                    title: "Deleted",
                                    text: data.description,
                                    type: "success",
                                }, function () {
                                    if (table == 'tb_member_portfolios' || table == 'tb_blog_comments' || table == 'tb_member_languages' || table == 'tb_member_experience' || table == 'tb_member_degrees' || table == 'tb_member_certifications' || table == 'tb_notifications' || table == 'tb_notification_users') {
                                        window.location.reload();
                                    } else if (table == 'tb_member_images') {
                                        $("#pic-" + unique_id).remove();
                                        $('#load_member_profile_images').cubeportfolio('destroy');
                                        $('#load_member_id_proofs').cubeportfolio('destroy');
                                        is_init_profile_images = false;
                                        load_member_profile_images();
                                        is_init_id_proof_images = false;
                                        load_member_id_proofs();
                                    }
                                });
                            } else {
                                // exception message here.
                                swal("Error!", data.description, "error");
                            }
                        },
                        error: function (xhr, desc, err) {
                            toastr["error"](xhr.statusText, "Error.");
                        }
                    });
                });
    };


    var GetStateOptions = function (country_id, state_id, class_name) {
        $.ajax({
            url: base_url + "misc/get_states/",
            dataType: 'json',
            method: 'post',
            cache: false,
            data: {country_id: country_id, state_id: state_id},
            beforeSend: function () {
                App.blockUI({target: 'body', animate: true});
            },
            complete: function () {
                App.unblockUI('body');
            },
            success: function (data) {
                if (!data.error) {

                    if (typeof class_name != 'undefined') {
                        $("." + class_name).html(data.options);
                    } else {
                        $("#dd-state").html(data.options);
                    }
                } else {
                    // exception message here.
                    swal("Error!", data.description, "warning");
                }
            },
            error: function (xhr, desc, err) {
                toastr["error"](xhr.statusText, "Error.");
            }
        });
    };
    var GetCitiesOptions = function (state_id, city_id, class_name) {
        $.ajax({
            url: base_url + "misc/get_cities/",
            dataType: 'json',
            method: 'post',
            cache: false,
            data: {state_id: state_id, city_id: city_id},
            beforeSend: function () {
                App.blockUI({target: 'body', animate: true});
            },
            complete: function () {
                App.unblockUI('body');
            },
            success: function (data) {

                if (!data.error) {
                    if (typeof class_name != 'undefined') {
                        $("." + class_name).html(data.options);
                    } else {
                        $("#dd-city").html(data.options);
                    }
                } else {
                    // exception message here.
                    swal("Error!", data.description, "warning");
                }
            },
            error: function (xhr, desc, err) {
                toastr["error"](xhr.statusText, "Error.");
            }
        });
    };

    var UpdatePaymentInfoInDB = function (data, member_id, plan_id, promo_code) {
        $.ajax({
            url: base_url + "misc/UpdatePaymentInfoInDB/",
            dataType: 'json',
            method: 'post',
            cache: false,
            data: {data: data, member_id: member_id, plan_id: plan_id, promo_code: promo_code},
            beforeSend: function () {
                App.blockUI({target: '.membership-plans', animate: true});
            },
            complete: function () {
                App.unblockUI('.membership-plans');
            },
            success: function (data) {
                if (!data.error) {
                    swal({
                        title: "Success!",
                        text: data.description,
                        type: "success",
                        showCancelButton: false,
//                      confirmButtonClass: "btn-danger",
                        confirmButtonText: "Done",
                        closeOnConfirm: true
                    },
                            function () {
                                if (typeof reload != 'undefined' && reload) {
                                    window.location.reload();
                                } else {
                                    window.location.href = base_url;
                                }
                            });
                } else {
                    // exception message here.
                    swal("Error!", data.description, "warning");
                }
            },
            error: function (xhr, desc, err) {
                toastr["error"](xhr.statusText, "Error.");
            }
        });
    };

    var HandleSubmitPromoCode = function () {
        var member_id = $("#promo_member_id").val();
        var promo_code = $("#promo_code").val();
        if (promo_code == "") {
            swal("Error!", "Please enter promo code to proceede.", "error");
            return false;
        }
        $.ajax({
            url: base_url + "member/submit_promo/",
            dataType: 'json',
            method: 'post',
            cache: false,
            data: {member_id: member_id, promo_code: promo_code},
            beforeSend: function () {
                App.blockUI({target: 'body', animate: true});
            },
            complete: function () {
                App.unblockUI('body');
            },
            success: function (data) {
                if (!data.error) {
                    swal({title: "Success", text: data.description, type: "success"}, function () {
                        window.location.reload();
                    });
                } else {
                    // exception message here.
                    swal("Error!", data.description, "error");
                }
            },
            error: function (xhr, desc, err) {
                toastr["error"](xhr.statusText, "Error.");
            }
        });
    };

    var HandleOnlineStatus = function (obj) {
        var is_online = $(obj).attr('data-mode');
        var classNmae = 'online';
        var removeClass = 'offline';
        if (is_online == 1) {
            is_online = 0;
            classNmae = 'offline';
            removeClass = 'online';
        } else {
            is_online = 1;
        }
        $.ajax({
            url: base_url + "misc/updateOnlineStatus/",
            dataType: 'json',
            method: 'post',
            cache: false,
            data: {userId: $(obj).attr('data-member-id'), is_online: is_online},
            success: function (data) {
                if (!data.error) {
                    toastr["success"](data.description, "Success.");
                    $(obj).attr('data-mode', is_online);
                    $('#changeMode').removeClass(removeClass).addClass(classNmae);
                    $('#changeMode').text(classNmae);
                } else {
                    toastr["error"](data.description, "Error.");
                }
            },
            error: function (xhr, desc, err) {
                toastr["error"](xhr.statusText, "Error.");
            }
        });
    };

    var show_connect_request = function (member_id, user_id) {
        App.blockUI({target: 'body', animate: true});
        App.unblockUI('body');
        $('#sendRequest').attr('data-memberID', member_id);
        $('#sendRequest').attr('data-userID', user_id);
        $("#static-modal-popup-connect").modal('show');
    };

    var send_request = function (obj) {
        $.ajax({
            url: base_url + "misc/sendRequest/",
            dataType: 'json',
            method: 'post',
            cache: false,
            data: {userID: $('#sendRequest').attr('data-userid'), memberID: $('#sendRequest').attr('data-memberid')},
            success: function (data) {
                if (!data.error) {
                    toastr["success"](data.description, "Request Sent Successfully!");
                    $('#connectionBtn').addClass('btn-disable');
                    $('#static-modal-popup-connect').modal('hide');
                } else {
                    toastr["error"](data.description, "Error.");
                }
            },
            error: function (xhr, desc, err) {
                toastr["error"](xhr.statusText, "Error.");
            }
        });
    };

    return {
        RejectRequest: function (unique_id, table, column, msg) {
            RejectRequest(unique_id, table, column, msg);
        },
        AcceptRequest: function (unique_id, table, column, msg) {
            AcceptRequest(unique_id, table, column, msg);
        },
        Delete: function (unique_id, table, column, msg) {
            Delete(unique_id, table, column, msg);
        },
        Delete_Childs: function (unique_id, table, column, msg) {
            Delete_Childs(unique_id, table, column, msg);
        },
        MakeProfileImage: function (image_id, member_id) {
            MarkAsProfileImage(image_id, member_id);
        },
        DeleteDropzoneFile: function (unique_id, file_name) {
            DeleteDropzoneFile(unique_id, file_name);
        },
        LoadStates: function (country_id, state_id, class_name) {
            GetStateOptions(country_id, state_id, class_name);
        },
        LoadCities: function (state_id, city_id, class_name) {
            GetCitiesOptions(state_id, city_id, class_name);
        },
        ExecutePayment: function (data, member_id, plan_id, promo_code) {
            UpdatePaymentInfoInDB(data, member_id, plan_id, promo_code);
        },
        changeHash: function (hashId) {
            setTimeout(function () {
                if (history.pushState) {
                    history.pushState(null, null, hashId);
                } else {
                    location.hash = hashId;
                }
            }, 200);
        },
        SubmitPromoCode: function () {
            HandleSubmitPromoCode();
        },
        changeMode: function (obj) {
            HandleOnlineStatus(obj);
        },
        modal_connect_request: function (member_id, user_id) {
            show_connect_request(member_id, user_id);
        },
        send_request: function () {
            send_request();
        }
    };


}();
//#endregion common functions