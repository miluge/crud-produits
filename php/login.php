<?php
require_once("functions.php");
session_start();
if(isset($_POST['email']) && isset($_POST['password'])) {
    if($_POST['email']!=""){
        $email = trim($_POST['email'], " \t\n\r\0\x0B");
        $password = trim($_POST['password'], " \t\n\r\0\x0B");
        $error = [];
        try {//connect to database
            $pdo = pdo_connect_mysql();
            $sql = "select name, password from `users` where `email`=:email";
            $stmt = $pdo->prepare($sql);
            $stmt->bindParam('email', $email, PDO::PARAM_STR);
            $stmt->execute();
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            if($row) {//check if user exists
                if($row['password'] == $password){//check if password is correct
                    $_SESSION['sess_name'] = $row['name'];
                    $error["none"] = true;
                }else{
                    $error["password"] = "Invalid password";
                }
            } else {
                $error["user"] = "user unknown";
            }
        } catch (PDOException $e) {
            $error["pdo"] = $e->getMessage();
        }
    }else{
        $error["user"] = "Please enter user email";
    }
}else{
    header('Location:../login.php');
}

echo json_encode($error);