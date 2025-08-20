<script>
    'use strict';

    // load users
    function getDataList() {
        var callParams      = {};
        callParams.type     = "GET";
        callParams.dataType = "html";
        callParams.url      = "{{ route('admin.customers.index') }}" + (gFilterObj ? '?' + $.param(gFilterObj) : '');
        callParams.data     = '';
        ajaxCall(callParams, function (result) {
            $('tbody').empty().html(result);
            feather.replace();
        }, function onErrorData(err, type, httpStatus) {});
    }

    // handle offcanvas for adding an user
    $('body').on('click', '#addTeamMemberBtnForOffCanvas', function(){
        $('#addTeamMemberFrm .offcanvas-title').text("{{ localize('Add New Team Member') }}");
        resetFormErrors('form#addTeamMemberFrm');
        resetForm('form#addTeamMemberFrm');
        showElement('.password_wrapper');
        $('form#addTeamMemberFrm input:hidden[name=_method]').val('POST');
        $('form#addTeamMemberFrm').attr('action', "{{ route('admin.customers.store') }}");
    })

    // search
    $('body').on('click', '#searchBtn', function(e){
        e.preventDefault();
        var search               = $('#f_search').val();
        var is_active            = $('#f_is_active :selected').val();
        var subscription_plan_id = $('#f_plan :selected').val();

        gFilterObj.search    = search;
        gFilterObj.subscription_plan_id = subscription_plan_id;

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
    $("#addTeamMemberFrm").submit(function(e) {
        e.preventDefault();

        resetFormErrors('form#addTeamMemberFrm');
        loading('#addTeamMemberBtn', 'Saving...');

        let id = $("#addTeamMemberFrm #id").val();

        var callParams  = {};
        callParams.type = "POST";
        callParams.url  = $("form#addTeamMemberFrm").attr("action");
       callParams.data = $('#addTeamMemberFrm').serialize();
        // callParams.data = new FormData($('#addTeamMemberFrm')[0]);

        ajaxCall(callParams, function (result) {
            resetLoading('#addTeamMemberBtn', 'Save');
            showSuccess(result.message);
            if(!id) { // only for save
                resetForm('form#addTeamMemberFrm');
            }
            getDataList();
        }, function (err, type, httpStatus) {
            showFormError(err, '#addTeamMemberFrm');
            resetLoading('#addTeamMemberBtn', 'Save');
        });

        return false;
    });

    // edit user
    $('body').on('click', '.editIcon', function(){
        let userId = parseInt($(this).data("id"));
        let actionUrl = $(this).data('url');
        let updateUrl = $(this).data('update-url');
        $('#addTeamMemberFrm .offcanvas-title').text("{{ localize('Update Customer') }}");
        $('#addTeamMemberSideBar').offcanvas('show');
        resetForm('form#addTeamMemberFrm');
        resetFormErrors('form#addTeamMemberFrm');
        hideElement('.password_wrapper');
        $('form#addTeamMemberFrm').attr('action', updateUrl);

        var callParams  = {};
        callParams.type = "GET";
        callParams.url  = actionUrl;
        callParams.data = "";
        ajaxCall(callParams, function (result) {
            if(result.data) {
                let user = result.data;
                $('#addTeamMemberFrm #id').val(user.id);
                $('#addTeamMemberFrm #name').val(user.name);
                $('#addTeamMemberFrm #email').val(user.email);
                $('#addTeamMemberFrm #user_type').val(user.user_type).change();
                $('#addTeamMemberFrm #mobile_no').val(user.mobile_no);
                $('#addTeamMemberFrm #avatar').val(user.avatar);
                $('#addTeamMemberFrm #is_active').val(user.is_active).change();
            }
        }, function (err, type, httpStatus) {

        });

    });

    // change user's status
    $('body').on('click', '.changeCustomerStatus', function(){
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
                    showFormError(err, '#addTeamMemberFrm');
                });
            }
        });
    });

    // delete user
    $('body').on('click', '.deleteCustomer', function(){
        let userId = parseInt($(this).data("id"));

        swConfirm({
            title: "Do you want to delete this user?",
            confirmButtonText: "Yes",
            showDenyButton: true,
        }, (result) => {
            if (result.isConfirmed) {
                var callParams  = {};
                callParams.type = "POST";
                callParams.url  = "admin/delete-admin/"+userId;
                callParams.data = {
                    id: userId,
                    _token : "{{ csrf_token() }}"
                };
                ajaxCall(callParams, function (result) {
                    toast(result.message);
                    getDataList();
                }, function (err, type, httpStatus) {
                    showFormError(err, '#addTeamMemberFrm');
                });
            }
        });
    });
    var offcanvasBottom = document.getElementById('offcanvasBottom')
    var secondoffcanvas = document.getElementById('addTeamMemberSideBar')

    offcanvasBottom.addEventListener('hidden.bs.offcanvas', function() {
        var bsOffcanvas2 = new bootstrap.Offcanvas(secondoffcanvas)
        bsOffcanvas2.show()
    })
    getDataList();

    $('body').on('change', '#assign_plan',function(e){
        if ($(this).is(':checked')) {
            $('#subscription-plan-div').removeClass('d-none');
        }else{
            $('#subscription-plan-div').addClass('d-none');
        }
    })
    $('body').on('click', '.is_paid',function(e){
        let is_paid = $('input[name="is_paid"]:checked').val();
        if (is_paid ==='free') {
            $('#payment-option').addClass('d-none');
        }else{
            $('#payment-option').removeClass('d-none');
        }
    })
    $('body').on('change', '.subscriptionPlanOption',function(e){
        e.preventDefault();
        let id = $(this).val();
        let url = "{{ route('admin.subscription-plans.get-price', [':id']) }}";
            url = url.replace(':id', id);
        var callParams  = {};
        callParams.type = "GET";
        callParams.url  = url;
        callParams.data = "";

        ajaxCall(callParams, function (result) {
            if(result.data.price){
                $('#payment_amount').val(result.data.price);
            }else{
                $('#payment_amount').val(0);
            }
        }, function onErrorData(err, type, httpStatus) {});
    })
</script>
