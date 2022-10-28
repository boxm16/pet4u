<?php

require_once 'mPDODataBaseConnection.php';
require_once 'Model/Item.php';

class UploadDao {

    private $databaseConnection;
    private $connection;

    function __construct() {
        $this->databaseConnection = new mPDODataBaseConnection();
        $this->connection = $this->databaseConnection->getLocalhostConnection();
    }

    public function insertUploadedData($itemsFromExcelFile) {
        $id = 0;
        $insertDataItem = array();
        $insertDataAltercode = array();
        foreach ($itemsFromExcelFile as $item) {
            $insertRow = array($id, $item->getDescription(), $item->getPosition());
            array_push($insertDataItem, $insertRow);

            $altercodes = $item->getAltercodes();

            foreach ($altercodes as $altercode) {
                $insertRowAltercode = array($id, $altercode);
                array_push($insertDataAltercode, $insertRowAltercode);
            }
            $id = $id + 1;
        }

        try {
            $this->connection->beginTransaction();
            
            $stm = $this->connection->query("DELETE FROM item");
            $stm->execute();

            $stm = $this->connection->query("DELETE FROM altercode");
            $stm->execute();

            $stmt = $this->connection->multiPrepare('INSERT INTO item (id, description, position)', $insertDataItem);
            $stmt->multiExecute($insertDataItem);
            //------
            $chunks = array_chunk($insertDataAltercode, 5000);

            foreach ($chunks as $chunk) {
                $stmt = $this->connection->multiPrepare('INSERT INTO altercode (item_id, altercode)', $chunk);
                $stmt->multiExecute($chunk);
            }

            $this->connection->commit();
            echo "ALtercodes inserted successfully into database" . "<br>";
        } catch (\PDOException $e) {
            echo $e->getMessage() . " Error Code:";
            echo $e->getCode() . "<br>";
        }
    }

}
