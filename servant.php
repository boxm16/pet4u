<?php

require_once 'Controller/ItemController.php';
$itemController = new ItemController();
$barcode = $_POST["barcode"];
$item = $itemController->getItemFromBarcode($barcode);
$position = $item->getPosition();
$output = $position."<br>---------------<br>ALTERNATIVE CODES<br>---------------";
$barcodes = $item->getBarcodes();
foreach ($barcodes as $barcode) {
    $output.="<br>".$barcode;
}
echo $output;

