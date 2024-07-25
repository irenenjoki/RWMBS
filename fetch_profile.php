<?php
// Start session
session_start();

// Check if user is logged in
if (!isset($_SESSION['username'])) {
    // Redirect to login page if user is not logged in
    header('Location: index.php');
    exit();
}

// Database connection details
$servername = "localhost";
$username_db = "root"; // Replace with your database username
$password_db = "";     // Replace with your database password
$database = "water_management";

// Create a new database connection
$conn = new mysqli($servername, $username_db, $password_db, $database);

// Check if there are any errors in the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Retrieve user's profile information from the database
$username = $_SESSION['username'];
$stmt = $conn->prepare("SELECT * FROM register WHERE name = ?");
$stmt->bind_param("s", $username);
$stmt->execute();
$result = $stmt->get_result();
$user = $result->fetch_assoc();

// Close statement and connection
$stmt->close();
$conn->close();

// Return user data as JSON
header('Content-Type: application/json');
echo json_encode($user);
?>
