<script>
    'use strict';

    // load Template Categories
    function getDataList() {
        var callParams      = {};
        callParams.type     = "GET";
        callParams.dataType = "html";
        callParams.url      = "{{ route('admin.support-categories.index') }}" + (gFilterObj ? '?' + $.param(gFilterObj) : '');
        callParams.data     = '';
        ajaxCall(callParams, function(result) {
            $('tbody').empty().html(result);
            feather.replace();
        }, function onErrorData(err, type, httpStatus) {});
    }

    // handle offcanvas for adding an user
    $('body').on('click', '#addCategoryFormOffCanvas', function() {
        $('#addCategoryForm .offcanvas-title').text("{{ localize('Add Support Category') }}");
        resetFormErrors('form#addCategoryForm');
        resetForm('form#addCategoryForm');
        showElement('.password_wrapper');
        $('form#addCategoryForm').attr('action', "{{ route('admin.support-categories.store') }}");
        $("form#addCategoryForm [name='_method']").attr('value', 'POST');
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

    // add Category
    $("#addCategoryForm").submit(function(e) {
        e.preventDefault();
        resetFormErrors('form#addCategoryForm');
        loading('#frmActionBtn', 'Saving...');

        let id = $("#addCategoryForm #id").val();
        let callParams = {};

        callParams.type = "POST";
        callParams.url = $("form#addCategoryForm").attr("action");
        callParams.data = $("form#addCategoryForm").serialize();

        ajaxCall(callParams, function(result) {
            resetLoading('#frmActionBtn', 'Save');
            id ? toast(result.message) : showSuccess(result.message);
            if (!id) { // only for save
                resetForm('form#addCategoryForm');
            }
            getDataList();
           $('#addCategoryFormSidebar').offcanvas('hide');
        }, function(err, type, httpStatus) {
            showFormError(err, '#addCategoryForm');
            resetLoading('#frmActionBtn', 'Save');
        });

        return false;
    });

    // edit user
    $(document).on('click', '.editIcon', function() {
        let userId = parseInt($(this).data("id"));
        let actionUrl = $(this).data("update-url");
        let editActionUrl = $(this).data("url");

        $('#addCategoryForm .offcanvas-title').text("{{ localize('Update Category') }}");
        $('#addCategoryFormSidebar').offcanvas('show');

        resetForm('form#addCategoryForm');
        resetFormErrors('form#addCategoryForm');
        hideElement('.password_wrapper');
        $('form#addCategoryForm').attr('action', actionUrl);
        $("form#addCategoryForm [name='_method']").attr('value', 'PUT');
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
                    let Category = result.data;
                    $('#addCategoryForm #_method').val("PUT");
                    $('#addCategoryForm #id').val(Category.id);
                    $('#addCategoryForm #name').val(Category.name);
                    $('#addCategoryForm #is_active').val(Category.is_active).change();
                }
            },
            function(err, type, httpStatus) {

            });

    });


    getDataList();
</script>
