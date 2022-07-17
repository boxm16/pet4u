<?php

require_once 'DataBaseConnection.php';

class TechManDao {

    private $databaseConnection;
    private $connection;

    function __construct() {
        $this->databaseConnection = new DataBaseConnection();
       $this->connection= $this->databaseConnection->getConnection();
    }

    public function createTable() {
        $sql = "CREATE TABLE `item` (
  `id` INT(6) NOT NULL AUTO_INCREMENT,
  
  `description` VARCHAR(125) NOT NULL, 
  `position` VARCHAR(25) NULL,
    
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

}
