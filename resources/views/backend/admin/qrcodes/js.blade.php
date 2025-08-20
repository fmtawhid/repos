<script>
    'use strict';

    // load Tables
    function getDataList() {
        var callParams      = {};
        callParams.type     = "GET";
        callParams.dataType = "html";
        callParams.url      = "{{ route('admin.qr-codes.index') }}" + (gFilterObj ? '?' + $.param(gFilterObj) : '');
        callParams.data     = '';
        ajaxCall(callParams, function (result) {
            console.log(result);

            $('.showQrCodeByAreaId').empty().html(result);
            feather.replace();

            //call qr codes..
            initQrCode();

        }, function onErrorData(err, type, httpStatus) {});
    }

    // handle offcanvas for adding an Table
    $('body').on('click', '#addTableBtnForOffCanvas', function(){
        $('#addTableFrm .offcanvas-title').text("{{ localize('Add New Table') }}");
        resetFormErrors('form#addTableFrm');
        resetForm('form#addTableFrm');
        showElement('.password_wrapper');
        $('form#addTableFrm input:hidden[name=_method]').val('POST');
        $('form#addTableFrm').attr('action', "{{ route('admin.tables.store') }}");
    })


    // filter qrcodes by area id
    $(document).on('click', '.filterQrCodeByAreaId', function()    {       
        $('.filterQrCodeByAreaId').removeClass('active');        
        $(this).addClass('active');
        
        gFilterObj.area_id = $(this).data('area_id'); // area_id
        getDataList();
    });

    // search
    $('body').on('click', '#searchBtn', function(e){
        e.preventDefault();
        var search      = $('#f_search').val();
        var table_type   = $('#f_table_type :selected').val();
        var is_active   = $('#f_is_active :selected').val();
        loadingInTable("tbody",{
            colSpan: 11,
            prop: false,
        });
        gFilterObj.search    = search;
        gFilterObj.Table_type = Table_type;

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

    // add Table
    $("#addTableFrm").submit(function(e) {
        e.preventDefault();

        resetFormErrors('form#addTableFrm');
        loading('#addTableBtn', 'Saving...');

        let id = $("#addTableFrm #id").val();

        var callParams  = {};
        callParams.type = "POST";
        callParams.url  = $("form#addTableFrm").attr("action");
        callParams.data = new FormData($('#addTableFrm')[0]);
        callParams.processData = false;
        callParams.contentType = false;

        ajaxCall(callParams, function (result) {
            resetLoading('#addTableBtn', 'Save');
            showSuccess(result.message);
           if(!id) { 
                resetForm('form#addTableFrm');
            }
            getDataList();
            $('#addTablesideBar').offcanvas('hide');
        }, function (err, type, httpStatus) {
            showFormError(err, '#addTableFrm');
            resetLoading('#addTableBtn', 'Save');
        });

        return false;
    });

    // edit Table
    $('body').on('click', '.editIcon', function(){
        let tableId = parseInt($(this).data("id"));

        let actionUrl = "{{ route('admin.tables.edit', ['table' => ':id']) }}".replace(':id', tableId);
        let updateUrl = "{{ route('admin.tables.update', ['table' => ':id']) }}".replace(':id', tableId);
        // let actionUrl = "admin/update-admin/"+TableId;

        $('#addTableFrm .offcanvas-title').text("{{ localize('Update Table') }}");
        $('#addTableSideBar').offcanvas('show');
        $('.selected-file').html('');
        resetForm('form#addTableFrm');
        resetFormErrors('form#addTableFrm');
        hideElement('.password_wrapper');
        $('form#addTableFrm').attr('action', updateUrl);

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
                let table = result.data;
                $('#addTableFrm input[name="_method"]').val("PUT");
                $('#addTableFrm #id').val(table.id);
                $('#addTableFrm #table_code').val(table.table_code);
                $('#addTableFrm #number_of_seats').val(table.number_of_seats);
                $('#addTableFrm #area_id').val(table.area_id).change();
                $('#addTableFrm #is_active').val(table.is_active).change();
                // getChosenFilesCount();
                // showSelectedFilePreviewOnLoad();
            }
        }, function (err, type, httpStatus) {

        });

    });

    // change Table's status
    $('body').on('click', '.changeTablestatus', function(){
        let TableId = parseInt($(this).data("id"));
        let status = parseInt($(this).data("status"));

        swConfirm({
            title: "Do you want to change the status?",
            confirmButtonText: "Yes",
            showDenyButton: true,
        }, (result) => {
            if (result.isConfirmed) {
                var callParams  = {};
                callParams.type = "POST";
                callParams.url  = "admin/update-admin-status/"+TableId;
                callParams.data = {
                    id: TableId,
                    modelName: "city",
                    is_active: status ? 0 : 1,
                    _token : "{{ csrf_token() }}"
                };
                ajaxCall(callParams, function (result) {
                    toast(result.message);
                    getDataList();
                }, function (err, type, httpStatus) {
                    showFormError(err, '#addTableFrm');
                });
            }
        });
    });

    // delete Table
    $('body').on('click', '.deleteTable', function(){
        let TableId = parseInt($(this).data("id"));

        swConfirm({
            title: "Do you want to delete this Table ?",
            confirmButtonText: "Yes",
            showDenyButton: true,
        }, (result) => {
            if (result.isConfirmed) {
                var callParams  = {};
                callParams.type = "POST";
                callParams.url  = $(this).data("url");
                callParams.data = {
                    id: TableId,
                    _method: $(this).data("method"),
                    _token : "{{ csrf_token() }}"
                };
                ajaxCall(callParams, function (result) {
                    toast(result.message);
                    getDataList();
                }, function (err, type, httpStatus) {
                    showFormError(err, '#addTableFrm');
                });
            }
        });
    });

    var offcanvasBottom = document.getElementById('offcanvasBottom')
    var secondoffcanvas = document.getElementById('addTableSideBar')

    offcanvasBottom.addEventListener('hidden.bs.offcanvas', function() {
        var bsOffcanvas2 = new bootstrap.Offcanvas(secondoffcanvas)
        bsOffcanvas2.show()
    })

    // initial query...
    gFilterObj.area_id = $('#firstAreaId').val(); // area_id
    getDataList();
</script>


<script>
    function initQrCode()
    {
        $('.showQrCodeImage').each(function(){
            var code = $(this).data('code');
            if(code){
                new QRCode(this, {
                    text: code,
                    width: 200,
                    height: 200,
                    colorDark : "#000000",
                    colorLight : "#ffffff",
                    correctLevel : QRCode.CorrectLevel.H
                });
            }
        });
    }
</script>
{{-- end showing qr code--}}

