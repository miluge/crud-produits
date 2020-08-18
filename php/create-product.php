<?php
require_once('../vendor/autoload.php');
use Respect\Validation\Validator as v;
session_start();
require_once('functions.php');
error_reporting(E_ALL);
ini_set('display_errors',1);

if (v::arrayVal()->notEmpty()->validate($_POST) && check_user()) {// Check if POST data is not empty and if user is connected
    $pdo = pdo_connect_mysql();
    $errors = [];
    
    $image_url = isset($_FILES['image_url']) ? $_FILES['image_url'] : '1';
    $manual_url = isset($_FILES['manual_url']) ? $_FILES['manual_url'] : '1';

    //check if $_POST['name'] is a non empty non blank string
    if (v::key('name')->validate($_POST)) {
        $name = trim($_POST['name']," \t\n\r\0\x0B");
        if (! v::stringType()->notEmpty()->validate($name)){
            $errors['name'] = "Please enter a product name";
        }
    } else {
        $errors['name'] = "Please enter a product name";
    }

    //check if $_POST['category_id'] is an id from category table
    if (v::key('category_id')->validate($_POST)) {
        $category_id = $_POST['category_id'];
        $stmt = $pdo->query('SELECT id_category from category');
        $category_ids = $stmt->fetchAll(PDO::FETCH_ASSOC);
        if (! v::contains($category_id)->validate($category_ids)){
            $errors['category_id'] = "Please select a category";
        }
    } else {
        $errors['category_id'] = "Please select a category";
    }

    //check if $_POST['price'] is a positive number with max 2 decimals
    if (v::key('price')->validate($_POST)) {
        $price = (float) $_POST['price'];
        if (! v::intVal()->positive()->digit()->validate($price*100)){
            $errors['price'] = "Please enter a valid price (ex: 39.99)";
        }
    } else {
        $errors['price'] = "Please enter a price";
    }

    //check if $_POST['source'] is a non empty non blank string
    if (v::key('source')->validate($_POST)) {
        $source = trim($_POST['source']," \t\n\r\0\x0B");
        if (! v::stringType()->notEmpty()->validate($source)){
            $errors['source'] = "Please enter a purchase location";
        }
    } else {
        $errors['source'] = "Please enter a purchase location";
    }

    //check if $_POST['buy_date'] is a date in the past
    if (v::key('buy_date')->validate($_POST)) {
        $buy_date = $_POST['buy_date'];
        if (v::date()->validate($buy_date)){
            //if buy_date is a date, convert to timestamp and compare to now
            $buy_date = strtotime($buy_date);
            if(v::lessThan(time())->validate($buy_date)){
                //date format
                $buy_date = date('Y-m-d',$buy_date);
            }else{
                $errors['buy_date'] = "Please enter a puchase date in future";
            }
        }else{
            $errors['buy_date'] = "Please enter a puchase date";
        }
    } else {
        $errors['buy_date'] = "Please enter a purchase date";
    }

    //check if $_POST['end_warranty'] is a date
    if (v::key('end_warranty')->validate($_POST)) {
        $end_warranty = date('Y-m-d',strtotime($_POST['end_warranty']));
        if (! v::date()->validate($end_warranty)){
            $errors['end_warranty'] = "Please enter an end of warranty date";
        }
    } else {
        $errors['end_warranty'] = "Please enter an end of warranty date";
    }

    //check if $_POST['care_products'] is a non empty non blank string
    if (v::key('care_products')->validate($_POST)) {
        $care_products = trim($_POST['care_products']," \t\n\r\0\x0B");
        if (! v::stringType()->notEmpty()->validate($care_products)){
            $errors['care_products'] = "Please enter maintenance advice";
        }
    } else {
        $errors['care_products'] = "Please enter maintenance advice";
    }

    //check if $_POST['reference_number'] is a non empty non blank string
    if (v::key('reference_number')->validate($_POST)) {
        $reference_number = trim($_POST['reference_number']," \t\n\r\0\x0B");
        if (! v::stringType()->notEmpty()->validate($reference_number)){
            $errors['reference_number'] = "Please enter a product reference";
        }
    } else {
        $errors['reference_number'] = "Please enter a product reference";
    }

    //check if $_POST['id_type'] is an id from type table
    if (v::key('id_type')->validate($_POST)) {
        $id_type = $_POST['id_type'];
        $stmt = $pdo->query('SELECT id_type from type');
        $id_types = $stmt->fetchAll(PDO::FETCH_ASSOC);
        if (! v::contains($id_type)->validate($id_types)){
            $errors['id_type'] = "Please select a purchase type";
        }
    } else {
        $errors['id_type'] = "Please select a purchase type";
    }


//   // Set image placement folder
//   $target_dir = "../uploads/images";
//   // Get file path
//   $image_url = $target_dir . basename($_FILES["image_url"]["name"]);
//   // Get file extension
//   $imageExt = strtolower(pathinfo($image_url, PATHINFO_EXTENSION));
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
//   } else if (file_exists($image_url)) {
//       $resMessage = array(
//           "status" => "alert-danger",
//           "message" => "File already exists."
//       );
//   } else {
//       if(!move_uploaded_file($_FILES["image_url"]["tmp_name"], $image_url)) {
//           $errors["file"] = "File cannot be moved";
//       }
//   }

    $image_url =  "1";
    $manual_url =  "1";

    if (empty($errors)){
        //if no errors insert product in database
        $errors["global"] = false;
        
        $stmt = $pdo->prepare('INSERT INTO products(image_url, category_id, manual_url, source, id_type, name, reference_number, price, buy_date, end_warranty, care_products) VALUES (:image_url, :category_id, :manual_url, :source, :id_type, :name, :reference_number, :price, :buy_date, :end_warranty, :care_products)');
        $stmt->bindValue(':image_url', $image_url);
        $stmt->bindValue(':category_id', $category_id);
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
    }else{
        $errors["global"] = "Failed to add product !";
    }
}else{
    $errors["global"] = "Failed to add product !";
}

//AJAX response
echo json_encode($errors);