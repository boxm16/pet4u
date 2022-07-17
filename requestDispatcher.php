<?php

require_once 'Model/Item.php';
require_once 'Controller/ItemController.php';
require_once 'Controller/TechManController.php';

if (isset($_GET["createTables"])) {
    $techManController=new TechManController();
    $techManController->createDatabaseTables();
    
}

if (isset($_POST["addNewItem"])) {
    $item = new Item();
    $item->setCodes($_POST["code"]);
    $item->addCode($_POST["code"]);
    $itemController = new ItemController();
    $itemController->addNewItem($item);
    echo "idem added";
}


