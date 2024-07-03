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
                        <div class="w-100 py-4 px-5 d-flex flex-column gap-4">
                            <div class="d-flex flex-column gap-5" id="forgot-password-content"></div>
                            <button class="btn-primary btn-submit">Send code</button>
                        </div>
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
