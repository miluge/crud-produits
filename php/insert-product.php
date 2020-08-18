<?php
error_reporting(E_ALL);
ini_set('display_errors',1);

require('vendor/autoload.php');
use Respect\Validation\Validator as v;

include 'functions.php';
$pdo = pdo_connect_mysql();
$msg = '';
if (!empty($_POST)) {  
$id = isset($_POST['id']) && !empty($_POST['id']) && $_POST['id'] != 'auto' ? $_POST['id'] : NULL;                             
$sql = "INSERT INTO products ( image_url, category_id, manual_url, source_id, name, reference_number, price, buy_date, end_warranty, care_products) VALUES (:image_url, :category_id, :manual_url, :source_id, :name, :reference_number, :price, :buy_date, :end_warranty, :care_products)";
$stmt = $pdo->prepare($sql);

// Bind parameters to statement
$image_url = isset($_POST['image_url']) ? $_POST['image_url'] : '';
$category = isset($_POST['category_id']) ? $_POST['category_id'] : '';
$manual_url = isset($_POST['manual_url']) ? $_POST['manual_url'] : '';
$source = isset($_POST['source_id']) ? $_POST['source_id'] : '';
$name = isset($_POST['name']) ? $_POST['name'] : '';
$reference_number = isset($_POST['reference_number']) ? $_POST['reference_number'] : '';
$price = isset($_POST['price']) ? $_POST['price'] : '';
$buy_date = isset($_POST['buy_date']) ? $_POST['buy_date'] : '';
$end_warranty = isset($_POST['end_warranty']) ? $_POST['end_warranty'] : '';
$care_products = isset($_POST['care_products']) ? $_POST['care_products'] : '';


$is_name = v::alnum(' ')->validate($name);
if ($is_name) {

    echo "Validation passed";
} else {

    echo "Validation failed";
}

$is_category = v::alnum(' ')->validate($category);
if ($is_category) {

    echo "Validation passed";
} else {

    echo "Validation failed";
}

$is_price = v::number()->validate($price);
if ($is_category) {

    echo "Validation passed";
} else {

    echo "Validation failed";
}

$is_source = v::alnum()->validate($price);
if ($is_category) {

    echo "Validation passed";
} else {

    echo "Validation failed";
}

$is_buydate = v::date()->validate($buy_date);
if ($is_buydate) {

    echo "Validation passed";
} else {

    echo "Validation failed";
}

$is_endwarranty = v::date()->greaterThan($buy_date);
$is_endwarranty->validate($end_warranty);
if ($is_endwarranty) {

    echo "Validation passed";
} else {

    echo "Validation failed";
}

$is_careproducts = v::alnum(' ')->validate($care_products);
if ($is_careproducts) {

    echo "Validation passed";
} else {

    echo "Validation failed";
}

$is_reference = v::alnum(' ')->validate($reference_number);
if ($is_reference) {

    echo "Validation passed";
} else {

    echo "Validation failed";
}


// Execute the prepared statement
$stmt->execute();
$msg = 'Created Successfully!'; 

//   // Set image placement folder
//   $target_dir = "uploads/images";
//   // Get file path
//   $target_file = $target_dir . basename($_FILES["image_url"]["name"]);
//   // Get file extension
//   $imageExt = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
//   // Allowed file types
//   $allowd_file_ext = array("jpg", "jpeg", "png");
  

//   if (!file_exists($_FILES["image_url"]["tmp_name"])) {
//      $resMessage = array(
//          "status" => "alert-danger",
//          "message" => "Select image to upload."
//      );
//   } else if (!in_array($imageExt, $allowd_file_ext)) {
//       $resMessage = array(
//           "status" => "alert-danger",
//           "message" => "Allowed file formats .jpg, .jpeg and .png."
//       );            
//   } else if ($_FILES["image_url"]["size"] > 2097152) {
//       $resMessage = array(
//           "status" => "alert-danger",
//           "message" => "File is too large. File size should be less than 2 megabytes."
//       );
//   } else if (file_exists($target_file)) {
//       $resMessage = array(
//           "status" => "alert-danger",
//           "message" => "File already exists."
//       );
//   } else {
//       if (move_uploaded_file($_FILES["image_url"]["tmp_name"], $target_file)) {
//           $sql = "INSERT INTO products (image_url) VALUES ('$target_file')";
//           $stmt = $conn->prepare($sql);
//            if($stmt->execute()){
//               $resMessage = array(
//                   "status" => "alert-success",
//                   "message" => "Image uploaded successfully."
//               );                 
//            }
//       } else {
//           $resMessage = array(
//               "status" => "alert-danger",
//               "message" => "Image coudn't be uploaded."
//           );
//       }
  }

