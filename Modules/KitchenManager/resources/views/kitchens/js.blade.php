<script>
    'use strict';

    // load branches
    function getDataList() {
        var callParams      = {};
        callParams.type     = "GET";
        callParams.dataType = "html";
        callParams.url      = "{{ route('admin.kitchens.index') }}" + (gFilterObj ? '?' + $.param(gFilterObj) : '');
        callParams.data     = '';
        ajaxCall(callParams, function (result) {
            $('tbody').empty().html(result);
            feather.replace();
        }, function onErrorData(err, type, httpStatus) {});
    }

    // handle offcanvas for adding an Kitchen
    $('body').on('click', '#addKitchenBtnForOffCanvas', function(){
        $('#addKitchenFrm .offcanvas-title').text("{{ localize('Add New Kitchen') }}");
        resetFormErrors('form#addKitchenFrm');
        resetForm('form#addKitchenFrm');
        showElement('.password_wrapper');
        $('form#addKitchenFrm input:hidden[name=_method]').val('POST');
        $('form#addKitchenFrm').attr('action', "{{ route('admin.kitchens.store') }}");
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

    // add Kitchen
    $("#addKitchenFrm").submit(function(e) {
        e.preventDefault();

        resetFormErrors('form#addKitchenFrm');
        loading('#addKitchenBtn', 'Saving...');

        let id = $("#addKitchenFrm #id").val();

        var callParams  = {};
        callParams.type = "POST";
        callParams.url  = $("form#addKitchenFrm").attr("action");
        callParams.data = new FormData($('#addKitchenFrm')[0]);
        callParams.processData = false;
        callParams.contentType = false;

        ajaxCall(callParams, function (result) {
            resetLoading('#addKitchenBtn', 'Save');
            showSuccess(result.message);
           if(!id) {
                resetForm('form#addKitchenFrm');
            }
            toast(result.message);
            getDataList();
            $('#addKitchenSideBar').offcanvas('hide');

        }, function (err, type, httpStatus) {
            showFormError(err, '#addKitchenFrm');
            resetLoading('#addKitchenBtn', 'Save');
        });

        return false;
    });

    // edit Kitchen
    $('body').on('click', '.editIcon', function(){
        let kitchen_id = parseInt($(this).data("id"));
        let actionUrl = "{{ route('admin.kitchens.edit', ['kitchen' => ':id']) }}".replace(':id', kitchen_id);
        let updateUrl = "{{ route('admin.kitchens.update', ['kitchen' => ':id']) }}".replace(':id', kitchen_id);

        $('#addKitchenFrm .offcanvas-title').text("{{ localize('Update Kitchen') }}");
        $('#addKitchenSideBar').offcanvas('show');
        $('.selected-file').html('');

        resetForm('form#addKitchenFrm');
        resetFormErrors('form#addKitchenFrm');
        hideElement('.password_wrapper');

        $('form#addKitchenFrm').attr('action', updateUrl);

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

                let kitchen = result.data;

                $('#addKitchenFrm input[name="_method"]').val("PUT");

                Object.keys(kitchen).forEach(function(column) {
                    $('#addKitchenFrm #' + column).val(kitchen[column]);
                });

                $('#addKitchenFrm #branch_id').val(kitchen.branch_id).trigger('change');
                $('#addKitchenFrm #is_active').val(kitchen.is_active).trigger('change');
                $('#addKitchenFrm #id').val(kitchen.id);

            }
        }, function (err, type, httpStatus) {

        });

    });

    // delete Kitchen
    $('body').on('click', '.deleteKitchen', function(){
        let KitchenId = parseInt($(this).data("id"));
        swConfirm({
            title: "Do you want to delete this Kitchen ?",
            confirmButtonText: "Yes",
            showDenyButton: true,
        }, (result) => {
            if (result.isConfirmed) {
                var callParams  = {};
                callParams.type = "POST";
                callParams.url  = $(this).data("url");
                callParams.data = {
                    id: KitchenId,
                    _method: $(this).data("method"),
                    _token : "{{ csrf_token() }}"
                };
                ajaxCall(callParams, function (result) {
                    toast(result.message);
                    getDataList();
                }, function (err, type, httpStatus) {
                    showFormError(err, '#addKitchenFrm');
                });
            }
        });
    });

   var offcanvasBottom = document.getElementById('offcanvasBottom')
    var secondoffcanvas = document.getElementById('addKitchenSideBar')

    offcanvasBottom.addEventListener('hidden.bs.offcanvas', function() {
        var bsOffcanvas2 = new bootstrap.Offcanvas(secondoffcanvas)
        bsOffcanvas2.show()
    })
    getDataList();
</script>
