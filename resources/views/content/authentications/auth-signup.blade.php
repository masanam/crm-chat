@php
$customizerHidden = 'customizer-hide';
@endphp

@extends('layouts/layoutMaster')

@section('title', 'Login')

@section('vendor-style')
<!-- Vendor -->
<link rel="stylesheet" href="{{ asset('assets/vendor/libs/@form-validation/umd/styles/index.min.css') }}" />
<link rel="stylesheet" href="{{ asset('assets/vendor/libs/flatpickr/flatpickr.css') }}" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/css/bootstrap.min.css" />

@endsection

@section('page-style')
<!-- Page -->
<link rel="stylesheet" href="{{ asset('assets/vendor/css/pages/page-auth.css') }}">
@endsection

@section('vendor-script')
<script src="{{asset('assets/vendor/libs/@form-validation/umd/bundle/popular.min.js')}}"></script>
<script src="{{asset('assets/vendor/libs/@form-validation/umd/plugin-bootstrap5/index.min.js')}}"></script>
<script src="{{asset('assets/vendor/libs/@form-validation/umd/plugin-auto-focus/index.min.js')}}"></script>
<script src="{{ asset('assets/vendor/libs/flatpickr/flatpickr.js') }}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

@endsection

@section('page-script')
<script src="{{ asset('assets/js/auth-sign-up.js') }}"></script>
<script src="{{ asset('assets/js/components/input-floating.js') }}"></script>
<script src="https://js.stripe.com/v2/"></script>
<script type="text/javascript">
    // var stripe = Stripe('pk_test_51OzD44P2jpJZ1J5syWQeAqIyfEta7xpLGwAAmuLtziPmFIJzxHDBG7WedNjUt6vobzP0AQspvVtIs9cGe39wLCcW00JlACclAC');

    var stripeKey = "{{ env('STRIPE_KEY') }}";
    var stripe = Stripe(stripeKey);

    $(function() {
        /*------------------------------------------
        --------------------------------------------
        Stripe Payment Code
        --------------------------------------------
        --------------------------------------------*/

        var $form = $(".require-validation");
        $('form.require-validation').bind('submit', function(e) {
            var $form = $(".require-validation"),
                inputSelector = ['input[type=email]', 'input[type=password]',
                    'input[type=text]', 'input[type=file]',
                    'textarea'
                ].join(', '),
                $inputs = $form.find('.required').find(inputSelector),
                $errorMessage = $form.find('div.error'),
                valid = true;
            $errorMessage.addClass('hide');



            $('.has-error').removeClass('has-error');
            $inputs.each(function(i, el) {
                var $input = $(el);
                if ($input.val() === '') {
                    $input.parent().addClass('has-error');
                    $errorMessage.removeClass('hide');
                    e.preventDefault();
                }
            });


            if (!$form.data('cc-on-file')) {
                e.preventDefault();
                Stripe.setPublishableKey($form.data('stripe-publishable-key'));
                Stripe.createToken({
                    number: $('.card-number').val(),
                    cvc: $('.card-cvc').val(),
                    exp_month: $('.card-expiry-month').val(),
                    exp_year: $('.card-expiry-year').val()
                }, stripeResponseHandler);
            }

        });



        /*------------------------------------------
        --------------------------------------------
        Stripe Response Handler
        --------------------------------------------
        --------------------------------------------*/

        function stripeResponseHandler(status, response) {
            if (response.error) {
                $('.error')
                    .removeClass('hide')
                    .find('.alert')
                    .text(response.error.message);
            } else {

                /* token contains id, last4, and card type */
                var token = response['id'];
                $form.find('input[type=text]').empty();
                $form.append("<input type='hidden' name='stripeToken' value='" + token + "'/>");
                $form.get(0).submit();
            }
        }
    });
</script>
@endsection

@php
$step = 6;
@endphp

@section('content')
    <div class="d-flex justify-content-between" id="auth-signup" style="height: 100vh; overflow-y: hidden;">
        <div class="w-100 d-flex flex-column justify-content-between">
            <div>
                <a href="/">
                    <img src="{{ asset('assets/svg/icons/pasima-logo.svg') }}" alt="pasima-logo" width="250">
                </a>
                <div class="container-xxl container-form-stepper">
                @if (Session::has('success'))
                <div class="authentication-wrapper authentication-basic payment">
                    <div class="d-flex flex-column gap-4 align-items-center">
                        <img src="assets/svg/icons/icon-payment-success.svg" alt="icon-payment-success" width="211">
                        <h1 class="payment-title text-center">Congratulations! Your Registration for 14-Days Free Trial has been successful</h1>
                    </div>
                </div>          
                @endif

                    <div
                        @class([
                            'authentication-wrapper authentication-basic payment',
                            'hidden' => Session::has('success'),
                        ])
                        class="authentication-wrapper authentication-basic payment"
                    >
                        <form role="form" action="{{ route('stripe.post') }}" method="post" class="require-validation w-100 py-4 px-5 d-flex flex-column gap-5" data-cc-on-file="false" data-stripe-publishable-key="{{ env('STRIPE_KEY') }}" id="payment-form">
                            @csrf
                            <div id="step1-validation" class="">
                                <div class="d-flex flex-column align-items-center">
                                    <h1 class="title">Start your free trial</h1>
                                    <h2 class="subtitle">14-day free trial</h2>
                                </div>
                                <div class="d-flex flex-column gap-2 mb-3">
                                    <label class="sign-up-label" for="email">You work email</label>
                                    <input class="sign-up-input" type="text" name="email" id="email" placeholder="Email">
                                </div>
                                <button class="btn-primary btn-submit w-100 mt-2" id="btn-next" type="submit">Continue</button>
                            </div>
                            <div id="step2-validation" class="hidden">
                                <div class="d-flex flex-column gap-3">
                                    <div class="d-flex justify-content-between gap-5">
                                        <div class="d-flex flex-column gap-2 w-100 mb-3">
                                            <label class="sign-up-label" for="first_name">First Name</label>
                                            <input class="sign-up-input" type="text" name="first_name" id="first_name" placeholder="First Name">
                                            <div class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback"></div>
                                        </div>
                                        <div class="d-flex flex-column gap-2 w-100 mb-3">
                                            <label class="sign-up-label" for="last_name">Last Name</label>
                                            <input class="sign-up-input" type="text" name="last_name" id="last_name" placeholder="Last Name">
                                        </div>
                                    </div>
                                    <div class="d-flex flex-column gap-2 w-100 mb-3">
                                        <label class="sign-up-label" for="phone_number">Phone Number</label>
                                        <input class="sign-up-input" type="number" name="phone_number" id="phone_number" placeholder="Phone Number">
                                    </div>
                                </div>
                                <button class="btn-primary btn-submit w-100 mt-2" id="btn-next">Continue</button>
                            </div>
                            <div id="step3-validation" class="hidden">
                                <div class="d-flex flex-column gap-3">
                                    <div class="d-flex flex-column gap-2 w-100 mb-3">
                                        <label class="sign-up-label" for="company">Company Name</label>
                                        <input class="sign-up-input" type="text" name="company" id="company" placeholder="Company Name">
                                    </div>
                                    <div class="d-flex justify-content-between gap-5">
                                        <div class="d-flex flex-column gap-2 w-100 mb-3">
                                            <label class="sign-up-label" for="job">Job Title</label>
                                            <input class="sign-up-input" type="text" name="job" id="job" placeholder="Job Title">
                                        </div>
                                        <div class="d-flex flex-column gap-2 w-100 mb-3">
                                            <label class="sign-up-label" for="industry">Industry</label>
                                            <input class="sign-up-input" type="text" name="industry" id="industry" placeholder="Industry">
                                        </div>
                                    </div>
                                    <div class="d-flex flex-column gap-2 w-100 mb-3">
                                        <label class="sign-up-label" for="team_number">Number of Team</label>
                                        <input class="sign-up-input" type="number" name="team_number" id="team_number" placeholder="Number of Team">
                                    </div>
                                </div>
                                <button class="btn-primary btn-submit w-100 mt-2" id="btn-next">Continue</button>
                            </div>
                            <div id="step4-validation" class="hidden">
                                <div class="d-flex flex-column gap-2 mb-3">
                                    <label class="sign-up-label" for="new_password">Password</label>
                                    <input class="sign-up-input" type="password" name="new_password" id="new_password" placeholder="Password">
                                </div>
                                <button class="btn-primary btn-submit w-100 mt-2" id="btn-next" type="submit">Continue</button>
                            </div>
                            <div id="step5-validation" class="hidden">
                                <div class="d-flex flex-column align-items-start">
                                    <h1 class="payment-title">You're About to Get 14 Days of Free Power!</h1>
                                    <h2 class="payment-subtitle">Start Now.</h2>
                                </div>
                                <div class="d-flex flex-column gap-4">
                                    <div class="d-flex justify-content-between gap-5">
                                        <span class="text-dark fw-bold" style="font-size: 24px">Set Up Your Credit Card</span>
                                        <div class="d-flex align-items-center gap-2">
                                            <div class="wrapper-payment-icon">
                                              <img src="assets/svg/icons/visa.svg" alt="icon-visa">
                                            </div>
                                            <div class="wrapper-payment-icon wrapper-card-discover">
                                              <img src="assets/svg/icons/discover.svg" alt="icon-discover">
                                            </div>
                                            <div class="wrapper-payment-icon">
                                              <img src="assets/svg/icons/maestro.svg" alt="icon-maestro">
                                            </div>
                                            <div class="wrapper-payment-icon">
                                              <img src="assets/svg/icons/master-card.svg" alt="icon-master-card">
                                            </div>
                                          </div>
                                    </div>
                                    <div class="d-flex flex-column gap-3">
                                        <div class="d-flex flex-column gap-2 mb-3">
                                            <label class="sign-up-label" for="card_number">Card Number</label>
                                            <input class="sign-up-input card-number" type="text" name="card_number" id="card_number" placeholder="Card card number">
                                        </div>
                                        <div class="d-flex justify-content-between gap-5">
                                            <div class="d-flex flex-column gap-2 w-100 mb-3">
                                                <label class="sign-up-label" for="exp_date">Expiration Month</label>
                                                <input class="sign-up-input card-expiry-month" type="text" name="exp_month" id="exp_month" placeholder="MM">
                                            </div>
                                            <div class="d-flex flex-column gap-2 w-100 mb-3">
                                                <label class="sign-up-label" for="exp_date">Expiration Year</label>
                                                <input class="sign-up-input card-expiry-year" type="text" name="exp_year" id="exp_year" placeholder="YYYY">
                                            </div>

                                            <div class="d-flex flex-column gap-2 w-100 mb-3">
                                                <div class="d-flex justify-content-between align-items-center">
                                                    <label class="sign-up-label" for="security_code">Security Code</label>
                                                    <small class="text-info-security">What is this?</small>
                                                </div>
                                                <input class="sign-up-input card-cvc" type="password" name="security_code" id="security_code" placeholder="CVC">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="d-flex flex-column gap-4">
                                    <span class="text-dark fw-bold" style="font-size: 24px">Billing Address</span>
                                    <div class="d-flex flex-column gap-3">
                                        <div class="d-flex justify-content-between gap-5">
                                            <div class="d-flex flex-column gap-2 w-100 mb-3">
                                                <label class="sign-up-label" for="firstName">First Name</label>
                                                <input class="sign-up-input" type="text" name="firstName" id="firstName" placeholder="First Name">
                                            </div>
                                            <div class="d-flex flex-column gap-2 w-100 mb-3">
                                                <label class="sign-up-label" for="lastName">Last Name</label>
                                                <input class="sign-up-input" type="text" name="lastName" id="lastName" placeholder="Last Name">
                                            </div>
                                        </div>
                                        <div class="d-flex flex-column gap-2 mb-3">
                                            <label class="sign-up-label" for="emailAddress">Email Address</label>
                                            <input class="sign-up-input" type="text" name="emailAddress" id="emailAddress" placeholder="Email Address">
                                        </div>
                                        <div class="d-flex flex-column gap-2 mb-3">
                                            <label class="sign-up-label" for="address">Street Address</label>
                                            <input class="sign-up-input" type="text" name="address" id="address" placeholder="Street Address">
                                        </div>
                                        <div class="d-flex justify-content-between gap-5">
                                            <div class="d-flex flex-column gap-2 w-100 mb-3">
                                                <label class="sign-up-label" for="state">State/Province</label>
                                                <input class="sign-up-input" type="text" name="state" id="state" placeholder="State/Province">
                                            </div>
                                            <div class="d-flex flex-column gap-2 w-100 mb-3">
                                                <label class="sign-up-label" for="city">City</label>
                                                <input class="sign-up-input" type="text" name="city" id="city" placeholder="City">
                                            </div>
                                        </div>
                                        <div class="d-flex justify-content-between gap-5">
                                            <div class="d-flex flex-column gap-2 w-100 mb-3">
                                                <label class="sign-up-label" for="postal_code">Postal Code</label>
                                                <input class="sign-up-input" type="number" name="postal_code" id="postal_code" placeholder="Postal Code">
                                            </div>
                                            <div class="d-flex flex-column gap-2 w-100 mb-3">
                                                <label class="sign-up-label" for="phone">Phone</label>
                                                <input class="sign-up-input" type="number" name="phone" id="phone" placeholder="Phone">
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <button class="btn-primary btn-submit w-100 mt-5" type="submit">Start your Free Trial</button>
                                <img src="{{ asset('assets/img/backgrounds/stripe.png') }}" alt="stripe logo" width="150" class="mt-2">
                            </div>
                        </form>
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