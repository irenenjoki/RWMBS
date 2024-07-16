<?php

// Database connection parameters
$servername = "localhost";
$username_db = "root"; // Database username
$password_db = "";     // Database password
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
    $meter_number = $_POST['meterNumber'];

    // Validate credentials and meter number
    $stmt = $conn->prepare("SELECT * FROM register WHERE name = ? AND passwords = ? AND meterNumber = ?");
    $stmt->bind_param("sss", $username, $password, $meter_number);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows == 1) {
        // Successful login
        session_start();
        $_SESSION['username'] = $username;
        echo json_encode(['success' => true]);
    } else {
        // Account doesn't exist
        echo json_encode(['success' => false, 'error' => 'Account does not exist. Please check your username, password, and meter number.']);
    }

    $stmt->close();
}

// Close the connection
$conn->close();
?>
