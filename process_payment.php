<?php
// Start the session (if not already started)
session_start();

// Database connection parameters
$servername = "localhost";
$username_db = "root"; // Database username
$password_db = "";     // Database password
$database = "water_management";

try {
    // Create a new database connection
    $db = new PDO("mysql:host=$servername;dbname=$database", $username_db, $password_db);
    // Set the PDO error mode to exception
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $meter_number = $_POST['meterNumber'];
        $amount_in_Ksh = $_POST['paymentAmount'];
        $payment_mode = $_POST['paymentMethod'];

        // Simulate M-Pesa payment process
        $transaction_id = "TX" . rand(1000, 9999); // Generate a random transaction ID
        $payment_status = "Success"; // Simulate a successful payment

        // Prepare the SQL statement
        $stmt = $db->prepare("INSERT INTO process_payment (meterNumber, paymentAmount, paymentMethod, transactionId, paymentStatus) VALUES (?, ?, ?, ?, ?)");
        
        // Execute the statement with provided data
        if ($stmt->execute([$meter_number, $amount_in_Ksh, $payment_mode, $transaction_id, $payment_status])) {
            // Redirect to landing page on success
            header("Location: landing.html");
            exit();
        } else {
            // If execution fails, display an error
            echo "Error: Unable to process payment.";
        }
    }
} catch (PDOException $e) {
    // Display error message if connection or query fails
    echo "Error: " . $e->getMessage();
}

// Close the connection (optional, as it will be closed automatically at the end of the script)
$db = null;
?>
