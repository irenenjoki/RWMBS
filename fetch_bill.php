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
    $stmt = $conn->prepare("SELECT Amount FROM process_payment WHERE meterNumber = ?");
    $stmt->bind_param("s", $meterNumber);
    $stmt->execute();
    $stmt->bind_result($amount);
    $stmt->fetch();
    $stmt->close();
    $conn->close();

    if ($amount !== null) {
        echo json_encode(["success" => true, "amount" => $amount]);
    } else {
        echo json_encode(["success" => false]);
    }
    try{
        $db = new PDO("mysql:host=$host;dbname=$dbname",$username,$password);
        $db->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
        session_start();
   
    }
    catch (PDOException $e){
        echo "unable to connect".$e->getmessage();
    }
}
?>
