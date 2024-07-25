<?php
// Check if meterNumber is set and not empty
if(isset($_POST['meterNumber']) && !empty($_POST['meterNumber'])) {
    // Sanitize input to prevent SQL injection (you can expand this based on your needs)
    $meterNumber = htmlspecialchars($_POST['meterNumber']);

    // Replace with your actual database connection details
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "water_management";

    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Prepare SQL statement with placeholders
    $sql = "SELECT * FROM process_payment WHERE meterNumber = ?";

    // Use prepared statement to prevent SQL injection
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $meterNumber); // "s" indicates the type of the parameter (string)
    $stmt->execute();
    $result = $stmt->get_result();

    // Check if any rows were returned
    if ($result->num_rows > 0) {
        // Start creating the table
        echo '<table class="table table-striped">';
        echo '<thead>';
        echo '<tr>';
        echo '<th scope="col">Meter Number</th>';
        echo '<th scope="col">Payment Method</th>';
        echo '<th scope="col">Payment Amount</th>';
        echo '</tr>';
        echo '</thead>';
        echo '<tbody>';

        // Output data of each row
        while($row = $result->fetch_assoc()) {
            echo '<tr>';
            echo '<td>' . $row["meterNumber"] . '</td>';
            echo '<td>' . $row["paymentMethod"] . '</td>';
            echo '<td>$' . $row["paymentAmount"] . '</td>';
            echo '</tr>';
        }

        echo '</tbody>';
        echo '</table>';
    } else {
        echo "No billing information found for meter number: " . $meterNumber;
    }

    // Close prepared statement and database connection
    $stmt->close();
    $conn->close();

} else {
    echo "Meter number is required.";
}
?>
