<script>
    'use strict';

    // add user
    $("#updateUserInfo").submit(function(e) {
        e.preventDefault();

        resetFormErrors('form#updateUserInfo');
        loading('.addUserBtn', 'Saving...');

        let id = $("#updateUserInfo #id").val();

        var callParams  = {};
        callParams.type = "POST";
        callParams.url  = $("form#updateUserInfo").attr("action");
        callParams.data = new FormData($('#updateUserInfo')[0]);
        callParams.processData = false;
        callParams.contentType = false;

        ajaxCall(callParams, function (result) {
            resetLoading('.addUserBtn', 'update');
            toast(result.message);
        
        }, function (err, type, httpStatus) {
            resetLoading('.addUserBtn', 'update');
        });

        return false;
    });
    // add user
    $("#userChangePassword").submit(function(e) {
        e.preventDefault();

        resetFormErrors('form#userChangePassword');
        loading('.addUserBtn', 'Saving...');

        let id = $("#userChangePassword #id").val();

        var callParams  = {};
        callParams.type = "POST";
        callParams.url  = $("form#userChangePassword").attr("action");
        callParams.data = new FormData($('#userChangePassword')[0]);
        callParams.processData = false;
        callParams.contentType = false;

        ajaxCall(callParams, function (result) {
            resetLoading('.addUserBtn', 'update');
            toast(result.message);
            location.reload();
        
        }, function (err, type, httpStatus) {
            showFormError(err, '#userChangePassword');
            resetLoading('.addUserBtn', 'update');
        });

        return false;
    });
   
</script>
