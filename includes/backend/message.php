<?php

class Message {

   /* hold address */

   var $http;

   /**
    * Constructor 
    *
    **/

   public function __construct($addr) {
   
      $this->http = $addr;
   
   }
   
   /**
    * The message 
    * header for each
    * sent mail
    *
    **/
    
   public function msgheader() {
   
      return "WONTBLINKBOX NOTIFICATION FOR REGISTERED ADDRESS: $this->http.\n\n";
   
   }

   /**
    * Display this if
    * no data can be
    * returned 
    *
    **/

   public function nodata() {

      return $this->msgheader()."a performance issue has been detected but specific data cannot be displayed at this time.\n\n".$this->msgfooter();

   }
   
   /**
    * The message 
    * footer for each
    * sent mail
    *
    **/
   
   public function msgfooter() {
   
      return "Please verify the status of this address and/or notify your administrator!";
   
   }
   
   /**
    * Displayed message
    * for response time
    * check failure
    *
    **/
   
   public function load($t) {
   
      return $this->msgheader()."This site is currently posting a response time of $t seconds!\n\n".$this->msgfooter();
   
   }
   
   /**
    * Displayed message
    * for http code 
    * check failure
    *
    **/
   
   public function resp($c) {
   
      return $this->msgheader()."This site is currently responding with http code: \"$c\"\n\n".$this->msgfooter();

   
   }
   
   /**
    * Displayed message 
    * for response time 
    * and http code
    * check failures
    *
    **/
   
   public function tcrq($t, $c) {
   
      return $this->msgheader()."This site is currently posting a response time of $t seconds with http code: \"$c\"\n\n".$this->msgfooter();
   
   
   }

   /**
    * Displayed message
    * for application
    * server check
    * failure
    *
    **/

   public function appout($msg) {

      return $this->msgheader()."The request to the server produced the following data:\n\n $msg".$this->msgfooter();

   }   

}

?>
