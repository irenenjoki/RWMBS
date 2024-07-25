<?php
// Database configuration
$servername = "localhost";
$username = "root";
$password = ""; // Assuming no password for localhost
$dbname = "water_management";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Collect form data
    $fullname = mysqli_real_escape_string($conn, $_POST['fullname']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $phone = mysqli_real_escape_string($conn, $_POST['phone']);
    $message = mysqli_real_escape_string($conn, $_POST['message']);

    // SQL query to insert data into the database
    $sql = "INSERT INTO contactus (fullname, email, phone, message) VALUES ('$fullname', '$email', '$phone', '$message')";

    // Execute query and check for success
    if ($conn->query($sql) === TRUE) {
        // Send JSON response for success
        header('Content-Type: application/json');
        echo json_encode(array('status' => 'success'));
    } else {
        // Send JSON response for error
        header('Content-Type: application/json');
        echo json_encode(array('status' => 'error', 'message' => $conn->error));
    }
}

// Close connection
$conn->close();
?>
