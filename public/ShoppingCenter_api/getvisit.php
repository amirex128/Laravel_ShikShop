<?php



$json= file_get_contents('php://input');
$request = json_decode($json);

$mobilenumber = $request[0]->usermobilenumber;



include 'DatabaseManager.php';
$databaseManager=new DatabaseManager();
$databaseManager->getVisit($mobilenumber);
