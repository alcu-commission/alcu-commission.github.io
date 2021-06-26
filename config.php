<?php
$servername = "localhost";
$username = "admin";
$password = "lloydpogi23";
$database_name = 'todo';

// Create connection
$conn = new mysqli($servername, $username, $password, $database_name);

// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}
echo "Connected successfully";
?>