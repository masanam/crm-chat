/**
 * App Chat
 */

 'use strict';

 document.addEventListener('DOMContentLoaded', function () {
   (async function () {
    const getContainerFormStepper = document.querySelector('.container-form-stepper')
    const getFormStepper = document.querySelector('#payment-form')
    const getStep1 = document.querySelector('#step1-validation')
    const getStep2 = document.querySelector('#step2-validation')
    const getStep3 = document.querySelector('#step3-validation')
    const getStep4 = document.querySelector('#step4-validation')
    const getStep5 = document.querySelector('#step5-validation')
    const getBtnNext = document.querySelectorAll('#btn-next')
    const getBtnSubmit = document.querySelector('#btn-submit-payment')
    const getFooter = document.querySelector('.footer')
    let step = 1
    let scrollbar
    let fv1, fv2, fv3, fv4, fv5

    if (getFormStepper) {
        fv1 = FormValidation.formValidation(getStep1, {
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
              }
            },
            plugins: {
              trigger: new FormValidation.plugins.Trigger(),
              bootstrap5: new FormValidation.plugins.Bootstrap5({
                eleValidClass: '',
                rowSelector: '.mb-3'
              }),
              submitButton: new FormValidation.plugins.SubmitButton(),
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
              })
            }
        });

        fv2 = FormValidation.formValidation(getStep2, {
            fields: {
              'first_name': {
                validators: {
                  notEmpty: {
                    message: 'Please enter your first name'
                  },
                }
              },
              'last_name': {
                validators: {
                  notEmpty: {
                    message: 'Please enter your last name'
                  },
                }
              },
              'phone_number': {
                validators: {
                  notEmpty: {
                    message: 'Please enter your phone number'
                  },
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

        fv3 = FormValidation.formValidation(getStep3, {
            fields: {
              company: {
                 validators: {
                   notEmpty: {
                     message: 'Please enter your company'
                   },
                 }
              },
              job: {
                validators: {
                  notEmpty: {
                    message: 'Please enter your job'
                  },
                }
              },
              industry: {
                validators: {
                  notEmpty: {
                    message: 'Please enter your industry'
                  },
                }
              },
              'team_number': {
                validators: {
                  notEmpty: {
                    message: 'Please enter your team number'
                  },
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
              autoFocus: new FormValidation.plugins.AutoFocus()
            },
            init: instance => {
              instance.on('plugins.message.placed', function (e) {
                if (e.element.parentElement.classList.contains('input-group')) {
                  e.element.parentElement.insertAdjacentElement('afterend', e.messageElement);
                }
                instance.on('core.form.valid', function() {
                    step = 4
                    getStep3.setAttribute('class', 'hidden')
                    getStep4.setAttribute('class', '')
                  })
              });
            }
        });

        fv4 = FormValidation.formValidation(getStep4, {
            fields: {
              'new_password': {
                validators: {
                  notEmpty: {
                    message: 'Please enter your password'
                  },
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
              autoFocus: new FormValidation.plugins.AutoFocus()
            },
            init: instance => {
              instance.on('plugins.message.placed', function (e) {
                if (e.element.parentElement.classList.contains('input-group')) {
                  e.element.parentElement.insertAdjacentElement('afterend', e.messageElement);
                }
              });
              instance.on('core.form.valid', function() {
                step = 5
                getStep4.setAttribute('class', 'hidden')
                getStep5.setAttribute('class', '')
                getFooter.setAttribute('class', 'hidden')
                const getBg = document.querySelector('.signup-bg')
                getBg.style.width = '645.5px'
              })
            }
        });

        fv5 = FormValidation.formValidation(getStep5, {
            fields: {
              'card_number': {
                validators: {
                  notEmpty: {
                    message: 'Please enter your card number'
                  },
                }
              },
              'exp_date': {
                validators: {
                  notEmpty: {
                    message: 'Please enter your expired date'
                  },
                }
              },
              'security_code': {
                validators: {
                  notEmpty: {
                    message: 'Please enter your security code'
                  },
                }
              },
              'firstName': {
                validators: {
                  notEmpty: {
                    message: 'Please enter your first name'
                  },
                }
              },
              'lastName': {
                validators: {
                  notEmpty: {
                    message: 'Please enter your last name'
                  },
                }
              },
              'emailAddress': {
                validators: {
                  notEmpty: {
                    message: 'Please enter your email'
                  },
                  emailAddress: {
                    message: 'Please enter valid email address'
                  }
                }
              },
              'address': {
                validators: {
                  notEmpty: {
                    message: 'Please enter your address'
                  },
                }
              },
              'state': {
                validators: {
                  notEmpty: {
                    message: 'Please enter your state'
                  },
                }
              },
              'city': {
                validators: {
                  notEmpty: {
                    message: 'Please enter your city'
                  },
                }
              },
              'postal_code': {
                validators: {
                  notEmpty: {
                    message: 'Please enter your postal code'
                  },
                }
              },
              'phone': {
                validators: {
                  notEmpty: {
                    message: 'Please enter your phone'
                  },
                }
              },
            plugins: {
              trigger: new FormValidation.plugins.Trigger(),
              bootstrap5: new FormValidation.plugins.Bootstrap5({
                eleValidClass: '',
                rowSelector: '.mb-3'
              }),
              submitButton: new FormValidation.plugins.SubmitButton(),
              autoFocus: new FormValidation.plugins.AutoFocus()
            },
            init: instance => {
              instance.on('plugins.message.placed', function (e) {
                if (e.element.parentElement.classList.contains('input-group')) {
                  e.element.parentElement.insertAdjacentElement('afterend', e.messageElement);
                }
                instance.on('core.form.valid', function() {
                    // step++
                    // getStep5.setAttribute('class', 'hidden')
                    // getStep5.setAttribute('class', '')
                    console.log('ww')
                  })
              });
            }
            }
        });
    }
    
    if (getContainerFormStepper) {
        scrollbar = new PerfectScrollbar(getContainerFormStepper, {
            wheelPropagation: false,
            suppressScrollX: true
        });
    }

    if (getBtnNext) {
        getBtnNext.forEach(btnNext => {
            btnNext.addEventListener('click', (e) => {
                e.preventDefault()
                switch (step) {
                    case 1:
                        fv1.validate()
                        break;
                    case 2:
                        fv2.validate()
                        break;
                    case 3:
                        fv3.validate()
                        break;
                    case 4:
                        fv4.validate()
                        break;
                }
                console.log(step)
            })
        })
    }
    if (getBtnSubmit) {
        getBtnSubmit.addEventListener('click', (e) => {
            e.preventDefault()
            fv5.validate()
        })
    }
   })();
 });
 