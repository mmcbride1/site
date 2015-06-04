<?php

require_once('Mail.php');

class Messenger {

   /* store mail config here */

   var $conf;

   /**
    * Construct 
    *
    * Set the values that
    * will be utilized by
    * the sendmail function 
    * 
    **/

   public function __construct() {

      $this->conf = $this->config();

   }

   /**
    * Load the mail 
    * configuration params
    * present in the 
    * message configuration
    * file 
    *
    **/

   public function config() {

      $send = parse_ini_file("message.ini");

      return $send;

   }

   /**
    * Set the message
    * headers, take the
    * subject as an 
    * argument
    *
    **/

   private function reqhead($to, $subj) {

      $headers = array(

         'From'    => $this->conf['from'],
         'To'      => $to,
         'Subject' => $subj

      );

      return $headers;

   }

   /**
    * Create the mail 
    * object and set 
    * the necessary 
    * parameters
    *
    **/

   private function fctry() {

      $smtp = Mail::factory('smtp', array(

         'host'     => $this->conf['host'],
         'port'     => $this->conf['port'],
         'auth'     => true,
         'username' => $this->conf['user'],
         'password' => $this->conf['pass']

      ));

      return $smtp;

   }

   /**
    * Send an email 
    * take the destination 
    * address, the message 
    * and the subject 
    * as an argument
    *
    **/

   public function sendmail($to, $msg, $subin=NULL) {

      $wwwsb = $this->conf['sub1'];

      $subj = ($subin == NULL) ? $wwwsb : $subin;

      $headers = $this->reqhead($to, $subj);

      $smtp = $this->fctry();

      $mail = $smtp->send($to, $headers, $msg);

   }

}

?>
