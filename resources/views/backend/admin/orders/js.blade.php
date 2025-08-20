<script>

    $(window).on("load",function() {
        fetchOrderList.call($("#searchForm"));
    });

    $(document).on("submit","#searchForm",function(e) {
        e.preventDefault();
        fetchOrderList.call(this);
    });

    function fetchOrderList() {
        var formData = $(this).serialize();

        let callParams  = {};
        callParams.type = "GET";
        callParams.url  = $(this).attr("action")+"?posOrdersFilter=1";
        callParams.data = formData;
        callParams.processData = false;
        callParams.contentType = false;

        loadingInContent(".posOrdersList", 'loading...');

        ajaxCall(callParams, function(response) {

            $(".posOrdersList").html(response.data);
            feather.replace();
        }, function(err, type, httpStatus) {

            console.log("Failed to load order list", err, err.responseJSON);
            toast(err.responseJSON.message, 'error');
        });
    }

    //Update Order Status
    $(document).on("change", ".orderStatusId", function() {
        let order_id = $(this).data("order_id");
        let status_id = $(this).val();
        let callParams  = {};

        callParams.type = "post";
        callParams.url  = '{{ route("admin.orders.update-status") }}';
        callParams.dataType = 'json';
        callParams.data = {
            order_id: order_id,
            status_id: status_id,
            _token: '{{ csrf_token() }}'
        };


        ajaxCall(callParams, function(response) {

            toast(response.message);
        }, function(err, type, httpStatus) {

            console.log("Failed to load order list", err, err.responseJSON);
            toast(err.responseJSON.message, 'error');
        });
    });

    //Update Order Product Status
    $(document).on("change", ".orderProductStatusId", function() {
        let order_product_id = $(this).data("order_product_id");
        let status_id = $(this).val();
        let callParams  = {};

        callParams.type = "post";
        callParams.url  = '{{ route("admin.update_status.order_product") }}';
        callParams.dataType = 'json';
        callParams.data = {
            order_product_id: order_product_id,
            status_id: status_id,
            _token: '{{ csrf_token() }}'
        };


        ajaxCall(callParams, function(response) {
            toast(response.message);
        }, function(err, type, httpStatus) {
            console.log("Failed to load order list", err, err.responseJSON);
            toast(err.responseJSON.message, 'error');
        });
    });

    //Update orderPaymentStatus
    $(document).on("change", ".orderPaymentStatus", function() {
        if($(this).val() == 0){
            return;
        }
        let select2 = $(this);
        let order_code = $(this).data("order_code");
        let amount = $(this).data("amount");
        
        let formData = new FormData();
        formData.append('order_code', order_code);
        formData.append('amount', amount);
        formData.append('_token', '{{ csrf_token() }}');

        let callParams = {
            type: "POST",
            url: '{{ route("pos.order.receiveBill") }}',
            data: formData,
            contentType: false,
            processData: false,
            dataType: "json"
        };

        ajaxCall(callParams, function (response){
            toast('{{ localize("Payment Status Updated Successfully") }}');
        }, function (xhr, status, error){
        });
    });



</script>
