<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

include('../db.php');
session_start();

date_default_timezone_set('Asia/Manila');

// Ensure 'Uid' session variable is set
if (isset($_GET['ucid'])) {
  $_SESSION['ucid'] = $_GET['ucid'];
}
$ucid = $_SESSION['ucid'] ?? 0;


$id = $_SESSION['Uid']; // Use 'Uid' session key

// Set 'ucid' session variable if passed in the URL
if (isset($_GET['ucid'])) {
  $_SESSION['ucid'] = $_GET['ucid'];
}

// Default 'ucid' to 0 if not set
$ucids = $_SESSION['ucid'] ?? 0;

// Fetch user details
$id = $_SESSION['Uid'];
$sql = "SELECT * FROM user WHERE ID = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
  while ($user = $result->fetch_assoc()) {
    $fullname = $user['Fullname'];
    $user_id = $user['user_id'];
  }
} else {
  echo "No user found.";
}
$host = "localhost";
$user = "u507130350_johnrid";
$pass = "Johnrid123";
$db_name = "u507130350_board";
// $host = "localhost"; 
// $user = "root"; 
// $pass = ""; 
// $db_name = "board"; 

if (isset($_POST['submit'])) {
  $link = mysqli_connect($host, $user, $pass, $db_name);

  if ($link === false) {
    die("ERROR: Could not connect. " . mysqli_connect_error());
  }

  // Escape user inputs for security
  $r = mysqli_real_escape_string($link, $_POST['rec']);
  $m = mysqli_real_escape_string($link, $_POST['msg']);
  $t = mysqli_real_escape_string($link, $_POST['types']);
  $ts = date('Y-m-d h:ia');

  $sql = "INSERT INTO chats (sender, receiver, msg, Category, dt) VALUES ('$user_id', '$r', '$m', '$t', '$ts')";
  if (!mysqli_query($link, $sql)) {
    echo "ERROR: Message not sent!";
  }

  mysqli_close($link);
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <title>PrimosBH</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- Favicons -->
  <link href="./logo/balay.jpg" rel="icon">

  <!-- Fonts -->
  <link href="https://fonts.googleapis.com" rel="preconnect">
  <link href="https://fonts.gstatic.com" rel="preconnect" crossorigin>
  <link
    href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Raleway:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
    rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="assets/vendor/aos/aos.css" rel="stylesheet">
  <link href="assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
  <link href="assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">

  <!-- Main CSS File -->
  <link href="assets/css/main.css" rel="stylesheet">
  <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css" rel="stylesheet">
  <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css" rel="stylesheet">
  <!-- =======================================================
  * Template Name: iPortfolio
  * Template URL: https://bootstrapmade.com/iportfolio-bootstrap-portfolio-websites-template/
  * Updated: Jun 29 2024 with Bootstrap v5.3.3
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->
</head>
<style>
  .index-page {
    overflow-x: hidden;
  }

  /* Buttons for sign in form */
  .btn-google {
    color: white;
    background-color: #dd4b39;
    border-color: #dd4b39;
  }

  .btn-google:hover,
  .btn-google:focus,
  .btn-google:active,
  .btn-google.active {
    background-color: #d73925;
    border-color: #c23321;
    color: white;
  }

  .btn-twitter {
    color: white;
    background-color: #55acee;
    border-color: #55acee;
  }

  .btn-twitter:hover,
  .btn-twitter:focus,
  .btn-twitter:active,
  .btn-twitter.active {
    background-color: #3ea1ec;
    border-color: #2795e9;
    color: white;
  }

  .btn-facebook {
    color: white;
    background-color: #3B5998;
    border-color: #3B5998;
  }

  .btn-facebook:hover,
  .btn-facebook:focus,
  .btn-facebook:active,
  .btn-facebook.active {
    background-color: #344e86;
    border-color: #2d4373;
    color: white;
  }

  .btn-vk {
    color: white;
    background-color: #36638e;
    border-color: #36638e;
  }

  .btn-vk:hover,
  .btn-vk:focus,
  .btn-vk:active,
  .btn-vk.active {
    background-color: #2f567c;
    border-color: #284969;
    color: white;
  }

  .auth-buttons {
    padding-left: 0px;
  }

  .auth-buttons li {
    list-style: none;
    margin-bottom: 5px;
    float: left;
    margin-right: 5px;
  }

  .close-signin {
    position: absolute;
    right: 20px;
    top: 15px;
    z-index: 3000;
  }

  #via_ue .form-inline .form-group {
    vertical-align: top;
  }

  .foot {
    position: absolute;
    left: 0;
    bottom: 0;
    height: 100px;
    width: 100%;
  }

  .page-title {
    text-align: center;
  }

  .form-control:focus {
    box-shadow: none;
  }

  .form-control-underlined {
    border-width: 0;
    border-bottom-width: 1px;
    border-radius: 0;
    padding-left: 0;
  }

  .form-control::placeholder {
    font-size: 0.95rem;
    color: #aaa;
    font-style: italic;
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

  /*.onlines:hover {
  box-shadow: 0 8px 16px 0 rgba(0,0,0,0.2);
}
*/
  body {
    background-color: #F8F8F8;
  }

  /*@media (min-width: 900px) {*/
  .chat {
    float: left;
    background-color: white;
    height: 630px;
    width: 65%;
    margin: .2in;
    margin-left: -.1in;
    box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2);
    transition: 0.3s;
    padding: .1in;
  }

  .avatar {
    width: 150px;
    height: 100px;
    /*    background-image: url("https://s3-us-west-2.amazonaws.com/s.cdpn.io/1689055/profile/profile-80.jpg");*/
    background-size: cover;
    background-repeat: no-repeat;
    background-position: 50% 50%;
    border-radius: 50px;
    box-shadow: 0 0 0 2px #66cc33;
    width: 48px;
    height: 48px;
    float: left;
    margin-right: 10px;
  }

  .profile {
    padding: 5px;
    padding-left: 10px;
    cursor: pointer;
    height: 55px;
    width: 100%;

    /*  max-width: 200px;*/
    /*  margin: 0 auto;*/
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

  /*}*/
  /*@media (min-width: 760px) {
.chat{
  height: 630px;
  width: 35%;
}
}*/
  .msg {
    border-radius: 20px;
  }

  @media screen and (min-width: 450px) {
    .mess {
      position: absolute;
      bottom: 3;
      width: 55%;
      height: 4vh;
      margin: auto;
    }

    main .inner_div {
      padding-left: 0;
      margin: 0;
      list-style-type: none;
      position: relative;
      overflow: auto;
      height: 80vh;
      background-image: url(/*https://media.geeksforgeeks.org/wp-content/cdn-uploads/20200911064223/bg.jpg);
      */ background-position: center;
      background-repeat: no-repeat;
      background-size: cover;
      position: relative;
      border-top: 2px solid #fff;
      border-bottom: 2px solid #fff;

    }

    .chat {
      height: 90vh;
      width: 60%;
    }

    .onlines {
      height: 90vh;
    }

    .msg {
      height: 40px;
      width: 245px;
    }

    .plane {
      font-size: 17px;
      margin: 0;

    }
  }

  @media screen and (min-width: 900px) {
    .plane {
      font-size: 20px;
      margin: 0;
    }

    .mess {
      position: absolute;
      bottom: 3;
      width: 43%;
      height: 6vh;
      margin: auto;
    }

    .chat {
      height: 95vh;
      width: 45%;
    }

    .onlines {
      height: 95vh;
    }

    main {
      width: 60%;
      height: 90vh;
      display: inline-block;
      font-size: 15px;
      vertical-align: top;
    }

    main .inner_div {
      padding-left: 0;
      margin: 0;
      list-style-type: none;
      position: relative;
      overflow: auto;
      height: 78vh;
      background-image: url(/*https://media.geeksforgeeks.org/wp-content/cdn-uploads/20200911064223/bg.jpg);
      */ background-position: center;
      background-repeat: no-repeat;
      background-size: cover;
      position: relative;
      border-top: 2px solid #fff;
      border-bottom: 2px solid #fff;

    }

    .msg {
      height: 40px;
      width: 550px;
    }
  }

  #container {
    /*  width:700px;*/
    height: 650px;
    background: white;
    margin: 0 auto;
    font-size: 0;
    border-radius: 5px;
    overflow: hidden;
    float: right;
  }

  main {
    width: 100%;
    height: 650px;
    display: inline-block;
    font-size: 15px;
    vertical-align: top;
  }

  main header {
    height: 80px;
    padding: 30px 20px 30px 40px;
    background-color: blue;
    text-align: center;
  }

  main header>* {
    display: inline-block;
    vertical-align: top;
  }

  main header img:first-child {
    width: 24px;
    margin-top: 8px;
  }

  main header img:last-child {
    width: 24px;
    margin-top: 8px;
  }

  /*main header div{
  margin-left:100px;
  margin-right:100px;
}*/
  main header h2 {
    font-size: 25px;
    margin-top: 5px;
    text-align: center;
    color: #FFFFFF;
  }

  main .triangle {
    width: 0;
    height: 0;
    border-style: solid;
    border-width: 0 8px 8px 8px;
    border-color: transparent transparent #58b666 transparent;
    margin-left: 20px;
    clear: both;
  }

  main .message {
    padding: 10px;
    color: #000;
    margin-left: 15px;
    background-color: #58b666;
    line-height: 20px;
    max-width: 90%;
    display: inline-block;
    text-align: left;
    border-radius: 5px;
    clear: both;
  }

  main .triangle1 {
    width: 0;
    height: 0;
    border-style: solid;
    border-width: 0 8px 8px 8px;
    border-color: transparent transparent #6fbced transparent;
    margin-right: 20px;
    float: right;
    clear: both;
  }

  main .message1 {
    padding: 10px;
    color: #000;
    margin-right: 15px;
    background-color: #6fbced;
    line-height: 20px;
    max-width: 90%;
    display: inline-block;
    text-align: left;
    border-radius: 5px;
    float: right;
    clear: both;
  }

  main footer {
    height: 150px;
    padding: 20px 30px 10px 20px;
    background-color: #622569;
  }

  main footer .input1 {
    resize: none;
    border: 100%;
    display: block;
    width: 120%;
    height: 55px;
    border-radius: 3px;
    padding: 20px;
    font-size: 13px;
    margin-bottom: 13px;
  }

  main footer #msg {
    resize: none;
    border: 100%;
    display: block;
    width: 140%;
    height: 55px;
    border-radius: 3px;
    padding: 20px;
    font-size: 13px;
    margin-bottom: 13px;
    margin-left: 20px;
  }

  main footer .input2 {
    resize: none;
    border: 100%;
    display: block;
    width: 40%;
    height: 55px;
    border-radius: 3px;
    padding: 20px;
    font-size: 13px;
    margin-bottom: 13px;
    margin-left: 100px;
    color: white;
    text-align: center;
    background-color: black;
    border: 2px solid white;
  }
  }

  main footer textarea::placeholder {
    color: #ddd;
  }

  .index-page {
    overflow-x: hidden;
  }

  /* Buttons for sign in form */
  .btn-google {
    color: white;
    background-color: #dd4b39;
    border-color: #dd4b39;
  }

  .btn-google:hover,
  .btn-google:focus,
  .btn-google:active,
  .btn-google.active {
    background-color: #d73925;
    border-color: #c23321;
    color: white;
  }

  .btn-twitter {
    color: white;
    background-color: #55acee;
    border-color: #55acee;
  }

  .btn-twitter:hover,
  .btn-twitter:focus,
  .btn-twitter:active,
  .btn-twitter.active {
    background-color: #3ea1ec;
    border-color: #2795e9;
    color: white;
  }

  .btn-facebook {
    color: white;
    background-color: #3B5998;
    border-color: #3B5998;
  }

  .btn-facebook:hover,
  .btn-facebook:focus,
  .btn-facebook:active,
  .btn-facebook.active {
    background-color: #344e86;
    border-color: #2d4373;
    color: white;
  }

  .btn-vk {
    color: white;
    background-color: #36638e;
    border-color: #36638e;
  }

  .btn-vk:hover,
  .btn-vk:focus,
  .btn-vk:active,
  .btn-vk.active {
    background-color: #2f567c;
    border-color: #284969;
    color: white;
  }

  .auth-buttons {
    padding-left: 0px;
  }

  .auth-buttons li {
    list-style: none;
    margin-bottom: 5px;
    float: left;
    margin-right: 5px;
  }

  .close-signin {
    position: absolute;
    right: 20px;
    top: 15px;
    z-index: 3000;
  }

  #via_ue .form-inline .form-group {
    vertical-align: top;
  }

  .foot {
    position: absolute;
    left: 0;
    bottom: 0;
    height: 100px;
    width: 100%;
  }

  .page-title {
    text-align: center;
  }

  .form-control:focus {
    box-shadow: none;
  }

  .form-control-underlined {
    border-width: 0;
    border-bottom-width: 1px;
    border-radius: 0;
    padding-left: 0;
  }

  .form-control::placeholder {
    font-size: 0.95rem;
    color: #aaa;
    font-style: italic;
  }

  .select-dropdown,
  .select-dropdown * {
    margin: 0;
    padding: 0;
    position: relative;
    box-sizing: border-box;
  }

  .select-dropdown {
    position: relative;
    background-color: #E6E6E6;
    border-radius: 4px;
  }

  .select-dropdown select {
    font-size: 1rem;
    font-weight: normal;
    max-width: 100%;
    padding: 8px 24px 8px 10px;
    border: none;
    background-color: transparent;
    -webkit-appearance: none;
    -moz-appearance: none;
    appearance: none;
  }

  .select-dropdown select:active,
  .select-dropdown select:focus {
    outline: none;
    box-shadow: none;
  }

  .select-dropdown:after {
    content: "";
    position: absolute;
    top: 50%;
    right: 8px;
    width: 0;
    height: 0;
    margin-top: -2px;
    border-top: 5px solid #aaa;
    border-right: 5px solid transparent;
    border-left: 5px solid transparent;
  }

  .active {}
</style>

<body class="index-page">

  <header id="header" class="header dark-background d-flex flex-column">
    <i class="header-toggle d-xl-none bi bi-list"></i>

    <div class="profile-img">
      <img src="logo/balay.jpg" alt="" class="img-fluid rounded-circle">
    </div>

    <a href="index.html" class="logo d-flex align-items-center justify-content-center">
      <!-- Uncomment the line below if you also wish to use an image logo -->
      <!-- <img src="assets/img/logo.png" alt=""> -->
      <h1 class="sitename"><?php echo $fullname ?></h1>
    </a>

    <div class="social-links text-center">
      <a href="#" class="twitter"><i class="bi bi-twitter-x"></i></a>
      <a href="#" class="facebook"><i class="bi bi-facebook"></i></a>
      <a href="#" class="instagram"><i class="bi bi-instagram"></i></a>
    </div>

    <nav id="navmenu" class="navmenu">
      <ul>
        <li><a href="Home.php"><i class="bi bi-house navicon"></i>Home</a></li>
        <li><a href="Documents.php"><i class="bi bi-file-earmark-text navicon"></i> Documents</a></li>

        <li><a href="Messages.php" class="active"><i class="bi bi-envelope navicon"></i> Messages</a></li>
        <li><a href="Maintenance.php"><i class="bi bi-newspaper navicon"></i> Maintenance Request</a></li>
        <li><a href="../logout.php"><i class="bi bi-box-arrow-right navicon"></i> Logout</a></li>
      </ul>

    </nav>

  </header>

  <main class="main">
    <div class="onlines">

      <?php
      // $dates=date('m d, Y h:i');
// echo $dates;
// echo $ucids;
      ?>
      <div><span style="font-size: 20px;">Chats</span>

      </div>

      <div>
        <!-- <form method="Get" name="search-form1" id="search-form1"class="form-search1"> -->
        <div class="profile" onclick="location.href = './Messages.php?ucid=0';">
          <div class="avatar" style="background-image: url('./logo/logo.png');"></div>
          <span>All</span>
          <input type="text" name="ucid" hidden value="0">
          <button id="status">
            <i></i> <span>Online</span>
          </button>
        </div><br>
        <!-- </form> -->
      </div>

      <?php
      $sql = "SELECT * FROM user";
      $result = $conn->query($sql);

      if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) { ?>
          <div>
            <!-- <form method="Get" name="search-form1" id="search-form1"class="form-search1"> -->
            <div class="profile" onclick="location.href = './Messages.php?ucid=<?php echo $user_id; ?>';">
              <div class="avatar" style="background-image: url('./logo/<?php echo $row['imgs']; ?>');"></div>
              <span><?php echo $row['Fullname']; ?></span>
              <input type="text" name="ucid" hidden value="<?php echo $user['user_id'];; ?>">
              <button id="status">
                <i></i> <span>Online</span>
              </button>
            </div><br>
            <!-- </form> -->
          </div>
          <?php
        }
      } ?>
    </div>
    <form id="myform" method="POST">
      <div class="chat">
        <div id="preloader"></div>
        <?php
        if (isset($_GET['ucid'])) {
          $_SESSION['ucid'] = $_GET['ucid'];
          $ucids = $_SESSION['ucid'];

        }
        if ($ucids != 0) {
          $sql = "SELECT * FROM user where ID='$ucids'";
          $result = $conn->query($sql);

          if ($result->num_rows > 0) {
            // output data of each row
            while ($row = $result->fetch_assoc()) {

              ?>


              <div class="profile" style="border-bottom: 1px solid;">
                <div class="avatar" style="background-image: url('./logo/<?php echo $row['imgs']; ?>');"></div>
                <span><?php echo $row['Fullname']; ?></span>
                <button id="status">
                  <i></i> <span style="color: green">Online</span>
                </button>
                <div style="float: right;">
                  <div class="select-dropdown">
                    <select name="types">
                      <option value="Message">Message</option>
                      <option value="Announcement">Announcement</option>
                    </select>
                  </div>
                </div>
              </div>
              <?php
            }
          }
        } else { ?>
          <div class="profile" style="border-bottom: 1px solid;">
            <div class="avatar" style="background-image: url('./logo/logo.png');"></div>
            <span>All</span>
            <button id="status">
              <i></i> <span style="color: green">Online</span>
            </button>

            <div style="float: right;">
              <div class="select-dropdown">
                <select name="types">
                  <option value="Message">Message</option>
                  <option value="Announcement">Announcement</option>
                </select>
              </div>
            </div>
          </div>
          <?php
        }
        ?>
        <div class="inner_div" id="chathist"></div>
        <div class="mess">
          <input class="input1" type="text" id="uname" name="uname" hidden placeholder="From" value="<?php if (isset($_SESSION['userid'])) {
            echo $userid;
          } ?>">
          <input class="input1" type="text" id="rec" name="rec" hidden placeholder="To" value="<?php if (isset($_GET['ucid'])) {
            echo $ucids;
          } ?>">
          <input type="text" name="msg" class="msg" id="msg">
          <button class="input2" type="submit" id="submit" name="submit"
            style="background-color: transparent;color: blue; width: auto;margin: 0; border: none;"><i
              class="fa fa-paper-plane plane"></i></button>

        </div>
        <!-- <footer>
    <table>
    <tr>
    <th>
      <input class="input1" type="text"
          id="uname" name="uname"
          placeholder="From">
    </th>
    <th>
      <input id="msg"type="text" name="msg"placeholder="Type your message">
      </input></th>
    <th>
      <input class="input2" type="submit"
      id="submit" name="submit" value="send">
    </th>      
    </tr>
    </table>      
 </footer> -->
    </form>
    </div>
  </main>

  <a href="#" id="scroll-top" class="scroll-top d-flex align-items-center justify-content-center"><i
      class="bi bi-arrow-up-short"></i></a>

  <!-- Preloader -->
  <!-- <div id="preloader"></div> -->

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
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <!-- Main JS File -->
  <script src="assets/js/main.js"></script>
  <script>
    var colors = ['#D64541', '#EB9532', '#66cc33', '#656565'];

    $("#status").click(function () {
      var color = colors[Math.floor(Math.random() * colors.length)];

      var lastColor = $(this).find('i').css('background');

      if (color === lastColor) {
        var color = colors[Math.floor(Math.random() * colors.length)];
      }


      var status = ['Busy', 'Away', 'Online', 'Offline'];

      if (color === '#D64541') {
        $(this).find('span').html('Busy');
        $(this).css('color', '#D64541');
      } else if (color === '#EB9532') {
        $(this).find('span').html('Away');
        $(this).css('color', '#EB9532');
      } else if (color === '#66cc33') {
        $(this).find('span').html('Online');
        $(this).css('color', '#66cc33');
      } else if (color === '#656565') {
        $(this).find('span').html('Offline');
        $(this).css('color', '#656565');
      }


      $('.avatar').css({ 'box-shadow': ' 0 0 0 2px ' + color });
      $(this).find('i').css({ 'background': color });
    });

  </script>
  <script>
    $(document).ready(function () {
      var scrollableDiv = document.getElementById('chathist');
      var bottomElement = scrollableDiv.lastElementChild;
      bottomElement.scrollIntoView({ behavior: 'smooth', block: 'end' });
    });
  </script>
  <script>
    $(document).ready(function () {

      setInterval(function () {
        $.ajax({
          url: '../chathistory.php', // URL of the server-side script
          success: function (data) {
            $('#chathist').html(data); // Update the content of the DIV element
          }
        });
      }, 1000); // Refresh the content every 5 seconds

    });
  </script>
  <script>
    var input = document.getElementById("msg");

    // Execute a function when the user presses a key on the keyboard
    input.addEventListener("keypress", function (event) {
      // If the user presses the "Enter" key on the keyboard
      if (event.key === "Enter") {
        // Cancel the default action, if needed
        event.preventDefault();
        // Trigger the button element with a click
        document.getElementById("submit").click();
      }
    });
  </script>
  <script>
    var tm;
    $(".confBtn").mouseup(function () {
      clearTimeout(tm);
      return;
    });
    $(".confBtn").mousedown(function () {
      tm = window.setTimeout(function () {
        $("#clicked").text("CLICKED");
      }, 2000);
      return;
    });
  </script>
</body>

</html>