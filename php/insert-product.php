<?php
error_reporting(E_ALL);
ini_set('display_errors',1);

var_dump($_FILES);

include 'functions.php';
$pdo = pdo_connect_mysql();
$msg = '';
if (!empty($_POST)) {  
$id = isset($_POST['id']) && !empty($_POST['id']) && $_POST['id'] != 'auto' ? $_POST['id'] : NULL;                             
$sql = "INSERT INTO products ( image_url, category_id, manual_url, source_id, name, reference_number, price, buy_date, end_warranty, care_products) VALUES (:image_url, :category_id, :manual_url, :source_id, :name, :reference_number, :price, :buy_date, :end_warranty, :care_products)";
$stmt = $pdo->prepare($sql);
            
// Bind parameters to statement
$image = isset($_POST['image_url']) ? $_POST['image_url'] : '';
$category = isset($_POST['category_id']) ? $_POST['category_id'] : '';
$manual = isset($_POST['manual_url']) ? $_POST['manual_url'] : '';
$source = isset($_POST['source_id']) ? $_POST['source_id'] : '';
$name = isset($_POST['name']) ? $_POST['name'] : '';
$reference_number = isset($_POST['reference_number']) ? $_POST['reference_number'] : '';
$price = isset($_POST['price']) ? $_POST['price'] : '';
$buy_date = isset($_POST['buy_date']) ? $_POST['buy_date'] : '';
$end_warranty = isset($_POST['end_warranty']) ? $_POST['end_warranty'] : '';
$care_products = isset($_POST['care_products']) ? $_POST['care_products'] : '';

// Execute the prepared statement
$stmt->execute();
$msg = 'Created Successfully!'; 

if(isset($_POST['submit'])){

    // Prepared statement
    $sql = "INSERT INTO products (image_url) VALUES(?)";
    
  
    $statement = $conn->prepare($sql);
      // File name
      $filename = $_FILES['image_url']['name'][$i];
  
      // Location
      $target_file = 'uploads/images'.$filename;
  
      // file extension
      $file_extension = pathinfo($target_file, PATHINFO_EXTENSION);
      $file_extension = strtolower($file_extension);
  
      // Valid image extension
      $valid_extension_img = array("png","jpeg","jpg");
  
      if(in_array($file_extension, $valid_extension)){
  
         // Upload file
         if(move_uploaded_file($_FILES['image_url']['tmp_name'][$i],$target_file)){
  
            // Execute query
        $statement->execute(array($filename,$target_file));
  
      }
    }
    echo "File upload successfully";
  }

//   if(isset($_POST['submit'])){

//     // Prepared statement
//     $sql = "INSERT INTO manual (name) VALUES(?)";
    
  
//     $statement = $conn->prepare($sql)
  
//       // File name
//       $filename = $_FILES['manual_url']['name'][$i];
  
//       // Location
//       $target_file = 'uploads/manuals'.$filename;
  
//       // file extension
//       $file_extension = pathinfo($target_file, PATHINFO_EXTENSION);
//       $file_extension = strtolower($file_extension);
  
//       // Valid image extension
//       $valid_extension_img = array("pdf","txt");
  
//       if(in_array($file_extension, $valid_extension)){
  
//          // Upload file
//          if(move_uploaded_file($_FILES['files']['tmp_name'][$i],$target_file)){
  
//             // Execute query
//         $statement->execute(array($filename,$target_file));
  
//       }
//     }
//     echo "File upload successfully";
//   }
// }