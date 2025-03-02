<?php
session_start();
include 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["id"]) && isset($_POST["user_id"])) {
    $payment_id = $_POST["id"];
    $user_id = $_POST["user_id"];

    // Fetch the approved payment details
    $sql = "SELECT * FROM payments WHERE payment_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $payment_id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $payment = $result->fetch_assoc();
        $amount = $payment['amount'];
        $payment_date = date("Y-m-d H:i:s"); // Current date & time
        $based_date = date("Y-m-d"); // Current date only

        // Update payment status to 'approved'
        $update_sql = "UPDATE payments SET status = 'approved' WHERE payment_id = ?";
        $update_stmt = $conn->prepare($update_sql);
        $update_stmt->bind_param("i", $payment_id);

        if ($update_stmt->execute()) {
            // Insert approved payment into paymenthistory
            $insert_sql = "INSERT INTO paymenthistory (tenantid, amount, baseddate, paymentdate) VALUES (?, ?, ?, ?)";
            $insert_stmt = $conn->prepare($insert_sql);
            $insert_stmt->bind_param("idss", $user_id, $amount, $based_date, $payment_date);

            if ($insert_stmt->execute()) {
                echo "success";
            } else {
                echo "error: " . $conn->error;
            }
            $insert_stmt->close();
        } else {
            echo "error: " . $conn->error;
        }
        $update_stmt->close();
    } else {
        echo "error: Payment record not found.";
    }
    $stmt->close();
    $conn->close();
}
?>
