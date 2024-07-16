<?php
header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Sanitize and validate input
    $name = $_POST['name'];
    $password = $_POST['passwords']; // Plain text password
    $email = $_POST['email'];
    $phonenumber = $_POST['phonenumber'];
    $meter_number = $_POST['meterNumber'];

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
    $insert_stmt->bind_param("ssssi", $name, $password, $email, $phonenumber, $meter_number);
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
