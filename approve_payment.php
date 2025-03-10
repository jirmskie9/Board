<?php
session_start();
include 'db.php';

// Enable error reporting for debugging
error_reporting(E_ALL);
ini_set('display_errors', 1);

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["id"]) && isset($_POST["user_id"])) {
    $payment_id = $_POST["id"];
    $user_id = $_POST["user_id"];

    // Fetch the payment details
    $sql = "SELECT status, amount FROM payments WHERE payment_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $payment_id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $payment = $result->fetch_assoc();

        // Check if status is already 'approved'
        if ($payment['status'] === 'approved') {
            echo "already_approved";
            exit();
        } else {
            $amount = $payment['amount'];
            $payment_date = date("Y-m-d H:i:s");
            $based_date = date("Y-m-d");

            // Start transaction to ensure consistency
            $conn->begin_transaction();

            try {
                // Update payment status to 'approved'
                $update_sql = "UPDATE payments SET status = 'approved' WHERE payment_id = ?";
                $update_stmt = $conn->prepare($update_sql);
                $update_stmt->bind_param("i", $payment_id);
                $update_stmt->execute();

                // Insert approved payment into payment history
                $insert_sql = "INSERT INTO paymenthistory (tenantid, amount, baseddate, paymentdate) VALUES (?, ?, ?, ?)";
                $insert_stmt = $conn->prepare($insert_sql);
                $insert_stmt->bind_param("idss", $user_id, $amount, $based_date, $payment_date);
                $insert_stmt->execute();

                // Update tenant balance (subtract the amount from balance)
                $update_balance_sql = "UPDATE tenants SET balance = balance - ? WHERE id = ?";
                $update_balance_stmt = $conn->prepare($update_balance_sql);
                $update_balance_stmt->bind_param("di", $amount, $user_id);
                $update_balance_stmt->execute();

                // Commit transaction
                $conn->commit();

                // Close statements
                $stmt->close();
                $update_stmt->close();
                $insert_stmt->close();
                $update_balance_stmt->close();
                $conn->close();

                // Return success response to AJAX
                echo "success";
                exit();
            } catch (Exception $e) {
                // Rollback transaction if any error occurs
                $conn->rollback();
                echo "error";
                exit();
            }
        }
    } else {
        echo "not_found";
        exit();
    }
}
?>
