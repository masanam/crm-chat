'use strict';

document.addEventListener('DOMContentLoaded', function () {
  (function () {

    // flow in/out sidebar right
    const getElementSidebarRight = document.querySelector('#app-chat-sidebar-right')
    const getElementCloseSidebar = document.querySelectorAll('.close-sidebar')
    const getElementChatHistory = document.querySelector('.app-chat-history')
    const getElementSidebarRightOne = document.querySelector('.sidebar-one-on-one')

    // Sidebar right scrollbar
    if (getElementSidebarRight) {
      new PerfectScrollbar(getElementSidebarRight, {
        wheelPropagation: false,
        suppressScrollX: true
      });
    }

    /**
     * @description event delegation for open sidebar
     */
    if (getElementChatHistory) {
      getElementChatHistory.addEventListener('click', e => {
        // check if target is btn info
        if(e.target.tagName === 'IMG') {
          if (getElementSidebarRight.style.display !== 'none') {
            getElementSidebarRight.classList.add('show')
          } else {
            getElementSidebarRightOne.classList.add('show')
          }
        }
      })
    }
    
    /**
     * @description close sidebar
     */
    if (getElementCloseSidebar) {
      getElementCloseSidebar.forEach(el => {
        el.addEventListener('click', () => {
          if (getElementSidebarRight.style.display !== 'none') {
            getElementSidebarRight.classList.remove('show')
          } else {
            getElementSidebarRightOne.classList.remove('show')
          }
        })
      })
    }
  })();
})