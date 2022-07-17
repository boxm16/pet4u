<?php

class Item {

    private $id;
    private $description;
    private $codes;
    private $barcodes;
    private $boxes;
    private $position;
    private $site;

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

    function getBoxes() {
        return $this->boxes;
    }

    function getPosition() {
        return $this->position;
    }

    function getSite() {
        return $this->site;
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

    function setBoxes($boxes): void {
        $this->boxes = $boxes;
    }

    function setPosition($position): void {
        $this->position = $position;
    }

    function setSite($site): void {
        $this->site = $site;
    }

    public function addCode($code) {
        array_push($this->codes, $code);
    }

    public function addBarcode($barcode) {
        array_push($this->barcodes, $barcode);
    }

    public function addBox($box) {
        array_push($this->boxes, $box);
    }

}
