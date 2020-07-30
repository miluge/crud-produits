<?php

include 'functions.php';
//database connection
$pdo = pdo_connect_mysql();

if (isset($_POST['mode'])){
    $mode = $_POST['mode'];
    $twig = load_twig();

    if (isset($_POST['id'])){//get product by id
        $id = $_POST['id'];
        $stmt = $pdo->prepare("SELECT * FROM products WHERE id_products = :id");
        $stmt->execute([':id'=>$id]);
        $product = $stmt->setFetchMode(PDO::FETCH_ASSOC);
        $product = $stmt->fetch();
    }else{
        echo "no id set";
    }
    
    if ($mode == 'delete'){//return delete render
        echo $twig->render( 'delete.html.twig' , $product);
    }

    if ($mode == 'details'){//return details render
        echo $twig->render( 'details.html.twig' , $product);
    }
    
}else{//if no $_POST['mode'], return products table entries for index.php

    // Prepare the SQL statement and get records from products table
    $stmt = $pdo->prepare('SELECT * FROM products');
    $stmt->execute();
    // Fetch the records so we can display them in template
    $products = $stmt->fetchAll(PDO::FETCH_ASSOC);
    foreach($products as $product){
        //render entry template
        echo $twig->render( 'entry.html.twig' , $product);
    }
}