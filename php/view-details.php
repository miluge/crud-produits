<?php

if (isset($_POST['id'])) {
    include 'functions.php';
    $twig = load_twig();

    //Connect to MySQL
    $pdo = pdo_connect_mysql();
    //get product by id
    $id = $_POST['id'];
    $stmt = $pdo->prepare("SELECT * FROM products WHERE id_products = :id");
    $stmt->execute([':id'=>$id]);
    $product = $stmt->setFetchMode(PDO::FETCH_ASSOC);
    $product = $stmt->fetch();

    //fill details render
    echo $twig->render( 'details.html.twig' , [
        'id_products' => $product['id_products'],
        'image_product' => $product['image_id'],
        'category' => $product['category_id'],
        'manual_product' => $product['manual_id'],
        'source_type' => $product['source_id'],
        'source' => $product['source_id'],
        'name' => $product['name'],
        'reference_number' => $product['reference_number'],
        'price' => $product['price'],
        'buy_date' => $product['buy_date'],
        'end_warranty' => $product['end_warranty'],
        'care_products' => $product['care_products']
    ]);
}