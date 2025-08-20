@extends('layouts.login')
@section('title')
    {{ localize('Password Reset') }} {{ getSetting('title_separator') }} {{ getSetting('system_title') }}
@endsection
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-10">
                <div class="tt-form-container bg-light p-4 d-flex shadow-sm rounded-4 my-4 my-lg-0">
                    <div class="tt-from-img rounded-2 me-md-4 d-none d-md-block"
                        style="background: url({{ avatarImage(getSetting('auth_image')) ?? asset('assets/img/login-img.jpg') }}) no-repeat center center / cover">
                    </div>

                    <!-- login form wrap start -->
                    <div class="tt-form-content p-lg-4 py-lg-5 py-5">

                        <form method="POST" action="{{ route('password.update') }}">
                            @csrf

                            <input type="hidden" name="token" value="{{ $token }}">

                            <div class="row mb-3">
                                <label for="email" class="form-label">{{ localize('Email Address') }}</label>
                                <div class="col-md-12">
                                    <input id="email" type="email" readonly
                                        class="form-control @error('email') is-invalid @enderror" name="email"
                                        value="{{ $email ?? old('email') }}" required autocomplete="email" autofocus>

                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">

                                <label for="password" class="form-label">{{ localize('Password') }} <span
                                        class="text-danger">*</span></label>
                                <div class="input-group tt-check-password mb-3">
                                    <input id="password" type="password"
                                        class="form-control rounded-end @error('password') is-invalid @enderror"
                                        name="password" placeholder="{{ localize('Password') }}"
                                        aria-label="{{ localize('Password') }}" autocomplete="new-password">
                                    <span class="tt-eye-check eye-icon"><i data-feather="eye"></i></span>
                                    <span class="tt-eye-check eye-icon-off"><i data-feather="eye-off"></i></span>
                                </div>
                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="row mb-3">
                               
                                <label for="password_confirmation" class="form-label">{{ localize('Confirm Password') }} <span
                                        class="text-danger">*</span></label>
                                <div class="input-group tt-check-password mb-3">
                                    <input id="password" type="password"
                                        class="form-control rounded-end @error('password') is-invalid @enderror"
                                        name="password_confirmation" placeholder="{{ localize('Password') }}"
                                        aria-label="{{ localize('password_confirmation') }}" autocomplete="new-password">
                                    <span class="tt-eye-check eye-icon"><i data-feather="eye"></i></span>
                                    <span class="tt-eye-check eye-icon-off"><i data-feather="eye-off"></i></span>
                                </div>
                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        {{ localize('Reset Password') }}
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                    <!-- login form wrap end -->

                </div>
            </div>
        </div>
    </div>
@endsection
