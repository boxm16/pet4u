<?php

require_once 'DAO/ItemDao.php';
require_once 'ExcelReader/ExcelReader.php';

class UploadController {

    private $itemDao;
    private $excelReader;

    function __construct() {
        $this->itemDao = new ItemDao();
        $this->excelReader = new ExcelReader();
    }

    public function saveUploadedDataIntoDatabase() {
        $itemsFromExcelFile = $this->excelReader->readItems();
        $this->itemDao->insertUploadedData($itemsFromExcelFile);
        return $itemsFromExcelFile;
    }

}
