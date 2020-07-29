<?php

include 'functions.php';

//Connect to MySQL
$pdo = pdo_connect_mysql();
// Prepare the SQL statement and get records from our contacts table, LIMIT will determine the page
$stmt = $pdo->prepare('SELECT * FROM products');
$stmt->execute();
// Fetch the records so we can display them in our template.
$products = $stmt->fetchAll(PDO::FETCH_ASSOC);
foreach($products as $product){
    echo $twig->render( 'entry.html.twig' , ['id_products' => $product['id_products'], 'reference_number' => $product['reference_number'],'name' => $product['name'], 'category' => 'informatic', 'price' => $product['price'], 'buy_date' => $product['buy_date'], 'action' => 'delete']);
}