<?php
$host = "localhost"; 
$user = "u507130350_johnrid"; 
$pass = "/0pXU13n*pc"; 
$db_name = "u507130350_board"; 

$conn = new mysqli($host, $user, $pass, $db_name);

// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}
// echo "Connected successfully";
?>