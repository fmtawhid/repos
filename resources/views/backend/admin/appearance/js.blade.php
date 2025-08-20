<script>
    'use strict';
    $(".appearanceForm").submit(function(e) {
        e.preventDefault();
       
        loading('.settingsSubmitButton', 'Saving...');
        let formAtrrId =  $(this).attr("id");
        let callParams = {};
        callParams.type = "POST";
        callParams.url = $("form#"+formAtrrId).attr("action");
        callParams.data = new FormData($("#"+formAtrrId)[0]);

        callParams.processData = false;
        callParams.contentType = false;
        ajaxCall(callParams, function(result) {
            resetLoading('.settingsSubmitButton',"{{localize('Save Configuration')}}");
            toast(result.message);
          
        }, function(err, type, httpStatus) {
            resetLoading('.settingsSubmitButton',"{{localize('Save Configuration')}}");
            toast(err.responseJSON.message, 'error');
        });

        return true;
    });

    $(document).ready(function() {
        getChosenFilesCount();
        showSelectedFilePreviewOnLoad();
    });
</script>
