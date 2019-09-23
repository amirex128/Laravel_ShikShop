<?php



$json= file_get_contents('php://input');
$request = json_decode($json);

$categoty_id= $request->categoty_id;


include 'DatabaseManager.php';
$databasemanager = new DatabaseManager();
$databasemanager->hasparent($categoty_id);

