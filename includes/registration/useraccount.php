<?php

include_once('inputmanager.php');

class UserAccount {

   /* login information */

   const HOST = "localhost";
   const USER = "master";
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

      $safe = new InputManager();

      $pw = $safe->escape($pw);

      $usr = "INSERT INTO members

      (username, password, site, email)
 
      VALUES ('$un', '$pw', '$st', '$em')";

      mysql_query($usr);                  

   }           

}

?>
