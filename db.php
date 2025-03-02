<?php
$host = "localhost"; 
$user = "u507130350_johnrid	2"; 
$pass = "/0pXU13n*pc"; 
$db_name = "board"; 

$conn = new mysqli($host, $user, $pass, $db_name);

// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}
// echo "Connected successfully";
?>