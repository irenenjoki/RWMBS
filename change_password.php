<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Retrieve form data
    $currentPassword = $_POST['current-password'];
    $newPassword = $_POST['new-password'];
    $confirmPassword = $_POST['confirm-password'];
    
    $servername = "localhost";
    $username_db = "root"; // Replace with your database username
    $password_db = ""; // Replace with your database password
    $database = "water_management";

    // Validate form data
    if (empty($currentPassword) || empty($newPassword) || empty($confirmPassword)) {
        echo 'All fields are required.';
        exit;
    }
    
    if ($newPassword !== $confirmPassword) {
        echo 'New password and confirm password must match.';
        exit;
    }

    // Connect to the database
    $conn = mysqli_connect($servername, $username_db, $password_db, $database);

    // Check connection
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }

    // Check current password
    $username = $_SESSION['username'];
    $stmt = $conn->prepare("SELECT password FROM users WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();
    $storedPassword = $row['password'];

    if (!password_verify($currentPassword, $storedPassword)) {
        echo 'Incorrect current password.';
        exit;
    }

    // Update password
    $hashedPassword = password_hash($newPassword, PASSWORD_DEFAULT);
    $updateStmt = $conn->prepare("UPDATE users SET password = ? WHERE username = ?");
    $updateStmt->bind_param("ss", $hashedPassword, $username);
    $updateResult = $updateStmt->execute();

    if ($updateResult) {
        echo 'Password updated successfully.';
    } else {
        echo 'Error updating password.';
    }

    // Close connections
    $stmt->close();
    $updateStmt->close();
    $conn->close();
}
?>
