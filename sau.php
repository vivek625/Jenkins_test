<?php
include 'db_config.php';

// User credentials
$username = 'saurav';
$password = 'saurav';
$email = 'sair@123.com';

// Hash the password
$hashed_password = password_hash($password, PASSWORD_DEFAULT);

// Prepare the SQL statement
$sql = "INSERT INTO users (username, password, email) VALUES (?, ?, ?)";
$stmt = $conn->prepare($sql);

if ($stmt === false) {
    die('MySQL prepare error: ' . $conn->error);
}

// Bind parameters and execute
$stmt->bind_param("sss", $username, $hashed_password, $email);
if ($stmt->execute()) {
    echo "User inserted successfully.";
} else {
    echo "Error inserting user: " . $stmt->error;
}

// Close statement and connection
$stmt->close();
$conn->close();
?>

