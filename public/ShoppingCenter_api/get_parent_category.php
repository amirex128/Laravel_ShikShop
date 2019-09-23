<?php



$json= file_get_contents('php://input');
$request = json_decode($json);

$categoty_id= $request[0]->categoty_id;


include 'DatabaseManager.php';
$databasemanager = new DatabaseManager();
$databasemanager->get_category_parent($categoty_id);

