<?php



$json= file_get_contents('php://input');
$request = json_decode($json);

$product_id = $request[0]->product_id;


include 'DatabaseManager.php';
$databaseManager=new DatabaseManager();
$databaseManager->GetProductColor($product_id);
