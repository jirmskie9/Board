<?php
session_start();
include('../db.php');

if (!isset($_SESSION['Uid'])) {
  header("Location: ../login.php");
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
    $user_id = $user['user_id'];
    $fullname = $user['Fullname'];
  }
} else {
  header("Location: ../login.php");
  exit();
}

if (isset($_POST['svform'])) {
  $fname = $_POST['fname'];
  $lname = $_POST['lname'];
  $mname = $_POST['mname'];
  $address = $_POST['address'];
  $contact = $_POST['contact'];
  $email = $_POST['email'];
  $pname = $_POST['pname'];
  $paddress = $_POST['paddress'];
  $pcontact = $_POST['pcontact'];
  $relation = $_POST['relation'];
  $room = $_POST['room'];
  $sql = "INSERT INTO tenants (fname,lname,mname,address,contact,email,efullname,eaddress,econtact,relation,room)
VALUES ('$fname','$lname','$mname','$address','$contact','$email','$pname','$paddress','$pcontact','$relation','$room')";

  if ($conn->query($sql) === TRUE) {
    echo "New record created successfully";
  } else {
    echo "Error: " . $sql . "<br>" . $conn->error;
  }
}
if (isset($_POST['tenid'])) {
  $tenid = $_POST['tenid'];
  $billdate = $_POST['billdate'];
  $amount = $_POST['amount'];
  $sql = "INSERT INTO paymenthistory (tenantid,amount,baseddate,user)
VALUES ('$tenid','$amount','$billdate','0')";

  if ($conn->query($sql) === TRUE) {
    $sql = "UPDATE tenants SET balance=balance-'$amount' WHERE ID='$tenid'";

    if ($conn->query($sql) === TRUE) {
      echo "Record updated successfully";
    } else {
      echo "Error updating record: " . $conn->error;
    }
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

  <!-- Fonts -->
  <link href="https://fonts.googleapis.com" rel="preconnect">
  <link href="https://fonts.gstatic.com" rel="preconnect" crossorigin>
  <link
    href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Raleway:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
    rel="stylesheet">
  <!-- Bootstrap 5 CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

  <!-- Bootstrap 5 JS Bundle (includes Popper.js) -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>


  <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">


  <link href="https://demo.dashboardpack.com/architectui-html-free/main.css" rel="stylesheet">

  <!-- Main CSS File -->
  <link href="assets/css/main.css" rel="stylesheet">


  <!-- =======================================================
  * Template Name: iPortfolio
  * Template URL: https://bootstrapmade.com/iportfolio-bootstrap-portfolio-websites-template/
  * Updated: Jun 29 2024 with Bootstrap v5.3.3
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->

</head>



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
        <li><a href="Home.php" class="active"><i class="bi bi-house navicon"></i>Home</a></li>
        <li><a href="Documents.php"><i class="bi bi-file-earmark-text navicon"></i> Documents</a></li>


        <li><a href="Messages.php"><i class="bi bi-envelope navicon"></i>
            Messages</a></li>
        <li><a href="Maintenance.php"><i class="bi bi-newspaper navicon"></i>
            Maintenance Request</a></li>
        <!--         <li><a href="#portfolio"><i class="bi bi-receipt navicon"></i> Expenses</a></li>
        <li><a href="#services"><i class="bi bi-hdd-stack navicon"></i> History</a></li> -->
        <li><a href="../logout.php"><i class="bi bi-box-arrow-right navicon"></i> Logout</a></li>
      </ul>

    </nav>

  </header>
  <main class="main">
    <div class="ui-theme-settings">

      <div class="theme-settings__inner">
        <div class="scrollbar-container">
          <div class="theme-settings__options-wrapper">
            <h3 class="themeoptions-heading">Layout Options
            </h3>
            <div class="p-3">
              <ul class="list-group">
                <li class="list-group-item">
                  <div class="widget-content p-0">
                    <div class="widget-content-wrapper">
                      <div class="widget-content-left mr-3">
                        <div class="switch has-switch switch-container-class" data-class="fixed-header">
                          <div class="switch-animate switch-on">
                            <input type="checkbox" checked data-toggle="toggle" data-onstyle="success">
                          </div>
                        </div>
                      </div>
                      <div class="widget-content-left">
                        <div class="widget-heading">Fixed Header
                        </div>
                        <div class="widget-subheading">Makes the header top fixed, always
                          visible!
                        </div>
                      </div>
                    </div>
                  </div>
                </li>
                <li class="list-group-item">
                  <div class="widget-content p-0">
                    <div class="widget-content-wrapper">
                      <div class="widget-content-left mr-3">
                        <div class="switch has-switch switch-container-class" data-class="fixed-sidebar">
                          <div class="switch-animate switch-on">
                            <input type="checkbox" checked data-toggle="toggle" data-onstyle="success">
                          </div>
                        </div>
                      </div>
                      <div class="widget-content-left">
                        <div class="widget-heading">Fixed Sidebar
                        </div>
                        <div class="widget-subheading">Makes the sidebar left fixed, always
                          visible!
                        </div>
                      </div>
                    </div>
                  </div>
                </li>
                <li class="list-group-item">
                  <div class="widget-content p-0">
                    <div class="widget-content-wrapper">
                      <div class="widget-content-left mr-3">
                        <div class="switch has-switch switch-container-class" data-class="fixed-footer">
                          <div class="switch-animate switch-off">
                            <input type="checkbox" data-toggle="toggle" data-onstyle="success">
                          </div>
                        </div>
                      </div>
                      <div class="widget-content-left">
                        <div class="widget-heading">Fixed Footer
                        </div>
                        <div class="widget-subheading">Makes the app footer bottom fixed, always
                          visible!
                        </div>
                      </div>
                    </div>
                  </div>
                </li>
              </ul>
            </div>
            <h3 class="themeoptions-heading">
              <div>
                Header Options
              </div>
              <button type="button"
                class="btn-pill btn-shadow btn-wide ml-auto btn btn-focus btn-sm switch-header-cs-class" data-class="">
                Restore Default
              </button>
            </h3>
            <div class="p-3">
              <ul class="list-group">
                <li class="list-group-item">
                  <h5 class="pb-2">Choose Color Scheme
                  </h5>
                  <div class="theme-settings-swatches">
                    <div class="swatch-holder bg-primary switch-header-cs-class"
                      data-class="bg-primary header-text-light">
                    </div>
                    <div class="swatch-holder bg-secondary switch-header-cs-class"
                      data-class="bg-secondary header-text-light">
                    </div>
                    <div class="swatch-holder bg-success switch-header-cs-class"
                      data-class="bg-success header-text-dark">
                    </div>
                    <div class="swatch-holder bg-info switch-header-cs-class" data-class="bg-info header-text-dark">
                    </div>
                    <div class="swatch-holder bg-warning switch-header-cs-class"
                      data-class="bg-warning header-text-dark">
                    </div>
                    <div class="swatch-holder bg-danger switch-header-cs-class"
                      data-class="bg-danger header-text-light">
                    </div>
                    <div class="swatch-holder bg-light switch-header-cs-class" data-class="bg-light header-text-dark">
                    </div>
                    <div class="swatch-holder bg-dark switch-header-cs-class" data-class="bg-dark header-text-light">
                    </div>
                    <div class="swatch-holder bg-focus switch-header-cs-class" data-class="bg-focus header-text-light">
                    </div>
                    <div class="swatch-holder bg-alternate switch-header-cs-class"
                      data-class="bg-alternate header-text-light">
                    </div>
                    <div class="divider">
                    </div>
                    <div class="swatch-holder bg-vicious-stance switch-header-cs-class"
                      data-class="bg-vicious-stance header-text-light">
                    </div>
                    <div class="swatch-holder bg-midnight-bloom switch-header-cs-class"
                      data-class="bg-midnight-bloom header-text-light">
                    </div>
                    <div class="swatch-holder bg-night-sky switch-header-cs-class"
                      data-class="bg-night-sky header-text-light">
                    </div>
                    <div class="swatch-holder bg-slick-carbon switch-header-cs-class"
                      data-class="bg-slick-carbon header-text-light">
                    </div>
                    <div class="swatch-holder bg-asteroid switch-header-cs-class"
                      data-class="bg-asteroid header-text-light">
                    </div>
                    <div class="swatch-holder bg-royal switch-header-cs-class" data-class="bg-royal header-text-light">
                    </div>
                    <div class="swatch-holder bg-warm-flame switch-header-cs-class"
                      data-class="bg-warm-flame header-text-dark">
                    </div>
                    <div class="swatch-holder bg-night-fade switch-header-cs-class"
                      data-class="bg-night-fade header-text-dark">
                    </div>
                    <div class="swatch-holder bg-sunny-morning switch-header-cs-class"
                      data-class="bg-sunny-morning header-text-dark">
                    </div>
                    <div class="swatch-holder bg-tempting-azure switch-header-cs-class"
                      data-class="bg-tempting-azure header-text-dark">
                    </div>
                    <div class="swatch-holder bg-amy-crisp switch-header-cs-class"
                      data-class="bg-amy-crisp header-text-dark">
                    </div>
                    <div class="swatch-holder bg-heavy-rain switch-header-cs-class"
                      data-class="bg-heavy-rain header-text-dark">
                    </div>
                    <div class="swatch-holder bg-mean-fruit switch-header-cs-class"
                      data-class="bg-mean-fruit header-text-dark">
                    </div>
                    <div class="swatch-holder bg-malibu-beach switch-header-cs-class"
                      data-class="bg-malibu-beach header-text-light">
                    </div>
                    <div class="swatch-holder bg-deep-blue switch-header-cs-class"
                      data-class="bg-deep-blue header-text-dark">
                    </div>
                    <div class="swatch-holder bg-ripe-malin switch-header-cs-class"
                      data-class="bg-ripe-malin header-text-light">
                    </div>
                    <div class="swatch-holder bg-arielle-smile switch-header-cs-class"
                      data-class="bg-arielle-smile header-text-light">
                    </div>
                    <div class="swatch-holder bg-plum-plate switch-header-cs-class"
                      data-class="bg-plum-plate header-text-light">
                    </div>
                    <div class="swatch-holder bg-happy-fisher switch-header-cs-class"
                      data-class="bg-happy-fisher header-text-dark">
                    </div>
                    <div class="swatch-holder bg-happy-itmeo switch-header-cs-class"
                      data-class="bg-happy-itmeo header-text-light">
                    </div>
                    <div class="swatch-holder bg-mixed-hopes switch-header-cs-class"
                      data-class="bg-mixed-hopes header-text-light">
                    </div>
                    <div class="swatch-holder bg-strong-bliss switch-header-cs-class"
                      data-class="bg-strong-bliss header-text-light">
                    </div>
                    <div class="swatch-holder bg-grow-early switch-header-cs-class"
                      data-class="bg-grow-early header-text-light">
                    </div>
                    <div class="swatch-holder bg-love-kiss switch-header-cs-class"
                      data-class="bg-love-kiss header-text-light">
                    </div>
                    <div class="swatch-holder bg-premium-dark switch-header-cs-class"
                      data-class="bg-premium-dark header-text-light">
                    </div>
                    <div class="swatch-holder bg-happy-green switch-header-cs-class"
                      data-class="bg-happy-green header-text-light">
                    </div>
                  </div>
                </li>
              </ul>
            </div>
            <h3 class="themeoptions-heading">
              <div>Sidebar Options</div>
              <button type="button"
                class="btn-pill btn-shadow btn-wide ml-auto btn btn-focus btn-sm switch-sidebar-cs-class" data-class="">
                Restore Default
              </button>
            </h3>
            <div class="p-3">
              <ul class="list-group">
                <li class="list-group-item">
                  <h5 class="pb-2">Choose Color Scheme
                  </h5>
                  <div class="theme-settings-swatches">
                    <div class="swatch-holder bg-primary switch-sidebar-cs-class"
                      data-class="bg-primary sidebar-text-light">
                    </div>
                    <div class="swatch-holder bg-secondary switch-sidebar-cs-class"
                      data-class="bg-secondary sidebar-text-light">
                    </div>
                    <div class="swatch-holder bg-success switch-sidebar-cs-class"
                      data-class="bg-success sidebar-text-dark">
                    </div>
                    <div class="swatch-holder bg-info switch-sidebar-cs-class" data-class="bg-info sidebar-text-dark">
                    </div>
                    <div class="swatch-holder bg-warning switch-sidebar-cs-class"
                      data-class="bg-warning sidebar-text-dark">
                    </div>
                    <div class="swatch-holder bg-danger switch-sidebar-cs-class"
                      data-class="bg-danger sidebar-text-light">
                    </div>
                    <div class="swatch-holder bg-light switch-sidebar-cs-class" data-class="bg-light sidebar-text-dark">
                    </div>
                    <div class="swatch-holder bg-dark switch-sidebar-cs-class" data-class="bg-dark sidebar-text-light">
                    </div>
                    <div class="swatch-holder bg-focus switch-sidebar-cs-class"
                      data-class="bg-focus sidebar-text-light">
                    </div>
                    <div class="swatch-holder bg-alternate switch-sidebar-cs-class"
                      data-class="bg-alternate sidebar-text-light">
                    </div>
                    <div class="divider">
                    </div>
                    <div class="swatch-holder bg-vicious-stance switch-sidebar-cs-class"
                      data-class="bg-vicious-stance sidebar-text-light">
                    </div>
                    <div class="swatch-holder bg-midnight-bloom switch-sidebar-cs-class"
                      data-class="bg-midnight-bloom sidebar-text-light">
                    </div>
                    <div class="swatch-holder bg-night-sky switch-sidebar-cs-class"
                      data-class="bg-night-sky sidebar-text-light">
                    </div>
                    <div class="swatch-holder bg-slick-carbon switch-sidebar-cs-class"
                      data-class="bg-slick-carbon sidebar-text-light">
                    </div>
                    <div class="swatch-holder bg-asteroid switch-sidebar-cs-class"
                      data-class="bg-asteroid sidebar-text-light">
                    </div>
                    <div class="swatch-holder bg-royal switch-sidebar-cs-class"
                      data-class="bg-royal sidebar-text-light">
                    </div>
                    <div class="swatch-holder bg-warm-flame switch-sidebar-cs-class"
                      data-class="bg-warm-flame sidebar-text-dark">
                    </div>
                    <div class="swatch-holder bg-night-fade switch-sidebar-cs-class"
                      data-class="bg-night-fade sidebar-text-dark">
                    </div>
                    <div class="swatch-holder bg-sunny-morning switch-sidebar-cs-class"
                      data-class="bg-sunny-morning sidebar-text-dark">
                    </div>
                    <div class="swatch-holder bg-tempting-azure switch-sidebar-cs-class"
                      data-class="bg-tempting-azure sidebar-text-dark">
                    </div>
                    <div class="swatch-holder bg-amy-crisp switch-sidebar-cs-class"
                      data-class="bg-amy-crisp sidebar-text-dark">
                    </div>
                    <div class="swatch-holder bg-heavy-rain switch-sidebar-cs-class"
                      data-class="bg-heavy-rain sidebar-text-dark">
                    </div>
                    <div class="swatch-holder bg-mean-fruit switch-sidebar-cs-class"
                      data-class="bg-mean-fruit sidebar-text-dark">
                    </div>
                    <div class="swatch-holder bg-malibu-beach switch-sidebar-cs-class"
                      data-class="bg-malibu-beach sidebar-text-light">
                    </div>
                    <div class="swatch-holder bg-deep-blue switch-sidebar-cs-class"
                      data-class="bg-deep-blue sidebar-text-dark">
                    </div>
                    <div class="swatch-holder bg-ripe-malin switch-sidebar-cs-class"
                      data-class="bg-ripe-malin sidebar-text-light">
                    </div>
                    <div class="swatch-holder bg-arielle-smile switch-sidebar-cs-class"
                      data-class="bg-arielle-smile sidebar-text-light">
                    </div>
                    <div class="swatch-holder bg-plum-plate switch-sidebar-cs-class"
                      data-class="bg-plum-plate sidebar-text-light">
                    </div>
                    <div class="swatch-holder bg-happy-fisher switch-sidebar-cs-class"
                      data-class="bg-happy-fisher sidebar-text-dark">
                    </div>
                    <div class="swatch-holder bg-happy-itmeo switch-sidebar-cs-class"
                      data-class="bg-happy-itmeo sidebar-text-light">
                    </div>
                    <div class="swatch-holder bg-mixed-hopes switch-sidebar-cs-class"
                      data-class="bg-mixed-hopes sidebar-text-light">
                    </div>
                    <div class="swatch-holder bg-strong-bliss switch-sidebar-cs-class"
                      data-class="bg-strong-bliss sidebar-text-light">
                    </div>
                    <div class="swatch-holder bg-grow-early switch-sidebar-cs-class"
                      data-class="bg-grow-early sidebar-text-light">
                    </div>
                    <div class="swatch-holder bg-love-kiss switch-sidebar-cs-class"
                      data-class="bg-love-kiss sidebar-text-light">
                    </div>
                    <div class="swatch-holder bg-premium-dark switch-sidebar-cs-class"
                      data-class="bg-premium-dark sidebar-text-light">
                    </div>
                    <div class="swatch-holder bg-happy-green switch-sidebar-cs-class"
                      data-class="bg-happy-green sidebar-text-light">
                    </div>
                  </div>
                </li>
              </ul>
            </div>
            <h3 class="themeoptions-heading">
              <div>Main Content Options</div>
              <button type="button" class="btn-pill btn-shadow btn-wide ml-auto active btn btn-focus btn-sm">Restore
                Default
              </button>
            </h3>
            <div class="p-3">
              <ul class="list-group">
                <li class="list-group-item">
                  <h5 class="pb-2">Page Section Tabs
                  </h5>
                  <div class="theme-settings-swatches">
                    <div role="group" class="mt-2 btn-group">
                      <button type="button" class="btn-wide btn-shadow btn-primary btn btn-secondary switch-theme-class"
                        data-class="body-tabs-line">
                        Line
                      </button>
                      <button type="button"
                        class="btn-wide btn-shadow btn-primary active btn btn-secondary switch-theme-class"
                        data-class="body-tabs-shadow">
                        Shadow
                      </button>
                    </div>
                  </div>
                </li>
              </ul>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="app-main">

      <div class="app-main__outer">
        <div class="app-main__inner">
          <div class="app-page-title">
            <div class="page-title-wrapper">
              <div class="page-title-heading">
                <div class="page-title-icon">
                  <i class="fas fa-home icon-gradient bg-mean-fruit"></i> <!-- Changed to FontAwesome Home Icon -->
                </div>
                <div>Welcome to Primos Boardinghouse
                  <div class="page-title-subheading">
                    This is an overview of all data in Primos Boardinghouse.
                  </div>
                </div>
              </div>

              <!-- Include FontAwesome for icons -->
              <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">


            </div>
          </div>
          <div class="row">
            <?php

            $current_year = date("Y");
            $sql = "SELECT SUM(amount) AS total_expenses FROM expenses";
            $stmt = $conn->prepare($sql);
            $stmt->execute();
            $result = $stmt->get_result();

            $total_expenses = 0; // Default value
            if ($result->num_rows > 0) {
              $row = $result->fetch_assoc();
              $total_expenses = $row['total_expenses'] ?? 0;
            }

            $stmt->close();

            ?>

            <div class="col-md-6 col-xl-4">
              <div class="card mb-3 widget-content bg-midnight-bloom">
                <div class="widget-content-wrapper text-white">
                  <div class="widget-content-left">
                    <div class="widget-heading">Current Balance</div>
                    <!-- <div class="widget-subheading">Current Year Expenses</div> -->
                  </div>
                  <div class="widget-content-right">
                    <div class="widget-numbers text-white">
                      <span>&#8369; <?php echo number_format($total_expenses, 2); ?></span>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <?php

            $sql = "SELECT date_started FROM lease";
            $result = $conn->query($sql);

            $days = 0; // Default value
            
            if ($result->num_rows > 0) {
              $row = $result->fetch_assoc();
              $date_started = $row['date_started'];

              // Convert date_started to a DateTime object
              $start_date = new DateTime($date_started);
              $current_date = new DateTime(); // Current date
            
              // Calculate the difference in days
              $interval = $start_date->diff($current_date);
              $days = $interval->days; // Get total days difference
            }
            ?>

            <div class="col-md-6 col-xl-4">
              <div class="card mb-3 widget-content bg-arielle-smile">
                <div class="widget-content-wrapper text-white">
                  <div class="widget-content-left">
                    <div class="widget-heading">Days Stays</div>
                    <div class="widget-subheading">Total Days of Stays</div>
                  </div>
                  <div class="widget-content-right">
                    <div class="widget-numbers text-white">
                      <span><?php echo $days; ?></span>
                    </div>
                  </div>
                </div>
              </div>
            </div>



            <?php

            $my_room = "N/A"; // Default value in case no room is found
            

            $sql = "SELECT room FROM tenants WHERE id = '$user_id'";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
              $row = $result->fetch_assoc();
              $my_room = $row['room']; // Store the room number
            }

            ?>

            <div class="col-md-6 col-xl-4">
              <div class="card mb-3 widget-content bg-grow-early">
                <div class="widget-content-wrapper text-white">
                  <div class="widget-content-left">
                    <div class="widget-heading">Current Room #</div>
                    <div class="widget-subheading">Current room stayed.</div>
                  </div>
                  <div class="widget-content-right">
                    <div class="widget-numbers text-white">
                      <span><?php echo $my_room; ?></span>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <div class="d-xl-none d-lg-block col-md-6 col-xl-4">
              <div class="card mb-3 widget-content bg-premium-dark">
                <div class="widget-content-wrapper text-white">
                  <div class="widget-content-left">
                    <div class="widget-heading">Room Occupied</div>
                    <div class="widget-subheading">Total Occupied Room</div>
                  </div>
                  <div class="widget-content-right">
                    <div class="widget-numbers text-warning"><span>5 Rooms</span></div>
                  </div>
                </div>
              </div>
          </div>
          <div class="row">
            <div class="col-md-6">
              <div class="mb-3 card shadow-lg rounded">
                <div class="card-header bg-primary text-white d-flex align-items-center">
                  <i class="fas fa-wallet me-2 fs-5"></i>
                  <h5 class="mb-0">Pending Payment</h5>
                </div>
                <div class="card-body">
                  <?php
                  if (isset($user_id)) {
                    // Fetch the total amount from bills
                    $sql_bills = "SELECT COALESCE(SUM(amount), 0) AS total_bills FROM bills WHERE tenantid = ?";
                    $stmt_bills = $conn->prepare($sql_bills);
                    $stmt_bills->bind_param("i", $user_id);
                    $stmt_bills->execute();
                    $result_bills = $stmt_bills->get_result();
                    $bills = $result_bills->fetch_assoc();
                    $totalBills = $bills['total_bills'];

                    // Fetch the total amount paid from paymenthistory
                    $sql_payments = "SELECT COALESCE(SUM(amount), 0) AS total_payments FROM paymenthistory WHERE tenantid = ?";
                    $stmt_payments = $conn->prepare($sql_payments);
                    $stmt_payments->bind_param("i", $user_id);
                    $stmt_payments->execute();
                    $result_payments = $stmt_payments->get_result();
                    $payments = $result_payments->fetch_assoc();
                    $totalPayments = $payments['total_payments'];

                    // Calculate the remaining balance
                    $totalDue = $totalBills - $totalPayments;

                    $stmt_bills->close();
                    $stmt_payments->close();

                    if ($totalDue > 0) {
                      $formattedTotalDue = number_format($totalDue, 2);
                      echo "
                      <div class='d-flex justify-content-between align-items-center'>
                          <h5 class='text-dark fw-bold'>₱{$formattedTotalDue}</h5>
                          <span class='badge bg-warning text-dark'>Pending Payment</span>
                      </div>
                      <p class='text-muted mt-2'>Please settle your outstanding balance as soon as possible.</p>
                      <div class='text-end'>
                          <a href='payment_page.php' class='btn btn-success btn-sm'>
                              <i class='fas fa-credit-card me-1'></i> Pay Now
                          </a>
                      </div>";
                    } else {
                      echo "<p class='text-muted text-center'>No pending payments.</p>";
                    }
                  } else {
                    echo "<p class='text-danger text-center'>User ID not found.</p>";
                  }
                  ?>

                </div>
              </div>
            </div>



            <div class="col-md-6">
              <?php
              // Ensure user ID is set
              if (isset($uid)) {
                // Fetch lease agreement content
                $sql = "SELECT lease_id FROM lease WHERE user_id = ?";
                $stmt = $conn->prepare($sql);
                $stmt->bind_param("i", $user_id); // Changed $user_id to $uid to match the variable name
                $stmt->execute();
                $result = $stmt->get_result();
                $lease = $result->fetch_assoc();

                if ($lease) {
                  $leaseId = $lease['lease_id'];
                  $showSignButton = true;
                } else {
                  $showSignButton = false;
                }
              } else {
                $showSignButton = false;
              }
              ?>

              <div class="mb-3 card shadow-lg rounded border">
                <div class="card-header bg-success text-white d-flex align-items-center">
                  <i class="fas fa-file-signature me-2 fs-5"></i>
                  <h5 class="mb-0">Lease Agreement</h5>
                </div>
                <div class="card-body text-center">
                  <?php if ($showSignButton): ?>
                    <p class="text-muted">You have a lease agreement.</p>
                    <a href="sign_agreement.php?lease_id=<?php echo $leaseId; ?>" class="btn btn-primary">
                      <i class="fas fa-pen-nib me-2"></i> Sign Agreement
                    </a>
                  <?php else: ?>
                    <p class="text-muted">No lease agreement pending for signature.</p>
                  <?php endif; ?>
                </div>
              </div>
            </div>

            <!-- Include FontAwesome for icons -->
            <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">




            <div class="row">
              <div class="col-md-6">
                <div class="mb-3 card shadow-lg rounded">
                  <div class="card-header bg-info text-white d-flex align-items-center">
                    <i class="fas fa-history me-2"></i>
                    <h5 class="mb-0">Payment History</h5>
                  </div>
                  <div class="card-body">
                    <table class="table table-striped table-hover">
                      <thead class="table-primary">
                        <tr>
                          <th>#</th>
                          <th>Amount</th>

                          <th>Payment Date</th>

                        </tr>
                      </thead>
                      <tbody>
                        <?php

                        $sql = "SELECT p.tenantid, p.amount, p.baseddate, t.ID, t.fname, t.lname FROM paymenthistory p
                                        JOIN tenants t ON p.tenantid = t.ID WHERE p.tenantid = '$user_id' ORDER BY p.baseddate DESC";
                        $result = $conn->query($sql);
                        $count = 1;

                        if ($result->num_rows > 0) {
                          while ($row = $result->fetch_assoc()) {
                            echo "<tr>
                                        <td>{$count}</td>
                                        <td>₱" . number_format($row['amount'], 2) . "</td>
                                   
                                        <td>" . date("F d, Y h:i A", strtotime($row['baseddate'])) . "</td>
                                    
                                      </tr>";
                            $count++;
                          }
                        } else {
                          echo "<tr><td colspan='5' class='text-center'>No payment records found</td></tr>";
                        }
                        ?>
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
              <div class="col-md-6">
                <div class="mb-3 card shadow-lg rounded">
                  <div class="card-header bg-info text-white d-flex align-items-center">
                    <i class="fas fa-file-alt me-2"></i>
                    <h5 class="mb-0">Applications</h5>

                  </div>
                  <div class="card-body">
                    <div class="table-responsive shadow-sm p-3 bg-white rounded">


                      <table class="table table-bordered table-striped">
                        <thead style="background-color: #e9ecef;"> <!-- Table header styling -->
                          <tr>
                            <th>Proof</th>
                            <th>Valid ID</th>
                            <th>Status</th>
                          </tr>
                        </thead>
                        <tbody>
                          <?php
                          $sql = "SELECT * FROM applications WHERE status = 'pending' AND user_id = '$user_id'";
                          $result = $conn->query($sql);

                          if ($result->num_rows > 0) {
                            while ($row = $result->fetch_assoc()) {
                              echo "<tr>";
                              echo "<td><a href='#' class='upload-link' data-userid='{$row['user_id']}' data-field='proof'>Upload Proof of Income</a></td>";
                              echo "<td><a href='#' class='upload-link' data-userid='{$row['user_id']}' data-field='valid_id'>Upload Valid ID</a></td>";
                              echo "<td><span style='background-color: #ffc107; color: black; padding: 5px 10px; border-radius: 5px;'>{$row['status']}</span></td>";
                              echo "</tr>";
                            }
                          } else {
                            echo "<tr><td colspan='3' style='text-align: center;'>No pending applications found.</td></tr>";
                          }
                          ?>
                        </tbody>
                      </table>

                      <!-- Modal (No Bootstrap) -->
                      <!-- Modal -->
                      <div id="uploadModal" class="modal">
                        <div class="modal-content">
                          <span class="close" onclick="closeModal()">&times;</span>
                          <h2 class="modal-title">Upload Document</h2>
                          <p class="modal-description">Please upload the required document below.</p>

                          <form action="upload_application_file.php" method="POST" enctype="multipart/form-data">
                            <input type="hidden" name="user_id" id="modal_user_id">
                            <input type="hidden" name="field_name" id="modal_field_name">

                            <label for="file_upload" class="file-label">Choose File</label>
                            <input type="file" name="file_upload" id="file_upload" class="file-input" required>

                            <div class="modal-footer">
                              <button type="button" class="btn btn-secondary" onclick="closeModal()">Cancel</button>
                              <button type="submit" class="btn btn-primary">Upload</button>
                            </div>
                          </form>
                        </div>
                      </div>


                      <!-- Modal Styling (No Bootstrap) -->
                      <style>
                        /* --- MODAL STYLING --- */

                        .modal {
                          display: none;
                          /* Ensure modal is hidden initially */
                          position: fixed;
                          z-index: 1000;
                          left: 0;
                          top: 0;
                          width: 100%;
                          height: 100%;
                          background-color: rgba(0, 0, 0, 0.5);
                          justify-content: center;
                          align-items: center;
                        }

                        /* Modal Content */
                        .modal-content {
                          background: white;
                          width: 400px;
                          padding: 25px;
                          border-radius: 12px;
                          box-shadow: 0px 4px 15px rgba(0, 0, 0, 0.2);
                          text-align: center;
                          position: relative;
                          animation: fadeIn 0.3s ease-in-out;
                        }

                        /* Fade-in Animation */
                        @keyframes fadeIn {
                          from {
                            opacity: 0;
                            transform: translateY(-10px);
                          }

                          to {
                            opacity: 1;
                            transform: translateY(0);
                          }
                        }

                        /* Close Button */
                        .close {
                          position: absolute;
                          top: 12px;
                          right: 18px;
                          font-size: 24px;
                          cursor: pointer;
                          color: #555;
                          transition: 0.3s;
                        }

                        .close:hover {
                          color: red;
                        }

                        /* Modal Title */
                        .modal-title {
                          font-size: 22px;
                          font-weight: bold;
                          margin-bottom: 8px;
                          color: #333;
                        }

                        /* Modal Description */
                        .modal-description {
                          font-size: 14px;
                          color: #666;
                          margin-bottom: 15px;
                        }

                        /* File Input */
                        .file-label {
                          font-size: 14px;
                          font-weight: bold;
                          display: block;
                          margin-bottom: 8px;
                          color: #444;
                        }

                        .file-input {
                          width: 100%;
                          padding: 10px;
                          border: 1px solid #ccc;
                          border-radius: 6px;
                          font-size: 14px;
                        }

                        /* Modal Footer (Buttons) */
                        .modal-footer {
                          margin-top: 20px;
                          display: flex;
                          justify-content: space-between;
                        }

                        /* Buttons */
                        .btn {
                          padding: 10px 16px;
                          border: none;
                          cursor: pointer;
                          border-radius: 6px;
                          font-size: 14px;
                          transition: 0.3s;
                        }

                        .btn-secondary {
                          background-color: #6c757d;
                          color: white;
                        }

                        .btn-secondary:hover {
                          background-color: #5a6268;
                        }

                        .btn-primary {
                          background-color: #007bff;
                          color: white;
                        }

                        .btn-primary:hover {
                          background-color: #0056b3;
                        }
                      </style>

                      <!-- JavaScript for Modal (No Bootstrap) -->
                      <script>
                        function openModal(userId, field) {
                          document.getElementById('modal_user_id').value = userId;
                          document.getElementById('modal_field_name').value = field;
                          document.getElementById('uploadModal').style.display = 'flex';
                        }

                        function closeModal() {
                          document.getElementById('uploadModal').style.display = 'none';
                        }

                        // Close modal when clicking outside the content
                        window.onclick = function (event) {
                          var modal = document.getElementById('uploadModal');
                          if (event.target === modal) {
                            modal.style.display = 'none';
                          }
                        };

                        // Attach event listeners to links
                        document.querySelectorAll('.upload-link').forEach(link => {
                          link.addEventListener('click', function (e) {
                            e.preventDefault();
                            openModal(this.getAttribute('data-userid'), this.getAttribute('data-field'));
                          });
                        });
                      </script>




                    </div>

                    <!--                     <div class="app-wrapper-footer">
                        <div class="app-footer">
                            <div class="app-footer__inner">
                                <div class="app-footer-left">
                                    <ul class="nav">
                                        <li class="nav-item">
                                            <a href="javascript:void(0);" class="nav-link">
                                                Footer Link 1
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="javascript:void(0);" class="nav-link">
                                                Footer Link 2
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                                <div class="app-footer-right">
                                    <ul class="nav">
                                        <li class="nav-item">
                                            <a href="javascript:void(0);" class="nav-link">
                                                Footer Link 3
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="javascript:void(0);" class="nav-link">
                                                <div class="badge badge-success mr-1 ml-0">
                                                    <small>NEW</small>
                                                </div>
                                                Footer Link 4
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>   -->

                  </div>
                </div>
                <div class="row">


                  <script src="http://maps.google.com/maps/api/js?sensor=true"></script>
                </div>
                <script type="text/javascript"
                  src="https://demo.dashboardpack.com/architectui-html-free/assets/scripts/main.js"></script>
  </main>


  <script>
    document.addEventListener("DOMContentLoaded", function () {
      const uploadLinks = document.querySelectorAll(".upload-link");

      uploadLinks.forEach(link => {
        link.addEventListener("click", function () {
          const userId = this.getAttribute("data-userid");
          const fieldName = this.getAttribute("data-field");

          document.getElementById("modal_user_id").value = userId;
          document.getElementById("modal_field_name").value = fieldName;
        });
      });
    });
  </script>



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






  <!-- Main JS File -->
  <script src="assets/js/main.js"></script>
  <!-- <script type="text/javascript">
    function showDiv(select) {
      if (select.value != 0) {
        var val = document.getElementById("test").value;
        // window.location.href = "#item=" + val; 
        var new_url = "./Occupants.php?item=" + val;
        window.history.pushState(null, "", new_url);
        document.getElementById('hidden_div').style.display = "block";
      } else {
        document.getElementById('hidden_div').style.display = "none";
      }
    } 
  </script>

  <script>
    var rowCount = $('#tbl >tbody >tr').length;
    $("#rowcount").text(rowCount);
  </script>
  <script>
    var within_first_modal = false;
    $('.btn-second-modal').on('click', function () {
      if ($(this).hasClass('within-first-modal')) {
        within_first_modal = true;
        $('#first-modal').modal('hide');
      }
      $('#second-modal').modal('show');
    });

    $('.btn-second-modal-close').on('click', function () {
      $('#second-modal').modal('hide');
      if (within_first_modal) {
        $('#first-modal').modal('show');
        within_first_modal = false;
      }
    });

    $('.btn-toggle-fade').on('click', function () {
      if ($('.modal').hasClass('fade')) {
        $('.modal').removeClass('fade');
        $(this).removeClass('btn-success');
      } else {
        $('.modal').addClass('fade');
        $(this).addClass('btn-success');
      }
    });
  </script>
  <script>
    var table document.getElementById('bills');
    var total = table.rows.length;
    var tb = table.tBodies[0].row.length;
  </script>
  <script>
    $(document).ready(function () {

      if (window.location.href.indexOf('#pay') != -1) {
        $('#pay').modal('show');
      }

    });
  </script>
  <script>
    $(document).ready(function () {

      if (window.location.href.indexOf('#bayad') != -1) {
        $('#bayad').modal('show');
      }

    });
  </script>
  <script>
    const input = document.querySelector('input')
    const output = document.querySelector('output')

    // Format the input value to ensure 2 decimal places
    const formatValue = () => {
      if (input.value !== '' && !isNaN(input.value)) {
        input.value = Math.abs(Number(input.value)).toFixed(2)
        updateOutput()
      }
    }

    // Show the cents
    const updateOutput = () => {
      const value = input.value !== '' ? Math.trunc(Math.abs(Number(input.value) * 100)) : 0
      output.innerHTML = `cents = ${value}`
    }

    input.addEventListener('change', formatValue)
    input.addEventListener('input', updateOutput)

    updateValue()
    updateOutput()
  </script>
  <script>
    updateSubTotal(); // Initial call

    function updateSubTotal() {
      var table = document.getElementById("bills");
      let subTotal = Array.from(table.rows).slice(1).reduce((total, row) => {
        return total + parseFloat(row.cells[2].innerHTML);
      }, 0);
      document.getElementById("totsum").innerHTML = subTotal;
    }

  </script> -->
  <?php
  if (isset($_SESSION['status']) && $_SESSION['status'] != '') {
    ?>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
      Swal.fire({
        title: "<?php echo $_SESSION['status']; ?>",
        icon: "<?php echo $_SESSION['status_code']; ?>",
        confirmButtonText: "<?php echo $_SESSION['status_button'] ?? 'OK'; ?>"
      });
    </script>
    <?php
    unset($_SESSION['status']);
    unset($_SESSION['status_code']);
    unset($_SESSION['status_button']);
  }
  ?>

</body>

</html>