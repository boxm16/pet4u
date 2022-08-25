<?php

require_once 'DataBaseConnection.php';

class TechManDao {

    private $databaseConnection;
    private $connection;

    function __construct() {
        $this->databaseConnection = new DataBaseConnection();
        $this->connection = $this->databaseConnection->getConnection();
    }

    public function createItemTable() {
        $sql = "CREATE TABLE `item` (
  `id` INT(6) NOT NULL ,
  `description` VARCHAR(125) NULL, 
  `position` VARCHAR(25) NULL,
  `status` VARCHAR(100) NULL,
  `sale_speed` VARCHAR(100) NULL,
  `measure_unit` VARCHAR(10) NULL,
  `coeficient` VARCHAR(10) NULL,
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

    public function createAltercodesTable() {
        $sql = "CREATE TABLE `altercodes`  ( 
            `item_id` INT(6) NOT NULL , 
            `item_altercode` VARCHAR(100) NOT NULL ,
            `type` VARCHAR(20)  NULL , 
            FOREIGN KEY (item_id) REFERENCES item(id) ON DELETE CASCADE)
            ENGINE = InnoDB;
       ";
        try {
            $this->connection->exec($sql);
            echo "Table 'altercodes' created successfully" . "<br>";
        } catch (\PDOException $e) {
            if ($e->getCode() == "42S01") {
                echo "Table 'altercodes' already exists" . "<br>";
            } else {
                echo $e->getMessage() . " Error Code:";
                echo $e->getCode() . "<br>";
            }
        }
    }

    public function createNotesTable() {
        $sql = "CREATE TABLE `notes`  ( 
           `barcode` VARCHAR(100) NOT NULL , 
           `note` VARCHAR(500)  NULL)
            ENGINE = InnoDB;
       ";
        try {
            $this->connection->exec($sql);
            echo "Table 'notes' created successfully" . "<br>";
        } catch (\PDOException $e) {
            if ($e->getCode() == "42S01") {
                echo "Table 'notes' already exists" . "<br>";
            } else {
                echo $e->getMessage() . " Error Code:";
                echo $e->getCode() . "<br>";
            }
        }
    }

    //------------------ DELETION--------------------
    public function deleteItemTable() {
        $sql = "DROP TABLE `item`";
        try {
            $this->connection->exec($sql);
            echo "Table 'item' deleted successfully" . "<br>";
        } catch (\PDOException $e) {
            echo $e->getMessage() . " Error Code:";
            echo $e->getCode() . "<br>";
        }
    }

    public function deleteALtercodesTable() {
        $sql = "DROP TABLE `altercodes`";
        try {
            $this->connection->exec($sql);
            echo "Table 'item_barcode' deleted successfully" . "<br>";
        } catch (\PDOException $e) {
            echo $e->getMessage() . " Error Code:";
            echo $e->getCode() . "<br>";
        }
    }

    public function deleteNotesTable() {
        $sql = "DROP TABLE `notes`";
        try {
            $this->connection->exec($sql);
            echo "Table 'notes' deleted successfully" . "<br>";
        } catch (\PDOException $e) {
            echo $e->getMessage() . " Error Code:";
            echo $e->getCode() . "<br>";
        }
    }

}
