<?php

require_once 'Model/Item.php';
require_once 'Model/Box.php';

require_once 'Controller/ItemController.php';
require_once 'Controller/TechManController.php';


if (isset($_GET["createTables"])) {
    $techManController = new TechManController();
    $techManController->createDatabaseTables();
}
if (isset($_GET["deleteTables"])) {
    $techManController = new TechManController();
    $techManController->deleteDatabaseTables();
}




