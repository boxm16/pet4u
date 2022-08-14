<?php

require_once 'DAO/TechManDao.php';

class TechManController {

    public function createDatabaseTables() {
        $techManDao = new TechManDao();
        $techManDao->createItemTable();
        $techManDao->createAltercodesTable();
        $techManDao->createNotesTable();
    }

    public function deleteDatabaseTables() {

        $techManDao = new TechManDao();
        //precedence matter


        $techManDao->deleteNotesTable();
        $techManDao->deleteAltercodesTable();
        $techManDao->deleteItemTable();
    }

}
