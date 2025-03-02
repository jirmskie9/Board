<?php
session_start();
include('db.php'); 

if (isset($_GET['id'])) {
    $tenantId = intval($_GET['id']);

    $sql = "DELETE FROM tenants WHERE ID = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $tenantId);

    if ($stmt->execute()) {
        $_SESSION['status'] = "Tenant deleted successfully!";
        $_SESSION['status_code'] = "success";
    } else {
        $_SESSION['status'] = "Error deleting tenant!";
        $_SESSION['status_code'] = "error";
    }

    $stmt->close();
    $conn->close();
}

// Redirect back
header("Location: Occupants.php"); 

exit();
?>
