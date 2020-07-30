<?php

include 'functions.php';

//Connect to MySQL
$pdo = pdo_connect_mysql();
// Prepare the SQL statement and get records from our contacts table, LIMIT will determine the page
$stmt = $pdo->prepare('SELECT id_products, image.name, category.name, manual.name, source.name, products.name, reference_number, price, buy_date, end_warranty, care_products FROM products INNER JOIN image ON products.image_id = image.id_image INNER JOIN category ON products.category_id = category.id_category INNER JOIN manual ON products.manual_id = manual.id_manual INNER JOIN source ON products.source_id = source.id_source ');
$stmt->execute();
// Fetch the records so we can display them in our template.
$products = $stmt->fetchAll(PDO::FETCH_ASSOC);
foreach($products as $product){
    $product['id_products'];
    $product['image.name'];
    $product['category.name'];
    $product['manual.name'];
    $product['source.name'];
    $product['products.name'];
    $product['reference_number'];
    $product['price'];
    $product['buy_date'];
    $product['end_warranty'];
    $product['care_products'];

    echo $twig->render( 'entry.html.twig' , ['reference_number' => $product['reference_number'],'name' => $product['name'], 'category' => 'informatic', 'price' => $product['price'], 'buy_date' => $product['buy_date'], 'action' => 'delete']);
}
    //load entry template
    echo $twig->render( 'entry.html.twig' , ['id_products' => $product['id_products'], 'reference_number' => $product['reference_number'],'name' => $product['name'], 'category' => 'informatic', 'price' => $product['price'], 'buy_date' => $product['buy_date']]);
}
