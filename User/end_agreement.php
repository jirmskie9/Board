<?php
session_start();
include '../db.php';

// Enable error reporting for debugging
error_reporting(E_ALL);
ini_set('display_errors', 1);

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["user_id"]) && isset($_POST["roomnum"]) && isset($_POST["balance"])) {
    $user_id = $_POST["user_id"];
    $roomnum = $_POST["roomnum"];
    $balance = floatval($_POST["balance"]); // Ensure balance is treated as a number

    // Check if balance is 0 before proceeding
    if ($balance != 0) {
        $_SESSION['status'] = "Lease cannot be ended. Outstanding balance must be paid first!";
        $_SESSION['status_code'] = "error";
        header("Location: Home.php");
        exit();
    }

    // Start a transaction to ensure all queries execute together
    $conn->begin_transaction();

    try {
        // Delete applications where user_id = $user_id
        $delete_applications = $conn->prepare("DELETE FROM applications WHERE user_id = ?");
        $delete_applications->bind_param("i", $user_id);
        $delete_applications->execute();

        // Delete bills where tenantid = $user_id
        $delete_bills = $conn->prepare("DELETE FROM bills WHERE tenantid = ?");
        $delete_bills->bind_param("i", $user_id);
        $delete_bills->execute();

        // Delete user where user_id = $user_id
        $delete_user = $conn->prepare("DELETE FROM user WHERE user_id = ?");
        $delete_user->bind_param("i", $user_id);
        $delete_user->execute();

        // Delete tenants where ID = $user_id
        $delete_tenants = $conn->prepare("DELETE FROM tenants WHERE ID = ?");
        $delete_tenants->bind_param("i", $user_id);
        $delete_tenants->execute();

        // Subtract 1 from tenants count in rooms where Roomnum = $roomnum
        $update_room = $conn->prepare("UPDATE rooms SET tenants = tenants - 1 WHERE Roomnum = ? AND tenants > 0");
        $update_room->bind_param("s", $roomnum);
        $update_room->execute();

        // Commit transaction if all operations succeed
        $conn->commit();

        $_SESSION['status'] = "Lease agreement ended successfully!";
        $_SESSION['status_code'] = "success";
    } catch (Exception $e) {
        // Rollback if any error occurs
        $conn->rollback();

        $_SESSION['status'] = "Error: " . $e->getMessage();
        $_SESSION['status_code'] = "error";
    }

    // Close database connection
    $conn->close();

    // Redirect to dashboard
    header("Location: Home.php");
    exit();
} else {
    $_SESSION['status'] = "Invalid request!";
    $_SESSION['status_code'] = "error";
    header("Location: Home.php");
    exit();
}
?>
