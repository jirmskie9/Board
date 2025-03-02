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
    echo "No user found.";
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


    <!-- Main CSS File -->
    <link href="assets/css/main.css" rel="stylesheet">
    <style></style>

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
                <li><a href="#" class="active"><i class="bi bi-house navicon"></i>Home</a></li>
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


        <div class="app-main__outer">
            <div class="app-main__inner">
                <div class="app-page-title">
                    <div class="page-title-wrapper">
                        <div class="page-title-heading">
                            <div class="page-title-icon">
                                <i class="fas fa-home icon-gradient bg-mean-fruit"></i>
                                <!-- Changed to FontAwesome Home Icon -->
                            </div>

                        </div>

                        <!-- Include FontAwesome for icons -->
                        <link rel="stylesheet"
                            href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">


                    </div>
                </div>
                <div class="row">


                    <div class="col-md-12">

                        <div class="row">
                            <div class="col-md-12">
                                <div class="mb-3 card shadow-lg rounded">
                                    <div class="card-header bg-info text-white d-flex align-items-center">
                                        <i class="fas fa-history me-2"></i>
                                        <h5 class="mb-0">Pending applications</h5>
                                    </div>
                                    <div class="card-body">
                                        <div class="table-responsive shadow-sm p-3 bg-white rounded">
                                            <h3 class="mb-3">Applications</h3>
                                            <table class="table table-bordered table-striped">
                                                <thead class="table-secondary">
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
                                                            echo "<td><a href='#' class='upload-link' data-userid='{$row['user_id']}' data-field='proof' data-bs-toggle='modal' data-bs-target='#uploadModal'>Upload Proof of Income</a></td>";
                                                            echo "<td><a href='#' class='upload-link' data-userid='{$row['user_id']}' data-field='valid_id' data-bs-toggle='modal' data-bs-target='#uploadModal'>Upload Valid ID</a></td>";
                                                            echo "<td><span class='badge bg-warning text-dark'>{$row['status']}</span></td>";
                                                            echo "</tr>";
                                                        }
                                                    } else {
                                                        echo "<tr><td colspan='3' class='text-center'>No pending applications found.</td></tr>";
                                                    }
                                                    ?>
                                                </tbody>
                                            </table>
                                            <div class="modal fade" id="uploadModal" tabindex="-1"
                                                aria-labelledby="uploadModalLabel" aria-hidden="true">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="uploadModalLabel">Upload
                                                                Document</h5>
                                                            <button type="button" class="btn-close"
                                                                data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>
                                                        <form action="upload_application_file.php" method="POST"
                                                            enctype="multipart/form-data">
                                                            <div class="modal-body">
                                                                <input type="hidden" name="user_id" id="modal_user_id">
                                                                <input type="hidden" name="field_name"
                                                                    id="modal_field_name">

                                                                <label for="file_upload" class="form-label">Choose
                                                                    File</label>
                                                                <input type="file" name="file_upload"
                                                                    class="form-control" required>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary"
                                                                    data-bs-dismiss="modal">Cancel</button>
                                                                <button type="submit"
                                                                    class="btn btn-primary">Upload</button>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>


                        </div>





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