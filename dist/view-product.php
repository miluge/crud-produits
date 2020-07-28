<?php

include 'functions.php';

//Connect to MySQL
$pdo = pdo_connect_mysql();
// Prepare the SQL statement and get records from our contacts table, LIMIT will determine the page
$stmt = $pdo->prepare('SELECT * FROM products');
$stmt->execute();
// Fetch the records so we can display them in our template.
$products = $stmt->fetchAll(PDO::FETCH_ASSOC);
// var_dump($products);
foreach($products as $product){
    echo $product['id_products'];
    echo $product['image_id'];
    echo $product['category_id'];
    echo $product['manual_id'];
    echo $product['source_id'];
    echo $product['name'];
    echo $product['reference_number'];
    echo $product['price'];
    echo $product['buy_date'];
    echo $product['end_warranty'];
    echo $product['care_products'];
}
?>