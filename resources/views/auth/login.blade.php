@extends('layouts.login')
@section('title')
    {{ localize('Login') }} {{ getSetting('tab_separator') }} {{ getSetting('system_title') }}
@endsection
@section('content')
    @php
        $authImage = getSetting("auth_image");
        $darkLogo = getSetting("logo_for_dark");
        $finalLogo = $darkLogo;

        if(empty($darkLogo)){
            $finalLogo = getSetting("logo_for_light");
        }

        if(empty($finalLogo)){
            $finalLogo = asset('assets/img/logo-color.png');
        }
    @endphp

    <div class="row justify-content-center">
        <div class="col-lg-10">
            <div class="tt-form-container bg-light p-4 d-flex shadow-sm rounded-4 my-4 my-lg-0">
                <div class="tt-from-img rounded-2 me-md-4 d-none d-md-block"
                    style="background: url({{ avatarImage($authImage) ?? asset('/assets/img/login-img.jpg') }})no-repeat center center / cover">
                </div>

                <!-- login form wrap start -->
                <div class="tt-form-content p-lg-4 py-lg-5 py-5">
                    <!-- login head info start -->

                    <div class="mb-6">
                        <a href="{{ route('layouts') }}" class="navbar-brand d-block mb-4 text-decoration-none">
                            @if(!empty($finalLogo))
                                <img src="{{ avatarImage($finalLogo) }}"
                                     alt="logo"
                                     class="img-fluid logo-color" />

                            @else
                                <img src="{{ asset('assets/img/logo-color.png') }}" alt="logo"
                                     class="img-fluid logo-color" />
                            @endif
                        </a>

                        <h2 class="h4 fw-bold">{{ localize('Welcome Back') }}</h2>
                        <p class="text-muted">{{ localize('Sign in to your account to continue') }}</p>
                    </div>
                    <!-- login head info end -->

                    <!-- login form start -->
                    <form action="{{ route('login') }}" method="POST" class="tt-login-register-form">
                        @csrf
                        <div class="row">
                            @include('flash::message')
                            <div class="col-sm-12">
                                <x-form.label for="email" label="{{ localize('Email') }}" isRequired=1 />
                                <x-form.input name="email" type="email" id="email"
                                    placeholder="{{ localize('Email') }}" value="" divClass="mb-3" />
                                {{ errorBlock('email') }}
                            </div>
                            <div class="col-sm-12">

                                <div class="d-flex justify-content-between">

                                    <x-form.label for="password" label="{{ localize('Password') }}" isRequired=1 />
                                    @if (Route::has('password.request'))
                                        <a href="{{ route('password.request') }}"
                                            class="fs-md">{{ localize('Forgot Password?') }}</a>
                                    @endif
                                </div>
                                <x-form.input name="password" type="password" id="password"
                                    placeholder="{{ localize('Password') }}" value="{{ old('password') }}"
                                    divClass="tt-check-password mb-3">
                                    <span class="tt-eye-check eye-icon"><i data-feather="eye"></i></span>
                                    <span class="tt-eye-check eye-icon-off"><i data-feather="eye-off"></i></span>
                                </x-form.input>
                            </div>
                            <div class="col-12">
                                <div class="form-check">
                                    <x-form.input name="remember" id="remember" type="checkbox" class="form-check-input"
                                        value="{{ old('remember') ? 'checked' : '' }}" showDiv=0 />
                                    <x-form.label class="form-check-label" for="remember"
                                        label="{{ localize('Remember Me') }}" />
                                </div>
                            </div>
                            <div class="col-12">

                                <button type="submit"
                                    class="btn btn-primary mt-3 d-block w-100">{{ localize('Login') }}</button>
                            </div>
                        </div>
                        <!-- <p class="mt-3 text-center">{{ localize('Don’t have an account?') }} <a
                                href="{{ route('register') }}" class="fw-medium">{{ localize('Sign up for free!') }}</a>

                        </p> -->

                    </form>
                    <!--demo credentials-->
                    @if (env('DEMO_MODE') == 'On')
                        <div class="row my-3">
                            <div class="col-12 mt-3">
                                <label class="fw-bold">Vendor Access</label>
                                <div class="d-flex flex-wrap align-items-center justify-content-between">
                                    <small>vendor@themetags.com</small>
                                    <small>123456</small>

                                    <button class="btn btn-sm btn-secondary py-0 px-2" type="button"
                                        onclick="copyCustomer()">Copy</button>
                                </div>
                            </div>

                            <div class="col-12">
                                <label class="fw-bold">Admin Access</label>
                                <div class="d-flex flex-wrap align-items-center justify-content-between border-bottom pb-3">
                                    <small>admin@themetags.com</small>
                                    <small>123456</small>
                                    <button class="btn btn-sm btn-secondary py-0 px-2" type="button"
                                        onclick="copyAdmin()">Copy</button>
                                </div>
                            </div>
                        </div>
                    @endif
                    <!--demo credentials-->
                    <!-- login form end -->
                    @if (getSetting('google_login') == 1 || getSetting('facebook_login') == 1)
                        <div class="tt-or-divider">
                            {{ localize('Or') }}
                        </div>

                        <!-- social login start -->
                        <div class="d-flex justify-content-center gap-3 mt-4">
                            @if (getSetting('google_login') == 1)
                                <a href="{{ route('social.login', ['provider' => 'google']) }}"
                                    class="btn btn-light btn-icon rounded-circle text-center border border-2 btn-shadow d-flex p-2">
                                    <img src="{{ asset('assets/img/website/google-icon.svg') }}" alt="google">
                            @endif
                            @if (getSetting('facebook_login') == 1)
                                </a><a href="{{ route('social.login', ['provider' => 'facebook']) }}"
                                    class="btn btn-light btn-icon rounded-circle text-center border border-2 btn-shadow d-flex p-2">
                                    <img src="{{ asset('assets/img/website/facebook-icon.svg') }}" alt="google">
                                </a>
                            @endif
                        </div>
                    @endif
                    <!-- social login end -->
                </div>
                <!-- login form wrap end -->

            </div>
        </div>
    </div>
@endsection
@section('js')
    <script>
        "use strict";

        // copyAdmin
        function copyAdmin() {
            $('#email').val('admin@themetags.com');
            $('#password').val('123456');
        }

        // copyCustomer
        function copyCustomer() {
            $('#email').val('customer@themetags.com');
            $('#password').val('123456');
        }

        // change input to phone
        function handleLoginWithPhone() {
            $('.login_with').val('phone');

            $('.login-email').addClass('d-none');
            $('.login-email input').prop('required', false);

            $('.login-phone').removeClass('d-none');
            $('.login-phone input').prop('required', true);
        }

        // change input to email
        function handleLoginWithEmail() {
            $('.login_with').val('email');
            $('.login-email').removeClass('d-none');
            $('.login-email input').prop('required', true);

            $('.login-phone').addClass('d-none');
            $('.login-phone input').prop('required', false);
        }


        // disable login button
        function handleSubmit() {
            $('#login-form').on('submit', function(e) {
                $('.sign-in-btn').prop('disabled', true);
            });
        }
    </script>
@endsection
