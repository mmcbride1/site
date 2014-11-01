<?php

//include('queue.php');

class PingSite {

   var $http;
   var $curl;

   /**
    * Constructor 
    *
    * Initalize the
    * user site address
    **/

   public function __construct($addr) {

//      $q = new RequestQueue();

      $this->http = $addr;
      
     // $this->curl = $this->getheader();
      $this->window();

   }

   public function set() {

      $this->curl = $this->getheader();

      return $this->curl;

   }

   /**
    * Performs the 
    * primary ping 
    * operation that
    * gets the site 
    * response info
    **/

   public function getheader() {

      $beat = $this->http;

      $ch = curl_init();

      curl_setopt_array($ch, array(

      CURLOPT_URL => $beat,
      CURLOPT_RETURNTRANSFER => true

      ));

      curl_exec($ch);

      $stat = curl_getinfo($ch);

      curl_close($ch);

      return $stat;

   }

   public function geturli() {

      $u = $this->curl['url'];

      $u = split("/", $u);

      return $u[2];

   }

   public function gettime() {

      $t = $this->curl['total_time'];

      return $t;

   }

   public function getcode() {

      $c = $this->curl['http_code'];

      return $c;

   }

   public function display() {

      $u = $this->geturli();
      $t = $this->gettime();
      $c = $this->getcode();

      echo '<h1>'.$u.'</h1>';
      echo '<h1>time: '.$t.'</h1>';
      echo '<h1>code: '.$c.'</h1>';

      return;

   }

   public function window() {

      echo '<script src="popup2.js"></script>';
      echo '<script>openRequestedPopup();</script>';
 
   }

}

//$obj = new PingSite('www.google.com');

//$obj->set();

//print $obj->gettime();

?>
