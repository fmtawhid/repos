<script>
    'use strict';
    // language flag select2
    $(".country-flag-select").select2({
        dir: '{{ @$localLang->is_rtl == 1 ? 'rtl' : 'ltr' }}',
        templateResult: countryCodeFlag,
        templateSelection: countryCodeFlag,
        escapeMarkup: function(m) {
            return m;
        },
    });

    function countryCodeFlag(state) {
        var flagName = $(state.element).data("flag");
        if (!flagName) return state.text;
        return (
            "<div class='d-flex align-items-center'><img class='flag me-2' src='" + flagName +
            "' height='14' />" + state.text + "</div>"
        );
    }
    // load Template Categories
    function getDataList() {
        var callParams = {};
        callParams.type = "GET";
        callParams.dataType = "html";
        callParams.url = "{{ route('admin.languages.index') }}" + (gFilterObj ? '?' + $.param(gFilterObj) : '');
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
    $('body').on('click', '#addLanguageOffCanvas', function() {
        $('#addLanguageForm .offcanvas-title').text("{{ localize('Add New Language') }}");
        resetFormErrors('form#addLanguageForm');
        resetForm('form#addLanguageForm');
        $('form#addLanguageForm').attr('action', "{{ route('admin.languages.store') }}");
        $("form#addLanguageForm [name='_method']").attr('value', 'POST');
    })

    // add Language
    $("#addLanguageForm").submit(function(e) {
        e.preventDefault();
        resetFormErrors('form#addLanguageForm');
        loading('#frmActionBtn', 'Saving...');

        let id = $("#addLanguageForm #id").val();
        let callParams = {};
        callParams.type = "POST";
        callParams.url = $("form#addLanguageForm").attr("action");
        callParams.data = $("#addLanguageForm").serialize();

        ajaxCall(callParams, function(result) {
            resetLoading('#frmActionBtn', 'Save');
            id ? toast(result.message) : showSuccess(result.message);
            if (!id) { // only for save
                resetForm('form#addLanguageForm');
            }
            getDataList();
            id ? $('#addLanguageFormSidebar').offcanvas('hide') : '';
        }, function(err, type, httpStatus) {
            showFormError(err, '#addLanguageForm');
            resetLoading('#frmActionBtn', 'Save');
        });

        return false;
    });

    // edit user
    $(document).on('click', '.editIcon', function() {
        let userId = parseInt($(this).data("id"));
        let actionUrl = $(this).data("update-url");
        let editActionUrl = $(this).data("url");

        $('#addLanguageForm .offcanvas-title').text("{{ localize('Update Language') }}");
        $('#addLanguageFormSidebar').offcanvas('show');

        resetForm('form#addLanguageForm');
        resetFormErrors('form#addLanguageForm');

        $('form#addLanguageForm').attr('action', actionUrl);
        $("form#addLanguageForm [name='_method']").attr('value', 'PUT');
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
                    let language = result.data;
                    $('#addLanguageForm #id').val(language.id);
                    $('#addLanguageForm #name').val(language.name);
                    $('#addLanguageForm #code').val(language.code);
                    $('#addLanguageForm #flag').val(language.flag).change();
                    $('#addLanguageForm #flag').val(language.flag).change();
                    $('#addLanguageForm #is_rtl').val(language.is_rtl).change();
                }
            },
            function(err, type, httpStatus) {

            });

    });


    getDataList();
</script>
