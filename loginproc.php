<?php
session_start();
include('db.php');

if(isset($_POST['uname']) && isset($_POST['upass'])){
    $user = $conn->real_escape_string($_POST['uname']);
    $pass = $conn->real_escape_string($_POST['upass']);

    // Hashing the password (if passwords are stored hashed in the database)
    // $pass = md5($pass); // Uncomment if passwords are hashed with MD5

    $sql = "SELECT * FROM user WHERE username='$user' AND password='$pass'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
    
        $_SESSION['Uid'] = $row['ID'];
    
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