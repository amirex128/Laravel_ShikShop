
<?php

$json= file_get_contents('php://input');
$userinfo = json_decode($json);


$mobilenumber = $userinfo->mobilenumber;
$password= $userinfo->password;


include 'DatabaseManager.php';
$databasemanager = new DatabaseManager();
$databasemanager->Login($mobilenumber,$password);

