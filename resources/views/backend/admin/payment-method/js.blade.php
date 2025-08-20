<script>
    "use strict";

    function getDataList() {
        var callParams      = {};
        callParams.type     = "GET";
        callParams.dataType = "html";
        callParams.url      = "{{ route('admin.payment-gateways.index') }}" + (gFilterObj ? '?' + $.param(gFilterObj) : '');
        callParams.data     = '';
        loadingInContent('#payment-methods', 'loading...');
        ajaxCall(callParams, function(result) {
        $('#payment-methods').empty().html(result);
            $('tbody').empty().html(result);
            feather.replace();
        }, function onErrorData(err, type, httpStatus) {});
    }

     $(".paymentForm").submit(function(e) {
        e.preventDefault();
        let formAttributeID =  $(this).attr("id");
        resetFormErrors('form#'+formAttributeID);
        loading('.paymentFormSubmitButton', 'Saving...');
        let callParams = {};

        callParams.type = "POST";
        callParams.url  = $("form#"+formAttributeID).attr("action");
        callParams.data = new FormData($("#"+formAttributeID)[0]);
        callParams.processData = false;
        callParams.contentType = false;

        ajaxCall(callParams, function(result) {
            resetLoading('.paymentFormSubmitButton', 'Save Configuration');
            toast(result.message);  
            getDataList();
            $('.offcanvas').offcanvas('hide');         
        }, function(err, type, httpStatus) {
            resetLoading('.paymentFormSubmitButton', 'Save Configuration');
            toast(err.responseJSON.message, 'error');
        });

        return false;
    });
    $(document).on('change', '#yookassa_reciept_active', function() {
        let status = $(this).is(':checked') ? true : false;
        if (status == true) {
            $('#reciept_yookassa').removeClass('d-none');
        } else {
            $('#reciept_yookassa').addClass('d-none');
        }
    })
    getDataList();
</script>