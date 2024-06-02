<?php
session_start();
// Include database connection file
require_once 'db.php'; // Assuming you have a file for database connection

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Validate credentials (This is a basic example, consider using prepared statements)
    $query = "SELECT * FROM users WHERE username = '$username' AND password = '$password'";
    $result = mysqli_query($conn, $query);

    if (mysqli_num_rows($result) == 1) {
        // Successful login
        $_SESSION['username'] = $username;
        header('Location: dashboard.html');
        exit();
    } else {
        // Account doesn't exist
        echo 'Account does not exist. Please check your username and password.';
    }
}
?>
