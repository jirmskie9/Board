<?php
session_start();
include 'db.php';

$uid = $_SESSION['Uid']; // Using the correct session variable

// Prepare the SQL query to fetch user details
$sql = "SELECT * FROM user WHERE ID = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $uid);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    // Fetch user details
    $user = $result->fetch_assoc();
    $fullname = $user['Fullname'];
    $user_id = $user['user_id'];
} else {
    echo "No user found.";
    exit;
}
echo $uid;
echo $user_id;

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["id"])) {
    $payment_id = $_POST["id"];

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
            // Use $uid here instead of $user_id
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
