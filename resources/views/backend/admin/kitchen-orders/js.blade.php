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

        loadingInContent(".posOrdersList", 'loading...');

        ajaxCall(callParams, function(response) {
            resetLoading(".posOrdersList");            
            toast(response.message);
            fetchOrderList.call($("#searchForm"));
        }, function(err, type, httpStatus) {
            resetLoading(".posOrdersList");
            console.log("Failed to load order list", err, err.responseJSON);
            toast(err.responseJSON.message, 'error');
        });   
    });
</script>
