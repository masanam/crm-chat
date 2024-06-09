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
   })();
 });
 