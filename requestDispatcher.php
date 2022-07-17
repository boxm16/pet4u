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

if (isset($_POST["addNewItem"])) {

    $item = new Item();
    $item->setDescription($_POST["description"]);
    $item->addCode($_POST["code"]);
    $item->addBarcode($_POST["barcode"]);
    $item->setPosition($_POST["position"]);
    $item->setSite($_POST["site"]);
    $itemController = new ItemController();
    $itemId = $itemController->addNewItem($item);

    $box = new Box();
    $box->setItemId($itemId);
    $box->setBoxBarcode($_POST["boxBarcode"]);
    $box->setItemsQuantity($_POST["itemsInBox"]);
    $itemController->addItemBox($box);

    echo "idem added";
}


