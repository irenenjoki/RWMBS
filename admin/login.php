<?php 
    require_once './connect.php';
    if($_SERVER['REQUEST_METHOD'] === 'POST') {
        try{
            $username = $_POST['username'];
            $password = $_POST['password'];
            
            // execute query
            $STH = $db->prepare("SELECT * FROM admin WHERE username=?");
            $data = array($username);
            $STH->execute($data);

            //check if email exists
            $rows_affected = $STH->rowCount();
            if ($rows_affected == 1){
                $row = $STH->fetch();
                $pass = $row['password'];
                
                //Check if password is correct
                if(password_verify($password,$pass))
                {
                    $_SESSION['success'] = "Welcome $row[username]";
                    $_SESSION['user'] = $row;

                    unset($user);
                    unset($password);

                    header("location: signin.php"); 
                    exit();               
                }
                else 
                $_SESSION['error'] = "Incorrect Password";
            }
            else 
            $_SESSION['error'] = "username does not exist";            
        }

        catch(PDOException $e){
            $_SESSION['error'] = "I'm afraid I can't Log you in at the moment.";
            file_put_contents('PDOErrors.txt',"\n". date('Y-m-d H:i:s').'] - '.$e->getMessage(), FILE_APPEND); # log errors to afile
        }
    }

    header('location: index.php');
