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

// Code maintained by Vivek
echo "Jai shree ram Ram";
echo "Welcome, you are logged in! Vivek Raj Singh ";
echo '<br><a href="?logout">Logout</a>';

