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

    if ($mode == 'Edit'){//return edit form render
        $product['mode'] = $mode;
        echo $twig->render( 'form.html.twig' , $product);
    }

    if ($mode == 'Add'){//return add form render
        $product['mode'] = $mode;
        echo $twig->render( 'form.html.twig' , $product);
    }
    
}else{//if no $_POST['mode'], return products table entries for index.php

    // Prepare the SQL statement and get records from products table
    // $stmt = $pdo->prepare('SELECT id_products, img.name, cat.name AS category, man.name, src.name, products.name, reference_number, price, buy_date, end_warranty, care_products FROM products INNER JOIN image AS img ON products.image_id = img.id_image INNER JOIN category AS cat ON products.category_id = cat.id_category INNER JOIN manual AS man ON products.manual_id = man.id_manual INNER JOIN source AS src ON products.source_id = src.id_source');
    $stmt = $pdo->prepare('SELECT * FROM products');
    $stmt->execute();
    // Fetch the records so we can display them in template
    $products = $stmt->fetchAll(PDO::FETCH_ASSOC);
    foreach($products as $product){
        // var_dump($product);
        //render entry template
        echo $twig->render( 'entry.html.twig' , $product);
    }
}