<style>
  h6{
    color: silver;
  }
</style>
<?php 
session_start();
$id=$_SESSION['Uid'];
date_default_timezone_set('Asia/Manila');

$host = "localhost"; 
$user = "u507130350_johnrid"; 
$pass = "Johnrid123"; 
$db_name = "u507130350_board"; 
// $host = "localhost"; 
// $user = "root"; 
// $pass = ""; 
// $db_name = "board"; 
$con = new mysqli($host, $user, $pass, $db_name);
$dates=date('F d, Y');
// $tdate=DATE_FORMAT(date,'%M %d, %Y %h:%i');
if(isset($_SESSION['ucid'])){
// $_SESSION['ucid']=$_GET['ucid'];
$ucid = $_SESSION['ucid'] ?? 0;
}
$query = "SELECT *,DATE_FORMAT(dt,'%M %d, %Y')as dt,DATE_FORMAT(dt,'%h:%i %p')as tim FROM chats where category='Message' and receiver='$ucid'";
$run = $con->query($query); 
$i=0;

while($row = $run->fetch_array()) : 
if($i==0){
$i=5;
$first=$row;
?>

    <h6 style="text-align: center;"><?php if($dates==$row['dt']){echo 'Today '.$row['tim'];}else{ echo $row['dt'].' '.$row['tim'];}  ?></h6>
<div id="triangle1" class="triangle1"></div>
<div id="message1" class="message1"> 
<span style="color:white;float:right;">
<?php echo $row['msg']; ?></span> <br/>
<div>
<span style="color:black;float:left;
font-size:10px;clear:both;">
  <?php echo $row['sender']; ?>
</span>
</div>

</div>
<br><br><br><br>
<?php
}
else
{
if($row['sender']!=$first['sender'])
{
?>
    <h6 style="text-align: center;"><?php if($dates==$row['dt']){echo 'Today '.$row['tim'];}else{ echo $row['dt'].' '.$row['tim'];}  ?></h6>
<div id="triangle" class="triangle"></div>
<div id="message" class="message"> 
<span style="color:white;float:left;">
<?php echo $row['msg']; ?>
</span> <br/>
<div>
<span style="color:black;float:right;
    font-size:10px;clear:both;">
<?php echo $row['sender']; ?>
</span>
</div>

</div>
<br><br><br><br>
<?php
} 
else
{
?>
    <h6 style="text-align: center;"><?php if($dates==$row['dt']){echo 'Today '.$row['tim'];}else{ echo $row['dt'].' '.$row['tim'];}  ?></h6>

<div id="triangle1" class="triangle1"></div>
<div id="message1" class="message1"> 
<span style="color:white;float:right;">
<?php echo $row['msg']; ?>
</span> <br/>
<div>
<span style="color:black;float:left;
    font-size:10px;clear:both;"> 
<?php echo $row['sender']; ?>
</span>
</div>
</div>

<br><br><br><br><?php
}

}
endwhile;
?>
<script>
  var tm;
$(".message").mouseup(function(){
  clearTimeout(tm);
  return;
});
$(".message").mousedown(function(){
  tm = window.setTimeout(function(){
    alert('Test');
  },2000);
  return;
});
</script>