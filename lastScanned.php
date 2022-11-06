<?php
require_once 'DAO/DataBaseConnection.php';
require_once 'Model/Note.php';
require_once 'Model/AltercodeWrapper.php';
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
$notesArray = array();
$sql = "SELECT notes.id, barcode, a2.altercode, a2.type, note,  description FROM notes LEFT JOIN altercode AS a1 ON notes.barcode=a1.altercode  JOIN item ON a1.item_id=item.id INNER JOIN altercode  as a2 ON item.id=a2.item_id ;";
try {
    $result = $connection->query($sql)->fetchAll();

    if (!$result) {
        
    } else {
        foreach ($result as $row) {
            $noteId = $row["id"];
            $barcode = $row["barcode"];
            $altercode = $row["altercode"];
            $altercodeType = $row["type"];
            $noteText = $row["note"];
            $itemDescription = $row["description"];
            if (key_exists($noteId, $notesArray)) {
                $note = $notesArray[$noteId];
                $altercodeWrapper = new AltercodeWrapper();
                $altercodeWrapper->setAltercode($altercode);
                $altercodeWrapper->setType($altercodeType);
                $note->addAltercode($altercodeWrapper);
                $notesArray[$noteId] = $note;
            } else {
                $note = new Note();
                $note->setId($noteId);
                $note->setBarcode($barcode);
                $note->setNoteText($noteText);
                $note->setItemDescription($itemDescription);
                $altercodeWrapper = new AltercodeWrapper();
                $altercodeWrapper->setAltercode($altercode);
                $altercodeWrapper->setType($altercodeType);
                $note->addAltercode($altercodeWrapper);
                $notesArray[$noteId] = $note;
            }
        }
    }
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
            foreach ($notesArray as $note) {
                $barcode = $note->getBarcode();
                $description = $note->getItemDescription();
                $noteText = $note->getNoteText();


                echo "<tr>";
                echo "<td><h2>$barcode</h2></td>";
                echo "<td>";
                foreach ($note->getAltercodes() as $altercodeWrapper) {
                    $pos = strpos($altercodeWrapper->getType(), 'eshop');
                    if ($pos === false) {
                        //do nothing
                    } else {
                        $eShopCode = $altercodeWrapper->getAltercode();
                        $eShopStatus = $altercodeWrapper->getType();
                        echo "<a href='https://www.pet4u.gr/search-products-el.html?subcats=Y&status=A&match=all&pshort=N&pfull=N&pname=Y&pkeywords=N&pcode_from_q=Y&wg_go_direct=Y&search_performed=Y&q=$eShopCode' target='_blank'>" . $eShopCode . "-" . $eShopStatus . "</a>";
                        echo "<br>";
                    }
                }
                echo "</td>";
                echo "<td><h2>$description</h2></td>";
                echo "<td><h2>$noteText<h2></td>";
                 echo "<td><h2><a href='lastScanned.php?removeBarcode=$barcode'>REMOVE</a><h2></td>";
                echo "</tr>";
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
