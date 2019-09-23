<?php



$json= file_get_contents('php://input');
$request = json_decode($json);

$product_id = $request->product_id;


include 'DatabaseManager.php';
$databasemanager = new DatabaseManager();
$databasemanager->getcategory_id_by_product_id($product_id);

