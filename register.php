<?php
session_start();
// Include database connection file
require_once 'db.php'; // Assuming you have a file for database connection

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Insert new user into database (This is a basic example, consider using prepared statements)
    $query = "INSERT INTO users (username, email, password) VALUES ('$username', '$email', '$password')";
    if (mysqli_query($conn, $query)) {
        // Successful registration
        $_SESSION['username'] = $username;
        header('Location: dashboard.html');
        exit();
    } else {
        // Error during registration
        echo 'Error: ' . mysqli_error($conn);
    }
}
?>
