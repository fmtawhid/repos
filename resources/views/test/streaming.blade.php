<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Stream Response</title>
</head>
<body>
    <div id="output"></div>

    <script>
        const outputDiv = document.getElementById('output');
        const eventSource = new EventSource('/stream');

        eventSource.onmessage = function(event) {
            const data = event.data;
            outputDiv.innerHTML += data + '<br>';
        };

        eventSource.onerror = function(event) {
            console.error('EventSource failed:', event);
            eventSource.close();
        };
    </script>
</body>
</html>
