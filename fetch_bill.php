<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $meterNumber = $_POST["meterNumber"];

    // Database connection
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "water_management";

    $conn = new mysqli($servername, $username, $password, $dbname);
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Fetch the bill amount using the meter number
    $stmt = $conn->prepare("SELECT Amount FROM bills WHERE meterNumber = ?");
    $stmt->bind_param("s", $meterNumber);
    $stmt->execute();
    $stmt->bind_result($amount);
    $stmt->fetch();
    $stmt->close();

    // Fetch payment history using the meter number
    $stmt = $conn->prepare("SELECT id, Reading_Date, Amount, Consumption, Status FROM bills WHERE meterNumber = ? ORDER BY Reading_Date DESC");
    $stmt->bind_param("s", $meterNumber);
    $stmt->execute();
    $result = $stmt->get_result();
    $paymentHistory = $result->fetch_all(MYSQLI_ASSOC);
    $stmt->close();
    $conn->close();

    if ($amount !== null) {
        echo "<h2>Bill Amount</h2>";
echo "<p>Meter Number: " . htmlspecialchars($meterNumber) . "</p>";
echo "<p>Amount Due: KES " . htmlspecialchars($amount) . "</p>";
echo "<form action='process_payment.php' method='post'>
        <input type='hidden' name='meterNumber' value='" . htmlspecialchars($meterNumber) . "'>
        <input type='hidden' name='amount' value='" . htmlspecialchars($amount) . "'>
        <button type='button' class='btn btn-primary' onclick=\"window.location.href='payment.html'\">Pay Now</button>
      </form>";

    } else {
        echo "<h2>Error!</h2>";
        echo "<p>No bill found for Meter Number: " . htmlspecialchars($meterNumber) . "</p>";
    }
}
?>
