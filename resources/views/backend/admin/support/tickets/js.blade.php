<script>
    'use strict';

    // load Template Categories
    function getDataList() {
        var callParams      = {};
        callParams.type     = "GET";
        callParams.dataType = "html";
        callParams.url      = "{{ route('admin.support-tickets.index') }}" + (gFilterObj ? '?' + $.param(gFilterObj) : '');
        callParams.data     = '';
        ajaxCall(callParams, function(result) {
            $('#listOfTicket').empty().html(result);
            feather.replace();
        }, function onErrorData(err, type, httpStatus) {});
    }

    // handle offcanvas for adding an user
    $('body').on('click', '#addTicketFormOffCanvas', function() {
        $('#addTicketForm .offcanvas-title').text("{{ localize('Add Ticket') }}");
        resetFormErrors('form#addTicketForm');
        resetForm('form#addTicketForm');
        showElement('.password_wrapper');
        $('form#addTicketForm').attr('action', "{{ route('admin.support-tickets.store') }}");
        $("form#addTicketForm [name='_method']").attr('value', 'POST');
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

    // add Ticket
    $("#addTicketForm").submit(function(e) {
        e.preventDefault();
        resetFormErrors('form#addTicketForm');
        loading('#frmActionBtn', 'Saving...');

        let id = $("#addTicketForm #id").val();
        let callParams = {};

        callParams.type = "POST";
        callParams.url = $("form#addTicketForm").attr("action");
        callParams.data = new FormData($("form#addTicketForm")[0]);
        callParams.processData = false;
        callParams.contentType = false;

        ajaxCall(callParams, function(result) {
            resetLoading('#frmActionBtn', 'Save');
            id ? toast(result.message) : showSuccess(result.message);
            if (!id) { // only for save
                resetForm('form#addTicketForm');
            }
            getDataList();
            $('#addTicketFormSidebar').offcanvas('hide');
        }, function(err, type, httpStatus) {
            showFormError(err, '#addTicketForm');
            resetLoading('#frmActionBtn', 'Save');
        });

        return false;
    });
    // add Ticket
    $("#replyTicketForm").submit(function(e) {
        e.preventDefault();
        alert('ok');
        resetFormErrors('form#replyTicketForm');
        loading('#frmActionBtn', 'Saving...');

        let id = $("#replyTicketForm #id").val();
        let callParams = {};

        callParams.type = "POST";
        callParams.url = $("form#replyTicketForm").attr("action");
        callParams.data = $("form#replyTicketForm").serialize();

        ajaxCall(callParams, function(result) {
            resetLoading('#frmActionBtn', 'Reply Ticket');
            toast(result.message);
         
        }, function(err, type, httpStatus) {
            showFormError(err, '#addTicketForm');
            resetLoading('#frmActionBtn', 'Reply Ticket');
        });

        return false;
    });

    // edit user
    $(document).on('click', '.editIcon', function() {
        let userId = parseInt($(this).data("id"));
        let actionUrl = $(this).data("update-url");
        let editActionUrl = $(this).data("url");

        $('#addTicketForm .offcanvas-title').text("{{ localize('Update Ticket') }}");
        $('#addTicketFormSidebar').offcanvas('show');

        resetForm('form#addTicketForm');
        resetFormErrors('form#addTicketForm');
        hideElement('.password_wrapper');
        $('form#addTicketForm').attr('action', actionUrl);
        $("form#addTicketForm [name='_method']").attr('value', 'PUT');
        $("#frmActionBtn").html('{{ localize('update') }}');
        let callParams = {};
        callParams.type = "GET";
        callParams.url = editActionUrl;
        callParams.data = "";
        ajaxCall(callParams, function(result) {
                if (result.data) {
                    let tag = result.data;
                    $('#addTicketForm #_method').val("PUT");
                    $('#addTicketForm #id').val(tag.id);
                    $('#addTicketForm #name').val(tag.name);
                    $('#addTicketForm #is_active').val(tag.is_active).change();
                }
            },
            function(err, type, httpStatus) {

            });

    });


    getDataList();
</script>
