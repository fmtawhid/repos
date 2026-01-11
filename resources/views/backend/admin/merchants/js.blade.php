<script>
    'use strict';

    // load users
    function getDataList() {
        var callParams      = {};
        callParams.type     = "GET";
        callParams.dataType = "html";
        callParams.url      = "{{ route('admin.merchants.index') }}" + (gFilterObj ? '?' + $.param(gFilterObj) : '');
        callParams.data     = '';
        ajaxCall(callParams, function (result) {
            $('tbody').empty().html(result);
            feather.replace();
        }, function onErrorData(err, type, httpStatus) {});
    }

    // handle offcanvas for adding an user
    $('body').on('click', '#addMerchantBtnForOffCanvas', function(){
        $('#addMerchantFrm .offcanvas-title').text("{{ localize('Add New Vendor') }}");
        resetFormErrors('form#addMerchantFrm');
        resetForm('form#addMerchantFrm');
        showElement('.password_wrapper');
        $('form#addMerchantFrm').attr('action', "{{ route('admin.merchants.store') }}");
        $('form#addMerchantFrm input:hidden[name=_method]').val('POST');
        // Ensure account status is visible and default to active
        $('#addMerchantFrm #account_status').closest('.mb-3').show();
        $('#addMerchantFrm #account_status').val({{ appStatic()::ACCOUNT_STATUS_ACTIVE }}).change();
    })

    // edit user
    $('body').on('click', '.editIcon', function(){
        let userId = parseInt($(this).data("id"));
        let actionUrl = $(this).data('url');
        let updateUrl = $(this).data('update-url');
        $('#addMerchantFrm .offcanvas-title').text("{{ localize('Update Vendor') }}");
        $('#addMerchantSideBar').offcanvas('show');
        resetForm('form#addMerchantFrm');
        resetFormErrors('form#addMerchantFrm');
        hideElement('.password_wrapper');
        $('.selected-file').html('');
        $('form#addMerchantFrm').attr('action', updateUrl);
        $("form#addMerchantFrm [name='_method']").attr('value', 'PUT');

        var callParams  = {};
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

                console.log('user', user);

                $('#addMerchantFrm #id').val(user.id);
                $('#addMerchantFrm #first_name').val(user.first_name);
                $('#addMerchantFrm #last_name').val(user.last_name);
                $('#addMerchantFrm #email').val(user.email);
                $('#addMerchantFrm #user_type').val(user.user_type).change();
                $('#addMerchantFrm #mobile_no').val(user.mobile_no);
                $('#addMerchantFrm #avatar').val(user.avatar);
                // Hide account status on edit - status not editable from edit form
                $('#addMerchantFrm #account_status').closest('.mb-3').hide();
                if(user.avatar){
                    getChosenFilesCount();
                    showSelectedFilePreviewOnLoad();
                }
            }
        }, function (err, type, httpStatus) {

        });

    });

    // search
    $('body').on('click', '#searchBtn', function(e){
        e.preventDefault();
        var search               = $('#f_search').val();
        var is_active            = $('#f_is_active :selected').val();
        var subscription_plan_id = $('#f_plan :selected').val();
        loadingInTable("tbody",{
            colSpan: 11,
            prop: false,
        });
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
    $("#addMerchantFrm").submit(function(e) {
        e.preventDefault();

        resetFormErrors('form#addMerchantFrm');
        loading('#addUserBtn', 'Saving...');

        let id = $("#addMerchantFrm #id").val();

        var callParams  = {};
        callParams.type = "POST";
        callParams.url  = $("form#addMerchantFrm").attr("action");
        callParams.data = $('#addMerchantFrm').serialize();

        ajaxCall(callParams, function (result) {
          
            resetLoading('#addUserBtn', 'Save');
            showSuccess(result.message);
            if(!id) { // only for save
                resetForm('form#addMerchantFrm');
            }
            getDataList();
            $('#addMerchantSideBar').offcanvas('hide');
        }, function (err, type, httpStatus) {
            resetLoading('#addUserBtn', 'Save');
            showFormError(err, '#addMerchantFrm');
            resetLoading('#addUserBtn', 'Save');
        });

        return false;
    });

    // edit user
    $('body').on('click', '.editIcon', function(){
        let userId = parseInt($(this).data("id"));
        let actionUrl = $(this).data('url');
        let updateUrl = $(this).data('update-url');
        $('#addMerchantFrm .offcanvas-title').text("{{ localize('Update Vendor') }}");
        $('#addMerchantSideBar').offcanvas('show');
        resetForm('form#addMerchantFrm');
        resetFormErrors('form#addMerchantFrm');
        hideElement('.password_wrapper');
        $('.selected-file').html('');
        $('form#addMerchantFrm').attr('action', updateUrl);
        $("form#addMerchantFrm [name='_method']").attr('value', 'PUT');

        var callParams  = {};
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

                console.log('user', user);

                $('#addMerchantFrm #id').val(user.id);
                $('#addMerchantFrm #first_name').val(user.first_name);
                $('#addMerchantFrm #last_name').val(user.last_name);
                $('#addMerchantFrm #email').val(user.email);
                $('#addMerchantFrm #user_type').val(user.user_type).change();
                $('#addMerchantFrm #mobile_no').val(user.mobile_no);
                $('#addMerchantFrm #avatar').val(user.avatar);
                // Hide account status on edit - status not editable from edit form
                $('#addMerchantFrm #account_status').closest('.mb-3').hide();
                if(user.avatar){
                    getChosenFilesCount();
                    showSelectedFilePreviewOnLoad();
                }
            }
        }, function (err, type, httpStatus) {

        });

    });

    // change merchant's status
    $('body').on('click', '.changeMerchantStatus', function(){
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
                callParams.url  = "{{ route('admin.merchants.statusUpdate', ['id' => ':id']) }}".replace(':id', userId);
                callParams.data = {
                    _token : "{{ csrf_token() }}"
                };
                ajaxCall(callParams, function (result) {
                    toast(result.message);
                    getDataList();
                }, function (err, type, httpStatus) {
                    showFormError(err, '#addMerchantFrm');
                });
            }
        });
    });

    // delete merchant
    $('body').on('click', '.deleteMerchant', function(){
        let userId = parseInt($(this).data("id"));

        let actionUrl = $(this).data('url');
        swConfirm({
            title: "Do you want to delete this user?",
            confirmButtonText: "Yes",
            showDenyButton: true,
        }, (result) => {
            if (result.isConfirmed) {
                var callParams  = {};
                callParams.type = "POST";
                callParams.url  = actionUrl;
                callParams.data = {
                    id: userId,
                    _method:"DELETE",
                    _token : "{{ csrf_token() }}"
                };
                ajaxCall(callParams, function (result) {
                    toast(result.message);
                    getDataList();
                }, function (err, type, httpStatus) {
                    showFormError(err, '#addMerchantFrm');
                });
            }
        });
    });
    var offcanvasBottom = document.getElementById('offcanvasBottom')
    var secondoffcanvas = document.getElementById('addMerchantSideBar')

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
