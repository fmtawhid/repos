<script>
    $(document).on('click', '.copyChat', function(e) {

        let textToCopy = $('.note-editable').text();
        let copyText = clearFormatData(textToCopy);

        if(!copyText){
            toast('{{ localize('The article has not been generated yet') }}',"error");
            return;
        }

        if (navigator.clipboard && navigator.clipboard.writeText) {
            // Use the Clipboard API if available
            navigator.clipboard.writeText(copyText).then(function() {
            }).catch(function(err) {
                toast(`{{ localize('Failed to copy text: ') }} ${err}`, 'error');
            });
        } else {
            // Fallback for older browsers
            let tempTextarea = $('<textarea>');
            tempTextarea.val(copyText).appendTo('body').select();

            try {
                document.execCommand('copy');
            } catch (err) {
                console.error('Fallback failed to copy text: ', err);
            }

            tempTextarea.remove();
        }

        toast('{{ localize('Chat has been copied successfully') }}');
    });

    function clearFormatData(copyText) {

        copyText = copyText.replaceAll(/(?:\r\n|\r|\n)/g, '');
        copyText = copyText.replaceAll('                        ', ' ');
        copyText = copyText.replaceAll('     ', ' ');
        copyText = copyText.replaceAll('    ', '');
        copyText = copyText.replaceAll('<br>', '\n');
        copyText = copyText.replaceAll('<span>', '');
        copyText = copyText.replaceAll('</span>', '');
        return copyText;
    }
</script>