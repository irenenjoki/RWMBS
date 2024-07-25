<?php

require_once './connect.php';

if(isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql = 'DELETE FROM subscriptions WHERE id = ?';
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