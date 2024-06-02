<?php
session_start();

// Database connection parameters
$servername = "your_servername";
$username = "your_username";
$password = "your_password";
$database = "your_database";

// Create connection
$conn = new mysqli($servername, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Validate credentials
    $query = "SELECT * FROM users WHERE username = '$username' AND password = '$password'";
    $result = $conn->query($query);

    if ($result->num_rows == 1) {
        // Successful login
        $_SESSION['username'] = $username;
        header('Location: dashboard.html');
        exit();
    } else {
        // Account doesn't exist
        echo 'Account does not exist. Please check your username and password.';
    }
}

// Close the connection
$conn->close();
?>
