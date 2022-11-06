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
                    <th>E-Shop Links</th>
          <!--  <th>M.U.<br> UNIT</th> -->
           <!--     <th>COEF.</th>-->
                    <th>Eshop <br> Sales </th>
                    <th>Shop <br>Supply </th>
                    <th>Total<br> Sales </th>
                  <!--     <th>Total<br> Sales In <br>Pieces </th>-->

                    <th>SALES GRAPHICAL</th>
                </tr>
            </thead>
            <?php
            foreach ($allItems as $item) {
                if ($item->getTotalSalesInPieces() == "") {
                    continue;
                }
                $isComplex = $item->getIsComplex();
                if ($isComplex == '1') {
                    echo " <tr style='background-color:lime'>";
                } else {
                    echo "<tr>";
                }

                $code = $item->getCode();
                $position = $item->getPosition();
                $description = $item->getDescription();

                $measureUnit = $item->getMeasureUnit();
                $coeficient = $item->getCoeficient();
                $eShopSales = $item->getEshopSales();
                $shopsSupply = $item->getShopsSupply();
                $totalSales = $item->getTotalSales();
                $totalSalesInPieces = $item->getTotalSalesInPieces();

                $altercodes = $item->getAltercodes();
                if ($coeficient != 0) {
                    $eShopSales = $eShopSales / $coeficient;
                    $shopsSupply = $shopsSupply / $coeficient;
                }


                echo "<td>" . $code . "</td>"
                . "<td>" . $position . "</td>"
                . "<td>" . $description . "</td>";

                echo "<td>";
                foreach ($altercodes as $altercodeWrapper) {
                    $pos = strpos($altercodeWrapper->getType(), 'eshop');
                    if ($pos === false) {
                        //do nothing
                    } else {
                        $eShopCode = $altercodeWrapper->getAltercode();
                        $eShopStatus = $altercodeWrapper->getType();
                        echo "<a href='https://www.pet4u.gr/search-products-el.html?subcats=Y&status=A&match=all&pshort=N&pfull=N&pname=Y&pkeywords=N&pcode_from_q=Y&wg_go_direct=Y&search_performed=Y&q=$eShopCode' target='_blank'>" . $eShopCode . "-" . $eShopStatus . "</a>";
                        echo "<br>";
                    }
                }
                echo "</td>";

// . "<td>" . $measureUnit . "</td>"
                //. "<td>" . $coeficient . "</td>"
                echo "<td>" . $eShopSales . "</td>"
                . "<td>" . $shopsSupply . "</td>";
                // . "<td>" . $totalSales . "</td>"
                if ($isComplex == '1') {
                    echo "<td><a href='complex.php?master_code=$code' target='_blank'>" . $totalSalesInPieces . "</a></td>";
                } else {
                    echo "<td>" . $totalSalesInPieces . "</td>";
                }

                echo "<td>"
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
