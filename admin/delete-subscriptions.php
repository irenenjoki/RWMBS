<?php

require_once './connect.php';

if(isset($_GET['email'])) {
    $id = $_GET['email'];
    $sql = 'DELETE FROM subscriptions WHERE email = ?';
    $cmd = $db->prepare($sql);

    try{
        $cmd->execute([$id]);
        $_SESSION['success'] = 'subscription Delete successfully';
        header('location: subscriptions.php');
    }
    catch(PDOException $e) {
        $_SESSION['error'] = 'An error occurred';
        echo $e->getMessage();
    }

}