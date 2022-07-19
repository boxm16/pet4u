<?php

require_once 'DAO/ItemDao.php';
require_once 'ExcelReader/ExcelReader.php';

class UploadController {

    private $dataBaseConnection;
    private $excelReader;

    function __construct() {
        $this->dataBaseConnection = new DataBaseConnection();
        $this->excelReader = new ExcelReader();
    }

    public function saveUploadedDataIntoDatabase() {
        $itemsFromExcelFile=$this->excelReader->readItems();
        return $itemsFromExcelFile;
        
        $xlRoutes = $this->routeController->getFullRoutes($clientId);
        $dbRoutes = $this->dataBaseTools->getRouteNumbers();

        $routeNumbersForInsertion = array();
        $vouchersForDeletion = array();

        foreach ($xlRoutes as $route) {

            $routeNumber = $route->getNumber();

            if (in_array($routeNumber, $dbRoutes)) {
                
            } else {

                array_push($routeNumbersForInsertion, $routeNumber);
            }

            $days = $route->getDays();
            foreach ($days as $day) {
                $exoduses = $day->getExoduses();
                foreach ($exoduses as $exodus) {
                    $tripVouchers = $exodus->getTripVouchers();
                    foreach ($tripVouchers as $tripVoucher) {
                        $tripVoucherNumber = $tripVoucher->getNumber();
                        array_push($vouchersForDeletion, $tripVoucherNumber);
                    }
                }
            }
        }
        if (count($routeNumbersForInsertion) > 0) {
            $insertData = array();
            foreach ($routeNumbersForInsertion as $routeNumber) {

                $exploded = explode("-", $routeNumber);
                $prefix = $exploded[0];
                $suffix = null;
                if (count($exploded) > 1) {
                    $suffix = $exploded[1];
                }
                $insertRow = array($routeNumber, $prefix, $suffix, "A-პუნკტი", "B-პუნკტი");
                array_push($insertData, $insertRow);
            }
            $this->dataBaseTools->insertRoutes($insertData);
        }

        $this->dataBaseTools->deleteVouchers($vouchersForDeletion);
        $this->dataBaseTools->insertUploadedData($xlRoutes);
    }

}
