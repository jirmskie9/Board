<?php
session_start();
include 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $roomnum = $_POST['roomnum'];
    $billAmount = floatval($_POST['billAmount']);
    $totalOccupants = $_POST['occupants'];
    $tenantIds = explode(',', $_POST['tenantIds']); // Convert to array

    // Ensure at least one tenant is selected
    if (empty($tenantIds) || $billAmount <= 0) {
        $_SESSION['status'] = "Invalid input. Please try again!";
        $_SESSION['status_code'] = "error";
        $_SESSION['status_button'] = "Okay";
        header("Location: add_utilities.php"); // Adjust the redirect page as needed
        exit();
    }

    $billPerOccupant = $billAmount / $totalOccupants;

    // Prepare SQL statement
    $stmt = $conn->prepare("INSERT INTO bills (tenantid, amount, date, type) VALUES (?, ?, NOW(), 'utilities')");

    foreach ($tenantIds as $tenantId) {
        $stmt->bind_param("id", $tenantId, $billPerOccupant);
        $stmt->execute();
    }

    // Close statement & connection
    $stmt->close();
    $conn->close();

    // Set success message
    $_SESSION['status'] = "Bills saved successfully!";
    $_SESSION['status_code'] = "success";
    $_SESSION['status_button'] = "Okay";

    header("Location: Utilities.php"); // Adjust to your actual page
    exit();
}
?>
