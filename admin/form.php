<?php


require_once './connect.php';
if($_SERVER['REQUEST_METHOD'] === 'POST'){
  $first_name= $_POST['first_name'];
  $last_name= $_POST['last_name'];
  $employee_number= $_POST['employee_number'];

  

  $stmt =$db->prepare("INSERT INTO employee(first_name, last_name, employee_number) VALUES(?,?,?)");
  $stmt->execute(array($first_name,$last_name,$employee_number));

 header("location: employee.php");
 
}
?>