<?php
error_reporting(E_ALL);
ini_set('display_errors',1);

include 'functions.php';
//Connect to db
$pdo = pdo_connect_mysql();
$msg = '';
// Check if POST data is not empty
if (!empty($_POST)) {
    // Post data not empty insert a new record
    // Check if POST variable "name" exists, if not default the value to blank, basically the same for all variables
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
    // Insert new record into the contacts table
    $stmt = $pdo->prepare('INSERT INTO products VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)');
    $stmt->execute([$image, $category, $manual, $source, $name, $reference_number, $price, $buy_date, $end_warranty, $care_products]);
    // Output message
    $msg = 'Product Created Successfully!';
}


// For test purposes 

                    $sql = "INSERT INTO products ( image_id, category_id, manual_id, source_id, name, reference_number, price, buy_date, end_warranty, care_products) VALUES (:image_id, :category_id, :manual_id, :source_id, :name, :reference_number, :price, :buy_date, :end_warranty, :care_products)";
                    $stmt = $conn->prepare($sql);
                    
                    // Bind parameters to statement
                    $stmt->bindParam(':image_id', $_REQUEST['image_id']);
                    $stmt->bindParam(':category_id', $_REQUEST['category_id']);
                    $stmt->bindParam(':manual_id', $_REQUEST['manual_id']);
                    $stmt->bindParam(':source_id', $_REQUEST['source_id']);
                    $stmt->bindParam(':name', $_REQUEST['name']);
                    $stmt->bindParam(':reference_number', $_REQUEST['reference_number']);
                    $stmt->bindParam(':price', $_REQUEST['price']);
                    $stmt->bindParam(':buy_date', $_REQUEST['buy_date']);
                    $stmt->bindParam(':end_warranty', $_REQUEST['end_warranty']);
                    $stmt->bindParam(':care_products', $_REQUEST['care_products']);

                    
                    // Execute the prepared statement
                    $stmt->execute();
?>
