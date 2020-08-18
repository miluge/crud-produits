<?php
session_start();
if(isset($_POST['email']) && $_POST['email']!="" && isset($_POST['password'])) {
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);
    $error = [];
    try {//connect to database
        require_once("functions.php");
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

echo json_encode($error);