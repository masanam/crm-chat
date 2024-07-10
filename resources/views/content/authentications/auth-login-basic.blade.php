@php
$customizerHidden = 'customizer-hide';
@endphp

@extends('layouts/layoutMaster')

@section('title', 'Login')

@section('vendor-style')
<!-- Vendor -->
<link rel="stylesheet" href="{{asset('assets/vendor/libs/@form-validation/umd/styles/index.min.css')}}" />
@endsection

@section('page-style')
<!-- Page -->
<link rel="stylesheet" href="{{asset('assets/vendor/css/pages/page-auth.css')}}">
@endsection

@section('vendor-script')
<script src="{{asset('assets/vendor/libs/@form-validation/umd/bundle/popular.min.js')}}"></script>
<script src="{{asset('assets/vendor/libs/@form-validation/umd/plugin-bootstrap5/index.min.js')}}"></script>
<script src="{{asset('assets/vendor/libs/@form-validation/umd/plugin-auto-focus/index.min.js')}}"></script>
@endsection

@section('page-script')
<script src="{{asset('assets/js/pages-auth.js')}}"></script>
@endsection

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
            <div class="authentication-wrapper authentication-basic container px-5">
              <div class="authentication-inner">
                <h4 class="mb-1 pt-2 text-center text-dark fw-bold login-title">Hello, there!</h4>
                  <p class="mb-4 text-center login-subtitle" style="color: #616A75;">Let’s login to your account</p>
          
                  <form id="formAuthentication" class="mb-3" action="{{route('login')}}" method="POST">
                    @csrf
                      <div class="d-flex flex-column gap-3">
                        <div class="d-flex flex-column gap-2 w-100">
                            <label class="sign-up-label" for="email">Your work email</label>
                            <input class="sign-up-input" type="text" name="email" id="email" placeholder="Email">
                        </div>
                        <div class="d-flex flex-column gap-2 w-100">
                            <label class="sign-up-label" for="password">Password</label>
                            <input class="sign-up-input" type="password" name="password" id="password" placeholder="Password">
                        </div>
                      </div>
                    <div class="w-100 d-flex align-items-center justify-content-center mb-3 mt-3">
                      <a class="text-center" href="{{url('forgot-password')}}">
                        <small class="text-blue">Forgot Password?</small>
                      </a>
                    </div>
                    <div class="mb-3">
                      <button class="btn-primary btn-submit w-100" type="submit">Log in</button>
                    </div>
                    <div class="text-center">
                      <small>Don’t have an account? <a href="sign-up" class="text-blue fw-bold">Sign up</a></small>
                    </div>
                  </form>
              </div>
            </div>
          </div>
      </div>
      <footer class="footer d-flex gap-5" style="position: initial;">
          <a href="#" class="text-primary">Term and Condition</a>
          <a href="#" class="text-primary">Privacy Policy</a>
      </footer>
  </div>
  <div class="auth-bg w-100">
      <img src="{{ asset('assets/img/backgrounds/signup-bg.png') }}" alt="auth bg" class="signup-bg">
  </div>
</div>
@endsection
