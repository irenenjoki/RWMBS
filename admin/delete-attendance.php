<?php
require_once "./connect.php";

if (isset($_GET['meterNumber'])) {
    $meterNumber = $_GET['meterNumber'];
    $sql = 'DELETE FROM process_payment WHERE meterNumber = ?';
    $cmd = $db->prepare($sql);

    try {
        $cmd->execute([$meterNumber]);
        $_SESSION['success'] = 'Payment record deleted successfully';
        header('location: billhistory.php');
        exit(); // Always exit after header redirect
    } catch (PDOException $e) {
        $_SESSION['error'] = 'An error occurred: ' . $e->getMessage();
        error_log('Error deleting payment record: ' . $e->getMessage());
        header('location: billhistory.php'); // Redirect to the same page or an error page
        exit();
    }
}
?>
