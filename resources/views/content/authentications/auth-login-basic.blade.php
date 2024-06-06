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
<script src="{{ asset('assets/js/components/input-floating.js') }}"></script>
@endsection

@section('content')
<header>
  <img src="{{asset('assets/svg/icons/pasima-logo.svg')}}" alt="pasima-logo" width="250">
</header>
<div class="container-xxl">
  <div class="authentication-wrapper authentication-basic container-p-y">
    <div class="auth-bg">
      <img src="{{asset('assets/img/backgrounds/auth-bg.png')}}" alt="auth bg" width="550px">
    </div>
    <div class="authentication-inner py-4">
      <!-- Login -->
      <div class="card">
        <div class="card-body">
          <!-- Logo -->
          <!-- /Logo -->
          <h4 class="mb-1 pt-2 text-center text-dark fw-bold">Hello, there!</h4>
          <p class="mb-4 text-center" style="color: #616A75;">Let’s login to your account</p>

          <form id="formAuthentication" class="mb-3" action="{{route('login')}}" method="POST">
            @csrf
            <div class="mb-3">
              <x-input-floating
                label="Email"
                id="email"
                name="email"
              ></x-input-floating>
            </div>
            <div class="mb-3">
              <x-input-floating
                label="Password"
                id="password"
                name="password"
                type="password"
              ></x-input-floating>
            </div>
            <div class="w-100 d-flex align-items-center justify-content-center mb-4">
              <a class="text-center" href="{{url('auth/forgot-password-basic')}}">
                <small class="text-blue">Forgot Password?</small>
              </a>
            </div>
            <div class="mb-3">
              <button class="btn btn-primary d-grid w-100" type="submit">Connect</button>
            </div>
            <div class="text-center">
              <small>Don’t have an account? <a href="#" class="text-blue fw-bold">Sign up</a></small>
            </div>
          </form>
        </div>
      </div>
      <!-- /Register -->
    </div>
  </div>
</div>
<footer class="footer border-top d-flex gap-5">
  <a href="#" class="text-primary">Term and Condition</a>
  <a href="#" class="text-primary">Privacy Policy</a>
</footer>
@endsection
