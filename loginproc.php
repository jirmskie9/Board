<?php
session_start();
include('db.php');

date_default_timezone_set("Asia/Manila"); // Set timezone to Asia/Manila

if (isset($_POST['uname']) && isset($_POST['upass'])) {
    $user = $conn->real_escape_string($_POST['uname']);
    $pass = $conn->real_escape_string($_POST['upass']);

    // Hashing the password (if passwords are stored hashed in the database)
    // $pass = md5($pass); // Uncomment if passwords are hashed with MD5

    $sql = "SELECT * FROM user WHERE username='$user' AND password='$pass'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $_SESSION['Uid'] = $row['ID'];

        // Insert login record into logs table
        $user_id = $row['ID'];
        $date_time = date("Y-m-d H:i:s"); // Get current date and time

        // Debugging Step 1: Print the variables
        echo "User ID: $user_id <br>";
        echo "Date Time: $date_time <br>";

        $log_query = "INSERT INTO logs (user_id, date_time) VALUES ('$user_id', '$date_time')";
        
        // Debugging Step 2: Print the SQL query
        echo "Query: $log_query <br>";

        if (!mysqli_query($conn, $log_query)) {
            die("Log insertion failed: " . mysqli_error($conn)); // Debugging Step 3: Show MySQL error
        } else {
            echo "Log inserted successfully! <br>";
        }

        // Redirect based on user type
        if ($row['Usertype'] == "0") {
            header("Location: Dashboard.php");
        } else {
            header("Location: User/Home.php");
        }
        exit();
    } else {
        $_SESSION['error'] = "Invalid username or password!";
        header("Location: login.php");
        exit();
    }
}
?>
