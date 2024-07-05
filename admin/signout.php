<?php

// start session
session_start();

// Destroy user session
unset($_SESSION['user']);

// Redirect to index.php page
header("Location: signin.php");
?>