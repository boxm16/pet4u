<?php

require_once 'Controller/ItemController.php';
$itemController = new ItemController();
$barcode = $_POST["barcode"];
$item = $itemController->getItemFromBarcode($barcode);
$position = $item->getPosition();
echo $position;
