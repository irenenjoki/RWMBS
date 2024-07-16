<?php

require_once './connect.php';

if(isset($_GET['firstname'])) {
    $id = $_GET['firstname'];
    $sql = 'DELETE FROM report WHERE firstname = ?';
    $cmd = $db->prepare($sql);

    try{
        $cmd->execute([$id]);
        $_SESSION['success'] = 'customer report Deleted successfully';
        header('location: customer-report.php');
    }
    catch(PDOException $e) {
        $_SESSION['error'] = 'An error occurred';
        echo $e->getMessage();
    }

} 