<?php



$json= file_get_contents('php://input');
$login = json_decode($json);

$phone = $login->phone;
$password = $login->password;

include 'DatabaseManager.php';
$databasemanager = new DatabaseManager();

$success = $databasemanager->login($phone,$password);

echo json_encode(["success"=>$success],JSON_UNESCAPED_UNICODE);
