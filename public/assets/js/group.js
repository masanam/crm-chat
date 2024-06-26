'use strict';

document.addEventListener('DOMContentLoaded', function () {
    (async function () {
        await fetchChatData();
    
        // Panggil fungsi fetchChatData setiap 7 detik
        setInterval(fetchChatData, 1500);
        const getContentGroup = document.querySelector('#chat-contact-group')
        const getContactChatOneOnOne = document.querySelector('#chat-contact-one')
        const getChatHistory = document.querySelector('.app-chat-history')
        const getSidebarRightGroup = document.querySelector('.sidebar-group')
        const getSidebarRightOne = document.querySelector('.sidebar-one-on-one')
        const chatContactsBody = document.querySelector('.app-chat-contacts .sidebar-body')
        
        const timeFormat = {
          hour: 'numeric',
          minute: 'numeric'
        };

        // Chat contact scrollbar
        if (chatContactsBody) {
            new PerfectScrollbar(chatContactsBody, {
              wheelPropagation: false,
              suppressScrollX: true
            });
        }

        const renderScrollbarChatHistoryBody = () => {
            const chatHistoryBody = document.querySelector('.chat-history-body')
            if (chatHistoryBody) {
                new PerfectScrollbar(chatHistoryBody, {
                  wheelPropagation: false,
                  suppressScrollX: true
                });
            }
        }

        // Flow Chat Contact
        // ---------------------------------------------------------------------
        const renderHeaderChatHistory = ({
            isOneOnOneChat = false,
            title,
            memberCount
        }) => {
            const renderTitle = `
                <div class="d-flex justify-content-between align-items-center">
                    <div class="d-flex overflow-hidden align-items-center">
                        <h6 class="m-0 text-dark fw-bold">${title}</h6>
                    </div>
                    <div class="d-flex align-items-center gap-3">
                        <button class="btn p-0" type="button" id="chat-header-actions-info">
                            <img src="assets/svg/icons/info.svg" alt="info" width="20">
                        </button>
                    </div>
                </div>
            `
            if (isOneOnOneChat) {
                return `
                <header class="chat-history-header border-bottom bg-white">
                    ${renderTitle}
                </header>
                `
            } else {
                return `
                <header>
                    <div class="chat-history-header border-bottom bg-white">
                        ${renderTitle}
                    </div>
                    <div class="d-flex align-items-center gap-2 py-1 chat-history-header-tag px-2 py-2">
                        <div class="d-flex align-items-center badge badge-sm rounded-pill badge-user text-dark gap-1">
                            <small class="text-center">${memberCount}+ Members</small>
                        </div>
                    </div>
                </header>
                `
            }
        }

        const renderContentChatHistory = ({
            isOneOnOneChat = false,
            title,
            memberCount
        }) => {
            const renderHeaderChat = renderHeaderChatHistory({ isOneOnOneChat, title, memberCount })
            
            return `
            <div class="chat-history-wrapper">
                ${renderHeaderChat}

                <div class="chat-history-body bg-white">
                    <ul class="list-unstyled chat-history">
                    </ul>
                </div>
                <!-- Chat message form -->
                <div class="chat-history-footer">
                    <form class="form-send-message d-flex flex-column justify-content-between h-100" method="POST" ">
                        <input class="form-control message-input border-0 me-3 shadow-none bg-transparent"
                            placeholder="Write message">
                        <div class="message-actions d-flex align-items-center justify-content-between ps-2 pe-3">
                            <div class="d-flex align-items-center">
                                <label for="attach-doc" class="form-label mb-0">
                                    <img src="assets/svg/icons/note_alt.svg" alt="info" width="24">
                                    <input type="file" id="attach-doc" hidden>
                                </label>
                            </div>
                            <button class="message-btn d-flex send-msg-btn rounded-circle" type="submit">
                                <img src="assets/svg/icons/send.svg" alt="info" width="24">
                            </button>
                        </div>
                    </form>
                </div>
            </div>
            `
        }

        // default render chat history
        if (getContentGroup && getContentGroup.children.length > 0) {
            const getFirstElement = getContentGroup.children[0]
            const getTitle = getFirstElement.querySelector('#chat-group-title')
            const getMember = getFirstElement.querySelector('#chat-group-member')
            const resultContent = renderContentChatHistory({
                title: getTitle.textContent,
                memberCount: getMember.textContent.split(' ')[0] ?? 0
            })
            getChatHistory.innerHTML = resultContent
            getSidebarRightOne.style.display = 'none'
            renderScrollbarChatHistoryBody()
        } else if (getContactChatOneOnOne && getContactChatOneOnOne.children.length > 0) {
            const getFirstElement = getContactChatOneOnOne.children[0]
            const getTitle = getFirstElement.querySelector('#chat-title')
            const resultContent = renderContentChatHistory({
                title: getTitle.textContent,
                isOneOnOneChat: true
            })
            getChatHistory.innerHTML = resultContent
            getSidebarRightGroup.style.display = 'none'
            renderScrollbarChatHistoryBody()
        } else {
            const createEl = document.createElement('div')
            createEl.className = 'd-flex align-items-center justify-content-center h-100'
            createEl.innerHTML = 'NO DATA'
            getChatHistory.appendChild(createEl)
        }
          
        if (getContactChatOneOnOne && getContactChatOneOnOne.children.length > 0) {
            for (let i = 0; i < getContactChatOneOnOne.children.length; i++) {
                const currentEl = getContactChatOneOnOne.children[i]
                currentEl.addEventListener('click', () => {
                    const getTitle = currentEl.querySelector('#chat-title')
                    const resultContent = renderContentChatHistory({
                        isOneOnOneChat: true,
                        title: getTitle.textContent
                    })
                    getChatHistory.innerHTML = resultContent
                    getSidebarRightGroup.style.display = 'none'
                    getSidebarRightOne.style.display = 'block'
                    renderScrollbarChatHistoryBody()
                })
            }
        }

        if (getContentGroup && getContentGroup.children.length > 0) {
            for (let i = 0; i < getContentGroup.children.length; i++) {
                const currentEl = getContentGroup.children[i]
                currentEl.addEventListener('click', () => {
                    const getTitle = currentEl.querySelector('#chat-group-title')
                    const getMember = currentEl.querySelector('#chat-group-member')
                    const resultContent = renderContentChatHistory({
                        title: getTitle.textContent,
                        memberCount: getMember.textContent.split(' ')[0] ?? 0
                    })
                    getChatHistory.innerHTML = resultContent
                    getSidebarRightOne.style.display = 'none'
                    getSidebarRightGroup.style.display = 'block'
                    renderScrollbarChatHistoryBody()
                })
            }
        }
        // End Flow Chat Contact
        // ---------------------------------------------------------------------
        
        // Flow Chat History
        // ---------------------------------------------------------------------
        
        function formatDate(dateString, timeOptions) {
            var options = timeOptions;
            var formattedTime = new Intl.DateTimeFormat('en-US', options).format(new Date(dateString));
            return formattedTime;
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
            const endpoint = 'https://crm.pasima.co/api/get-chats/+6281217071702';
      
            // Lakukan request ke endpoint
            fetch(endpoint)
              .then(response => response.json())
              .then(data => {
                document.querySelector('.chat-history').innerHTML = '';
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
                  if (message.from === '+14155238886') {
                    newMessage.className = 'chat-message chat-message-right';
                    newMessage.innerHTML = `
                  <div class="d-flex align-items-end overflow-hidden">
                      <div class="chat-message-wrapper flex-grow-1 w-50">
                          <div class="chat-message-text">
                              <p class="mb-0">${message.message}</p>
                          </div>
                          <div class="text-end text-muted mt-1">
                            <small>${formatDate(message.created_at, timeFormat)}</small>
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
                              <small>${formatDate(message.created_at, timeFormat)}</small>
                          </div>
                      </div>
                  </div>
                `;
                  }
      
                  // Tambahkan pesan ke dalam chat room
                  document.querySelector('.chat-history').append(newMessage);
                });
              })
              .catch(error => console.error('Error fetching data:', error));
          }
        // End Flow Chat History
        // ---------------------------------------------------------------------
    })();
})