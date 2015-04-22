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

   function __construct() {

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

   function config() {

      $send = parse_ini_file("message.ini");

      return $send;

   }

   /**
    * Send an email 
    * take the destination 
    * address and the 
    * message as an argument
    *
    **/

   function sendmail($to, $msg) {

      $headers = array(

         'From'    => $this->conf['from'],
         'To'      => $to,
         'Subject' => $this->conf['sub1'] 

      );

      $smtp = Mail::factory('smtp', array(

         'host'     => $this->conf['host'],
         'port'     => $this->conf['port'],
         'auth'     => true,
         'username' => $this->conf['user'],
         'password' => $this->conf['pass']

      ));

      $mail = $smtp->send($to, $headers, $msg);

   }

}

?>
