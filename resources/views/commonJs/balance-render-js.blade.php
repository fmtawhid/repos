<script>
    function balanceRender(type = null, selector = "#balance-render") {
        let callParams = {};
        callParams.type = "GET";
        callParams.url = "{{ route('admin.balance-render') }}";
        callParams.data = {
            type: type
        };

        ajaxCall(callParams, function(result) {
            $(selector).html(result.data);
        },
        function(err, type, httpStatus) {
            console.log("Failed to load balance-render", err.responseJSON);
            toast(err.responseJSON.message, 'error');
        });
    }
</script>