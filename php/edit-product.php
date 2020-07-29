<?php
error_reporting(E_ALL);
ini_set('display_errors',1);

include 'functions.php';

$pdo = pdo_connect_mysql();

// load twig
require_once '../vendor/autoload.php';
$loader = new \Twig\Loader\FilesystemLoader('../templates/');
$twig = new \Twig\Environment($loader, [
    'cache' => false,
]);

if (isset($_POST['id'])) {
    //get product by id
    $id = $_POST['id'];
    $stmt = $pdo->prepare("SELECT * FROM products WHERE id_products = :id");
    $stmt->execute([':id'=>$id]);
    $product = $stmt->setFetchMode(PDO::FETCH_ASSOC);
    $product = $stmt->fetch();

    //fill form render
    echo $twig->render( 'form.html.twig' , [
        'mode' => 'Edit',
        'id_products' => $product['id_products'],
        'image_product' => $product['image_id'],
        'category1' => 'informatic',
        'category2' => 'vehicule',
        'manual_product' => $product['manual_id'],
        'source' => $product['source_id'],
        'name' => $product['name'],
        'reference_number' => $product['reference_number'],
        'price' => $product['price'],
        'buy_date' => $product['buy_date'],
        'end_warranty' => $product['end_warranty'],
        'care_products' => $product['care_products']  
    ]);

    $image = isset($_POST['image_id']) ? $_POST['image_id'] : '';
    $category = isset($_POST['category_id']) ? $_POST['category_id'] : '';
    $manual = isset($_POST['manual_id']) ? $_POST['manual_id'] : '';
    $source = isset($_POST['source_id']) ? $_POST['source_id'] : '';
    $name = isset($_POST['name']) ? $_POST['name'] : '';
    $reference_number = isset($_POST['reference_number']) ? $_POST['reference_number'] : '';
    $price = isset($_POST['price']) ? $_POST['price'] : '';
    $buy_date = isset($_POST['buy_date']) ? $_POST['buy_date'] : '';
    $end_warranty = isset($_POST['end_warranty']) ? $_POST['end_warranty'] : '';
    $care_products = isset($_POST['care_products']) ? $_POST['care_products'] : '';
    // Update the record
    $stmt = $pdo->prepare('UPDATE products SET image_id = :image_id, category_id = :category_id, manual_id = :manual_id, source_id = :source_id, name = :name, reference_number = :reference_number, price = :price, buy_date = :buy_date, end_warranty = :end_warranty, care_products = :care_products WHERE id_products = :id');
    $stmt->bindValue(':id', $id);
    $stmt->bindValue(':image_id', $image);
    $stmt->bindValue(':category_id', $category);
    $stmt->bindValue(':manual_id', $manual);
    $stmt->bindValue(':source_id', $source);
    $stmt->bindValue(':name', $name);
    $stmt->bindValue(':reference_number', $reference_number);
    $stmt->bindValue(':price', $price);
    $stmt->bindValue(':buy_date', $buy_date);
    $stmt->bindValue(':end_warranty', $end_warranty);
    $stmt->bindValue(':care_products', $care_products);
    $stmt->execute();
}else {
    //create form render
    echo $twig->render( 'form.html.twig' , [
        'mode' => 'Add',
        'id_products' => '',
        'image_product' => '',
        'category1' => 'informatic',
        'category2' => 'vehicule',
        'manual_product' => '',
        'source' => '',
        'name' => '',
        'reference_number' => '',
        'price' => '',
        'buy_date' => '',
        'end_warranty' => '',
        'care_products' => ''  
    ]);
}