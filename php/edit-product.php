<?php
error_reporting(E_ALL);
ini_set('display_errors',1);

include 'functions.php';

$pdo = pdo_connect_mysql();

 if (isset($_GET['id'])) {
     $id = $_GET['id'];
     $stmt = $pdo->prepare("SELECT * FROM products WHERE id_products = :id");
     $stmt->execute([':id'=>$id]);
     $products = $stmt->setFetchMode(PDO::FETCH_ASSOC);
     $products = $stmt->fetchAll();
     if (!empty($_POST)) {
//         // This part is similar to the create.php, but instead we update a record and not insert
        //  $id = isset($_POST['id_products']) ? $_POST['id_products'] : NULL;
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
//         // Update the record
        $stmts = $conn->prepare('UPDATE products SET id_products = :id, image_id = :image_id, category_id = :category_id, manual_id = :manual_id, source_id = :source_id, name = :name, reference_number = :reference_number, price = :price, buy_date = :buy_date, end_warranty = :end_warranty, care_products = :care_products WHERE id_products = :id');
        $stmt->bindValue(':image_id', $_REQUEST['image_id']);
        $stmt->bindValue(':category_id', $_REQUEST['category_id']);
        $stmt->bindValue(':manual', $_REQUEST['manual']);
        $stmt->bindValue(':source_id', $_REQUEST['source_id']);
        $stmt->bindValue(':name', $_REQUEST['name']);
        $stmt->bindValue(':reference_number', $_REQUEST['reference_number']);
        $stmt->bindValue(':price', $_REQUEST['price']);
        $stmt->bindValue(':buy_date', $_REQUEST['buy_date']);
        $stmt->bindValue(':end_warranty', $_REQUEST['end_warranty']);
        $stmt->bindValue(':care_products', $_REQUEST['care_products']);
        $stmts->execute();
        $msg = 'Updated Successfully!';
        echo '<script>alert("'.$msg.'")</script>';
     }
     // Get the product from the product table
     $stmt = $conn->prepare("SELECT * FROM products WHERE id_products = :id");
     $stmt->execute([':id'=>$id]);
     $products = $stmt->setFetchMode(PDO::FETCH_ASSOC);
     $products = $stmt->fetchAll();
     if (!$result) {
         exit('Product doesn\'t exist with that ID!');
     }
 } else {
     exit('No ID specified!');
 }
?>
                    <div class="container-fluid">
                        <h1 class="mt-4">Add a product</h1>
                        <form class="field" action="" method="post" enctype="multipart/form-data">
                            <label class="label">Product name</label>
                            <div class="control">
                                <input class="input" type="text" name="name" placeholder="Product name">
                            </div>
                            <label class="label">Select category</label>
                            <div class="control">
                            <input class="input" type="date" name="buy_location" placeholder="DD-MM-YYYY" >
                            </div>
                            <label class="label">Buy date</label>
                            <div class="control">
                                <input class="input" type="date" name="buy_date"  placeholder="DD-MM-YYYY" >
                            </div>
                            <label class="label">Warranty end date</label>
                            <div class="control">
                                <input class="input" type="date" name="end_warranty"  placeholder="DD-MM-DDDD">
                            </div>
                            <label class="label">Price</label>
                            <div class="control">
                                <input class="input" type="text" name="price" placeholder="Price">
                            </div>
                            <label class="label">Reference number</label>
                            <div class="control">
                                <input class="input" type="text" name="reference_number" placeholder="Reference no">
                            </div>
                            <label class="label">Product image</label>
                            <div class="control">
                                <input class="button" type="file"  name="image">
                            </div>
                            <label class="label">User manual</label>
                            <div class="control">
                                <input class="button" type="file"  name="manual">
                            </div>
                            <label class="label">Care instruction</label>
                            <div class="control">
                                <textarea rows="15" cols="40" class="input" type="text" name="care_instructions" placeholder="Care instructions..."></textarea>
                            </div>
                            <br>
                            <div class="control">
                                <input class="button" type="submit" name="insert-product" value="Save"></input>
                                <a class="button" value="cancel" href="dashboard.php">Cancel</a>
                            </div>
                        </form>
                    </div>