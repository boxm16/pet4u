<?php

require_once 'DataBaseConnection.php';
require_once 'Model/Item.php';
require_once 'Model/Box.php';

class ItemDao {

    private $databaseConnection;
    private $connection;

    function __construct() {
        $this->databaseConnection = new DataBaseConnection();
        $this->connection = $this->databaseConnection->getConnection();
    }

    public function addNewItem($item) {
        $id = $item->getId();
        $description = $item->getDescription();
        $position = $item->getPosition();
        $site = $item->getSite();


        $sql = "INSERT INTO item (id, description, position, site) "
                . "        VALUES (:id,:description, :position, :site)";

        $statement = $this->connection->prepare($sql);

        $statement->bindValue(':id', $id);
        $statement->bindValue(':description', $description);
        $statement->bindValue(':position', $position);
        $statement->bindValue(':site', $site);
        $statement->execute();
    }

    public function addItemCode($itemId, $code) {
        $sql = "INSERT INTO item_code (item_id, item_code) "
                . "        VALUES (:item_id, :item_code)";

        $statement = $this->connection->prepare($sql);

        $statement->bindValue(':item_id', $itemId);
        $statement->bindValue(':item_code', $code);
        $statement->execute();
    }

    public function addItemBarcode($itemId, $barcode) {
        $sql = "INSERT INTO item_barcode (item_id, item_barcode) "
                . "        VALUES (:item_id, :item_barcode)";

        $statement = $this->connection->prepare($sql);

        $statement->bindValue(':item_id', $itemId);
        $statement->bindValue(':item_barcode', $barcode);
        $statement->execute();
    }

    public function addItemBox($box) {
        $itemId = $box->getItemId();

        $boxBarcode = $box->getBoxBarcode();
        $itemQuantity = $box->getItemsQuantity();
        $sql = "INSERT INTO item_box (item_id, box_barcode, item_quantity) "
                . "        VALUES (:item_id, :box_barcode, :item_quantity)";

        $statement = $this->connection->prepare($sql);

        $statement->bindValue(':item_id', $itemId);
        $statement->bindValue(':box_barcode', $boxBarcode);
        $statement->bindValue(':item_quantity', $itemQuantity);
        $statement->execute();
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

    public function insertUploadedData($items) {
        foreach ($items as $item) {
            $this->addNewItem($item);
            echo $item->getDescription();
            echo "<br>";
        }
    }

    public function getItemFromBarcode($barcode) {
        //first inserting barcode into last scanned barcode
        
        $insertionSQL="INSERT INTO last_scanned (barcode) VALUES ($barcode)";
        
         try {
         $this->connection->exec($insertionSQL);
        } catch (\PDOException $e) {
            echo $e->getMessage() . " Error Code:";
            echo $e->getCode() . "<br>";
            exit;
        }
        
        $sql = "SELECT * FROM item "
                . "INNER JOIN item_barcode ON item.id=item_barcode.item_id "
                . "INNER JOIN item_code ON item.id=item_code.item_id "
                //   . "INNER JOIN item_box ON item.id=item_box.item_id "
                . "WHERE item_barcode='$barcode'";


        try {
            $result = $this->connection->query($sql)->fetch(PDO::FETCH_ASSOC);
        } catch (\PDOException $e) {
            echo $e->getMessage() . " Error Code:";
            echo $e->getCode() . "<br>";
            exit;
        }

        $item = new Item();
        if (!$result) {
            $item->setPosition("Barcode not found");
        } else {

            $itemId = $result["id"];
            $description = $result["description"];
            $position = $result["position"];

            $itemBarcode = $result["item_barcode"];
            $itemCode = $result["item_code"];


            $item->setId($itemId);
            $item->setDescription($description);
            $item->setPosition("POSITION:" . $position);
            $item->addCode($itemCode);
            $item->addBarcode($itemBarcode);
        }
        return $item;
    }

}
