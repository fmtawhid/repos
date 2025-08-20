<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <h3>{{ localize('Health Check') }}</h3>
    <p>
        @if($is_success)
            {{ localize('Your system is healthy!') }} - {{ $message }}
        @else
            {{ localize('Your system is not healthy!') }}
        @endif
    </p>

    <p>{{ localize("Code") }}: {{ $code }}</p>
</body>
</html>