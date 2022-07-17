<?php

require_once 'DAO/TechManDao.php';

class TechManController {

    public function createDatabaseTables() {
        $techManDao = new TechManDao();
        $techManDao->createItemTable();
        $techManDao->createItemCodeTable();
        $techManDao->createItemBarcodeTable();
        $techManDao->createItemBoxTable();
    }

    public function deleteDatabaseTables() {

        $techManDao = new TechManDao();
        //precedence matter

        $techManDao->deleteItemCodeTable();
        $techManDao->deleteItemBarcodeTable();
        $techManDao->deleteItemBoxTable();
        $techManDao->deleteItemTable();
    }

}
