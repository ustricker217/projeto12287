(function () {
    'use strict';

    var passOne = $("#passOne").val();
    var passTwo = $("#passTwo").val();
    var $btn = "";

    $("#footerText").html("Fields don't match");


    var checkAndChange = function () {

        if ($("#footer").hasClass("correct")) {
            $("#footer").removeClass("correct").addClass("incorrect");
            $("#footerText").html("They don't match");
            $btn.addClass("hidden");
        } else {
            $("#footerText").html("They don't match");
            $btn.addClass("hidden");
        }
        if ($("#footer").hasClass("incorrect")) {
            if (passOne == passTwo && (passOne != 0 && passTwo != 0)) {
                $("#footer").removeClass("incorrect").addClass("correct");
                $("#footerText").html("Passwords match");
                $btn.removeClass("hidden");
            }
        }
        else {
            if (passOne != passTwo) {
                $("#footer").removeClass("correct").addClass("incorrect");
                $("#footerText").html("They don't match");
                $btn.addClass("hidden");
            }
        }
    };

    window.changePassword = function () {
        event.preventDefault();
        $.ajax({
            url: '/api/changeAdminPasswd',
            type: 'PUT',
            data: JSON.stringify({'newPassword': passOne}),
            contentType: 'application/json; charset=utf-8',
            success: function (response) {
                console.log(response);
            }
        });
    };

    function createButton() {
        $btn = $('<center><a class="btn btn-success"  href=" /admin " onclick="changePassword()">Update Password</a></center>');
        $btn.appendTo($("#footer"));
    }

    createButton();

    $("input").keyup(function () {
        var newPassOne = $("#passOne").val();
        var newPassTwo = $("#passTwo").val();

        passOne = newPassOne;
        passTwo = newPassTwo;

        checkAndChange();
    });


})();