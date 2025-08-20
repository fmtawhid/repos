<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title')</title>

    <link rel="stylesheet" href="{{ asset('assets/css/error.css') }}">
        

</head>
<body>
    <div class="container">
        <!-- Replace the src with your logo -->
        <img class="logo" src="{{asset('assets/img/error.png')}}" alt="Logo">

        <h1>@yield('code')</h1>
        <h2>@yield('title')</h2>
        <p>@yield('message')</p>
        <a href="{{ url('/') }}" class="btn">{{localize('Return to Home')}}</a>
    </div>
</body>
</html>
