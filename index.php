<?php
require_once 'TechManController.php';

$techMenController=new TechManController();
$result=$techMenController->createDatabaseTables();
echo $result;

?>