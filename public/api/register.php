
<?php

$json= file_get_contents('php://input');
$userinfo = json_decode($json);


$name = $userinfo->name;
$family = $userinfo->family;
$mobilenumber = $userinfo->mobilenumber;
$email= $userinfo->email;
$password= $userinfo->password;


include 'DatabaseManager.php';
$databasemanager = new DatabaseManager();

$success = $databasemanager->Register($name,$family,$mobilenumber,$email,$password);

echo json_encode(["success"=>$success],JSON_UNESCAPED_UNICODE);
