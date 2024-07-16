<?php


require_once './connect.php';
if($_SERVER['REQUEST_METHOD'] === 'POST'){
  $name= $_POST['name'];
  $email= $_POST['email'];
  $meter_number= $_POST['meterNumber'];

  
  $stmt =$db->prepare("INSERT INTO register(name, email, meterNumber) VALUES(?,?,?)");
  $stmt->execute(array($name,$email,$meter_number));

 header("location: customer.php");
 
}
?>