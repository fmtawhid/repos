<script>
    'use strict';

    // load Template Categories
    function getDataList() {
        var callParams      = {};
        callParams.type     = "GET";
        callParams.dataType = "html";
        callParams.url      = "{{ route('admin.tags.index') }}" + (gFilterObj ? '?' + $.param(gFilterObj) : '');
        callParams.data     = '';
        ajaxCall(callParams, function(result) {
            $('tbody').empty().html(result);
            feather.replace();
        }, function onErrorData(err, type, httpStatus) {});
    }

    // handle offcanvas for adding an user
    $('body').on('click', '#addTagFormOffCanvas', function() {
        $('#addTagForm .offcanvas-title').text("{{ localize('Add Tag') }}");
        resetFormErrors('form#addTagForm');
        resetForm('form#addTagForm');
        $('form#addTagForm').attr('action', "{{ route('admin.tags.store') }}");
        $("form#addTagForm [name='_method']").attr('value', 'POST');
    })

    // search
    $('body').on('click', '#searchBtn', function() {
        var search = $('#f_search').val();
        var is_active = $('#f_is_active :selected').val();

        gFilterObj.search = search;
        loadingInTable("#tags-list",{
            colSpan: 5,
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

    // add Tag
    $("#addTagForm").submit(function(e) {
        e.preventDefault();
        resetFormErrors('form#addTagForm');
        loading('#frmActionBtn', 'Saving...');
        loading('.generateContents', 'Generating...');

        let id = $("#addTagForm #id").val();
        let callParams = {};

        callParams.type = "POST";
        callParams.url = $("form#addTagForm").attr("action");
        callParams.data = $("form#addTagForm").serialize();

        ajaxCall(callParams, function(result) {
            resetLoading('#frmActionBtn', 'Save');
            id ? toast(result.message) : showSuccess(result.message);
            if (!id) { // only for save
                resetForm('form#addTagForm');
            }
            getDataList();
            $('#addTagFormSidebar').offcanvas('hide');
        }, function(err, type, httpStatus) {
            showFormError(err, '#addTagForm');
            resetLoading('#frmActionBtn', 'Save');
        });

        return false;
    });

    // edit user
    $(document).on('click', '.editIcon', function() {
        let userId = parseInt($(this).data("id"));
        let actionUrl = $(this).data("update-url");
        let editActionUrl = $(this).data("url");

        $('#addTagForm .offcanvas-title').text("{{ localize('Update Tag') }}");
        $('#addTagFormSidebar').offcanvas('show');

        resetForm('form#addTagForm');
        resetFormErrors('form#addTagForm');
        hideElement('.password_wrapper');
        $('form#addTagForm').attr('action', actionUrl);
        $("form#addTagForm [name='_method']").attr('value', 'PUT');
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
                    let tag = result.data;
                    $('#addTagForm #_method').val("PUT");
                    $('#addTagForm #id').val(tag.id);
                    $('#addTagForm #name').val(tag.name);
                    $('#addTagForm #is_active').val(tag.is_active).change();
                }
            },
            function(err, type, httpStatus) {

            });
    });

    getDataList();
</script>
@if(isModuleActive('WordpressBlog'))
    <script>         
        $(document).on('click', '#syncAllTags', function(e) {
            e.preventDefault();
            $('#syncText').html('Syncing.......');
            callParams = {};
            callParams.type = "GET";
            callParams.url = "{{route('admin.sync.all.tags')}}";
            ajaxCall(callParams, function(result) {
                $('#syncText').html("{{localize('Sync to wordpress')}}");
                resetLoading('#frmActionBtn', 'Save');
                id ? toast(result.message) : showSuccess(result.message);                
                getDataList();
              
            }, function(err, type, httpStatus) {
                showFormError(err, '#addTagForm');
                resetLoading('#frmActionBtn', 'Save');
            });
            return false;
        });
    </script>
@endif