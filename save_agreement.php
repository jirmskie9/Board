<?php
session_start();
// Include database connection
include 'db.php'; // Make sure 'db.php' correctly initializes $conn

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Debugging: Check if values are received
    error_log("Form submitted. Checking values...");

    // Retrieve and sanitize input
    $user_id = isset($_POST['user_id']) ? $_POST['user_id'] : null;
    $app_id = isset($_POST['app_id']) ? $_POST['app_id'] : null;
    $agreement_content = isset($_POST['agreement_content']) ? $_POST['agreement_content'] : null;

    // Debugging: Log received values
    error_log("Received user_id: " . $user_id);
    error_log("Received app_id: " . $app_id);

    // Check for missing values
    if (empty($user_id) || empty($app_id) || empty($agreement_content)) {
        $_SESSION['status'] = "Missing required fields!";
        $_SESSION['status_code'] = "error";
        header("Location: Occupants.php");
        exit();
    }

    // Set timezone to Asia/Manila
    date_default_timezone_set('Asia/Manila');
    $current_date = date("Y-m-d H:i:s");

    // Start transaction
    mysqli_begin_transaction($conn);

    try {
        // Insert into lease table
        $stmt1 = mysqli_prepare($conn, "INSERT INTO lease (user_id, content, date_started) VALUES (?, ?, ?)");
        mysqli_stmt_bind_param($stmt1, "iss", $user_id, $agreement_content, $current_date);
        if (!mysqli_stmt_execute($stmt1)) {
            throw new Exception("Lease Insert Error: " . mysqli_error($conn));
        }

        // Update applications table
        $stmt2 = mysqli_prepare($conn, "UPDATE applications SET status = 'approved' WHERE app_id = ?");
        mysqli_stmt_bind_param($stmt2, "i", $app_id);
        if (!mysqli_stmt_execute($stmt2)) {
            throw new Exception("Applications Update Error: " . mysqli_error($conn));
        }

        // Commit transaction
        mysqli_commit($conn);

        $_SESSION['status'] = "Agreement saved and application approved!";
        $_SESSION['status_code'] = "success";
    } catch (Exception $e) {
        mysqli_rollback($conn);
        $_SESSION['status'] = $e->getMessage();
        $_SESSION['status_code'] = "error";
    }

    // Close connection
    mysqli_close($conn);

    header("Location: Occupants.php");
    exit();
}
?>
