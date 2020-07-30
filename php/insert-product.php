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

            if(isset($_POST['submit'])) {
                // for input => ticket image
               
                $ticket = $_FILES['ticket'];

                $ticketName = $_FILES['ticket']['name'];
                $ticketTmpname = $_FILES['ticket']['tmp_name'];
                $ticketSize = $_FILES['ticket']['size'];
                $ticketError = $_FILES['ticket']['error'];
                $ticketType = $_FILES['ticket']['type'];

                $ticketExt = explode('.', $ticketName);
                $ticketActualExt = strtolower(end($fileExt));

                $allowed = array('jpg', 'jpeg', 'png');

                if (in_array($ticketActualExt, $allowed)){
                    if ($ticketError === 0) {
                        if ($ticketSize < 500000 ) {
                            $ticketNameNew = uniqid(', true').".".$ticketActualExt;
                            $ticketDestination = 'uploads/images/'.$ticketNameNew;
                            move_uploaded_file($ticketTmpname, $ticketDestination);
                        } else {
                            echo "file is too big";
                        }
                    } else {
                    echo "Error uploading your file!";
                }
            } else {
                echo "You cannot upload files of this type!";
            }

            $manual = $_FILES['manual'];

            $manualName = $_FILES['manual']['name'];
            $manualTmpname = $_FILES['manual']['tmp_name'];
            $manualSize = $_FILES['manual']['size'];
            $manualError = $_FILES['manual']['error'];
            $manualType = $_FILES['manual']['type'];

            $manualExt = explode('.', $manualName);
            $manualActualExt = strtolower(end($fileExt));

            $allowed = array('pdf', 'doc', 'txt');

            if (in_array($manualActualExt, $allowed)){
                if ($manualError === 0) {
                    if ($manualSize < 500000 ) {
                        $manualNameNew = uniqid(', true').".".$manualActualExt;
                        $manualDestination = 'uploads/manuals/'.$manualNameNew;
                        move_uploaded_file($manualTmpname, $manualDestination);
                    } else {
                        echo "file is too big";
                    }
                } else {
                echo "Error uploading your file!";
            }
        } else {
            echo "You cannot upload files of this type!";
        }
?>
