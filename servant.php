<?php

require_once 'Controller/ItemController.php';
$itemController = new ItemController();
$barcode = $_POST["barcode"];
$item = $itemController->getItemFromBarcode($barcode);
$position = $item->getPosition();
$output = $position."\n ALTERNATIVE CODES";
$barcodes = $item->getBarcodes();
foreach ($barcodes as $barcode) {
    $output.="\n ".$barcode;
}
echo $output;

