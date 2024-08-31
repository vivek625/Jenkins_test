<?php
$servername = "3.110.49.140";
$username = "root";
$password = "password"; // Replace with your actual password
$database = "my_database"; // Replace with your database name

// Create connection using mysqli
$conn = new mysqli($servername, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
