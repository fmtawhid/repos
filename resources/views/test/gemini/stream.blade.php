<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chat Streaming with Gemini</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
        }

        #chatBox {
            border: 1px solid #ccc;
            padding: 10px;
            margin-top: 20px;
            height: 300px;
            overflow-y: scroll;
            background-color: #f9f9f9;
        }

        #chatBox p {
            margin: 5px 0;
        }

        #chatBox .user {
            color: blue;
        }

        #chatBox .ai {
            color: green;
        }

        form {
            margin-top: 20px;
        }

        textarea {
            width: 100%;
            height: 80px;
        }

        button {
            margin-top: 10px;
            padding: 10px 20px;
            background-color: #007bff;
            color: white;
            border: none;
            cursor: pointer;
        }

        button:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
<h1>Chat with Gemini</h1>

<form id="chatForm">
    <textarea id="message" placeholder="Type your message here...">What is Laravel?</textarea><br>
    <button type="submit">Send</button>
</form>

<div id="chatBox">
    <p><b>Chat:</b></p>
</div>

<script>
    document.getElementById('chatForm').addEventListener('submit', function (e) {
        e.preventDefault();

        const message = document.getElementById('message').value;
        const chatBox = document.getElementById('chatBox');

        // Append the user's message to the chatBox
        chatBox.innerHTML += `<p class="user"><b>You:</b> ${message}</p>`;
        chatBox.scrollTop = chatBox.scrollHeight;

        // Open an EventSource connection to the Laravel backend
        const eventSource = new EventSource(`{{ route("geminiTestStream") }}?message=${encodeURIComponent(message)}`);

        eventSource.onmessage = function (event) {
            if (event.data === "[END]") {
                // Handle end of stream
                chatBox.innerHTML += `<p><b>Stream finished.</b></p>`;
                eventSource.close();
                return;
            }

            // Append AI's response to the chatBox
            chatBox.innerHTML += `${event.data}`;
            chatBox.scrollTop = chatBox.scrollHeight;
        };

        eventSource.onerror = function () {
            chatBox.innerHTML += `<p style="color:red;">Connection lost. Please try again later.</p>`;
            eventSource.close();
        };

        eventSource.onopen = function () {
        };
    });
</script>
</body>
</html>
