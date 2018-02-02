/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


var DatatablesObj = function () {

    var InitAdminUsersDatatable = function (tableId) {
        var grid = new Datatable();
        grid.init({
            src: $("#" + tableId),
            onSuccess: function (grid, response) {
                // grid:        grid object
                // response:    json object of server side ajax response
                // execute some code after table records loaded
                $(".date-picker").datepicker();
            },
            onError: function (grid) {
                // execute some code on network or other general error  
            },
            onDataLoad: function (grid) {
                // execute some code on ajax data load
            },
            loadingMessage: 'Loading...',
            dataTable: {
                "bStateSave": true, // save datatable state(pagination, sort, etc) in cookie.
                "lengthMenu": [
                    [10, 20, 50, 100, 150, -1],
                    [10, 20, 50, 100, 150, "All"] // change per page values here
                ],
                "pageLength": 10, // default record count per page
                "ajax": {
                    "url": base_url + "admin/admin_dashboard/get_admin_users", // ajax source
                },
                "order": [
                    [1, "asc"]
                ], // set first column as a default sort by asc
                "aoColumnDefs": [
                    {'sName': 'Image', 'bSortable': false, 'aTargets': [0]},
                    {'sName': 'Username', 'bSortable': true, 'aTargets': [1]},
                    {'sName': 'FirstName', 'bSortable': true, 'aTargets': [2]},
                    {'sName': 'LastName', 'bSortable': true, 'aTargets': [3]},
                    {'sName': 'Email', 'bSortable': true, 'aTargets': [4]},
                    {'sName': 'UpdatedOn', 'bSortable': true, 'aTargets': [5]},
                    {'sName': 'Actions', 'bSortable': false, 'aTargets': [6]},
                ]
            }
        });

        // handle group actionsubmit button click
        grid.getTableWrapper().on('click', '.table-group-action-submit', function (e) {
            e.preventDefault();
            var action = $(".table-group-action-input", grid.getTableWrapper());
            if (action.val() != "" && grid.getSelectedRowsCount() > 0) {
                grid.setAjaxParam("customActionType", "group_action");
                grid.setAjaxParam("customActionName", action.val());
                grid.setAjaxParam("id", grid.getSelectedRows());
                grid.getDataTable().ajax.reload();
                grid.clearAjaxParams();
            } else if (action.val() == "") {
                App.alert({
                    type: 'danger',
                    icon: 'warning',
                    message: 'Please select an action',
                    container: grid.getTableWrapper(),
                    place: 'prepend'
                });
            } else if (grid.getSelectedRowsCount() === 0) {
                App.alert({
                    type: 'danger',
                    icon: 'warning',
                    message: 'No record selected',
                    container: grid.getTableWrapper(),
                    place: 'prepend'
                });
            }
        });

        grid.setAjaxParam("customActionType", "group_action");
        grid.getDataTable().ajax.reload();
        grid.clearAjaxParams();
    };

    var InitCompanionUsersDatatable = function (tableId) {

        var grid = new Datatable();

        grid.init({
            src: $("#" + tableId),
            onSuccess: function (grid, response) {
                // grid:        grid object
                // response:    json object of server side ajax response
                // execute some code after table records loaded
                $(".date-picker").datepicker();
            },
            onError: function (grid) {
                // execute some code on network or other general error  
            },
            onDataLoad: function (grid) {
                // execute some code on ajax data load
            },
            loadingMessage: 'Loading...',
            dataTable: {
                "bStateSave": true, // save datatable state(pagination, sort, etc) in cookie.
                "lengthMenu": [
                    [10, 20, 50, 100, 150, -1],
                    [10, 20, 50, 100, 150, "All"] // change per page values here
                ],
                "pageLength": 10, // default record count per page
                "ajax": {
                    "url": base_url + "admin/companions/get_companion_users", // ajax source
                },
                "order": [
                    //[1, "asc"]
                ], // set first column as a default sort by asc
                "aoColumnDefs": [
                    {'sName': 'Image', 'bSortable': false, 'aTargets': [0]},
                    {'sName': 'Username', 'bSortable': true, 'aTargets': [1]},
                    {'sName': 'FirstName', 'bSortable': true, 'aTargets': [2]},
                    {'sName': 'LastName', 'bSortable': true, 'aTargets': [3]},
                    {'sName': 'Email', 'bSortable': true, 'aTargets': [4]},
                    {'sName': 'UpdatedOn', 'bSortable': true, 'aTargets': [5]},
                    {'sName': 'Actions', 'bSortable': false, 'aTargets': [6]},
                ]
            }
        });

        // handle group actionsubmit button click
        grid.getTableWrapper().on('click', '.table-group-action-submit', function (e) {
            e.preventDefault();
            var action = $(".table-group-action-input", grid.getTableWrapper());
            if (action.val() != "" && grid.getSelectedRowsCount() > 0) {
                grid.setAjaxParam("customActionType", "group_action");
                grid.setAjaxParam("customActionName", action.val());
                grid.setAjaxParam("id", grid.getSelectedRows());
                grid.getDataTable().ajax.reload();
                grid.clearAjaxParams();
            } else if (action.val() == "") {
                App.alert({
                    type: 'danger',
                    icon: 'warning',
                    message: 'Please select an action',
                    container: grid.getTableWrapper(),
                    place: 'prepend'
                });
            } else if (grid.getSelectedRowsCount() === 0) {
                App.alert({
                    type: 'danger',
                    icon: 'warning',
                    message: 'No record selected',
                    container: grid.getTableWrapper(),
                    place: 'prepend'
                });
            }
        });

        grid.setAjaxParam("customActionType", "group_action");
        grid.getDataTable().ajax.reload();
        grid.clearAjaxParams();
    };

    var InitGuestUsersDatatable = function (tableId) {

        var grid = new Datatable();

        grid.init({
            src: $("#" + tableId),
            onSuccess: function (grid, response) {
                // grid:        grid object
                // response:    json object of server side ajax response
                // execute some code after table records loaded
                $(".date-picker").datepicker();
            },
            onError: function (grid) {
                // execute some code on network or other general error  
            },
            onDataLoad: function (grid) {
                // execute some code on ajax data load
            },
            loadingMessage: 'Loading...',
            dataTable: {
                "bStateSave": true, // save datatable state(pagination, sort, etc) in cookie.
                "lengthMenu": [
                    [10, 20, 50, 100, 150, -1],
                    [10, 20, 50, 100, 150, "All"] // change per page values here
                ],
                "pageLength": 10, // default record count per page
                "ajax": {
                    "url": base_url + "admin/guests/get_guest_users", // ajax source
                },
                "order": [
                    //[1, "asc"]
                ], // set first column as a default sort by asc
                "aoColumnDefs": [
                    {'sName': 'Image', 'bSortable': false, 'aTargets': [0]},
                    {'sName': 'Username', 'bSortable': true, 'aTargets': [1]},
                    {'sName': 'FirstName', 'bSortable': true, 'aTargets': [2]},
                    {'sName': 'LastName', 'bSortable': true, 'aTargets': [3]},
                    {'sName': 'Email', 'bSortable': true, 'aTargets': [4]},
                    {'sName': 'UpdatedOn', 'bSortable': true, 'aTargets': [5]},
                    {'sName': 'Actions', 'bSortable': false, 'aTargets': [6]},
                ]
            }
        });

        // handle group actionsubmit button click
        grid.getTableWrapper().on('click', '.table-group-action-submit', function (e) {
            e.preventDefault();
            var action = $(".table-group-action-input", grid.getTableWrapper());
            if (action.val() != "" && grid.getSelectedRowsCount() > 0) {
                grid.setAjaxParam("customActionType", "group_action");
                grid.setAjaxParam("customActionName", action.val());
                grid.setAjaxParam("id", grid.getSelectedRows());
                grid.getDataTable().ajax.reload();
                grid.clearAjaxParams();
            } else if (action.val() == "") {
                App.alert({
                    type: 'danger',
                    icon: 'warning',
                    message: 'Please select an action',
                    container: grid.getTableWrapper(),
                    place: 'prepend'
                });
            } else if (grid.getSelectedRowsCount() === 0) {
                App.alert({
                    type: 'danger',
                    icon: 'warning',
                    message: 'No record selected',
                    container: grid.getTableWrapper(),
                    place: 'prepend'
                });
            }
        });

        grid.setAjaxParam("customActionType", "group_action");
        grid.getDataTable().ajax.reload();
        grid.clearAjaxParams();
    };

    var InitCategoriesDatatable = function (tableId) {

        var grid = new Datatable();

        grid.init({
            src: $("#" + tableId),
            onSuccess: function (grid, response) {
                // grid:        grid object
                // response:    json object of server side ajax response
                // execute some code after table records loaded
                $(".date-picker-createdon").datepicker();
                $(".date-picker-updatedon").datepicker();
            },
            onError: function (grid) {
                // execute some code on network or other general error  
            },
            onDataLoad: function (grid) {
                // execute some code on ajax data load
            },
            loadingMessage: 'Loading...',
            dataTable: {
                "bStateSave": true, // save datatable state(pagination, sort, etc) in cookie.
                "lengthMenu": [
                    [10, 20, 50, 100, 150, -1],
                    [10, 20, 50, 100, 150, "All"] // change per page values here
                ],
                "pageLength": 10, // default record count per page
                "ajax": {
                    "url": base_url + "admin/misc/get_categories", // ajax source
                },
                "order": [
                    [0, "asc"]
                ], // set first column as a default sort by asc
                "aoColumnDefs": [
                    {'sName': 'Category Name', 'bSortable': true, 'aTargets': [0]},
                    {'sName': 'CreatedOn', 'bSortable': true, 'aTargets': [1]},
                    {'sName': 'CreatedBy', 'bSortable': true, 'aTargets': [2]},
                    {'sName': 'UpdatedOn', 'bSortable': true, 'aTargets': [3]},
                    {'sName': 'Status', 'bSortable': true, 'aTargets': [4]},
                    {'sName': 'Actions', 'bSortable': false, 'aTargets': [5]},
                ]
            }
        });

        // handle group actionsubmit button click
        grid.getTableWrapper().on('click', '.table-group-action-submit', function (e) {
            e.preventDefault();
            var action = $(".table-group-action-input", grid.getTableWrapper());
            if (action.val() != "" && grid.getSelectedRowsCount() > 0) {
                grid.setAjaxParam("customActionType", "group_action");
                grid.setAjaxParam("customActionName", action.val());
                grid.setAjaxParam("id", grid.getSelectedRows());
                grid.getDataTable().ajax.reload();
                grid.clearAjaxParams();
            } else if (action.val() == "") {
                App.alert({
                    type: 'danger',
                    icon: 'warning',
                    message: 'Please select an action',
                    container: grid.getTableWrapper(),
                    place: 'prepend'
                });
            } else if (grid.getSelectedRowsCount() === 0) {
                App.alert({
                    type: 'danger',
                    icon: 'warning',
                    message: 'No record selected',
                    container: grid.getTableWrapper(),
                    place: 'prepend'
                });
            }
        });

        grid.setAjaxParam("customActionType", "group_action");
        grid.getDataTable().ajax.reload();
        grid.clearAjaxParams();
    };
    
    var InitSubCategoriesDatatable = function (tableId, category_id) {

        var grid = new Datatable();

        grid.init({
            src: $("#" + tableId),
            onSuccess: function (grid, response) {
                // grid:        grid object
                // response:    json object of server side ajax response
                // execute some code after table records loaded
                $(".date-picker-createdon").datepicker();
                $(".date-picker-updatedon").datepicker();
            },
            onError: function (grid) {
                // execute some code on network or other general error  
            },
            onDataLoad: function (grid) {
                // execute some code on ajax data load
            },
            loadingMessage: 'Loading...',
            dataTable: {
                "bStateSave": true, // save datatable state(pagination, sort, etc) in cookie.
                "lengthMenu": [
                    [10, 20, 50, 100, 150, -1],
                    [10, 20, 50, 100, 150, "All"] // change per page values here
                ],
                "pageLength": 10, // default record count per page
                "ajax": {
                    "url": base_url + "admin/misc/get_sub_categories/" + category_id, // ajax source
                },
                "order": [
                    [0, "asc"]
                ], // set first column as a default sort by asc
                "aoColumnDefs": [
                    {'sName': 'Sub Category Name', 'bSortable': true, 'aTargets': [0]},
                    {'sName': 'CreatedOn', 'bSortable': true, 'aTargets': [1]},
                    {'sName': 'CreatedBy', 'bSortable': true, 'aTargets': [2]},
                    {'sName': 'UpdatedOn', 'bSortable': true, 'aTargets': [3]},
                    {'sName': 'Status', 'bSortable': true, 'aTargets': [4]},
                    {'sName': 'Actions', 'bSortable': false, 'aTargets': [5]},
                ]
            }
        });

        // handle group actionsubmit button click
        grid.getTableWrapper().on('click', '.table-group-action-submit', function (e) {
            e.preventDefault();
            var action = $(".table-group-action-input", grid.getTableWrapper());
            if (action.val() != "" && grid.getSelectedRowsCount() > 0) {
                grid.setAjaxParam("customActionType", "group_action");
                grid.setAjaxParam("customActionName", action.val());
                grid.setAjaxParam("id", grid.getSelectedRows());
                grid.getDataTable().ajax.reload();
                grid.clearAjaxParams();
            } else if (action.val() == "") {
                App.alert({
                    type: 'danger',
                    icon: 'warning',
                    message: 'Please select an action',
                    container: grid.getTableWrapper(),
                    place: 'prepend'
                });
            } else if (grid.getSelectedRowsCount() === 0) {
                App.alert({
                    type: 'danger',
                    icon: 'warning',
                    message: 'No record selected',
                    container: grid.getTableWrapper(),
                    place: 'prepend'
                });
            }
        });

        grid.setAjaxParam("customActionType", "group_action");
        grid.getDataTable().ajax.reload();
        grid.clearAjaxParams();
    };
    
    var InitTagsDatatable = function (tableId) {

        var grid = new Datatable();

        grid.init({
            src: $("#" + tableId),
            onSuccess: function (grid, response) {
                // grid:        grid object
                // response:    json object of server side ajax response
                // execute some code after table records loaded
                $(".date-picker-createdon").datepicker();
                $(".date-picker-updatedon").datepicker();
            },
            onError: function (grid) {
                // execute some code on network or other general error  
            },
            onDataLoad: function (grid) {
                // execute some code on ajax data load
            },
            loadingMessage: 'Loading...',
            dataTable: {
                "bStateSave": true, // save datatable state(pagination, sort, etc) in cookie.
                "lengthMenu": [
                    [10, 20, 50, 100, 150, -1],
                    [10, 20, 50, 100, 150, "All"] // change per page values here
                ],
                "pageLength": 10, // default record count per page
                "ajax": {
                    "url": base_url + "admin/blogs/get_tags", // ajax source
                },
                "order": [
                    [0, "asc"]
                ], // set first column as a default sort by asc
                "aoColumnDefs": [
                    {'sName': 'Tag Name', 'bSortable': true, 'aTargets': [0]},
                    {'sName': 'CreatedOn', 'bSortable': true, 'aTargets': [1]},
                    {'sName': 'UpdatedOn', 'bSortable': true, 'aTargets': [2]},
                    {'sName': 'CreatedBy', 'bSortable': true, 'aTargets': [3]},
                    {'sName': 'Status', 'bSortable': true, 'aTargets': [4]},
                    {'sName': 'Actions', 'bSortable': false, 'aTargets': [5]},
                ]
            }
        });

        // handle group actionsubmit button click
        grid.getTableWrapper().on('click', '.table-group-action-submit', function (e) {
            e.preventDefault();
            var action = $(".table-group-action-input", grid.getTableWrapper());
            if (action.val() != "" && grid.getSelectedRowsCount() > 0) {
                grid.setAjaxParam("customActionType", "group_action");
                grid.setAjaxParam("customActionName", action.val());
                grid.setAjaxParam("id", grid.getSelectedRows());
                grid.getDataTable().ajax.reload();
                grid.clearAjaxParams();
            } else if (action.val() == "") {
                App.alert({
                    type: 'danger',
                    icon: 'warning',
                    message: 'Please select an action',
                    container: grid.getTableWrapper(),
                    place: 'prepend'
                });
            } else if (grid.getSelectedRowsCount() === 0) {
                App.alert({
                    type: 'danger',
                    icon: 'warning',
                    message: 'No record selected',
                    container: grid.getTableWrapper(),
                    place: 'prepend'
                });
            }
        });

        grid.setAjaxParam("customActionType", "group_action");
        grid.getDataTable().ajax.reload();
        grid.clearAjaxParams();
    };
    
    var InitPromosDatatable = function (tableId) {

        var grid = new Datatable();

        grid.init({
            src: $("#" + tableId),
            onSuccess: function (grid, response) {
                // grid:        grid object
                // response:    json object of server side ajax response
                // execute some code after table records loaded
                $(".date-picker-createdon").datepicker();
                $(".date-picker-updatedon").datepicker();
            },
            onError: function (grid) {
                // execute some code on network or other general error  
            },
            onDataLoad: function (grid) {
                // execute some code on ajax data load
            },
            loadingMessage: 'Loading...',
            dataTable: {
                "bStateSave": true, // save datatable state(pagination, sort, etc) in cookie.
                "lengthMenu": [
                    [10, 20, 50, 100, 150, -1],
                    [10, 20, 50, 100, 150, "All"] // change per page values here
                ],
                "pageLength": 10, // default record count per page
                "ajax": {
                    "url": base_url + "admin/promos/get_promos", // ajax source
                },
                "order": [
                    [0, "asc"]
                ], // set first column as a default sort by asc
                "aoColumnDefs": [
                    {'sName': 'Promos Title', 'bSortable': true, 'aTargets': [0]},
                    {'sName': 'CreatedOn', 'bSortable': true, 'aTargets': [1]},
                    {'sName': 'UpdatedOn', 'bSortable': true, 'aTargets': [2]},
                    {'sName': 'CreatedBy', 'bSortable': true, 'aTargets': [3]},
                    {'sName': 'Status', 'bSortable': true, 'aTargets': [4]},
                    {'sName': 'Actions', 'bSortable': false, 'aTargets': [5]},
                ]
            }
        });

        // handle group actionsubmit button click
        grid.getTableWrapper().on('click', '.table-group-action-submit', function (e) {
            e.preventDefault();
            var action = $(".table-group-action-input", grid.getTableWrapper());
            if (action.val() != "" && grid.getSelectedRowsCount() > 0) {
                grid.setAjaxParam("customActionType", "group_action");
                grid.setAjaxParam("customActionName", action.val());
                grid.setAjaxParam("id", grid.getSelectedRows());
                grid.getDataTable().ajax.reload();
                grid.clearAjaxParams();
            } else if (action.val() == "") {
                App.alert({
                    type: 'danger',
                    icon: 'warning',
                    message: 'Please select an action',
                    container: grid.getTableWrapper(),
                    place: 'prepend'
                });
            } else if (grid.getSelectedRowsCount() === 0) {
                App.alert({
                    type: 'danger',
                    icon: 'warning',
                    message: 'No record selected',
                    container: grid.getTableWrapper(),
                    place: 'prepend'
                });
            }
        });

        grid.setAjaxParam("customActionType", "group_action");
        grid.getDataTable().ajax.reload();
        grid.clearAjaxParams();
    };
    
    var InitBlogsDatatable = function (tableId) {

        var grid = new Datatable();

        grid.init({
            src: $("#" + tableId),
            onSuccess: function (grid, response) {
                // grid:        grid object
                // response:    json object of server side ajax response
                // execute some code after table records loaded
                $(".date-picker-createdon").datepicker();
                $(".date-picker-updatedon").datepicker();
            },
            onError: function (grid) {
                // execute some code on network or other general error  
            },
            onDataLoad: function (grid) {
                // execute some code on ajax data load
            },
            loadingMessage: 'Loading...',
            dataTable: {
                "bStateSave": true, // save datatable state(pagination, sort, etc) in cookie.
                "lengthMenu": [
                    [10, 20, 50, 100, 150, -1],
                    [10, 20, 50, 100, 150, "All"] // change per page values here
                ],
                "pageLength": 10, // default record count per page
                "ajax": {
                    "url": base_url + "admin/blogs/get_blogs", // ajax source
                },
                "order": [
                    [0, "asc"]
                ], // set first column as a default sort by asc
                "aoColumnDefs": [
                    {'sName': 'Blog Title', 'bSortable': true, 'aTargets': [0]},
                    {'sName': 'Blog Author', 'bSortable': true, 'aTargets': [1]},
//                    {'sName': 'Blog Date', 'bSortable': true, 'aTargets': [2]},
                    {'sName': 'Blog Image', 'bSortable': true, 'aTargets': [2]},
                    {'sName': 'Author Image', 'bSortable': true, 'aTargets': [3]},
                    {'sName': 'CreatedOn', 'bSortable': true, 'aTargets': [4]},
//                    {'sName': 'UpdatedOn', 'bSortable': true, 'aTargets': [6]},
                    {'sName': 'CreatedBy', 'bSortable': true, 'aTargets': [5]},
                    {'sName': 'Status', 'bSortable': true, 'aTargets': [6]},
                    {'sName': 'Actions', 'bSortable': false, 'aTargets': [7]},
                ]
            }
        });

        // handle group actionsubmit button click
        grid.getTableWrapper().on('click', '.table-group-action-submit', function (e) {
            e.preventDefault();
            var action = $(".table-group-action-input", grid.getTableWrapper());
            if (action.val() != "" && grid.getSelectedRowsCount() > 0) {
                grid.setAjaxParam("customActionType", "group_action");
                grid.setAjaxParam("customActionName", action.val());
                grid.setAjaxParam("id", grid.getSelectedRows());
                grid.getDataTable().ajax.reload();
                grid.clearAjaxParams();
            } else if (action.val() == "") {
                App.alert({
                    type: 'danger',
                    icon: 'warning',
                    message: 'Please select an action',
                    container: grid.getTableWrapper(),
                    place: 'prepend'
                });
            } else if (grid.getSelectedRowsCount() === 0) {
                App.alert({
                    type: 'danger',
                    icon: 'warning',
                    message: 'No record selected',
                    container: grid.getTableWrapper(),
                    place: 'prepend'
                });
            }
        });

        grid.setAjaxParam("customActionType", "group_action");
        grid.getDataTable().ajax.reload();
        grid.clearAjaxParams();
    };

    return {
        InitAdminTable: function (tableId) {
            InitAdminUsersDatatable(tableId);
        },
        InitCompanionTable: function (tableId) {
            InitCompanionUsersDatatable(tableId);
        },
        InitGuestTable: function (tableId) {
            InitGuestUsersDatatable(tableId);
        },
        InitCategoriesTable: function (tableId) {
            InitCategoriesDatatable(tableId);
        },
        InitTagsTable: function (tableId) {
            InitTagsDatatable(tableId);
        },
        InitPromosTable: function (tableId) {
            InitPromosDatatable(tableId);
        },
        InitBlogsTable: function (tableId) {
            InitBlogsDatatable(tableId);
        },
        InitSubCategoriesTable: function (tableId, category_id) {
            InitSubCategoriesDatatable(tableId, category_id);
        }
    };

}();