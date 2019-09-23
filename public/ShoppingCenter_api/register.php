
<?php

$json= file_get_contents('php://input');
$userinfo = json_decode($json);


$fullname = $userinfo->fullname;
$phone = $userinfo->phone;
$password = $userinfo->password;
$email= $userinfo->email;


include 'DatabaseManager.php';
$databasemanager = new DatabaseManager();

$success = $databasemanager->AddUser($fullname,$phone,$password,$email);

echo json_encode(["success"=>$success],JSON_UNESCAPED_UNICODE);
