<style>
  h6 {
    color: silver;
  }
</style>

<?php
session_start();
$id = $_SESSION['Uid'];
date_default_timezone_set('Asia/Manila');

$host = "localhost"; 
$user = "u507130350_johnrid"; 
$pass = "Johnrid123"; 
$db_name = "u507130350_board"; 
// $host = "localhost"; 
// $user = "root"; 
// $pass = ""; 
// $db_name = "board"; 
$con = new mysqli($host, $user, $pass, $db_name);
$dates = date('F d, Y');

$ucid = $_SESSION['ucid'] ?? 0;

if ($ucid == 0) {
    // Fetch global messages and join with users table to get sender's full name
    $query = "SELECT chats.*, user.Fullname, 
                     DATE_FORMAT(chats.dt, '%M %d, %Y') as dt, 
                     DATE_FORMAT(chats.dt, '%h:%i %p') as tim 
              FROM chats 
              JOIN user ON chats.sender = user.ID 
              WHERE chats.receiver = 0 
              ORDER BY chats.dt ASC";
    $stmt = $con->prepare($query);
} else {
    // Fetch private messages and join with users table to get sender's full name
    $query = "SELECT chats.*, user.Fullname, 
                     DATE_FORMAT(chats.dt, '%M %d, %Y') as dt, 
                     DATE_FORMAT(chats.dt, '%h:%i %p') as tim 
              FROM chats 
              JOIN user ON chats.sender = user.ID 
              WHERE ((chats.receiver=? AND chats.sender=?) OR (chats.receiver=? AND chats.sender=?)) 
              ORDER BY chats.dt ASC";
    $stmt = $con->prepare($query);
    $stmt->bind_param("iiii", $id, $ucid, $ucid, $id);
}

$stmt->execute();
$run = $stmt->get_result();

while ($row = $run->fetch_assoc()): 
    $isSender = ($row['sender'] == $id);
?>
    <h6 style="text-align: center;">
        <?= ($dates == $row['dt']) ? 'Today ' . $row['tim'] : $row['dt'] . ' ' . $row['tim']; ?>
    </h6>

    <div class="<?= $isSender ? 'triangle1' : 'triangle'; ?>"></div>
    <div class="<?= $isSender ? 'message1' : 'message'; ?>">
        <span style="color:white; float: <?= $isSender ? 'right' : 'left'; ?>">
            <?= htmlspecialchars($row['msg']); ?>
        </span>
        <br>
        <div>
            <span style="color:black; float: <?= $isSender ? 'left' : 'right'; ?>; font-size:10px; clear:both;">
                <?= htmlspecialchars($row['Fullname']); ?>  <!-- Display Fullname instead of sender ID -->
            </span>
        </div>
    </div>
    <br><br><br>
<?php endwhile; ?>

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
