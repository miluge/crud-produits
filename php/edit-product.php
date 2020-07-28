<?php
error_reporting(E_ALL);
ini_set('display_errors',1);

require_once 'dbconfig.php';

 if (isset($_GET['id'])) {
     $id = $_GET['id'];
     $stmt = $conn->prepare("SELECT * FROM products WHERE id_products = :id");
     $stmt->execute([':id'=>$id]);
     $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
     $result = $stmt->fetchAll();
     if (!empty($_POST)) {
//         // This part is similar to the create.php, but instead we update a record and not insert
         $id = isset($_POST['id_products']) ? $_POST['id_products'] : NULL;
         $location = isset($_POST['buy_location']) ? $_POST['buy_location'] : '';
         $category = isset($_POST['category']) ? $_POST['category'] : '';
         $name = isset($_POST['name']) ? $_POST['name'] : '';
         $ref_nr = isset($_POST['reference_number']) ? $_POST['reference_number'] : '';
         $ref_nr = isset($_POST['price']) ? $_POST['price'] : '';
         $ref_nr = isset($_POST['buy_date']) ? $_POST['buy_date'] : '';
         $ref_nr = isset($_POST['end_warranty']) ? $_POST['end_warranty'] : '';
         $ref_nr = isset($_POST['image_product']) ? $_POST['image_product'] : '';
         $ref_nr = isset($_POST['manual_product']) ? $_POST['manual_product'] : '';
         $ref_nr = isset($_POST['care_products']) ? $_POST['care_products'] : '';
//         // Update the record
         $stmts = $conn->prepare('UPDATE product SET id_products = :id, buy_location = :buy_location, category = :category, name = :name, reference_number = :reference_number, price = :price, buy_date = :buy_date, end_warranty = :end_warranty, image_product = :image_product, manual_product = :manual_product, care_products = :care_products WHERE id_products = :id');
         $stmt->bindValue(':buy_location', $_REQUEST['buy_location']);
        $stmt->bindValue(':category', $_REQUEST['category']);
        $stmt->bindValue(':name', $_REQUEST['name']);
        $stmt->bindValue(':reference_number', $_REQUEST['reference_number']);
        $stmt->bindValue(':price', $_REQUEST['price']);
        $stmt->bindValue(':buy_date', $_REQUEST['buy_date']);
        $stmt->bindValue(':end_warranty', $_REQUEST['end_warranty']);
        $stmt->bindValue(':image_product', $_REQUEST['image_product']);
        $stmt->bindValue(':manual_product', $_REQUEST['manual_product']);
        $stmt->bindValue(':care_products', $_REQUEST['care_products']);
        $stmts->execute();
        $msg = 'Updated Successfully!';
        echo '<script>alert("'.$msg.'")</script>';
     }
     // Get the product from the product table
     $stmt = $conn->prepare("SELECT * FROM products WHERE id_products = :id");
     $stmt->execute([':id'=>$id]);
     $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
     $result = $stmt->fetchAll();
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