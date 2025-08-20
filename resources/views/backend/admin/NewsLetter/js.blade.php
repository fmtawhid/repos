<script>
    $("#selectAll").click(function() {
        if ($("#selectAll").is(':checked')) {
            $("#subscriber_emails > option").prop("selected", "selected");
            $("#subscriber_emails").trigger("change");
        } else {
            $('#subscriber_emails').select2('destroy').find('option').prop('selected', false).end().select2();
            $("#subscriber_emails").trigger("change");
        }
    });
    // add Tag
    $("#bulkSendMessage").submit(function(e) {
        e.preventDefault();
        resetFormErrors('form#bulkSendMessage');
        loading('#frmActionBtn', 'sending...');

        let id = $("#bulkSendMessage #id").val();
        let callParams = {};

        callParams.type = "POST";
        callParams.url = $("form#bulkSendMessage").attr("action");
        callParams.data = $("form#bulkSendMessage").serialize();

        ajaxCall(callParams, function(result) {
            resetLoading('#frmActionBtn', 'Save');
            toast(result.message);
        }, function(err, type, httpStatus) {
            showFormError(err, '#bulkSendMessage');
            resetLoading('#frmActionBtn', 'Save');
        });

        return false;
    });
</script>
