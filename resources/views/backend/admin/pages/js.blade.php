<script>
    'use strict';

    // load Template Categories
    function getDataList() {
        var callParams = {};
        callParams.type = "GET";
        callParams.dataType = "html";
        callParams.url = "{{ route('admin.pages.index') }}" + (gFilterObj ? '?' + $.param(gFilterObj) : '');
        callParams.data = '';

        ajaxCall(callParams, function(result) {
            $('tbody').empty().html(result);
            feather.replace();
        }, function onErrorData(err, type, httpStatus) {});
    }

    // handle offcanvas for adding an user
    $('body').on('click', '#addPageFormOffCanvas', function() {
        $('#addPageForm .offcanvas-title').text("{{ localize('Add Page') }}");
        resetFormErrors('form#addPageForm');
        resetForm('form#addPageForm');
        removeAllImage();
        $('#meta_image').val('');
        $('form#addPageForm').attr('action', "{{ route('admin.pages.store') }}");
        $("form#addPageForm [name='_method']").attr('value', 'POST');
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

    // add Page
    $("#addPageForm").submit(function(e) {
        e.preventDefault();
        resetFormErrors('form#addPageForm');
        loading('#frmActionBtn', 'Saving...');

        let id = $("#addPageForm #id").val();
        let callParams = {};

        callParams.type = "POST";
        callParams.url = $("form#addPageForm").attr("action");
        callParams.data = $("form#addPageForm").serialize();

        ajaxCall(callParams, function(result) {
            resetLoading('#frmActionBtn', 'Save');
            id ? toast(result.message) : showSuccess(result.message);
            if (!id) { // only for save
                resetForm('form#addPageForm');
            }
            getDataList();
           $('#addPageFormSidebar').offcanvas('hide');
        }, function(err, type, httpStatus) {
            showFormError(err, '#addPageForm');
            resetLoading('#frmActionBtn', 'Save');
        });

        return false;
    });

    // edit user
    $(document).on('click', '.editIcon', function() {
        let userId = parseInt($(this).data("id"));
        let actionUrl = $(this).data("update-url");
        let editActionUrl = $(this).data("url");

        $('#addPageForm .offcanvas-title').text("{{ localize('Update Page') }}");
        $('#addPageFormSidebar').offcanvas('show');

        resetForm('form#addPageForm');
        resetFormErrors('form#addPageForm');
        hideElement('.password_wrapper');
        $('form#addPageForm').attr('action', actionUrl);
        $("form#addPageForm [name='_method']").attr('value', 'PUT');
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
                    let page = result.data;
                    $('#addPageForm #_method').val("PUT");
                    $('#addPageForm #id').val(page.id);
                    $('#addPageForm #title').val(page.title);
                    $('#editor').summernote('code', page.content);
                    $('#addPageForm #meta_title').val(page.meta_title);
                    $('#addPageForm #meta_image').val(page.meta_image);
                    $('#addPageForm #meta_description').val(page.meta_description);
                    $('#addPageForm #is_active').val(page.is_active).change();
                    getChosenFilesCount();
                    showSelectedFilePreviewOnLoad();
                }
            },
            function(err, type, httpStatus) {

            });

    });

    getDataList();

    var offcanvasBottom = document.getElementById('offcanvasBottom')
    var secondoffcanvas = document.getElementById('addPageFormSidebar')

    offcanvasBottom.addEventListener('hidden.bs.offcanvas', function() {
        var bsOffcanvas2 = new bootstrap.Offcanvas(secondoffcanvas)
        bsOffcanvas2.show()
    })
</script>
