<script>
    'use strict';

    // load Template Categories
    function getDataList() {
        var callParams      = {};
        callParams.type     = "GET";
        callParams.dataType = "html";
        callParams.url      = "{{ route('admin.support-priorities.index') }}" + (gFilterObj ? '?' + $.param(gFilterObj) : '');
        callParams.data     = '';
        ajaxCall(callParams, function(result) {
            $('tbody').empty().html(result);
            feather.replace();
        }, function onErrorData(err, type, httpStatus) {});
    }

    // handle offcanvas for adding an user
    $('body').on('click', '#addPriorityFormOffCanvas', function() {
        $('#addPriorityForm .offcanvas-title').text("{{ localize('Add Priority') }}");
        resetFormErrors('form#addPriorityForm');
        resetForm('form#addPriorityForm');
        showElement('.password_wrapper');
        $('form#addPriorityForm').attr('action', "{{ route('admin.support-priorities.store') }}");
        $("form#addPriorityForm [name='_method']").attr('value', 'POST');
    })

    // search
    $('body').on('click', '#searchBtn', function() {
        var search = $('#f_search').val();
        var is_active = $('#f_is_active :selected').val();
        loadingInTable("tbody",{
            colSpan: 11,
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

    // add Priority
    $("#addPriorityForm").submit(function(e) {
        e.preventDefault();
        resetFormErrors('form#addPriorityForm');
        loading('#frmActionBtn', 'Saving...');

        let id = $("#addPriorityForm #id").val();
        let callParams = {};

        callParams.type = "POST";
        callParams.url = $("form#addPriorityForm").attr("action");
        callParams.data = $("form#addPriorityForm").serialize();

        ajaxCall(callParams, function(result) {
            resetLoading('#frmActionBtn', 'Save');
            id ? toast(result.message) : showSuccess(result.message);
            if (!id) { // only for save
                resetForm('form#addPriorityForm');
            }
            getDataList();
            $('#addPriorityFormSidebar').offcanvas('hide');
        }, function(err, type, httpStatus) {
            showFormError(err, '#addPriorityForm');
            resetLoading('#frmActionBtn', 'Save');
        });

        return false;
    });

    // edit user
    $(document).on('click', '.editIcon', function() {
        let userId = parseInt($(this).data("id"));
        let actionUrl = $(this).data("update-url");
        let editActionUrl = $(this).data("url");

        $('#addPriorityForm .offcanvas-title').text("{{ localize('Update Priority') }}");
        $('#addPriorityFormSidebar').offcanvas('show');

        resetForm('form#addPriorityForm');
        resetFormErrors('form#addPriorityForm');
        hideElement('.password_wrapper');
        $('form#addPriorityForm').attr('action', actionUrl);
        $("form#addPriorityForm [name='_method']").attr('value', 'PUT');
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
                    let priority = result.data;
                    $('#addPriorityForm #_method').val("PUT");
                    $('#addPriorityForm #id').val(priority.id);
                    $('#addPriorityForm #name').val(priority.name);
                    $('#addPriorityForm #is_active').val(priority.is_active).change();
                }
            },
            function(err, type, httpStatus) {

            });

    });


    getDataList();
</script>
