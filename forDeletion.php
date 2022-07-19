<?php
require_once 'Controller/UploadController.php';
require_once 'Model/Item.php';
$uploadController = new UploadController();
$items = $uploadController->saveUploadedDataIntoDatabase();
?>
<!DOCTYPE html>

<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
        <style>
            table, th, td {
                border: 1px solid black;
                border-collapse: collapse;
            }
        </style>
    </head>
    <body>
        <table >
            <?php
            foreach ($items as $item) {
                echo "<tr>"
                . "<td>" . $item->getCodes()[0] . "</td>"
                . "<td>" . $item->getBarcodes()[0] . "</td>"
                . "<td>" . $item->getDescription() . "</td>"
                . "<td>" . $item->getPosition() . "</td>"
                . "</tr>";
            }
            ?>
        </table>
    </body>
</html>
