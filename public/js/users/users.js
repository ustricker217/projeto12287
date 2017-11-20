(function () {
    'use strict';

    var $datatable = null;

    window.deleteUser = function (id) {
        event.preventDefault();
        if (confirm("Remove user " + id + "?") === true) {
            $.ajax({
                url: '/api/users/' + id,
                type: 'DELETE',
                success: function (result) {
                    $datatable.ajax.reload();
                }
            });
        }
    };

    window.changePermission = function (id, estado) {
        event.preventDefault();
        if (confirm("Unblock user?") === true) {
            var reason = prompt("Enter the reason:");
            $.ajax({
                url: '/api/users/' + id + '/block',
                type: 'PUT',
                data: JSON.stringify({'reason': reason, 'estado': estado}),
                contentType: 'application/json; charset=utf-8',
                success: function (result) {
                    $datatable.ajax.reload();
                    console.log(this.data);
                }
            });
        }
    };

    var changePermission = function (userId, estado) {
        return '<a class="btn btn-xs btn-info"  href="/users/' + userId + '" onclick=" changePermission(' + userId + ', ' + estado + ')">' + (estado == 1 ? "Unblock" : "Block") + '</a>';
    };


    var getUsers = function (source) {
        var url = "/api/users";
        if ($datatable == null) {
            $datatable = $("#datatable").DataTable({
                "serverSide": true,
                "processing": true,
                "paging": true,
                "searching": false,
                "ordering": false,
                "lengthChange": false,
                "pageLength": 5,
                ajax: {
                    url: 'api/users',
                    dataSrc: 'data',
                    data: function (d) {
                        if (d.length === 0) {
                            return {};
                        }
                        var numPage = d.start / d.length + 1;
                        if (numPage < 1) {
                            numPage = 1;
                        }
                        return {"page": numPage};
                    },
                    dataFilter: function (rawData) {
                        var data = jQuery.parseJSON(rawData);
                        data.recordsTotal = data.meta.total;
                        data.recordsFiltered = data.meta.total;
                        return JSON.stringify(data);
                    },
                },
                columns: [
                    {"data": "id"},
                    {"data": "name"},
                    {"data": "email"},
                    {"data": "nickname"},
                    {
                        "data": "permission",
                        "render": function (data, type, row, meta) {
                            return changePermission(row.id, data);
                        }
                    },
                    {
                        "data": "id",
                        "render": function (data, type, row, meta) {
                            return '<a class="btn btn-xs btn-danger"  href="/users/' + data + '" onclick=" deleteUser(' + row.id + ')">Delete</a>';
                        }
                    }

                ]
            });
        } else {
            $datatable.ajax.url(url).load();
        }
    };
    getUsers();
})();
