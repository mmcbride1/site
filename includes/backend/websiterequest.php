<?php

include('pingsite.php');
include('message.php');
include('messenger.php');

class WebsiteRequest {

  /* configurations */

   var $req;
   var $cfg;

   /**
    * Construct
    *
    * PingSite backend
    * functionality
    *
    **/

   public function __construct($addr) {

      $this->req = new PingSite($addr, 1);

      $this->cfg = $this->conf();

   }

   /**
    * Configuration
    *
    * Set parameters
    *
    **/

   private function conf() {

      return parse_ini_file('request.ini');

   }

   /**
    * Accept these
    * http codes
    *
    **/

   private function accept() {

      $ok = array(

         0 => '200 OK',
         1 => '202 Activated',
         2 => '302 Found'

      );

      return $ok;

   }

   /**
    * Pass if code is
    * acceptable, 
    * return code otherwise
    *
    **/

   private function extcode() {

      $ext = $this->req->codeinfo();

      if(in_array($ext, $this->accept())) {

         return;

      }

      else {

         return $ext;

      }

   }
   
   /**
    * Initialize the 
    * message object with
    * the given address.
    * This will give the 
    * correct alert message
    *
    **/
   
   private function alert() {
   
      $out = $this->req->geturli();
   
      return new Message($out);
   
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

      $hold = $this->cfg['hold'];

      $rqst = $this->req->gettime();

      $time = ($rqst > $hold);

      $code = ($this->extcode() != NULL);

      if($time && !$code) {

         return $this->alert()->load($time);

      }

      else if(!$time && $code) {

         return $this->alert()->resp($code);

      }

      else if($time && $code) {

         return $this->alert()->tcrq($time, $code)

      }

      else {

         return;

      }

   }

}

?>
