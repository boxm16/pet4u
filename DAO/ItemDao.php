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
        $description = $item->getDescription();
        $position = $item->getPosition();
        $site = $item->getSite();


        $sql = "INSERT INTO item (description, position, site) "
                . "        VALUES (:description, :position, :site)";

        $statement = $this->connection->prepare($sql);

        $statement->bindValue(':description', $description);
        $statement->bindValue(':position', $position);
        $statement->bindValue(':site', $site);
        $statement->execute();
        $itemId = $this->connection->lastInsertId();

        return $itemId;
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

}
