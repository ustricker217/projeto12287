(function () {
    'use strict';

    var newMail = "";
    var currentMail = "";
    var $btn = "";


    window.changeEmail = function () {
        event.preventDefault();
        //console.log(newMail);

        newMail = $("#newMail").val();
        currentMail = $("#currentMail").val();

        $.ajax({
            url: '/api/changeConfigMail',
            type: 'PUT',
            data: JSON.stringify({'currentMail': currentMail, 'newMail': newMail}),
            contentType: 'application/json; charset=utf-8',
            success: function (response) {
                console.log(response);
            }
        });
    };

    function createButton() {
        $btn = $('<center><a class="btn btn-success"  href=" /admin " onclick="changeEmail()">Update Config Mail</a></center>');
        $btn.appendTo($("#footer"));
    }

    createButton();
})();