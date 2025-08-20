<script>
    'use strict';

    // load users
    function getDataList() {
        var callParams      = {};
        callParams.type     = "GET";
        callParams.dataType = "html";
        callParams.url      = "{{ route('admin.users.index') }}" + (gFilterObj ? '?' + $.param(gFilterObj) : '');
        callParams.data     = '';
        ajaxCall(callParams, function (result) {
            $('tbody').empty().html(result);
            feather.replace();
        }, function onErrorData(err, type, httpStatus) {});
    }

    // handle offcanvas for adding an user
    $('body').on('click', '#addUserBtnForOffCanvas', function(){
        $('#addUserFrm .offcanvas-title').text("{{ localize('Add New Staff') }}");
        resetFormErrors('form#addUserFrm');
        resetForm('form#addUserFrm');
        showElement('.password_wrapper');
        $('form#addUserFrm input:hidden[name=_method]').val('POST');
        $('form#addUserFrm').attr('action', "{{ route('admin.users.store') }}");
    })

    // search
    $('body').on('click', '#searchBtn', function(e){
        e.preventDefault();
        var search      = $('#f_search').val();
        var user_type   = $('#f_user_type :selected').val();
        var is_active   = $('#f_is_active :selected').val();
        loadingInTable("tbody",{
            colSpan: 11,
            prop: false,
        });
        gFilterObj.search    = search;
        gFilterObj.user_type = user_type;

        if(is_active === '0' || is_active === '1') {
            gFilterObj.is_active = is_active;
        } else if(gFilterObj.hasOwnProperty('is_active')) {
            delete gFilterObj.is_active;
        }


        if(gFilterObj.hasOwnProperty('page')) {
            delete gFilterObj.page;
        }

        getDataList();
    });

    // add user
    $("#addUserFrm").submit(function(e) {
        e.preventDefault();

        resetFormErrors('form#addUserFrm');
        loading('#addUserBtn', 'Saving...');

        let id = $("#addUserFrm #id").val();

        var callParams  = {};
        callParams.type = "POST";
        callParams.url  = $("form#addUserFrm").attr("action");
        callParams.data = new FormData($('#addUserFrm')[0]);
        callParams.processData = false;
        callParams.contentType = false;

        ajaxCall(callParams, function (result) {
            resetLoading('#addUserBtn', 'Save');
            showSuccess(result.message);
           if(!id) { 
                resetForm('form#addUserFrm');
            }
            getDataList();
            $('#addUserSideBar').offcanvas('hide');
        }, function (err, type, httpStatus) {
            showFormError(err, '#addUserFrm');
            resetLoading('#addUserBtn', 'Save');
        });

        return false;
    });

    // edit user
    $('body').on('click', '.editIcon', function(){
        let userId = parseInt($(this).data("id"));

        let actionUrl = "{{ route('admin.users.edit', ['user' => ':id']) }}".replace(':id', userId);
        let updateUrl = "{{ route('admin.users.update', ['user' => ':id']) }}".replace(':id', userId);
        // let actionUrl = "admin/update-admin/"+userId;

        $('#addUserFrm .offcanvas-title').text("{{ localize('Update User') }}");
        $('#addUserSideBar').offcanvas('show');
        $('.selected-file').html('');
        resetForm('form#addUserFrm');
        resetFormErrors('form#addUserFrm');
        hideElement('.password_wrapper');

        $('form#addUserFrm').attr('action', updateUrl);

        let callParams  = {};

        callParams.type = "GET";
        callParams.url  = actionUrl;
        callParams.data = "";
        loadingInContent('#loader', 'loading...');
        hideElement('.offcanvas-body');
        ajaxCall(callParams, function (result) {
            resetLoading('#loader', '');
            showElement('.offcanvas-body');
            if(result.data) {
                let user = result.data;
                $('#addUserFrm input[name="_method"]').val("PUT");
                $('#addUserFrm #id').val(user.id);
                
                $('#addUserFrm #first_name').val(user?.first_name);
                $('#addUserFrm #last_name').val(user?.last_name);

                $('#addUserFrm #email').val(user.email);
                $('#addUserFrm #avatar').val(user.avatar);
                $('#addUserFrm #user_type').val(user.user_type).change();
                $('#addUserFrm #mobile_no').val(user.mobile_no);

                $('#addUserFrm #branch_id').val(user.branch_id ?? null).change();

                console.log('accoutn stat', user.account_status);
                $('#addUserFrm #is_active').val(user.account_status).change();

                $('#role_id').val(result.data?.role?.role_id).change();
                getChosenFilesCount();
                showSelectedFilePreviewOnLoad();
            }
        }, function (err, type, httpStatus) {

        });

    });

    // change user's status
    $('body').on('click', '.changeUserStatus', function(){
        let userId = parseInt($(this).data("id"));
        let status = parseInt($(this).data("status"));

        swConfirm({
            title: "Do you want to change the status?",
            confirmButtonText: "Yes",
            showDenyButton: true,
        }, (result) => {
            if (result.isConfirmed) {
                var callParams  = {};
                callParams.type = "POST";
                callParams.url  = "admin/update-admin-status/"+userId;
                callParams.data = {
                    id: userId,
                    modelName: "city",
                    is_active: status ? 0 : 1,
                    _token : "{{ csrf_token() }}"
                };
                ajaxCall(callParams, function (result) {
                    toast(result.message);
                    getDataList();
                }, function (err, type, httpStatus) {
                    showFormError(err, '#addUserFrm');
                });
            }
        });
    });

    // delete user
    $('body').on('click', '.deleteUser', function(){
        let userId = parseInt($(this).data("id"));

        swConfirm({
            title: "Do you want to delete this user?",
            confirmButtonText: "Yes",
            showDenyButton: true,
        }, (result) => {
            if (result.isConfirmed) {
                var callParams  = {};
                callParams.type = "POST";
                callParams.url  = $(this).data("url");
                callParams.data = {
                    id: userId,
                    _method: $(this).data("method"),
                    _token : "{{ csrf_token() }}"
                };
                ajaxCall(callParams, function (result) {
                    toast(result.message);
                    getDataList();
                }, function (err, type, httpStatus) {
                    showFormError(err, '#addUserFrm');
                });
            }
        });
    });

    var offcanvasBottom = document.getElementById('offcanvasBottom')
    var secondoffcanvas = document.getElementById('addUserSideBar')

    offcanvasBottom.addEventListener('hidden.bs.offcanvas', function() {
        var bsOffcanvas2 = new bootstrap.Offcanvas(secondoffcanvas)
        bsOffcanvas2.show()
    })
    getDataList();
</script>
