<?php

if (isset($_POST['id'])) {
    include 'functions.php';
    $twig = load_twig();

    //Connect to MySQL
    $pdo = pdo_connect_mysql();
    //get product name by id
    $id = $_POST['id'];
    $stmt = $pdo->prepare("SELECT name FROM products WHERE id_products = :id");
    $stmt->execute([':id'=>$id]);
    $product = $stmt->setFetchMode(PDO::FETCH_ASSOC);
    $product = $stmt->fetch();

    //fill details render
    echo $twig->render( 'delete.html.twig' , [
        'id_products' => $id,
        'name' => $product['name'],
    ]);
}