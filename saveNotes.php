<?php
require_once 'DAO/ItemDao.php';
$barcode=$_POST["barcode"];
$notes=$_POST["notes"];
$itemDao=new ItemDao();
$result=$itemDao->saveNotes($barcode, $notes);
echo $result;


