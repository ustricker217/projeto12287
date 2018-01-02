(function () {
    'use strict';

    var $datatable = null;

    window.deleteImage = function (id) {
        event.preventDefault();
        $.ajax({
            url: '/api/images/' + id,
            type: 'DELETE',
            success: function (result) {
                $datatable.ajax.reload();
            }
        });
    };

    window.blockUnblock = function (id, estado) {
        event.preventDefault();
        $.ajax({
            url: '/api/images/' + id + '/changeStatus',
            type: 'PUT',
            data: JSON.stringify({'estado': estado}),
            contentType: 'application/json; charset=utf-8',
            success: function () {
                $datatable.ajax.reload();
                console.log(this.data);
            }
        });
    };


    var changeStatus = function (imageId, estado) {
        return '<a class="btn btn-xs btn-info"  href="/images/' + imageId + '" onclick=" blockUnblock(' + imageId + ', ' + estado + ')">' + (estado == 1 ? "Deactivate" : "Activate") + '</a>';

    };


    var getImages = function (source) {
        var url = "/api/images";
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
                    url: 'api/images',
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
                    {"data": "face"},
                    {"data": "path",
                        "render": function (data, type, row, meta) {
                            return '<img height="75%" width="15%" src="img/' + data + '"/>';
                        }
                    },
                    {
                        "data": "active",
                        "render": function (data, type, row, meta) {
                            return changeStatus(row.id, data);
                        }
                    },
                    {
                        "data": "id",
                        "render": function (data, type, row, meta) {
                            return '<a class="btn btn-xs btn-danger"  href="/images/' + data + '" onclick=" deleteImage(' + row.id + ')">Delete</a>';
                        }
                    }

                ]
            });
        } else {
            $datatable.ajax.url(url).load();
        }
    };

    getImages();
})();
