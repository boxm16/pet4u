<?php
require_once 'DAO/DataBaseConnection.php';
$databaseConnection = new DataBaseConnection();
$connection = $databaseConnection->getConnection();
if (isset($_POST["deleteLastScan"])) {
    $sql = "DELETE FROM notes";
    $connection->exec($sql);
}

$sql = "SELECT * FROM notes";
try {
    $result = $connection->query($sql)->fetchAll();
} catch (\PDOException $e) {
    echo $e->getMessage() . " Error Code:";
    echo $e->getCode() . "<br>";
    exit;
}
?>
<!DOCTYPE html>

<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <a href="index.php">INDEX</a>
        <hr>
        <form action="<?php echo $_SERVER["PHP_SELF"]; ?>" method="POST">
            <input hidden name="refresh">
            <center>   <button style="background-color: green" type="submit">REFRESH</button></center>
        </form>
        <hr>
        <?php
        if (!$result) {
            
        } else {
            foreach ($result as $row) {

                $barcode = $row["barcode"];
                 $notes = $row["note"];
                echo "<h1>" .$barcode."----".$notes."</h1>";
                echo "<br>";
            }
        }
        ?>

        <hr>
        <form action="<?php echo $_SERVER["PHP_SELF"]; ?>" method="POST">
            <input hidden name="deleteLastScan">
            <button type="submit">DELETE LAST SCANNED BARCODES</button>
        </form>

    </body>
</html>
