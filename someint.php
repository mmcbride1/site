<?php
 
class SomeInt {

   var $num;

   public function __construct() {

      $this->num = $this->gen();

   }

   public function gen() {

      return rand();

   }

   public function get() {

      return $this->num;

   }

}

#$var = new SomeInt();

#print $var->get();

?>
