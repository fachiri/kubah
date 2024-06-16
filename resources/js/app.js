import './bootstrap';
import 'flowbite';

import {
  initializeApp
} from "https://www.gstatic.com/firebasejs/10.12.2/firebase-app.js";
import {
  getMessaging,
  getToken,
  onMessage
} from "https://www.gstatic.com/firebasejs/10.12.2/firebase-messaging.js";

import Toast from './tailwind-toastify';

const firebaseConfig = {
  apiKey: "AIzaSyAQs1TmEH0joc4Sl1isoUVONkXYLmjeIq0",
  authDomain: "hokorin-projek.firebaseapp.com",
  databaseURL: "https://hokorin-projek.firebaseio.com",
  projectId: "hokorin-projek",
  storageBucket: "hokorin-projek.appspot.com",
  messagingSenderId: "625026746787",
  appId: "1:625026746787:web:2454ce6db4f29d55ad7216",
  measurementId: "G-HVQFWQ35VN"
};

const app = initializeApp(firebaseConfig);
const messaging = getMessaging(app);

onMessage(messaging, (payload) => {
  Toast.notif({
    title: payload.data.title,
    imageSrc: payload.data.image ?? '/icon-128x128.png',
    imageAlt: 'Profile image description',
    name: payload.data.senderName,
    content: payload.data.body,
    timestamp: 'Baru saja',
    timeout: 5000,
  });
});

if (Notification.permission === 'granted') {
  getDeviceToken()
} else {
  Toast.confirm({
    title: 'Izinkan Notifikasi',
    subtitle: 'Izinkan notifikasi muncul di perangkat anda',
    timeout: 5000,
    confirmText: 'Izinkan',
    onConfirm: function () {
      requestNotifPermission()
    }
  });
}

function requestNotifPermission() {
  Notification.requestPermission().then(permission => {
    if (permission === 'granted') {
      getDeviceToken()
    }
  });
}

function getDeviceToken() {
  getToken(messaging, {
    vapidKey: 'BNb9WZOQnnMKvrKrC5gLNeeWLds2zIa7cazPkx1RN8qB5CToJp7CMAQUt0acaunJxQI175JQeU0JQFSK4NpbVlI'
  }).then(currentToken => {
    if (currentToken) {
      sessionStorage.setItem('device_token', currentToken);
    }
  });
}
