<?php

class Item {

    private $id;
    private $description;
    private $codes;
    private $barcodes;
    private $boxBarcodes;
    private $position;

    function __construct() {
        $this->codes = array();
        $this->barcodes = array();
        $this->boxBarcodes = array();
    }

    function getId() {
        return $this->id;
    }

    function getDescription() {
        return $this->description;
    }

    function getCodes() {
        return $this->codes;
    }

    function getBarcodes() {
        return $this->barcodes;
    }

    function getBoxBarcodes() {
        return $this->boxBarcodes;
    }

    function getPosition() {
        return $this->position;
    }

    function setId($id): void {
        $this->id = $id;
    }

    function setDescription($description): void {
        $this->description = $description;
    }

    function setCodes($codes): void {
        $this->codes = $codes;
    }

    function setBarcodes($barcodes): void {
        $this->barcodes = $barcodes;
    }

    function setBoxBarcodes($boxBarcodes): void {
        $this->boxBarcodes = $boxBarcodes;
    }

    function setPosition($position): void {
        $this->position = $position;
    }

    public function addCode($code) {
        array_push($this->codes, $code);
    }

    public function addBarcode($barcode) {
        array_push($this->barcodes, $barcode);
    }

    public function addBoxBarcode($boxBarcode) {
        array_push($this->boxBarcodes, $boxBarcode);
    }

}
