<?php
session_start();
include('../db.php'); // Ensure database connection

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $user_id = $_POST['user_id'];
    $field_name = $_POST['field_name'];

    // Check if both valid_id and proof already have data
    $checkQuery = "SELECT valid_id, proof FROM applications WHERE user_id = ?";
    $stmt = $conn->prepare($checkQuery);
    $stmt->bind_param("i", $user_id);
    $stmt->execute();
    $stmt->store_result();
    $stmt->bind_result($valid_id, $proof);
    $stmt->fetch();

    if (!empty($valid_id) && !empty($proof)) {
        $_SESSION['status'] = "Both files are already uploaded. No further uploads allowed.";
        $_SESSION['status_code'] = "warning";
    } else {
        // Move uploads folder outside current directory
        $targetDir = "../uploads/"; // Now located outside the script directory
        if (!is_dir($targetDir)) {
            mkdir($targetDir, 0777, true); // Create directory if it doesn't exist
        }

        // Generate a unique filename
        $fileName = time() . "_" . basename($_FILES["file_upload"]["name"]);
        $targetFilePath = $targetDir . $fileName;
        $fileType = strtolower(pathinfo($targetFilePath, PATHINFO_EXTENSION));

        // Allowed file types
        $allowedTypes = array("jpg", "png", "pdf", "jpeg");

        if (in_array($fileType, $allowedTypes)) {
            if (move_uploaded_file($_FILES["file_upload"]["tmp_name"], $targetFilePath)) {
                // Prevent updating if the field is already filled
                if (($field_name == "valid_id" && !empty($valid_id)) || ($field_name == "proof" && !empty($proof))) {
                    $_SESSION['status'] = ucfirst(str_replace("_", " ", $field_name)) . " is already uploaded.";
                    $_SESSION['status_code'] = "warning";
                } else {
                    // Use prepared statements to prevent SQL injection
                    $updateQuery = "UPDATE applications SET $field_name = ? WHERE user_id = ?";
                    $updateStmt = $conn->prepare($updateQuery);
                    $updateStmt->bind_param("si", $fileName, $user_id);

                    if ($updateStmt->execute()) {
                        $_SESSION['status'] = "Document uploaded successfully!";
                        $_SESSION['status_code'] = "success";
                    } else {
                        $_SESSION['status'] = "Database update failed!";
                        $_SESSION['status_code'] = "error";
                    }
                    $updateStmt->close(); // Close the update statement
                }
            } else {
                $_SESSION['status'] = "Error uploading file!";
                $_SESSION['status_code'] = "error";
            }
        } else {
            $_SESSION['status'] = "Invalid file format! Allowed: JPG, PNG, PDF";
            $_SESSION['status_code'] = "warning";
        }
    }

    $stmt->close(); // Close the initial statement
}

$conn->close();
header("Location: home.php");
exit();
?>
