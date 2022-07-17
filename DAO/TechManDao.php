<?php

require_once 'DataBaseConnection.php';

class TechManDao {

    private $databaseConnection;
    private $connection;

    function __construct() {
        $this->databaseConnection = new DataBaseConnection();
        $this->connection = $this->databaseConnection->getConnection();
    }

    public function createItemCodeTable() {
        $sql = "CREATE TABLE `item_code`  ( 
            `item_id` INT(6) NOT NULL , 
            `item_code` VARCHAR(100) NOT NULL , 
            FOREIGN KEY (item_id) REFERENCES item(id) ON DELETE CASCADE)
            ENGINE = InnoDB;
       ";
        try {
            $this->connection->exec($sql);
            echo "Table 'item_code' created successfully" . "<br>";
        } catch (\PDOException $e) {
            if ($e->getCode() == "42S01") {
                echo "Table 'item_code' already exists" . "<br>";
            } else {
                echo $e->getMessage() . " Error Code:";
                echo $e->getCode() . "<br>";
            }
        }
    }

    public function createItemTable() {
        $sql = "CREATE TABLE `item` (
  `id` INT(6) NOT NULL AUTO_INCREMENT,
  `description` VARCHAR(125) NULL, 
  `position` VARCHAR(25) NULL,
  `site` VARCHAR(3000) NULL,
   PRIMARY KEY (`id`))
   ENGINE = InnoDB
   DEFAULT CHARACTER SET = utf8;
   ";
        try {
            $this->connection->exec($sql);
            echo "Table 'item' created successfully" . "<br>";
        } catch (\PDOException $e) {
            if ($e->getCode() == "42S01") {
                echo "Table 'item' already exists" . "<br>";
            } else {
                echo $e->getMessage() . " Error Code:";
                echo $e->getCode() . "<br>";
            }
        }
    }

    public function createItemBarcodeTable() {
        $sql = "CREATE TABLE `item_barcode`  ( 
            `item_id` INT(6) NOT NULL , 
            `item_barcode` VARCHAR(100) NOT NULL , 
            FOREIGN KEY (item_id) REFERENCES item(id) ON DELETE CASCADE)
            ENGINE = InnoDB;
       ";
        try {
            $this->connection->exec($sql);
            echo "Table 'item_barcode' created successfully" . "<br>";
        } catch (\PDOException $e) {
            if ($e->getCode() == "42S01") {
                echo "Table 'item_barcode' already exists" . "<br>";
            } else {
                echo $e->getMessage() . " Error Code:";
                echo $e->getCode() . "<br>";
            }
        }
    }

    public function createItemBoxTable() {
        $sql = "CREATE TABLE `item_box`  ( 
            `item_id` INT(6) NOT NULL , 
            `box_barcode` VARCHAR(100) NOT NULL , 
            `quantity` INT(25) NOT NULL , 
            FOREIGN KEY (item_id) REFERENCES item(id) ON DELETE CASCADE)
            ENGINE = InnoDB;
       ";
        try {
            $this->connection->exec($sql);
            echo "Table 'item_box' created successfully" . "<br>";
        } catch (\PDOException $e) {
            if ($e->getCode() == "42S01") {
                echo "Table 'item_box' already exists" . "<br>";
            } else {
                echo $e->getMessage() . " Error Code:";
                echo $e->getCode() . "<br>";
            }
        }
    }

}
