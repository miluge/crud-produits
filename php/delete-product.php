<?php
session_start();
include 'functions.php';
if(isset($_POST['id']) && check_user()){
    //delete from database
    $pdo = pdo_connect_mysql();
    $stmt = $pdo->prepare('DELETE FROM products WHERE id_products = ?');
    $stmt->execute([$_POST['id']]);
}else{
    header('Location:../login.php');
}