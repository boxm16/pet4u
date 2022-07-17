<?php 
require_once 'Controller/ItemController.php';
$itemController=new ItemController();
$items=$itemController->getAllItems();

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
        <?php
      
       foreach($items as $item){
           echo $item->getId();
           echo "<br>";
       }
        ?>
    </body>
</html>
