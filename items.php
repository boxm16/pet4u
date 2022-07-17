<?php
require_once 'Controller/ItemController.php';
$itemController = new ItemController();
$items = $itemController->getAllItems();
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        ITEMS
        <hr>
        <a href="index.php">Main Page</a>
        <hr>
        <a href="addNewItem.php">Add New Item</a>
        <hr>
        <?php
        foreach ($items as $item) {
            echo $item->getId(). "-" . $item->getCodes()[0] . "-" . $item->getDescription()."-" . $item->getBarcodes()[0];
            echo "<br>";
        }
        ?>
    </body>
</html>
