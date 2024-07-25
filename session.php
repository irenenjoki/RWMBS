<?php
session_start();

// Check if user is not logged in, redirect to login page
if ($_SESSION["status"]=!true) {
    header("Location: index.php"); // Adjust this redirect location as per your project structure
    exit();
}
?>
