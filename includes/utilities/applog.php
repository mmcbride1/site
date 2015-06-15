<?php

class AppLog {

   /* configuration */

   var $config;
   var $address;

   private $mainlog;

   /**
    * Construct
    * 
    * Set file location
    * and configuration
    *
    **/

   public function __construct() {

      $this->config = $this->conf();

      $this->mainlog = $this->config['log'];

   }

   /**
    * Get the 
    * configuration 
    * file
    *
    **/

   private function conf() {

      return parse_ini_file('expr.ini');

   }

   /**
    * Initialize the
    * address to be 
    * logged
    *
    **/

   public function getaddr($addr) {

      $this->address = $addr;

   }

   /**
    * Get the date 
    * and time of this
    * logged event
    *
    **/

   private function logtime() {

      $date = new DateTime('America/New_York');

      return $date->format('y-m-d-h:i:s');

   }

   /**
    * Put together 
    * the basic log
    * message
    *
    **/

   private function logmsg($msg) {

      return $this->logtime().": $msg";

   }

   /**
    * Write the log
    *
    **/

   private function logfile($log) {

      error_log("$log\n", 3, $this->mainlog);

   }

   /**
    * For events 
    * invloving return
    * codes, build the
    * log
    *
    **/

   public function return_code_void($msg) {

      $log = $this->logmsg($this->address." - $msg");

      $this->logfile($log);

      return;

   }

   /**
    * For request events:
    * carry out the 
    * return code log
    *
    **/

   public function request_log($adr, $msg) {

      $this->getaddr($adr);

      $this->return_code_void($msg);

      return;

   } 

}

?>
