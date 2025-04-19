<?php
include('../db.php');
session_start();
date_default_timezone_set('Asia/Manila');

if (!isset($_SESSION['Uid'])) {
    die("Session 'Uid' is not set.");
}

$id = $_SESSION['Uid'];
$ucids = $_SESSION['ucid'] ?? 0;

// Fetch messages
if ($ucids == 0) {
    // Group chat - get all messages where receiver is 0
    $sql = "SELECT c.*, u.Fullname as sender_name, u.imgs as sender_img 
            FROM chats c 
            JOIN user u ON c.sender = u.ID 
            WHERE c.receiver = 0 
            ORDER BY c.dt ASC";
    $stmt = $conn->prepare($sql);
} else {
    // Private chat - get messages between two users
    $sql = "SELECT c.*, u.Fullname as sender_name, u.imgs as sender_img 
            FROM chats c 
            JOIN user u ON c.sender = u.ID 
            WHERE (c.sender = ? AND c.receiver = ?) 
            OR (c.sender = ? AND c.receiver = ?) 
            ORDER BY c.dt ASC";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("iiii", $id, $ucids, $ucids, $id);
}

$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $currentDate = '';
    while ($row = $result->fetch_assoc()) {
        $messageDate = date('F d, Y', strtotime($row['dt']));
        $messageTime = date('h:i A', strtotime($row['dt']));
        $isSent = $row['sender'] == $id;
        
        // Display date header if it's a new day
        if ($currentDate != $messageDate) {
            $currentDate = $messageDate;
            $displayDate = ($messageDate == date('F d, Y')) ? 'Today' : $messageDate;
            echo "<div class='date-header'>$displayDate</div>";
        }
        
        // Message container
        echo "<div class='message-container " . ($isSent ? 'sent' : 'received') . "'>";
        
        // Avatar and sender name for received messages
        if (!$isSent) {
            echo "<div class='message-avatar'>";
            echo "<img src='./logo/" . htmlspecialchars($row['sender_img']) . "' alt='" . htmlspecialchars($row['sender_name']) . "'>";
            echo "</div>";
        }
        
        // Message content
        echo "<div class='message-content'>";
        if (!$isSent) {
            echo "<div class='sender-name'>" . htmlspecialchars($row['sender_name']) . "</div>";
        }
        echo "<div class='message-text'>" . htmlspecialchars($row['msg']) . "</div>";
        echo "<div class='message-time'>$messageTime</div>";
        echo "</div>";
        
        echo "</div>";
    }
} else {
    echo '<div class="no-messages">No messages yet. Start the conversation!</div>';
}
?>

<style>
.date-header {
    text-align: center;
    color: #666;
    margin: 10px 0;
    font-size: 12px;
}

.message-container {
    display: flex;
    margin: 10px 0;
    padding: 0 10px;
}

.message-container.sent {
    flex-direction: row-reverse;
}

.message-avatar {
    width: 40px;
    height: 40px;
    border-radius: 50%;
    overflow: hidden;
    margin-right: 10px;
}

.message-avatar img {
    width: 100%;
    height: 100%;
    object-fit: cover;
}

.message-content {
    max-width: 70%;
}

.sender-name {
    font-size: 12px;
    color: #666;
    margin-bottom: 4px;
}

.message-text {
    background: #007bff;
    color: white;
    padding: 10px 15px;
    border-radius: 15px;
    word-wrap: break-word;
}

.message-container.sent .message-text {
    background: #28a745;
}

.message-time {
    font-size: 10px;
    color: #999;
    margin-top: 4px;
    text-align: right;
}

.no-messages {
    text-align: center;
    color: #666;
    padding: 20px;
    font-style: italic;
}
</style>

<script>
$(document).ready(function() {
    // Scroll to bottom of chat
    var chatHistory = document.getElementById('chathist');
    chatHistory.scrollTop = chatHistory.scrollHeight;
});
</script>