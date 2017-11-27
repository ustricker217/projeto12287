(function () {
    'use strict';

    function initFields() {
        document.getElementById('inputName').value = '';
        document.getElementById('inputEmail').value = '';
        document.getElementById('inputNickname').value = '';

    }


    function fillFields(user) {
        document.getElementById('inputName').value = user.name;
        document.getElementById('inputEmail').value = user.email;
        document.getElementById('inputNickname').value = user.nickname;
    }

    function loadUser(userID) {
        $.ajax({
            url: '/api/users/' + userID,
            type: 'GET',
            success: function (result) {
                console.log(result.data);
                fillFields(result.data);
            }
        });
    }

    initFields();
    var userID = window.location.pathname.split('/')[2];
    loadUser(userID);
})();