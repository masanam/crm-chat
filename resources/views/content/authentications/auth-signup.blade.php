@php
$customizerHidden = 'customizer-hide';
@endphp

@extends('layouts/layoutMaster')

@section('title', 'Login')

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
<script src="{{ asset('assets/js/auth-sign-up.js') }}"></script>
<script src="{{ asset('assets/js/components/input-floating.js') }}"></script>
<script src="https://js.stripe.com/v3/"></script>
<script type="text/javascript">
    var stripe = Stripe('pk_test_51OzD44P2jpJZ1J5syWQeAqIyfEta7xpLGwAAmuLtziPmFIJzxHDBG7WedNjUt6vobzP0AQspvVtIs9cGe39wLCcW00JlACclAC');
    var elements = stripe.elements();
    var cardElement = elements.create('card');
    cardElement.mount('#card-element');

    /*------------------------------------------
    --------------------------------------------
    Create Token Code
    --------------------------------------------
    --------------------------------------------*/
    function createToken() {
        document.getElementById("pay-btn").disabled = true;
        stripe.createToken(cardElement).then(function(result) {

            if (typeof result.error != 'undefined') {
                document.getElementById("pay-btn").disabled = false;
                alert(result.error.message);
            }

            /* creating token success */
            if (typeof result.token != 'undefined') {
                document.getElementById("stripe-token-id").value = result.token.id;
                document.getElementById('checkout-form').submit();
            }
        });
    }
</script>

@endsection

@php
$step = 6;
@endphp

@section('content')
<div class="d-flex justify-content-between">
    <div class="w-100 d-flex flex-column justify-content-between">
        <div>
            <a href="/">
                <img src="{{ asset('assets/svg/icons/pasima-logo.svg') }}" alt="pasima-logo" width="250">
            </a>
            <div class="container-xxl container-form-stepper">
                <div class="authentication-wrapper authentication-basic payment">
                    <div class="w-100 py-4 px-5 d-flex flex-column gap-5">
                        <div class="d-flex flex-column gap-5 form-stepper"></div>
                        <button class="btn-primary btn-submit">Continue</button>
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