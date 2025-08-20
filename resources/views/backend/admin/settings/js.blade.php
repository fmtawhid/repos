<script>
    'use strict';
    if(document.getElementById("header_custom_css")) {
        var customCssEditor = CodeMirror.fromTextArea(document.getElementById("header_custom_css"), {
            lineNumbers: false,
            mode: "javascript",  // You can change this to other modes like 'php', 'html', etc.
            theme: "monokai",    // You can choose another theme if you like
        });
    }
    if(document.getElementById("header_custom_scripts")) {
        var headerCustomJsEditor = CodeMirror.fromTextArea(document.getElementById("header_custom_scripts"), {
            lineNumbers: false,
            mode: "javascript",  // You can change this to other modes like 'php', 'html', etc.
            theme: "monokai",    // You can choose another theme if you like
        });
    }
    if(document.getElementById("footer_custom_scripts")) {
        var footerCustomJsEditor = CodeMirror.fromTextArea(document.getElementById("footer_custom_scripts"), {
            lineNumbers: false,
            mode: "javascript",  // You can change this to other modes like 'php', 'html', etc.
            theme: "monokai",    // You can choose another theme if you like
        });
    }
    $(document).ready(function() {
        getChosenFilesCount();
        showSelectedFilePreviewOnLoad();
    });

    $(".settingsForm").submit(function(e) {
        e.preventDefault();
        let formId     =  $(this).attr("id");
        let hashFormId = `#${formId}`;
        var buttonName = hashFormId +' .settingsSubmitButton';


        loading(buttonName, 'Saving...');

        let callParams  = {};
        callParams.type = "POST";
        callParams.url  = $(`form${hashFormId}`).attr("action");
        callParams.data = new FormData($(hashFormId)[0]);
        callParams.processData = false;
        callParams.contentType = false;

        ajaxCall(callParams, function(result) {
            resetLoading(buttonName,"{{localize('Save Configuration')}}");
            toast(result.message);
          
        }, function(err, type, httpStatus) {
            resetLoading(buttonName,"{{localize('Save Configuration')}}");
            toast(err.responseJSON.message, 'error');
        });

        return true;
    });

    $("#settings-custom-scripts-form").submit(function(e) {
        e.preventDefault();
        let formId =  $(this).attr("id");
        var buttonName = "#"+formId +' .settingsSubmitButton';
        loading(buttonName, 'Saving...');
        let headerCustomScript =  $("#header_custom_scripts").val();
        let footerCustomScript =  $("#footer_custom_scripts").val();
        let customCss          =  $("#header_custom_css").val();
        let enable_script      =  $("#enable_script").val();
        let enable_css         =  $("#enable_css").val();
     
        let data = {
             _token:"{{ csrf_token() }}",
             "settings[header_custom_scripts]":headerCustomScript,
             "settings[footer_custom_scripts]":footerCustomScript,
             "settings[header_custom_css]":customCss,
             "settings[enable_script]":enable_script,
             "settings[enable_css]":enable_css,
             "is_scripts":1,
        }
        let callParams  = {};
        callParams.type = "POST";
        callParams.url  = $("form#"+formId).attr("action");
        callParams.data = data;
        ajaxCall(callParams, function(result) {
            resetLoading(buttonName,"{{localize('Save Configuration')}}");
            toast(result.message);
          
        }, function(err, type, httpStatus) {
            resetLoading(buttonName,"{{localize('Save Configuration')}}");
            toast(err.responseJSON.message, 'error');
        });

        return true;
    });


    $(document).on('change', '.enableDisable', function() {
        saveSettings({
            entity: $(this).data('entity'), 
            value: $(this).is(':checked') ? 1: 0, 
            url: "{{ route('admin.settings.store') }}",
            _token:"{{ csrf_token() }}"
        });

        return true;
    });

    $(document).on('change', '.selectDefaultEngine', function() {

        saveSettings({
            entity: $(this).data('entity'), 
            value: $(this).val(), 
            url: "{{ route('admin.settings.store') }}",
            _token:"{{ csrf_token() }}"
        });

        return true;
    });

    $(document).ready(function() {
        $('.summernoteCode').summernote({
            
        });
    });

    let entityMap = {
            '&': '&amp;',
            '<': '&lt;',
            '>': '&gt;',
            '"': '&quot;',
            "'": '&#39;',
            '/': '&#x2F;',
            '`': '&#x60;',
            '=': '&#x3D;'
        };
    function escapeHtml (string) {
        return String(string).replace(/[&<>"'`=\/]/g, function (s) {
            return entityMap[s];
        });
    }
</script>
