<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    $password = $_POST['passwords'];
    $email = $_POST['email'];
    $meter_number = $_POST['meterNumber'];

    $servername = "localhost";
    $db_username = "root"; // Replace with your database username
    $db_password = "";     // Replace with your database password
    $database = "water_management";

    // Create a new database connection
    $conn = new mysqli($servername, $db_username, $db_password, $database);

    // Check if there are any errors in the connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Check if the username already exists
    $stmt = $conn->prepare("SELECT * FROM register WHERE name = ?");
    $stmt->bind_param("s", $name);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        echo 'Account already exists. Please choose a different username.';
    } else {
        // Check if the meter number already exists
        $stmt = $conn->prepare("SELECT * FROM register WHERE meterNumber = ?");
        $stmt->bind_param("s", $meter_number);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            echo 'Meter number already registered. Please use a different meter number.';
        } else {
            // Insert the new user into the database
            $stmt = $conn->prepare("INSERT INTO register (name, passwords, email, meterNumber) VALUES (?, ?, ?, ?)");
            $stmt->bind_param("ssss", $name, $password, $email, $meter_number);
            if ($stmt->execute()) {
                echo 'Account created successfully.';
                // Redirect to payment.html after successful registration
                header('Location: payment.html');
                exit(); // Stop further execution
            } else {
                echo 'Error: ' . $stmt->error;
            }
        }
    }

    // Close the statement and connection
    $stmt->close();
    $conn->close();
}
?>


