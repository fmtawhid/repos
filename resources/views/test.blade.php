<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Summernote Editor with Streaming</title>

    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>

    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

    <!-- Summernote -->
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.20/dist/summernote-lite.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.20/dist/summernote-lite.min.js"></script>

    <style>
        #streamOutput {
            font-family: monospace;
            white-space: pre-wrap;
            background-color: #f8f9fa;
            min-height: 100px;
        }
    </style>
</head>
<body class="container mt-5">
<h2>Streaming HTML Editor</h2>

<!-- Summernote Editor -->
<div class="row mb-4">
    <div class="col-md-12">
        <textarea id="summernote" name="content"></textarea>
    </div>
</div>

<!-- Stream Output -->
<div class="row">
    <div class="col-md-12">
        <h4>Stream Output:</h4>
        <div id="streamOutput" class="border p-3"></div>
    </div>
</div>

<script>
    $(document).ready(function() {
        // Initialize Summernote
        $('#summernote').summernote({
            height: 300,
            toolbar: [
                ['style', ['style']],
                ['font', ['bold', 'underline', 'clear']],
                ['color', ['color']],
                ['para', ['ul', 'ol', 'paragraph']],
                ['table', ['table']],
                ['view', ['codeview']]
            ]
        });

        // Stream handling
        const eventSource = new EventSource('/stream');
        let buffer = '';
        const streamOutput = document.getElementById('streamOutput');

        eventSource.onmessage = (event) => {
            // Append new content with a space if it's a word
            if (!event.data.startsWith('<') && !event.data.endsWith('>')) {
                buffer += (buffer.endsWith('>') ? ' ' : '') + event.data;
            } else {
                buffer += event.data;
            }

            // Update displays
            streamOutput.textContent = buffer;
            $('#summernote').summernote('code', buffer);
        };

        eventSource.onerror = (error) => {
            console.error('EventSource failed:', error);
            eventSource.close();
        };
    });
</script>
</body>
</html>