<?php
include 'db.php'; // Ensure this file contains a valid $conn connection

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['user_id'])) {
    $user_id = intval($_POST['user_id']);
    $default_password = "1234"; 

    $query = "UPDATE user SET Password = '$default_password' WHERE ID = $user_id";
    
    if (mysqli_query($conn, $query)) {
        // Store success message in session and redirect
        session_start();
        $_SESSION['message'] = "Password has been reset to 1234.";
        $_SESSION['message_type'] = "success";
        header("Location: user.php");
        exit(); // Ensure script stops here
    } else {
        session_start();
        $_SESSION['message'] = "Failed to reset password.";
        $_SESSION['message_type'] = "error";
        header("Location: user.php");
        exit();
    }
}
?>
