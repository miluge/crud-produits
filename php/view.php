<?php
require_once 'functions.php';

if (isset($_POST['mode'])){//if $_POST['mode] via AJAX, echo twig template for modal
    session_start();
    if(check_user()){
        $mode = $_POST['mode'];
        
        //load twig
        require_once '../vendor/autoload.php';
        $loader = new \Twig\Loader\FilesystemLoader('../templates/');
        $twig = new \Twig\Environment($loader, [
            'cache' => false,
        ]);

        //connect to db
        require_once('functions.php');
        $pdo = pdo_connect_mysql();

        if (isset($_POST['id'])){//get product by id
            $id = $_POST['id'];
            $stmt = $pdo->prepare("SELECT id_products, image_url , cat.name AS category, category_id, manual_url, source, type.name AS source_type, products.name AS name, reference_number, price, buy_date, end_warranty, care_products FROM products INNER JOIN category AS cat ON products.category_id = cat.id_category INNER JOIN type ON products.id_type = type.id_type WHERE id_products = :id");
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

        if ($mode == 'Edit' || $mode == 'Add'){//return form render
            //get categories
            $stmt = $pdo->prepare("SELECT id_category, name FROM category");
            $stmt->execute();
            $product['categories'] = $stmt->fetchAll(PDO::FETCH_ASSOC);
            $product['mode'] = $mode;
            echo $twig->render( 'form.html.twig' , $product);
        }
    }
}else if(check_user()){//if no $_POST['mode'], return products table entries for index.php

    // Prepare the SQL statement and get records from products table
    $stmt = $pdo->prepare('SELECT cat.name AS category , id_products, products.name AS name, reference_number, price, buy_date FROM products INNER JOIN category AS cat ON products.category_id = cat.id_category');
    $stmt->execute();
    // Fetch the records so we can display them in template
    $products = $stmt->fetchAll(PDO::FETCH_ASSOC);
    foreach($products as $product){
        //render entry template
        echo $twig->render( 'entry.html.twig' , $product);
    }
}else{
    header('Location:../login.php');
}