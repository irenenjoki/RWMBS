<?php
session_start();
session_destroy(); // Destroy session data
echo "Session destroyed. Redirecting...";

// Redirect to login page
header("Location: index.html");
exit();
?>