<?php
session_start();

define('CODE', 'THIWASCO22$'); // Define your company code here

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve and sanitize form data
    $username = htmlspecialchars(trim($_POST['username']));
    $password = htmlspecialchars(trim($_POST['password']));
    $code = htmlspecialchars(trim($_POST['code']));

    // Basic validation
    if (empty($username) || empty($password) || empty($code)) {
        $response = array('success' => false, 'error' => 'Username, password, and company code are required.');
        echo json_encode($response);
        exit;
    }

    // Check if the company code is correct
    if ($code !== CODE) {
        $response = array('success' => false, 'error' => 'Invalid company code.');
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

    // Check if username and password are correct
    $user_query = "SELECT * FROM users WHERE username = ? AND password = ?";
    $stmt_user = $conn->prepare($user_query);
    if (!$stmt_user) {
        $response = array('success' => false, 'error' => 'Preparation failed: ' . $conn->error);
        echo json_encode($response);
        exit;
    }
    $stmt_user->bind_param("ss", $username, $password);
    $stmt_user->execute();
    $stmt_user->store_result();

    if ($stmt_user->num_rows > 0) {
        // Successful login
        $_SESSION['username'] = $username;
        $response = array('success' => true);
        echo json_encode($response);
    } else {
        // Invalid username or password
        $response = array('success' => false, 'error' => 'Invalid username or password.');
        echo json_encode($response);
    }

    // Close statements and database connection
    $stmt_user->close();
    $conn->close();
} else {
    // Handle cases where the form was not submitted properly
    $response = array('success' => false, 'error' => 'Form submission method not recognized.');
    echo json_encode($response);
}
?>
