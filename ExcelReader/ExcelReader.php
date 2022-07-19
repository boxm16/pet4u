<?php

require_once "SimpleXLSX.php";

class ExcelReader {

    public function readItems() {
        $excelRows = $this->readExcelFile();
        $items = $this->getItemsFromExcelRows($excelRows); //array of items
        return $items;
    }

    private function readExcelFile() {
        if ($xlsx = SimpleXLSX::parse("uploads/itemsExcelFile" . ".xlsx")) {
            $rows = $xlsx->rowsEx();
        } else {
            header("Location:excelFileErrorPage.php");
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

            $itemCode = $row[0]["value"];
            $itemBarcode = $row[1]["value"];
            $itemDescription = $row[2]["value"];
            $itemPosition = $row[3]["value"];
            if (array_key_exists($itemPosition, $items)) {
                
            } else {
                $item = new Item();
                $item->addCode($itemCode);
                $item->addBarcode($itemBarcode);
                $item->setDescription($itemDescription);
                $item->setPosition($itemPosition);
                $items[$itemPosition] = $item;
            }
        }
        return $items;
    }

}
