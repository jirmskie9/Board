<?php
session_start();
$id=$_SESSION['id'];
date_default_timezone_set('Asia/Manila');
if (isset($_POST['submit'])){
/* Attempt MySQL server connection. Assuming
you are running MySQL server with default 
setting (user 'root' with no password) */
$link = mysqli_connect("localhost", 
			"root", "", "board");

// Check connection
if($link === false){
	die("ERROR: Could not connect. "
		. mysqli_connect_error());
}

// Escape user inputs for security
$un= mysqli_real_escape_string(
	$link, $_REQUEST['uname']);
$m = mysqli_real_escape_string(
	$link, $_REQUEST['msg']);
date_default_timezone_set('Asia/Manila');
$ts=date('y-m-d h:ia');

// Attempt insert query execution
$sql = "INSERT INTO chats (uname, msg, dt)
		VALUES ('$un', '$m', '$ts')";
if(mysqli_query($link, $sql)){
	;
} else{
	echo "ERROR: Message not sent!!!";
}
// Close connection
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
  <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Raleway:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">

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
<style>
*{
	box-sizing:border-box;
}
body{
	background-color:#abd9e9;
	font-family:Arial;
}
#container{
	width:700px;
	height:650px;
	background:white;
	margin:0 auto;
	font-size:0;
	border-radius:5px;
	overflow:hidden;
	float: right;
}
main{
	width:700px;
	height:650px;
	display:inline-block;
	font-size:15px;
	vertical-align:top;
}
main header{
	height:80px;
	padding:30px 20px 30px 40px;
	background-color:blue; 
	text-align: center;
}
main header > *{
	display:inline-block;
	vertical-align:top;
}
main header img:first-child{
	width:24px;
	margin-top:8px;
} 
main header img:last-child{
	width:24px;
	margin-top:8px;
}
/*main header div{
	margin-left:100px;
	margin-right:100px;
}*/
main header h2{
	font-size:25px;
	margin-top:5px;
	text-align:center;
	color:#FFFFFF; 
}
main .inner_div{
	padding-left:0;
	margin:0;
	list-style-type:none;
	position:relative;
	overflow:auto;
	height:460px;
	background-image:url(
/*https://media.geeksforgeeks.org/wp-content/cdn-uploads/20200911064223/bg.jpg);*/
	background-position:center;
	background-repeat:no-repeat;
	background-size:cover;
	position: relative;
	border-top:2px solid #fff;
	border-bottom:2px solid #fff;
	
}
main .triangle{
	width: 0;
	height: 0;
	border-style: solid;
	border-width: 0 8px 8px 8px;
	border-color: transparent transparent
	#58b666 transparent;
	margin-left:20px;
	clear:both;
}
main .message{
	padding:10px;
	color:#000;
	margin-left:15px;
	background-color:#58b666;
	line-height:20px;
	max-width:90%;
	display:inline-block;
	text-align:left;
	border-radius:5px;
	clear:both;
}
main .triangle1{
	width: 0;
	height: 0;
	border-style: solid;
	border-width: 0 8px 8px 8px;
	border-color: transparent 
	transparent #6fbced transparent;
	margin-right:20px;
	float:right;
	clear:both;
}
main .message1{
	padding:10px;
	color:#000;
	margin-right:15px;
	background-color:#6fbced;
	line-height:20px;
	max-width:90%;
	display:inline-block;
	text-align:left;
	border-radius:5px;
	float:right;
	clear:both;
}

main footer{
	height:150px;
	padding:20px 30px 10px 20px;
	background-color:#622569;
}
main footer .input1{
	resize:none;
	border:100%;
	display:block;
	width:120%;
	height:55px;
	border-radius:3px;
	padding:20px;
	font-size:13px;
	margin-bottom:13px;
}
main footer #msg{
	resize:none;
	border:100%;
	display:block;
	width:140%;
	height:55px;
	border-radius:3px;
	padding:20px;
	font-size:13px;
	margin-bottom:13px;
	margin-left:20px;
}
main footer .input2{
	resize:none;
	border:100%;
	display:block;
	width:40%;
	height:55px;
	border-radius:3px;
	padding:20px;
	font-size:13px;
	margin-bottom:13px;
	margin-left:100px;
	color:white;
	text-align:center;
	background-color:black;
	border: 2px solid white; 
}
}
main footer textarea::placeholder{
	color:#ddd;
}

  .index-page{
    overflow-x: hidden;
  }
  /* Buttons for sign in form */
 .btn-google {
    color:white;
    background-color: #dd4b39;
    border-color: #dd4b39;
}
.btn-google:hover, .btn-google:focus, .btn-google:active, .btn-google.active {
    background-color: #d73925;
    border-color: #c23321;
    color:white;
}
.btn-twitter {
    color:white;
    background-color: #55acee;
    border-color: #55acee;
}
.btn-twitter:hover, .btn-twitter:focus, .btn-twitter:active, .btn-twitter.active {
    background-color: #3ea1ec;
    border-color: #2795e9;
    color:white;
}
.btn-facebook {
    color:white;
    background-color: #3B5998;
    border-color: #3B5998;
}
.btn-facebook:hover, .btn-facebook:focus, .btn-facebook:active, .btn-facebook.active {
    background-color: #344e86;
    border-color: #2d4373;
    color:white;
}
.btn-vk {
    color:white;
    background-color: #36638e;
    border-color: #36638e;
}
.btn-vk:hover, .btn-vk:focus, .btn-vk:active, .btn-vk.active {
    background-color: #2f567c;
    border-color: #284969;
    color:white;
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
.foot{
  position: absolute;
left: 0;
bottom: 0;
height: 100px;
width: 100%;
}
.page-title{
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
</style>
	<body class="index-page"onload="show_func()">

  <header id="header" class="header dark-background d-flex flex-column">
    <i class="header-toggle d-xl-none bi bi-list"></i>

    <div class="profile-img">
      <img src="assets/img/my-profile-img.jpg" alt="" class="img-fluid rounded-circle">
    </div>

    <a href="index.html" class="logo d-flex align-items-center justify-content-center">
      <!-- Uncomment the line below if you also wish to use an image logo -->
      <!-- <img src="assets/img/logo.png" alt=""> -->
      <h1 class="sitename">User Fullname</h1>
    </a>

    <div class="social-links text-center">
      <a href="#" class="twitter"><i class="bi bi-twitter-x"></i></a>
      <a href="#" class="facebook"><i class="bi bi-facebook"></i></a>
      <a href="#" class="instagram"><i class="bi bi-instagram"></i></a>
    </div>

    <nav id="navmenu" class="navmenu">
<ul>
        <li><a href="#hero" ><i class="bi bi-house navicon"></i>Dashboard</a></li>
        <li><a href="#about"class="active"><i class="bi bi-person navicon"></i> Occupants</a></li>
        <li><a href="#resume" ><i class="bi bi-door-open navicon"></i> Rooms</a></li>
        <li><a href="#portfolio"><i class="bi bi-receipt navicon"></i> Expenses</a></li>
        <li><a href="#services"><i class="bi bi-hdd-stack navicon"></i> History</a></li>
      </ul>
          
    </nav>

  </header>

  <main class="main">
<div id="container">
	<main>
		<header>

			<div>
				<h2>GROUP CHAT</h2>
			</div>
			
		</header>

<script>
function show_func(){

var element = document.getElementById("chathist");
	element.scrollTop = element.scrollHeight;

}
</script>

<form id="myform" action="chat.php" method="POST" >
<div class="inner_div" id="chathist">
<?php 
$host = "localhost"; 
$user = "root"; 
$pass = ""; 
$db_name = "board"; 
$con = new mysqli($host, $user, $pass, $db_name);

$query = "SELECT * FROM chats";
$run = $con->query($query); 
$i=0;

while($row = $run->fetch_array()) : 
if($i==0){
$i=5;
$first=$row;
?>
<div id="triangle1" class="triangle1"></div>
<div id="message1" class="message1"> 
<span style="color:white;float:right;">
<?php echo $row['msg']; ?></span> <br/>
<div>
<span style="color:black;float:left;
font-size:10px;clear:both;">
	<?php echo $row['uname']; ?>, 
		<?php echo $row['dt']; ?>
</span>
</div>
</div>
<br/><br/>
<?php
}
else
{
if($row['uname']!=$first['uname'])
{
?>
<div id="triangle" class="triangle"></div>
<div id="message" class="message"> 
<span style="color:white;float:left;">
<?php echo $row['msg']; ?>
</span> <br/>
<div>
<span style="color:black;float:right;
		font-size:10px;clear:both;">
<?php echo $row['uname']; ?>, 
		<?php echo $row['dt']; ?>
</span>
</div>
</div>
<br/><br/>
<?php
} 
else
{
?>
<div id="triangle1" class="triangle1"></div>
<div id="message1" class="message1"> 
<span style="color:white;float:right;">
<?php echo $row['msg']; ?>
</span> <br/>
<div>
<span style="color:black;float:left;
		font-size:10px;clear:both;"> 
<?php echo $row['uname']; ?>, 
	<?php echo $row['dt']; ?>
</span>
</div>
</div>
<br/><br/>
<?php
}
}
endwhile;
?>
</div>
	<footer>
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
	</footer>
</form>
</main> 
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
  <a href="#" id="scroll-top" class="scroll-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

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
