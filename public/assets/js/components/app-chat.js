/**
 * App Chat
 */

'use strict';

// const moment = require("moment/moment");

document.addEventListener('DOMContentLoaded', function () {
  (async function () {
    await fetchChatData();
    fetchInternalNotes();

    // Panggil fungsi fetchChatData setiap 7 detik
    setInterval(fetchChatData, 7000);
    const chatContactsBody = document.querySelector('.app-chat-contacts .sidebar-body'),
      chatContactListItems = [].slice.call(
        document.querySelectorAll('.chat-contact-list-item:not(.chat-contact-list-item-title)')
      ),
      chatHistoryBody = document.querySelector('.chat-history-body'),
      chatSidebarLeftBody = document.querySelector('.app-chat-sidebar-left .sidebar-body'),
      chatSidebarRightBody = document.querySelector('.app-chat-sidebar-right .sidebar-body'),
      chatUserStatus = [].slice.call(document.querySelectorAll(".form-check-input[name='chat-user-status']")),
      chatSidebarLeftUserAbout = $('.chat-sidebar-left-user-about'),
      formSendMessage = document.querySelector('.form-send-message'),
      formSendInternalMessage = document.querySelector('.form-send-internal-message'),
      internalNoteHistory = document.querySelector('.internal-notes-history'),
      messageInput = document.querySelector('.message-input'),
      userID = document.querySelector('#USERID'),
      internalMessageInput = document.querySelector('.internal-message-input'),
      searchInput = document.querySelector('.chat-search-input'),
      speechToText = $('.speech-to-text'), // ! jQuery dependency for speech to text
      userStatusObj = {
        active: 'avatar-online',
        offline: 'avatar-offline',
        away: 'avatar-away',
        busy: 'avatar-busy'
      };

    scrollToBottom();
    const dateFormat = {
      weekday: 'long',
      year: 'numeric',
      month: 'long',
      day: 'numeric'
    };
    const timeFormat = {
      hour: 'numeric',
      minute: 'numeric'
    };

    // Initialize PerfectScrollbar
    // ------------------------------

    // Chat contacts scrollbar
    if (chatContactsBody) {
      new PerfectScrollbar(chatContactsBody, {
        wheelPropagation: false,
        suppressScrollX: true
      });
    }

    // Chat history scrollbar
    if (chatHistoryBody) {
      new PerfectScrollbar(chatHistoryBody, {
        wheelPropagation: false,
        suppressScrollX: true
      });
    }

    // Sidebar left scrollbar
    // if (chatSidebarLeftBody) {
    //   new PerfectScrollbar(chatSidebarLeftBody, {
    //     wheelPropagation: false,
    //     suppressScrollX: true
    //   });
    // }

    // // Sidebar right scrollbar
    // if (chatSidebarRightBody) {
    //   new PerfectScrollbar(chatSidebarRightBody, {
    //     wheelPropagation: false,
    //     suppressScrollX: true
    //   });
    // }

    // Scroll to bottom function
    function scrollToBottom() {
      chatHistoryBody?.scrollTo(0, chatHistoryBody.scrollHeight);
    }
    scrollToBottom();

    // User About Maxlength Init
    if (chatSidebarLeftUserAbout.length) {
      chatSidebarLeftUserAbout.maxlength({
        alwaysShow: true,
        warningClass: 'label label-success bg-success text-white',
        limitReachedClass: 'label label-danger',
        separator: '/',
        validate: true,
        threshold: 120
      });
    }

    // flow open/close picker date
    var flatpickrDate = document.querySelector("#flatpickr-date");
    if (flatpickrDate) {
      flatpickrDate.flatpickr({
        monthSelectorType: 'static'
      });
    }

    // Update user status
    chatUserStatus.forEach(el => {
      el.addEventListener('click', e => {
        let chatLeftSidebarUserAvatar = document.querySelector('.chat-sidebar-left-user .avatar'),
          value = e.currentTarget.value;
        //Update status in left sidebar user avatar
        chatLeftSidebarUserAvatar.removeAttribute('class');
        Helpers._addClass('avatar avatar-xl ' + userStatusObj[value] + '', chatLeftSidebarUserAvatar);
        //Update status in contacts sidebar user avatar
        let chatContactsUserAvatar = document.querySelector('.app-chat-contacts .avatar');
        chatContactsUserAvatar.removeAttribute('class');
        Helpers._addClass('flex-shrink-0 avatar ' + userStatusObj[value] + ' me-3', chatContactsUserAvatar);
      });
    });

    // Select chat or contact
    chatContactListItems.forEach(chatContactListItem => {
      // Bind click event to each chat contact list item
      chatContactListItem.addEventListener('click', e => {
        // Remove active class from chat contact list item
        chatContactListItems.forEach(chatContactListItem => {
          chatContactListItem.classList.remove('active');
        });
        // Add active class to current chat contact list item
        e.currentTarget.classList.add('active');
      });
    });

    // Filter Chats
    if (searchInput) {
      searchInput.addEventListener('keyup', e => {
        let searchValue = e.currentTarget.value.toLowerCase(),
          searchChatListItemsCount = 0,
          searchContactListItemsCount = 0,
          chatListItem0 = document.querySelector('.chat-list-item-0'),
          contactListItem0 = document.querySelector('.contact-list-item-0'),
          searchChatListItems = [].slice.call(
            document.querySelectorAll('#chat-list li:not(.chat-contact-list-item-title)')
          ),
          searchContactListItems = [].slice.call(
            document.querySelectorAll('#contact-list li:not(.chat-contact-list-item-title)')
          );

        // Search in chats
        searchChatContacts(searchChatListItems, searchChatListItemsCount, searchValue, chatListItem0);
        // Search in contacts
        searchChatContacts(searchContactListItems, searchContactListItemsCount, searchValue, contactListItem0);
      });
    }

    // Search chat and contacts function
    function searchChatContacts(searchListItems, searchListItemsCount, searchValue, listItem0) {
      searchListItems.forEach(searchListItem => {
        let searchListItemText = searchListItem.textContent.toLowerCase();
        if (searchValue) {
          if (-1 < searchListItemText.indexOf(searchValue)) {
            searchListItem.classList.add('d-flex');
            searchListItem.classList.remove('d-none');
            searchListItemsCount++;
          } else {
            searchListItem.classList.add('d-none');
          }
        } else {
          searchListItem.classList.add('d-flex');
          searchListItem.classList.remove('d-none');
          searchListItemsCount++;
        }
      });
      // Display no search fount if searchListItemsCount == 0
      if (searchListItemsCount == 0) {
        listItem0.classList.remove('d-none');
      } else {
        listItem0.classList.add('d-none');
      }
    }

    function formatDate(dateString, timeOptions) {
      var options = timeOptions;
      var formattedTime = new Intl.DateTimeFormat('en-US', options).format(new Date(dateString));
      return formattedTime;
    }

    // Function to get the current time in the desired format
    function getCurrentTime() {
      const now = new Date();
      const hours = now.getHours().toString().padStart(2, '0');
      const minutes = now.getMinutes().toString().padStart(2, '0');
      return `${hours}:${minutes}`;
    }

    const sendMessage = async (type, id, message) => {
      console.log('message', message)

      const response = await axios.get(`${baseUrl}api/is_dealer/${id}`)
      console.log('response', response.data)
      const data = response.data

      const url = baseUrl + 'api/send-whatsapp'
      console.log('url', url)

      const body = JSON.stringify({
        phone: data.dealer?.business_phone, // replace with the actual phone number
        // phone: '+6281217071702', // replace with the actual phone number
        message: message,
        user_id: id,
        type: type,
        lead_id: data.assigned_lead?.lead_id,
        dealer_id: data.dealer_id
      })

      console.log('body', body)

      await axios.post(url, body, {
        // fetch('https://crm.pasima.co/api/send-whatsapp', {
        // method: 'POST',
        headers: {
          'Content-Type': 'application/json'
        },
      })
        .then(response => {
          if (!response.status) {
            throw new Error('Network response was not ok');
          }

          console.log('response', response.data)
          return response.data;
        })
        .then(data => {
          // Handle the response data as needed
          console.log(data);
        })
        .catch(error => {
          // Handle errors
          console.error('There was a problem with the fetch operation:', error);
        });
    }

    // Send Message
    formSendMessage?.addEventListener('submit', e => {
      e.preventDefault();

      var userId = user.id;
      console.log('user di submit', user)

      const user_chat = JSON.parse(user)
      console.log('user', user_chat)
      console.log('user.id', user_chat.profile_id)

      // var userId = getQueryParam('user_id');
      // console.log('userId', userId)

      if (messageInput.value) {
        // Create a div and add a class
        // let renderMsg = document.createElement('div');
        // renderMsg.className = 'chat-message-text mt-2';
        // renderMsg.innerHTML = '<p class="mb-0 text-break">' + messageInput.value + '</p>';
        // document.querySelector('li:last-child .chat-message-wrapper').appendChild(renderMsg);
        let newMessage = document.createElement('li');
        newMessage.className = 'chat-message chat-message-right';
        newMessage.innerHTML = `
          <div class="d-flex overflow-hidden">
              <div class="chat-message-wrapper flex-grow-1">
                  <div class="chat-message-text">
                      <p class="mb-0">${messageInput.value}</p>
                  </div>
                  <div class="text-end text-muted mt-1">
                      <i class='ti ti-checks ti-xs me-1 text-muted'></i>
                      <small>${getCurrentTime()}</small>
                  </div>
              </div>
              <div class="user-avatar flex-shrink-0 ">
                    <div class="avatar"><span class="avatar-initial rounded-8 text-dark fw-bolder sender-avatar">D</span></div>
                </div>
          </div>
        `;

        // Append the new message to the .chat-history
        document.querySelector('.chat-history').appendChild(newMessage);

        // Make a POST request to the API
        sendMessage('template', user_chat.profile_id, messageInput.value)

        messageInput.value = '';
        scrollToBottom();
      }
    });

    // on click of chatHistoryHeaderMenu, Remove data-overlay attribute from chatSidebarLeftClose to resolve overlay overlapping issue for two sidebar
    // let chatHistoryHeaderMenu = document.querySelector(".chat-history-header [data-target='#app-chat-contacts']"),
    //   chatSidebarLeftClose = document.querySelector('.app-chat-sidebar-left .close-sidebar');
    // chatHistoryHeaderMenu.addEventListener('click', e => {
    //   chatSidebarLeftClose.removeAttribute('data-overlay');
    // });
    // }

    // Speech To Text
    if (speechToText.length) {
      var SpeechRecognition = SpeechRecognition || webkitSpeechRecognition;
      if (SpeechRecognition !== undefined && SpeechRecognition !== null) {
        var recognition = new SpeechRecognition(),
          listening = false;
        speechToText.on('click', function () {
          const $this = $(this);
          recognition.onspeechstart = function () {
            listening = true;
          };
          if (listening === false) {
            recognition.start();
          }
          recognition.onerror = function (event) {
            listening = false;
          };
          recognition.onresult = function (event) {
            $this.closest('.form-send-message').find('.message-input').val(event.results[0][0].transcript);
          };
          recognition.onspeechend = function (event) {
            listening = false;
            recognition.stop();
          };
        });
      }
    }

    async function fetchInternalNotes() {
      try {
        // Fetch data from the API
        const response = await fetch('https://crm.pasima.co/api/internal-notes/1');
        const apiResponse = await response.json();

        // Iterate over each item in the API response and append a timeline item
        apiResponse.forEach(item => {
          // Create a new li element
          var newLi = document.createElement('li');
          newLi.className = 'timeline-item pb-4 timeline-item-info border-left-dashed';

          // Populate the li element with data from the API response
          newLi.innerHTML = `
                  <span class="timeline-indicator-advanced timeline-indicator-info">
                      <i class="ti ti-user-circle rounded-circle"></i>
                  </span>
                  <div class="timeline-event pb-3">
                      <div class="timeline-header">
                          <span class="text-muted">${formatDate(item.created_at, dateFormat)}</span>
                      </div>
                      <div class="timeline-header">
                          <span class="text-muted">${formatDate(item.created_at, timeFormat)}</span>
                      </div>
                      <p>${item.message}</p>
                      <hr />
                      <div class="d-flex justify-content-between flex-wrap gap-2">
                          <div class="d-flex flex-wrap">
                              <div>
                                  <p class="mb-0">Dandi</p>
                              </div>
                          </div>
                      </div>
                  </div>
              `;

          // Append the new li element to the element with class internalNoteHistory
          internalNoteHistory?.appendChild(newLi);
        });
      } catch (error) {
        console.error('Error fetching data:', error);
      }
    }

    // Send Message
    if (formSendInternalMessage) {
      formSendInternalMessage.addEventListener('submit', async e => {
        e.preventDefault();
        if (internalMessageInput.value) {
          try {
            const response = await fetch('https://crm.pasima.co/api/internal-notes', {
              method: 'POST',
              headers: {
                'Content-Type': 'application/json'
              },
              body: JSON.stringify({
                user_id: 1, // Replace with the desired user_id
                lead_id: 1, // Replace with the desired lead_id
                message: internalMessageInput.value // Replace with the desired message
              })
            });

            if (response.ok) {
              console.log('Data posted successfully!');
              const responseData = await response.json();
              const created_at = responseData.created_at;
              const message = responseData.message;
              var newLi = document.createElement('li');
              newLi.className = 'timeline-item pb-4 timeline-item-info border-left-dashed';

              // Populate the li element with data from the API response
              newLi.innerHTML = `
                        <span class="timeline-indicator-advanced timeline-indicator-info">
                            <i class="ti ti-user-circle rounded-circle"></i>
                        </span>
                        <div class="timeline-event pb-3">
                            <div class="timeline-header">
                                <span class="text-muted">${formatDate(created_at, dateFormat)}</span>
                            </div>
                            <div class="timeline-header">
                                <span class="text-muted">${formatDate(created_at, timeFormat)}</span>
                            </div>
                            <p>${message}</p>
                            <hr />
                            <div class="d-flex justify-content-between flex-wrap gap-2">
                                <div class="d-flex flex-wrap">
                                    <div>
                                        <p class="mb-0">Dandi</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    `;
              internalNoteHistory?.appendChild(newLi);
              internalMessageInput.value = '';
            } else {
              console.error('Failed to post data:', response.statusText);
            }
          } catch (error) {
            console.error('Error posting data:', error);
          }
        }
      });
    }

    function getUriSegment(segmentIndex) {
      // Get the URL pathname (excluding query string)
      const pathname = window.location.pathname.split('?')[0];
      console.log('pathname', pathname)

      // Split the pathname into segments using a forward slash (/) delimiter
      const segments = pathname.split('/');
      console.log('segments', segments)

      // Check if the requested segment index is within bounds
      if (segmentIndex < 0 || segmentIndex >= segments.length) {
        return null; // Return null if the segment doesn't exist
      }

      // Return the requested URI segment
      return segments[segmentIndex];
    }

    async function fetchChatData() {
      console.log('GET CHAT');
      const dateFormat = {
        year: 'numeric',
        month: 'numeric',
        day: 'numeric',
        hour: 'numeric',
        minute: 'numeric'
      };

      // Ganti dengan endpoint yang sesuai
      console.log('profileData', profileData)
      console.log('profileData', profileData.dealer)
      console.log('profileData', profileData.dealer?.business_phone)
      console.log('user', user)
      const ticketId = parseInt(getUriSegment(2));
      const endpoint = baseUrl + `api/get-chats-ticket/${profile.dealer.business_phone}/${ticketId}`; // to sebelah kanan
      // const endpoint = 'https://crm.pasima.co/api/get-chats/+6281217071702';

      // Lakukan request ke endpoint
      await axios.get(endpoint)
        .then(response => response.data)
        .then(data => {
          document.querySelector('.chat-history').innerHTML = '';
          console.log('data endpoint', data)
          // Loop melalui setiap pesan
          data.forEach(message => {
            // fungsi temporary
            var sender_id = message.user_id;
            var sender_name = '';
            switch (sender_id) {
              case 1:
                sender_name = 'Admin';
                break;
              case 2:
                sender_name = 'Dandi';
                break;
              default:
                break;
            }
            var initials = sender_name.match(/\b\w/g) || [];
            initials = ((initials.shift() || '') + (initials.pop() || '')).toUpperCase();
            // Buat elemen li baru
            const newMessage = document.createElement('li');
            // Check the 'from' value to determine the message position
            if (message.from === '6285218056736') {
              // if (message.from === '+14155238886') {
              newMessage.className = 'chat-message chat-message-right';
              newMessage.innerHTML = `
            <div class="d-flex align-items-end overflow-hidden">
                <div class="chat-message-wrapper flex-grow-1 w-50">
                    <div class="chat-message-text">
                        <p class="mb-0">${message.message}</p>
                    </div>
                    <div class="text-end text-muted mt-1">
                      <small>${moment(message.created_at).fromNow()}</small>
                      <i class='ti ti-checks ti-xs me-1'></i>
                    </div>
                    <div class="text-end text-muted mt-1">
                      <small class="sender-message">${sender_name}</small>
                    </div>
                </div>
                <div class="user-avatar flex-shrink-0 ">
                    <div class="avatar"><span class="avatar-initial rounded-8 text-dark fw-bolder sender-avatar">${initials}</span></div>
                </div>
            </div>
          `;
            } else {
              newMessage.className = 'chat-message';
              newMessage.innerHTML = `
            <div class="d-flex align-items-end overflow-hidden">
                <div class="user-avatar flex-shrink-0 me-2">
                    <div class="avatar"><span class="avatar-initial rounded-8 bg-label-success text-dark fw-bolder">AR</span></div>
                </div>
                <div class="chat-message-wrapper flex-grow-1">
                    <div class="chat-message-text">
                        <p class="mb-0">${message.message}</p>
                    </div>
                    <div class="text-muted mt-1">
                        <small>${moment(message.created_at).fromNow()}</small>
                    </div>
                </div>
            </div>
          `;
              console.log('newMessage', newMessage)
            }

            document.querySelector('.chat-history').append(newMessage);
            // Tambahkan pesan ke dalam chat room
          });
        })
        .catch(error => console.error('Error fetching data:', error));
    }

    //this is temporary function this will be deleted after using
    function getQueryParam(user_id) {
      var match = RegExp('[?&]' + name + '=([^&]*)').exec(window.location.search);
      return match && decodeURIComponent(match[1].replace(/\+/g, ' '));
    }
  })();
});
