'use strict';

document.addEventListener('DOMContentLoaded', function () {
  (function () {
    const getElementCardPlanAll = document.querySelectorAll('.card-plan > .card-plan-header')
    
    getElementCardPlanAll.forEach(parentEl => {
        const getTargetCheckbox = parentEl.children[0].children[1]
        getTargetCheckbox.addEventListener('click', () => {
            // remove class active in all parent component
            // by attribute name
            getElementCardPlanAll.forEach(el => {
                const getInnerCheckbox = el.children[0].children[1]
                if (getTargetCheckbox.getAttribute('name') === 'user-plan' && !getInnerCheckbox.checked) {
                    el.classList.remove('active')
                }
                if (getTargetCheckbox.getAttribute('name') === 'conversation-plan' && !getInnerCheckbox.checked) {
                    el.classList.remove('active')
                }
            })
            // set class active in selected parent component
            parentEl.classList.add('active')
        })
    })
  })();
})