<?php

class AltercodeWrapper {
   private $altercode;
   private $type;
   
   function getAltercode() {
       return $this->altercode;
   }

   function getType() {
       return $this->type;
   }

   function setAltercode($altercode): void {
       $this->altercode = $altercode;
   }

   function setType($type): void {
       $this->type = $type;
   }


}
