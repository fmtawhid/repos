<script src="{{ asset('assets/js/vendors/toastr.min.js') }}"></script>
<script src="{{ asset('assets/js/vendors/sweetalert2@11.js') }}"></script>
<script>
    "use strict";
    function resetLoading(selector, text) {
        $(selector).prop("disabled", false).html(text);
    }

    function showElement(selector) {
        if ($(selector).hasClass("d-none")) {
            $(selector).removeClass("d-none");
        }
    }
    function removeElement(selector) {
        if ($(selector).length > 0) {
            $(selector).remove();
        }
    }
    function hideElement(selector) {
        if (!$(selector).hasClass("d-none")) {
            $(selector).addClass("d-none");
        }
    }
    function showError(message) {
        showElement(".message-wrapper");
        hideElement(".message-wrapper .alert.alert-success");
        $(".message-wrapper .alert.alert-danger").html(message);
    }
     // Set the options that I want
    toastr.options = {
        closeButton: true,
        newestOnTop: false,
        progressBar: true,
        positionClass: "toast-top-center",
        preventDuplicates: false,
        onclick: null,
        showDuration: "3000",
        hideDuration: "1000",
        timeOut: "5000",
        extendedTimeOut: "1000",
        showEasing: "swing",
        hideEasing: "linear",
        showMethod: "fadeIn",
        hideMethod: "fadeOut",
    };
    const Toast = Swal.mixin({
        toast: true,
        position: "top-end",
        showConfirmButton: false,
        timerProgressBar: true,
        timer: 10000,
        didOpen: (toast) => {
            toast.onmouseenter = Swal.stopTimer;
            toast.onmouseleave = Swal.resumeTimer;
        },
    });
    // status = warning, error, success, info, and question
    function toast(msg, status = "success", position = "top-end") {
        Toast.fire({
            icon: status,
            title: `<span class="toast-msg">${msg}</span>`,
            showCloseButton: true,
            position,
            customClass: {
                closeButton: "tt-sw-close-button",
                icon: "tt-sw-icon",
            },
        });
    }
    // ajaxcall
    function ajaxCall(
        callParams,
        successCallback,
        errorCallback,
        timeout = 20000,
        quietMillis = 100
    ) {
        let ajaxOption = {
            url: callParams.url,
            timeout: timeout,
            type: callParams.type || "POST", // "POST" OR "GET
            dataType: callParams.dataType || "JSON",
            data: callParams.data || {},
            cache: callParams.cache || false,
            processData: callParams.processData || false,
            contentType: callParams.contentType || false,
            complete: callParams.complete || function() {},
            success: successCallback,
            error: errorCallback,
        };

        if (!callParams.hasOwnProperty("processData")) {
            delete ajaxOption.processData;
        }
        if (!callParams.hasOwnProperty("contentType")) {
            delete ajaxOption.contentType;
        }

        if (!callParams.hasOwnProperty("cache")) {
            delete ajaxOption.cache;
        }

        if (!callParams.hasOwnProperty("complete")) {
            delete ajaxOption.complete;
        }

        $.ajax(ajaxOption);
    }

    function loading(selector, text = "Loading...") {
        $(selector)
            .html(
                '<span class="spinner-border spinner-border-sm me-2" role="status" aria-hidden="true"></span>' +
                text
            )
            .prop("disabled", true);
    }
    // toastr js

    function resetFormErrors(frmSelector) {
        hideElement(".message-wrapper");
        removeElement(frmSelector + " .invalid-feedback");
        $(frmSelector).each(function() {
            $(this).find(":input").removeClass("is-invalid");
        });
    }

    function showFormError(responseData, formSelector = "") {
        responseData = JSON.parse(responseData?.responseText ?? []);
        showError(responseData?.message);

        $.each(responseData?.errors ?? [], function(fieldName, errorMessage) {
            let fieldHtml = `<span class="invalid-feedback" role="alert">${errorMessage[0]}</span>`;
            $(formSelector + " #" + fieldName + "")
                .addClass("is-invalid")
                .after(fieldHtml);
        });
    }

    function resetForm(formSelector) {
        $(formSelector).find('input:text, input:password, input:file, select, textarea').val('');
        $('#editor').summernote('code', '');
    }
    function showFormError(responseData, formSelector = "") {
        responseData = JSON.parse(responseData?.responseText ?? []);
        showError(responseData?.message);

        $.each(responseData?.errors ?? [], function (fieldName, errorMessage) {
            let fieldHtml = `<span class="invalid-feedback" role="alert">${errorMessage[0]}</span>`;
            $(formSelector + " #" + fieldName + "")
                .addClass("is-invalid")
                .after(fieldHtml);
        });
    }
</script>
