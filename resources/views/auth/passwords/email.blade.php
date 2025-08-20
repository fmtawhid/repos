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

                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif

                        {{-- Show validation errors --}}
                        @if ($errors->any())
                            <div class="alert alert-danger" role="alert">
                                <ul class="mb-0">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif


                        <form action="{{ route('password.email') }}" method="POST" id="login-form" class="mt-4 register-form">
                            @csrf
            
                            <input type="hidden" name="reset_with" class="reset_with" value="email">
                            <div class="row">
                                <div class="col-sm-12">
                                    <span class="reset-email @if (old('reset_with') == 'phone') d-none @endif">
                                        <label for="email" class="mb-1">{{ localize('Email') }}<span class="text-danger">
                                                *</span></label>
                                        <div class="input-group">
                                            <input type="email" class="form-control" placeholder="{{ localize('Enter your email') }}"
                                                id="email" @if (old('reset_with') != 'phone') required @endif aria-label="email"
                                                name="email" value="{{ old('email') }}">
                                        </div>
                                        <div class="text-end d-none">
                                            <small class="">
                                                <a href="javascript:void(0);" class="fs-sm login-with-phone-btn"
                                                    onclick="handleResetWithPhone()">
                                                    {{ localize('Reset with phone?') }}</a>
                                            </small>
                                        </div>
                                    </span>
            
                                    <span class="reset-phone @if (old('reset_with') == 'email' || old('reset_with') == '') d-none @endif">
                                        <label for="phone" class="mb-1">{{ localize('Phone') }}<span class="text-danger">
                                                *</span></label>
                                        <div class="input-group">
                                            <input type="text" class="form-control" placeholder="+xxxxxxxxxx" id="phone"
                                                aria-label="phone" name="phone" value="{{ old('phone') }}">
                                        </div>
                                        <div class="text-end">
                                            <small class="">
                                                <a href="javascript:void(0);" class="fs-sm login-with-email-btn"
                                                    onclick="handleResetWithEmail()">
                                                    {{ localize('Reset with email?') }}</a>
                                            </small>
                                        </div>
                                    </span>
                                </div>
            
                                <div class="col-12">
                                    <button type="submit" class="btn btn-primary mt-3 d-block w-100 sign-in-btn"
                                        onclick="handleSubmit()">{{ localize('Reset Password') }}</button>
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
@section('js')
<script>
    "use strict";

    // change input to phone
    function handleResetWithPhone() {
        $('.reset_with').val('phone');

        $('.reset-email').addClass('d-none');
        $('.reset-email input').prop('required', false);

        $('.reset-phone').removeClass('d-none');
        $('.reset-phone input').prop('required', true);
    }

    // change input to email
    function handleResetWithEmail() {
        $('.reset_with').val('email');
        $('.reset-email').removeClass('d-none');
        $('.reset-email input').prop('required', true);

        $('.reset-phone').addClass('d-none');
        $('.reset-phone input').prop('required', false);
    }

    // disable login button
    function handleSubmit() {
        $('#login-form').on('submit', function(e) {
            $('.sign-in-btn').prop('disabled', true);
        });
    }
</script>
@endsection