<?php
include('../db.php');
session_start();
date_default_timezone_set('Asia/Manila');

header('Content-Type: application/json');

if (!isset($_SESSION['Uid'])) {
    echo json_encode(['success' => false, 'message' => 'Session expired. Please log in again.']);
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_SESSION['Uid'];
    $r = isset($_POST['rec']) ? intval($_POST['rec']) : 0;
    $m = isset($_POST['msg']) ? trim($_POST['msg']) : '';
    $t = isset($_POST['types']) ? trim($_POST['types']) : 'Message';
    
    // Get the current time in the correct format
    $currentTime = new DateTime('now', new DateTimeZone('Asia/Manila'));
    $ts = $currentTime->format('Y-m-d H:i:s'); // Use 24-hour format with seconds

    if (empty($m)) {
        echo json_encode(['success' => false, 'message' => 'Message cannot be empty.']);
        exit;
    }

    // Use prepared statement to prevent SQL injection
    $sql = "INSERT INTO chats (sender, receiver, msg, Category, dt) VALUES (?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("iisss", $id, $r, $m, $t, $ts);

    if ($stmt->execute()) {
        // After successful insert, update any future-dated messages to current time
        $updateSql = "UPDATE chats SET dt = ? WHERE dt > ? AND (sender = ? OR receiver = ?)";
        $updateStmt = $conn->prepare($updateSql);
        $updateStmt->bind_param("ssii", $ts, $ts, $id, $id);
        $updateStmt->execute();
        
        echo json_encode(['success' => true, 'message' => 'Message sent successfully.']);
    } else {
        echo json_encode(['success' => false, 'message' => 'Failed to send message.']);
    }
} else {
    echo json_encode(['success' => false, 'message' => 'Invalid request method.']);
}
?> 