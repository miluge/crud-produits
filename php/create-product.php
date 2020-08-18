<?php
error_reporting(E_ALL);
ini_set('display_errors',1);
require('../vendor/autoload.php');
use Respect\Validation\Validator as v;
include 'functions.php';

var_dump($_FILES);

//Connect to db
$pdo = pdo_connect_mysql();
if (!empty($_POST)) {// Check if POST data is not empty

    if (!empty($_FILES)) {//check if files sent
        //UPLOAD
    }
    //INCLUDE FILE URL IN VARIABLE
    $image_url = isset($_FILES['image_url']) ? $_FILES['image_url'] : '1';
    $manual_url = isset($_FILES['manual_url']) ? $_FILES['manual_url'] : '1';
    $category = isset($_POST['category_id']) ? $_POST['category_id'] : '1';
    $source_type = isset($_POST['source_type']) ? $_POST['source_type'] : '1';
    $source = isset($_POST['source']) ? $_POST['source'] : '1';
    $name = isset($_POST['name']) ? $_POST['name'] : '1';
    $reference_number = isset($_POST['reference_number']) ? $_POST['reference_number'] : '1';
    $price = isset($_POST['price']) ? $_POST['price'] : '1';
    $buy_date = isset($_POST['buy_date']) ? $_POST['buy_date'] : '2020-12-12';
    $end_warranty = isset($_POST['end_warranty']) ? $_POST['end_warranty'] : '2020-12-12';
    $care_products = isset($_POST['care_products']) ? $_POST['care_products'] : '1';
    // Insert new record into the contacts table
    $stmt = $pdo->prepare('INSERT INTO products(image_url, category_id, manual_url, source, id_type, name, reference_number, price, buy_date, end_warranty, care_products) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)');
    $stmt->execute([$image, $category, $manual, $source, $source_type, $name, $reference_number, $price, $buy_date, $end_warranty, $care_products]);

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





  // Set image placement folder
  $target_dir = "../uploads/images";
  // Get file path
  $target_file = $target_dir . basename($_FILES["image_url"]["name"]);
  // Get file extension
  $imageExt = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
  // Allowed file types
  $allowd_file_ext = array("jpg", "jpeg", "png");
  

  if (!file_exists($_FILES["image_url"]["tmp_name"])) {
     $resMessage = array(
         "status" => "alert-danger",
         "message" => "Select image to upload."
     );
  } else if (!in_array($imageExt, $allowd_file_ext)) {
      $resMessage = array(
          "status" => "alert-danger",
          "message" => "Allowed file formats .jpg, .jpeg and .png."
      );            
  } else if ($_FILES["image_url"]["size"] > 2097152) {
      $resMessage = array(
          "status" => "alert-danger",
          "message" => "File is too large. File size should be less than 2 megabytes."
      );
  } else if (file_exists($target_file)) {
      $resMessage = array(
          "status" => "alert-danger",
          "message" => "File already exists."
      );
  } else {
      if (move_uploaded_file($_FILES["image_url"]["tmp_name"], $target_file)) {
          $sql = "INSERT INTO products (image_url) VALUES ('$target_file')";
          $stmt = $pdo->prepare($sql);
           if($stmt->execute()){
              $resMessage = array(
                  "status" => "alert-success",
                  "message" => "Image uploaded successfully."
              );                 
           }
      } else {
          $resMessage = array(
              "status" => "alert-danger",
              "message" => "Image coudn't be uploaded."
          );
      }
  }
}