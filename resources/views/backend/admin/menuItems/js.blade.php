<script>
    'use strict';

    // load MenuItems
    function getDataList() {
        var callParams      = {};
        callParams.type     = "GET";
        callParams.dataType = "html";
        callParams.url      = "{{ route('admin.menu-items.index') }}" + (gFilterObj ? '?' + $.param(gFilterObj) : '');
        callParams.data     = '';
        ajaxCall(callParams, function (result) {
            $('tbody').empty().html(result);
            feather.replace();
        }, function onErrorData(err, type, httpStatus) {});
    }

    // handle offcanvas for adding an MenuItem
    $('body').on('click', '#addMenuItemBtnForOffCanvas', function(){
        $('#addMenuItemFrm .offcanvas-title').text("{{ localize('Add New Menu Item') }}");
        resetFormErrors('form#addMenuItemFrm');
        resetForm('form#addMenuItemFrm');
        showElement('.password_wrapper');
        $('form#addMenuItemFrm input:hidden[name=_method]').val('POST');
        $('form#addMenuItemFrm').attr('action', "{{ route('admin.menu-items.store') }}");
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

    // add MenuItem
    $("#addMenuItemFrm").submit(function(e) {
        e.preventDefault();

        resetFormErrors('form#addMenuItemFrm');
        loading('#addMenuItemBtn', 'Saving...');

        let id = $("#addMenuItemFrm #id").val();

        var callParams             = {};
            callParams.type        = "POST";
            callParams.url         = $("form#addMenuItemFrm").attr("action");
            callParams.data        = new FormData($('#addMenuItemFrm')[0]);
            callParams.processData = false;
            callParams.contentType = false;

        ajaxCall(callParams, function (result) {
            resetLoading('#addMenuItemBtn', 'Save');
            showSuccess(result.message);
           if(!id) {
                resetForm('form#addMenuItemFrm');
            }
            toast(result.message);           
            getDataList();
            $('#addMenuItemSideBar').offcanvas('hide');
        }, function (err, type, httpStatus) {
            showFormError(err, '#addMenuItemFrm');
            resetLoading('#addMenuItemBtn', 'Save');
        });

        return false;
    });

    // edit MenuItem
    $('body').on('click', '.editIcon', function(){
        let menuItemId = parseInt($(this).data("id"));
        let actionUrl = "{{ route('admin.menu-items.edit', ['menu_item' => ':id']) }}".replace(':id', menuItemId);
        let updateUrl = "{{ route('admin.menu-items.update', ['menu_item' => ':id']) }}".replace(':id', menuItemId);
        // let actionUrl = "admin/update-admin/"+menuItemId;

        $('#addMenuItemFrm .offcanvas-title').text("{{ localize('Update MenuItem') }}");
        $('#addMenuItemSideBar').offcanvas('show');
        $('.selected-file').html('');
        resetForm('form#addMenuItemFrm');
        resetFormErrors('form#addMenuItemFrm');
        hideElement('.password_wrapper');
        $('form#addMenuItemFrm').attr('action', updateUrl);

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
                let menuItem = result.data.menuItems;

                $('#addMenuItemFrm input[name="_method"]').val("PUT");
                $('#addMenuItemFrm #id').val(menuItem.id);
                $('#addMenuItemFrm #name').val(menuItem.name);
                $('#addMenuItemFrm #description').val(menuItem?.description);
                $('#addMenuItemFrm #preparation_time').val(menuItem?.preparation_time);

                // variations
                let variations = [];
                menuItem.product_attributes.length > 0 ? $('#variationItems').empty() : '';
                menuItem.product_attributes.forEach((variation, index) => {

                $('#variationItems').append(`
                        <div class="variant-item mb-2 d-flex align-items-center gap-2">
                            <input type="text" class="form-control form-control-sm" name="variation_titles[]" placeholder="Variant title" value="${variation.title}" required>
                            <input type="hidden" name="variation_ids[]" value="${variation.id}">

                            <input type="text" class="form-control form-control-sm" name="variation_prices[]" placeholder="Variant price" value="${variation.price}" required>

                           <button type="button" data-id="${variation.id}" class="deleteVariation btn btn-soft-danger btn-sm flex-shrink-0">
                                <i data-feather="trash" class="icon-14"></i>
                            </button>
                        </div>
                    `);
                });

                // addons
                let addons = [];
                $('#addonItems').empty();

                menuItem.product_addons ? menuItem.product_addons.forEach((addon) => {
                $('#addonItems').append(`
                        <div class="addon-item mb-2 d-flex align-items-center gap-2">
                            <input type="text" class="form-control form-control-sm" name="addon_titles[]" placeholder="Addon title" value="${addon.title}" required>
                            <input type="text" class="form-control form-control-sm" name="addon_prices[]" placeholder="Addon price" value="${addon.price}" required>
                            <button type="button" class="deleteAddon btn btn-soft-danger btn-sm flex-shrink-0">
                                <i data-feather="trash" class="icon-14"></i>
                            </button>
                        </div>
                    `);
                }) : '';

                initFeather();

                $('#addMenuItemFrm #media_manager_id').val(menuItem?.media_manager_id);
                $('#addMenuItemFrm #menu_id').val(menuItem.menu_id).trigger('change');
                $('#addMenuItemFrm #item_category_id').val(menuItem.item_category_id).trigger('change');
                $('#addMenuItemFrm #is_active').val(menuItem.is_active).trigger('change');
                $('#addMenuItemFrm #hasVariant').prop('checked', menuItem.has_variation == 1);

                getChosenFilesCount();
                showSelectedFilePreviewOnLoad();
            }
        }, function (err, type, httpStatus) {

        });
    });

    //------------------------------------------------
    // add item on click has variant
    //------------------------------------------------
    let firstVariation = `
        <div class="variant-item mb-2 d-flex align-items-center gap-2">
            <input type="text" class="form-control form-control-sm" name="variation_titles[]" placeholder="Variant title" required>
            <input type="text" class="form-control form-control-sm" name="variation_prices[]" placeholder="Variant price" required>
            <button type="button" class="deleteVariation btn btn-soft-danger btn-sm flex-shrink-0">
                <i data-feather="trash" class="icon-14"></i>
            </button>
        </div>
    `;

    //------------------------------------------------
    //Add more variation
    //------------------------------------------------
    $(document).on('click', '.addNewVariation', function(e){
        e.preventDefault();
        $('#variationItems').append(firstVariation);
        initFeather();
    });


    //---------------------------------
    //Delete variation.
    //---------------------------------
    $(document).on('click', '.deleteVariation', function(){
        if ($('#variationItems .variant-item').length > 1){
            $(this).closest('.variant-item').remove();
            initFeather();
        }else{
            toast('At lease one variation must be added', 'error');
        }
    });


    //------------------------------------------------
    // addons
    //------------------------------------------------
    let firstAddon = `
        <div class="addon-item mb-2 d-flex align-items-center gap-2">
            <input type="text" class="form-control form-control-sm" name="addon_titles[]" placeholder="Addon title" required>
            <input type="text" class="form-control form-control-sm" name="addon_prices[]" placeholder="Addon price" required>
            <button type="button" class="deleteAddon btn btn-soft-danger btn-sm flex-shrink-0">
                <i data-feather="trash" class="icon-14"></i>
            </button>
        </div>
    `;

    //------------------------------------------------
    //Add more addons
    //------------------------------------------------
    $(document).on('click', '.addNewAddon', function(e){
        e.preventDefault();
        $('#addonItems').append(firstAddon);
        initFeather();
    });


    //---------------------------------
    //Delete addons.
    //---------------------------------
    $(document).on('click', '.deleteAddon', function(){
        $(this).closest('.addon-item').remove();
        initFeather();
    });

    //------------------------------------------------
    //delete Menu Item
    //------------------------------------------------
    $('body').on('click', '.deleteMenuItem', function(){
        let menuItemId = parseInt($(this).data("id"));
        swConfirm({
            title: "Do you want to delete this Menu Item ?",
            confirmButtonText: "Yes",
            showDenyButton: true,
        }, (result) => {
            if (result.isConfirmed) {
                var callParams  = {};
                callParams.type = "POST";
                callParams.url  = $(this).data("url");
                callParams.data = {
                    id: menuItemId,
                    _method: $(this).data("method"),
                    _token : "{{ csrf_token() }}"
                };
                ajaxCall(callParams, function (result) {
                    toast(result.message);
                    getDataList();
                }, function (err, type, httpStatus) {
                    showFormError(err, '#MenuItemItems');
                });
            }
        });
    });

    var offcanvasBottom = document.getElementById('offcanvasBottom')
    var secondoffcanvas = document.getElementById('addMenuItemSideBar')

    offcanvasBottom.addEventListener('hidden.bs.offcanvas', function() {
        var bsOffcanvas2 = new bootstrap.Offcanvas(secondoffcanvas)
        bsOffcanvas2.show()
    })
    getDataList();
</script>
