<!-- BEGIN: Vendor JS-->
<script src="{{ asset(mix('assets/vendor/libs/jquery/jquery.js')) }}"></script>
<script src="{{ asset(mix('assets/vendor/libs/popper/popper.js')) }}"></script>
<script src="{{ asset(mix('assets/vendor/js/bootstrap.js')) }}"></script>
<script src="{{ asset(mix('assets/vendor/libs/node-waves/node-waves.js')) }}"></script>
<script src="{{ asset(mix('assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js')) }}"></script>
<script src="{{ asset(mix('assets/vendor/libs/hammer/hammer.js')) }}"></script>
<script src="{{ asset(mix('assets/vendor/libs/typeahead-js/typeahead.js')) }}"></script>
<script src="{{ asset(mix('assets/vendor/js/menu.js')) }}"></script>
<script src="https://unpkg.com/axios/dist/axios.min.js"></script>
<script>
  var appUrl = "{{env('APP_URL')}}";
  console.log(appUrl);
  var waFrom = "{{env('TWILIO_WHATSAPP_FROM')}}";
  console.log(waFrom);
  var user = '@json(auth()->user())';
  console.log('user data:', user);

  // get profile
  const getProfile = async (user) => {
    try {
      // Parse user object (assuming it's a string)
      const trueUser = JSON.parse(user);
      console.log('user.profile_id:', trueUser.profile_id);

      // Build API URL with profile ID
      const response = await axios.get(`${baseUrl}api/is_dealer/${trueUser.profile_id}`)
      console.log('response', response.data)
      const data = response.data
      console.log('data', data)

      return data
    } catch (error) {
      console.error('Error fetching profile:', error);
      return null; // Return null in case of errors
    }
  }

  // Assuming you have the user data in a variable named 'user'
  const profileData = getProfile(user)
  console.log('profileData', profileData.dealer)
</script>
@yield('vendor-script')
<!-- END: Page Vendor JS-->
<!-- BEGIN: Theme JS-->
<script src="{{ asset(mix('assets/js/main.js')) }}"></script>

<script>
  function redirectTo(url) {
    window.location.href = url;
  }
</script>

@if(Auth::check())
<script>
  var subscription = true;
  var quota = true;
  if(window.location.pathname.indexOf('app/chat') != -1){
    if(!quota) {
      $('body').prepend(`
        <div style="width:100%;height:100vh;display:block;position:absolute;background-color:rgba(0,0,0,.5);z-index:999999">
          <p style="background-color:white;color:black;padding:10px;width:1000px;margin:auto auto;text-align:center">Quota anda telah habis, harap segera melakukan topup kembali.</p>
        </div>
      `);
    }
  }
  if(!subscription) {
    $('body').prepend(`
      <div style="width:100%;height:100vh;display:block;position:absolute;background-color:rgba(0,0,0,.5);z-index:999999">
        <p style="background-color:white;color:black;padding:10px;width:1000px;margin:auto auto;text-align:center">Akun anda telah kadalursa, harap segera melakukan pengaktifan kembali.</p>
      </div>
    `);
  }
</script>
@endif

<script>
  var waTo = '';
  $('.chat-contact-list-item').on('click', function () {
      waTo = $(this).data('wa');
      var initials = $(this).data('name').split(" ").map((n)=>n[0]).join("");
      console.log('initials: ' + initials);

      $('.app-chat-history').find('.avatar-initial.bg-label-success').text(initials);
      $('.app-chat-history .chat-contact-info').find('h6').text($(this).data('name'));

      $('.chat-history').empty();
  });

  var getUrlParameter = function getUrlParameter(sParam) {
    var sPageURL = window.location.search.substring(1),
        sURLVariables = sPageURL.split('&'),
        sParameterName,
        i;

    for (i = 0; i < sURLVariables.length; i++) {
        sParameterName = sURLVariables[i].split('=');

        if (sParameterName[0] === sParam) {
            return sParameterName[1] === undefined ? true : decodeURIComponent(sParameterName[1]);
        }
    }
    return false;
  };
  if(getUrlParameter('phone')) {
    $('.chat-contact-list-item[data-wa="'+getUrlParameter('phone')+'"]').addClass('active').trigger('click');
  }
</script>

<script src="https://www.gstatic.com/firebasejs/8.10.0/firebase-app.js"></script>
<script src="https://www.gstatic.com/firebasejs/8.10.0/firebase-messaging.js"></script>
<script src="https://www.gstatic.com/firebasejs/8.10.0/firebase-database.js"></script>
<script>
  // Konfigurasi Firebase Anda
  var firebaseConfig = {
    apiKey: '{{ env("FIREBASE_API_KEY") }}',
    authDomain: '{{ env("FIREBASE_AUTH_DOMAIN") }}',
    databaseURL: '{{ env("FIREBASE_DB_URL") }}',
    projectId: '{{ env("FIREBASE_PROJECT_ID") }}',
    storageBucket: '{{ env("FIREBASE_STORAGE_BUCKET") }}',
    messagingSenderId: '{{ env("FIREBASE_MESSAGING_SENDER_ID") }}',
    appId: '{{ env("FIREBASE_APP_ID") }}',
  };

  // Inisialisasi Firebase
  firebase.initializeApp(firebaseConfig);
  const messaging = firebase.messaging();

  // Meminta izin untuk menerima notifikasi
  messaging.requestPermission()
    .then(function () {
      console.log("Permission granted!");
      return messaging.getToken();
    })
    .then(function (token) {
      console.log("FCM Token:", token);
      // Kirim token ke server Anda untuk disimpan jika perlu
      $.ajax({
        url: appUrl + '/api/fcm-token',
        type: 'POST',
        data: {
          user_id: user.id,
          token: token
        },
        success: function(res) {
          console.log(res);
        },
        error: function(res) {
          console.log('error:' + res);
        }
      });
    })
    .catch(function (err) {
      console.log("Permission denied:", err);
    });

  // messaging.requestPermission().then(function() {
  // //console.log('Notification permission granted.');

  //   if(isTokenSentToServer()){

  //       // console.log("Token Already sent");
  //     }else{
  //         getRegisterToken();
  //   }

  //   // TODO(developer): Retrieve an Instance ID token for use with FCM.
  //   // ...
  // }).catch(function(err) {
  //   console.log('Unable to get permission to notify.', err);
  // });

  // function getRegisterToken(){
  //   // Get Instance ID token. Initially this makes a network call, once retrieved
  //   // subsequent calls to getToken will return from cache.
  //   messaging.getToken().then(function(currentToken) {
  //     if (currentToken) {
  //         saveToken(currentToken);
  //         console.log(currentToken);
  //       sendTokenToServer(currentToken);
  //     // updateUIForPushEnabled(currentToken);
  //     } else {
  //       // Show permission request.
  //       console.log('No Instance ID token available. Request permission to generate one.');
  //       // Show permission UI.
  //     // updateUIForPushPermissionRequired();
  //       setTokenSentToServer(false);
  //     }
  //   }).catch(function(err) {
  //     console.log('An error occurred while retrieving token. ', err);
  //     //showToken('Error retrieving Instance ID token. ', err);
  //     setTokenSentToServer(false);
  //   });
  // }

  // function setTokenSentToServer(sent) {
  //   window.localStorage.setItem('sentToServer', sent ? '1' : '0');
  // }

  // function sendTokenToServer(currentToken) {
  //   if (!isTokenSentToServer()) {
  //     console.log('Sending token to server...');
  //     // TODO(developer): Send the current token to your server.
  //     setTokenSentToServer(true);
  //   } else {
  //     console.log('Token already sent to server so won\'t send it again ' +
  //         'unless it changes');
  //   }
  // }
  // function isTokenSentToServer() {
  //   return window.localStorage.getItem('sentToServer') === '1';
  // }

  // function saveToken(currentToken){

  //      jQuery.ajax({
  //        data: {"token":currentToken},
  //        type: "post",
  //        url: "savefcmtoken.php",
  //        success: function(result){
  //            console.log(result);
  //        }

  //   });
  // }

  // Mendengarkan pesan yang diterima
  messaging.onMessage(function (payload) {
    console.log("Message received:", payload);
    // Menampilkan notifikasi di browser
    const { title, body } = payload.notification;
    new Notification(title, { body });
  });

  // Mengatur perilaku notifikasi ketika tab tidak dalam fokus
  document.addEventListener("visibilitychange", function () {
    if (document.visibilityState === 'hidden') {
      // Lakukan sesuatu ketika tab tidak dalam fokus
      // Contohnya, tampilkan notifikasi atau lakukan tindakan lain
      messaging.onMessage(function (payload) {
        const { title, body } = payload.notification;
        new Notification(title, { body });
      });
    }
  });

  // Mendapatkan referensi ke Firebase Realtime Database
  var database = firebase.database();
  var ref = database.ref('/');

  function getCurrentTime() {
      const now = new Date();
      const hours = now.getHours().toString().padStart(2, '0');
      const minutes = now.getMinutes().toString().padStart(2, '0');
      return `${hours}:${minutes}`;
    }

  console.log('realtime');

  // Mendengarkan perubahan data secara realtime

  ref.limitToLast(1).on('value', function(snapshot) {
    var data = snapshot.val();
    console.log('Data terakhir data:', data);

    $.each(data, function(i,v) {
    let newMessage = document.createElement('li');
    newMessage.className = 'chat-message';
    newMessage.innerHTML = `
      <div class="d-flex overflow-hidden">
          <div class="user-avatar flex-shrink-0 ">
                <div class="avatar"><span class="avatar-initial rounded-circle bg-label-primary">D</span></div>
            </div>
          <div class="chat-message-wrapper flex-grow-1">
              <div class="chat-message-text">
                  <p class="mb-0">`+JSON.parse(v).message+`</p>
              </div>
              <div class="text-end text-muted mt-1">
                  <i class='ti ti-checks ti-xs me-1 text-muted'></i>
                  <small>${getCurrentTime()}</small>
              </div>
          </div>
      </div>
    `;

    // Append the new message to the .chat-history
    document.querySelector('.chat-history').appendChild(newMessage);
    });
  });

  // ref.limitToLast(1).on('value')
  // .then(function(snapshot) {
  //   snapshot.forEach(function(childSnapshot) {
  //     var lastData = childSnapshot.val();
  //     console.log('Data terakhir:', lastData);

  //     let newMessage = document.createElement('li');
  //     newMessage.className = 'chat-message';
  //     newMessage.innerHTML = `
  //       <div class="d-flex overflow-hidden">
  //           <div class="user-avatar flex-shrink-0 ">
  //                 <div class="avatar"><span class="avatar-initial rounded-circle bg-label-primary">D</span></div>
  //             </div>
  //           <div class="chat-message-wrapper flex-grow-1">
  //               <div class="chat-message-text">
  //                   <p class="mb-0">`+lastData.message+`</p>
  //               </div>
  //               <div class="text-end text-muted mt-1">
  //                   <i class='ti ti-checks ti-xs me-1 text-muted'></i>
  //                   <small>${getCurrentTime()}</small>
  //               </div>
  //           </div>
  //       </div>
  //     `;

  //     // Append the new message to the .chat-history
  //     document.querySelector('.chat-history').appendChild(newMessage);
  //   });
  // })
  // .catch(function(error) {
  //   console.error('Gagal mendapatkan data:', error);
  // });

  ref.on('value', function(snapshot) {
    var data = snapshot.val();
    console.log(data);
  //   // Lakukan sesuatu dengan data yang diperbarui
  //   console.log('realtime'); // Misalnya, tampilkan data ke console
  //   console.log(data); // Misalnya, tampilkan data ke console

  //   // Tampilkan data ke dalam elemen HTML dengan ID "data-container"
  //   // document.getElementById('data-container').innerText = JSON.stringify(data);

  //   // // $('.chat-hostory').append();
  //   // $.each(data, function(i,v) {
  //   //   console.log(v);
  //   //   let newMessage = document.createElement('li');
  //   //   newMessage.className = 'chat-message';
  //   //   newMessage.innerHTML = `
  //   //     <div class="d-flex overflow-hidden">
  //   //         <div class="user-avatar flex-shrink-0 ">
  //   //               <div class="avatar"><span class="avatar-initial rounded-circle bg-label-primary">D</span></div>
  //   //           </div>
  //   //         <div class="chat-message-wrapper flex-grow-1">
  //   //             <div class="chat-message-text">
  //   //                 <p class="mb-0">`+v.message+`</p>
  //   //             </div>
  //   //             <div class="text-end text-muted mt-1">
  //   //                 <i class='ti ti-checks ti-xs me-1 text-muted'></i>
  //   //                 <small>${getCurrentTime()}</small>
  //   //             </div>
  //   //         </div>
  //   //     </div>
  //   //   `;

  //   //   // Append the new message to the .chat-history
  //   //   document.querySelector('.chat-history').appendChild(newMessage);
  //   // });
  });

</script>

<script>
  // let socket = new WebSocket('ws://api-crm.pasima.co:8899'); // Ganti dengan alamat WebSocket Anda
  const socket_url = '{{ env("WEB_SOCKET") }}'
  console.log('socket_url', socket_url)

  let socket = new WebSocket('{{env("WEB_SOCKET")}}');
  console.log('socket', socket)

  socket.onopen = function(event) {
      console.log('WebSocket connected');

      var user_id = '123'; // Ganti dengan ID pengguna yang sesuai
      socket.send(user_id);
  };

  socket.onmessage = function(event) {
      let receivedData = event.data;
      console.log('Received data:', receivedData);
      // Lakukan sesuatu dengan data yang diterima

      var currentVal = $('.badge-notifications').text();
      $('.badge-notifications').text(parseInt(currentVal) + 1);

      $('.dropdown-notifications-list > .list-group').prepend(`
        <li class="list-group-item list-group-item-action dropdown-notifications-item">
            <div class="d-flex">
                <div class="flex-shrink-0 me-3">
                    <div class="avatar">
                        <img src="${'baseUrl'}assets/img/avatars/1.png" alt="" class="h-auto rounded-circle">
                    </div>
                </div>
                <div class="flex-grow-1">
                    <h6 class="mb-1">`+receivedData.from+`</h6>
                    <p class="mb-0">`+receivedData.body+`</p>
                    <small class="text-muted">1h ago</small>
                </div>
                <div class="flex-shrink-0 dropdown-notifications-actions">
                    <a href="javascript:void(0)" class="dropdown-notifications-read"><span class="badge badge-dot"></span></a>
                    <a href="javascript:void(0)" class="dropdown-notifications-archive"><span class="ti ti-x"></span></a>
                </div>
            </div>
        </li>
      `);
  };

  socket.onerror = function(error) {
      console.error('WebSocket error:', error);
  };

  socket.onclose = function(event) {
      console.log('WebSocket closed');
  };
</script>

<script>
  // function sendMessage(message) {
  //   socket.send(message);
  // }
  setTimeout(function() {
    var pesan = {
      to: 'id_penerima', // Ganti dengan ID penerima
      content: 'Pesan Anda'
    };

    socket.send(JSON.stringify(pesan));

    console.log('send web socket');
  }, 30000);
</script>

<!-- END: Theme JS-->
<!-- Pricing Modal JS-->
@stack('pricing-script')
<!-- END: Pricing Modal JS-->
<!-- BEGIN: Page JS-->
@yield('page-script')
<!-- END: Page JS-->
