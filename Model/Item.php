<?php

class Item {

    private $id;
    private $code;
    private $description;
    private $altercodes;
    private $position;
    private $siteCode;
    private $sales;
    private $measureUnit;
    private $quantity;
    private $coeficient;

    function __construct() {

        $this->altercodes = array();
    }

    function getId() {
        return $this->id;
    }

    function getDescription() {
        return $this->description;
    }

    function getPosition() {
        return $this->position;
    }

    function getSiteCode() {
        return $this->siteCode;
    }

    function setId($id): void {
        $this->id = $id;
    }

    function setDescription($description): void {
        $this->description = $description;
    }

    function setPosition($position): void {
        $this->position = $position;
    }

    function setSiteCode($siteCode): void {
        $this->siteCode = $siteCode;
    }

    function getAltercodes() {
        return $this->altercodes;
    }

    function setAltercodes($altercodes): void {
        $this->altercodes = $altercodes;
    }

    public function addAltercode($altercode) {
        array_push($this->altercodes, $altercode);
    }

    function getSales() {
        return $this->sales;
    }

    function setSales($sales): void {
        $this->sales = $sales;
    }
    function getCode() {
        return $this->code;
    }

    function getMeasureUnit() {
        return $this->measureUnit;
    }

    function getQuantity() {
        return $this->quantity;
    }

    function getCoeficient() {
        return $this->coeficient;
    }

    function setCode($code): void {
        $this->code = $code;
    }

    function setMeasureUnit($measureUnit): void {
        $this->measureUnit = $measureUnit;
    }

    function setQuantity($quantity): void {
        $this->quantity = $quantity;
    }

    function setCoeficient($coeficient): void {
        $this->coeficient = $coeficient;
    }



}
