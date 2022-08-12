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
    </head>
    <body>
        <a href="index.php">Go Index</a>
        <?php
        foreach ($allPositions as $item) {
          
            $position = $item->getPosition();
            $description = $item->getDescription();
            echo $position."-". $description;
            echo "<br>";
        }
        ?>
    </body>
</html>
