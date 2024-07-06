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
            rowSelector: '.mb-3'
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
      const getWrapper = document.querySelector('#form-forgot-password');
      const getBtnSubmit = document.querySelector('.btn-submit');
      const getForgotPasswordStepper = document.querySelector('#forgot-password-stepper');
      const getStep1 = document.querySelector('#forgot-password-step1')
      const getStep2 = document.querySelector('#forgot-password-step2')
      const getStep3 = document.querySelector('#forgot-password-step3')
      let step = 1;

      const fv1 = FormValidation.formValidation(getStep1, {
        fields: {
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
        },
        plugins: {
          trigger: new FormValidation.plugins.Trigger(),
          bootstrap5: new FormValidation.plugins.Bootstrap5({
            eleValidClass: '',
            rowSelector: '.mb-3'
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
          instance.on('core.form.valid', function() {
            step++
            getStep1.setAttribute('class', 'hidden')
            getStep2.setAttribute('class', '')
            getBtnSubmit.innerHTML = 'Reset Password'
            getForgotPasswordStepper.children[step - 1].setAttribute('class', 'step-passed')
            handleOtpInput()
            handleSendCode()
          })
        }
      });

      const fv2 = FormValidation.formValidation(getStep2, {
        fields: {
          otp: {
            validators: {
              notEmpty: {
                message: 'Please enter otp'
              },
            }
          },
        },
        plugins: {
          trigger: new FormValidation.plugins.Trigger(),
          bootstrap5: new FormValidation.plugins.Bootstrap5({
            eleValidClass: '',
            rowSelector: '.mb-3'
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
          instance.on('core.form.valid', function() {
            step++
            getStep2.setAttribute('class', 'hidden')
            getStep3.setAttribute('class', '')
          })
        }
      });

      const fv3 = FormValidation.formValidation(getStep3, {
        fields: {
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
          'confirm_password': {
            validators: {
              notEmpty: {
                message: 'Please confirm password'
              },
              identical: {
                compare: function () {
                  return getStep3.querySelector('[name="password"]').value;
                },
                message: 'The password and its confirm are not the same'
              },
              stringLength: {
                min: 6,
                message: 'Password must be more than 6 characters'
              }
            }
          },
        },
        plugins: {
          trigger: new FormValidation.plugins.Trigger(),
          bootstrap5: new FormValidation.plugins.Bootstrap5({
            eleValidClass: '',
            rowSelector: '.mb-3'
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
          instance.on('core.form.valid', function() {
            step++
            getStep2.setAttribute('class', 'hidden')
            getStep3.setAttribute('class', '')
          })
        }
      });


      if (getWrapper) {
        if (getBtnSubmit) {
          getBtnSubmit.addEventListener('click', (e) => {
            e.preventDefault()
            switch (step) {
              case 1:
                fv1.validate()
                break;
              case 2:
                // fv2.validate()
                step++
                getStep2.setAttribute('class', 'hidden')
                getStep3.setAttribute('class', '')
                getForgotPasswordStepper.children[step - 1].setAttribute('class', 'step-passed')
                break;
              case 3:
                fv3.validate()
                break;
              default:
                break;
            }
          })
        }
      }
  })();
});
