<?php

$barcode = $_POST["barcode"];
// create curl resource
$ch = curl_init();

// set url
curl_setopt($ch, CURLOPT_URL, "http://ec2-54-74-154-166.eu-west-1.compute.amazonaws.com:8080/Pet4U/hello.htm?barcode=$barcode");

//return the transfer as a string
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

// $output contains the output string
$output = curl_exec($ch);

// close curl resource to free up system resources
curl_close($ch);
echo $output;
exit;






require_once 'Controller/ItemController.php';
$itemController = new ItemController();

$item = $itemController->getItemFromBarcode($barcode);
$position = $item->getPosition();
$output = $position . "<br>---------------<br>ALTERNATIVE CODES<br>---------------";
$altercodes = $item->getAltercodes();
foreach ($altercodes as $altercode) {
    $output .= "<br>" . $altercode;
}
echo $output;

