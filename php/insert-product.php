<?php
error_reporting(E_ALL);
ini_set('display_errors',1);

include 'functions.php';
$pdo = pdo_connect_mysql();
$msg = '';
if (!empty($_POST)) {  
$id = isset($_POST['id']) && !empty($_POST['id']) && $_POST['id'] != 'auto' ? $_POST['id'] : NULL;                             
$sql = "INSERT INTO products ( image_id, category_id, manual_id, source_id, name, reference_number, price, buy_date, end_warranty, care_products) VALUES (:image_id, :category_id, :manual_id, :source_id, :name, :reference_number, :price, :buy_date, :end_warranty, :care_products)";
$stmt = $pdo->prepare($sql);
            
// Bind parameters to statement
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

// Execute the prepared statement
$stmt->execute();
$msg = 'Created Successfully!'; 

// Close connection
unset($pdo);

//     if(isset($_POST['submit'])) {
//         // for input => ticket image
        
//         $ticket = $_FILES['ticket'];

//         $ticketName = $_FILES['ticket']['name'];
//         $ticketTmpname = $_FILES['ticket']['tmp_name'];
//         $ticketSize = $_FILES['ticket']['size'];
//         $ticketError = $_FILES['ticket']['error'];
//         $ticketType = $_FILES['ticket']['type'];

//         $ticketExt = explode('.', $ticketName);
//         $ticketActualExt = strtolower(end($fileExt));

//         $allowed = array('jpg', 'jpeg', 'png');

//         if (in_array($ticketActualExt, $allowed)){
//             if ($ticketError === 0) {
//                 if ($ticketSize < 500000 ) {
//                     $ticketNameNew = uniqid(', true').".".$ticketActualExt;
//                     $ticketDestination = 'uploads/images/'.$ticketNameNew;
//                     move_uploaded_file($ticketTmpname, $ticketDestination);
//                 } else {
//                     echo "file is too big";
//                 }
//             } else {
//             echo "Error uploading your file!";
//         }
//     } else {
//         echo "You cannot upload files of this type!";
//     }

//     $manual = $_FILES['manual'];

//     $manualName = $_FILES['manual']['name'];
//     $manualTmpname = $_FILES['manual']['tmp_name'];
//     $manualSize = $_FILES['manual']['size'];
//     $manualError = $_FILES['manual']['error'];
//     $manualType = $_FILES['manual']['type'];

//     $manualExt = explode('.', $manualName);
//     $manualActualExt = strtolower(end($fileExt));

//     $allowed = array('pdf', 'doc', 'txt');

//     if (in_array($manualActualExt, $allowed)){
//         if ($manualError === 0) {
//             if ($manualSize < 500000 ) {
//                 $manualNameNew = uniqid(', true').".".$manualActualExt;
//                 $manualDestination = 'uploads/manuals/'.$manualNameNew;
//                 move_uploaded_file($manualTmpname, $manualDestination);
//             } else {
//                 echo "file is too big";
//             }
//         } else {
//         echo "Error uploading your file!";
//     }
// } else {
//     echo "You cannot upload files of this type!";
// }

// SECOND IMAGE AND MANUAL Method"

if(isset($_POST['submit'])){

    // Prepared statement
    $sql = "INSERT INTO image (name,image) VALUES(?,?)";
    
  
    $statement = $conn->prepare($sql);
  
    // Loop all files
    for($i=0;$i<$countfiles;$i++){
  
      // File name
      $filename = $_FILES['files']['name'][$i];
  
      // Location
      $target_file = 'uploads/images'.$filename;
  
      // file extension
      $file_extension = pathinfo($target_file, PATHINFO_EXTENSION);
      $file_extension = strtolower($file_extension);
  
      // Valid image extension
      $valid_extension_img = array("png","jpeg","jpg");
  
      if(in_array($file_extension, $valid_extension)){
  
         // Upload file
         if(move_uploaded_file($_FILES['files']['tmp_name'][$i],$target_file)){
  
            // Execute query
        $statement->execute(array($filename,$target_file));
  
         }
      }
    }
    echo "File upload successfully";
  }

  if(isset($_POST['add-manual'])){

    // Prepared statement
    $sql = "INSERT INTO manual (name) VALUES(?)";
    
  
    $statement = $conn->prepare($sql);
  
    // Loop all files
    for($i=0;$i<$countfiles;$i++){
  
      // File name
      $filename = $_FILES['files']['name'][$i];
  
      // Location
      $target_file = 'uploads/manuals'.$filename;
  
      // file extension
      $file_extension = pathinfo($target_file, PATHINFO_EXTENSION);
      $file_extension = strtolower($file_extension);
  
      // Valid image extension
      $valid_extension_img = array("pdf","txt");
  
      if(in_array($file_extension, $valid_extension)){
  
         // Upload file
         if(move_uploaded_file($_FILES['files']['tmp_name'][$i],$target_file)){
  
            // Execute query
        $statement->execute(array($filename,$target_file));
  
         }
      }
    }
    echo "File upload successfully";
  }
}