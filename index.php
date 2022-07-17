<?php

require_once 'Controller/TechManController.php';

$techMenController = new TechManController();
$result = $techMenController->createDatabaseTables();
echo $result;
?>