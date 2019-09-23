<?php



$json= file_get_contents('php://input');
$request = json_decode($json);

$string = $request[0]->string;


include 'DatabaseManager.php';
$databasemanager = new DatabaseManager();
$databasemanager->search($string);

