<?php
include('../db.php');
session_start();
date_default_timezone_set('Asia/Manila');

// Ensure user is logged in
if (!isset($_SESSION['Uid'])) {
    die(json_encode(['success' => false, 'message' => 'User not logged in']));
}

$currentUserId = $_SESSION['Uid'];

// Handle different API actions
$action = $_GET['action'] ?? '';

switch ($action) {
    case 'get':
        // Get messages for a specific chat
        $receiver = $_GET['receiver'] ?? 0;
        
        // Prepare SQL query based on chat type
        if ($receiver == 0) {
            // Group chat - get all messages where receiver is 0 (group messages)
            $sql = "SELECT c.*, u.Fullname as senderName, u.imgs as senderImg 
                    FROM chats c 
                    JOIN user u ON c.sender = u.ID 
                    WHERE c.receiver = 0 
                    ORDER BY c.dt ASC";
            $stmt = $conn->prepare($sql);
            $stmt->execute();
            $result = $stmt->get_result();
        } else {
            // Private chat - get messages between two users
            $sql = "SELECT c.*, u.Fullname as senderName, u.imgs as senderImg 
                    FROM chats c 
                    JOIN user u ON c.sender = u.ID 
                    WHERE (c.sender = ? AND c.receiver = ?) 
                    OR (c.sender = ? AND c.receiver = ?) 
                    ORDER BY c.dt ASC";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("iiii", $currentUserId, $receiver, $receiver, $currentUserId);
            $stmt->execute();
            $result = $stmt->get_result();
        }

        // Add error logging
        if (!$result) {
            error_log("Database error: " . $conn->error);
            echo json_encode(['success' => false, 'message' => 'Database error occurred']);
            exit;
        }

        $messages = [];
        while ($row = $result->fetch_assoc()) {
            // Format date and time
            $dt = new DateTime($row['dt']);
            $messages[] = [
                'id' => $row['id'],
                'sender' => $row['sender'],
                'receiver' => $row['receiver'],
                'message' => $row['msg'],
                'type' => $row['Category'],
                'time' => $dt->format('g:i A'),
                'senderName' => $row['senderName'],
                'senderImg' => $row['senderImg']
            ];
        }

        // Add debug logging
        error_log("Messages retrieved: " . count($messages));
        echo json_encode(['success' => true, 'messages' => $messages]);
        break;

    case 'send':
        // Send a new message
        $data = json_decode(file_get_contents('php://input'), true);
        
        if (!isset($data['receiver']) || !isset($data['message']) || !isset($data['type'])) {
            echo json_encode(['success' => false, 'message' => 'Missing required fields']);
            exit;
        }

        $receiver = $data['receiver'];
        $message = $data['message'];
        $type = $data['type'];
        $timestamp = date('Y-m-d H:i:s');

        // Insert message into database
        $sql = "INSERT INTO chats (sender, receiver, msg, Category, dt) VALUES (?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("iisss", $currentUserId, $receiver, $message, $type, $timestamp);

        if ($stmt->execute()) {
            echo json_encode(['success' => true, 'message' => 'Message sent successfully']);
        } else {
            error_log("Failed to send message: " . $conn->error);
            echo json_encode(['success' => false, 'message' => 'Failed to send message']);
        }
        break;

    case 'users':
        // Get all users
        $stmt = $conn->prepare("SELECT ID, Fullname, imgs FROM user");
        $stmt->execute();
        $result = $stmt->get_result();
        
        $users = [];
        while ($row = $result->fetch_assoc()) {
            $users[] = $row;
        }
        
        echo json_encode([
            'success' => true,
            'users' => $users
        ]);
        break;
        
    default:
        echo json_encode(['success' => false, 'message' => 'Invalid action']);
}
