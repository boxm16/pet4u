<?php

require_once "SimpleXLSX.php";

class ExcelReader {

    public function readItems() {

        $excelRows = $this->readExcelFile();

        $items = $this->getItemsFromExcelRows($excelRows); //array of items
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

    public function getItemsFromExcelRows($excelRows) {
        $items = array();
        $doubledCodeItems = array();
        $checkArray = array();
        foreach ($excelRows as $row) {
            // sifting off empty rows and rows that show something else
            /*   if ($row[7]["value"] == "მარშრუტი" || $row[7]["value"] == "კონდუქტორი" || $row[7]["value"] == "") {

              continue;
              }
             * */

            $altercode = $row[0]["value"];
            $itemCode = $row[1]["value"];
            $itemDescription = $row[2]["value"];
            $itemPosition = $row[6]["value"];
            if (array_key_exists($itemCode, $items)) {
                $item = $items[$itemCode];
                $item->addAltercode($altercode);
                $items[$itemCode] = $item;
            } else {
                $item = new Item();
                $item->setCode($itemCode);
                $item->addAltercode($altercode);
                $item->setDescription($itemDescription);
                $item->setPosition($itemPosition);
                $items[$itemCode] = $item;
            }
        }
        return $items;
    }

}
