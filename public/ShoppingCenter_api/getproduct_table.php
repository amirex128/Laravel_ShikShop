<?php



$json= file_get_contents('php://input');
$request = json_decode($json);

$product_id = $request[0]->product_id;


include 'DatabaseManager.php';
$databasemanager = new DatabaseManager();
$databasemanager->gettable($product_id);

