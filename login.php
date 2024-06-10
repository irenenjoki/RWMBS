<?php
// Database connection parameters
$servername = "localhost";
$username_db = "root"; // Changed to avoid conflict with form data
$password_db = ""; // Changed to avoid conflict with form data
$database = "water_management";

// Create a new database connection
$conn = new mysqli($servername, $username_db, $password_db, $database);

// Check if there are any errors in the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['name'];
    $password = $_POST['passwords'];

    // Validate credentials (This is a basic example, consider using prepared statements)
    $stmt = $conn->prepare("SELECT * FROM register WHERE name = ? AND passwords = ?");
    $stmt->bind_param("ss", $username, $password);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows == 1) {
        // Successful login
        session_start();
        $_SESSION['username'] = $username;
        header('Location: dashboard.html');
        exit();
    } else {
        // Account doesn't exist
        echo 'Account does not exist. Please check your username and password.';
    }

    $stmt->close();
}

// Close the connection
$conn->close();
?>
