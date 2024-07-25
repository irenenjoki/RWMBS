<?php

require_once './connect.php';

if(isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql = 'DELETE FROM contactus WHERE id = ?';
    $cmd = $db->prepare($sql);

    try{
        $cmd->execute([$id]);
        $_SESSION['success'] = 'message Delete successfully';
        header('location: contact.php');
    }
    catch(PDOException $e) {
        $_SESSION['error'] = 'An error occurred';
        echo $e->getMessage();
    }

}