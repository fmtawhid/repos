<script>
    'use strict';

    // load menus
    function getDataList() {
        var callParams      = {};
        callParams.type     = "GET";
        callParams.dataType = "html";
        callParams.url      = "{{ route('admin.menus.index') }}" + (gFilterObj ? '?' + $.param(gFilterObj) : '');
        callParams.data     = '';
        ajaxCall(callParams, function (result) {
            $('tbody').empty().html(result);
            feather.replace();
        }, function onErrorData(err, type, httpStatus) {});
    }

    // handle offcanvas for adding an Menu
    $('body').on('click', '#addMenuBtnForOffCanvas', function(){
        $('#addMenuFrm .offcanvas-title').text("{{ localize('Add New Menu') }}");
        resetFormErrors('form#addMenuFrm');
        resetForm('form#addMenuFrm');
        showElement('.password_wrapper');
        $('form#addMenuFrm input:hidden[name=_method]').val('POST');
        $('form#addMenuFrm').attr('action', "{{ route('admin.menus.store') }}");
    })

    // add Menu
    $("#addMenuFrm").submit(function(e) {
        e.preventDefault();

        resetFormErrors('form#addMenuFrm');
        loading('#addMenuBtn', 'Saving...');

        let id = $("#addMenuFrm #id").val();

        var callParams  = {};
        callParams.type = "POST";
        callParams.url  = $("form#addMenuFrm").attr("action");
        callParams.data = new FormData($('#addMenuFrm')[0]);
        callParams.processData = false;
        callParams.contentType = false;

        ajaxCall(callParams, function (result) {
            resetLoading('#addMenuBtn', 'Save');
            showSuccess(result.message);

           if(!id) {
                resetForm('form#addMenuFrm');
            }

            toast(result.message);
            getDataList();
            $('#addMenuSideBar').offcanvas('hide');
        }, function (err, type, httpStatus) {
            showFormError(err, '#addMenuFrm');
            resetLoading('#addMenuBtn', 'Save');
        });

        return false;
    });

    // edit Menu
    $('body').on('click', '.editIcon', function(){
        let menuId = parseInt($(this).data("id"));
        let actionUrl = "{{ route('admin.menus.edit', ['menu' => ':id']) }}".replace(':id', menuId);
        let updateUrl = "{{ route('admin.menus.update', ['menu' => ':id']) }}".replace(':id', menuId);
        // let actionUrl = "admin/update-admin/"+menuId;

        $('#addMenuFrm .offcanvas-title').text("{{ localize('Update Menu') }}");
        $('#addMenuSideBar').offcanvas('show');
        $('.selected-file').html('');
        resetForm('form#addMenuFrm');
        resetFormErrors('form#addMenuFrm');
        hideElement('.password_wrapper');
        $('form#addMenuFrm').attr('action', updateUrl);

        let callParams  = {};
        callParams.type = "GET";
        callParams.url  = actionUrl;
        callParams.data = "";
        loadingInContent('#loader', 'loading...');
        hideElement('.offcanvas-body');
        ajaxCall(callParams, function (result) {
            resetLoading('#loader', '');
            showElement('.offcanvas-body');
            if(result.data) {
                let menu = result.data;
                $('#addMenuFrm input[name="_method"]').val("PUT");
                $('#addMenuFrm #id').val(menus.id);
                $('#addMenuFrm #name').val(menu.name);
                $('#addMenuFrm #is_active').val(menu.is_active).change();
                $('#addMenuFrm #branch_ids').val(menu.branches.map(branch => branch.id)).trigger('change');

                // getChosenFilesCount();
                // showSelectedFilePreviewOnLoad();
            }
        }, function (err, type, httpStatus) {

        });

    });


    // search
    $('body').on('click', '#searchBtn', function(e){

        e.preventDefault();
        var keyword      = $('#keyword').val();
        var is_active   = $('#search_status :selected').val();

        loadingInTable("tbody",{
            colSpan: 11,
            prop: false,
        });

        gFilterObj.keyword = keyword;

        if(is_active === '0' || is_active === '1') {
            gFilterObj.is_active = is_active;
        } else if(gFilterObj.hasOwnProperty('is_active')) {
            delete gFilterObj.is_active;
        }


        if(gFilterObj.hasOwnProperty('page')) {
            delete gFilterObj.page;
        }

        getDataList();
    });

   var offcanvasBottom = document.getElementById('offcanvasBottom')
    var secondoffcanvas = document.getElementById('addMenuSideBar')

    offcanvasBottom.addEventListener('hidden.bs.offcanvas', function() {
        var bsOffcanvas2 = new bootstrap.Offcanvas(secondoffcanvas)
        bsOffcanvas2.show()
    })
    getDataList();
</script>
