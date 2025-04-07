<?php
session_start();
include('db.php');
if (!isset($_SESSION['Uid'])) {
  header("Location: login.php");
  exit(); // Stop script execution after redirect
}

$uid = $_SESSION['Uid']; // Use the correct session variable

// Prepare the SQL query to fetch user details
$sql = "SELECT * FROM user WHERE ID = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $uid);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
  while ($user = $result->fetch_assoc()) {
    $fullname = $user['Fullname'];
  }
} else {
  echo "No user found.";
}


if (isset($_POST['rn'])) {
  $rn = $_POST['rn'];
  $ro = $_POST['ro'];
  $rc = $_POST['rc'];


  $sql = "INSERT INTO rooms (Roomnum, Occupants, Cost)
VALUES ('$rn', '$ro', '$rc')";

  if ($conn->query($sql) === TRUE) {
    echo "New record created successfully";
  } else {
    echo "Error: " . $sql . "<br>" . $conn->error;
  }
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
  <!-- <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon"> -->

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

  .wrapper {
    display: table;
    height: 100%;
    width: 100%;
    margin-top: -50px;
  }

  .container-fostrap {
    display: table-cell;
    padding: 1em;
    text-align: center;
    vertical-align: middle;
  }

  .fostrap-logo {
    width: 100px;
    margin-bottom: 15px
  }

  h1.heading {
    color: #fff;
    font-size: 1em;
    font-weight: 900;
    margin: 0 0 0.5em;
    color: #505050;

  }

  @media (min-width: 450px) {
    h1.heading {
      font-size: 3.55em;
      margin-top: -52px;
    }
  }

  @media (min-width: 760px) {
    h1.heading {
      font-size: 3.05em;
      margin-top: -52px;
    }
  }

  @media (min-width: 900px) {
    h1.heading {
      font-size: 3.25em;
      margin: 0 0 0.3em;
      margin-top: -52px;
    }

    .col-sm-4 {
      width: 30%;
    }

    .container {
      width: 1000px;
    }
  }

  .card {
    display: block;
    margin-bottom: 20px;
    line-height: 1.42857143;
    background-color: #fff;
    border-radius: 2px;
    box-shadow: 0 2px 5px 0 rgba(0, 0, 0, 0.16), 0 2px 10px 0 rgba(0, 0, 0, 0.12);
    transition: box-shadow .25s;
    /*    width: 240px;*/
  }

  .card:hover {
    box-shadow: 0 8px 17px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
  }

  .img-card {
    width: 100%;
    height: 200px;
    border-top-left-radius: 2px;
    border-top-right-radius: 2px;
    display: block;
    overflow: hidden;
  }

  .img-card img {
    width: 100%;
    height: 200px;
    object-fit: cover;
    transition: all .25s ease;
  }

  .card-content {
    padding: 15px;
    text-align: left;
  }

  .card-title {
    margin-top: 0px;
    font-weight: 700;
    font-size: 1.65em;
    text-align: center;
  }

  .card-title a {
    color: #000;
    text-decoration: none !important;
  }

  .card-read-more {
    border-top: 1px solid #D4D4D4;
  }

  .card-read-more a {
    text-decoration: none !important;
    padding: 10px;
    font-weight: 600;
    text-transform: uppercase
  }

  .table-responsive {
    min-height: .01%;
    overflow-x: auto;
    overflow-y: hidden;
  }
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


    <nav id="navmenu" class="navmenu">
      <ul>
        <li><a href="./Dashboard.php"><i class="bi bi-house navicon"></i>Dashboard</a></li>
        <li><a href="./Occupants.php"><i class="bi bi-person navicon"></i> Occupants</a></li>
        <li><a href="./Rooms.php" class="active"><i class="bi bi-door-open navicon"></i> Rooms</a></li>
        <li><a href="./Documents.php"><i class="bi bi-file-earmark-text navicon"></i> Documents</a></li>
        <li><a href="./Utilities.php"><i class="bi bi-lightbulb navicon"></i> <!-- Represents electricity/utilities -->
        Utility Bills</a></li>
        <li><a href="./Collection.php" class=""><i class="bi bi-cash-stack navicon"></i>Rent Collection</a></li>
        <li><a href="./Expenses.php"><i class="bi bi-receipt navicon"></i> Expenses</a></li>
        <li><a href="./Messages.php"><i class="bi bi-envelope-fill navicon"></i> Messages</a></li>
        <li><a href="./Maintenance.php"><i class="bi bi-newspaper navicon"></i> Maintenance Request</a></li>
        <li><a href="./user.php"><i class="bi bi-people navicon"></i> Users Management</a></li>
        <li><a href="./logout.php"><i class="bi bi-box-arrow-right navicon"></i> Logout</a></li>
      </ul>

    </nav>

  </header>

  <main class="main col-lg-9">
    <div class="page-title">
      <!-- <h1>Rooms</h1> -->
      <div>
        <img src="./logo/balay.jpg" class="fostrap-logo" />
        <h1 class="heading">
          PrimosBH Rooms
        </h1>
      </div>
    </div>
    <div class="p-1 bg-light rounded rounded-pill shadow-sm mb-4" style="width: 55%; float: left;">
      <div class="input-group">
        <input type="search" style="width: 85%;" placeholder="What're you searching for?"
          aria-describedby="button-addon1" class="form-control border-0 bg-light">
        <div class="input-group-append">
          <button id="button-addon1" style="float: right;" type="submit" class="btn btn-link text-primary"><i
              class="fa fa-search"></i></button>
        </div>
      </div>
    </div>
    <div style="float: right; margin-top: 5px;padding: 5px;"><button type="button" id="PopoverCustomT-1"
        class="btn btn-primary btn-sm" data-toggle="modal" data-target="#modal-social"><span class="fa fa-plus"></span>
        New Room</button></div><br><br><br>

    <div class="table-responsive">

      <section class="wrapper">
        <div class="container-fostrap">
          <?php
          // Fetch total occupants
          $sqlTotal = "SELECT SUM(Occupants) AS totalOccupants FROM rooms";
          $resultTotal = $conn->query($sqlTotal);
          $totalOccupants = ($resultTotal->num_rows > 0) ? $resultTotal->fetch_assoc()['totalOccupants'] : 0;
          ?>

          <div class="content">
            <div class="container">
              <div class="row">
                <?php
                $sql = "SELECT * FROM rooms ORDER BY Roomnum";
                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                  while ($row = $result->fetch_assoc()) {
                    // Determine the correct image based on tenants vs occupants
                    $statusImage = ($row['tenants'] >= $row['Occupants']) ? 'logo/occupied.png' : 'logo/available.png';
                    ?>

                    <div class="col-xs-12 col-sm-4">
                      <div class="card">
                        <a class="img-card" href="http://www.fostrap.com/2016/03/bootstrap-3-carousel-fade-effect.html">
                          <img src="./logo/rooms.jpg" />
                        </a>
                        <div class="card-content">
                          <h4 class="card-title">
                            <a href="http://www.fostrap.com/2016/03/bootstrap-3-carousel-fade-effect.html">Room
                              #<?php echo $row['Roomnum']; ?>
                            </a>
                          </h4>
                          <p class="">
                            Occupants: <?php echo $row['Occupants']; ?> <br>
                            Tenants: <?php echo $row['tenants']; ?> <br>
                            Price: <?php echo $row['Cost']; ?>
                          </p>
                          
                        </div>
                        <div class="card-read-more text-center p-2">
                          <img src="<?php echo $statusImage; ?>" alt="Room Status" class="img-fluid rounded shadow-sm"
                            style="max-width: 100%; height: auto;">
                        </div>

                      </div>
                    </div>
                    <?php

                  }
                }
                ?>
              </div>

            </div>
          </div>
        </div>
      </section>

      <span>Total Occupants: </span><span style="color: red;"></span><?php echo $totalOccupants ?></span>
    </div>

    <div class="modal fade" id="modal-social" tabindex="-1">
      <div class="modal-dialog">
        <div class="modal-content">
          <button type="button" class="close" data-dismiss="modal"><i class="icon-xs-o-md"></i></button>
          <div class="modal-header">
            <!-- <button type="button" class="close" data-dismiss="modal" aria-label="Close" ><span aria-hidden="true">&times;</span></button> -->
            <h4 class="modal-title caps"><strong>Add New Room</strong></h4>
          </div>
          <div class="modal-body">


            <div id="via_ue" class="row">
              <div class="col-xl-8">
                <div class="card shadow-sm border-0 p-4">
                  <h4 class="mb-3 text-primary"><i class="fas fa-door-open"></i> Room Information</h4>
                  <form method="post" id="signinform" novalidate>
                    <input type="hidden" name="signin_action" value="login">

                    <div class="row g-3">
                      <div class="col-md-6">
                        <label for="rn" class="form-label">Room Number</label>
                        <input class="form-control shadow-sm" id="rn" placeholder="Enter Room Number" type="text"
                          name="rn" required>
                      </div>

                      <div class="col-md-6">
                        <label for="ro" class="form-label">Room Occupants</label>
                        <input class="form-control shadow-sm" id="ro" placeholder="Enter Number of Occupants"
                          type="number" name="ro" required>
                      </div>

                      <div class="col-md-6">
                        <label for="rc" class="form-label">Room Cost/Rate (₱)</label>
                        <input class="form-control shadow-sm" id="rc" placeholder="Enter Cost/Rate" type="number"
                          name="rc" step="0.01" required>
                      </div>


                    </div>
                  </form>
                </div>
              </div>


              <!--             <div class="col-xs-12 col-sm-4">
              <div style="margin-top:10px;">
                <a href="#" data-toggle="modal" data-target="#signup_panel" data-dismiss="modal">Регистрация</a>
              </div>
            </div>
            <div class="col-xs-12 col-sm-4">
              <div style="margin-top:10px;">
                <a href="#" data-toggle="modal" data-target="#pass_reset" data-dismiss="modal">Забыли пароль?</a>
              </div>
            </div> -->
            </div>

          </div>
          <footer id="footer" class="footer position-relative light-background" style="padding: 10px;">
            <button class="btn btn-success" style="float: right;" form="signinform">Save</button>
            <button class="btn btn-danger" data-dismiss="modal" style="float: right;margin-right: 5px; ">Close</button>
          </footer>
        </div>

      </div>
    </div>
  </main>

  <!--   <footer id="footer" class="footer position-relative light-background foot">

    <div class="container">
      <div class="copyright text-center ">
        <p><strong class="px-1 sitename">ASystems</strong> <span>All Rights Reserved</span></p>
      </div>
      <div class="credits">
        Designed by <a href="https://bootstrapmade.com/">Adonnis Pama</a>
      </div>
    </div>

  </footer> -->

  <!-- Scroll Top -->
  <a href="#" id="scroll-top" class="scroll-top d-flex align-items-center justify-content-center"><i
      class="bi bi-arrow-up-short"></i></a>

  <!-- Preloader -->
  <div id="preloader"></div>

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

  <!-- Main JS File -->
  <script src="assets/js/main.js"></script>

</body>

</html>