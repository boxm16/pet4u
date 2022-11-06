<?php

class Note {

    private $id;
    private $barcode;
    private $noteText;
    private $altercodes;
    private $itemDescription;

    function __construct() {
        $this->altercodes = array();
    }

    function getId() {
        return $this->id;
    }

    function getBarcode() {
        return $this->barcode;
    }

    function getAltercodes() {
        return $this->altercodes;
    }

    function getItemDescription() {
        return $this->itemDescription;
    }

    function setId($id): void {
        $this->id = $id;
    }

    function setBarcode($barcode): void {
        $this->barcode = $barcode;
    }

    function setAltercodes($altercodes): void {
        $this->altercodes = $altercodes;
    }

    function setItemDescription($itemDescription): void {
        $this->itemDescription = $itemDescription;
    }

    public function addAltercode($altercode) {
        array_push($this->altercodes, $altercode);
    }

    function getNoteText() {
        return $this->noteText;
    }

    function setNoteText($noteText): void {
        $this->noteText = $noteText;
    }

}
