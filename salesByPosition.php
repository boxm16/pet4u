<?php
require_once 'Controller/ItemController.php';
$itemController = new ItemController();
$allItems = $itemController->getSalesByPositions();
?>
<!DOCTYPE html>

<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
        <style>
            table, th, td {
                border: 1px solid ;
                border-collapse: collapse;
                font-size: 20px;
            }

        </style>
    </head>
    <body>
        <a href="index.php">Go Index</a>
        <hr>
        <table>
            <thead>
                <tr> 
                    <th>CODE</th>
                    <th>POSITION</th>
                    <th>DESCRIPTION</th>
                    <th>M.U.<br> UNIT</th>
                    <th>COEF.</th>
                    <th>Eshop <br> Sales </th>
                    <th>Shop <br>Supply </th>
                    <th>Total<br> Sales </th>
                    <th>Total<br> Sales In <br>Pieces </th>

                    <th>SALES GRAPHICAL</th>
                </tr>
            </thead>
            <?php
            foreach ($allItems as $item) {
                echo "<tr>";
                $code = $item->getCode();
                $position = $item->getPosition();
                $description = $item->getDescription();

                $measureUnit = $item->getMeasureUnit();
                $coeficient = $item->getCoeficient();
                $eShopSales = $item->getEshopSales();
                $shopsSupply = $item->getShopsSupply();
                $totalSales = $item->getTotalSales();
                $totalSalesInPieces = $item->getTotalSalesInPieces();

                echo "<td>" . $code . "</td>"
                . "<td>" . $position . "</td>"
                . "<td>" . $description . "</td>"
                . "<td>" . $measureUnit . "</td>"
                . "<td>" . $coeficient . "</td>"
                . "<td>" . $eShopSales . "</td>"
                . "<td>" . $shopsSupply . "</td>"
                . "<td>" . $totalSales . "</td>"
                . "<td>" . $totalSalesInPieces . "</td>"
                . "<td>"
                . "<svg width='$totalSalesInPieces' height='30'>"
                . " <rect width='$totalSalesInPieces' height='30' style='fill:rgb(0,0,255);stroke-width:3;stroke:rgb(0,0,0)' />"
                . "</svg>"
                . "</td > ";
                echo "</tr>";
            }
            ?>
        </table>
    </body>
</html>
