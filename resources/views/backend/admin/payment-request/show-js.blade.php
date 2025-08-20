<script>
    "use strict";

    $("#feedbackSubmitForm").submit(function(e) {
        e.preventDefault();       
        loading('#feedbackSubmitButton', 'Saving...');
        let callParams = {};
        callParams.type = "POST";
        callParams.url = $("form#feedbackSubmitForm").attr("action");
        callParams.data = $("form#feedbackSubmitForm").serialize();

        ajaxCall(callParams, function(result) {
            resetLoading('#feedbackSubmitButton', 'Save');
            toast(result.message);            
        }, function(err, type, httpStatus) {
            resetLoading('#feedbackSubmitButton', 'Save');
        });

        return false;
    });
    $("#reSubmitForm").submit(function(e) {
        e.preventDefault();       
        loading('#reSubmitButton', 'Saving...');
        let callParams = {};
        callParams.type = "POST";
        callParams.url = $("form#reSubmitForm").attr("action");
        callParams.data = $("form#reSubmitForm").serialize();

        ajaxCall(callParams, function(result) {
            resetLoading('#reSubmitButton', 'Save');
            toast(result.message);            
        }, function(err, type, httpStatus) {
            resetLoading('#reSubmitButton', 'Save');
        });

        return false;
    });
    // handle package payment
    function handlePackageActive($this) {
        let subscription_user_id = $($this).data('subscription_user_id');
        let is_carried_over = $($this).data('is_carried_over');
        showElement('#paymentDetailDiv');
        hideElement('#reSubmitDiv');
        hideElement('#feedbackBack');
        $('#subscription_user_id').val(subscription_user_id);
        if (is_carried_over == 0) {
            $('.carried_over_info').addClass('d-none')
        } else {
            $('.carried_over_info').removeClass('d-none')
        }
        showactivePackageNow();
    }

    // show package payment modal
    function showactivePackageNow() {
        $('#activePackageNow').modal('show')
    }

    // handle package payment
    function handleRecurringPayment($this) {
   
        let subscription_user_id = $($this).data('subscription_user_id');
        let gateway            = $($this).data('gateway');
        let type               = $($this).data('type');

        $('.subscription_user_id').val(subscription_user_id);
        $('.payment_gateway_auto_payment').val(gateway);
        
        if(type == 'active') {
            $('#activeRecurringPaymentNow').modal('show');
        }else if(type =='cancel'){
            $('#cancelReecurringPaymentNow').modal('show');
        }
    }

    $(document).on('click','.feedbackBackButton', function(e){
        hideElement('#paymentDetailDiv');
        hideElement('#reSubmitDiv');
        showElement('#feedbackBack');
        $('.feedbackBackButton').addClass('paymentDetailDivButton');
        $('.feedbackBackButton').removeClass('feedbackBackButton');
    })
    $(document).on('click','.paymentDetailDivButton', function(e){
        showElement('#paymentDetailDiv');
        hideElement('#reSubmitDiv');
        hideElement('#feedbackBack');
        $('.paymentDetailDivButton').addClass('feedbackBackButton');
        $('.paymentDetailDivButton').removeClass('paymentDetailDivButton');

    })


    // clear data
    function clearData() {
        $('#subscription_user_id').val('');
    }
</script>