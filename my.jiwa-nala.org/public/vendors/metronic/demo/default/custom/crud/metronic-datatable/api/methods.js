var DefaultDatatableDemo = {
    init: function () {
        var t, a;
        t = {
            data: {
                type: "remote",
                source: {
                    read: {
                        url: "inc/api/datatables/demos/default.php"
                    },
					params: {
						_token: 
					}
                },
                pageSize: 20,
                serverPaging: !0,
                serverFiltering: !0,
                serverSorting: !0
            },
            layout: {
                theme: "default",
                class: "",
                scroll: !0,
                height: 550,
                footer: !1
            },
            sortable: !0,
            pagination: !0,
            search: {
                input: $("#generalSearch")
            },
            columns: [{
                field: "RecordID",
                title: "#",
                sortable: !1,
                width: 40,
                selector: {
                    class: "m-checkbox--solid m-checkbox--brand"
                }
            }, {
                field: "ID",
                title: "ID",
                sortable: !1,
                width: 40,
                template: "{{RecordID}}"
            }, {
                field: "ShipCountry",
                title: "Ship Country",
                width: 150,
                template: function (t) {
                    return t.ShipCountry + " - " + t.ShipCity
                }
            }, {
                field: "ShipCity",
                title: "Ship City"
            }, {
                field: "Currency",
                title: "Currency",
                width: 100
            }, {
                field: "ShipDate",
                title: "Ship Date",
                sortable: "asc"
            }, {
                field: "Latitude",
                title: "Latitude"
            }, {
                field: "Status",
                title: "Status",
                template: function (t) {
                    var a = {
                        1: {
                            title: "Pending",
                            class: "m-badge--brand"
                        },
                        2: {
                            title: "Delivered",
                            class: " m-badge--metal"
                        },
                        3: {
                            title: "Canceled",
                            class: " m-badge--primary"
                        },
                        4: {
                            title: "Success",
                            class: " m-badge--success"
                        },
                        5: {
                            title: "Info",
                            class: " m-badge--info"
                        },
                        6: {
                            title: "Danger",
                            class: " m-badge--danger"
                        },
                        7: {
                            title: "Warning",
                            class: " m-badge--warning"
                        }
                    };
                    return '<span class="m-badge ' + a[t.Status].class + ' m-badge--wide">' + a[t.Status].title + "</span>"
                }
            }, {
                field: "Type",
                title: "Type",
                template: function (t) {
                    var a = {
                        1: {
                            title: "Online",
                            state: "danger"
                        },
                        2: {
                            title: "Retail",
                            state: "primary"
                        },
                        3: {
                            title: "Direct",
                            state: "accent"
                        }
                    };
                    return '<span class="m-badge m-badge--' + a[t.Type].state + ' m-badge--dot"></span>&nbsp;<span class="m--font-bold m--font-' + a[t.Type].state + '">' + a[t.Type].title + "</span>"
                }
            }, {
                field: "Actions",
                width: 110,
                title: "Actions",
                sortable: !1,
                overflow: "visible",
                template: function (t, a, e) {
                    return '\t\t\t\t\t\t<div class="dropdown ' + (e.getPageSize() - a <= 4 ? "dropup" : "") + '">\t\t\t\t\t\t\t<a href="#" class="btn m-btn m-btn--hover-accent m-btn--icon m-btn--icon-only m-btn--pill" data-toggle="dropdown">                                <i class="la la-ellipsis-h"></i>                            </a>\t\t\t\t\t\t  \t<div class="dropdown-menu dropdown-menu-right">\t\t\t\t\t\t    \t<a class="dropdown-item" href="#"><i class="la la-edit"></i> Edit Details</a>\t\t\t\t\t\t    \t<a class="dropdown-item" href="#"><i class="la la-leaf"></i> Update Status</a>\t\t\t\t\t\t    \t<a class="dropdown-item" href="#"><i class="la la-print"></i> Generate Report</a>\t\t\t\t\t\t  \t</div>\t\t\t\t\t\t</div>\t\t\t\t\t\t<a href="#" class="m-portlet__nav-link btn m-btn m-btn--hover-accent m-btn--icon m-btn--icon-only m-btn--pill" title="Edit details">\t\t\t\t\t\t\t<i class="la la-edit"></i>\t\t\t\t\t\t</a>\t\t\t\t\t\t<a href="#" class="m-portlet__nav-link btn m-btn m-btn--hover-danger m-btn--icon m-btn--icon-only m-btn--pill" title="Delete">\t\t\t\t\t\t\t<i class="la la-trash"></i>\t\t\t\t\t\t</a>\t\t\t\t\t'
                }
            }]
        }, a = $(".m_datatable").mDatatable(t), $("#m_datatable_destroy").on("click", function () {
            $(".m_datatable").mDatatable("destroy")
        }), $("#m_datatable_init").on("click", function () {
            a = $(".m_datatable").mDatatable(t)
        }), $("#m_datatable_reload").on("click", function () {
            $(".m_datatable").mDatatable("reload")
        }), $("#m_datatable_sort_asc").on("click", function () {
            a.sort("ShipCity", "asc")
        }), $("#m_datatable_sort_desc").on("click", function () {
            a.sort("ShipCity", "desc")
        }), $("#m_datatable_get").on("click", function () {
            if (a.rows(".m-datatable__row--active"), a.nodes().length > 0) {
                var t = a.columns("ShipCity").nodes().text();
                $("#datatable_value").html(t)
            }
        }), $("#m_datatable_check").on("click", function () {
            var t = $("#m_datatable_check_input").val();
            a.setActive(t)
        }), $("#m_datatable_check_all").on("click", function () {
            $(".m_datatable").mDatatable("setActiveAll", !0)
        }), $("#m_datatable_uncheck_all").on("click", function () {
            $(".m_datatable").mDatatable("setActiveAll", !1)
        }), $("#m_datatable_hide_column").on("click", function () {
            a.columns("Currency").visible(!1)
        }), $("#m_datatable_show_column").on("click", function () {
            a.columns("Currency").visible(!0)
        }), $("#m_datatable_remove_row").on("click", function () {
            a.rows(".m-datatable__row--active").remove()
        })
    }
};
jQuery(document).ready(function () {
    DefaultDatatableDemo.init()
});