<script>
    'use strict';

    // load ItemCategorys
    function getDataList() {
        var callParams      = {};
        callParams.type     = "GET";
        callParams.dataType = "html";
        callParams.url      = "{{ route('admin.item-categories.index') }}" + (gFilterObj ? '?' + $.param(gFilterObj) : '');
        callParams.data     = '';
        ajaxCall(callParams, function (result) {
            $('tbody').empty().html(result);
            feather.replace();
        }, function onErrorData(err, type, httpStatus) {});
    }

    // handle offcanvas for adding an ItemCategory
    $('body').on('click', '#addItemCategoryBtnForOffCanvas', function(){
        $('#addItemCategoryFrm .offcanvas-title').text("{{ localize('Add New Item Category') }}");
        resetFormErrors('form#addItemCategoryFrm');
        resetForm('form#addItemCategoryFrm');
        showElement('.password_wrapper');
        $('form#addItemCategoryFrm input:hidden[name=_method]').val('POST');
        $('form#addItemCategoryFrm').attr('action', "{{ route('admin.item-categories.store') }}");
    })

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

    // add ItemCategory
    $("#addItemCategoryFrm").submit(function(e) {
        e.preventDefault();

        resetFormErrors('form#addItemCategoryFrm');
        loading('#addItemCategoryBtn', 'Saving...');

        let id = $("#addItemCategoryFrm #id").val();

        var callParams  = {};
        callParams.type = "POST";
        callParams.url  = $("form#addItemCategoryFrm").attr("action");
        callParams.data = new FormData($('#addItemCategoryFrm')[0]);
        callParams.processData = false;
        callParams.contentType = false;
        callParams.dataType ="json";

        ajaxCall(callParams, function (result) {
            toast(result.message);

            resetLoading('#addItemCategoryBtn', 'Save');
            showSuccess(result.message);
           if(!id) {
                resetForm('form#addItemCategoryFrm');
            }

            $('#addItemCategorySideBar').offcanvas('hide');

            getDataList();
        }, function (err, type, httpStatus) {
            toast(err.responseJSON.message,"error");

            showFormError(err, '#addItemCategoryFrm');
            resetLoading('#addItemCategoryBtn', 'Save');
        });

        return false;
    });

    // edit ItemCategory
    $('body').on('click', '.editIcon', function(){
        let itemCategoryId = parseInt($(this).data("id"));
        let actionUrl = "{{ route('admin.item-categories.edit', ':id') }}".replace(':id', itemCategoryId);
        let updateUrl = "{{ route('admin.item-categories.update',':id') }}".replace(':id', itemCategoryId);
        // let actionUrl = "admin/update-admin/"+itemCategoryId;

        $('#addItemCategoryFrm .offcanvas-title').text("{{ localize('Update Item Category') }}");
        $('#addItemCategorySideBar').offcanvas('show');

        $('.selected-file').html('');

        resetForm('form#addItemCategoryFrm');
        resetFormErrors('form#addItemCategoryFrm');
        hideElement('.password_wrapper');

        $('form#addItemCategoryFrm').attr('action', updateUrl);

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
                let itemCategory = result.data;
                $('#addItemCategoryFrm input[name="_method"]').val("PUT");
                $('#addItemCategoryFrm #id').val(itemCategory.id);
                $('#addItemCategoryFrm #name').val(itemCategory.name);
                $('#addItemCategoryFrm #is_active').val(itemCategory.is_active).change();
            }
        }, function (err, type, httpStatus) {

        });

    });

    // change ItemCategory's status
    $('body').on('click', '.changeItemCategorystatus', function(){
        let itemCategoryId = parseInt($(this).data("id"));
        let status = parseInt($(this).data("status"));

        swConfirm({
            title: "Do you want to change the status?",
            confirmButtonText: "Yes",
            showDenyButton: true,
        }, (result) => {
            if (result.isConfirmed) {
                var callParams  = {};
                callParams.type = "POST";
                callParams.url  = "admin/update-admin-status/"+itemCategoryId;
                callParams.data = {
                    id: itemCategoryId,
                    modelName: "city",
                    is_active: status ? 0 : 1,
                    _token : "{{ csrf_token() }}"
                };
                ajaxCall(callParams, function (result) {
                    toast(result.message);
                    getDataList();
                }, function (err, type, httpStatus) {
                    showFormError(err, '#addItemCategoryFrm');
                });
            }
        });
    });

    // delete ItemCategory
    $('body').on('click', '.deleteItemCategory', function(){
        let itemCategoryId = parseInt($(this).data("id"));
        swConfirm({
            title: "Do you want to delete this ItemCategory ?",
            confirmButtonText: "Yes",
            showDenyButton: true,
        }, (result) => {
            if (result.isConfirmed) {
                var callParams  = {};
                callParams.type = "POST";
                callParams.url  = $(this).data("url");
                callParams.data = {
                    id: itemCategoryId,
                    _method: $(this).data("method"),
                    _token : "{{ csrf_token() }}"
                };
                ajaxCall(callParams, function (result) {
                    toast(result.message);
                    getDataList();
                }, function (err, type, httpStatus) {
                    showFormError(err, '#addItemCategoryFrm');
                });
            }
        });
    });

   var offcanvasBottom = document.getElementById('offcanvasBottom')
    var secondoffcanvas = document.getElementById('addItemCategorySideBar')

    offcanvasBottom.addEventListener('hidden.bs.offcanvas', function() {
        var bsOffcanvas2 = new bootstrap.Offcanvas(secondoffcanvas)
        bsOffcanvas2.show()
    })
    getDataList();
</script>
