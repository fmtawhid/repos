<script>
    "use script";

    function loadPermissions(){
        let callParams = {};

        callParams.url      = "{{ route('admin.permissions.index') }}";
        callParams.dataType = "json";

        ajaxCall(callParams, function(response){
        },
        function(xhr, status, error){
            console.log("Server Error : ", error.responseText);
        })
    }

    function getDataList() {

        var callParams      = {};
        callParams.type     = "GET";
        callParams.dataType = "html";
        callParams.url      = "{{ route('admin.permissions.index') }}" + (gFilterObj ? '?' + $.param(gFilterObj) : '');
        callParams.data     = '';
        ajaxCall(
            callParams,
            function(result) {
                $('.permissions').empty().html(result);

                feather.replace();
            },
            function onErrorData(err, type, httpStatus) {
                let error = JSON.parse(err.responseText);
                centerToast(error.message, "error");
            }
        );
    }

    $(()=>{
        getDataList();
    })


    $(document).on("click",".changeAllowInDemoStatus",async function (e) {
        let id = $(this).data("id");
        let callParams = {};

        callParams.url = "{{ route('admin.permissions.update', ['permission' => ':id']) }}".replace(':id', id);

        callParams.dataType = "json";
        callParams.type = "POST";
        callParams.data = {
            id      : id,
            _method : "PUT",
            _token  : "{{ csrf_token() }}"
        };

        await ajaxCall(callParams, function(result){
            toast(result.message, "success")
        },
        function (err, type, httpStatus){
            let error = JSON.parse(err.responseText);
            centerToast(error.message, "error");
        })
    })
</script>