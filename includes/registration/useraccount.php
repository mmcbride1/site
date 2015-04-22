<?php

include_once('inputmanager.php');
include_once('includes/utilities/messenger.php');

class UserAccount {

   /* login information */

   const HOST = "localhost";
   const USER = "mattymain";
   const PASS = "administrator";
   const DATA = "wbbusers";
   const TABL = "members";

   /**
    * Construct
    *
    * Connect to the
    * wontblinkbox 
    * database
    *
    **/

   function __construct() {

      $this->connect();

   }

   /**
    * Set the database
    * parameters for 
    * access
    *
    **/

   function params() {

      $con = array(

      'host' => self::HOST,
      'user' => self::USER,
      'pass' => self::PASS,
      'data' => self::DATA,
      'tabl' => self::TABL

      );

      return $con;      

   }

   /**
    * Database connection
    * via given database
    * parameters
    *
    **/

   function connect() {

      $db = $this->params();

      $h = $db['host'];
      $u = $db['user'];
      $p = $db['pass'];
      $d = $db['data'];

      mysql_connect("$h", "$u", "$p");

      mysql_select_db("$d")

      or die ("DATABASE UNAVAILABLE");      

   }

   /**
    * Generate random  
    * key value to use
    * as confirmation id
    *
    **/

   function conf_key() {

      $key = md5(uniqid(rand()));

      return $key;

   }

   /**
    * Send Confirmation
    * message to user if
    * all registration 
    * requirements succeed
    *
    **/

   function confirmation($to, $key) {

      $mail = new Messenger();

      $msg = $mail->conf['msg1'];

      $mail->sendmail($to, "$msg=$key");

      return;

   }

   /**
    * Carry out validation
    * checks on given input.
    * If acceptable, add user
    * to database as new user 
    * account
    *
    **/

   function insertuserinfo($con) {

      $un = $con['name'];
      $pw = $con['password'];
      $st = $con['site'];
      $em = $con['mail'];

      $key = $this->conf_key();

      $safe = new InputManager();

      $pw = $safe->escape($pw);

      $usr = "INSERT INTO members

      (username, password, site, email, confirmation)
 
      VALUES ('$un', '$pw', '$st', '$em', '$key')";

      mysql_query($usr);

      $this->confirmation($em, $key);

   }          

}

?>
