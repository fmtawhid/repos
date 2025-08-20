<script>
    'use strict';

    // load Template Categories
    function getDataList() {
        var callParams      = {};
        callParams.type     = "GET";
        callParams.dataType = "html";
        callParams.url      = "{{ route('admin.faqs.index') }}" + (gFilterObj ? '?' + $.param(gFilterObj) : '');
        callParams.data     = '';
        ajaxCall(callParams, function(result) {
            $('tbody').empty().html(result);
            feather.replace();
        }, function onErrorData(err, type, httpStatus) {});
    }

    // handle offcanvas for adding an user
    $('body').on('click', '#addFormOffCanvas', function() {
        $('#addFAQForm .offcanvas-title').text("{{ localize('Add FAQ') }}");
        resetFormErrors('form#addFAQForm');
        resetForm('form#addFAQForm');
        showElement('.password_wrapper');
        $('form#addFAQForm').attr('action', "{{ route('admin.faqs.store') }}");
        $("form#addFAQForm [name='_method']").attr('value', 'POST');
    })

    // search
    $('body').on('click', '#searchBtn', function() {
        var search = $('#f_search').val();

        var is_active = $('#f_is_active :selected').val();

        gFilterObj.search = search;
        loadingInTable("tbody",{
            colSpan: 11,
            prop: false,
        });

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

    // add FAQ
    $("#addFAQForm").submit(function(e) {
        e.preventDefault();
        resetFormErrors('form#addFAQForm');
        loading('#frmActionBtn', 'Saving...');

        let id = $("#addFAQForm #id").val();
        let callParams = {};

        callParams.type = "POST";
        callParams.url = $("form#addFAQForm").attr("action");
        callParams.data = $("form#addFAQForm").serialize();

        ajaxCall(callParams, function(result) {
            resetLoading('#frmActionBtn', 'Save');
            id ? toast(result.message) : showSuccess(result.message);
            if (!id) { // only for save
                resetForm('form#addFAQForm');
            }
            getDataList();
            $('#addFAQFormSidebar').offcanvas('hide');
        }, function(err, type, httpStatus) {
            showFormError(err, '#addFAQForm');
            resetLoading('#frmActionBtn', 'Save');
        });

        return false;
    });

    // edit user
    $(document).on('click', '.editIcon', function() {
        let userId = parseInt($(this).data("id"));
        let actionUrl = $(this).data("update-url");
        let editActionUrl = $(this).data("url");

        $('#addFAQForm .offcanvas-title').text("{{ localize('Update FAQ') }}");
        $('#addFAQFormSidebar').offcanvas('show');

        resetForm('form#addFAQForm');
        resetFormErrors('form#addFAQForm');
        hideElement('.password_wrapper');
        $('form#addFAQForm').attr('action', actionUrl);
        $("form#addFAQForm [name='_method']").attr('value', 'PUT');
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
                    let FAQ = result.data;
                    $('#addFAQForm #_method').val("PUT");
                    $('#addFAQForm #id').val(FAQ.id);
                    $('#addFAQForm #question').val(FAQ.question);
                    $('#addFAQForm #answer').val(FAQ.answer);
                    $('#addFAQForm #is_active').val(FAQ.is_active).change();
                }
            },
            function(err, type, httpStatus) {

            });

    });


    getDataList();
</script>
