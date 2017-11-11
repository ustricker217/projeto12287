(function () {
    'use strict';

    var $datatable = null;

    window.deleteUser = function (userId) {
        event.preventDefault();
        if (confirm("Remove user " + userId + "?") === true)
        {
            $.ajax({
                url:'api/users/'+userId,
                type: 'DELETE',
                success: function (result) {
                    console.log($datatable);
                    $datatable.ajax.reload();
                }
            });
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
                    data: function ( d ) {
                        if (d.length === 0) {
                            return {};
                        }
                        var numPage = d.start / d.length + 1;
                        if (numPage < 1) {
                            numPage  = 1;
                        }
                        return {"page": numPage};
                    },
                    dataFilter: function(rawData){
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
                            "data": "id",
                            "render": function (data, type, row, meta) {
                                return '<a class="btn btn-xs btn-primary"  href="/users/'+ data + '/edit">Edit</a>' +
                                    '<a class="btn btn-xs btn-danger"  href="/users/ '+ data + '" onclick=" deleteUser(' + data + ')">Delete</a>';
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
