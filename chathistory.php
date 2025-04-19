<style>
  h6 {
    color: silver;
  }
</style>

<?php
include('db.php');
session_start();

if (!isset($_SESSION['Uid'])) {
    die("Session 'Uid' is not set.");
}

$id = $_SESSION['Uid'];
$ucids = $_SESSION['ucid'] ?? 0;

// Fetch messages
if ($ucids == 0) {
    $sql = "SELECT c.*, u.Fullname as sender_name, u.imgs as sender_img 
            FROM chats c 
            JOIN user u ON c.sender = u.ID 
            ORDER BY c.dt ASC";
} else {
    $sql = "SELECT c.*, u.Fullname as sender_name, u.imgs as sender_img 
            FROM chats c 
            JOIN user u ON c.sender = u.ID 
            WHERE (c.sender = ? AND c.receiver = ?) 
            OR (c.sender = ? AND c.receiver = ?) 
            ORDER BY c.dt ASC";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("iiii", $id, $ucids, $ucids, $id);
    $stmt->execute();
    $result = $stmt->get_result();
}

if ($ucids == 0) {
    $result = $conn->query($sql);
}

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $isSent = $row['sender'] == $id;
        $messageClass = $isSent ? 'sent' : 'received';
        ?>
        <div class="message <?php echo $messageClass; ?>">
            <div class="message-content">
                <?php if (!$isSent): ?>
                    <div class="message-sender">
                        <img src="./logo/<?php echo $row['sender_img']; ?>" alt="<?php echo htmlspecialchars($row['sender_name']); ?>" class="message-avatar">
                        <span class="sender-name"><?php echo htmlspecialchars($row['sender_name']); ?></span>
                    </div>
                <?php endif; ?>
                <div class="message-text"><?php echo htmlspecialchars($row['msg']); ?></div>
                <div class="message-time"><?php echo date('h:i A', strtotime($row['dt'])); ?></div>
            </div>
        </div>
        <?php
    }
} else {
    echo '<div class="no-messages">No messages yet. Start the conversation!</div>';
}
?>

<script>
  var tm;
  $(".message").mouseup(function () {
    clearTimeout(tm);
    return;
  });
  $(".message").mousedown(function () {
    tm = window.setTimeout(function () {
      alert('Test');
    }, 2000);
    return;
  });
</script>
