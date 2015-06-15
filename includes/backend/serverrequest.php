<?php

include('pingserv.php');

class ServerRequest {

   /* request info */

   var $ping;
   var $cfg;

   /**
    * Construct
    *
    * PingServer backend
    * functionality
    *
    **/

   public function __construct($addr) {

      $this->ping = new PingServ($addr, 1);

      $this->cfg = $this->conf();

   }

   /**
    * Set 
    * configuration
    * parameters
    *
    **/

   private function conf() {

      return parse_ini_file('expr.ini');

   }

   /**
    * Get the 
    * assigned address
    *
    **/

   private function ip() {

      $ip = 'ip';

      return $this->ping->$ip;

   }

   /**
    * Logging
    *
    **/

   private function logdata($msg) {

      $log = new AppLog();

      $log->request_log($this->ip(), $msg);

   }

   /**
    * Initialize the 
    * message object with
    * the given address.
    * This will give the 
    * correct alert message
    *
    **/

   private function msgt($ipt) {

      return new Message($ipt);

   } 

   /**
    * Get the response
    * information
    *
    **/

   private function request() {

      return $this->ping->getrq();

   }

   /**
    * Get the response
    * code
    *
    **/

   private function getcode() {

      $cd = 'cd';

      return $this->ping->$cd;

   }

   /**
    * Build the 
    * alert message
    *
    **/

   private function buildmsg() {

      $out = "";

      foreach($this->request() as $r) {

         $out .= "$r\n";

      }

      $out .= "HOST IS UNREACHABLE\n\n";

      return $out;

   }

   /**
    * Monitor:
    * get the response 
    * information. If 
    * any below criteria 
    * are met, alert the
    * user
    *
    **/

   public function monitor() {

      $ip = $this->ip();

      $msg = $this->msgt($ip);

      if($this->getcode() > 1) {

         $this->logdata($this->cfg['log1']);

         return;

      }

      if($this->getcode() == 1) {

         return $msg->appout($this->buildmsg());     

      }

      else {

         return;

      }

   }

}

?>
