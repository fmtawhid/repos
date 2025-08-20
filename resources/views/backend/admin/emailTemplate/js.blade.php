<script>
    'use strict';
    $('.emailTemplateEditor').summernote({
        height: 450,
    });
    $(".emailTemplateForm").submit(function(e) {
        e.preventDefault();
        loading('.saveEmailtemplateButton', 'Saving...');
        let formId =  $(this).attr("id");
   
        let callParams  = {};
        callParams.type = "POST";
        callParams.url  = $("form#"+formId).attr("action");
        callParams.data = new FormData($("#"+formId)[0]);
        callParams.processData = false;
        callParams.contentType = false;
        ajaxCall(callParams, function(result) {
            resetLoading('.saveEmailtemplateButton',"{{localize('Save Configuration')}}");
            toast(result.message);
          
        }, function(err, type, httpStatus) {
            resetLoading('.saveEmailtemplateButton',"{{localize('Save Configuration')}}");
            toast(err.responseJSON.message, 'error');
        });

        return true;
    });

</script>
