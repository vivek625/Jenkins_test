<?php
include 'db_config.php';

$username = 'saurav';
$password = 'saurav'; // Plain text password

// Hash the password
$hashed_password = password_hash($password, PASSWORD_BCRYPT);

// Insert into database
$sql = "INSERT INTO users (username, password) VALUES (?, ?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param("ss", $username, $hashed_password);
$stmt->execute();

if ($stmt->affected_rows > 0) {
    echo "User created successfully.";
} else {
    echo "Error: " . $stmt->error;
}

$stmt->close();
$conn->close();
?>
