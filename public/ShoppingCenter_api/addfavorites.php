<?php



$json= file_get_contents('php://input');
$request = json_decode($json);

$mobilenumber = $request->usermobilenumber;
$product_id = $request->product_id;

include 'DatabaseManager.php';
$databasemanager = new DatabaseManager();

$success = $databasemanager->AddFavorites($mobilenumber,$product_id);

echo json_encode(["success"=>$success],JSON_UNESCAPED_UNICODE);



