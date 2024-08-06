/**
 * App Chat
 */

 'use strict';

 document.addEventListener('DOMContentLoaded', function () {
   (async function () {
    const optionsChannel = [
      {
        label: 'WhatsApp',
        value: 'wa'
      },
      {
        label: 'Email',
        value: 'email'
      },
      {
        label: 'WeChat',
        value: 'wechat'
      },
      {
        label: 'Instagram',
        value: 'instagram'
      },
    ]

    const fullToolbar = [
      [
        {
          size: []
        }
      ],
      ['bold', 'italic', 'underline'],
      [
        {
          list: 'ordered'
        },
        {
          list: 'bullet'
        },
      ],
      [
        {
          align: []
        }
      ],
      ['link', 'image', 'video'],
      ['clean']
    ];

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
              listView.classList.add('hidden')
              break;
            case '#list-view':
              kanbanView.classList.add('hidden')
              listView.classList.remove('hidden')
              chatView.classList.add('hidden')
              break;
            default:
              break;
          }
        })
      })
    }

    /**
     * @description fix handle navigate between tab in customer detail
     */
    const navItemCustomerDetail = document.querySelectorAll('.nav-item-customer-detail')
    const tabActivities = document.querySelector('#tab-activities')
    const tabCommunication = document.querySelector('#tab-communication')
    const tabTicket = document.querySelector('#tab-ticket')
    if (navItemCustomerDetail) {
      navItemCustomerDetail.forEach(el => {
        el?.addEventListener('click', () => {
          switch (el.getAttribute('data-bs-target')) {
            case '#tab-activities':
              tabActivities.classList.remove('hidden')
              tabCommunication.classList.add('hidden')
              tabTicket.classList.add('hidden')
              break;
            case '#tab-communication':
              tabActivities.classList.add('hidden')
              tabCommunication.classList.remove('hidden')
              tabTicket.classList.add('hidden')
              break;
            case '#tab-ticket':
              tabActivities.classList.add('hidden')
              tabCommunication.classList.add('hidden')
              tabTicket.classList.remove('hidden')
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

     /**
      * @description handle navigation customer detail
      */
     const btnInfo = document.querySelector('.btn-route-customer');
     if (btnInfo) {
      btnInfo.addEventListener('click', (e) => {
        e.stopPropagation()
        window.location.href = '/customers/test'
      })
     }

     /**
      * @description set scrollable sidebar client
      */
     const sidebarClient = document.querySelector('.sidebar-client-info');
     if (sidebarClient) {
      new PerfectScrollbar(sidebarClient, {
        wheelPropagation: false,
        suppressScrollX: true
      });
     }

     /**
      * @description handle sub tab communication
      */
    const navLinkCommunicationTab = document.querySelectorAll('.sub-nav-communication');
    const waTab = document.querySelector('#wa');
    const emailTab = document.querySelector('#email');
    const weChatTab = document.querySelector('#we-chat');
    const instagramTab = document.querySelector('#instagram');

    if (navLinkCommunicationTab) {
      navLinkCommunicationTab.forEach(el => {
        el?.addEventListener('click', () => {
          switch (el.getAttribute('data-bs-target')) {
            case '#wa':
              waTab.classList.remove('hidden')
              emailTab.classList.add('hidden')
              weChatTab.classList.add('hidden')
              instagramTab.classList.add('hidden')
              break;
            case '#email':
              emailTab.classList.remove('hidden')
              waTab.classList.add('hidden')
              weChatTab.classList.add('hidden')
              instagramTab.classList.add('hidden')
              break;
            case '#we-chat':
              weChatTab.classList.remove('hidden')
              waTab.classList.add('hidden')
              emailTab.classList.add('hidden')
              instagramTab.classList.add('hidden')
              break;
            case '#instagram':
              instagramTab.classList.remove('hidden')
              waTab.classList.add('hidden')
              weChatTab.classList.add('hidden')
              emailTab.classList.add('hidden')
              break;
            default:
              break;
          }
        })
      })
    }

    /**
     * @description handle create element input floating
     * @param {String} name
     * @param {String} type
     * @param {HTMLDivElement} parentEl
     */
    const createElementInputFloating = ({ name = 'contact', type = 'text', parentEl }) => {
      if (!parentEl) {
        return console.error('required pass parent element')
      }

      const containerInput = document.createElement('div')
      containerInput.setAttribute('class', 'container-input')
      const textField = document.createElement('div')
      textField.setAttribute('class', 'material-textfield')

      const input = document.createElement('input')
      input.setAttribute('placeholder', '')
      input.setAttribute('id', name.toLowerCase())
      input.setAttribute('name', name.toLowerCase())
      input.setAttribute('type', type)

      const label = document.createElement('label')
      label.setAttribute('for', name.toLowerCase())
      label.innerHTML = name

      textField.appendChild(input)
      textField.appendChild(label)
      containerInput.appendChild(textField)
      parentEl.appendChild(containerInput)
    }

    /**
     * @description handle create element channel
     * @param {HTMLDivElement} parentEl 
     */
    const createElementChannel = (parentEl) => {
      if (!parentEl) {
        return console.error('required pass parent element')
      }

      const wrapperForm = document.createElement('div')
      wrapperForm.setAttribute('class', 'd-flex justify-content-between gap-5 w-100')
      
      // create dropdown channel
      const containerInput = document.createElement('div')
      containerInput.setAttribute('class', 'container-input')
      const textField = document.createElement('div')
      textField.setAttribute('class', 'material-textfield')
      
      const select = document.createElement('select')
      select.setAttribute('id', 'channel2')
      select.setAttribute('name', 'channel2')
      
      const label = document.createElement('label')
      label.setAttribute('for', 'channel2')
      label.innerHTML = 'Channel'
      
      optionsChannel.forEach(item => {
        const option = document.createElement('option')
        option.setAttribute('value', item.value)
        option.innerText = item.label
        select.appendChild(option)
      })

      textField.appendChild(select)
      textField.appendChild(label)
      containerInput.appendChild(textField)
      wrapperForm.appendChild(containerInput)

      // create input text
      createElementInputFloating({ name: 'Contact', parentEl: wrapperForm })

      parentEl.setAttribute('class', 'd-flex flex-column gap-3 w-100')
      parentEl.appendChild(wrapperForm)
    }

    /**
     * @description handle add more channel
     */
    const getBtnAddMoreChannel = document.querySelector('#btn-more-channel')
    const getWrapperElementChannel = document.querySelector('#wrapper-channel')
    if (getBtnAddMoreChannel) {
      console.log(getBtnAddMoreChannel)
      getBtnAddMoreChannel.addEventListener('click', () => {
        createElementChannel(getWrapperElementChannel)
      })
    }

    /**
     * @description handle add more contact
     */
    const getBtnAddMoreContact = document.querySelector('#btn-more-contact')
    const getWrapperDynamicForm = document.querySelector('#wrapper-dynamic-form')
    if (getBtnAddMoreContact) {
      getBtnAddMoreContact.addEventListener('click', () => {
        const wrapperContact = document.createElement('div')
        wrapperContact.setAttribute('class', 'd-flex flex-column gap-2 border-bottom border-1 pb-3 align-items-start')

        const wrapperForm = document.createElement('div')
        wrapperForm.setAttribute('class', 'd-flex flex-column gap-3')
        
        const wrapperUsername = document.createElement('div')
        wrapperUsername.setAttribute('class', 'd-flex justify-content-between gap-5 w-100')
        
        // create element input first and last name
        const field = ['First Name', 'Last Name']
        field.forEach(item => {
          createElementInputFloating({ name: item, parentEl: wrapperUsername })
        })
      
        const wrapperChannel = document.createElement('div')
        wrapperChannel.setAttribute('class', 'd-flex justify-content-between gap-5 w-100')
      
        // create element channel
        createElementChannel(wrapperChannel)
      
        wrapperForm.appendChild(wrapperUsername)
        wrapperForm.appendChild(wrapperChannel)

        // create element input job title
        createElementInputFloating({ name: 'Job Title', parentEl: wrapperForm })

        wrapperContact.appendChild(wrapperForm)

        getWrapperDynamicForm.setAttribute('class', 'd-flex flex-column gap-2 mt-3')
        getWrapperDynamicForm.appendChild(wrapperContact)
      })
    }

    /**
     * @description handle add more channel modal customer
     */
     const getBtnAddMoreChannelCustomer = document.querySelector('#btn-more-channel-customer')
     const getWrapperElementChannelCustomer = document.querySelector('#wrapper-channel-customer')
     if (getBtnAddMoreChannelCustomer) {
       getBtnAddMoreChannelCustomer.addEventListener('click', () => {
         createElementChannel(getWrapperElementChannelCustomer)
       })
     }
 
     /**
      * @description handle add more contact customer
      */
     const getBtnAddMoreContactCustomer = document.querySelector('#btn-more-contact-customer')
     const getWrapperDynamicFormCustomer = document.querySelector('#wrapper-dynamic-form-customer')
     if (getBtnAddMoreContactCustomer) {
      getBtnAddMoreContactCustomer.addEventListener('click', () => {
         const wrapperContact = document.createElement('div')
         wrapperContact.setAttribute('class', 'd-flex flex-column gap-2 border-bottom border-1 pb-3 align-items-start')
 
         const wrapperForm = document.createElement('div')
         wrapperForm.setAttribute('class', 'd-flex flex-column gap-3')
         
         const wrapperUsername = document.createElement('div')
         wrapperUsername.setAttribute('class', 'd-flex justify-content-between gap-5 w-100')
         
         // create element input first and last name
         const field = ['First Name', 'Last Name']
         field.forEach(item => {
           createElementInputFloating({ name: item, parentEl: wrapperUsername })
         })
       
         const wrapperChannel = document.createElement('div')
         wrapperChannel.setAttribute('class', 'd-flex justify-content-between gap-5 w-100')
       
         // create element channel
         createElementChannel(wrapperChannel)
       
         wrapperForm.appendChild(wrapperUsername)
         wrapperForm.appendChild(wrapperChannel)
 
         wrapperContact.appendChild(wrapperForm)
 
         getWrapperDynamicFormCustomer.setAttribute('class', 'd-flex flex-column gap-2 mt-3')
         getWrapperDynamicFormCustomer.appendChild(wrapperContact)
       })
     }

    /**
     * @description adding scrollbar in wrapper detail tab communication email
     */
    const wrapperCustomerDetailEmail = document.querySelector('#customer-detail-content-email')
    if (wrapperCustomerDetailEmail) {
      new PerfectScrollbar(wrapperCustomerDetailEmail, {
        wheelPropagation: false,
        suppressScrollX: true
      });
    }

    /**
     * @description text editor for modal new/reply email
     */
    const commentEditor = document.querySelector('#full-editor');
    if (commentEditor) {
      new Quill(commentEditor, {
        bounds: commentEditor,
        placeholder: 'Write a Comment... ',
        modules: {
          toolbar: fullToolbar
        },
        theme: 'snow'
      });
    }

    /**
     * @description handle open close dropdown button new in tab activities
     */
    const getBtnDropdown = document.querySelector('#add-dropdown')
    const getModalDropdown = document.querySelector('.modal-dropdown')
    if (getBtnDropdown) {
      getBtnDropdown.addEventListener('click', () => {
        const isHidden = getModalDropdown.className.includes('hidden')

        if (isHidden) {
          getModalDropdown.classList.remove('hidden')
        } else {
          getModalDropdown.classList.add('hidden')
        }
      })
    }

    /**
     * @description handle input date for all modal activities
     */
    const dateInput = document.querySelectorAll("#date");
    if (dateInput.length > 0) {
      dateInput.forEach(el => {
        el.flatpickr({
          monthSelectorType: 'static'
        });
      })
    }

    const startDateInput = document.querySelectorAll("#start_date");
    if (startDateInput.length > 0) {
      startDateInput.forEach(el => {
        el.flatpickr({
          enableTime: true,
          noCalendar: true
        });
      })
    }

    const endDateInput = document.querySelectorAll("#end_date");
    if (endDateInput.length > 0) {
      endDateInput.forEach(el => {
        el.flatpickr({
          enableTime: true,
          noCalendar: true
        });
      })
    }

    /**
     * @description text editor for modal activities (Log a Call)
     */
    const logCallEditor = document.querySelector('#full-editor-log-call');
    if (logCallEditor) {
      new Quill(logCallEditor, {
        bounds: logCallEditor,
        placeholder: 'Write a note... ',
        modules: {
          toolbar: fullToolbar
        },
        theme: 'snow'
      });
    }

    /**
     * @description text editor for modal activities (Log a Meeting)
     */
     const logMeetingEditor = document.querySelector('#full-editor-log-meeting');
     if (logMeetingEditor) {
       new Quill(logMeetingEditor, {
         bounds: logMeetingEditor,
         placeholder: 'Write a note... ',
         modules: {
           toolbar: fullToolbar
         },
         theme: 'snow'
       });
     }

     /**
     * @description text editor for modal activities (Log a task)
     */
    const logTaskEditor = document.querySelector('#full-editor-log-task');
    if (logTaskEditor) {
      new Quill(logTaskEditor, {
        bounds: logTaskEditor,
        placeholder: 'Write a note... ',
        modules: {
          toolbar: fullToolbar
        },
        theme: 'snow'
      });
    }

    /**
     * @description text editor for modal activities (Schedule a Call)
     */
     const scheduleCallEditor = document.querySelector('#full-editor-schedule-call');
     if (scheduleCallEditor) {
       new Quill(scheduleCallEditor, {
         bounds: scheduleCallEditor,
         placeholder: 'Write a note... ',
         modules: {
           toolbar: fullToolbar
         },
         theme: 'snow'
       });
     }

     /**
     * @description text editor for modal activities (Schedule a Meeting)
     */
    const scheduleMeetingEditor = document.querySelector('#full-editor-schedule-meeting');
    if (scheduleMeetingEditor) {
      new Quill(scheduleMeetingEditor, {
        bounds: scheduleMeetingEditor,
        placeholder: 'Write a note... ',
        modules: {
          toolbar: fullToolbar
        },
        theme: 'snow'
      });
    }

    /**
     * @description text editor for modal activities (Schedule a Task)
     */
     const scheduleTaskEditor = document.querySelector('#full-editor-schedule-task');
     if (scheduleTaskEditor) {
       new Quill(scheduleTaskEditor, {
         bounds: scheduleTaskEditor,
         placeholder: 'Write a note... ',
         modules: {
           toolbar: fullToolbar
         },
         theme: 'snow'
       });
     }

    /**
    * @description text editor for modal activities (Add Notes)
    */
    const addNotesEditor = document.querySelector('#full-editor-add-notes');
    if (addNotesEditor) {
      new Quill(addNotesEditor, {
        bounds: addNotesEditor,
        placeholder: 'Write a note... ',
        modules: {
          toolbar: fullToolbar
        },
        theme: 'snow'
      });
    }

    /**
     * @description handle flow internal chat
     */
    const btnInternalChat = document.querySelector('#btn-internal-chat')
    const getTextChat = document.querySelector('.messenger-sendCard')
    const getCountdownSession = $('#countdown-session')
    if (btnInternalChat) {
      btnInternalChat.addEventListener('click', (e) => {
        e.preventDefault()
        if ($('#confirmation-internal-chat').is(":hidden")) {
          getTextChat.style.background = '#FCF0D4'
          $('#confirmation-internal-chat').show()
          $('#btn-upload').hide()
          $('#btn-template').hide()
          $('#confirmation-session-expired').hide()
          $('.m-send').show()
          $('.send-button').show();
          $('#type').val('internalChat')
        } else if (getCountdownSession.text() === 'EXPIRED') {
          $('.m-send').hide()
          $('#confirmation-internal-chat').hide()
          $('#confirmation-session-expired').show()
          $('#btn-template').show();
          $('#icon-bolt').hide();
          $('#btn-upload').hide();
          $('#btn-internal-chat').show();
          $('.send-button').hide();
          $('#icon-bolt-active').show()
          $('#type').val('contactChat')
          getTextChat.style.background = 'rgb(241, 242, 244)'
        } else {
          $('#btn-upload').show()
          $('#btn-template').show()
          $('#confirmation-internal-chat').hide()
          getTextChat.style.background = 'rgb(241, 242, 244)'
        }
      })
      $('#confirmation-internal-chat').on('click', (e) => {
        e.preventDefault()
        $('#confirmation-internal-chat').hide()
        getTextChat.style.background = 'rgb(241, 242, 244)'
        
        if (getCountdownSession.text() === 'EXPIRED') {
          $('#confirmation-session-expired').show()
          $('.m-send').hide();
          $('#btn-template').show();
          $('#icon-bolt').hide();
          $('#btn-upload').hide();
          $('.send-button').hide();
          $('#icon-bolt-active').show();
        } else {
          $('#btn-upload').show();
          $('#btn-template').show();
        }
      })
    }
   })();
 });
 