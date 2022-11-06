<?php

require_once 'DataBaseConnection.php';
require_once 'Model/Item.php';
require_once 'Model/AltercodeWrapper.php';

class ItemDao {

    private $databaseConnection;
    private $connection;

    function __construct() {
        $this->databaseConnection = new DataBaseConnection();
        $this->connection = $this->databaseConnection->getConnection();
    }

    public function getAllItems() {

        $items = array();
        $sql = "SELECT * FROM item "
                . "INNER JOIN item_barcode ON item.id=item_barcode.item_id "
                . "INNER JOIN item_code ON item.id=item_code.item_id "
                . "INNER JOIN item_box ON item.id=item_box.item_id";

        try {
            $result = $this->connection->query($sql)->fetchAll();
        } catch (\PDOException $e) {
            echo $e->getMessage() . " Error Code:";
            echo $e->getCode() . "<br>";
            exit;
        }

        foreach ($result as $itemData) {


            $itemId = $itemData["id"];
            $description = $itemData["description"];
            $position = $itemData["position"];

            $itemBarcode = $itemData["item_barcode"];
            $itemCode = $itemData["item_code"];
            $boxBarcode = $itemData["box_barcode"];
            $itemsInBox = $itemData["item_quantity"];

            if (!array_key_exists($itemId, $items)) {
                $item = new Item();
                $item->setId($itemId);
                $item->setDescription($description);
                $item->setPosition($position);
                $item->addCode($itemCode);
                $item->addBarcode($itemBarcode);

                $items[$itemId] = $item;
            }
        }

        return $items;
    }

    public function getItemFromBarcode($barcode) {
        //first inserting barcode into last scanned barcode

        $insertionSQL = "INSERT  INTO notes (barcode, note) VALUES ('$barcode', 'SCANNED FOR POSITION AND/OR ALTERCODES')";

        try {
            $this->connection->exec($insertionSQL);
        } catch (\PDOException $e) {
            echo $e->getMessage() . " Error Code:";
            echo $e->getCode() . "<br>";
            exit;
        }
        //----------------------------------------------------------
        //get id
        $idSql = "SELECT item_id FROM altercode WHERE  altercode='$barcode'";
        try {
            $result = $this->connection->query($idSql)->fetch();
        } catch (\PDOException $e) {
            echo $e->getMessage() . " Error Code:";
            echo $e->getCode() . "<br>";
            exit;
        }
        $id = $result["item_id"];



        $sql = "SELECT * FROM item "
                . "INNER JOIN altercode ON item.id=altercode.item_id "
                . "WHERE id='$id'";


        try {
            $resultRows = $this->connection->query($sql)->fetchAll();
        } catch (\PDOException $e) {
            echo $e->getMessage() . " Error Code:";
            echo $e->getCode() . "<br>";
            exit;
        }


        $item = new Item();
        if (!$result) {
            $item->setPosition("Barcode not found");
        } else {

            foreach ($resultRows as $row) {
                $itemId = $row["id"];
                $description = $row["description"];
                $position = $row["position"];
                $altercode = $row["altercode"];



                $item->setId($itemId);
                $item->setDescription($description);
                $item->setPosition("POSITION:" . $position);
                $item->addAltercode($altercode);
            }
        }
        return $item;
    }

    public function getAllPositions() {
        $items = array();
        $sql = "SELECT * FROM item  ORDER BY item.position";

        try {
            $result = $this->connection->query($sql)->fetchAll();
        } catch (\PDOException $e) {
            echo $e->getMessage() . " Error Code:";
            echo $e->getCode() . "<br>";
            exit;
        }

        foreach ($result as $itemData) {


            $itemId = $itemData["id"];
            $description = $itemData["description"];
            $position = $itemData["position"];
            $sales = $itemData["sale_speed"];

            //   $itemBarcode = $itemData["item_barcode"];
            // $itemCode = $itemData["item_code"];
            // $boxBarcode = $itemData["box_barcode"];
            //  $itemsInBox = $itemData["item_quantity"];

            if (!array_key_exists($itemId, $items)) {
                $item = new Item();
                $item->setId($itemId);
                $item->setDescription($description);
                $item->setPosition($position);
                $item->setSales($sales);

                $items[$itemId] = $item;
            }
        }

        return $items;
    }

    public function getAllSales() {

        $items = array();
        $sql = "SELECT * FROM sales";

        try {
            $result = $this->connection->query($sql)->fetchAll();
        } catch (\PDOException $e) {
            echo $e->getMessage() . " Error Code:";
            echo $e->getCode() . "<br>";
            exit;
        }

        foreach ($result as $itemData) {

            $item = new Item();
            $item->setCode($itemData["code"]);
            $item->setDescription($itemData["description"]);
            $item->setMeasureUnit($itemData["measure_unit"]);
            $item->setEshopSales($itemData["eshop_sales"]);
            $item->setShopsSupply($itemData["shops_supply"]);
            $item->setTotalSales($itemData["total_sales"]);
            $item->setCoeficient($itemData["coeficient"]);
            $item->setTotalSalesInPieces($itemData["total_sales_in_pieces"]);
            $item->setIsComplex($itemData["is_complex"]);

            $items[$itemData["code"]] = $item;
        }



        return $items;
    }

    public function saveNotes($barcode, $notes) {
        $insertionSQL = "INSERT INTO notes (barcode, note) VALUES ('$barcode', '$notes')";
        try {
            $this->connection->exec($insertionSQL);
        } catch (\PDOException $e) {
            //echo $e->getMessage() . " Error Code:";
            //  echo $e->getCode() . "<br>";
            return $e->getMessage() . " Error Code:" . $e->getCode() . "<br>";
        }
        return "success";
    }

    public function getSalesByPositions() {
        $items = array();
        $sql = "SELECT * FROM sales ";

        try {
            $result = $this->connection->query($sql)->fetchAll();
        } catch (\PDOException $e) {
            echo $e->getMessage() . " Error Code:";
            echo $e->getCode() . "<br>";
            exit;
        }

        foreach ($result as $itemData) {

            $item = new Item();
            $item->setCode($itemData["code"]);
            $item->setDescription($itemData["description"]);

            $item->setMeasureUnit($itemData["measure_unit"]);
            $item->setSales($itemData["quantity"]);
            $item->setCoeficient($itemData["coeficient"]);

            array_push($items, $item);
        }
        return $items;
    }

    public function getAllItemsByPositions() {
        $items = array();
        $sql = "SELECT * FROM item "
                . "INNER JOIN altercode ON item.id=altercode.item_id  ORDER BY position";

        try {
            $result = $this->connection->query($sql)->fetchAll();
        } catch (\PDOException $e) {
            echo $e->getMessage() . " Error Code:";
            echo $e->getCode() . "<br>";
            exit;
        }

        foreach ($result as $itemData) {


            $itemId = $itemData["id"];
            $description = $itemData["description"];
            $position = $itemData["position"];

            $altercode = $itemData["altercode"];
            $altercodeType = $itemData["type"];

            if (!array_key_exists($itemId, $items)) {
                $item = new Item();
                $item->setId($itemId);
                $item->setDescription($description);
                $item->setPosition($position);

                $altercodeWrapper = new AltercodeWrapper();
                $altercodeWrapper->setAltercode($altercode);
                $altercodeWrapper->setType($altercodeType);

                $item->addAltercode($altercodeWrapper);


                $items[$itemId] = $item;
            } else {
                $item = $items[$itemId];

                $altercodeWrapper = new AltercodeWrapper();
                $altercodeWrapper->setAltercode($altercode);
                $altercodeWrapper->setType($altercodeType);

                $item->addAltercode($altercodeWrapper);


                $items[$itemId] = $item;
            }
        }

        return $items;
    }

}
