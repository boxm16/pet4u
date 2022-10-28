<?php

require_once 'DAO/ItemDao.php';
require_once 'ExcelReader/ExcelReader.php';
require_once 'PD2/UploadDao.php';

class UploadController {

    private $itemDao;
    private $uploadDao;
    private $excelReader;

    function __construct() {
        $this->itemDao = new ItemDao();
        $this->uploadDao = new UploadDao();
        $this->excelReader = new ExcelReader();
    }

    public function saveUploadedDataIntoDatabase() {

        $itemsFromExcelFile = $this->excelReader->readItems();

        $this->uploadDao->insertUploadedData($itemsFromExcelFile);
        return $itemsFromExcelFile;
    }

    public function saveUploadedSalesDataIntoDatabase() {

        $itemsFromExcelFile = $this->excelReader->readSales();

        $this->uploadDao->insertUploadedSalesData($itemsFromExcelFile);
        return $itemsFromExcelFile;
    }

}
