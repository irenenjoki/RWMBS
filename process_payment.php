<?php
if ($_SERVER["REQUEST_METHOD"] == 'POST') {
    // Retrieve form data
    if (isset($_POST['paymentAmount']) && isset($_POST['paymentMethod'])) {
        $paymentAmount = $_POST['paymentAmount'];
        $paymentMethod = $_POST['paymentMethod'];
        
        // Perform payment processing here (e.g., charge credit card, validate payment, etc.)
        
        // Dummy response for demonstration
        $paymentStatus = "Success"; // Change this based on actual payment processing
        
        if ($paymentStatus === "Success") {
            // Database connection parameters
            $servername = "localhost";
            $username = "root";
            $password = "";
            $database = "water_management";
            
            // Insert payment details into the database
            $conn = new mysqli($servername, $username, $password, $database);
            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }
            
            // Prepare and bind the SQL statement
            $stmt = $conn->prepare("INSERT INTO process_payment (paymentMethod, paymentAmount) VALUES (?, ?)");
            $stmt->bind_param("sd", $paymentMethod, $paymentAmount); // "s" indicates a string, "d" indicates a double/decimal value
            
            // Execute the statement
            if ($stmt->execute()) {
                echo "<h2>Payment Successful!</h2>";
                echo "<p>Payment Method: $paymentMethod</p>";
                echo "<p>Amount Paid: $paymentAmount</p>";
            } else {
                echo "<h2>Error!</h2>";
                echo "<p>Unable to process payment. Please try again later.</p>";
            }
            
            // Close the statement and connection
            $stmt->close();
            $conn->close();
        } else {
            echo "<h2>Payment Failed!</h2>";
            echo "<p>Unable to process payment. Please try again later.</p>";
        }
    } else {
        echo "<h2>Error!</h2>";
        echo "<p>Payment amount and method are required.</p>";
    }
} else {
    // Redirect back to payment page if accessed directly
    header("Location: payment.html");
    exit;
}
?>
