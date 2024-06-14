importScripts('https://www.gstatic.com/firebasejs/9.2.0/firebase-app-compat.js');
importScripts('https://www.gstatic.com/firebasejs/9.2.0/firebase-messaging-compat.js');

firebase.initializeApp({
  apiKey: "AIzaSyAQs1TmEH0joc4Sl1isoUVONkXYLmjeIq0",
  authDomain: "hokorin-projek.firebaseapp.com",
  databaseURL: "https://hokorin-projek.firebaseio.com",
  projectId: "hokorin-projek",
  storageBucket: "hokorin-projek.appspot.com",
  messagingSenderId: "625026746787",
  appId: "1:625026746787:web:2454ce6db4f29d55ad7216",
  measurementId: "G-HVQFWQ35VN"
});

const messaging = firebase.messaging();

messaging.onBackgroundMessage(function (payload) {
  console.log('[firebase-messaging-sw.js] Received background message ', payload);
  const notificationTitle = payload.data.title;
  const notificationOptions = {
    body: payload.data.body,
    icon: '/icon-128x128.png'
  };

  self.registration.showNotification(notificationTitle,
    notificationOptions);
});