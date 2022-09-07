<?php

require_once 'DAO/ItemDao.php';

class ItemController {

    private $itemDao;

    function __construct() {
        $this->itemDao = new ItemDao();
    }

    public function addNewItem($item) {
        $itemId = '1111111';

        $item->setId($itemId);
        $this->itemDao->addNewItem($item);

        $code = $item->getCodes()[0];
        $this->itemDao->addItemCode($itemId, $code);

        $barcode = $item->getBarcodes()[0];
        $this->itemDao->addItemBarcode($itemId, $barcode);

        return $itemId;
    }

    public function addItemBox($box) {
        $this->itemDao->addItemBox($box);
    }

    public function getAllItems() {
        return $this->itemDao->getAllItems();
    }

    public function getItemFromBarcode($barcode) {
        return $this->itemDao->getItemFromBarcode($barcode);
    }

    public function getAllPositions() {
        return $this->itemDao->getAllPositions();
    }

    public function getAllItemsBySales() {
        $items = $this->itemDao->getAllItems();

        return $this->itemDao->getAllSales();
    }

    public function getSalesByPositions() {
        $itemsWithSales = $this->itemDao->getAllSales();
        $itemsWithPositions = $this->itemDao->getAllItemsByPositions();
        foreach ($itemsWithPositions as $itemWithPosition) {
            $id = $itemWithPosition->getId();
            $altercodes = $itemWithPosition->getAltercodes();
            foreach ($altercodes as $altercode) {
                if (array_key_exists($altercode, $itemsWithSales)) {

                    $itemWithSales = $itemsWithSales[$altercode];
                    
                    $itemWithPosition->setCode($itemWithSales->getCode());

                    $itemWithPosition->setEshopSales($itemWithSales->getEshopSales());
                    $itemWithPosition->setShopsSupply($itemWithSales->getShopsSupply());
                    $itemWithPosition->setCoeficient($itemWithSales->getCoeficient());

                    $itemWithPosition->setTotalSales($itemWithSales->getTotalSales());
                    $itemWithPosition->setMeasureUnit($itemWithSales->getMeasureUnit());
                    $itemWithPosition->setTotalSalesInPieces($itemWithSales->getTotalSalesInPieces());
                    $itemsWithPositions[$id] = $itemWithPosition;
                } else {
                    //  echo "Code:$altercode dont Exist";
                    //  echo "<br>";
                }
            }
        }
        return $itemsWithPositions;
    }

}
