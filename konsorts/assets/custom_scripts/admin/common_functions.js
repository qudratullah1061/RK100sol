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





var CommonFunctions = function () {

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
                                    } else if (table == 'tb_activities') {
                                        $('#datatable_activities').DataTable().ajax.reload();
                                    } else if (table == 'tb_availabilities') {
                                        $('#datatable_availabilities').DataTable().ajax.reload();
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
                });
    };

    return {
        Delete: function (unique_id, table, column, msg) {
            Delete(unique_id, table, column, msg);
        }
    };


}();