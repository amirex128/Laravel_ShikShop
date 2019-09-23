<?php



$json= file_get_contents('php://input');
$request = json_decode($json);

$mobilenumber = $request->usermobilenumber;
$content = $request->content;

include 'DatabaseManager.php';
$databasemanager = new DatabaseManager();

$success = $databasemanager->AddTicket($mobilenumber,$content);

echo json_encode(["success"=>$success],JSON_UNESCAPED_UNICODE);



