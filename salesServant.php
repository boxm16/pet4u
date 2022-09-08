<?php

require_once 'Controller/ItemController.php';
$itemController = new ItemController();
$barcode = $_POST["barcode"];
$item = $itemController->getItemSaleFromBarcode($barcode);

$description = $item->getDescription();
$position = $item->getPosition();
$sales = $item->getEshopSales();
$shopsSupply = $item->getShopsSupply();
$totalSales = $item->getTotalSales();
$coeficient = $item->getCoeficient();
$salesInPieces = $sales / $coeficient;
$shopSopplyInPieces = $shopsSupply / $coeficient;
$totalSalesInPieces=$item->getTotalSalesInPieces();

echo "Barcode:$barcode";
echo "<br>";
echo "-----------------";
echo "<br>";
echo "Description:$description";
echo "<br>";
echo "-----------------";
echo "<br>";
echo "$position";
echo "<br>";
echo "-----------------";
echo "<br>";
echo "Sales:$salesInPieces";
echo "<br>";
echo "-----------------";
echo "<br>";
echo "Shops Supply:$shopSopplyInPieces";
echo "<br>";
echo "-----------------";
echo "<br>";
echo "Total Sales:$totalSalesInPieces";
echo "<br>";
echo "-----------------";

