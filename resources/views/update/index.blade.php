<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update</title>
</head>
<body>
<h1>Upload Update ZIP File</h1>

@if(session('success'))
    <p style="color: green;">{{ session('success') }}</p>
@endif

@if(session('error'))
    <p style="color: red;">{{ session('error') }}</p>
@endif

<form action="{{ route('update.upload') }}" method="POST" enctype="multipart/form-data">
    @csrf
    <label for="update_zip">Choose ZIP File:</label>
    <input type="file" name="update_zip" id="update_zip" required>
    <button type="submit">Upload</button>
</form>
</body>
</html>
