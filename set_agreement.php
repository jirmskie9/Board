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

if (isset($_GET['app_id'])) {
    $app_id = $_GET['app_id'];

    // Secure the input to prevent SQL injection
    $app_id = mysqli_real_escape_string($conn, $app_id);

    // Corrected SQL query
    $query = "SELECT a.app_id, a.user_id, a.status, t.ID, t.fname, t.lname, t.room, r.Roomnum,
          r.Cost 
          FROM applications a 
          JOIN tenants t ON a.user_id = t.ID 
          JOIN rooms r ON t.room = r.Roomnum
          WHERE a.app_id = '$app_id'";

    // Execute query
    $result = mysqli_query($conn, $query);

    // Check if query executed successfully
    if ($result && mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            $user_id = $row['user_id'];
            $fname = $row['fname'];
            $lname = $row['lname'];
            $cost = $row['Cost'];
            $roomNum = $row['Roomnum'];
        }
    } else {
        header("Location: Occupants.php");
        exit();
    }
} else {
    echo "<p>Application ID is missing.</p>";
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

        <div class="social-links text-center">
            <a href="#" class="twitter"><i class="bi bi-twitter-x"></i></a>
            <a href="#" class="facebook"><i class="bi bi-facebook"></i></a>
            <a href="#" class="instagram"><i class="bi bi-instagram"></i></a>
        </div>

        <nav id="navmenu" class="navmenu">
            <ul>
                <li><a href="./Dashboard.php"><i class="bi bi-house navicon"></i>Dashboard</a></li>
                <li><a href="./Occupants.php" class="active"><i class="bi bi-person navicon"></i> Occupants</a></li>
                <li><a href="./Rooms.php"><i class="bi bi-door-open navicon"></i> Rooms</a></li>
                <li><a href="./Expenses.php"><i class="bi bi-receipt navicon"></i> Expenses</a></li>
                <li><a href="./Messages.php"><i class="fa fa-envelope"></i> Messages</a></li>
                <li><a href="./Maintenance.php"><i class="bi bi-newspaper navicon"></i> Maintenance Request</a></li>
                <li><a href="./logout.php"><i class="bi bi-box-arrow-right navicon"></i> Logout</a></li>
            </ul>

        </nav>

    </header>

    <main class="main col-lg-9">
        <div class="page-title text-center">
            <h1 class="fw-bold text-secondary">Set Up Rental Agreement</h1>
            <p class="text-muted">Review and approve the rental agreement details below.</p>
        </div>

        <div class="container mt-5">
            <div class="card shadow-lg p-4 border-0 rounded-3">
                <h4 class="text-primary fw-bold text-center mb-3">Rental Agreement</h4>

                <div class="border p-4 rounded bg-light position-relative">
                    <form action="save_agreement.php" method="POST" onsubmit="saveContent()">
                        <input type="hidden" name="user_id" value="<?php echo $user_id; ?>">
                        <input type="hidden" name="app_id" value="<?php echo $app_id; ?>">
                        <input type="hidden" name = "roomnum" value = "<?php echo $roomNum ?>">
                        <textarea name="agreement_content" id="agreement_content" style="display:none;"></textarea>

                        <div id="agreementContent" class="p-3 bg-white rounded shadow-sm">
                            <p><strong>Date of Agreement:</strong> <span
                                    contenteditable="true"><?php echo date("F j, Y"); ?></span></p>

                            <p><strong>Parties Involved:</strong></p>
                            <p><strong>Landlord:</strong> <span contenteditable="true">PrimosBH</span></p>
                            <p><strong>Tenant:</strong> <span
                                    contenteditable="true"><?php echo $fname . " " . $lname; ?></span></p>

                            <p contenteditable="true">
                                This Rental Agreement is made and entered into as of the approval date between the
                                Landlord
                                and the Tenant. The Tenant agrees to lease the property under the following terms and
                                conditions:
                            </p>

                            <ul class="list-group list-group-flush">
                                <li class="list-group-item"><strong>Property Address:</strong> <span
                                        contenteditable="true">Prk 7, Brgy Poblacion, Tupi, South Cotabato</span></li>
                                <li class="list-group-item"><strong>Monthly Rent: ₱</strong> <span
                                        contenteditable="true"><?php echo $cost; ?></span> (Due every <span
                                        contenteditable="true">first day of Month</span>)</li>
                                <li class="list-group-item"><strong>Maintenance and Repairs:</strong> <span
                                        contenteditable="true">Tenant is responsible for minor repairs; major repairs
                                        handled by the Landlord.</span></li>
                                <li class="list-group-item"><strong>Utilities:</strong> <span
                                        contenteditable="true">Tenant</span></li>
                            </ul>

                            <p class="mt-3" contenteditable="true">
                                By signing this agreement, both parties agree to abide by the terms and conditions set
                                forth above.
                            </p>
                        </div>

                        <script>
                            function saveContent() {
                                document.getElementById("agreement_content").value = document.getElementById("agreementContent").innerHTML;
                            }
                        </script>

                        <!-- Image Positioned at Bottom Right -->
                        <img src="logo/balay.jpg" alt="Agreement Seal" class="agreement-img">
                    
                </div>

                <!-- Action Buttons -->
                <div class="mt-4 d-flex justify-content-center gap-3">
                    <button type="submit" name="save" class="btn btn-success btn-lg shadow">
                        <i class="fas fa-check-circle me-2"></i> Confirm
                    </button>
                    </form>
                </div>
            </div>
        </div>

        <!-- CSS for Styling -->
        <style>
            .agreement-img {
                position: absolute;
                bottom: 15px;
                right: 15px;
                width: 90px;
                opacity: 0.8;
            }

            .card {
                background: #fff;
                border-radius: 10px;
            }

            .list-group-item {
                background: transparent;
                border-left: none;
                border-right: none;
                padding: 10px 15px;
            }
        </style>

    </main>

    <script>
        // Set current date in the agreement
        document.getElementById("agreementDate").innerText = new Date().toLocaleDateString();

        function confirmApproval() {
            if (confirm("Are you sure you want to approve this agreement?")) {
                alert("Agreement approved successfully!");
                // Add redirection or form submission logic here
            }
        }

        function confirmRejection() {
            if (confirm("Are you sure you want to reject this agreement?")) {
                alert("Agreement rejected.");
                // Add redirection or form submission logic here
            }
        }
    </script>

</body>

</html>