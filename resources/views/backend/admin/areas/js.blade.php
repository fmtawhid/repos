<script>
    'use strict';

    // load areas
    function getDataList() {
        var callParams      = {};
        callParams.type     = "GET";
        callParams.dataType = "html";
        callParams.url      = "{{ route('admin.areas.index') }}" + (gFilterObj ? '?' + $.param(gFilterObj) : '');
        callParams.data     = '';
        ajaxCall(callParams, function (result) {
            $('tbody').empty().html(result);
            feather.replace();
        }, function onErrorData(err, type, httpStatus) {});
    }

    // handle offcanvas for adding an area
    $('body').on('click', '#addAreaBtnForOffCanvas', function(){
        $('#addAreaFrm .offcanvas-title').text("{{ localize('Add New Area') }}");
        resetFormErrors('form#addAreaFrm');
        resetForm('form#addAreaFrm');
        showElement('.password_wrapper');
        $('form#addAreaFrm input:hidden[name=_method]').val('POST');
        $('form#addAreaFrm').attr('action', "{{ route('admin.areas.store') }}");
    })

    // search
    $('body').on('click', '#searchBtn', function(e){
        e.preventDefault();
        var keyword    = $('#keyword').val();
        var is_active  = $('#search_status :selected').val();
        var branch_id  = $('#branch_id :selected').val();

        loadingInTable("tbody",{
            colSpan: 11,
            prop: false,
        });

        gFilterObj.keyword   = keyword;
        gFilterObj.branch_id = branch_id;

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

    // add area
    $("#addAreaFrm").submit(function(e) {
        e.preventDefault();

        resetFormErrors('form#addAreaFrm');
        loading('#addAreaBtn', 'Saving...');

        let id = $("#addAreaFrm #id").val();

        var callParams  = {};
        callParams.type = "POST";
        callParams.url  = $("form#addAreaFrm").attr("action");
        callParams.data = new FormData($('#addAreaFrm')[0]);
        callParams.processData = false;
        callParams.contentType = false;

        ajaxCall(callParams, function (result) {
            resetLoading('#addAreaBtn', 'Save');
            showSuccess(result.message);
           if(!id) {
                resetForm('form#addAreaFrm');
            }
            toast(result.message);
            getDataList();
            $('#addAreaSideBar').offcanvas('hide');
        }, function (err, type, httpStatus) {
            showFormError(err, '#addAreaFrm');
            resetLoading('#addAreaBtn', 'Save');
        });

        return false;
    });

    // edit area
    $('body').on('click', '.editIcon', function(){

        let areaId    = parseInt($(this).data("id"));
        let actionUrl = "{{ route('admin.areas.edit', ['area' => ':id']) }}".replace(':id', areaId);
        let updateUrl = "{{ route('admin.areas.update', ['area' => ':id']) }}".replace(':id', areaId);
        // let actionUrl = "admin/update-admin/"+areaId;

        $('#addAreaFrm .offcanvas-title').text("{{ localize('Update area') }}");
        $('#addAreaSideBar').offcanvas('show');
        $('.selected-file').html('');

        resetForm('form#addAreaFrm');
        resetFormErrors('form#addAreaFrm');
        hideElement('.password_wrapper');

        $('form#addAreaFrm').attr('action', updateUrl);

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

                let area = result.data;

                $('#addAreaFrm input[name="_method"]').val("PUT");
                $('#addAreaFrm #id').val(area.id);
                $('#addAreaFrm #name').val(area.name);
                $('#addAreaFrm #number_of_tables').val(area.number_of_tables);
                $('#addAreaFrm #branch_ids').val(area.branches.map(branch => branch.id)).trigger('change');
                $('#addAreaFrm #is_active').val(area.is_active).change();

            }
        }, function (err, type, httpStatus) {

            toast(err.responseJSON.message,"error");

            showFormError(err, '#addAreaFrm');
        });
    });

    // change area's status
    $('body').on('click', '.changeareastatus', function(){
        let areaId = parseInt($(this).data("id"));
        let status = parseInt($(this).data("status"));

        swConfirm({
            title: "Do you want to change the status?",
            confirmButtonText: "Yes",
            showDenyButton: true,
        }, (result) => {
            if (result.isConfirmed) {
                var callParams  = {};
                callParams.type = "POST";
                callParams.url  = "admin/update-admin-status/"+areaId;
                callParams.data = {
                    id: areaId,
                    modelName: "city",
                    is_active: status ? 0 : 1,
                    _token : "{{ csrf_token() }}"
                };
                ajaxCall(callParams, function (result) {
                    toast(result.message);
                    getDataList();
                }, function (err, type, httpStatus) {
                    showFormError(err, '#addAreaFrm');
                });
            }
        });
    });

    // delete area
    $('body').on('click', '.deleteArea', function(){
        let areaId = parseInt($(this).data("id"));

        swConfirm({
            title: "Do you want to delete this area ?",
            confirmButtonText: "Yes",
            showDenyButton: true,
        }, (result) => {
            if (result.isConfirmed) {
                var callParams  = {};
                callParams.type = "POST";
                callParams.url  = $(this).data("url");
                callParams.data = {
                    id: areaId,
                    _method: $(this).data("method"),
                    _token : "{{ csrf_token() }}"
                };
                ajaxCall(callParams, function (result) {
                    toast(result.message);
                    getDataList();
                }, function (err, type, httpStatus) {
                    showFormError(err, '#addAreaFrm');
                });
            }
        });
    });

    var offcanvasBottom = document.getElementById('offcanvasBottom')
    var secondoffcanvas = document.getElementById('addAreaSideBar')

    offcanvasBottom.addEventListener('hidden.bs.offcanvas', function() {
        var bsOffcanvas2 = new bootstrap.Offcanvas(secondoffcanvas)
        bsOffcanvas2.show()
    })
    getDataList();
</script>
