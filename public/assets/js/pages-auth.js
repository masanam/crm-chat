/**
 *  Pages Authentication
 */

'use strict';
const formAuthentication = document.querySelector('#formAuthentication');

document.addEventListener('DOMContentLoaded', function (e) {
  (function () {
    // Form validation for Add new record
    if (formAuthentication) {
      const fv = FormValidation.formValidation(formAuthentication, {
        fields: {
          username: {
            validators: {
              notEmpty: {
                message: 'Please enter username'
              },
              stringLength: {
                min: 6,
                message: 'Username must be more than 6 characters'
              }
            }
          },
          email: {
            validators: {
              notEmpty: {
                message: 'Please enter your email'
              },
              emailAddress: {
                message: 'Please enter valid email address'
              }
            }
          },
          'email-username': {
            validators: {
              notEmpty: {
                message: 'Please enter email / username'
              },
              stringLength: {
                min: 6,
                message: 'Username must be more than 6 characters'
              }
            }
          },
          password: {
            validators: {
              notEmpty: {
                message: 'Please enter your password'
              },
              stringLength: {
                min: 6,
                message: 'Password must be more than 6 characters'
              }
            }
          },
          'confirm-password': {
            validators: {
              notEmpty: {
                message: 'Please confirm password'
              },
              identical: {
                compare: function () {
                  return formAuthentication.querySelector('[name="password"]').value;
                },
                message: 'The password and its confirm are not the same'
              },
              stringLength: {
                min: 6,
                message: 'Password must be more than 6 characters'
              }
            }
          },
          terms: {
            validators: {
              notEmpty: {
                message: 'Please agree terms & conditions'
              }
            }
          }
        },
        plugins: {
          trigger: new FormValidation.plugins.Trigger(),
          bootstrap5: new FormValidation.plugins.Bootstrap5({
            eleValidClass: '',
            rowSelector: '.mb-1'
          }),
          submitButton: new FormValidation.plugins.SubmitButton(),

          defaultSubmit: new FormValidation.plugins.DefaultSubmit(),
          autoFocus: new FormValidation.plugins.AutoFocus()
        },
        init: instance => {
          instance.on('plugins.message.placed', function (e) {
            if (e.element.parentElement.classList.contains('input-group')) {
              e.element.parentElement.insertAdjacentElement('afterend', e.messageElement);
            }
          });
        }
      });
    }

    //  Two Steps Verification
    const numeralMask = document.querySelectorAll('.numeral-mask');

    // Verification masking
    if (numeralMask.length) {
      numeralMask.forEach(e => {
        new Cleave(e, {
          numeral: true
        });
      });
    }

    /**
     * @description set scrollbar for page auth login/forgot password
     */
    const authWrapper = document.querySelector('.container-wrapper');
    if (authWrapper) {
      new PerfectScrollbar(authWrapper, {
          wheelPropagation: false,
          suppressScrollX: true
      });
    }

    /**
     * @description handle flow input verification code
     */
    const handleOtpInput = () => {
      const wrapperOtpInput = document.querySelector('#otp-input-wrapper');
      if (wrapperOtpInput) {
        wrapperOtpInput.addEventListener('input', (e) => {
          const target = e.target;
          const val = target.value;
  
          if (isNaN(val)) {
            target.value = "";
            return;
          }
     
          if (val != "") {
              const next = target.nextElementSibling;
              if (next) {
                  next.focus();
              }
          }
        });
  
        wrapperOtpInput.addEventListener("keyup", function (e) {
          const target = e.target;
          const key = e.key.toLowerCase();
       
          if (key == "backspace" || key == "delete") {
              target.value = "";
              const prev = target.previousElementSibling;
              if (prev) {
                  prev.focus();
              }
              return;
          }
        });
      }
    }

    /**
     * @description handle btn submit send code
     */
    const handleSendCode = () => {
      const getBtnResendEmail = document.querySelector('#btn-resend-email');
      const getTimeRemaining = document.querySelector('#time-remaining');
      let timeLeft = 30;
      
      if (getBtnResendEmail && getTimeRemaining) {
        getBtnResendEmail.addEventListener('click', (e) => {
          e.preventDefault()
          // set countdown
          if (!getBtnResendEmail.classList.contains('cursor-not-allowed')) {
            var timerId = setInterval(countdown, 1000);
            function countdown() {
              if (timeLeft == -1) {
                clearTimeout(timerId);
                getTimeRemaining.innerHTML = '';
                getBtnResendEmail.setAttribute('class', 'cursor-pointer text-dark fw-bold');
                timeLeft = 30;
              } else {
                getTimeRemaining.innerHTML = 'in ' + timeLeft;
                timeLeft--;
              }
            }
          }
          getBtnResendEmail.setAttribute('class', 'cursor-not-allowed text-dark fw-bold')
        })
      }
    }
      /**
       * @description render dynamic forgot password content
       */
      const getWrapper = document.querySelector('#forgot-password-content');
      const getBtnSubmit = document.querySelector('.btn-submit');
      const getForgotPasswordStepper = document.querySelector('#forgot-password-stepper');

      let step = 1;

      if (getWrapper) {
        const renderFormByStep = () => {
          switch (step) {
            case 1:
              getWrapper.innerHTML = `
                <div class="d-flex flex-column gap-4 align-items-center">
                  <img src="assets/svg/icons/icon-forgot-password.svg" alt="icon-forgot-password">
                  <span class="text-dark fw-bold text-center" style="font-size: 26px;">Forgot Your Password?</span>
                  <span class="text-center" style="font-size: 24px">Don’t worry we get you covered. Please select a password recovery method below.</span>
                </div>
                <div class="d-flex flex-column gap-3">
                    <div class="d-flex flex-column gap-2 w-100">
                        <input class="sign-up-input" type="text" name="email" id="email" placeholder="Email">
                    </div>
                </div>
              `
              getBtnSubmit.innerHTML = 'Send Code'
              break;
            case 2:
              getWrapper.innerHTML = `
                <div class="d-flex flex-column gap-4 align-items-center">
                  <img src="assets/svg/icons/icon-check-email.svg" alt="icon-check-email">
                  <span class="text-dark fw-bold text-center" style="font-size: 26px;">Verification Code Entry</span>
                  <span class="text-center" style="font-size: 24px">Please enter the verification code sent to your email address:</span>
                </div>
                <div class="d-flex flex-column gap-3">
                    <div class="d-flex justify-content-center w-100" id="otp-input-wrapper">
                        <input class="otp-input" type="text" inputmode="numeric" maxlength="1" />
                        <input class="otp-input" type="text" inputmode="numeric" maxlength="1" />
                        <input class="otp-input" type="text" inputmode="numeric" maxlength="1" />
                        <input class="otp-input" type="text" inputmode="numeric" maxlength="1" />
                    </div>
                    <div class="d-flex justify-content-center gap-1" id="resend-wrapper">
                        <span style="font-size: 16px;">If you didn’t receive the code, click
                          <a href="javascript:void(0)" class="text-dark fw-bold cursor-pointer" id="btn-resend-email">resend code</a>
                        </span>
                        <span style="font-size: 16px;" id="time-remaining"></span>
                    </div>
                </div>
              `
              getBtnSubmit.innerHTML = 'Reset Password'
              getForgotPasswordStepper.children[step - 1].setAttribute('class', 'step-passed')
              handleOtpInput()
              handleSendCode()
              break;
            case 3:
              getWrapper.innerHTML = `
                <div class="d-flex flex-column gap-4 align-items-center mt-2">
                  <img src="assets/svg/icons/icon-new-password.svg" alt="icon-new-password">
                  <span class="text-dark fw-bold text-center" style="font-size: 26px;">Create New Password</span>
                  <span class="text-center" style="font-size: 24px">Please enter and confirm your new password</span>
                </div>
                <div class="d-flex flex-column gap-3">
                    <input class="sign-up-input" type="text" name="password" id="password" placeholder="Create new password">
                    <input class="sign-up-input" type="text" name="confim_password" id="confim_password" placeholder="Confirm new password">
                </div>
              `
              getForgotPasswordStepper.children[step - 1].setAttribute('class', 'step-passed')
              break;
            default:
              break;
          }
        }
        
        renderFormByStep()

        if (getBtnSubmit) {
          getBtnSubmit.addEventListener('click', () => {
            if (step === 3) {
              // reset form
              step = 1
              getForgotPasswordStepper.children[1].setAttribute('class', 'step-upcoming')
              getForgotPasswordStepper.children[2].setAttribute('class', 'step-upcoming')
              renderFormByStep()
            } else {
              step++
              renderFormByStep()
            }

          })
        }
      }
  })();
});
