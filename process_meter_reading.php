<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $meterNumber = $_POST["meterNumber"];
    $amount = $_POST["amount"];

    // Database connection
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "water_management";

    $conn = new mysqli($servername, $username, $password, $dbname);
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Record the payment
    $stmt = $conn->prepare("INSERT INTO payments (meterNumber, Amount) VALUES (?, ?)");
    $stmt->bind_param("sd", $meterNumber, $amount);
    if ($stmt->execute()) {
        echo "Payment recorded successfully.";
    } else {
        echo "Error recording payment: " . $stmt->error;
    }
    $stmt->close();
    $conn->close();
}
?>
