<?php
$servername = "sql207.epizy.com";
$username = "epiz_28994832";
$password = "3fkkLGiOwpu";
$database_name = 'epiz_28994832_alcu';

// Create connection
$conn = new mysqli($servername, $username, $password, $database_name);

// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}
// echo "Connected successfully";
?>