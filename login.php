<?php
session_start();
include('db.php');

// Check if form is submitted
if (isset($_POST['uname']) && isset($_POST['upass'])) {
  $user = $conn->real_escape_string($_POST['uname']);
  $pass = $conn->real_escape_string($_POST['upass']);

  // Query user
  $sql = "SELECT * FROM user WHERE username='$user' AND password='$pass'";
  $result = $conn->query($sql);

  if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $_SESSION['Uid'] = $row['ID'];
    $user_id = $row['user_id'];
  

    // Get current date & time in Asia/Manila timezone
    date_default_timezone_set('Asia/Manila');
    $date_time = date("Y-m-d H:i:s");

    // Insert into logs table
    $log_query = "INSERT INTO logs (user_id, date_time) VALUES ('$user_id', '$date_time')";
    if (!mysqli_query($conn, $log_query)) {
      die("Log insertion failed: " . mysqli_error($conn));
    }

    // Redirect based on user type
    if ($row['Usertype'] == "0") {
      echo "<script>window.location.href = 'Dashboard.php';</script>";
    } else {
      echo "<script>window.location.href = 'User/Home.php';</script>";
    }
    exit();
  } else {
    $_SESSION['status'] = "Invalid username or password!";
    $_SESSION['status_code'] = "error";
    header("Location: login.php");
    exit();
  }
}
?>



<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>


<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <script src="https://kit.fontawesome.com/64d58efce2.js" crossorigin="anonymous"></script>
  <link href="./logo/balay.jpg" rel="icon">
  <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">

  <!-- Vendor CSS Files -->
  <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="assets/vendor/aos/aos.css" rel="stylesheet">
  <link href="assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
  <link href="assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
  <script src="https://cdn.jsdelivr.net/npm/jquery@3.7.1/dist/jquery.slim.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
  <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
  <title>PrimosBH Login</title>
</head>

<style type="text/css">
  @import url('https://fonts.googleapis.com/css2?family=Montserrat:wght@100;200;300;400;500;600;700;800;900&display=swap');


  * {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
    font-family: 'Montserrat', sans-serif;
  }

  body,
  input {
    font-family: 'Montserrat', sans-serif;
  }

  .container {
    position: relative;
    width: 100%;
    background-color: #fff;
    min-height: 100vh;
    overflow: hidden;
  }

  .forms-container {
    position: absolute;
    width: 100%;
    height: 100%;
    top: 0;
    left: 0;
  }

  .signin-signup {
    position: absolute;
    top: 50%;
    transform: translate(-50%, -50%);
    left: 75%;
    width: 50%;
    transition: 1s 0.7s ease-in-out;
    display: grid;
    grid-template-columns: 1fr;
    z-index: 5;
  }

  form {
    display: flex;
    align-items: center;
    justify-content: center;
    flex-direction: column;
    padding: 0rem 5rem;
    transition: all 0.2s 0.7s;
    overflow: hidden;
    grid-column: 1 / 2;
    grid-row: 1 / 2;
  }

  form.sign-up-form {
    opacity: 0;
    z-index: 1;
  }

  form.sign-in-form {
    z-index: 2;
  }

  .title {
    font-size: 2.2rem;
    color: #444;
    margin-bottom: 10px;
  }

  .input-field {
    max-width: 380px;
    width: 100%;
    background-color: #f0f0f0;
    margin: 10px 0;
    height: 55px;
    border-radius: 5px;
    display: grid;
    grid-template-columns: 15% 85%;
    padding: 0 0.4rem;
    position: relative;
  }

  .input-field i {
    text-align: center;
    line-height: 55px;
    color: #acacac;
    transition: 0.5s;
    font-size: 1.1rem;
  }

  .input-field input {
    background: none;
    outline: none;
    border: none;
    line-height: 1;
    font-weight: 600;
    font-size: 1.1rem;
    color: #333;
  }

  .input-field input::placeholder {
    color: #aaa;
    font-weight: 500;
  }

  .social-text {
    padding: 0.7rem 0;
    font-size: 1rem;
  }

  .social-media {
    display: flex;
    justify-content: center;
  }

  .social-icon {
    height: 46px;
    width: 46px;
    display: flex;
    justify-content: center;
    align-items: center;
    margin: 0 0.45rem;
    color: #333;
    border-radius: 50%;
    border: 1px solid #333;
    text-decoration: none;
    font-size: 1.1rem;
    transition: 0.3s;
  }

  .social-icon:hover {
    color: #F86F03;
    border-color: #F86F03;
  }

  .btn {
    width: 150px;
    background-color: #07103c;
    border: none;
    outline: none;
    height: 49px;
    border-radius: 4px;
    color: #fff;
    text-transform: uppercase;
    font-weight: 600;
    margin: 10px 0;
    cursor: pointer;
    transition: 0.5s;
  }

  .btn:hover {
    background-color: #f98c39;
  }

  .panels-container {
    position: absolute;
    height: 100%;
    width: 100%;
    top: 0;
    left: 0;
    display: grid;
    grid-template-columns: repeat(2, 1fr);
  }

  .container:before {
    content: "";
    position: absolute;
    height: 2000px;
    width: 2000px;
    top: -10%;
    right: 48%;
    transform: translateY(-50%);
    background-image: linear-gradient(-45deg, #dcd7e1 0%, #00c5ff 100%);
    transition: 1.8s ease-in-out;
    border-radius: 50%;
    z-index: 6;
  }

  .image {
    width: 100%;
    transition: transform 1.1s ease-in-out;
    transition-delay: 0.4s;
  }

  .panel {
    display: flex;
    flex-direction: column;
    align-items: flex-end;
    justify-content: space-around;
    text-align: center;
    z-index: 6;
  }

  .left-panel {
    pointer-events: all;
    padding: 3rem 17% 2rem 12%;
  }

  .right-panel {
    pointer-events: none;
    padding: 3rem 12% 2rem 17%;
  }

  .panel .content {
    color: #fff;
    transition: transform 0.9s ease-in-out;
    transition-delay: 0.6s;
  }

  .panel h3 {
    font-weight: 600;
    line-height: 1;
    font-size: 1.5rem;
  }

  .panel p {
    font-size: 0.95rem;
    padding: 0.7rem 0;
  }

  .btn.transparent {
    margin: 0;
    background: none;
    border: 2px solid #fff;
    width: 130px;
    height: 41px;
    font-weight: 600;
    font-size: 0.8rem;
  }

  .right-panel .image,
  .right-panel .content {
    transform: translateX(800px);
  }

  /* ANIMATION */

  .container.sign-up-mode:before {
    transform: translate(100%, -50%);
    right: 52%;
  }

  .container.sign-up-mode .left-panel .image,
  .container.sign-up-mode .left-panel .content {
    transform: translateX(-800px);
  }

  .container.sign-up-mode .signin-signup {
    left: 25%;
  }

  .container.sign-up-mode form.sign-up-form {
    opacity: 1;
    z-index: 2;
  }

  .container.sign-up-mode form.sign-in-form {
    opacity: 0;
    z-index: 1;
  }

  .container.sign-up-mode .right-panel .image,
  .container.sign-up-mode .right-panel .content {
    transform: translateX(0%);
  }

  .container.sign-up-mode .left-panel {
    pointer-events: none;
  }

  .container.sign-up-mode .right-panel {
    pointer-events: all;
  }

  @media (max-width: 870px) {

    /*    .alert-box {
  padding: 15px;
    margin-bottom: 20px;
    border: 1px solid transparent;
    border-radius: 4px; 
    position: fixed;
    top: 0;
    right: 0;
    z-index:99; 
    width: 20vh;
}*/
    .container {
      min-height: 800px;
      height: 100vh;
    }

    .signin-signup {
      width: 100%;
      top: 95%;
      transform: translate(-50%, -100%);
      transition: 1s 0.8s ease-in-out;
    }

    p {
      margin-top: 0;
      margin-bottom: 0rem;
    }

    .signin-signup,
    .container.sign-up-mode .signin-signup {
      left: 50%;
    }

    .panels-container {
      grid-template-columns: 1fr;
      grid-template-rows: 1fr 2fr 1fr;
    }

    .panel {
      flex-direction: row;
      justify-content: space-around;
      align-items: center;
      padding: 2.5rem 8%;
      grid-column: 1 / 2;
    }

    .right-panel {
      grid-row: 3 / 4;
    }

    .left-panel {
      grid-row: 1 / 2;
    }

    .image {
      width: 200px;
      transition: transform 0.9s ease-in-out;
      transition-delay: 0.6s;
    }

    .panel .content {
      padding-right: 15%;
      transition: transform 0.9s ease-in-out;
      transition-delay: 0.8s;
    }

    .panel h3 {
      font-size: 1.2rem;
    }

    .panel p {
      font-size: 0.7rem;
      padding: 0.5rem 0;
    }

    .btn.transparent {
      width: 110px;
      height: 35px;
      font-size: 0.7rem;
    }

    .container:before {
      width: 1500px;
      height: 1500px;
      transform: translateX(-50%);
      left: 30%;
      bottom: 68%;
      right: initial;
      top: initial;
      transition: 2s ease-in-out;
    }

    .container.sign-up-mode:before {
      transform: translate(-50%, 100%);
      bottom: 32%;
      right: initial;
    }

    .container.sign-up-mode .left-panel .image,
    .container.sign-up-mode .left-panel .content {
      transform: translateY(-300px);
    }

    .container.sign-up-mode .right-panel .image,
    .container.sign-up-mode .right-panel .content {
      transform: translateY(0px);
    }

    .right-panel .image,
    .right-panel .content {
      transform: translateY(300px);
    }

    .container.sign-up-mode .signin-signup {
      top: .5%;
      transform: translate(-50%, 0);
    }
  }

  @media (max-width: 570px) {

    /*    .alert-box {
  padding: 15px;
    margin-bottom: 20px;
    border: 1px solid transparent;
    border-radius: 4px; 
    position: fixed;
    top: 0;
    right: 0;
    z-index:99; 
    width: 20vh;
}*/
    form {
      padding: 0 1.5rem;
    }

    .image {
      display: none;
    }

    .panel .content {
      padding: 0.5rem 1rem;
    }

    .container {
      padding: 1.5rem;
    }

    .container:before {
      bottom: 72%;
      left: 50%;
    }

    .container.sign-up-mode:before {
      bottom: 28%;
      left: 50%;
    }

    p {
      margin-top: 0;
      margin-bottom: 0rem;
    }
  }

  .form-group {
    margin: 2px;
  }

  h2 {
    margin: 0
  }

  /*.alert{
    position: fixed;
    top: 0;
    right: 0;
    z-index:99;
}*/
  .alert-box {
    padding: 15px;
    margin-bottom: 20px;
    border: 1px solid transparent;
    border-radius: 4px;
    position: fixed;
    top: 0;
    right: 0;
    z-index: 99;
    width: 80vh;
  }

  .success {
    color: #3c763d;
    background-color: #dff0d8;
    border-color: #d6e9c6;
    display: none;
  }

  .failure {
    color: #a94442;
    background-color: #f2dede;
    border-color: #ebccd1;
    display: none;
  }

  .warning {
    color: #8a6d3b;
    background-color: #f2dede;
    border-color: salmon;
    display: none;
  }
</style>

<body>
  <div class="alert-box warning"><b>Error!</b><span style="margin-left: 10px;">Message here</span></div>
  <div class="container">
    <div class="forms-container">
      <div class="signin-signup">
        <form class="sign-in-form" method="post">
          <h2 class="title">Sign in</h2>
          <div class="input-field">
            <i class="bi bi-person"></i>
            <input type="text" name="uname" placeholder="Username" />
          </div>
          <div class="input-field">
            <i class="bi bi-person-fill-lock"></i>
            <input type="password" name="upass" placeholder="Password" />
          </div>
          <input type="submit" value="Login" class="btn solid" />
          <!--           <p class="social-text">Or Sign in with social platforms</p>
          <div class="social-media">
            <a href="#" class="social-icon">
              <i class="fab fa-facebook-f"></i>
            </a>
            <a href="#" class="social-icon">
              <i class="fab fa-twitter"></i>
            </a>
            <a href="#" class="social-icon">
              <i class="fab fa-google"></i>
            </a>
            <a href="#" class="social-icon">
              <i class="fab fa-linkedin-in"></i>
            </a>
          </div> -->
        </form>
        <form action="#" class="sign-up-form">
          <h2 class="title">Sign up</h2>
          <div id="via_ue" class="row">
            <div class="col-xs-12">
              <input type="hidden" name="signin_action" id="id_signin_action" value="login">
              <div class="row">
                <div class="form-group col-sm-5" style="position:static;">
                  <input class="form-control" id="fname" placeholder="Firstname" type="text" name="fname" tabindex="1"
                    value="">
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
                  <select class="form-control" tabindex="4">
                    <option>Select Room</option>
                    <option>Room 1</option>
                  </select>
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
                    autocomplete="off" name="address">
                </div>
                <div class="form-group col-sm-5">
                  <input class="form-control" id="password" placeholder="Password" type="password" tabindex="5"
                    autocomplete="off" name="password">
                </div>
                <p>Incase of Emergency Please Contact:</p>
                <div class="form-group col-sm-5">
                  <input class="form-control" id="address" placeholder="Name of Parent/Guardian" type="text"
                    tabindex="5" autocomplete="off" name="pname">
                </div>
                <div class="form-group col-sm-5">
                  <input class="form-control" id="paddress" placeholder="Address" type="text" tabindex="5"
                    autocomplete="off" name="paddress">
                </div>
                <div class="form-group col-sm-5">
                  <input class="form-control" id="pcontact" placeholder="Contact Number" type="tel" tabindex="5"
                    autocomplete="off" name="pcontact">
                </div>
                <div class="form-group col-sm-5">
                  <input class="form-control" id="relation" placeholder="Relation" type="text" tabindex="5"
                    autocomplete="off" name="relation">
                </div>

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
          <input type="submit" class="btn" value="Sign up" />
        </form>
      </div>
    </div>

    <div class="panels-container">
      <div class="panel left-panel">

        <img src="https://i.ibb.co/6HXL6q1/Privacy-policy-rafiki.png" class="image" alt="" />
      </div>
      <div class="panel right-panel">
        <div class="content">
          <h3>One of us ?</h3>
          <p>
            Reconnect with Primos Boardinghouse using your own account
          </p>
          <button class="btn transparent" id="sign-in-btn">
            Log In Now
          </button>
        </div>
        <img src="https://i.ibb.co/nP8H853/Mobile-login-rafiki.png" class="image" alt="" />
      </div>
    </div>
  </div>

  <script src="app.js"></script>
</body>
<script>
  const sign_in_btn = document.querySelector("#sign-in-btn");
  const sign_up_btn = document.querySelector("#sign-up-btn");
  const container = document.querySelector(".container");

  sign_up_btn.addEventListener("click", () => {
    container.classList.add("sign-up-mode");
  });

  sign_in_btn.addEventListener("click", () => {
    container.classList.remove("sign-up-mode");
  });
</script>
<script>
  function close() {
    $("div.warning").fadeIn(300).delay(1500).fadeOut(400);
  };
  // $(".alert").alert();    
  // window.setTimeout(function() { 
  //     $(".alert").slideUp(function() { 
  //         $(".alert").alert('close');
  //     });
  // }, 5000);
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

</html>