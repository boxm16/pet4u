<?php
require_once 'Controller/ItemController.php';
$itemController = new ItemController();
$allItems = $itemController->getAllPositions();
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
                    <th>POSITION</th>
                    <th>DESCRIPTION</th>
                    <th>SALE`S RATE</th>
                     <th>SALE`S RATE GRAPHICAL</th>
                </tr>
            </thead>
            <?php
            foreach ($allItems as $item) {
                echo "<tr>";
                $position = $item->getPosition();
                $description = $item->getDescription();
                $siteCode = $item->getSiteCode();
                $sales = $item->getSales();
                echo "<td>" . $position . "</td>"
                . "<td>" . $description . "</td>"
                . "<td>" . $sales . "</td>"
                . "<td>"
                . "<svg width='$sales' height='30'>"
                . " <rect width='$sales' height='30' style='fill:rgb(0,0,255);stroke-width:3;stroke:rgb(0,0,0)' />"
                . "</svg>"
                . "</td > ";
                echo "</tr>";
            }
            ?>
        </table>
    </body>
</html>
