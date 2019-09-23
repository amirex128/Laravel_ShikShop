<?php

$json= file_get_contents('php://input');
$request = json_decode($json);

$mobilenumber = $request->mobilenumber;
$content = $request->content;

include 'DatabaseManager.php';
$databasemanager = new DatabaseManager();
$databasemanager->AddTicket($mobilenumber,$content);




