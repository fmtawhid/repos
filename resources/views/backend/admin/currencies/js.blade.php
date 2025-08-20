<script>
    'use strict';
    // language flag select2

    // load Template Categories
    function getDataList() {
        var callParams = {};
        callParams.type = "GET";
        callParams.dataType = "html";
        callParams.url = "{{ route('admin.currencies.index') }}" + (gFilterObj ? '?' + $.param(gFilterObj) : '');
        callParams.data = '';
        ajaxCall(callParams, function(result) {
            $('tbody').empty().html(result);
            feather.replace();
        }, function onErrorData(err, type, httpStatus) {});
    }

    // search
    $('body').on('click', '#searchBtn', function() {
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

    // handle offcanvas for adding an user
    $('body').on('click', '#addCurrencyOffCanvas', function() {
        $('#addCurrencyForm .offcanvas-title').text("{{ localize('Add New Currency') }}");
        resetFormErrors('form#addCurrencyForm');
        resetForm('form#addCurrencyForm');
        $('form#addCurrencyForm').attr('action', "{{ route('admin.currencies.store') }}");
        $("form#addCurrencyForm [name='_method']").attr('value', 'POST');
    })

    // add Currency
    $("#addCurrencyForm").submit(function(e) {
        e.preventDefault();
        resetFormErrors('form#addCurrencyForm');
        loading('#frmActionBtn', 'Saving...');

        let id = $("#addCurrencyForm #id").val();
        let callParams = {};
        callParams.type = "POST";
        callParams.url = $("form#addCurrencyForm").attr("action");
        callParams.data = $("#addCurrencyForm").serialize();

        ajaxCall(callParams, function(result) {
            resetLoading('#frmActionBtn', 'Save');
            id ? toast(result.message) : showSuccess(result.message);
            if (!id) { // only for save
                resetForm('form#addCurrencyForm');
            }
            getDataList();
            id ? $('#addCurrencyFormSidebar').offcanvas('hide') : '';
        }, function(err, type, httpStatus) {
            showFormError(err, '#addCurrencyForm');
            resetLoading('#frmActionBtn', 'Save');
        });

        return false;
    });

    // edit user
    $(document).on('click', '.editIcon', function() {
        let userId = parseInt($(this).data("id"));
        let actionUrl = $(this).data("update-url");
        let editActionUrl = $(this).data("url");

        $('#addCurrencyForm .offcanvas-title').text("{{ localize('Update Currency') }}");
        $('#addCurrencyFormSidebar').offcanvas('show');

        resetForm('form#addCurrencyForm');
        resetFormErrors('form#addCurrencyForm');

        $('form#addCurrencyForm').attr('action', actionUrl);
        $("form#addCurrencyForm [name='_method']").attr('value', 'PUT');
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
                    let currency = result.data;
                    $('#addCurrencyForm #id').val(currency.id);
                    $('#addCurrencyForm #name').val(currency.name);
                    $('#addCurrencyForm #code').val(currency.code);
                    $('#addCurrencyForm #rate').val(currency.rate);
                    $('#addCurrencyForm #symbol').val(currency.symbol);
                    $('#addCurrencyForm #alignment').val(currency.alignment).change();
                    $('#addCurrencyForm #is_active').val(currency.is_active).change();
                }
            },
            function(err, type, httpStatus) {

            });

    });


    getDataList();
</script>
