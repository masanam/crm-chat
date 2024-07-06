@php
    $customizerHidden = 'customizer-hide';
@endphp

@extends('layouts/layoutMaster')

@section('title', 'Forgot Password')

@section('vendor-style')
    <!-- Vendor -->
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/@form-validation/umd/styles/index.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/flatpickr/flatpickr.css') }}" />
@endsection

@section('page-style')
    <!-- Page -->
    <link rel="stylesheet" href="{{ asset('assets/vendor/css/pages/page-auth.css') }}">
@endsection

@section('vendor-script')
    <script src="{{ asset('assets/vendor/libs/@form-validation/umd/bundle/popular.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/libs/@form-validation/umd/plugin-bootstrap5/index.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/libs/@form-validation/umd/plugin-auto-focus/index.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/libs/flatpickr/flatpickr.js') }}"></script>
@endsection

@section('page-script')
    <script src="{{asset('assets/js/pages-auth.js')}}"></script>
@endsection

@php
    $step = 6;
@endphp

@section('content')
    <div class="d-flex justify-content-between">
        <div class="w-100 d-flex flex-column justify-content-between container-wrapper">
            <div>
                <header>
                    <a href="/">
                        <img src="{{ asset('assets/svg/icons/pasima-logo.svg') }}" alt="pasima-logo" width="250">
                    </a>
                </header>
                <div class="container-xxl">
                    <div class="authentication-wrapper authentication-basic">
                        <form role="form" onSubmit="return false" id="form-forgot-password" class="w-100 py-4 px-5 d-flex flex-column gap-4">
                            @csrf
                            <div id="forgot-password-step1">
                                <div class="d-flex flex-column gap-4 align-items-center">
                                    <img src="assets/svg/icons/icon-forgot-password.svg" alt="icon-forgot-password">
                                    <span class="text-dark fw-bold text-center" style="font-size: 26px;">Forgot Your Password?</span>
                                    <span class="text-center" style="font-size: 24px">Don’t worry we get you covered. Please select a password recovery method below.</span>
                                  </div>
                                  <div class="d-flex flex-column gap-3 mt-5">
                                      <div class="d-flex flex-column gap-2 w-100 mb-3">
                                          <input class="sign-up-input" type="text" name="email" id="email" placeholder="Email">
                                      </div>
                                  </div>
                            </div>
                            <div class="hidden" id="forgot-password-step2">
                                <div class="d-flex flex-column gap-4 align-items-center">
                                    <img src="assets/svg/icons/icon-check-email.svg" alt="icon-check-email">
                                    <span class="text-dark fw-bold text-center" style="font-size: 26px;">Verification Code Entry</span>
                                    <span class="text-center" style="font-size: 24px">Please enter the verification code sent to your email address:</span>
                                  </div>
                                  <div class="d-flex flex-column align-items-center gap-3 mt-5">
                                      <div class="d-flex justify-content-center w-100" id="otp-input-wrapper">
                                          <input name='otp1' class="otp-input" type="text" inputmode="numeric" maxlength="1" />
                                          <input name='otp2' class="otp-input" type="text" inputmode="numeric" maxlength="1" />
                                          <input name='otp3' class="otp-input" type="text" inputmode="numeric" maxlength="1" />
                                          <input name='otp4' class="otp-input" type="text" inputmode="numeric" maxlength="1" />
                                      </div>
                                      <div class="d-flex justify-content-center gap-1" id="resend-wrapper">
                                          <span style="font-size: 16px;">If you didn’t receive the code, click
                                            <a href="javascript:void(0)" class="text-dark fw-bold cursor-pointer" id="btn-resend-email">resend code</a>
                                          </span>
                                          <span style="font-size: 16px;" id="time-remaining"></span>
                                      </div>
                                  </div>
                            </div>
                            <div class="hidden" id="forgot-password-step3">
                                <div class="d-flex flex-column gap-4 align-items-center mt-2">
                                    <img src="assets/svg/icons/icon-new-password.svg" alt="icon-new-password">
                                    <span class="text-dark fw-bold text-center" style="font-size: 26px;">Create New Password</span>
                                    <span class="text-center" style="font-size: 24px">Please enter and confirm your new password</span>
                                  </div>
                                  <div class="d-flex flex-column gap-3 mt-5">
                                      <div class="d-flex flex-column mb-3">
                                        <input class="sign-up-input" type="password" name="password" id="password" placeholder="Create new password">
                                      </div>
                                      <div class="d-flex flex-column mb-3">
                                        <input class="sign-up-input" type="password" name="confirm_password" id="confim_password" placeholder="Confirm new password">
                                      </div>
                                  </div>
                            </div>
                            <button class="btn-primary btn-submit" type="submit">Send code</button>
                        </form>
                    </div>
                </div>
            </div>
            <footer style="position: relative; padding: 1rem 4rem;">
                <div class="d-flex align-items-center gap-4" id="forgot-password-stepper">
                    <div class="step-passed"></div>
                    <div class="step-upcoming"></div>
                    <div class="step-upcoming"></div>
                </div>
            </footer>
        </div>
        <div class="auth-bg w-100">
            <img src="{{ asset('assets/img/backgrounds/auth-forgot-password-bg.png') }}" alt="auth bg" class="signup-bg">
        </div>
    </div>
@endsection
