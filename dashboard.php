<?php
session_start();

// Include the database configuration file
include 'db_config.php';

// Check if the user is logged in
if (!isset($_SESSION['loggedin']) || !$_SESSION['loggedin']) {
    echo "You must be logged in to view this page.";
    echo '<br><a href="index.php">Go to Login</a>';
    exit();
}

// Logout logic
if (isset($_GET['logout'])) {
    session_destroy();
    header('Location: index.php'); // Redirect to login page
    exit();
}

// Query to fetch user data
$user_id = $_SESSION['user_id'];
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
?>

<!DOCTYPE html>
<html>
<head>
    <title>Dashboard</title>
</head>
<body>
    <h2>Welcome, <?php echo htmlspecialchars($username); ?>!</h2>
    <p>Your email: <?php echo htmlspecialchars($email); ?></p>
    <a href="?logout">Logout</a>
</body>
</html>

