<?php
$servername = "3.108.237.74";
$username = "root";
$password = "your_password"; // Replace with the actual password
$database = "my_database"; // Replace with your database name

// Create connection using mysqli
$conn = new mysqli($servername, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>

