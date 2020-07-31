<?php
error_reporting(E_ALL);
ini_set('display_errors',1);

include 'functions.php';
$pdo = pdo_connect_mysql();

if (isset($_POST['id'])) {
    //get product by id
    $id = $_POST['id'];
    $stmt = $pdo->prepare("SELECT id_products, image.name, category.name, manual.name, source, products.name, reference_number, price, buy_date, end_warranty, care_products FROM products INNER JOIN image ON products.image_id = image.id_image INNER JOIN category ON products.category_id = category.id_category INNER JOIN manual ON products.manual_id = manual.id_manual INNER JOIN type ON products.id_type = type.id_type WHERE id_products = :id");
    $stmt->execute([':id'=>$id]);
    $product = $stmt->setFetchMode(PDO::FETCH_ASSOC);
    $product = $stmt->fetch();

    $image = isset($_POST['image.name']) ? $_POST['image.name'] : '';
    $category = isset($_POST['category.name']) ? $_POST['category.name'] : '';
    $manual = isset($_POST['manual.name']) ? $_POST['manual.name'] : '';
    $source = isset($_POST['source']) ? $_POST['source'] : '';
    $id_type = isset($_POST['id_type']) ? $_POST['id_type'] : '';
    $name = isset($_POST['products.name']) ? $_POST['products.name'] : '';
    $reference_number = isset($_POST['reference_number']) ? $_POST['reference_number'] : '';
    $price = isset($_POST['price']) ? $_POST['price'] : '';
    $buy_date = isset($_POST['buy_date']) ? $_POST['buy_date'] : '';
    $end_warranty = isset($_POST['end_warranty']) ? $_POST['end_warranty'] : '';
    $care_products = isset($_POST['care_products']) ? $_POST['care_products'] : '';
    // Update the record
    $stmt = $pdo->prepare('UPDATE products SET image_id = :image_id, category_id = :category_id, manual_id = :manual_id, source = :source, id_type = :id_type, name = :name, reference_number = :reference_number, price = :price, buy_date = :buy_date, end_warranty = :end_warranty, care_products = :care_products WHERE id_products = :id');
    $stmt->bindValue(':id', $id);
    $stmt->bindValue(':image.name', $image);
    $stmt->bindValue(':category.name', $category);
    $stmt->bindValue(':manual.name', $manual);
    $stmt->bindValue(':source', $source);
    $stmt->bindValue(':id_type', $id_type);
    $stmt->bindValue(':products.name', $name);
    $stmt->bindValue(':reference_number', $reference_number);
    $stmt->bindValue(':price', $price);
    $stmt->bindValue(':buy_date', $buy_date);
    $stmt->bindValue(':end_warranty', $end_warranty);
    $stmt->bindValue(':care_products', $care_products);
    $stmt->execute();
}