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
//#region common functions
var CommonFunctions = function () {

    DeleteDropzoneFile = function (unique_id, file_name) {
        App.blockUI({target: '.dropzone-file-area', animate: true});
        var jqxhr = $.getJSON(base_url + "admin/misc/delete_dropzone_temp_file", data = {unique_id: unique_id, file_name: file_name}, function (response) {
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
                        url: base_url + "admin/Misc/MarkAsProfileImage/",
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
                                    $(".pic-caption-" + image_id).css("color", "#474747");
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
                        url: base_url + "admin/Misc/DeleteRecord/",
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
                                    if (table == 'tb_admin_users') {
                                        $('#datatable_adminusers').DataTable().ajax.reload();
                                    } else if (table == 'tb_categories') {
                                        $('#datatable_categories').DataTable().ajax.reload();
                                    } else if (table == 'tb_sub_categories') {
                                        $('#datatable_sub_categories').DataTable().ajax.reload();
                                    } else if (table == 'tb_members') {
                                        if ($('#datatable_guests').length > 0)
                                            $('#datatable_guests').DataTable().ajax.reload();
                                        else if ($('#datatable_companions').length > 0)
                                            $('#datatable_companions').DataTable().ajax.reload();
                                    } else if (table == 'tb_member_images') {
                                        $("#pic-" + unique_id).remove();
                                        $('#load_member_profile_images').cubeportfolio('destroy');
                                        $('#load_member_id_proofs').cubeportfolio('destroy');
                                        is_init_profile_images = false;
                                        load_member_profile_images();
                                        is_init_id_proof_images = false;
                                        load_member_id_proofs();
                                    } else if (table == 'tb_tags') {
                                        $('#datatable_tags').DataTable().ajax.reload();
                                    } else if (table == 'tb_member_portfolios' || table == 'tb_member_languages') {
                                        window.location.reload();
                                    } else if (table == 'tb_member_portfolios' || table == 'tb_member_languages' || table == 'tb_member_experience' || table == 'tb_member_degrees' || table == 'tb_member_certifications') {
                                        window.location.reload();
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

    var GetStateOptions = function (country_id, state_id, dropdown_class) {
        $.ajax({
            url: base_url + "admin/misc/get_states/",
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
                    if (dropdown_class != undefined) {
                        $("." + dropdown_class).html(data.options);
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
    var GetCitiesOptions = function (state_id, city_id, dropdown_class) {
        $.ajax({
            url: base_url + "admin/misc/get_cities/",
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
                    if (dropdown_class != undefined) {
                        $("." + dropdown_class).html(data.options);
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

    return {
        Delete: function (unique_id, table, column, msg) {
            Delete(unique_id, table, column, msg);
        },
        MakeProfileImage: function (image_id, member_id) {
            MarkAsProfileImage(image_id, member_id);
        },
        DeleteDropzoneFile: function (unique_id, file_name) {
            DeleteDropzoneFile(unique_id, file_name);
        },
        LoadStates: function (country_id, state_id, dropdown_class) {
            GetStateOptions(country_id, state_id, dropdown_class);
        },
        LoadCities: function (state_id, city_id, dropdown_class) {
            GetCitiesOptions(state_id, city_id, dropdown_class);
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
        UpdateSubscriptionModal: function (member_id, end_subscription_date) {
            ShowSubscriptionModal(member_id, end_subscription_date);
        }
    };


}();
//#endregion common functions