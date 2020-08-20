<?php
session_start();
include 'functions.php';
if(isset($_POST['id']) && check_user()){
    $id = $_POST['id'];
    //delete files
    $pdo = pdo_connect_mysql();
    $stmt = $pdo->prepare('SELECT image_url, manual_url FROM products WHERE id_products = :id');
    $stmt->bindValue(':id', $id);
    $stmt->execute();
    $files = $stmt->fetch(PDO::FETCH_ASSOC);
    $image = "../uploads/images/".$id."-".$files["image_url"];
    unlink($image);
    if ($files["manual_url"] != ""){
        $manual = "../uploads/manuals/".$id."-".$files["manual_url"];
        unlink($manual);
    }
    //delete from database
    $stmt = $pdo->prepare('DELETE FROM products WHERE id_products = :id');
    $stmt->bindValue(':id', $id);
    $stmt->execute();
}else{
    header('Location:../login.php');
}