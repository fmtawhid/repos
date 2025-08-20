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
</script>
