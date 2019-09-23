<?php



$json= file_get_contents('php://input');
$request = json_decode($json);

$mobilenumber = $request->usermobilenumber;
$product_id = $request->product_id;


include 'DatabaseManager.php';
$databasemanager = new DatabaseManager();
$databasemanager->AddVisit($mobilenumber,$product_id);

