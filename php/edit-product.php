<?php
error_reporting(E_ALL);
ini_set('display_errors',1);

include 'functions.php';
$pdo = pdo_connect_mysql();

if (isset($_POST['id'])) {
    // //get product by id
    // $id = $_POST['id'];
    // $stmt = $pdo->prepare("SELECT id_products, image.name, category.name, manual.name, source, products.name, reference_number, price, buy_date, end_warranty, care_products FROM products INNER JOIN image ON products.image_id = image.id_image INNER JOIN category ON products.category_id = category.id_category INNER JOIN manual ON products.manual_id = manual.id_manual INNER JOIN type ON products.id_type = type.id_type WHERE id_products = :id");
    // $stmt->execute([':id'=>$id]);
    // $product = $stmt->setFetchMode(PDO::FETCH_ASSOC);
    // $product = $stmt->fetch();
    // var_dump($_POST);

    $id = $_POST['id'];
    $image = isset($_POST['image_url']) ? $_POST['image_url'] : '1';
    $category = isset($_POST['category_id']) ? $_POST['category_id'] : '1';
    $manual = isset($_POST['manual_url']) ? $_POST['manual_url'] : '1';
    $source = isset($_POST['source']) ? $_POST['source'] : '';
    $id_type = isset($_POST['source_type']) ? $_POST['source_type'] : '1';
    $name = isset($_POST['name']) ? $_POST['name'] : '1';
    $reference_number = isset($_POST['reference_number']) ? $_POST['reference_number'] : '1';
    $price = isset($_POST['price']) ? $_POST['price'] : '1';
    $buy_date = isset($_POST['buy_date']) ? $_POST['buy_date'] : '2020-12-12';
    $end_warranty = isset($_POST['end_warranty']) ? $_POST['end_warranty'] : '2020-12-12';
    $care_products = isset($_POST['care_products']) ? $_POST['care_products'] : '1';

    // Update the record
    $stmt = $pdo->prepare('UPDATE products SET image_url = :image_url, category_id = :category_id, manual_url = :manual_url, source = :source, id_type = :id_type, name = :name, reference_number = :reference_number, price = :price, buy_date = :buy_date, end_warranty = :end_warranty, care_products = :care_products WHERE id_products = :id');
    $stmt->bindValue(':id', $id);
    $stmt->bindValue(':image_url', $image);
    $stmt->bindValue(':category_id', $category);
    $stmt->bindValue(':manual_url', $manual);
    $stmt->bindValue(':source', $source);
    $stmt->bindValue(':id_type', $id_type);
    $stmt->bindValue(':name', $name);
    $stmt->bindValue(':reference_number', $reference_number);
    $stmt->bindValue(':price', $price);
    $stmt->bindValue(':buy_date', $buy_date);
    $stmt->bindValue(':end_warranty', $end_warranty);
    $stmt->bindValue(':care_products', $care_products);
    $stmt->execute();
}