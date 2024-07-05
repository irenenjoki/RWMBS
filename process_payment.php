<?php
if ($_SERVER["REQUEST_METHOD"] == 'POST') {
    // Retrieve form data
    if (isset($_POST['paymentAmount']) && isset($_POST['paymentMethod']) && isset($_POST['meterNumber'])) {
        $paymentAmount = $_POST['paymentAmount'];
        $paymentMethod = $_POST['paymentMethod'];
        $meterNumber = $_POST['meterNumber'];

        // Perform payment processing here (e.g., charge credit card, validate payment, etc.)

        // Dummy response for demonstration
        $paymentStatus = "Success"; // Change this based on actual payment processing

        if ($paymentStatus === "Success") {
            // Database connection parameters
            $servername = "localhost";
            $username = "root";
            $password = "";
            $database = "water_management";

            // Create connection
            $conn = new mysqli($servername, $username, $password, $database);

            // Check connection
            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }

            // Prepare and bind the SQL statement
            $stmt = $conn->prepare("INSERT INTO process_payment (meterNumber, paymentMethod, paymentAmount) VALUES (?, ?, ?)");
            $stmt->bind_param("ssd", $meterNumber, $paymentMethod, $paymentAmount); // "s" for string, "d" for double/decimal value

            // Execute the statement
            if ($stmt->execute()) {
                // Alert message and redirect to landing.html
                echo "<script>alert('Payment added successfully!');</script>";
                echo "<script>window.location.replace('landing.html');</script>";
                exit;
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
        echo "<p>Payment amount, method, and meter number are required.</p>";
    }
} else {
    // Redirect back to payment page if accessed directly
    header("Location: payment.html");
    exit;
}
?>
