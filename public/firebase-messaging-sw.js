/*
Give the service worker access to Firebase Messaging.
Note that you can only use Firebase Messaging here, other Firebase libraries are not available in the service worker.
*/
importScripts('https://www.gstatic.com/firebasejs/8.8.0/firebase-app.js');
importScripts('https://www.gstatic.com/firebasejs/8.8.0/firebase-messaging.js');

/*
Initialize the Firebase app in the service worker by passing in the messagingSenderId.
* New configuration for app@pulseservice.com
*/
firebase.initializeApp({
    apiKey: "AIzaSyCtqwcq18Hj1FI90REZQCqgJLvCp28zKoU",
    authDomain: "starter-backend-44a60.firebaseapp.com",
    projectId: "starter-backend-44a60",
    storageBucket: "starter-backend-44a60.appspot.com",
    messagingSenderId: "868736128789",
    appId: "1:868736128789:web:ffe33762ef26f62a9e3b1c",
    measurementId: "G-LSZDMK7P8P"
});

// Retrieve an instance of Firebase Messaging so that it can handle background
// messages.
const messaging = firebase.messaging();

messaging.onMessage(function(payload) {
    console.log('result: ' + payload);
})

