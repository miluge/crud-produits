<?php
include 'functions.php';
$pdo = pdo_connect_mysql();
// Check that the product ID exists
if (isset($_POST['id'])) {
    $stmt = $pdo->prepare('DELETE FROM products WHERE id_products = ?');
    $stmt->execute([$_POST['id']]);
}