<?php
require_once 'Controller/ItemController.php';
$itemController = new ItemController();
$allPositions = $itemController->getAllPositions();
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
                </tr>
            </thead>
            <?php
            foreach ($allPositions as $item) {
                echo "<tr>";
                $position = $item->getPosition();
                $description = $item->getDescription();
                echo "<td>" . $position . "</td>"
                //. "<td>" . $description . "</td>"
                . "<td>" . $description . "</td>";
                echo "</tr>";
            }
            ?>
        </table>
    </body>
</html>
