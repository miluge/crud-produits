<?php
error_reporting(E_ALL);
ini_set('display_errors',1);

require_once 'dbconfig.php';
                                 
            $sql = "INSERT INTO product ( buy_location, category, name, reference_number, price, buy_date, end_warranty, image_product, manual_product, care_products) VALUES (:buy_location, :category, :name, :reference_number, :price, :buy_date, :end_warranty, :image_product, :manual_product, :care_products)";
            $stmt = $conn->prepare($sql);
            
            // Bind parameters to statement
             $stmt->bindParam(':buy_location', $_REQUEST['buy_location']);
            $stmt->bindParam(':category', $_REQUEST['category']);
            $stmt->bindParam(':name', $_REQUEST['name']);
            $stmt->bindParam(':reference_number', $_REQUEST['reference_number']);
            $stmt->bindParam(':price', $_REQUEST['price']);
            $stmt->bindParam(':buy_date', $_REQUEST['buy_date']);
            $stmt->bindParam(':end_warranty', $_REQUEST['end_warranty']);
            $stmt->bindParam(':image_product', $_REQUEST['image_product']);
            $stmt->bindParam(':manual_product', $_REQUEST['manual_product']);
            $stmt->bindParam(':care_products', $_REQUEST['care_products']);
            
            // Execute the prepared statement
            $stmt->execute();
            echo "Product added succesfully"; 
           
            // Close connection
            unset($conn);

?>
