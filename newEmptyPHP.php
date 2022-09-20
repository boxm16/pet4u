<?php

require_once 'DAO/DataBaseConnection.php';
echo "lapa";

$databaseConnection = new DataBaseConnection();
$connection = $databaseConnection->getConnection();
$insertionSQL = "INSERT  INTO complex (master_code, "
        . "slave_code, "
        . "description, "
        . "measure_unit, "
        . "eshop_sales, "
        . "shops_supply, "
        . "total_sales, "
        . "coeficient, "
        . "total_sales_in_pieces) "
        . "VALUES ("
        . "'12362261', "
        . "'12362261-WE', "
        . "'TONUS Sens.Dog Σολομος 14kg(/kg)', "
        . "'KG', "
        . "'2422', "
        . "'0', "
        . "'2422', "
        . "'14', "
        . "'173')";
try {
  //  $connection->exec($insertionSQL);
} catch (\PDOException $e) {
    echo $e->getMessage() . " Error Code:";
    echo $e->getCode() . "<br>";
    exit;
}
//----------------------------------------------------------
echo ' succ';