<script>
    'use strict';

    $(".adSenseForm").submit(function(e) {
        e.preventDefault();
        loading('.adSenseSubmitButton', 'Saving...');
        let formId =  $(this).attr("id");
   
        let callParams  = {};
        callParams.type = "POST";
        callParams.url  = $("form#"+formId).attr("action");
        callParams.data = new FormData($("#"+formId)[0]);
        callParams.processData = false;
        callParams.contentType = false;
        ajaxCall(callParams, function(result) {
            resetLoading('.adSenseSubmitButton',"{{localize('Save Configuration')}}");
            toast(result.message);
          
        }, function(err, type, httpStatus) {
            resetLoading('.adSenseSubmitButton',"{{localize('Save Configuration')}}");
            toast(err.responseJSON.message, 'error');
        });

        return true;
    });

</script>
