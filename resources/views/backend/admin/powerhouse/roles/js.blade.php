<script>
    'use strict';

    $(document).on("click",".groupTitle",function (e) {
        let groupId             = $(this).attr("for");
        let inputWithAttribute  = `input[data-group-id="${groupId}"]`;

        let isGroupChecked = $(`#${groupId}`).prop("checked");

        $(inputWithAttribute).each(function() {
            $(this).prop('checked', !isGroupChecked);
        });
    });

 

    function getDataList() {
        var callParams = {};
        callParams.type = "GET";
        callParams.dataType = "html";
        callParams.url = "{{ route('admin.roles.index') }}" + (gFilterObj ? '?' + $.param(gFilterObj) : '');
        callParams.data = '';
        ajaxCall(callParams,
            function(result) {
                $('.roles').empty().html(result);

                feather.replace();
            },
            function onErrorData(err, type, httpStatus) {
                let error = JSON.parse(err.responseText);
                centerToast(error.message, "error");
            }
        );
    }


    // add user
    $("#addFrm").submit(function(e) {
        e.preventDefault();

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': "{{ csrf_token() }}"
            }
        });

        resetFormErrors('form#addFrm');
        loading('#frmActionBtn', 'Saving...');

        let id = $("#addFrm #id").val();

        var callParams  = {};
        callParams.type = "POST";
        callParams.url  = $("form#addFrm").attr("action");

        let formData = new FormData();

        formData.append("name", $("#addFrm #name").val());
        formData.append("is_active", $("#addFrm #is_active").val());
        formData.append("_method", $("input[name='_method']").val());

        $('input[name="permission_id[]"]:checked').each(function() {
            // Append the value of each checked checkbox to the formData object
            formData.append('routes[]', $(this).val());
        });
        callParams.data = formData;
        callParams.processData  = false;
        callParams.contentType  = false;
        ajaxCall(callParams, function (result) {
            resetLoading('#frmActionBtn', 'Save');
            showSuccess(result.message);
            if(!id) { // only for save
                resetForm('form#addFrm');
            }
            getDataList();
        }, function (err, type, httpStatus) {
            showFormError(err, '#addFrm');
            resetLoading('#frmActionBtn', 'Save');
        });

        return false;
    });

    $(document).on("click",".editIcon",function (e) {
        e.preventDefault();
        let id = $(this).data("id");

        let editRoute = "{{ route('admin.roles.edit',['role' => ':id']) }}";
        editRoute     = editRoute.replace(':id', id);

        let updateRoute = "{{ route('admin.roles.update',['role' => ':id']) }}";
        updateRoute     = updateRoute.replace(':id', id);

        $("input[name='_method']").val("PUT");

        let callParams  = {};
        callParams.type = "GET";
        callParams.url  = editRoute;

        callParams.data = '';
        ajaxCall(callParams, function (result) {
            $("#addFrm #id").val(result.id);
            $("#addFrm #name").val(result.name);
            $("#addFrm #is_active").val(result.is_active);
            $("#addFrm").attr("action", updateRoute);

            // Console all the permissions
            result.permissions.forEach(permission => {
                let permissionId = `#perm${permission.id}`;
                $(permissionId).prop('checked', true);
            });
        }, function (err, type, httpStatus) {
            console.log("Server Error : ", err);
        });


    });

    // delete Role
    $('body').on('click', '.deleteRole', function(){
        let userId = parseInt($(this).data("id"));

        swConfirm({
            title: "Do you want to delete this user?",
            confirmButtonText: "Yes",
            showDenyButton: true,
        }, (result) => {
            if (result.isConfirmed) {
                var callParams  = {};
                callParams.type = "POST";
                callParams.url  = $(this).data("url");
                callParams.data = {
                    id: userId,
                    _method: $(this).data("method"),
                    _token : "{{ csrf_token() }}"
                };
                ajaxCall(callParams, function (result) {
                    toast(result.message);
                    getDataList();
                }, function (err, type, httpStatus) {
                    showFormError(err, '#addFrm');
                });
            }
        });
    });

    
    var offcanvasBottom = document.getElementById('offcanvasBottom')
    var secondoffcanvas = document.getElementById('addFormSidebar')

    offcanvasBottom.addEventListener('hidden.bs.offcanvas', function() {
        var bsOffcanvas2 = new bootstrap.Offcanvas(secondoffcanvas)
        bsOffcanvas2.show()
    })
    getDataList();
</script>