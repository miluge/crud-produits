<?php
error_reporting(E_ALL);
ini_set('display_errors',1);

include 'functions.php';
//Connect to db
$pdo = pdo_connect_mysql();
// Check if POST data is not empty
if (!empty($_POST)) {
    // Post data not empty insert a new record
    // Check if POST variable exists, if not default the value to blank, basically the same for all variables
    $image = isset($_POST['image_id']) ? $_POST['image_id'] : '1';
    $category = isset($_POST['category_id']) ? $_POST['category_id'] : '1';
    $manual = isset($_POST['manual_id']) ? $_POST['manual_id'] : '1';
    $source_type = isset($_POST['source_type']) ? $_POST['source_type'] : '1';
    $source = isset($_POST['source']) ? $_POST['source'] : '1';
    $name = isset($_POST['name']) ? $_POST['name'] : '1';
    $reference_number = isset($_POST['reference_number']) ? $_POST['reference_number'] : '1';
    $price = isset($_POST['price']) ? $_POST['price'] : '1';
    $buy_date = isset($_POST['buy_date']) ? $_POST['buy_date'] : '2020-12-12';
    $end_warranty = isset($_POST['end_warranty']) ? $_POST['end_warranty'] : '2020-12-12';
    $care_products = isset($_POST['care_products']) ? $_POST['care_products'] : '1';
    // Insert new record into the contacts table
    $stmt = $pdo->prepare('INSERT INTO products(image_id, category_id, manual_id, source, id_type, name, reference_number, price, buy_date, end_warranty, care_products) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)');
    $stmt->execute([$image, $category, $manual, $source, $source_type, $name, $reference_number, $price, $buy_date, $end_warranty, $care_products]);

    // //load twig
    // require_once '../vendor/autoload.php';
    // $loader = new \Twig\Loader\FilesystemLoader('../templates/');
    // $twig = new \Twig\Environment($loader, [
    //     'cache' => false,
    // ]);

    // //return new entry
    // $id = $pdo->lastInsertId();
    // $stmt = $pdo->prepare("SELECT id_products, img.name AS image , cat.name AS category, man.name AS manual, source, type.name AS source_type, products.name AS name, reference_number, price, buy_date, end_warranty, care_products FROM products INNER JOIN image AS img ON products.image_id = img.id_image INNER JOIN category AS cat ON products.category_id = cat.id_category INNER JOIN manual AS man ON products.manual_id = man.id_manual INNER JOIN type ON products.id_type = type.id_type WHERE id_products = :id");
    // $stmt->execute([':id'=>$id]);
    // $product = $stmt->setFetchMode(PDO::FETCH_ASSOC);
    // $product = $stmt->fetch();
    // echo $twig->render( 'entry.html.twig' , $product);
}