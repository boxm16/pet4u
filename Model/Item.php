<?php

class Item {

    private $id;
    private $code;
    private $description;
    private $altercodes;
    private $position;
    private $siteCode;
    private $eshopSales;
    private $shopsSupply;
    private $totalSales;
    private $coeficient;
    private $totalSalesInPieces;
    private $measureUnit;
    private $isComplex;

    function __construct() {

        $this->altercodes = array();
    }

    public function addAltercode($altercode) {
        array_push($this->altercodes, $altercode);
    }

    function getId() {
        return $this->id;
    }

    function getCode() {
        return $this->code;
    }

    function getDescription() {
        return $this->description;
    }

    function getAltercodes() {
        return $this->altercodes;
    }

    function getPosition() {
        return $this->position;
    }

    function getSiteCode() {
        return $this->siteCode;
    }

    function getEshopSales() {
        return $this->eshopSales;
    }

    function getShopsSupply() {
        return $this->shopsSupply;
    }

    function getTotalSales() {
        return $this->totalSales;
    }

    function getCoeficient() {
        return $this->coeficient;
    }

    function getTotalSalesInPieces() {
        return $this->totalSalesInPieces;
    }

    function getMeasureUnit() {
        return $this->measureUnit;
    }

    function setId($id): void {
        $this->id = $id;
    }

    function setCode($code): void {
        $this->code = $code;
    }

    function setDescription($description): void {
        $this->description = $description;
    }

    function setAltercodes($altercodes): void {
        $this->altercodes = $altercodes;
    }

    function setPosition($position): void {
        $this->position = $position;
    }

    function setSiteCode($siteCode): void {
        $this->siteCode = $siteCode;
    }

    function setEshopSales($eshopSales): void {
        $this->eshopSales = $eshopSales;
    }

    function setShopsSupply($shopsSupply): void {
        $this->shopsSupply = $shopsSupply;
    }

    function setTotalSales($totalSales): void {
        $this->totalSales = $totalSales;
    }

    function setCoeficient($coeficient): void {
        $this->coeficient = $coeficient;
    }

    function setTotalSalesInPieces($totalSalesInPieces): void {
        $this->totalSalesInPieces = $totalSalesInPieces;
    }

    function setMeasureUnit($measureUnit): void {
        $this->measureUnit = $measureUnit;
    }

    function getIsComplex() {
        return $this->isComplex;
    }

    function setIsComplex($isComplex): void {
        $this->isComplex = $isComplex;
    }

}
