<?php
require_once 'DAO/TechManDao.php';

class TechManController {
    
    

    public function createDatabaseTables() {
        $techManDao=new TechManDao();
        $result=$techManDao->createTable();
        return $result;
    }

}
