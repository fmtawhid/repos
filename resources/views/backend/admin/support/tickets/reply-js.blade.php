<script>
    'use strict';

    $(document).on('click', '#post_a_reply', function() {
            $("#post_reply").toggleClass("d-none");
        })
    $(document).on('click', '.confirm-delete', function(e) {
            e.preventDefault();
            var url = $(this).data("href");
            $("#delete-modal").modal("show");
            $("#delete-link").attr("href", url);
    })
    $("#replyTicketForm").submit(function(e) {
        e.preventDefault();
        alert('ok');
        resetFormErrors('form#replyTicketForm');
        loading('#frmActionBtn', 'Saving...');

        let id = $("#replyTicketForm #id").val();
        let callParams = {};

        callParams.type = "POST";
        callParams.url = $("form#replyTicketForm").attr("action");
        callParams.data = $("form#replyTicketForm").serialize();

        ajaxCall(callParams, function(result) {
            resetLoading('#frmActionBtn', 'Reply Ticket');
            toast(result.message);

        }, function(err, type, httpStatus) {
            showFormError(err, '#addTicketForm');
            resetLoading('#frmActionBtn', 'Reply Ticket');
        });

        return false;
    });
</script>
