<?php
echo "ladoga";exit;
require_once 'Controller/ItemController.php';
$itemController = new ItemController();
$barcode = $_POST["barcode"];
$item = $itemController->getItemFromBarcode($barcode);
$position = $item->getPosition();
$output = $position."<br>---------------<br>ALTERNATIVE CODES<br>---------------";
$altercodes = $item->getAltercodes();
foreach ($altercodes as $altercode) {
    $output.="<br>".$altercode;
}
echo $output;

