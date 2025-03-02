<?php
session_start();
include '../db.php'; // Ensure this file contains your database connection

// Set timezone to Asia/Manila
date_default_timezone_set('Asia/Manila');

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $wallet_name = htmlspecialchars($_POST['wallet_name']);
    $wallet_number = htmlspecialchars($_POST['wallet_number']);
    $transaction_id = htmlspecialchars($_POST['transaction_id']);
    $payment_method = htmlspecialchars($_POST['payment_method']);
    $amount= htmlspecialchars($_POST['amount']);
    $date_time = date("Y-m-d H:i:s"); // Current date & time
    $user_id = $_POST['user_id'];

    // Prepare SQL statement
    $sql = "INSERT INTO payments (name, amount, number, transaction, method, date_time, user_id) VALUES (?,?, ?, ?, ?, ?,?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sdssssi", $wallet_name, $amount, $wallet_number, $transaction_id, $payment_method, $date_time, $user_id);

    // Execute and check
    if ($stmt->execute()) {
        $_SESSION['status'] = "Payment details submitted successfully!";
        $_SESSION['status_code'] = "success";
    } else {
        $_SESSION['status'] = "Something went wrong. Please try again.";
        $_SESSION['status_code'] = "error";
    }

    $stmt->close();
    $conn->close();

    header("Location: Home.php");
    exit();
}
?>
