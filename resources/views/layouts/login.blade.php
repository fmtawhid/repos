<!DOCTYPE html>
<html lang="en" data-bs-theme="light">
<head>
    <!--required meta tags-->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!--meta-->
    <meta name="description" content="@yield('description', 'WriteBot ai content generator and writing assistant for saas platform'))">
    <meta name="keywords" content="@yield('keywords', 'ai, ai assistant, ai content writer, ai copywriting, ai image generator, ai speech to text, ai writer, chat gpt3, chatgpt, content generation, dall-e, openai, openai dalle, openai davinci, Text Generation'))">
    <meta name="author" content="ThemeTags">
    @yield('meta')
    <!--favicon icon-->
    <link rel="icon" href="{{ avatarImage(getSetting('favicon')) ?? asset('assets/img/favicon.png') }}" type="image/png" sizes="16x16">

    <!--title-->
    <title>@yield('title', config('app.name', 'Laravel'))</title>
    
    @if (getSetting('enable_recaptcha') == 1)
        {!! RecaptchaV3::initJs() !!}
    @endif
    <!--build:css-->
    @include('common.css')
    <!-- endbuild -->

    @stack('css')

</head>

<body>
    @if(getSetting('enable_preloader') !=0)
        <!--preloader start-->
        @include('common.preloader')
        <!--preloader end-->
    @endif
    <!--main content wrapper start-->
    <section class="d-flex align-items-center position-relative bg-secondary-subtle min-vh-100">

        <!--login registration section start-->
        <div class="container">
          
            @yield('content')

        </div>
        <!--login registration section end-->

    </section>
    <!--main content wrapper end-->

    <!--build:js-->
    @include('common.js')
    @yield('js')
</body>

</html>
