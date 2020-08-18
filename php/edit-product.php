<?php
error_reporting(E_ALL);
ini_set('display_errors',1);

require('../vendor/autoload.php');
use Respect\Validation\Validator as v;
include 'functions.php';
$pdo = pdo_connect_mysql();

if (isset($_POST['id'])) {
    // //get product by id
    // $id = $_POST['id'];
    // $stmt = $pdo->prepare("SELECT id_products, image.name, category.name, manual.name, source, products.name, reference_number, price, buy_date, end_warranty, care_products FROM products INNER JOIN image ON products.image_id = image.id_image INNER JOIN category ON products.category_id = category.id_category INNER JOIN manual ON products.manual_id = manual.id_manual INNER JOIN type ON products.id_type = type.id_type WHERE id_products = :id");
    // $stmt->execute([':id'=>$id]);
    // $product = $stmt->setFetchMode(PDO::FETCH_ASSOC);
    // $product = $stmt->fetch();
    // var_dump($_POST);

    $id = $_POST['id'];
    $image_url = isset($_POST['image_url']) ? $_POST['image_url'] : '1';
    $category = isset($_POST['category_id']) ? $_POST['category_id'] : '1';
    $manual_url = isset($_POST['manual_url']) ? $_POST['manual_url'] : '1';
    $source = isset($_POST['source']) ? $_POST['source'] : '';
    $id_type = isset($_POST['source_type']) ? $_POST['source_type'] : '1';
    $name = isset($_POST['name']) ? $_POST['name'] : '1';
    $reference_number = isset($_POST['reference_number']) ? $_POST['reference_number'] : '1';
    $price = isset($_POST['price']) ? $_POST['price'] : '1';
    $buy_date = isset($_POST['buy_date']) ? $_POST['buy_date'] : '2020-12-12';
    $end_warranty = isset($_POST['end_warranty']) ? $_POST['end_warranty'] : '2020-12-12';
    $care_products = isset($_POST['care_products']) ? $_POST['care_products'] : '1';

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
if ($is_price) {

    echo "Validation passed";
} else {

    echo "Validation failed";
}

$is_source = v::alnum()->validate($source);
if ($is_source) {

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

//---------- Image Upload ------------//

  // Set image placement folder
  $target_dir = "../uploads/images";
  // Get file path
  $image_url = $target_dir . basename($_FILES["image_url"]["name"]);
  // Get file extension
  $imageExt = strtolower(pathinfo($image_url, PATHINFO_EXTENSION));
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
  } else if (file_exists($image_url)) {
      $resMessage = array(
          "status" => "alert-danger",
          "message" => "File already exists."
      );
  } else {
      if(!move_uploaded_file($_FILES["image_url"]["tmp_name"], $image_url)) {
          $errors["file"] = "File cannot be moved";
      }
  }

  //------ Manual Upload ---------//

  // Set manual placement folder
  $target_dir = "../uploads/manuals";
  // Get file path
  $manual_url = $target_dir . basename($_FILES["manual_url"]["name"]);
  // Get file extension
  $manualExt = strtolower(pathinfo($manual_url, PATHINFO_EXTENSION));
  // Allowed file types
  $allowd_file_ext = array("pdf", "txt");
  

  if (!file_exists($_FILES["manual_url"]["tmp_name"])) {
     $resMessage = array(
         "status" => "alert-danger",
         "message" => "Select image to upload."
     );
  } else if (!in_array($manualExt, $allowd_file_ext)) {
      $resMessage = array(
          "status" => "alert-danger",
          "message" => "Allowed file formats .jpg, .jpeg and .png."
      );            
  } else if ($_FILES["manual_url"]["size"] > 2097152) {
      $resMessage = array(
          "status" => "alert-danger",
          "message" => "File is too large. File size should be less than 2 megabytes."
      );
  } else if (file_exists($manual_url)) {
      $resMessage = array(
          "status" => "alert-danger",
          "message" => "File already exists."
      );
  } else {
      if(!move_uploaded_file($_FILES["manual_url"]["tmp_name"], $manual_url)) {
          $errors["file"] = "File cannot be moved";
      }
  }

    // Update the record
if (empty($errors)){
    //If no errors insert product in database
    $errors["none"] = true;
    $stmt = $pdo->prepare('UPDATE products SET image_url = :image_url, category_id = :category_id, manual_url = :manual_url, source = :source, id_type = :id_type, name = :name, reference_number = :reference_number, price = :price, buy_date = :buy_date, end_warranty = :end_warranty, care_products = :care_products WHERE id_products = :id');
    $stmt->bindValue(':id', $id);
    $stmt->bindValue(':image_url', $image_url);
    $stmt->bindValue(':category_id', $category);
    $stmt->bindValue(':manual_url', $manual_url);
    $stmt->bindValue(':source', $source);
    $stmt->bindValue(':id_type', $id_type);
    $stmt->bindValue(':name', $name);
    $stmt->bindValue(':reference_number', $reference_number);
    $stmt->bindValue(':price', $price);
    $stmt->bindValue(':buy_date', $buy_date);
    $stmt->bindValue(':end_warranty', $end_warranty);
    $stmt->bindValue(':care_products', $care_products);
    $stmt->execute();
    
    }
    //AJAX response
    echo json_encode($errors);
}