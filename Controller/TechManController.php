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

}
