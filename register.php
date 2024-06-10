<?php
// Database connection parameters
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    $password = $_POST['passwords'];
    $email = $_POST['email'];

    $servername = "localhost";
    $db_username = "root"; // Renamed to avoid conflict with form data
    $db_password = "";
    $database = "water_management";

    // Create a new database connection
    $conn = new mysqli($servername, $db_username, $db_password, $database);

    // Check if there are any errors in the connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Check if the account already exists
    $stmt = $conn->prepare("SELECT * FROM register WHERE name = ?");
    $stmt->bind_param("s", $name);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        echo 'Account already exists. Please choose a different username.';
    } else {
        // Insert the new user into the database
        $stmt = $conn->prepare("INSERT INTO register (name, passwords, email) VALUES (?, ?, ?)");
        $stmt->bind_param("sss", $name, $password, $email);
        if ($stmt->execute()) {
            echo 'Account created successfully.';
        } else {
            echo 'Error: ' . $stmt->error;
        }
    }
    header('Location: index.html');
    // Close the statement and connection
    $stmt->close();
    $conn->close();
}
?>
