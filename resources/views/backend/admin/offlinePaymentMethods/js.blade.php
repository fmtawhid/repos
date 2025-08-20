<script>
    'use strict';

    // load Template Categories
    function getDataList() {
        var callParams      = {};
        callParams.type     = "GET";
        callParams.dataType = "html";
        callParams.url      = "{{ route('admin.offline-payment-methods.index') }}" + (gFilterObj ? '?' + $.param(gFilterObj) : '');
        callParams.data     = '';
        ajaxCall(callParams, function(result) {
            $('tbody').empty().html(result);
            feather.replace();
        }, function onErrorData(err, type, httpStatus) {});
    }

    // handle offcanvas for adding an user
    $('body').on('click', '#addOfflinePaymentMethodFormOffCanvas', function() {
        $('#addOfflinePaymentMethodForm .offcanvas-title').text("{{ localize('Add Offline Payment Method') }}");
        resetFormErrors('form#addOfflinePaymentMethodForm');
        resetForm('form#addOfflinePaymentMethodForm');
        $('form#addOfflinePaymentMethodForm').attr('action', "{{ route('admin.offline-payment-methods.store') }}");
        $("form#addOfflinePaymentMethodForm [name='_method']").attr('value', 'POST');
    })

    // search
    $('body').on('click', '#searchBtn', function(e) {
        e.preventDefault();
        var search = $('#f_search').val();
        var is_active = $('#f_is_active :selected').val();
        loadingInTable("tbody",{
            colSpan: 5,
            prop: false,
        });
        gFilterObj.search = search;

        if (is_active === '0' || is_active === '1') {
            gFilterObj.is_active = is_active;
        } else if (gFilterObj.hasOwnProperty('is_active')) {
            delete gFilterObj.is_active;
        }


        if (gFilterObj.hasOwnProperty('page')) {
            delete gFilterObj.page;
        }

        getDataList();
    });

    // add Offline Payment Method
    $("#addOfflinePaymentMethodForm").submit(function(e) {
        e.preventDefault();
        resetFormErrors('form#addOfflinePaymentMethodForm');
        loading('#frmActionBtn', 'Saving...');

        let id = $("#addOfflinePaymentMethodForm #id").val();
        let callParams = {};

        callParams.type = "POST";
        callParams.url = $("form#addOfflinePaymentMethodForm").attr("action");
        callParams.data = new FormData($("#addOfflinePaymentMethodForm")[0]);
        callParams.processData  = false;
        callParams.contentType  = false;
        ajaxCall(callParams, function(result) {
            resetLoading('#frmActionBtn', 'Save');
            id ? toast(result.message) : showSuccess(result.message);
            if (!id) { // only for save
                resetForm('form#addOfflinePaymentMethodForm');
            }
            getDataList();
            $('#addOfflinePaymentMethodFormSidebar').offcanvas('hide');
        }, function(err, type, httpStatus) {
            showFormError(err, '#addOfflinePaymentMethodForm');
            resetLoading('#frmActionBtn', 'Save');
            toast(err.responseJSON.message, 'error');
        });

        return false;
    });

    // edit user
    $(document).on('click', '.editIcon', function() {
        let userId = parseInt($(this).data("id"));
        let actionUrl = $(this).data("update-url");
        let editActionUrl = $(this).data("url");

        $('#addOfflinePaymentMethodForm .offcanvas-title').text("{{ localize('Update Offline Payment Method') }}");
        $('#addOfflinePaymentMethodFormSidebar').offcanvas('show');

        resetForm('form#addOfflinePaymentMethodForm');
        resetFormErrors('form#addOfflinePaymentMethodForm');
        hideElement('.password_wrapper');
        $('form#addOfflinePaymentMethodForm').attr('action', actionUrl);
        $("form#addOfflinePaymentMethodForm [name='_method']").attr('value', 'PUT');
        $("#frmActionBtn").html('{{ localize('update') }}');
        let callParams = {};
        callParams.type = "GET";
        callParams.url = editActionUrl;
        callParams.data = "";
        loadingInContent('#loader', 'loading...');
        hideElement('.offcanvas-body');
        ajaxCall(callParams, function(result) {
            resetLoading('#loader', '');
            showElement('.offcanvas-body');
                if (result.data) {
                    let method = result.data;
                    $('#addOfflinePaymentMethodForm #_method').val("PUT");
                    $('#addOfflinePaymentMethodForm #id').val(method.id);
                    $('#addOfflinePaymentMethodForm #name').val(method.name);
                    $('#addOfflinePaymentMethodForm #description').val(method.description);
                    $('#addOfflinePaymentMethodForm #is_active').val(method.is_active).change();
                }
            },
            function(err, type, httpStatus) {

            });

    });
    getDataList();
</script>
