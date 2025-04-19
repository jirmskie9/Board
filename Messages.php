<?php
include('db.php');
session_start();
date_default_timezone_set('Asia/Manila');

// Ensure 'Uid' session variable is set
if (!isset($_SESSION['Uid'])) {
  die("Session 'Uid' is not set. Please log in again.");
}

$id = $_SESSION['Uid'];

// Set 'ucid' session variable if passed in the URL
if (isset($_GET['ucid'])) {
  $_SESSION['ucid'] = $_GET['ucid'];
}

// Default 'ucid' to 0 if not set
$ucids = $_SESSION['ucid'] ?? 0;

// Fetch user details
$sql = "SELECT * FROM user WHERE ID = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
  while ($user = $result->fetch_assoc()) {
    $fullname = $user['Fullname'];
  }
} else {
  echo "No user found.";
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <title>PrimosBH - Messages</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- Favicons -->
  <link href="logo/balay.jpg" rel="icon">

  <!-- Fonts -->
  <link href="https://fonts.googleapis.com" rel="preconnect">
  <link href="https://fonts.gstatic.com" rel="preconnect" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700&display=swap" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="assets/vendor/aos/aos.css" rel="stylesheet">
  <link href="assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
  <link href="assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">
  <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css" rel="stylesheet">
  <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css" rel="stylesheet">

  <!-- Main CSS File -->
  <link href="assets/css/main.css" rel="stylesheet">
</head>

<style>
  .index-page {
    overflow-x: hidden;
  }

  body {
    background-color: #F8F8F8;
  }

  .onlines {
    float: left;
    background-color: white;
    height: 630px;
    width: 30%;
    margin: .2in;
    box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2);
    transition: 0.3s;
    padding: .1in;
  }

  .chat {
    float: left;
    background-color: white;
    height: 90vh;
    width: 65%;
    margin: .2in;
    margin-left: -.1in;
    box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2);
    transition: 0.3s;
    padding: 0;
    position: relative;
    display: flex;
    flex-direction: column;
    border-radius: 10px;
    overflow: hidden;
  }

  .chat::before {
    content: "";
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background-image: url('chatbg2.png');
    background-size: cover;
    background-position: center;
    background-repeat: no-repeat;
    opacity: 0.05;
    z-index: -1;
  }

  .chat-header {
    padding: 15px 20px;
    border-bottom: 1px solid #eee;
    background: white;
    display: flex;
    align-items: center;
    justify-content: space-between;
  }

  .chat-header .profile {
    display: flex;
    align-items: center;
    gap: 10px;
    margin: 0;
    padding: 0;
    border: none;
  }

  .chat-header .avatar {
    width: 40px;
    height: 40px;
    border-radius: 50%;
    background-size: cover;
    background-position: center;
    border: 2px solid #007bff;
  }

  .chat-header .select-dropdown {
    background: #f8f9fa;
    border-radius: 5px;
    padding: 5px;
  }

  .chat-header select {
    border: none;
    background: transparent;
    padding: 5px;
    font-size: 14px;
    color: #495057;
  }

  .inner_div {
    flex: 1;
    overflow-y: auto;
    padding: 20px;
    display: flex;
    flex-direction: column;
    gap: 15px;
    height: calc(90vh - 120px);
    background: rgba(248, 249, 250, 0.5);
  }

  .mess {
    display: flex;
    align-items: center;
    padding: 15px 20px;
    background: white;
    border-top: 1px solid #eee;
    position: sticky;
    bottom: 0;
  }

  .msg {
    flex: 1;
    padding: 12px 20px;
    border: 1px solid #ddd;
    border-radius: 25px;
    margin-right: 10px;
    outline: none;
    font-size: 14px;
    transition: border-color 0.3s;
  }

  .msg:focus {
    border-color: #007bff;
    box-shadow: 0 0 0 2px rgba(0, 123, 255, 0.25);
  }

  .input2 {
    background: transparent;
    border: none;
    color: #007bff;
    cursor: pointer;
    padding: 8px 15px;
    border-radius: 50%;
    transition: all 0.3s;
  }

  .input2:hover {
    background: rgba(0, 123, 255, 0.1);
    color: #0056b3;
  }

  .plane {
    font-size: 20px;
  }

  /* Custom scrollbar */
  .inner_div::-webkit-scrollbar {
    width: 8px;
  }

  .inner_div::-webkit-scrollbar-track {
    background: #f1f1f1;
    border-radius: 4px;
  }

  .inner_div::-webkit-scrollbar-thumb {
    background: #c1c1c1;
    border-radius: 4px;
  }

  .inner_div::-webkit-scrollbar-thumb:hover {
    background: #a8a8a8;
  }

  /* Status indicator */
  #status {
    background: transparent;
    border: none;
    padding: 0;
    font-size: 12px;
    color: #28a745;
  }

  #status i {
    display: inline-block;
    width: 8px;
    height: 8px;
    border-radius: 50%;
    background: #28a745;
    margin-right: 5px;
  }

  /* Message typing indicator */
  .typing-indicator {
    display: flex;
    align-items: center;
    gap: 5px;
    padding: 10px 15px;
    background: #f8f9fa;
    border-radius: 15px;
    margin: 5px 0;
    width: fit-content;
  }

  .typing-indicator span {
    width: 8px;
    height: 8px;
    background: #6c757d;
    border-radius: 50%;
    animation: typing 1s infinite;
  }

  .typing-indicator span:nth-child(2) {
    animation-delay: 0.2s;
  }

  .typing-indicator span:nth-child(3) {
    animation-delay: 0.4s;
  }

  @keyframes typing {
    0%, 100% { transform: translateY(0); }
    50% { transform: translateY(-5px); }
  }

  .avatar {
    width: 48px;
    height: 48px;
    border-radius: 50%;
    background-size: cover;
    background-position: center;
    border: 2px solid #66cc33;
    float: left;
    margin-right: 10px;
  }

  .profile {
    padding: 5px;
    padding-left: 10px;
    cursor: pointer;
    height: 55px;
    width: 100%;
  }

  .onlines .profile:hover {
    background-color: silver;
    border-radius: 10px;
  }

  .profile span {
    display: block;
    font: bold 12px arial, tahoma, sans-serif;
  }

  .profile button {
    background: transparent;
    border: 0 none;
    color: rgba(255, 255, 255, 0.4);
    font: bold 11px arial, tahoma, sans-serif;
    cursor: pointer;
    padding: 0px;
  }

  .profile button i {
    width: 6px;
    height: 6px;
    background: #66cc33;
    display: inline-block;
    position: relative;
    top: -1px;
    border-radius: 100%;
  }

  .profile button span {
    display: inline-block;
  }
</style>

<body class="index-page">

  <header id="header" class="header dark-background d-flex flex-column">
    <i class="header-toggle d-xl-none bi bi-list"></i>

    <div class="profile-img">
      <img src="logo/balay.jpg" alt="" class="img-fluid rounded-circle">
    </div>

    <a href="index.html" class="logo d-flex align-items-center justify-content-center">
      <h1 class="sitename"><?php echo $fullname ?></h1>
    </a>

    <nav id="navmenu" class="navmenu">
      <ul>
        <li><a href="./Dashboard.php"><i class="bi bi-house navicon"></i>Dashboard</a></li>
        <li><a href="./Occupants.php"><i class="bi bi-person navicon"></i> Occupants</a></li>
        <li><a href="./Rooms.php"><i class="bi bi-door-open navicon"></i> Rooms</a></li>
        <li><a href="./Documents.php"><i class="bi bi-file-earmark-text navicon"></i> Documents</a></li>
        <li><a href="./Utilities.php"><i class="bi bi-lightbulb navicon"></i> Utility Bills</a></li>
        <li><a href="./Collection.php" class=""><i class="bi bi-cash-stack navicon"></i>Rent Collection</a></li>
        <li><a href="./expenses.php"><i class="bi bi-receipt navicon"></i> Expenses</a></li>
        <li><a href="./Messages.php" class="active"><i class="bi bi-envelope-fill navicon"></i> Messages</a></li>
        <li><a href="./Maintenance.php"><i class="bi bi-newspaper navicon"></i> Maintenance Request</a></li>
        <li><a href="./user.php"><i class="bi bi-people navicon"></i> Users Management</a></li>
        <li><a href="./logout.php"><i class="bi bi-box-arrow-right navicon"></i> Logout</a></li>
      </ul>
    </nav>
  </header>

  <main class="main">
    <div class="onlines">
      <div><span style="font-size: 20px;">Chats</span></div>
      <div class="profile" onclick="location.href = './Messages.php?ucid=0';">
        <div class="avatar" style="background-image: url('./logo/logo.png');"></div>
        <span>All</span>
        <button id="status"><i></i> <span>Online</span></button>
      </div><br>

      <?php
      $sql = "SELECT * FROM user";
      $result = $conn->query($sql);
      if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) { ?>
          <div class="profile" onclick="location.href = './Messages.php?ucid=<?php echo $row['ID']; ?>';">
            <div class="avatar" style="background-image: url('./logo/<?php echo $row['imgs']; ?>');"></div>
            <span><?php echo htmlspecialchars($row['Fullname']); ?></span>
            <button id="status"><i></i> <span>Online</span></button>
          </div><br>
        <?php }
      } ?>
    </div>

    <form id="myform" method="POST">
      <div class="chat">
        <div class="chat-header">
          <?php
          if ($ucids != 0) {
            $sql = "SELECT * FROM user WHERE ID = ?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("i", $ucids);
            $stmt->execute();
            $result = $stmt->get_result();

            if ($result->num_rows > 0) {
              while ($row = $result->fetch_assoc()) { ?>
                <div class="profile" style="border-bottom: none;">
                  <div class="avatar" style="background-image: url('./logo/<?php echo $row['imgs']; ?>');"></div>
                  <span><?php echo htmlspecialchars($row['Fullname']); ?></span>
                  <button id="status"><i></i> <span style="color: green">Online</span></button>
                  <div style="float: right;">
                    <div class="select-dropdown">
                      <select name="types">
                        <option value="Message">Message</option>
                        <option value="Announcement">Announcement</option>
                      </select>
                    </div>
                  </div>
                </div>
              <?php }
            }
          } else { ?>
            <div class="profile" style="border-bottom: none;">
              <div class="avatar" style="background-image: url('./logo/logo.png');"></div>
              <span>All</span>
              <button id="status"><i></i> <span style="color: green">Online</span></button>
              <div style="float: right;">
                <div class="select-dropdown">
                  <select name="types">
                    <option value="Message">Message</option>
                    <option value="Announcement">Announcement</option>
                  </select>
                </div>
              </div>
            </div>
          <?php } ?>
        </div>

        <div class="inner_div" id="chathist"></div>
        
        <div class="mess">
          <input type="hidden" id="uname" name="uname" value="<?php echo htmlspecialchars($id); ?>">
          <input type="hidden" id="rec" name="rec" value="<?php echo htmlspecialchars($ucids); ?>">
          <input type="text" name="msg" class="msg" id="msg" placeholder="Type your message...">
          <button class="input2" type="submit" id="submit" name="submit">
            <i class="fa fa-paper-plane plane"></i>
          </button>
        </div>
      </div>
    </form>
  </main>

  <!-- Vendor JS Files -->
  <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
  <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="assets/vendor/php-email-form/validate.js"></script>
  <script src="assets/vendor/aos/aos.js"></script>
  <script src="assets/vendor/typed.js/typed.umd.js"></script>
  <script src="assets/vendor/purecounter/purecounter_vanilla.js"></script>
  <script src="assets/vendor/waypoints/noframework.waypoints.js"></script>
  <script src="assets/vendor/glightbox/js/glightbox.min.js"></script>
  <script src="assets/vendor/imagesloaded/imagesloaded.pkgd.min.js"></script>
  <script src="assets/vendor/isotope-layout/isotope.pkgd.min.js"></script>
  <script src="assets/vendor/swiper/swiper-bundle.min.js"></script>

  <script>
  $(document).ready(function() {
      // Handle form submission with AJAX
      $('#myform').on('submit', function(e) {
          e.preventDefault();
          
          // Show typing indicator
          var typingIndicator = $('<div class="typing-indicator"><span></span><span></span><span></span></div>');
          $('#chathist').append(typingIndicator);
          
          // Get form data
          var formData = {
              rec: $('#rec').val(),
              msg: $('#msg').val(),
              types: $('select[name="types"]').val()
          };

          // Send message via AJAX
          $.ajax({
              url: 'User/send_message.php',
              type: 'POST',
              data: formData,
              success: function(response) {
                  // Remove typing indicator
                  typingIndicator.remove();
                  
                  if (response.success) {
                      // Clear input field
                      $('#msg').val('');
                      // Refresh chat history
                      loadChatHistory();
                  } else {
                      alert('Error sending message: ' + response.message);
                  }
              },
              error: function() {
                  // Remove typing indicator
                  typingIndicator.remove();
                  alert('Error sending message. Please try again.');
              }
          });
      });

      // Function to load chat history
      function loadChatHistory() {
          $.ajax({
              url: 'User/chathistory.php',
              type: 'GET',
              success: function(data) {
                  $('#chathist').html(data);
                  // Scroll to bottom
                  var chatHistory = document.getElementById('chathist');
                  chatHistory.scrollTop = chatHistory.scrollHeight;
              }
          });
      }

      // Load chat history initially
      loadChatHistory();

      // Refresh chat history every 2 seconds
      setInterval(loadChatHistory, 2000);

      // Handle Enter key in message input
      $('#msg').keypress(function(e) {
          if (e.which == 13) {
              $('#myform').submit();
              return false;
          }
      });
  });
  </script>
</body>

</html>