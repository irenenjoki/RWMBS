<?php

require_once './connect.php';

if(isset($_GET['name'])) {
    $id = $_GET['name'];
    $sql = 'DELETE FROM register WHERE name = ?';
    $cmd = $db->prepare($sql);

    try{
        $cmd->execute([$id]);
        $_SESSION['success'] = 'customer Deleted successfully';
        header('location: customer.php');
    }
    catch(PDOException $e) {
        $_SESSION['error'] = 'An error occurred';
        echo $e->getMessage();
    }

}