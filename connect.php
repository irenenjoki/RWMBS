<?php
$host = 'localhost';
$dbname = 'water_management';
$username = 'root';
$password = '';


try {
    $db = new PDO('mysql:host=localhost;dbname=water_management', 'root', '');
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo "Database connection error: " . $e->getMessage();
}
?>

