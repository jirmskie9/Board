
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title></title>
    <script type="text/javascript" src="web-notification.js"></script>
</head>
<body>
</body>
<script type="text/javascript">
    document.querySelector('.some-button').addEventListener('click', function onClick() {
    webNotification.showNotification('Example Notification', {
        body: 'Notification Text...',
        icon: 'my-icon.ico',
        onClick: function onNotificationClicked() {
            console.log('Notification clicked.');
        },
        autoClose: 4000 //auto close the notification after 4 seconds (you can manually close it via hide function)
    }, function onShow(error, hide) {
        if (error) {
            window.alert('Unable to show notification: ' + error.message);
        } else {
            console.log('Notification Shown.');

            setTimeout(function hideNotification() {
                console.log('Hiding notification....');
                hide(); //manually close the notification (you can skip this if you use the autoClose option)
            }, 5000);
        }
    });
});
    navigator.serviceWorker.register('service-worker.js').then(function(registration) {
    document.querySelector('.some-button').addEventListener('click', function onClick() {
        webNotification.showNotification('Example Notification', {
            serviceWorkerRegistration: registration,
            body: 'Notification Text...',
            icon: 'my-icon.ico',
            actions: [
                {
                    action: 'Start',
                    title: 'Start'
                },
                {
                    action: 'Stop',
                    title: 'Stop'
                }
            ],
            autoClose: 4000 //auto close the notification after 4 seconds (you can manually close it via hide function)
        }, function onShow(error, hide) {
            if (error) {
                window.alert('Unable to show notification: ' + error.message);
            } else {
                console.log('Notification Shown.');

                setTimeout(function hideNotification() {
                    console.log('Hiding notification....');
                    hide(); //manually close the notification (you can skip this if you use the autoClose option)
                }, 5000);
            }
        });
    });
});
    //manually ask for notification permissions (invoked automatically if needed and allowRequest=true)
webNotification.requestPermission(function onRequest(granted) {
    if (granted) {
        console.log('Permission Granted.');
    } else {
        console.log('Permission Not Granted.');
    }
});
</script>
</html>