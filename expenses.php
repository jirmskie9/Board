<?php
session_start();
include('db.php');
$id = $_SESSION['Uid'];


// Prepare the SQL query to fetch user details
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
date_default_timezone_set('Asia/Manila');
// echo date_default_timezone_get();
if (isset($_POST["submit_expense"])) {
  $exdesc = $conn->real_escape_string($_POST["exdesc"]);
  $examt = $conn->real_escape_string($_POST["examt"]);
  $exnote = $conn->real_escape_string($_POST["exnote"]);
  $exdate = $conn->real_escape_string($_POST["exdate"]);

  // File Upload Handling
  $targetDir = "uploads/"; // Directory where files will be stored
  $fileName = basename($_FILES["exfile"]["name"]);
  $targetFilePath = $targetDir . $fileName;
  $fileType = pathinfo($targetFilePath, PATHINFO_EXTENSION);

  // Allowed file types (modify as needed)
  $allowedTypes = array("jpg", "png", "pdf", "jpeg", "docx");

  if (in_array($fileType, $allowedTypes)) {
    // Move file to the uploads directory
    if (move_uploaded_file($_FILES["exfile"]["tmp_name"], $targetFilePath)) {
      // Insert data into the database
      $sql = "INSERT INTO expenses (Details, amount, attachment, note, timeanddate)
                  VALUES ('$exdesc', '$examt', '$fileName', '$exnote', '$exdate')";

      if ($conn->query($sql) === TRUE) {
        echo "New expense added successfully!";
      } else {
        echo "Error: " . $conn->error;
      }
    } else {
      echo "File upload failed.";
    }
  } else {
    echo "Invalid file format. Only JPG, PNG, PDF, JPEG, DOCX are allowed.";
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
  <link rel="icon" href="./logo/balay.jpg">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css">
  <!-- Bootstrap 5 -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

  <!-- Bootstrap Table Plugin -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-table@1.21.4/dist/bootstrap-table.min.css">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap-table@1.21.4/dist/bootstrap-table.min.js"></script>


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
  <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-table/1.10.0/bootstrap-table.min.css" rel="stylesheet">
  <link href="https://rawgit.com/vitalets/x-editable/master/dist/bootstrap3-editable/css/bootstrap-editable.css"
    rel="stylesheet">

</head>
<style>
  body {
    background-color: #F8F8F8;
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

  .card .headers {
    color: #555;
    padding: 20px;
    position: relative;
    border-bottom: 1px solid rgba(204, 204, 204, 0.35);
  }

  .card {
    margin: .2in;
  }

  .card .headers .header-dropdown {
    position: absolute;
    top: 13px;
    right: 15px;
    list-style: none;
  }

  .card .headers h2 {
    margin: 0;
    font-size: 18px;
    font-weight: normal;
    color: #111;
  }

  .fixed-table-loading {
    display: hidden;
  }

  td {
    cursor: pointer;
  }

  tbody tr:hover {
    background-color: rgba(41, 103, 182, 0.89);
    color: #FFF;
  }

  .form-item {
    position: relative;
    margin-bottom: 15px
  }

  .form-item input {
    display: block;
    width: 400px;
    height: 40px;
    background: transparent;
    border: solid 1px #ccc;
    transition: all .3s ease;
    padding: 0 15px
  }

  .form-item input:focus {
    border-color: blue
  }

  .form-item label {
    position: absolute;
    cursor: text;
    z-index: 2;
    top: 13px;
    left: 10px;
    font-size: 12px;
    font-weight: bold;
    background: #fff;
    padding: 0 10px;
    color: #999;
    transition: all .3s ease
  }

  .form-item input:focus+label,
  .form-item input:valid+label {
    font-size: 11px;
    top: -5px
  }

  .form-item input:focus+label {
    color: blue
  }

  .file-input {
    display: inline-block;
    text-align: left;
    background: #fff;
    padding: 16px;
    width: 400px;
    position: relative;
    border-radius: 3px;
  }

  .file-input>[type='file'] {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    opacity: 0;
    z-index: 10;
    cursor: pointer;
  }

  .file-input>.button {
    display: inline-block;
    cursor: pointer;
    background: #eee;
    padding: 8px 16px;
    border-radius: 2px;
    margin-right: 8px;
  }

  .file-input:hover>.button {
    background: dodgerblue;
    color: white;
  }

  .file-input>.label {
    color: #333;
    white-space: nowrap;
    opacity: .3;
  }

  .file-input.-chosen>.label {
    opacity: 1;
  }

  .button-58 {
    align-items: center;
    background-color: #06f;
    /*  border: 2px solid #06f;*/
    box-sizing: border-box;
    color: #fff;
    cursor: pointer;
    display: inline-flex;
    fill: #000;
    font-family: Inter, sans-serif;
    font-size: 16px;
    font-weight: 600;
    height: 48px;
    justify-content: center;
    letter-spacing: -.8px;
    line-height: 24px;
    min-width: 140px;
    outline: 0;
    padding: 0 10px;
    text-align: center;
    text-decoration: none;
    transition: all .3s;
    user-select: none;
    -webkit-user-select: none;
    touch-action: manipulation;
  }

  .button-58:focus {
    color: #171e29;
  }

  .button-58:hover {
    background-color: #3385ff;
    border-color: #3385ff;
    fill: #06f;
  }

  .button-58:active {
    background-color: #3385ff;
    border-color: #3385ff;
    fill: #06f;
  }

  @media (min-width: 768px) {
    .button-58 {
      min-width: 100px;
    }
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
        <li><a href="./Documents.php"><i class="bi bi-file-earmark-text navicon"></i> Documents</a></li>
        <li><a href="./Utilities.php"><i class="bi bi-lightbulb navicon"></i> <!-- Represents electricity/utilities -->
        Utility Bills</a></li>
        <li><a href="./Collection.php" class=""><i class="bi bi-cash-stack navicon"></i>Rent Collection</a></li>
        <li><a href="./expenses.php" class="active"><i class="bi bi-receipt navicon"></i> Expenses</a></li>
        <li><a href="./Messages.php"><i class="bi bi-envelope-fill navicon"></i> Messages</a></li>
        <li><a href="./Maintenance.php"><i class="bi bi-newspaper navicon"></i> Maintenance Request</a></li>
        <li><a href="./user.php"><i class="bi bi-people navicon"></i> Users Management</a></li>
        <li><a href="./logout.php"><i class="bi bi-box-arrow-right navicon"></i> Logout</a></li>
      </ul>

    </nav>

  </header>

  <main class="main">
    <div class="page-title">
      <!-- <h1>Rooms</h1> -->
      <div>
        <img src="./logo/balay.jpg" class="fostrap-logo" />
        <h1 class="heading">
          PrimosBH Expenses
        </h1>
      </div>
    </div>



    <div class="table-responsive">
      <div class="card">
        <div class="headers">
          <h2>Expense Manager</h2>
          <ul class="header-dropdown">
            <button type="button" id="PopoverCustomT-1" class="btn btn-info btn-sm waves-effect amDisable modalButton"
              data-toggle="modal" data-target="#newexpense"><i class="fa fa-plus"></i> Add Expenses</button>
          </ul>
        </div>
        <div class="container">
          <div id="toolbar">
            <select class="form-control">
              <option value="">Export Basic</option>
              <option value="all">Export All</option>
              <option value="selected">Export Selected</option>
            </select>
          </div>
          <!-- Expenses Table -->
          <table id="expensesTable" class="table table-hover table-striped table-bordered">
            <thead class="table-dark">
              <tr>
                <th>#</th>
                <th>Description</th>
                <th>Amount</th>
                <th>Date</th>
                <th>Attachment</th>
              </tr>
            </thead>
            <tbody>
              <?php
              $sql = "SELECT *, DATE(timeanddate) AS d FROM expenses";
              $result = $conn->query($sql);
              $count = 1;

              if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) { ?>
                  <tr>
                    <td><?php echo $count++; ?></td>
                    <td><?php echo htmlspecialchars($row['Details']); ?></td>
                    <td>₱<?php echo number_format($row['amount'], 2); ?></td>
                    <td><?php echo htmlspecialchars($row['d']); ?></td>
                    <td class="text-center">
                      <?php
                      if (!empty($row['attachment'])) {
                        $fileExtension = pathinfo($row['attachment'], PATHINFO_EXTENSION);
                        $filePath = "uploads/" . htmlspecialchars($row['attachment']);

                        // Check if the file is an image
                        if (in_array(strtolower($fileExtension), ['jpg', 'jpeg', 'png', 'gif', 'webp'])) {
                          echo "<img src='{$filePath}' alt='Attachment' class='img-thumbnail' width='100' height='100'>";
                        } else {
                          // For non-image files, display a download link
                          echo "<a href='{$filePath}' target='_blank' class='btn btn-sm btn-outline-primary'>Download File</a>";
                        }
                      } else {
                        echo "<span class='text-muted'>No attachment</span>";
                      }
                      ?>
                    </td>

                  </tr>
                <?php }
              } else {
                echo "<tr><td colspan='5' class='text-center text-muted'>No records found</td></tr>";
              }
              ?>
            </tbody>
          </table>

          <!-- Modal for Viewing Attachment -->
          
        </div>
      </div>


    </div>



    <div class="modal fade" id="newexpense" tabindex="-1">
      <div class="modal-dialog">
        <div class="modal-content">
          <button type="button" class="close" data-dismiss="modal"><i class="icon-xs-o-md"></i></button>
          <div class="modal-header">
            <!-- <button type="button" class="close" data-dismiss="modal" aria-label="Close" ><span aria-hidden="true">&times;</span></button> -->
            <h4 class="modal-title caps"><strong>Add Expenses</strong></h4>
          </div>
          <div class="modal-body">
            <form method="post" id="subex" enctype="multipart/form-data">
              <!-- Expense Date -->
              <div class="mb-3">
                <label for="expenses_date" class="form-label">Expense Date</label>
                <input type="date" class="form-control" id="expenses_date" name="exdate" required
                  value="<?php echo date('Y-m-d'); ?>">
              </div>

              <!-- Expense Description -->
              <div class="mb-3">
                <label for="ex-desc" class="form-label">Expense Description</label>
                <input type="text" class="form-control" id="ex-desc" name="exdesc" autocomplete="off" required>
              </div>

              <!-- Expense Amount -->
              <div class="mb-3">
                <label for="ex-amt" class="form-label">Amount</label>
                <input type="number" class="form-control" id="ex-amt" name="examt" autocomplete="off" required>
              </div>

              <!-- Expense Attachment -->
              <div class="mb-3">
                <label class="form-label">Expense Attachments</label>
                <input type="file" class="form-control" name="exfile" required>
              </div>

              <!-- Expense Note -->
              <div class="mb-3">
                <label for="ex-Note" class="form-label">Note</label>
                <textarea class="form-control" id="ex-Note" name="exnote" rows="3" required></textarea>
              </div>

              <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-success" name="submit_expense">Save Expense</button>
              </div>
            </form>

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
    var $table = $('#table');
    $(function () {
      $('#toolbar').find('select').change(function () {
        $table.bootstrapTable('refreshOptions', {
          exportDataType: $(this).val()
        });
      });
    })

    var trBoldBlue = $("table");


    $(trBoldBlue).on("click", "tr", function () {
      $(this).toggleClass("bold-blue");
    });
  </script>
  <script>
    $("tbody tr").click(function () {
      $(this).parent().children().removeClass("selected");
      $(this).addClass("selected");

    });
  </script>
  <script>
    // Also see: https://www.quirksmode.org/dom/inputfile.html

    var inputs = document.querySelectorAll('.file-input')

    for (var i = 0, len = inputs.length; i < len; i++) {
      customInput(inputs[i])
    }

    function customInput(el) {
      const fileInput = el.querySelector('[type="file"]')
      const label = el.querySelector('[data-js-label]')

      fileInput.onchange =
        fileInput.onmouseout = function () {
          if (!fileInput.value) return

          var value = fileInput.value.replace(/^.*[\\\/]/, '')
          el.className += ' -chosen'
          label.innerText = value
        }
    }
  </script>
</body>

</html>