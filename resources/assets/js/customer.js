/**
 * App Chat
 */

 'use strict';

 document.addEventListener('DOMContentLoaded', function () {
   (async function () {
     const chatHistoryWrapper = document.querySelector('.chat-history-wrapper');

     if (chatHistoryWrapper) {
        // dynamic adding/remove nav
        // const ul = document.createElement('ul')
        // const li = document.createElement('li')
        // const btn = document.createElement('button')
        // ul.setAttribute('class', 'nav nav-tabs nav-tab-chat')
        // ul.setAttribute('role', 'tablist')
        // li.classList.add('nav-item')
        // btn.setAttribute('type', 'button')
        // btn.classList.add('nav-link')
        // btn.setAttribute('role', 'tab')
        // btn.setAttribute('data-bs-toggle', 'tab')
        // btn.setAttribute('data-bs-target', '#navs-top-home')
        // btn.setAttribute('aria-controls', 'navs-top-home')
        // btn.setAttribute('aria-selected', 'true')
        // btn.innerText = 'Home'
        // li.appendChild(btn)
        // ul.appendChild(li)
        // chatHistoryWrapper.prepend(ul)
     }

     /**
      * @description handle tab view menu
      */
    const navLink = document.querySelectorAll('.nav-link');
    const chatView = document.querySelector('#chat-view');
    const kanbanView = document.querySelector('#kanban-view');
    const listView = document.querySelector('#list-view');

    if (navLink) {
      navLink.forEach(el => {
        el?.addEventListener('click', () => {
          switch (el.getAttribute('data-bs-target')) {
            case '#chat-view':
              chatView.classList.remove('hidden')
              kanbanView.classList.add('hidden')
              listView.classList.add('hidden')
              break;
            case '#kanban-view':
              chatView.classList.add('hidden')
              kanbanView.classList.remove('hidden')
              break;
            case '#list-view':
              kanbanView.classList.add('hidden')
              listView.classList.remove('hidden')
              break;
            default:
              break;
          }
        })
      })
    }

    /**
     * @description flow open/close field start date in modal filter
     */
    const startDate = document.querySelector("#start-date");
    if (startDate) {
      startDate.flatpickr({
        monthSelectorType: 'static'
      });
    }

    /**
     * @description flow open/close field end date in modal filter
     */
     const endDate = document.querySelector("#end-date");
     if (endDate) {
       endDate.flatpickr({
         monthSelectorType: 'static'
       });
     }
   })();
 });
 