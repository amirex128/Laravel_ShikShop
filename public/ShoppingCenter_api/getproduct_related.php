<?php



$json= file_get_contents('php://input');
$request = json_decode($json);

$category_id = $request[0]->category_id;


include 'DatabaseManager.php';
$databasemanager = new DatabaseManager();
$databasemanager->getproduct_in_related($category_id);

