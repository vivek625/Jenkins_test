<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include 'db_config.php';

// Initialize message variable
$message = "";

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Get user input
    $username = $_POST['username'];
    $password = $_POST['password'];
    $email = $_POST['email'];

    // Debugging output
    echo "<pre>";
    print_r($_POST);
    echo "</pre>";

    // Validate input
    if (empty($username) || empty($password) || empty($email)) {
        $message = "All fields are required.";
    } else {
        // Hash the password
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

        // Prepare and execute the SQL query
        $sql = "INSERT INTO users (username, password, email) VALUES (?, ?, ?)";
        $stmt = $conn->prepare($sql);

        if ($stmt === false) {
            $message = 'MySQL prepare error: ' . $conn->error;
        } else {
            $stmt->bind_param("sss", $username, $hashed_password, $email);
            if ($stmt->execute()) {
                $message = "User registered successfully.";
            } else {
                $message = "Error registering user: " . $stmt->error;
            }
            $stmt->close();
        }

        $conn->close();
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Register</title>
</head>
<body>
    <h2>Register</h2>
    <?php if ($message): ?>
        <p><?php echo htmlspecialchars($message); ?></p>
    <?php endif; ?>
    <form action="register.php" method="post">
        <label for="username">Username:</label>
        <input type="text" id="username" name="username" required><br><br>
        
        <label for="password">Password:</label>
        <input type="password" id="password" name="password" required><br><br>
        
        <label for="email">Email:</label>
        <input type="email" id="email" name="email" required><br><br>
        
        <input type="submit" value="Register">
    </form>
</body>
</html>

