<?php
session_start();

// Check if form is submitted via POST method
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve and sanitize form data
    $username = htmlspecialchars(trim($_POST['username']));
    $password = htmlspecialchars(trim($_POST['password']));

    // Basic validation (you should add more as needed)
    if (empty($username) || empty($password)) {
        $response = array('success' => false, 'error' => 'Username and password are required.');
        echo json_encode($response);
        exit;
    }

    // Database connection parameters
    $servername = "localhost";
    $username_db = "root"; // Replace with your MySQL username
    $password_db = ""; // Replace with your MySQL password
    $dbname = "admin2"; // Replace with your MySQL database name

    // Create connection
    $conn = new mysqli($servername, $username_db, $password_db, $dbname);

    // Check connection
    if ($conn->connect_error) {
        $response = array('success' => false, 'error' => 'Connection failed: ' . $conn->connect_error);
        echo json_encode($response);
        exit;
    }

    // Check if username already exists
    $check_query = "SELECT * FROM users WHERE username = ?";
    $stmt = $conn->prepare($check_query);
    if (!$stmt) {
        $response = array('success' => false, 'error' => 'Preparation failed: ' . $conn->error);
        echo json_encode($response);
        exit;
    }
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        // Username already exists
        $response = array('success' => false, 'error' => 'Username already exists.');
        echo json_encode($response);
        exit;
    }

    // Insert user into database
    $insert_query = "INSERT INTO users (username, password) VALUES (?, ?)";
    $stmt_insert = $conn->prepare($insert_query);
    if (!$stmt_insert) {
        $response = array('success' => false, 'error' => 'Preparation failed: ' . $conn->error);
        echo json_encode($response);
        exit;
    }
    $stmt_insert->bind_param("ss", $username, $password);

    if ($stmt_insert->execute()) {
        // Registration successful
        $response = array('success' => true);
        echo json_encode($response);
    } else {
        // Registration failed
        $response = array('success' => false, 'error' => 'Failed to register user: ' . $conn->error);
        echo json_encode($response);
    }

    // Close statements and database connection
    $stmt->close();
    $stmt_insert->close();
    $conn->close();
} else {
    // Handle cases where the form was not submitted properly
    $response = array('success' => false, 'error' => 'Form submission method not recognized.');
    echo json_encode($response);
}
?>
