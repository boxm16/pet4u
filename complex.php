<?php
require_once 'DAO/DataBaseConnection.php';
require_once 'Model/Item.php';
$databaseConnection = new DataBaseConnection();
$connection = $databaseConnection->getConnection();
$masterCode = $_GET["master_code"];
$items = getAllItems($connection, $masterCode);

function getAllItems($connection, $masterCode) {

    $items = array();
    $sql = "SELECT * FROM complex WHERE master_code='$masterCode'";

    try {
        $result = $connection->query($sql)->fetchAll();
    } catch (\PDOException $e) {
        echo $e->getMessage() . " Error Code:";
        echo $e->getCode() . "<br>";
        exit;
    }

    foreach ($result as $itemData) {

        $item = new Item();
        $item->setCode($itemData["slave_code"]);
        $item->setDescription($itemData["description"]);
        $item->setMeasureUnit($itemData["measure_unit"]);
        $item->setEshopSales($itemData["eshop_sales"]);
        $item->setShopsSupply($itemData["shops_supply"]);
        $item->setTotalSales($itemData["total_sales"]);
        $item->setCoeficient($itemData["coeficient"]);
        $item->setTotalSalesInPieces($itemData["total_sales_in_pieces"]);


        array_push($items, $item);
    }
    return $items;
}
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
        <table>
            <thead>
                <tr> 
                    <th>CODE</th>
                    <th>DESCRIPTION</th>
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
            foreach ($items as $item) {
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
                if ($coeficient != 0) {
                    $eShopSales = $eShopSales / $coeficient;
                    $shopsSupply = $shopsSupply / $coeficient;
                }


                echo "<td>" . $code . "</td>"
              //  . "<td>" . $position . "</td>"
                . "<td>" . $description . "</td>"
                // . "<td>" . $measureUnit . "</td>"
                //. "<td>" . $coeficient . "</td>"
                . "<td>" . $eShopSales . "</td>"
                . "<td>" . $shopsSupply . "</td>";
                // . "<td>" . $totalSales . "</td>"
                if ($isComplex == '1') {
                    echo "<td><a href='complex.php?master_code=$code' target='_blank'>" . $totalSalesInPieces . "</a></td>";
                } else {
                    echo "<td>" . $totalSalesInPieces . "</td>";
                }
                // . "<td>" . $isComplex . "</td>"
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
