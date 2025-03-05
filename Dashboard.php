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

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <title>PrimosBH</title>
    <meta content="" name="description">
    <meta content="" name="keywords">

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
    <meta name="viewport"
        content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no, shrink-to-fit=no" />
    <meta name="description" content="This is an example dashboard created using build-in elements and components.">
    <meta name="msapplication-tap-highlight" content="no">
    <link href="./logo/balay.jpg" rel="icon">
    <link href="https://demo.dashboardpack.com/architectui-html-free/main.css" rel="stylesheet">
    <link href="./logo/balay.jpg" rel="icon">
    <style>
        .password-strength {
            margin-top: 5px;
            font-size: 12px;
        }

        #strength-bar {
            height: 5px;
            margin-top: 5px;
        }

        .very-weak {
            height: 5px;
            background-color: #ff4d4d;
        }

        .weak {
            background-color: #ffa07a;
        }

        .fair {
            background-color: #ffd700;
        }

        .moderate {
            background-color: #add8e6;
        }

        .strong {
            background-color: #90ee90;
        }

        .very-strong {
            background-color: #00cc00;
        }
    </style>
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

        <a href="#" class="logo d-flex align-items-center justify-content-center">
            <!-- Uncomment the line below if you also wish to use an image logo -->
            <!-- <img src="assets/img/logo.png" alt=""> -->
            <h1 class="sitename"><?php echo $fullname ?></h1>
        </a>



        <nav id="navmenu" class="navmenu">
            <ul>
                <li><a href="./Dashboard.php" class="active"><i class="bi bi-house navicon"></i>Dashboard</a></li>
                <li><a href="./Occupants.php"><i class="bi bi-person navicon"></i> Occupants</a></li>
                <li><a href="./Rooms.php"><i class="bi bi-door-open navicon"></i> Rooms</a></li>
                <li><a href="./Documents.php"><i class="bi bi-file-earmark-text navicon"></i> Documents</a></li>

                <li><a href="./Utilities.php"><i class="bi bi-lightbulb navicon"></i>
                        <!-- Represents electricity/utilities -->
                        Utility Bills</a></li>
                <li><a href="./Collection.php" class=""><i class="bi bi-cash-stack navicon"></i>Rent Collection</a></li>

                <li><a href="./expenses.php"><i class="bi bi-receipt navicon"></i> Expenses</a></li>
                <li><a href="./Messages.php"><i class="bi bi-envelope-fill navicon"></i> Messages</a></li>
                <li><a href="./Maintenance.php"><i class="bi bi-newspaper navicon"></i> Maintenance Request</a></li>
                <li><a href="./logout.php"><i class="bi bi-box-arrow-right navicon"></i> Logout</a></li>
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
                                                <div class="switch has-switch switch-container-class"
                                                    data-class="fixed-header">
                                                    <div class="switch-animate switch-on">
                                                        <input type="checkbox" checked data-toggle="toggle"
                                                            data-onstyle="success">
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
                                                <div class="switch has-switch switch-container-class"
                                                    data-class="fixed-sidebar">
                                                    <div class="switch-animate switch-on">
                                                        <input type="checkbox" checked data-toggle="toggle"
                                                            data-onstyle="success">
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
                                                <div class="switch has-switch switch-container-class"
                                                    data-class="fixed-footer">
                                                    <div class="switch-animate switch-off">
                                                        <input type="checkbox" data-toggle="toggle"
                                                            data-onstyle="success">
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
                                class="btn-pill btn-shadow btn-wide ml-auto btn btn-focus btn-sm switch-header-cs-class"
                                data-class="">
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
                                        <div class="swatch-holder bg-info switch-header-cs-class"
                                            data-class="bg-info header-text-dark">
                                        </div>
                                        <div class="swatch-holder bg-warning switch-header-cs-class"
                                            data-class="bg-warning header-text-dark">
                                        </div>
                                        <div class="swatch-holder bg-danger switch-header-cs-class"
                                            data-class="bg-danger header-text-light">
                                        </div>
                                        <div class="swatch-holder bg-light switch-header-cs-class"
                                            data-class="bg-light header-text-dark">
                                        </div>
                                        <div class="swatch-holder bg-dark switch-header-cs-class"
                                            data-class="bg-dark header-text-light">
                                        </div>
                                        <div class="swatch-holder bg-focus switch-header-cs-class"
                                            data-class="bg-focus header-text-light">
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
                                        <div class="swatch-holder bg-royal switch-header-cs-class"
                                            data-class="bg-royal header-text-light">
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
                                class="btn-pill btn-shadow btn-wide ml-auto btn btn-focus btn-sm switch-sidebar-cs-class"
                                data-class="">
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
                                        <div class="swatch-holder bg-info switch-sidebar-cs-class"
                                            data-class="bg-info sidebar-text-dark">
                                        </div>
                                        <div class="swatch-holder bg-warning switch-sidebar-cs-class"
                                            data-class="bg-warning sidebar-text-dark">
                                        </div>
                                        <div class="swatch-holder bg-danger switch-sidebar-cs-class"
                                            data-class="bg-danger sidebar-text-light">
                                        </div>
                                        <div class="swatch-holder bg-light switch-sidebar-cs-class"
                                            data-class="bg-light sidebar-text-dark">
                                        </div>
                                        <div class="swatch-holder bg-dark switch-sidebar-cs-class"
                                            data-class="bg-dark sidebar-text-light">
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
                            <button type="button"
                                class="btn-pill btn-shadow btn-wide ml-auto active btn btn-focus btn-sm">Restore Default
                            </button>
                        </h3>
                        <div class="p-3">
                            <ul class="list-group">
                                <li class="list-group-item">
                                    <h5 class="pb-2">Page Section Tabs
                                    </h5>
                                    <div class="theme-settings-swatches">
                                        <div role="group" class="mt-2 btn-group">
                                            <button type="button"
                                                class="btn-wide btn-shadow btn-primary btn btn-secondary switch-theme-class"
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
                                    <i class="fas fa-home icon-gradient bg-mean-fruit"></i>
                                    <!-- Changed to FontAwesome Home Icon -->
                                </div>
                                <div>Welcome to Primos Boardinghouse
                                    <div class="page-title-subheading">
                                        This is an overview of all data in Primos Boardinghouse.
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                    <div class="row">
                        <?php
                        include('db.php');

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
                                        <div class="widget-heading">Total Expenses</div>
                                        <div class="widget-subheading">Current Year Expenses</div>
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

                        $sql = "SELECT COUNT(*) AS total_tenants FROM tenants";
                        $result = $conn->query($sql);

                        $total_rooms = 0; // Default value
                        if ($result->num_rows > 0) {
                            $row = $result->fetch_assoc();
                            $total_tenants = $row['total_tenants'];
                        }

                        ?>
                        <div class="col-md-6 col-xl-4">
                            <div class="card mb-3 widget-content bg-arielle-smile">
                                <div class="widget-content-wrapper text-white">
                                    <div class="widget-content-left">
                                        <div class="widget-heading">Boarders/Occupants</div>
                                        <div class="widget-subheading">Total Boarders/Occupants</div>
                                    </div>
                                    <div class="widget-content-right">
                                        <div class="widget-numbers text-white"><span><?php echo $total_tenants ?></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php

                        $sql = "SELECT COUNT(*) AS total_rooms FROM rooms";
                        $result = $conn->query($sql);

                        $total_rooms = 0; // Default value
                        if ($result->num_rows > 0) {
                            $row = $result->fetch_assoc();
                            $total_rooms = $row['total_rooms'];
                        }

                        ?>

                        <div class="col-md-6 col-xl-4">
                            <div class="card mb-3 widget-content bg-grow-early">
                                <div class="widget-content-wrapper text-white">
                                    <div class="widget-content-left">
                                        <div class="widget-heading">Rooms</div>
                                        <div class="widget-subheading">Total Rooms</div>
                                    </div>
                                    <div class="widget-content-right">
                                        <div class="widget-numbers text-white"><span><?php echo $total_rooms; ?>
                                                Rooms</span></div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                    <?php
                    // Database query to get monthly income
                    $sql = "SELECT DATE_FORMAT(baseddate, '%Y-%m') AS month, SUM(amount) AS total_income 
                    FROM paymenthistory 
                    GROUP BY month 
                    ORDER BY month ASC";

                    $result = $conn->query($sql);

                    $months = [];
                    $income = [];

                    while ($row = $result->fetch_assoc()) {
                        $months[] = date("F Y", strtotime($row['month'] . "-01")); // Format as "Month Year"
                        $income[] = $row['total_income'];
                    }
                    ?>
                    <div class="row">
                        <!-- Monthly Income Chart -->
                        <div class="col-md-6">
                            <div class="mb-3 card shadow-lg rounded">
                                <div class="card-header bg-primary text-white d-flex align-items-center">
                                    <i class="fas fa-chart-line me-2"></i>
                                    <h5 class="mb-0">Monthly Income</h5>
                                </div>
                                <div class="card-body">
                                    <canvas id="incomeChart"></canvas>
                                </div>
                            </div>
                        </div>

                        <!-- Payment History Chart -->
                        <?php
                      
                        error_reporting(E_ALL);
                        ini_set('display_errors', 1);

                        // Fetch total occupants and tenants
                        $query = "SELECT SUM(occupants) AS total_occupants, SUM(tenants) AS total_tenants FROM rooms";
                        $result = $conn->query($query);

                        $total_occupants = 0;
                        $total_tenants = 0;

                        if ($result && $row = $result->fetch_assoc()) {
                            $total_occupants = intval($row['total_occupants']);
                            $total_tenants = intval($row['total_tenants']);
                        }

                        // Calculate available slots
                        $total_available = $total_occupants - $total_tenants;
                        ?>

                        <div class="col-md-6">
                            <div class="mb-3 card shadow-lg rounded">
                                <div class="card-header bg-success text-white d-flex align-items-center">
                                    <i class="fas fa-home me-2"></i>
                                    <h5 class="mb-0">Room Occupancy</h5>
                                </div>
                                <div class="card-body">
                                    <canvas id="roomChart"></canvas>
                                </div>
                            </div>
                        </div>

                        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
                        <script>
                            document.addEventListener("DOMContentLoaded", function () {
                                // Get PHP values and pass to JavaScript
                                var occupied = <?php echo $total_tenants; ?>;
                                var available = <?php echo max($total_available, 0); ?>; // Ensure no negative values

                                var ctx = document.getElementById("roomChart").getContext("2d");
                                var roomChart = new Chart(ctx, {
                                    type: "pie",
                                    data: {
                                        labels: ["Occupied", "Available"],
                                        datasets: [{
                                            data: [occupied, available],
                                            backgroundColor: ["#28a745", "#dc3545"], // Green for occupied, red for available
                                            borderWidth: 1
                                        }]
                                    },
                                    options: {
                                        responsive: true,
                                        plugins: {
                                            legend: {
                                                position: "bottom"
                                            }
                                        }
                                    }
                                });
                            });
                        </script>

                    </div>
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
                                                <th>Tenant</th>
                                                <th>Date</th>

                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php

                                            $sql = "SELECT p.tenantid, p.amount, p.baseddate, t.ID, t.fname, t.lname FROM paymenthistory p
                                        JOIN tenants t ON p.tenantid = t.ID ORDER BY p.baseddate DESC";
                                            $result = $conn->query($sql);
                                            $count = 1;

                                            if ($result->num_rows > 0) {
                                                while ($row = $result->fetch_assoc()) {
                                                    echo "<tr>
                                        <td>{$count}</td>
                                        <td>₱" . number_format($row['amount'], 2) . "</td>
                                      <td>" . htmlspecialchars($row['fname'] . ' ' . $row['lname']) . "</td>
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
                                <div class="card-header bg-warning text-white d-flex align-items-center">
                                    <i class="fas fa-history me-2"></i>
                                    <h5 class="mb-0">Online transactions</h5>
                                </div>
                                <div class="card-body">
                                    <table class="table table-striped table-hover table-sm small">
                                        <thead class="table-primary">
                                            <tr>
                                                <th>Wallet Name</th>
                                                <th>Amount</th>
                                                <th>Wallet Number</th>
                                                <th>Transaction ID</th>
                                                <th>Method</th>
                                                <th>Date and Time</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            // Make sure to include your DB connection before this block
                                            $sql = "SELECT *, user_id FROM payments ORDER BY date_time DESC"; // Fetch latest transactions first
                                            $result = $conn->query($sql);

                                            if ($result->num_rows > 0) {
                                                while ($row = $result->fetch_assoc()) {
                                                    echo "<tr>";
                                                    echo "<td>" . htmlspecialchars($row['name']) . "</td>";
                                                    echo "<td>" . htmlspecialchars($row['amount']) . "</td>";
                                                    echo "<td>" . htmlspecialchars($row['number']) . "</td>";
                                                    echo "<td>" . htmlspecialchars($row['transaction']) . "</td>";
                                                    echo "<td>" . strtoupper(htmlspecialchars($row['method'])) . "</td>";
                                                    echo "<td>" . date("F d, Y - h:i A", strtotime($row['date_time'])) . "</td>";

                                                    // Approve button (disabled if already approved)
                                                    if ($row['status'] == 'Approved') {
                                                        echo "<td><button class='btn btn-success btn-sm' disabled>Approved</button></td>";
                                                    } else {
                                                        // Pass both payment_id and user_id as data attributes
                                                        echo "<td>
                            <button class='btn btn-success btn-sm approve-btn' data-id='{$row['payment_id']}' data-user_id='{$row['user_id']}'>
                                <i class='fas fa-check-circle'></i>
                            </button>
                          </td>";
                                                    }
                                                    echo "</tr>";
                                                }
                                            } else {
                                                echo "<tr><td colspan='7' class='text-center text-muted'>No payment records found.</td></tr>";
                                            }
                                            $conn->close();
                                            ?>
                                        </tbody>
                                    </table>

                                    <!-- Include SweetAlert2 and jQuery -->
                                    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
                                    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

                                    <script>
                                        $(document).ready(function () {
                                            $(".approve-btn").click(function () {
                                                var paymentId = $(this).data("id");
                                                var userId = $(this).data("user_id");
                                                var button = $(this);

                                                Swal.fire({
                                                    title: "Are you sure?",
                                                    text: "You are about to approve this payment.",
                                                    icon: "warning",
                                                    showCancelButton: true,
                                                    confirmButtonColor: "#3085d6",
                                                    cancelButtonColor: "#d33",
                                                    confirmButtonText: "Yes, approve it!"
                                                }).then((result) => {
                                                    if (result.isConfirmed) {
                                                        $.ajax({
                                                            url: "approve_payment.php",
                                                            type: "POST",
                                                            data: { id: paymentId, user_id: userId },
                                                            success: function (response) {
                                                                if (response.trim() === "success") {
                                                                    Swal.fire("Approved!", "The payment has been approved.", "success");
                                                                    button.replaceWith('<button class="btn btn-success btn-sm" disabled>Approved</button>');
                                                                } else if (response.trim() === "already_approved") {
                                                                    Swal.fire("Warning!", "Payment is already approved.", "warning");
                                                                } else if (response.trim() === "not_found") {
                                                                    Swal.fire("Error!", "Payment record not found.", "error");
                                                                } else {
                                                                    Swal.fire("Error!", "Something went wrong.", "error");
                                                                }
                                                            },
                                                            error: function () {
                                                                Swal.fire("Error!", "AJAX request failed.", "error");
                                                            }
                                                        });
                                                    }
                                                });
                                            });
                                        });

                                    </script>


                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Include FontAwesome for icons -->
                    <link rel="stylesheet"
                        href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">




                    <!-- Chart.js Library -->
                    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
                    <script>
                        document.addEventListener("DOMContentLoaded", function () {
                            var ctx = document.getElementById('incomeChart').getContext('2d');
                            var incomeChart = new Chart(ctx, {
                                type: 'bar', // Change to 'line' if needed
                                data: {
                                    labels: <?php echo json_encode($months); ?>,
                                    datasets: [{
                                        label: 'Total Income (PHP)',
                                        data: <?php echo json_encode($income); ?>,
                                        backgroundColor: 'rgba(54, 162, 235, 0.5)',
                                        borderColor: 'rgba(54, 162, 235, 1)',
                                        borderWidth: 2
                                    }]
                                },
                                options: {
                                    responsive: true,
                                    plugins: {
                                        legend: { display: false }
                                    },
                                    scales: {
                                        x: { grid: { display: false } },
                                        y: { beginAtZero: true }
                                    }
                                }
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
            <script src="http://maps.google.com/maps/api/js?sensor=true"></script>
        </div>
        <script type="text/javascript"
            src="https://demo.dashboardpack.com/architectui-html-free/assets/scripts/main.js"></script>
    </main>

    <footer id="footer" class="footer position-relative light-background">

        <div class="container">
            <div class="copyright text-center ">
                <p><strong class="px-1 sitename">ASystems</strong> <span>All Rights Reserved</span></p>
            </div>
            <div class="credits">
                <!-- All the links in the footer should remain intact. -->
                <!-- You can delete the links only if you've purchased the pro version. -->
                <!-- Licensing information: https://bootstrapmade.com/license/ -->
                <!-- Purchase the pro version with working PHP/AJAX contact form: [buy-url] -->
                Designed by <a href="https://google.com/">Johnrid Morata</a>
            </div>
        </div>

    </footer>

    <!-- Scroll Top -->
    <a href="#" id="scroll-top" class="scroll-top d-flex align-items-center justify-content-center"><i
            class="bi bi-arrow-up-short"></i></a>

    <!-- Preloader -->
    <div id="preloader"></div>

    <!-- Vendor JS Files -->
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