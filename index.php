<?php
session_start();

// Check if the user is logged in
if (!isset($_SESSION['loggedin']) || !$_SESSION['loggedin']) {
    header('Location: login.php');
    exit();
}

// Logout logic
if (isset($_GET['logout'])) {
    session_destroy();
    header('Location: login.php');
    exit();
}

// Include the database configuration file
include 'db_config.php';

// Query to fetch user data
$user_id = $_SESSION['user_id']; // Assuming you store user ID in session after login
$sql = "SELECT username, email FROM users WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $username = $row['username'];
    $email = $row['email'];
} else {
    $username = 'Unknown User';
    $email = 'Unknown Email';
}

$stmt->close();
$conn->close();

// Display user information
echo "Jai Shree Ram<br>";
echo "Welcome, $username! Vivek Raj Singh<br>";
echo "Your email: $email<br>";
echo '<br><a href="?logout">Logout</a>';
?>

