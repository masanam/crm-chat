/**
 * App Chat
 */

 'use strict';

 document.addEventListener('DOMContentLoaded', function () {
   (async function () {
    const getContainerFormStepper = document.querySelector('.container-form-stepper')
    const getFormStepper = document.querySelector('.form-stepper')
    const getBtnSubmit = document.querySelector('.btn-submit')
    const getFooter = document.querySelector('.footer')
    let step = 1
    let scrollbar
    
    if (getContainerFormStepper) {
        scrollbar = new PerfectScrollbar(getContainerFormStepper, {
            wheelPropagation: false,
            suppressScrollX: true
        });
    }

    if (getFormStepper) {
      const renderFormByStep = () => {
        switch (step) {
          case 1:
            getFormStepper.innerHTML = `
            <div class="d-flex flex-column align-items-center">
            <h1 class="title">Start your free trial</h1>
            <h2 class="subtitle">14-day free trial</h2>
        </div>
        <div class="d-flex flex-column gap-2">
            <label class="sign-up-label" for="email">You work email</label>
            <input class="sign-up-input" type="text" name="email" id="email" placeholder="Email">
            `
            break;
          case 2:
            getFormStepper.innerHTML = `
            <div class="d-flex flex-column gap-3">
            <div class="d-flex justify-content-between gap-5">
                <div class="d-flex flex-column gap-2 w-100">
                    <label class="sign-up-label" for="first_name">First Name</label>
                    <input class="sign-up-input" type="text" name="first_name" id="first_name" placeholder="First Name">
                </div>
                <div class="d-flex flex-column gap-2 w-100">
                    <label class="sign-up-label" for="last_name">Last Name</label>
                    <input class="sign-up-input" type="text" name="last_name" id="last_name" placeholder="Last Name">
                </div>
            </div>
            <div class="d-flex flex-column gap-2 w-100">
                <label class="sign-up-label" for="phone_number">Phone Number</label>
                <input class="sign-up-input" type="number" name="phone_number" id="phone_number" placeholder="Phone Number">
            </div>
        </div>
            `
            break;
          case 3:
            getFormStepper.innerHTML = `
            <div class="d-flex flex-column gap-3">
            <div class="d-flex flex-column gap-2 w-100">
                <label class="sign-up-label" for="company">Company Name</label>
                <input class="sign-up-input" type="text" name="company" id="company" placeholder="Company Name">
            </div>
            <div class="d-flex justify-content-between gap-5">
                <div class="d-flex flex-column gap-2 w-100">
                    <label class="sign-up-label" for="job">Job Title</label>
                    <input class="sign-up-input" type="text" name="job" id="job" placeholder="Job Title">
                </div>
                <div class="d-flex flex-column gap-2 w-100">
                    <label class="sign-up-label" for="industry">Industry</label>
                    <input class="sign-up-input" type="text" name="industry" id="industry" placeholder="Industry">
                </div>
            </div>
            <div class="d-flex flex-column gap-2 w-100">
                <label class="sign-up-label" for="team_number">Number of Team</label>
                <input class="sign-up-input" type="number" name="team_number" id="team_number" placeholder="Number of Team">
            </div>
        </div>
            `
            break;
          case 4:
            getFormStepper.innerHTML = `
            <div class="d-flex flex-column gap-2">
                                        <label class="sign-up-label" for="password">Password</label>
                                        <input class="sign-up-input" type="password" name="password" id="password" placeholder="Password">
                                    </div>
            `
            break;
          case 5:
            getFormStepper.innerHTML = `
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
                <div class="d-flex flex-column gap-2">
                    <label class="sign-up-label" for="card_number">Card Number</label>
                    <input class="sign-up-input" type="text" name="card_number" id="card_number" placeholder="Card card number">
                </div>
                <div class="d-flex justify-content-between gap-5">
                    <div class="d-flex flex-column gap-2 w-100">
                        <label class="sign-up-label" for="exp_date">Expiration Date</label>
                        <input class="sign-up-input" type="text" name="exp_date" id="exp_date" placeholder="MM/YY">
                    </div>
                    <div class="d-flex flex-column gap-2 w-100">
                        <div class="d-flex justify-content-between align-items-center">
                            <label class="sign-up-label" for="security_code">Card Security Code</label>
                            <small class="text-info-security">What is this?</small>
                        </div>
                        <input class="sign-up-input" type="password" name="security_code" id="security_code" placeholder="CVV">
                    </div>
                </div>
            </div>
        </div>
        <div class="d-flex flex-column gap-4">
            <span class="text-dark fw-bold" style="font-size: 24px">Billing Address</span>
            <div class="d-flex flex-column gap-3">
                <div class="d-flex justify-content-between gap-5">
                    <div class="d-flex flex-column gap-2 w-100">
                        <label class="sign-up-label" for="first_name">First Name</label>
                        <input class="sign-up-input" type="text" name="first_name" id="first_name" placeholder="First Name">
                    </div>
                    <div class="d-flex flex-column gap-2 w-100">
                        <label class="sign-up-label" for="last_name">Last Name</label>
                        <input class="sign-up-input" type="text" name="last_name" id="last_name" placeholder="Last Name">
                    </div>
                </div>
                <div class="d-flex flex-column gap-2">
                    <label class="sign-up-label" for="email">Email Address</label>
                    <input class="sign-up-input" type="text" name="email" id="email" placeholder="Email Address">
                </div>
                <div class="d-flex flex-column gap-2">
                    <label class="sign-up-label" for="address">Street Address</label>
                    <input class="sign-up-input" type="text" name="address" id="address" placeholder="Street Address">
                </div>
                <div class="d-flex justify-content-between gap-5">
                    <div class="d-flex flex-column gap-2 w-100">
                        <label class="sign-up-label" for="state">State/Province</label>
                        <input class="sign-up-input" type="number" name="state" id="state" placeholder="State/Province">
                    </div>
                    <div class="d-flex flex-column gap-2 w-100">
                        <label class="sign-up-label" for="city">City</label>
                        <input class="sign-up-input" type="text" name="city" id="city" placeholder="City">
                    </div>
                </div>
                <div class="d-flex justify-content-between gap-5">
                    <div class="d-flex flex-column gap-2 w-100">
                        <label class="sign-up-label" for="postal_code">Postal Code</label>
                        <input class="sign-up-input" type="number" name="postal_code" id="postal_code" placeholder="Postal Code">
                    </div>
                    <div class="d-flex flex-column gap-2 w-100">
                        <label class="sign-up-label" for="phone">Phone</label>
                        <input class="sign-up-input" type="number" name="phone" id="phone" placeholder="Phone">
                    </div>
                </div>
            </div>
        </div>
            `
            getBtnSubmit.innerHTML = 'Start your Free Trial'
            getFooter.classList.add('hidden')
            getFooter.classList.remove('d-flex')
            break;
          case 6:
            getFormStepper.innerHTML = `
            <div class="d-flex flex-column gap-4 align-items-center">
                                        <img src="assets/svg/icons/icon-payment-success.svg" alt="icon-payment-success" width="211">
                                        <h1 class="payment-title text-center">Congratulations! Your Registration for 14-Days Free Trial has been successful</h1>
                                    </div>
            `
            getBtnSubmit.innerHTML = 'Go to Dashboard'
            scrollbar?.destroy()
            break;
          default:
            break;
        }
      }

      renderFormByStep()

      if (getBtnSubmit) {
        getBtnSubmit.addEventListener('click', () => {
          step++
          renderFormByStep()

          if (step === 5) {
          const expDate = document.querySelector("#exp_date");
              if (expDate) {
                  expDate.flatpickr({
                      monthSelectorType: 'static'
                  });
              }
          }
        })
      }
    }
   })();
 });
 