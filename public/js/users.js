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

    window.blockUser = function (id) {
        event.preventDefault();
        if (confirm("Block user?") === true) {
            $.ajax({
                url: '/api/users/' + id +'/block',
                type: 'PUT',
                success: function (result) {
                    $datatable.ajax.reload();
                }
            });
        }
    };

    window.unblockUser = function (id) {
        event.preventDefault();
        if (confirm("Unblock user?") === true) {
            $.ajax({
                url: '/api/users/' + id +'/unblock',
                type: 'PUT',
                success: function (result) {
                    console.log($datatable);
                    $datatable.ajax.reload();
                }
            });
        }
    };

    var changePermission = function (permission, userId) {
        if(permission === 0)
        {
            return '<a class="btn btn-xs btn-info"  href="/users/' + userId + '" onclick=" blockUser(' + userId + ')">Block</a>';
        }else{
            return '<a class="btn btn-xs btn-info"  href="/users/' + userId + '" onclick=" unblockUser(' + userId + ')">Unblock</a>';
        }
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
                            return changePermission(data, row.id);

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
