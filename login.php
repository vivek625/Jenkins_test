<?php
session_start();
include 'db_config.php';

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Validate input
    if (empty($username) || empty($password)) {
        header('Location: index.php?error=Please fill in both fields');
        exit();
    }

    // Prepare and execute the SQL query
    $sql = "SELECT id, password FROM users WHERE username = ?";
    $stmt = $conn->prepare($sql);

    if ($stmt === false) {
        die('MySQL prepare error: ' . $conn->error);
    }

    $stmt->bind_param("s", $username);
    $stmt->execute();
    $stmt->store_result();
    
    if ($stmt->num_rows > 0) {
        $stmt->bind_result($user_id, $hashed_password);
        $stmt->fetch();

        // Verify password
        if (password_verify($password, $hashed_password)) {
            $_SESSION['loggedin'] = true;
            $_SESSION['user_id'] = $user_id;
            header('Location: dashboard.php'); // Redirect to dashboard
            exit();
        } else {
            header('Location: index.php?error=Invalid username or password');
            exit();
        }
    } else {
        header('Location: index.php?error=Invalid username or password');
        exit();
    }

    $stmt->close();
    $conn->close();
} else {
    // Redirect to login page if the request method is not POST
    header('Location: index.php');
    exit();
}

