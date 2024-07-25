<?php
session_start();
header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Sanitize and validate input
    $name = filter_var(trim($_POST['name']), FILTER_SANITIZE_STRING);
    $password = trim($_POST['passwords']); // Plain text password
    $email = filter_var(trim($_POST['email']), FILTER_SANITIZE_EMAIL);
    $phonenumber = filter_var(trim($_POST['phonenumber']), FILTER_SANITIZE_STRING);
    $meter_number = filter_var(trim($_POST['meterNumber']), FILTER_SANITIZE_STRING);

    // Validate email
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo json_encode(['success' => false, 'error' => 'Invalid email format']);
        exit();
    }

    // Validate other fields (you can add more validation if needed)
    if (empty($name) || empty($password) || empty($phonenumber) || empty($meter_number)) {
        echo json_encode(['success' => false, 'error' => 'All fields are required']);
        exit();
    }

    $servername = "localhost";
    $db_username = "root"; // Replace with your database username
    $db_password = "";     // Replace with your database password
    $database = "water_management";

    // Create a new database connection
    $conn = new mysqli($servername, $db_username, $db_password, $database);

    // Check if there are any errors in the connection
    if ($conn->connect_error) {
        echo json_encode(['success' => false, 'error' => 'Connection failed: ' . $conn->connect_error]);
        exit();
    }

    // Check if the username already exists
    $stmt = $conn->prepare("SELECT * FROM register WHERE name = ?");
    if (!$stmt) {
        echo json_encode(['success' => false, 'error' => 'Prepare failed: ' . $conn->error]);
        exit();
    }
    $stmt->bind_param("s", $name);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        echo json_encode(['success' => false, 'error' => 'Account already exists. Please choose a different username.']);
        $stmt->close();
        $conn->close();
        exit();
    }

    // Check if the meter number already exists
    $stmt = $conn->prepare("SELECT * FROM register WHERE meterNumber = ?");
    if (!$stmt) {
        echo json_encode(['success' => false, 'error' => 'Prepare failed: ' . $conn->error]);
        exit();
    }
    $stmt->bind_param("s", $meter_number);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        echo json_encode(['success' => false, 'error' => 'Meter number already registered. Please use a different meter number.']);
        $stmt->close();
        $conn->close();
        exit();
    }

    // Insert the new user into the database
    $insert_stmt = $conn->prepare("INSERT INTO register (name, passwords, email, phonenumber, meterNumber) VALUES (?, ?, ?, ?, ?)");
    if (!$insert_stmt) {
        echo json_encode(['success' => false, 'error' => 'Prepare failed: ' . $conn->error]);
        exit();
    }
    $insert_stmt->bind_param("sssss", $name, $password, $email, $phonenumber, $meter_number);
    if ($insert_stmt->execute()) {
        echo json_encode(['success' => true, 'message' => 'Account created successfully.']);
    } else {
        echo json_encode(['success' => false, 'error' => 'Error: ' . $insert_stmt->error]);
    }

    // Close statements and connection
    $stmt->close();
    $insert_stmt->close();
    $conn->close();
}
?>
