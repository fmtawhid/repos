<script>
    'use strict';

    // load branches
    function getDataList() {
        var callParams      = {};
        callParams.type     = "GET";
        callParams.dataType = "html";
        callParams.url      = "{{ route('admin.branches.index') }}" + (gFilterObj ? '?' + $.param(gFilterObj) : '');
        callParams.data     = '';
        ajaxCall(callParams, function (result) {
            $('tbody').empty().html(result);
            feather.replace();
        }, function onErrorData(err, type, httpStatus) {});
    }

    // handle offcanvas for adding an Branch
    $('body').on('click', '#addBranchBtnForOffCanvas', function(){
        $('#addBranchFrm .offcanvas-title').text("{{ localize('Add New Branch') }}");
        resetFormErrors('form#addBranchFrm');
        resetForm('form#addBranchFrm');
        showElement('.password_wrapper');
        $('form#addBranchFrm input:hidden[name=_method]').val('POST');
        $('form#addBranchFrm').attr('action', "{{ route('admin.branches.store') }}");
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

    // add Branch
    $("#addBranchFrm").submit(function(e) {
        e.preventDefault();

        resetFormErrors('form#addBranchFrm');
        loading('#addBranchBtn', 'Saving...');

        let id = $("#addBranchFrm #id").val();

        var callParams  = {};
        callParams.type = "POST";
        callParams.url  = $("form#addBranchFrm").attr("action");
        callParams.data = new FormData($('#addBranchFrm')[0]);
        callParams.processData = false;
        callParams.contentType = false;

        ajaxCall(callParams, function (result) {
            resetLoading('#addBranchBtn', 'Save');
            showSuccess(result.message);
           if(!id) {
                resetForm('form#addBranchFrm');
            }
            toast(result.message);
            getDataList();
            $('#addBranchSideBar').offcanvas('hide');

        }, function (err, type, httpStatus) {
            showFormError(err, '#addBranchFrm');
            resetLoading('#addBranchBtn', 'Save');
        });

        return false;
    });

    // edit Branch
    $('body').on('click', '.editIcon', function(){
        let branch_id = parseInt($(this).data("id"));
        let actionUrl = "{{ route('admin.branches.edit', ['branch' => ':id']) }}".replace(':id', branch_id);
        let updateUrl = "{{ route('admin.branches.update', ['branch' => ':id']) }}".replace(':id', branch_id);
        // let actionUrl = "admin/update-admin/"+BranchId;

        $('#addBranchFrm .offcanvas-title').text("{{ localize('Update Branch') }}");
        $('#addBranchSideBar').offcanvas('show');
        $('.selected-file').html('');

        resetForm('form#addBranchFrm');
        resetFormErrors('form#addBranchFrm');
        hideElement('.password_wrapper');

        $('form#addBranchFrm').attr('action', updateUrl);

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

                let branch = result.data;

                $('#addBranchFrm input[name="_method"]').val("PUT");

                Object.keys(branch).forEach(function(column) {
                    $('#addBranchFrm #' + column).val(branch[column]);
                });

            }
        }, function (err, type, httpStatus) {

        });

    });

    // change Branch's status
    $('body').on('click', '.changebranchestatus', function(){
        let BranchId = parseInt($(this).data("id"));
        let status = parseInt($(this).data("status"));

        swConfirm({
            title: "Do you want to change the status?",
            confirmButtonText: "Yes",
            showDenyButton: true,
        }, (result) => {
            if (result.isConfirmed) {
                var callParams  = {};
                callParams.type = "POST";
                callParams.url  = "admin/update-admin-status/"+BranchId;
                callParams.data = {
                    id: BranchId,
                    modelName: "city",
                    is_active: status ? 0 : 1,
                    _token : "{{ csrf_token() }}"
                };
                ajaxCall(callParams, function (result) {
                    toast(result.message);
                    getDataList();
                }, function (err, type, httpStatus) {
                    showFormError(err, '#addBranchFrm');
                });
            }
        });
    });

    // delete Branch
    $('body').on('click', '.deleteBranch', function(){
        let BranchId = parseInt($(this).data("id"));
        swConfirm({
            title: "Do you want to delete this Branch ?",
            confirmButtonText: "Yes",
            showDenyButton: true,
        }, (result) => {
            if (result.isConfirmed) {
                var callParams  = {};
                callParams.type = "POST";
                callParams.url  = $(this).data("url");
                callParams.data = {
                    id: BranchId,
                    _method: $(this).data("method"),
                    _token : "{{ csrf_token() }}"
                };
                ajaxCall(callParams, function (result) {
                    toast(result.message);
                    getDataList();
                }, function (err, type, httpStatus) {
                    showFormError(err, '#addBranchFrm');
                });
            }
        });
    });

   var offcanvasBottom = document.getElementById('offcanvasBottom')
    var secondoffcanvas = document.getElementById('addBranchSideBar')

    offcanvasBottom.addEventListener('hidden.bs.offcanvas', function() {
        var bsOffcanvas2 = new bootstrap.Offcanvas(secondoffcanvas)
        bsOffcanvas2.show()
    })
    getDataList();
</script>
