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
  console.log('Message received. ', payload);
  alert(payload.notification.title);
});

Notification.requestPermission().then(permission => {
  if (permission === 'granted') {
    console.log('Notification permission granted.');
    getToken(messaging, {
      vapidKey: 'BNb9WZOQnnMKvrKrC5gLNeeWLds2zIa7cazPkx1RN8qB5CToJp7CMAQUt0acaunJxQI175JQeU0JQFSK4NpbVlI'
    }).then(currentToken => {
      if (currentToken) {
        if (window.location.pathname === '/login') {
          document.getElementById('device_token').value = currentToken;
        }
      } else {
        console.log('No registration token available. Request permission to generate one.');
      }
    }).catch(err => {
      console.log('An error occurred while retrieving token. ', err);
    });
  } else {
    console.log('Notification permission not granted.');
  }
}).catch(err => {
  console.log('Error requesting notification permission: ', err);
});
