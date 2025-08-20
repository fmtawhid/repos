<script>
    'use strict';

    // load Template Categories
    function getDataList() {
        var callParams      = {};
        callParams.type     = "GET";
        callParams.dataType = "html";
        callParams.url      = "{{ route('admin.client-feedbacks.index') }}" + (gFilterObj ? '?' + $.param(gFilterObj) : '');
        callParams.data     = '';

        ajaxCall(callParams, function(result) {
            $('tbody').empty().html(result);
            feather.replace();
        }, function onErrorData(err, type, httpStatus) {});
    }

    // handle offcanvas for adding an user
    $('body').on('click', '#addClientFeedbackFormOffCanvas', function() {
        $('#addClientFeedbackForm .offcanvas-title').text("{{ localize('Add Template Category') }}");
        resetFormErrors('form#addClientFeedbackForm');
        resetForm('form#addClientFeedbackForm');
        showElement('.password_wrapper');
        $('form#addClientFeedbackForm').attr('action', "{{ route('admin.client-feedbacks.store') }}");
        $("form#addClientFeedbackForm [name='_method']").attr('value', 'POST');
    })

    // search
    $('body').on('click', '#searchBtn', function(e) {
        e.preventDefault();
        var search    = $('#f_search').val();
        var is_active = $('#f_is_active: selected').val();
        loadingInTable("tbody",{
            colSpan: 8,
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

    // add Template Category
    $("#addClientFeedbackForm").submit(function(e) {
        e.preventDefault();
        resetFormErrors('form#addClientFeedbackForm');
        loading('#frmActionBtn', 'Saving...');

        let callParams = {};
        let id         = $("#addClientFeedbackForm #id").val();

        callParams.type        = "POST";
        callParams.url         = $("form#addClientFeedbackForm").attr("action");
        callParams.data        = new FormData($("#addClientFeedbackForm")[0]);
        callParams.processData = false;
        callParams.contentType =  false;
        ajaxCall(callParams, function(result) {
            resetLoading('#frmActionBtn', 'Save');
            id ? toast(result.message) : showSuccess(result.message);
            if (!id) { // only for save
                resetForm('form#addClientFeedbackForm');
            }
            getDataList();
            $('#addClientFeedbackFormSidebar').offcanvas('hide');
        }, function(err, type, httpStatus) {
            showFormError(err, '#addClientFeedbackForm');
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

        $('#addClientFeedbackForm .offcanvas-title').text("{{ localize('Update Template Category') }}");
        $('#addClientFeedbackFormSidebar').offcanvas('show');
        $('.selected-file').html('');
        resetForm('form#addClientFeedbackForm');
        resetFormErrors('form#addClientFeedbackForm');
        hideElement('.password_wrapper');
        $('form#addClientFeedbackForm').attr('action', actionUrl);
        $("form#addClientFeedbackForm [name='_method']").attr('value', 'PUT');
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
                    let clientFeedback = result.data;
                    $('#addClientFeedbackForm #_method').val("PUT");
                    $('#addClientFeedbackForm #id').val(clientFeedback.id);
                    $('#addClientFeedbackForm #avatar').val(clientFeedback.avatar);
                    $('#addClientFeedbackForm #name').val(clientFeedback.name);
                    $('#addClientFeedbackForm #designation').val(clientFeedback.designation);
                    $('#addClientFeedbackForm #heading').val(clientFeedback.heading);
                    $('#addClientFeedbackForm #rating').val(clientFeedback.rating).change();
                    $('#addClientFeedbackForm #review').val(clientFeedback.review);
                    if(clientFeedback.avatar){
                        getChosenFilesCount();
                        showSelectedFilePreviewOnLoad();
                    }
                }
            },
            function(err, type, httpStatus) {

            });

    });
    var offcanvasBottom = document.getElementById('offcanvasBottom')
    var secondoffcanvas = document.getElementById('addClientFeedbackFormSidebar')

    offcanvasBottom.addEventListener('hidden.bs.offcanvas', function() {
        var bsOffcanvas2 = new bootstrap.Offcanvas(secondoffcanvas)
        bsOffcanvas2.show()
    })
    getDataList();
    $(document).ready(function() {
        getChosenFilesCount();
        showSelectedFilePreviewOnLoad();
    });
</script>
