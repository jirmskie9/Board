<?php
session_start();
require_once "../db.php"; // Ensure this connects to your database

$data = json_decode(file_get_contents("php://input"), true);

if (isset($data['image']) && isset($data['user_id'])) {
    $user_id = intval($data['user_id']);
    $imageData = $data['image'];

    // Decode the base64 image
    $imageData = str_replace("data:image/png;base64,", "", $imageData);
    $imageData = base64_decode($imageData);

    // Generate unique filename
    $signatureFile = "signature_" . $user_id . "_" . time() . ".png";
    $filePath = "../uploads/" . $signatureFile; // Ensure correct path

    // Save the file
    if (file_put_contents($filePath, $imageData)) {
        // Update the database
        $sql = "UPDATE lease SET signature = ? WHERE user_id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("si", $signatureFile, $user_id);

        if ($stmt->execute()) {
            $_SESSION['status'] = "Signature saved successfully!";
            $_SESSION['status_code'] = "success";
            $_SESSION['status_button'] = "Okay";
        } else {
            $_SESSION['status'] = "Database update failed!";
            $_SESSION['status_code'] = "error";
            $_SESSION['status_button'] = "Try Again";
        }

        $stmt->close();
    } else {
        $_SESSION['status'] = "File saving failed!";
        $_SESSION['status_code'] = "error";
        $_SESSION['status_button'] = "Try Again";
    }
} else {
    $_SESSION['status'] = "Invalid request!";
    $_SESSION['status_code'] = "warning";
    $_SESSION['status_button'] = "Okay";
}

// Redirect back
header("Location: ../lease_page.php"); // Change to your actual page
exit();
?>
