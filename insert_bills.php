<?php
session_start();
include 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $roomnum = $_POST['roomnum'];
    $billAmount = floatval($_POST['billAmount']);
    $totalTenants = isset($_POST['tenants']) ? intval($_POST['tenants']) : 0; // Use 'tenants' instead of 'occupants'
    $tenantIds = isset($_POST['tenantIds']) ? explode(',', $_POST['tenantIds']) : []; // Convert to array

    // Validate inputs
    if (empty($tenantIds) || $billAmount <= 0 || $totalTenants <= 0) {
        $_SESSION['status'] = "Invalid input. Please try again!";
        $_SESSION['status_code'] = "error";
        $_SESSION['status_button'] = "Okay";
        header("Location: add_utilities.php"); 
        exit();
    }

    $billPerTenant = $billAmount / $totalTenants;

    // Prepare SQL statement for inserting bills
    $stmt = $conn->prepare("INSERT INTO bills (tenantid, amount, date, type) VALUES (?, ?, NOW(), 'utilities')");

    foreach ($tenantIds as $tenantId) {
        $stmt->bind_param("id", $tenantId, $billPerTenant);
        $stmt->execute();

        // Update tenant balance
        $updateStmt = $conn->prepare("UPDATE tenants SET balance = balance + ? WHERE id = ?");
        $updateStmt->bind_param("di", $billPerTenant, $tenantId);
        $updateStmt->execute();
        $updateStmt->close();
    }

    $stmt->close();
    $conn->close();

    $_SESSION['status'] = "Bills saved successfully!";
    $_SESSION['status_code'] = "success";
    $_SESSION['status_button'] = "Okay";

    header("Location: Utilities.php");
    exit();
}
?>
