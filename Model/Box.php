<?php

class Box {

    private $itemId;
    private $boxBarcode;
    private $itemsQuantity;

    function getItemId() {
        return $this->itemId;
    }

    function getBoxBarcode() {
        return $this->boxBarcode;
    }

    function getItemsQuantity() {
        return $this->itemsQuantity;
    }

    function setItemId($itemId): void {
        $this->itemId = $itemId;
    }

    function setBoxBarcode($boxBarcode): void {
        $this->boxBarcode = $boxBarcode;
    }

    function setItemsQuantity($itemsQuantity): void {
        $this->itemsQuantity = $itemsQuantity;
    }

}
