<?php

require_once "SimpleXLSX.php";

class ExcelReader {

    public function readItems() {

        $excelRows = $this->readExcelFile();

        $items = $this->getItemsFromExcelRows($excelRows); //array of items
        return $items;
    }

    public function readSales() {

        $excelRows = $this->readExcelFileSales();

        $items = $this->getSalesFromExcelRows($excelRows); //array of items
        return $items;
    }

    private function readExcelFile() {
        if ($xlsx = SimpleXLSX::parse("uploads/uploadedExcelFile" . ".xlsx")) {
            $rows = $xlsx->rowsEx();
        } else {
            // header("Location:excelFileErrorPage.php");
            echo " File not uploaded or damaged (" . SimpleXLSX::parseError() . ")";
            echo "<hr>";

            return;
        }
        return $rows;
    }

    private function readExcelFileSales() {
        if ($xlsx = SimpleXLSX::parse("uploads/uploadedExcelFileSales" . ".xlsx")) {
            $rows = $xlsx->rowsEx();
        } else {
            // header("Location:excelFileErrorPage.php");
            echo " File not uploaded or damaged (" . SimpleXLSX::parseError() . ")";
            echo "<hr>";

            return;
        }
        return $rows;
    }

    public function getItemsFromExcelRows($excelRows) {
        $items = array();
        $doubledCodeItems = array();
        $checkArray = array();
        $rowIndex = 0;
        foreach ($excelRows as $row) {
            if ($rowIndex == 0) {
                $rowIndex++;
                continue;
            }
            // sifting off empty rows and rows that show something else
            /*   if ($row[7]["value"] == "მარშრუტი" || $row[7]["value"] == "კონდუქტორი" || $row[7]["value"] == "") {

              continue;
              }
             * */

            $altercode = $row[0]["value"];
            $itemCode = $row[1]["value"];
            $itemDescription = $row[2]["value"];
            $itemPosition = $row[6]["value"];
            $altercodeType = $row[9]["value"];
            if (array_key_exists($itemCode, $items)) {
                $item = $items[$itemCode];

                $altercodeWrapper = new AltercodeWrapper();
                $altercodeWrapper->setAltercode($altercode);
                $altercodeWrapper->setType($altercodeType);
                $item->addAltercode($altercodeWrapper);

                $items[$itemCode] = $item;
            } else {
                $item = new Item();
                $item->setCode($itemCode);

                $altercodeWrapper = new AltercodeWrapper();
                $altercodeWrapper->setAltercode($altercode);
                $altercodeWrapper->setType($altercodeType);

                $item->addAltercode($altercodeWrapper);
                $item->setDescription($itemDescription);
                $item->setPosition($itemPosition);
                $items[$itemCode] = $item;
            }
        }
        return $items;
    }

    public function getSalesFromExcelRows($excelRows) {
        $items = array();
        $doubledCodeItems = array();
        $checkArray = array();
        $indx = 0;
        foreach ($excelRows as $row) {
            if ($indx == 0) {
                $indx++;
                continue;
            }
            // sifting off empty rows and rows that show something else
            /*   if ($row[7]["value"] == "მარშრუტი" || $row[7]["value"] == "კონდუქტორი" || $row[7]["value"] == "") {

              continue;
              }
             * */
            //    echo $row[1]["value"] . "<br>";
            $position = $row[0]["value"];
            $itemCode = $row[1]["value"];
            $description = $row[2]["value"];

            $measureUnit = $row[3]["value"];
            $eshopSales = $row[4]["value"];
            $shopsSupply = $row[5]["value"];
            $totalSales = $row[6]["value"];
            $coeficient = $row[7]["value"];
            $totalSalesInPieces = $row[8]["value"];

            $item = new Item();
            $item->setPosition($position);
            $item->setCode($itemCode);
            $item->setDescription($description);

            $item->setMeasureUnit($measureUnit);
            $item->setEshopSales($eshopSales);
            $item->setShopsSupply($shopsSupply);
            $item->setTotalSales($totalSales);
            $item->setCoeficient($coeficient);
            $item->setTotalSalesInPieces($totalSalesInPieces);
            $items[$itemCode] = $item;
        }
        return $items;
    }

}
