<!-- <script>
   function doPoll() {
    // Get the JSON
    $.ajax({ url: 'asd.json', success: function(data){
        if(data.notify) {
            // Yeah, there is a new notification! Show it to the user
            var notification = new Notification(data.title, {
                 icon:'https://lh3.googleusercontent.com/-aCFiK4baXX4/VjmGJojsQ_I/AAAAAAAANJg/h-sLVX1M5zA/s48-Ic42/eggsmall.png',
                 body: data.desc,
             });
             notification.onclick = function () {
                 window.open(data.url);      
             };
        }
        // Retry after a second
        setTimeout(doPoll,1000);
    }, dataType: "json"});
}
if (Notification.permission !== "granted")
{
    // Request permission to send browser notifications
    Notification.requestPermission().then(function(result) {
        if (result === 'default') {
            // Permission granted
            doPoll();
        }
    });
} else {
    doPoll();
}
</script> -->
 <?php
// JSON object, typically this would come from your PHP backend or an API
$notificationData = json_encode([
    "notify" => true,
    "title" => "Hey there!",
    "desc" => "This is a new message for you",
    "url" => "localhost/capricorn/Occupants.php",
    "icon" => "./logo/logo.png" // URL of the icon/logo
]);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PHP Notification Example</title>
</head>
<body>

<script>
//    if ("Notification" in window) {
//     alert("Notifications are supported!");
// } else {
//     alert("Notifications are not supported on this device.");
// }
// Parse the PHP data into JavaScript
var notificationData = <?php echo $notificationData; ?>;

// Check if notifications are allowed by the user
if (notificationData.notify && "Notification" in window) {
    // Ask the user for permission if it hasn’t been granted
    if (Notification.permission === "granted") {
        showNotification(notificationData);
    } else if (Notification.permission !== "denied") {
        Notification.requestPermission().then(permission => {
            if (permission === "granted") {
                showNotification(notificationData);
            }
        });
    }
}

// Function to display the notification
function showNotification(data) {
    var notification = new Notification(data.title, {
        body: data.desc,
        icon: data.icon // Use the icon URL from the JSON data
    });

    // Handle click event to open the URL
    notification.onclick = function() {
        window.open(data.url);
    };
}
</script>

</body>
</html>

