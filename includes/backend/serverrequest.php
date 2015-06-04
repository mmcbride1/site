<?php

include('pingserv.php');
include('messenger.php');

class ServerRequest {

   /* request info */

   var $ping;

   /**
    * Construct
    *
    * PingServer backend
    * functionality
    *
    **/

   public function __construct($addr) {

      $this->ping = new PingServ($addr, 1);

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

      $ip = 'ip';

      $msg = $this->msgt($ip);

      if($this->getcode() == 1) {

         return $msg->appout($this->buildmsg());     

      }

      else {

         return;

      }

   }

}

?>
