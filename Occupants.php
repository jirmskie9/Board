<?php
session_start();
include('db.php');

if (!isset($_SESSION['Uid'])) {
  header("Location: login.php");
}
$uid = $_SESSION['Uid'];

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

if (isset($_POST['svform'])) {
  include('db.php'); // Ensure DB connection is included

  // Sanitize inputs
  $fname = $conn->real_escape_string($_POST['fname']);
  $lname = $conn->real_escape_string($_POST['lname']);
  $fullname = $fname . " " . $lname;
  $mname = $conn->real_escape_string($_POST['mname']);
  $address = $conn->real_escape_string($_POST['address']);
  $contact = $conn->real_escape_string($_POST['contact']);
  $email = $conn->real_escape_string($_POST['email']);
  $pname = $conn->real_escape_string($_POST['pname']);
  $paddress = $conn->real_escape_string($_POST['address']);
  $pcontact = $conn->real_escape_string($_POST['contact']);
  $relation = $conn->real_escape_string($_POST['relation']);
  $room = $conn->real_escape_string($_POST['room']);
  $password = $conn->real_escape_string($_POST['password']);

  // Get latest count value and increment it
  $countQuery = "SELECT MAX(count) AS last_count FROM user";
  $countResult = $conn->query($countQuery);
  $lastCount = 0;

  if ($countResult->num_rows > 0) {
    $row = $countResult->fetch_assoc();
    $lastCount = $row['last_count'] + 1;
  }

  // Generate username based on count
  $username = "PrimosBH_" . $lastCount;

  // Insert into tenants
  $sql = "INSERT INTO tenants (fname, lname, mname, address, contact, email, efullname, eaddress, econtact, relation, room)
        VALUES ('$fname', '$lname', '$mname', '$address', '$contact', '$email', '$pname', '$paddress', '$pcontact', '$relation', '$room')";

  if ($conn->query($sql) === TRUE) {
    $tenantId = $conn->insert_id; // Get the last inserted tenant ID

    // ✅ Insert into applications (user_id = last tenant_id + 1)
    $sqlApplication = "INSERT INTO applications (user_id) VALUES ('$tenantId')";
    if (!$conn->query($sqlApplication)) {
      echo "Error inserting into applications table: " . $conn->error;
      exit;
    }

    // Insert into bills
    $sqlx = "INSERT INTO bills (tenantid, amount)
             SELECT tenants.id, rooms.cost / (SELECT COUNT(*) FROM tenants WHERE room = rooms.Roomnum)
             FROM tenants 
             INNER JOIN rooms ON tenants.room = rooms.Roomnum 
             WHERE tenants.id = '$tenantId'";

    if ($conn->query($sqlx) === TRUE) {
      // Update balance
      $sqlUpdate = "UPDATE tenants AS t 
                      INNER JOIN rooms AS r ON t.room = r.Roomnum 
                      SET t.balance = t.balance + (r.cost / (SELECT COUNT(*) FROM tenants WHERE room = r.Roomnum)) 
                      WHERE t.id = '$tenantId'";

      if ($conn->query($sqlUpdate) === TRUE) {

        // ✅ Update the Occupants column in the rooms table (subtract 1)
        $sqlRoomUpdate = "UPDATE rooms SET Occupants = Occupants - 1 WHERE Roomnum = '$room'";

        if ($conn->query($sqlRoomUpdate) === TRUE) {
          // Insert into user table
          $sqlUser = "INSERT INTO user (user_id, username, password, Fullname, count) 
                            VALUES ('$tenantId','$username', '$password', '$fullname', '$lastCount')";

          if ($conn->query($sqlUser) === TRUE) {
            $_SESSION['status'] = "Tenant, Room Status, User record, and Application updated successfully!";
            $_SESSION['status_code'] = "success";
            $_SESSION['status_button'] = "Okay";
            header("Location: Occupants.php");
          } else {
            echo "Error inserting into user table: " . $conn->error;
          }
        } else {
          echo "Error updating room status: " . $conn->error;
        }
      } else {
        echo "Error updating balance: " . $conn->error;
      }
    } else {
      echo "Error inserting into bills table: " . $conn->error;
    }
  } else {
    echo "Error inserting into tenants table: " . $conn->error;
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
  <!-- Add this in your HTML head or before the closing </body> tag -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">


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
      <img src="logo/balay.jpg  " alt="" class="img-fluid rounded-circle">
    </div>

    <a href="index.html" class="logo d-flex align-items-center justify-content-center">
      <!-- Uncomment the line below if you also wish to use an image logo -->
      <!-- <img src="assets/img/logo.png" alt=""> -->
      <h1 class="sitename"><?php echo $fullname ?></h1>
    </a>

  

    <nav id="navmenu" class="navmenu">
      <ul>
        <li><a href="./Dashboard.php"><i class="bi bi-house navicon"></i>Dashboard</a></li>
        <li><a href="./Occupants.php" class="active"><i class="bi bi-person navicon"></i> Occupants</a></li>
        <li><a href="./Rooms.php"><i class="bi bi-door-open navicon"></i> Rooms</a></li>
        <li><a href="./Utilities.php"><i class="bi bi-lightbulb navicon"></i> <!-- Represents electricity/utilities -->
        Utility Bills</a></li>
        <li><a href="./Collection.php" class=""><i class="bi bi-cash-stack navicon"></i>Rent Collection</a></li>
        <li><a href="./Expenses.php"><i class="bi bi-receipt navicon"></i> Expenses</a></li>
        <li><a href="./Messages.php"><i class="fa fa-envelope"></i> Messages</a></li>
        <li><a href="./Maintenance.php"><i class="bi bi-newspaper navicon"></i> Maintenance Request</a></li>
        <li><a href="./logout.php"><i class="bi bi-box-arrow-right navicon"></i> Logout</a></li>
      </ul>

    </nav>

  </header>

  <main class="main col-lg-9">
    <div class="page-title">
      <h1>Boarders/Occupants</h1>
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
    <div style="float: right; margin-top: 5px;padding: 5px;"><button type="button" id="PopoverCustomT-1"
        class="btn btn-primary btn-sm" data-toggle="modal" data-target="#modal-social"><span class="fa fa-plus"></span>
        New Occupant</button></div><br><br><br>

    <div class="table-responsive">


      <!-- Include Bootstrap CSS (if not already included) -->

      <table class="table table-bordered table-hover table-striped align-middle text-center" id="tbl">
        <thead class="table-primary">
          <tr>
            <th>#</th>
            <th>Name</th>
            <th>Room #</th>
            <th>Balance</th>
            <th>Actions</th>
          </tr>
        </thead>
        <tbody>
          <?php
          $sql = "SELECT a.user_id, a.status, t.ID, t.fname, t.lname, t.room, t.balance FROM applications a JOIN tenants t
          ON a.user_id = t.ID WHERE a.status = 'approved'";
          $result = $conn->query($sql);
          $count = 1;

          if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) { ?>
              <tr>
                <td><?php echo $count++; ?></td>
                <td class="text-start">
                  <strong><?php echo $row['fname'] . ' ' . $row['lname']; ?></strong>
                </td>
                <td>Room #<?php echo $row['room']; ?></td>
                <td>
                  <span class="badge bg-warning text-dark">
                    &#8369; <?php echo number_format($row['balance'], 2); ?>
                  </span>
                </td>
                <td>
                  <a href="?tenantid=<?php echo $row['ID']; ?>#pay" class="btn btn-success btn-sm">
                    <i class="fa-solid fa-money-bill-wave"></i>
                  </a>

                  <!-- Hidden input field to store Tenant ID -->
                  <input type="hidden" value="<?php echo $row['ID']; ?>" class="user_id">

                  <!-- Delete button -->

                </td>
              </tr>
            <?php }
          } else { ?>
            <tr>
              <td colspan="5" class="text-center">
                <img src="logo/empty.png" alt="No Tenants Found" width="150"><br>
                No tenants found.
              </td>
            </tr>
          <?php } ?>
        </tbody>




      </table>
      <!-- Delete Confirmation Modal -->
      <!-- Delete Confirmation Modal -->
      <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="deleteModalLabel">Confirm Deletion</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
              <p>Are you sure you want to delete <strong id="tenantName"></strong>?</p>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
              <a href="#" id="confirmDelete" class="btn btn-danger">Delete</a>
            </div>
          </div>
        </div>
      </div>

      <script>
        document.addEventListener("DOMContentLoaded", function () {
          const deleteButtons = document.querySelectorAll(".delete-btn");
          const tenantName = document.getElementById("tenantName");
          const confirmDelete = document.getElementById("confirmDelete");

          deleteButtons.forEach((button) => {
            button.addEventListener("click", function () {
              const tenantId = this.getAttribute("data-id");
              const name = this.getAttribute("data-name");

              tenantName.textContent = name; // Show tenant name in modal
              confirmDelete.href = "delete_tenant.php?id=" + tenantId; // Set delete link
            });
          });
        });
      </script>



      <div class="mt-3">
        <span class="fw-bold">Total Occupants:</span>
        <span class="text-danger fw-bold" id="rowcount"><?php echo $result->num_rows; ?></span>
      </div>


    </div>
    <br>
    <div class="page-title">
      <h1>Pending Applications</h1>
    </div>
    <?php
    $sql = "SELECT a.app_id, a.user_id, a.proof, a.valid_id, a.status, t.fname, t.lname 
        FROM applications a
        JOIN tenants t ON a.user_id = t.ID 
        WHERE a.status = 'pending' AND a.proof IS NOT NULL AND a.proof != '' AND a.valid_id IS NOT NULL AND a.valid_id != ''";

    $result = $conn->query($sql);
    ?>

    <div class="table-responsive">
      <table class="table table-bordered table-hover table-striped align-middle text-center" id="tbl">
        <thead class="table-primary">
          <tr>
            <th>#</th>
            <th>First Name</th>
            <th>Last Name</th>
            <th>Actions</th>
          </tr>
        </thead>
        <tbody>
          <?php
          $count = 1;
          if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) { ?>
              <tr>
                <td><?php echo $count++; ?></td>
                <td class="text-start">
                  <strong><?php echo $row['fname']; ?></strong>
                </td>
                <td class="text-start">
                  <strong><?php echo $row['lname']; ?></strong>
                </td>
                <td>
                  <!-- Review Button -->
                  <a href="review_application.php?appid=<?php echo $row['app_id']; ?>" class="btn btn-info btn-sm">
                    <i class="fa-solid fa-eye"></i> Review
                  </a>
                </td>
              </tr>
            <?php }
          } else { ?>
            <tr>
              <td colspan="3" class="text-center">

                <p>No applications found.</p>
              </td>
            </tr>
          <?php } ?>
        </tbody>
      </table>
    </div>

    </table>

    </table>

    </div>

    <div class="modal fade" id="modal-social" tabindex="-1">
      <div class="modal-dialog">
        <div class="modal-content">
          <button type="button" class="close" data-dismiss="modal"><i class="icon-xs-o-md"></i></button>
          <div class="modal-header">
            <!-- <button type="button" class="close" data-dismiss="modal" aria-label="Close" ><span aria-hidden="true">&times;</span></button> -->
            <h4 class="modal-title caps"><strong>Add New Boarder/Occupant</strong></h4>
          </div>
          <div class="modal-body">


            <div id="via_ue" class="row">
              <div class="col-xs-12">
                <p>Occupant Information</p>
                <form class="form-inline" method="post" id="signinform" novalidate="novalidate">
                  <div class="row">
                    <div class="form-group col-sm-5" style="position:static;">
                      <input type="hidden" name="svform" hidden>
                      <input class="form-control" id="fname" placeholder="Firstname" type="text" name="fname"
                        tabindex="1" value="">
                    </div>
                    <div class="form-group col-sm-5">
                      <input class="form-control" id="lname" placeholder="Lastname" type="text" tabindex="2"
                        autocomplete="off" name="lname">
                    </div>
                    <div class="form-group col-sm-5">
                      <input class="form-control" id="mname" placeholder="Middlename" type="text" tabindex="3"
                        autocomplete="off" name="mname">
                    </div>
                    <div class="form-group col-sm-5">
                      <select class="form-control" tabindex="4" id="roomSelect" name="room"
                        onchange="showRoomDetails(this.value)" style="width: 29vh">
                        <option value="0">Select Room</option>
                        <?php

                        $sql = "SELECT * FROM rooms WHERE Occupants != '0' ORDER BY Roomnum";
                        $result = $conn->query($sql);

                        if ($result->num_rows > 0) {
                          while ($row = $result->fetch_assoc()) { ?>
                            <option value="<?php echo $row['Roomnum']; ?>">Room #<?php echo $row['Roomnum']; ?></option>
                          <?php }
                        } else {
                          echo "<option value='0'>No Rooms Available</option>";
                        }
                        ?>
                      </select>
                    </div>
                    <!-- Make sure to include Bootstrap CSS in your <head> -->

                    <div id="hidden_div" class="card mt-3 mx-auto shadow" style="display: none; max-width: 500px;">
                      <div class="card-header text-center bg-primary text-white">
                        Room Information
                      </div>
                      <div class="card-body" id="roomDetails">


                        <?php
                        // if(isset($_GET['item'])){
                        $roomsel = $_GET['item'];
                        $sql = "SELECT * FROM rooms where Roomnum='$roomsel'";
                        $result = $conn->query($sql);

                        if ($result->num_rows > 0) {
                          // output data of each row
                          while ($row = $result->fetch_assoc()) { ?>
                            <p class="">
                              Room Number: <?php echo $row['Roomnum']; ?><br>
                              Occupants: <br>
                              Occupied: 3 <br>
                              Available: 3 <br>
                              Price:
                            </p>
                          <?php }
                        } else {
                          echo "0 results";
                        }
                        // }
                        ?>

                      </div>
                      <script>
                        function showRoomDetails(roomNum) {
                          if (roomNum == "0") {
                            document.getElementById("hidden_div").style.display = "none";
                            return;
                          }

                          // AJAX Request to fetch room details
                          var xhr = new XMLHttpRequest();
                          xhr.open("GET", "fetch_room.php?room=" + roomNum, true);
                          xhr.onreadystatechange = function () {
                            if (xhr.readyState == 4 && xhr.status == 200) {
                              document.getElementById("roomDetails").innerHTML = xhr.responseText;
                              document.getElementById("hidden_div").style.display = "block";
                            }
                          };
                          xhr.send();
                        }
                      </script>
                      <?php
                      $sql = "SELECT count FROM user ORDER BY count DESC LIMIT 1";
                      $result = $conn->query($sql);

                      // Get the latest count value and add 1
                      if ($result->num_rows > 0) {
                        $row = $result->fetch_assoc();
                        $last_row_count = $row['count'] + 1;
                      } else {
                        $last_row_count = 1;
                      }


                      $value = "PrimosBH_" . $last_row_count;

                      ?>
                    </div>
                    <p>Contact Information</p>
                    <div class="form-group col-sm-5">
                      <input class="form-control" id="address" placeholder="Address" type="text" tabindex="5"
                        autocomplete="off" name="address">
                    </div>
                    <div class="form-group col-sm-5">
                      <input class="form-control" id="contact" placeholder="Contact Number" type="tel" tabindex="5"
                        autocomplete="off" name="contact">
                    </div>
                    <div class="form-group col-sm-5">
                      <input class="form-control" id="address" placeholder="Email" type="email" tabindex="5"
                        autocomplete="off" name="email">
                    </div>
                    <p>Incase of Emergency Please Contact:</p>
                    <div class="form-group col-sm-5">
                      <input class="form-control" id="address" placeholder="Name of Parent/Guardian" type="text"
                        tabindex="5" autocomplete="off" name="pname">
                    </div>
                    <div class="form-group col-sm-5">
                      <input class="form-control" id="address" placeholder="Relationship" type="text" tabindex="5"
                        autocomplete="off" name="relation">
                    </div>
                    <p>Tenant Account:</p>
                    <div class="form-group col-sm-5">
                      <input class="form-control" value="PrimosBH_<?php echo $last_row_count ?>" placeholder="Username"
                        type="text" tabindex="5" autocomplete="off" name="puser">
                    </div>
                    <div class="form-group col-sm-5">
                      <input class="form-control" placeholder="Password" type="password" tabindex="5" name="password">
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
            <button class="btn btn-success" style="float: right;" form="signinform">Save</button>
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
                      <div class="mt-3 p-3 bg-light border rounded text-center">
                        <h5 class="fw-bold text-danger">Total Balance</h5>
                        <h4 class="text-success">
                          <span id="totsum">
                            <?php
                            $sql = "SELECT (COALESCE(SUM(bills.amount), 0) - COALESCE(paymenthistory.amount, 0)) AS fulls 
                            FROM bills 
                            LEFT JOIN paymenthistory ON bills.date = paymenthistory.baseddate 
                            WHERE bills.tenantid = '$tenantid' 
                            GROUP BY bills.date LIMIT 1";
                            $result = $conn->query($sql);
                            echo ($result->num_rows > 0) ? number_format($result->fetch_assoc()['fulls'], 2) : "0.00";
                            ?>
                          </span>
                        </h4>
                      </div>
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
            <?php
            $amount = isset($row['amount']) ? bcadd($row['amount'], '0', 2) : '0';
            $formattedAmount = number_format($amount, 2);
            $halfAmount = bcdiv($amount, '2', 2);
            ?>
            <div style="font-size: 16px">
              <span style="  position: absolute;
              left: .9em;
              top: 0;
              height: 100%;
              display: flex;
              align-items: center;
              pointer-events: none;
              color: dimgray;">&#8369;</span>
              <?php

              $tenantId = isset($_GET['tenantid']) ? htmlspecialchars($_GET['tenantid']) : '';
              ?>
              <form method="post" id="pays" onsubmit="return confirm('Are you sure you want to proceed payment?')">
                <input type="hidden" name="tenid" value="<?php echo $tenantId ?>">
                <br>
                <input type="text" name="billdate" value="<?php echo $_SESSION['billdate']; ?>" hidden>
                <input type="number" name="amount" step="0.01" inputmode="decimal" min="0" placeholder="Enter Amount"
                  required>
              </form>
            </div><br>


          </div>
          <div class="modal-footer">

            <button type="submit" class="btn btn-success" form="pays">Proceed Payment</button>
            <button type="button" class="btn-second-modal-close btn btn-default" data-dismiss="modal">Close</button>

          </div>

        </div>
      </div>
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
  <?php
  if (isset($_SESSION['status'])) {
    ?>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script>
      document.addEventListener("DOMContentLoaded", function () {
        swal({
          title: "<?php echo $_SESSION['status']; ?>",
          icon: "<?php echo $_SESSION['status_code']; ?>",
          button: "<?php echo $_SESSION['status_button']; ?>"
        });
      });
    </script>
    <?php
    unset($_SESSION['status']);
    unset($_SESSION['status_code']);
    unset($_SESSION['status_button']);
  }
  ?>


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

 

</body >

</html >