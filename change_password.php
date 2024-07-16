<?php
session_start();

// Check if user is logged in
if (!isset($_SESSION['username'])) {
    http_response_code(401);
    exit("Unauthorized");
}

// Validate and sanitize input
$currentPassword = trim($_POST['current_password']);
$newPassword = trim($_POST['new_password']);
$confirmPassword = trim($_POST['confirm_password']);

// Check if new password and confirm password match
if ($newPassword !== $confirmPassword) {
    http_response_code(400);
    exit(json_encode(array('message' => 'New password and confirm password do not match.')));
}

// Validate current password and update new password
$servername = "localhost";
$username_db = "root"; // Database username
$password_db = "";     // Database password
$database = "water_management";

// Create a new database connection
$conn = new mysqli($servername, $username_db, $password_db, $database);

// Check if there are any errors in the connection
if ($conn->connect_error) {
    http_response_code(500);
    exit(json_encode(array('message' => 'Connection failed: ' . $conn->connect_error)));
}

// Retrieve username from session
$username = $_SESSION['username'];

// Fetch user data from database
$stmt = $conn->prepare("SELECT password FROM register WHERE name = ?");
$stmt->bind_param("s", $username);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows == 1) {
    $row = $result->fetch_assoc();
    $storedPasswordHash = $row['password'];

    // Verify current password
    if (password_verify($currentPassword, $storedPasswordHash)) {
        // Hash the new password
        $newPasswordHash = password_hash($newPassword, PASSWORD_DEFAULT);

        // Update password in database
        $updateStmt = $conn->prepare("UPDATE register SET password = ? WHERE name = ?");
        $updateStmt->bind_param("ss", $newPasswordHash, $username);
        
        if ($updateStmt->execute()) {
            // Password updated successfully
            http_response_code(200);
            echo json_encode(array('message' => 'Password changed successfully.'));
        } else {
            // Failed to update password
            http_response_code(500);
            echo json_encode(array('message' => 'Failed to update password.'));
        }
    } else {
        // Current password is incorrect
        http_response_code(401);
        echo json_encode(array('message' => 'Current password is incorrect.'));
    }
} else {
    // User not found
    http_response_code(404);
    echo json_encode(array('message' => 'User not found.'));
}

// Close statement and connection
$stmt->close();
$updateStmt->close();
$conn->close();
?>
