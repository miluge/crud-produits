<?php
error_reporting(E_ALL);
ini_set('display_errors',1);

include 'functions.php';

var_dump($_FILES);

//Connect to db
$pdo = pdo_connect_mysql();
if (!empty($_POST)) {// Check if POST data is not empty

    if (!empty($_FILES)) {//check if files sent
        //UPLOAD
    }
    //INCLUDE FILE URL IN VARIABLE
    $image = isset($_FILES['image_url']) ? $_FILES['image_url'] : '1';
    $manual = isset($_FILES['manual_url']) ? $_FILES['manual_url'] : '1';

    $category = isset($_POST['category_id']) ? $_POST['category_id'] : '1';
    $source_type = isset($_POST['source_type']) ? $_POST['source_type'] : '1';
    $source = isset($_POST['source']) ? $_POST['source'] : '1';
    $name = isset($_POST['name']) ? $_POST['name'] : '1';
    $reference_number = isset($_POST['reference_number']) ? $_POST['reference_number'] : '1';
    $price = isset($_POST['price']) ? $_POST['price'] : '1';
    $buy_date = isset($_POST['buy_date']) ? $_POST['buy_date'] : '2020-12-12';
    $end_warranty = isset($_POST['end_warranty']) ? $_POST['end_warranty'] : '2020-12-12';
    $care_products = isset($_POST['care_products']) ? $_POST['care_products'] : '1';
    // Insert new record into the contacts table
    $stmt = $pdo->prepare('INSERT INTO products(image_url, category_id, manual_url, source, id_type, name, reference_number, price, buy_date, end_warranty, care_products) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)');
    $stmt->execute([$image, $category, $manual, $source, $source_type, $name, $reference_number, $price, $buy_date, $end_warranty, $care_products]);
}