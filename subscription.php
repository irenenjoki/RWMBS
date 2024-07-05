<?php

// Replace these variables with your actual database connection details
$servername = "localhost";
$username = "root";
$password = ""; // Assuming you are using no password for localhost
$dbname = "water_management";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Assuming you have already established a database connection in your project
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Sanitize input to prevent SQL injection
    $email = $_POST['email'];

    // Prepare SQL statement to insert data into the 'subscriptions' table
    $stmt = $conn->prepare("INSERT INTO subscriptions (email) VALUES (?)");

    if ($stmt === false) {
        die('Error preparing statement: ' . $conn->error);
    }

    // Bind parameters and execute the statement
    $stmt->bind_param("s", $email);

    if ($stmt->execute()) {
        // Close statement and connection
        $stmt->close();
        $conn->close();

        // Alert message and redirect to landing.html
        echo "<script>alert('Subscription added successfully!');</script>";
        echo "<script>window.location.replace('landing.html');</script>";
        exit; // Ensure no further code execution after redirection
    } else {
        die('Error executing statement: ' . $stmt->error);
    }
}

// Close statement and connection (in case of no POST request)
$conn->close();

?>
