
<script>
    var firebaseConfig = {
        apiKey: "AIzaSyCtqwcq18Hj1FI90REZQCqgJLvCp28zKoU",
        authDomain: "starter-backend-44a60.firebaseapp.com",
        projectId: "starter-backend-44a60",
        storageBucket: "starter-backend-44a60.appspot.com",
        messagingSenderId: "868736128789",
        appId: "1:868736128789:web:ffe33762ef26f62a9e3b1c",
        measurementId: "G-LSZDMK7P8P"
    };
    firebase.initializeApp(firebaseConfig);
    const messaging = firebase.messaging();
    // Get registration token. Initially this makes a network call, once retrieved
    // subsequent calls to getToken will return from cache.
    messaging.getToken({ vapidKey: 'BFi_I5tqWVsq-1eX2sUH0IXG5W9usYogttgGV1kbPoyH7SLh_CJHyLrT-mxOyuyO57q2-cmymvyeT2n0BH1mnwE' }).then((currentToken) => {
    if (currentToken) {
        // Send the token to your server and update the UI if necessary
        // ...
        $.ajax({
                url: "{{ route('save-token') }}",
                method: 'GET',
                data: {
                    token: currentToken
                },
                success: function(data) {
                    console.log('token updated');
                }
        });
        console.log(currentToken);
    } else {
        // Show permission request UI
        console.log('No registration token available. Request permission to generate one.');
        // ...
    }
    }).catch((err) => {
    console.log('An error occurred while retrieving token. ', err);
    // ...
    });

    //EVENT KETIKA MENERIMA NOTIFIKASI
    var stackedToasts = [];
    messaging.onMessage((payload) => {
        console.log('Message received. ', payload);
        const Toast = Swal.mixin({
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 10000,
            timerProgressBar: true,
            didOpen: (toast) => {
                toast.addEventListener('mouseenter', Swal.stopTimer)
                toast.addEventListener('mouseleave', Swal.resumeTimer)
            }
            });

            Swal.queue(stackedToasts);

            Toast.fire({
                icon: 'info',
                html: `
                        <h4>${payload.notification.title}</h4>
                        <p>${payload.notification.body}</p>
                        `
            });
        // ...
    });

    function sendNotitificationFCM(title, body)
    {
        $.ajax({
            url: '{{ route("fcm.send") }}',
            method: 'GET',
            data: {
                "title" : title,
                "body" : body
            },
            beforeSend: function (xhr) {
                //
            },
            success: function (data) {
                console.log(data);
            },
        })
    }
</script>
