<?php

include_once('validator.php');
include_once('includes/utilities/messenger.php');

class UserAccount {

   /* connection */

   var $success;

   /* login information */

   var $sql;

   /**
    * Construct
    *
    * Connect to the
    * wontblinkbox 
    * database
    *
    **/

   function __construct() {

      $this->sql = $this->config();

      $this->success = $this->connect();

   }

   /**
    * Collect the 
    * connection login
    * information
    *
    **/

   private function config() {

      $f = "db.ini";

      return parse_ini_file($f);

   }

   /**
    * Did the DB
    * connection
    * succeed ?
    *
    **/

   function access() {

      return $this->success;

   }

   /**
    * Record the date
    * and time upon
    * temporary 
    * registration 
    *
    **/

   function tmpdate() {

      return date("Y-m-d H:i:s");

   }

   /**
    * Set the database
    * parameters for 
    * access
    *
    **/

   function params() {

      $con = array(

      'host' => $this->sql['HOST'],
      'user' => $this->sql['USER'],
      'pass' => $this->sql['PASS'],
      'data' => $this->sql['DATA'],
      'tabl' => $this->sql['TABL']

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

      $c = mysql_connect("$h", "$u", "$p");

      if($c) {

         mysql_select_db("$d");

      }

     return $c;

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
    * to tmp database as 
    * new user account
    * awaiting confirmation
    *
    **/

   function insertuserinfo($con) {

      $un = $con['name'];
      $pw = $con['password'];
      $st = $con['site'];
      $em = $con['mail'];

      $key = $this->conf_key();

      $dt = $this->tmpdate();

      $safe = new Validator();

      $pw = $safe->escape($pw);

      $usr = "INSERT INTO members

      (username, password, site, email, confirmation, date)
 
      VALUES ('$un', '$pw', '$st', '$em', '$key', '$dt')";

      mysql_query($usr);

      $this->confirmation($em, $key);

   }

   /**
    * Register the user 
    * information into
    * the registration
    * database as new 
    * user account
    *
    **/

   function register($cfm) {

      $data = mysql_fetch_array($cfm);

      $user = $data['username'];
      $pass = $data['password'];
      $mail = $data['email'];
      $site = $data['site'];

      $sql = "INSERT INTO registered_members 

      (username, password, site, email) 

      VALUES ('$user', '$pass', '$site', '$mail')";

      return mysql_query($sql);

   }

   /**
    * Delete user info
    * from tmp if 
    * confirmation checks
    * out properly
    *
    **/

   function purgetmp($val) {

      $sql = "DELETE FROM members

      WHERE confirmation = '$val'";

      mysql_query($sql);

   }

   /**
    * For forgot password
    * vslidate email address
    * and send link to user
    *
    **/

   function fgtpasswdconf($email) {

      $safe = new Validator();

      $email = $safe->escape($email);

      $sql = "SELECT * FROM 

      registered_members WHERE 

      email = '$email'";

      $rslt = mysql_query($sql);

      if (mysql_num_rows($rslt) == 1) {

         $mail = new Messenger();

         $msg = $mail->conf['msg2'];

         $mail->sendmail($email, $msg);

         return;

      }

      else {

         if (isset($email)) {

         echo '<h1>PROBLEM WITH ENTRY</h1>';

         }

      }

   }

   /**
    *
    **/

   function changepasswd($ps1, $ps2) {

      $v = $_GET['fpemail'];

      $sql = "UPDATE registered_members

      SET password = '$ps2' WHERE

      email = '$v'";

      if ($ps1 == $ps2) {

         mysql_query($sql);

      }

      else {

       if (isset($ps1) && isset($ps2)) {

         echo '<h1>PASSWORDS DO NOT MATCH</h1>';


         }
    
      }

   }

   /**
    * Retrieve the value
    * from the confimation
    * email. If all checks 
    * out register the user
    * and delete the tmp
    * information
    *
    **/

   function confirmuserinfo() {

      $passkey = $_GET['passkey'];

      $sql = "SELECT * FROM members

      WHERE confirmation = '$passkey'";

      $rslt = mysql_query($sql);

      $count = mysql_num_rows($rslt);

      if($count == 1) {

         if($this->register($rslt)) {

            $this->purgetmp($passkey);

         }

         return 0;

      }

      else {

         return 1;

      }

   } 

}

?>
