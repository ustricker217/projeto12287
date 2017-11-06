(function () {
    'use strict';

    var $datatable = null;

/*    window.deleteUser = function (userId) {
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
    };*/

    var getUsers = function (source) {
        var url = "/api/users";
        if ($datatable == null) {
            $datatable = $("#datatable").DataTable({
                ajax: {
                    "url": url,
                },
                    "columns": [
                        {"data": "id"},
                        {"data": "name"},
                        {"data": "email"},
                        {"data": "nickname"},
                        {
                            "data": "id",
                            "render": function (data, type, row, meta) {
                                return '<a class="btn btn-xs btn-primary"  href="/users/' + data + '">Edit</a>' +
                                    '<a class="btn btn-xs btn-danger"  href="#" onclick=" deleteUser(' + data + ')">Delete</a>';
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