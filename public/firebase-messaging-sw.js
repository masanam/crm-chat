importScripts('https://www.gstatic.com/firebasejs/8.10.0/firebase-app.js');
importScripts('https://www.gstatic.com/firebasejs/8.10.0/firebase-messaging.js');

// Initialize Firebase app in the service worker by providing the Firebase configuration
firebase.initializeApp({
  apiKey: 'AIzaSyDKk_rtTZuxflUvW-3IHyns6piV6imqgm4',
  authDomain: 'pasima-crm-d1979.firebaseapp.com',
  projectId: 'pasima-crm-d1979',
  storageBucket: 'pasima-crm-d1979.appspot.com',
  messagingSenderId: '669364208033',
  appId: '1:669364208033:web:7276c825080f3089234be0'
});

const messaging = firebase.messaging();

// Customize notification handler here, for example:
messaging.onBackgroundMessage(payload => {
  console.log('Received background message ', payload);
  // Customize notification handling here or show a notification
});
