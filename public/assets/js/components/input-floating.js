'use strict';

document.addEventListener('DOMContentLoaded', function () {
    (function () {
        // select2
        const select2 = $('.select2');

        if (select2.length) {
            select2.each(function () {
              var $this = $(this);
              $this.wrap('<div class="position-relative"></div>')?.select2({
                placeholder: 'Select value',
                dropdownParent: $this.parent()
              });

              $this.on('select2:open', () => {
                const targetLabel = document.querySelector('#label-multiple');
                targetLabel.classList.add('selected');
              }).on('select2:close', (elm) => {
                  const targetLabel = document.querySelector('#label-multiple');
                  const targetOptions = $(elm.target.selectedOptions);
                  if (targetOptions.length === 0) {
                      targetLabel.classList.remove('selected');
                  }
              });
            });
        }

        // flow type password
        const getElementIconPassword = document.querySelector('.icon-password')
        const getElementPassword = document.querySelector('.input-password')
        getElementIconPassword?.addEventListener('click', () => {
          if (getElementIconPassword.classList.contains('ti-eye-off')) {
            getElementIconPassword.classList.remove('ti-eye-off')
            getElementIconPassword.classList.add('ti-eye')
            getElementPassword.type = 'text'
          } else {
            getElementIconPassword.classList.remove('ti-eye')
            getElementIconPassword.classList.add('ti-eye-off')
            getElementPassword.type = 'password'
          }
        })

        // flow textarea
        const getAllElementTextarea = document.querySelectorAll('textarea')
        getAllElementTextarea?.forEach(el => {
          el.value = ''
        })
    })();
});