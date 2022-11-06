<?php
require_once 'DAO/DataBaseConnection.php';
$databaseConnection = new DataBaseConnection();
$connection = $databaseConnection->getConnection();
if (isset($_POST["deleteLastScan"])) {
    $sql = "DELETE FROM notes";
    $connection->exec($sql);
}
if (isset($_GET["removeBarcode"])) {
    $barcode = $_GET["removeBarcode"];
    $sql = "DELETE  FROM notes  WHERE barcode='$barcode'";
    try {
        $result = $connection->exec($sql);
    } catch (\PDOException $e) {
        echo $e->getMessage() . " Error Code:";
        echo $e->getCode() . "<br>";
        exit;
    }
}

$sql = "SELECT * FROM notes LEFT JOIN altercode ON notes.barcode=altercode.altercode LEFT JOIN item ON altercode.item_id=item.id;";
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
        <style>
            table, th, td {
                border: 1px solid ;
                border-collapse: collapse;
                font-size: 20px;
            }

        </style>
    </head>
    <body>
        <a href="index.php">INDEX</a>
        <hr>
        <form action="<?php echo $_SERVER["PHP_SELF"]; ?>" method="POST">
            <input hidden name="refresh">
            <center>   <button style="background-color: green" type="submit">REFRESH</button></center>
        </form>
        <hr>

        <table>
            <?php
            if (!$result) {
                
            } else {
                foreach ($result as $row) {

                    $barcode = $row["barcode"];
                    $notes = $row["note"];
                    $description = $row["description"];
                    echo "<tr>";
                    echo "<td><h2>" . $barcode . "</h2></td>";
                    echo "<td><h2>" . $description . "</h2></td>";
                    echo "<td><h2>" . $notes . "</h2></td>";
                    echo "<td><h2><a href='lastScanned.php?removeBarcode=$barcode'>REMOVE</a></h2></td>";
                    echo "</tr>";
                }
            }
            ?>
        </table>

        <hr>
        <form action="<?php echo $_SERVER["PHP_SELF"]; ?>" method="POST">
            <input hidden name="deleteLastScan">
            <button type="submit">DELETE LAST SCANNED BARCODES</button>
        </form>

    </body>
</html>
