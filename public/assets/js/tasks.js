'use strict';

document.addEventListener('DOMContentLoaded', function () {
    (function () {
        const getElementSidebarRight = document.querySelector('#app-chat-sidebar-right')
        const getElementChatContactTimeItem = document.querySelectorAll('#chat-contact-time')

        const timeFormat = {
            hour: 'numeric',
            minute: 'numeric'
        };
  
        function formatDate(dateString, timeOptions) {
            var options = timeOptions;
            var formattedTime = new Intl.DateTimeFormat('en-US', options).format(new Date(dateString));
            return formattedTime;
        }
        
        // change formating time chat contact time
        if (getElementChatContactTimeItem.length > 0) {
            getElementChatContactTimeItem.forEach(el => {
                el.textContent = formatDate(el.textContent, timeFormat)
            })
        }
    })();
})