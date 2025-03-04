<?php
session_start();
include('db.php');
if (isset($_GET['tenantid'])) {
  $_SESSION['tenantid'] = $_GET['tenantid'];
}

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


if ($_SERVER["REQUEST_METHOD"] == "POST") {
  // Accept Request
  if (isset($_POST['acceptreq'])) {
      $id = $_POST['acceptreq'];

      $stmt = $conn->prepare("UPDATE maintenance SET status='Accepted' WHERE ID=?");
      $stmt->bind_param("i", $id);

      if ($stmt->execute()) {
          $_SESSION['status'] = "Request accepted successfully!";
          $_SESSION['status_code'] = "success";
          $_SESSION['status_button'] = "Okay";
      } else {
          $_SESSION['status'] = "Error updating request: " . $stmt->error;
          $_SESSION['status_code'] = "error";
          $_SESSION['status_button'] = "Try Again";
      }
      $stmt->close();


  }

  // Decline Request
  if (isset($_POST['decreq'])) {
      $id = $_POST['decreq'];

      $stmt = $conn->prepare("UPDATE maintenance SET status='Declined' WHERE ID=?");
      $stmt->bind_param("i", $id);

      if ($stmt->execute()) {
          $_SESSION['status'] = "Request declined successfully!";
          $_SESSION['status_code'] = "success";
          $_SESSION['status_button'] = "Okay";
      } else {
          $_SESSION['status'] = "Error updating request: " . $stmt->error;
          $_SESSION['status_code'] = "error";
          $_SESSION['status_button'] = "Try Again";
      }
      $stmt->close();

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

  <!-- Vendor CSS Files -->
  <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.min.css" rel="stylesheet">
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

  .css-serial {
    counter-reset: serial-number;
    /* Set the serial number counter to 0 */
  }

  .css-serial td:first-child:before {
    counter-increment: serial-number;
    /* Increment the serial number counter */
    content: counter(serial-number);
    /* Display the counter */
  }

  #bills {
    counter-reset: serial-number;
    /* Set the serial number counter to 0 */
  }

  #bills td:first-child:before {
    counter-increment: serial-number;
    /* Increment the serial number counter */
    content: counter(serial-number);
    /* Display the counter */
  }

  @media (min-width: 1200px) {
    .container {
      width: 470px;
    }
  }

  .modalDialog {
    position: fixed;
    top: 0;
    right: 0;
    bottom: 0;
    left: 0;
    background: rgba(0, 0, 0, 0.8);
    z-index: 999;
    opacity: 0;
    -webkit-transition: opacity 100ms ease-in;
    -moz-transition: opacity 100ms ease-in;
    transition: opacity 100ms ease-in;
    pointer-events: none;
    overflow-y: scroll;
  }

  .modalDialog:target {
    opacity: 1;
    pointer-events: auto;
  }

  .modalDialog>div {
    max-width: 800px;
    width: 48%;
    height: 900px;
    position: relative;
    margin: 2% auto;
    padding: 20px;
    border-radius: 3px;
    background: #fff;
  }

  .closex {
    font-family: Arial, Helvetica, sans-serif;
    background: #f26d7d;
    color: #fff;
    line-height: 25px;
    position: absolute;
    right: -12px;
    text-align: center;
    top: -10px;
    width: 34px;
    height: 34px;
    text-decoration: none;
    font-weight: bold;
    -webkit-border-radius: 50%;
    -moz-border-radius: 50%;
    border-radius: 50%;
    -moz-box-shadow: 1px 1px 3px #000;
    -webkit-box-shadow: 1px 1px 3px #000;
    box-shadow: 1px 1px 3px #000;
    padding-top: 5px;
  }

  .closex:hover {
    background: #fa3f6f;
  }

  div {
    position: relative;
  }

  .right span {
    left: initial;
    right: .9em;
  }

  input {
    -moz-appearance: textfield;
    font: inherit;
    padding: .6em .9em;
    border-radius: .6em;
    border: 1px solid darkgray;
    padding-inline: 2em .9em;
    width: 25em;
  }

  input:invalid {
    border-color: orangered;
    color: crimson;
  }

  .right input {
    padding-inline: .9em 2em;
  }

  input::-webkit-outer-spin-button,
  input::-webkit-inner-spin-button {
    -webkit-appearance: none;
    margin: 0;
  }

  output {
    font-family: monospace;
    font-size: 1.2em;
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
        <li><a href="./Rooms.php"><i class="bi bi-door-open navicon"></i> Rooms</a></li>
        <li><a href="./Utilities.php"><i class="bi bi-lightbulb navicon"></i> <!-- Represents electricity/utilities -->
            Utility Bills</a></li>
        <li><a href="./expenses.php"><i class="bi bi-receipt navicon"></i> Expenses</a></li>
        <li><a href="./Collection.php" class=""><i class="bi bi-cash-stack navicon"></i>Rent Collection</a></li>
        <li><a href="./Messages.php"><i class="fa fa-envelope"></i> Messages</a></li>
        <li><a href="./Maintenance.php" class="active"><i class="bi bi-newspaper navicon"></i> Maintenance Request</a>

        <li><a href="./logout.php"><i class="bi bi-box-arrow-right navicon"></i> Logout</a></li>
        </li>
      </ul>

    </nav>

  </header>

  <main class="main col-lg-9">
    <div class="page-title">
      <!-- <h1>Boarders/Occupants</h1> -->
    </div>
    <div class="p-1 bg-light rounded rounded-pill shadow-sm mb-4" style="width: 55%; float: left;">
      <div class="input-group">
        <input type="search" style="width: 85%;" placeholder="Search Anything here..." aria-describedby="button-addon1"
          class="form-control border-0 bg-light">
        <div class="input-group-append">
          <button id="button-addon1" style="float: right;" type="submit" class="btn btn-link text-primary"><i
              class="fa fa-search"></i></button>
        </div>
      </div>
    </div>
    <!-- <div style="float: right; margin-top: 5px;padding: 5px;"><button type="button" id="PopoverCustomT-1" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#modal-social"><span class="fa fa-plus"></span> Request Maintenance</button></div><br><br><br> -->

    <div class="table-responsive">


      <table class="table table-hover table-bordered table-striped text-center align-middle" id="tbl">
        <thead class="table-dark">
          <tr>
            <th>#</th>
            <th>Maintenance Description</th>
            <th>Room #</th>
            <th>Date & Time Request</th>
            <th>Requested By</th>
            <th>Status</th>
            <th>Actions</th>
          </tr>
        </thead>
        <tbody>
          <?php
          $sql = "SELECT m.ID as maintenance_id, m.description, m.Roomnum, m.daterequest, m.requestedby, m.status, t.ID, 
          t.fname, t.lname FROM maintenance m JOIN tenants t ON m.requestedby = t.ID";
          $result = $conn->query($sql);

          if ($result->num_rows > 0) {
            $count = 1; // Serial Number
            while ($row = $result->fetch_assoc()) { ?>
              <tr>
                <td><?php echo $count++; ?></td>
                <td><?php echo htmlspecialchars($row['description']); ?></td>
                <td><span class="badge bg-primary">Room #<?php echo htmlspecialchars($row['Roomnum']); ?></span></td>
                <td><?php echo date("F d, Y h:i A", strtotime($row['daterequest'])); ?></td>
                <td><?php echo htmlspecialchars($row['fname'] . ' ' . $row['lname']); ?></td>
                <td>
                  <span class="badge 
                        <?php echo ($row['status'] == 'Pending' ? 'bg-warning' :
                          ($row['status'] == 'Completed' ? 'bg-success' : 'bg-danger')); ?>">
                    <?php echo htmlspecialchars($row['status']); ?>
                  </span>
                </td>
                <td>
                  <div class="d-flex justify-content-center">
                    <form method="post" class="me-2">
                      <input type="hidden" name="acceptreq" value="<?php echo htmlspecialchars($row['maintenance_id']); ?>">
                      <button type="submit" class="btn btn-success btn-sm" data-bs-toggle="tooltip" title="Accept Request">
                        <i class="fas fa-check"></i>
                      </button>
                    </form>
                    <form method="post">
                      <input type="hidden" name="decreq" value="<?php echo htmlspecialchars($row['maintenance_id']); ?>">
                      <button type="submit" class="btn btn-danger btn-sm" data-bs-toggle="tooltip" title="Decline Request">
                        <i class="fas fa-times"></i>
                      </button>
                    </form>
                  </div>
                </td>
              </tr>
            <?php }
          } else { ?>
            <tr>
              <td colspan="7" class="text-center text-muted">No maintenance requests found.</td>
            </tr>
          <?php } ?>
        </tbody>

      </table>
<!-- Font Awesome CDN -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

      <!-- Enable Bootstrap Tooltips -->
      <script>
        var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
        var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
          return new bootstrap.Tooltip(tooltipTriggerEl);
        });
      </script>


      <!-- <span>Number of Transactions: </span><span style="color: red;"id="rowcount">0</span> -->
    </div>

    <div class="modal fade" id="modal-social" tabindex="-1">
      <div class="modal-dialog">
        <div class="modal-content">
          <button type="button" class="close" data-dismiss="modal"><i class="icon-xs-o-md"></i></button>
          <div class="modal-header">
            <!-- <button type="button" class="close" data-dismiss="modal" aria-label="Close" ><span aria-hidden="true">&times;</span></button> -->
            <h4 class="modal-title caps"><strong>Request Maintenance</strong></h4>
          </div>
          <div class="modal-body">


            <div id="via_ue" class="row">
              <div class="col-xs-12">
                <p>Maintenance Description</p>
                <form class="form-inline" method="post" id="signinform" novalidate="novalidate">
                  <div class="row">
                    <div class="form-group col-sm-5" style="position:static;">
                      <input type="hidden" name="tenidx" value="<?php echo $_SESSION['tenantid']; ?>" hidden>
                      <input class="form-control" id="descr" placeholder="Ex. Door Knob,Faucet" type="text" name="descr"
                        tabindex="1" value="">
                    </div>

                  </div>
                </form>
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
            <button class="btn btn-success" style="float: right;" form="signinform">Request</button>
            <button class="btn btn-danger" data-dismiss="modal" style="float: right;margin-right: 5px; ">Close</button>
          </footer>
        </div>

      </div>
    </div>



    <div class="modal fade" id="pay" data-backdrop="static" data-keyboard="false">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <!-- <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button> -->
            <h4 class="modal-title" id="myModalLabel">
              <?php
              $tenantid = $_GET['tenantid'];
              $sql = "SELECT * FROM tenants where ID='$tenantid'";
              $result = $conn->query($sql);

              if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) { ?>
                  Room #<?php echo $row['room']; ?> - <?php echo $row['fname']; ?>     <?php echo $row['lname']; ?>
                <?php }
              } else {
                echo "0 resultsx";
              }
              ?>
            </h4>
          </div>
          <div class="modal-body">
            <div class="container table-responsive py-5">
              <table class="table table-bordered table-hover" id="bills">
                <thead class="thead-dark">
                  <tr>
                    <th scope="col">#</th>
                    <th scope="col">Month</th>
                    <th scope="col">Amount</th>
                    <!-- <th scope="col">Status</th> -->
                    <th scope="col">Action</th>
                  </tr>
                </thead>
                <tbody>


                  <?php
                  $tenantid = $_GET['tenantid'];
                  // SELECT * FROM terms WHERE id IN (SELECT term_id FROM terms_relation WHERE taxonomy = "categ")
                  $sql = "SELECT bills.ID,paymenthistory.ID as phid,bills.date,(COALESCE(bills.amount, 0) - COALESCE(paymenthistory.amount, 0))as amounts,bills.pstat FROM bills left join paymenthistory on bills.date=paymenthistory.baseddate where bills.tenantid='$tenantid' group by bills.date";
                  $result = $conn->query($sql);

                  if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) { ?>



                      <tr>
                        <td scope="row"></td>
                        <td><?php echo date('F', strtotime($row['date'])); ?></td>
                        <td><?php echo $row['amounts']; ?></td>
                        <!-- <td><?php echo $row['pstat']; ?></td> -->
                        <td><a
                            href="./Occupants.php?tenantid=<?php echo $tenantid ?>&ngi=<?php echo $row['ID'] ?>#pay#bayad"
                            class="btn btn-success" type="button"><span class="fa fa-money"></span></a></td>
                      </tr>
                    <?php }
                  } else {
                    echo "0 resultsz";
                  }
                  ?>

                </tbody>

              </table>
              <?php
              $tenantid = $_GET['tenantid'];
              $sql = "SELECT (COALESCE(sum(bills.amount), 0) - COALESCE(paymenthistory.amount, 0))as fulls FROM bills left join paymenthistory on bills.date=paymenthistory.baseddate where bills.tenantid='$tenantid' group by bills.date limit 1";
              // $sql = "SELECT *,sum(amount)as fulls FROM bills where tenantid='$tenantid' group by id limit 1";
              $result = $conn->query($sql);

              if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) { ?>
                  <tr>
                    <td scope="row"></td>
                    <b>
                      <td>Total Balance: </td>
                      <td>&#8369; <span id="totsum"><?php echo number_format($row['fulls']); ?></span></td>
                    </b>
                  </tr>
                <?php }
              } else {
                echo "0 resultsx";
              }
              ?>
            </div>
          </div>
          <div class="modal-footer">
            <!--           <button type="button" class="btn-second-modal within-first-modal btn btn-primary">
            Launch second Modal
          </button> -->
            <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
          </div>
        </div>
      </div>
    </div>

    <div class="modal fade" id="bayad" data-backdrop="static" data-keyboard="false">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h4 class="modal-title" style="float:left;">Month of
              <?php
              $ngi = $_GET['ngi'];

              $sql = "SELECT * FROM bills where ID='$ngi'";
              $result = $conn->query($sql);

              if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                  $_SESSION['billdate'] = $row['date']; ?>
                  <?php echo date('F', strtotime($row['date'])); ?>
                <?php }
              } else {
                echo "0 resultsx";
              }
              ?>
            </h4>
            <!-- <button type="button" class="btn-second-modal-close close" data-dismiss="modal"><span aria-hidden="true">&times;</span></button> -->
            <!-- <h4 class="modal-title">Second Modal</h4> -->
          </div>
          <div class="modal-body">
            <?php
            $sql = "SELECT bills.ID,paymenthistory.ID as phid,bills.date,(COALESCE(bills.amount, 0) - COALESCE(paymenthistory.amount, 0))as amount,bills.pstat FROM bills left join paymenthistory on bills.date=paymenthistory.baseddate where bills.ID='$ngi' group by bills.date";
            // $sql = "SELECT * FROM bills where ID='$ngi'";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
              while ($row = $result->fetch_assoc()) { ?>
                <b style="font-size: 20px;">Total Amount: <span style="color: salmon">&#8369;
                    <?php $a = bcadd($row['amount'], '0', 2);
                    echo number_format($a); ?></span></b>
              <?php }

            } else {
              echo "0 resultsx";
            }
            ?><br>
            <div style="font-size: 16px">
              <span style="  position: absolute;
  left: .9em;
  top: 0;
  height: 100%;
  display: flex;
  align-items: center;
  pointer-events: none;
  color: dimgray;">&#8369;</span>
              <form method="post" id="pays" onsubmit="return confirm('Are you sure you want to proceed payment?')">
                <input type="text" name="tenid" value="<?php echo $_SESSION['tenantid']; ?>" hidden>
                <input type="text" name="billdate" value="<?php echo $_SESSION['billdate']; ?>" hidden>
                <input type="number" name="amount" step="0.01" inputmode="decimal" min="0" placeholder="Enter Amount"
                  required>
              </form>
            </div><br>
            <button type="button" class="btn btn-success">Pay Half</button>
            <button type="button" class="btn btn-success">Pay in full</button>

          </div>
          <div class="modal-footer">
            <!-- <button type="button" class="btn btn-success">Proceed</button> -->
            <!-- <button type="button" class="btn-second-modal-close btn btn-default" data-dismiss="modal">Close</button> -->
            <button type="submit" class="btn btn-success" form="pays">Proceed Payment</button>
            <button type="button" class="btn-second-modal-close btn btn-default" data-dismiss="modal">Close</button>
            <!-- <a href="./Occupants.php?tenantid=<?php echo $tenantid ?>#pay" type="button" class="btn btn-danger">Close</a> -->
          </div>
        </div>
      </div>
    </div>
    </div>
    <!--    <div class="modal fade" id="pay" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog" style="--bs-modal-width: 585px;">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Room #1 - Adonnis Pama</h4>
        </div>
        <div class="modal-body">

<span>Payment Details</span>

        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          <button type="button" class="btn btn-primary">Save changes</button>
        </div>
      </div>
    </div>
  </div>-->


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
  <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-table/1.10.0/bootstrap-table.js"></script>
  <script
    src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-table/1.9.1/extensions/editable/bootstrap-table-editable.js"></script>
  <script
    src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-table/1.9.1/extensions/export/bootstrap-table-export.js"></script>
  <script src="https://rawgit.com/hhurz/tableExport.jquery.plugin/master/tableExport.js"></script>
  <script
    src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-table/1.9.1/extensions/filter-control/bootstrap-table-filter-control.js"></script>

  <!-- Main JS File -->
  <script src="assets/js/main.js"></script>
  <script type="text/javascript">
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

  </script>
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