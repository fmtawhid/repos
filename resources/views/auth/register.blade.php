@extends('layouts.login')
@section('title')
    {{ localize('Register') }} {{ getSetting('tab_separator') }} {{ getSetting('system_title') }}
@endsection
@section('content')
    @php
        $authImage = getSetting("auth_image");
        $darkLogo  = getSetting("logo_for_dark");
        $finalLogo = $darkLogo;

        if(empty($darkLogo)){
            $finalLogo = getSetting("logo_for_light");
        }

        if(empty($finalLogo)){
            $finalLogo = asset('assets/img/logo-color.png');
        }
    @endphp

    <div class="container">
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
                                         class="img-fluid logo-color"
                                    />
                                @else
                                    <img src="{{ asset('assets/img/logo-color.png') }}"
                                         alt="logo"
                                         class="img-fluid logo-color"
                                    />
                                @endif
                            </a>

                            <h2 class="h4 fw-bold">{{ localize('Welcome Back') }}</h2>
                            <p class="text-muted">{{ localize('Sign in to your account to continue') }}</p>
                        </div>
                        <!-- login head info end -->

                        <!-- registration form start -->
                        <form action="{{ route('register') }}" method="POST" class="tt-login-register-form">
                            @csrf
                            @if (getSetting('enable_recaptcha') == 1)
                                {!! RecaptchaV3::field('recaptcha_token') !!}
                            @endif
                            <div class="row">
                                <div class="col-sm-6">
                                    <label for="first_name" class="form-label">{{ localize('First Name') }} <span
                                            class="text-danger">*</span>
                                    </label>

                                    <div class="input-group mb-3">
                                        <input id="first_name" type="text"
                                            class="form-control @error('first_name') is-invalid @enderror" name="first_name"
                                            value="{{ old('first_name') }}" placeholder="{{ localize('First Name') }}"
                                            aria-label="{{ localize('First Name') }}">
                                        {{ errorBlock('first_name') }}
                                    </div>
                                </div>

                                <div class="col-sm-6">
                                    <label for="last_name" class="form-label">{{ localize('Last Name') }} <span
                                            class="text-danger">*</span>
                                    </label>

                                    <div class="input-group mb-3">
                                        <input id="last_name" type="text"
                                            class="form-control @error('last_name') is-invalid @enderror" name="last_name"
                                            value="{{ old('last_name') }}" placeholder="{{ localize('Last Name') }}"
                                            aria-label="{{ localize('Last  Name') }}">
                                        {{ errorBlock('last_name') }}
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-sm-12">
                                    <label for="email" class="form-label">{{ localize('Email') }} <span
                                            class="text-danger">*</span></label>
                                    <div class="input-group mb-3">
                                        <input id="email" type="email"
                                            class="form-control @error('email') is-invalid @enderror" name="email"
                                            value="{{ old('email') }}" placeholder="{{ localize('Email') }}"
                                            aria-label="{{ localize('Email') }}">
                                        {{ errorBlock('email') }}
                                    </div>
                                </div>
                                <div class="col-sm-12">
                                    <label for="mobile_no" class="form-label">{{ localize('Mobile') }} 
                                    @if (getSetting('registration_with') == 'email_and_phone')
                                        <span class="text-danger">*</span>
                                    @endif
                                    </label>
                                    <div class="input-group mb-3">
                                        <input id="mobile_no" type="text"
                                            class="form-control @error('mobile_no') is-invalid @enderror" name="mobile_no"
                                            value="{{ old('mobile_no') }}" placeholder="012345678"
                                            aria-label="012345678">
                                        {{ errorBlock('mobile_no') }}
                                    </div>
                                </div>
                                <div class="col-sm-12">
                                    <label for="password" class="form-label">{{ localize('Password') }} <span
                                            class="text-danger">*</span></label>
                                    <div class="input-group tt-check-password mb-3">
                                        <input id="password" type="password"
                                            class="form-control rounded-end @error('password') is-invalid @enderror"
                                            name="password" placeholder="{{ localize('Password') }}"
                                            aria-label="{{ localize('Password') }}" autocomplete="current-password">
                                        <span class="tt-eye-check eye-icon"><i data-feather="eye"></i></span>
                                        <span class="tt-eye-check eye-icon-off"><i data-feather="eye-off"></i></span>
                                    </div>
                                    @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                    <div class="form-check">
                                        <input class="form-check-input" name="i_agree" type="checkbox" id="ex-check-1">
                                        <label class="form-check-label"
                                            for="ex-check-1">{{ localize('I agree with WriteBot') }} <a
                                                href="{{route('terms-conditions')}}" target="_blank">{{ localize('Terms of Service') }}</a>,
                                            <a
                                                href="{{route('privacy-policy')}}" target="_blank">{{ localize('Privacy Policy') }}</a>{{ localize(', and default') }}
                                            .</label>
                                            </div>
                                            {{ errorBlock('i_agree') }}
                                </div>

                                <div class="col-12">
                                    <button type="submit"
                                        class="btn btn-primary mt-3 d-block w-100">{{ localize('Sign Up') }}</button>
                                </div>
                            </div>
                            <p class="mt-3 text-center">{{ localize('Already have an account?') }} <a
                                    href="{{ route('login') }}" class="fw-medium">{{ localize('Sign In') }}</a>
                            </p>
                        </form>
                        <!-- registration form end -->
                        @if (getSetting('google_login') == 1 || getSetting('facebook_login') == 1)
                        <div class="tt-or-divider">
                            {{ localize('Or') }}
                        </div>
                   
                        <!-- social login start -->
                        <div class="d-flex justify-content-center gap-3 mt-4">
                            @if (getSetting('google_login') == 1)
                                <a href="{{ route('social.login', ['provider' => 'google']) }}"
                                    class="btn btn-light btn-icon rounded-circle text-center border btn-shadow d-flex p-2">
                                    <img src="{{ asset('assets/img/website/google-icon.svg') }}" alt="google">
                            @endif
                            @if (getSetting('facebook_login') == 1)
                                </a><a href="{{ route('social.login', ['provider' => 'facebook']) }}"
                                    class="btn btn-light btn-icon rounded-circle text-center border btn-shadow d-flex p-2">
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
    </div>
@endsection
