<?php

require_once 'DAO/ItemDao.php';

class ItemController {

    private $itemDao;

    function __construct() {
        $this->itemDao = new ItemDao();
    }

    public function addNewItem($item) {
        $itemId = $this->itemDao->addNewItem($item);

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

}
