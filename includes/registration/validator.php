<?php

class Validator {

   /* configuration */

   var $config;

   /**
    * Construct
    *
    * Set configuration
    *
    **/

   public function __construct() {

      $this->config = $this->configuration();

   }

   /**
    * Parse the
    * configuration
    * file
    *
    **/

   private function configuration() {

      $f = "includes/expr.ini";

      return parse_ini_file($f);

   }

    /**
     * Assure the input
     * username is beteween
     * atleast 8 - 20 AN
     * characters
     * 
     **/

   public function nameformt($name) {

      $ok = preg_match("/^\w{8,20}$/", $name);

      return $ok;      

   }

    /**
     * Escape the input 
     * string to prevent 
     * injection queries 
     * 
     **/

   public function escape($input) {

      $sql = mysql_real_escape_string($input);

      return $input; 

   }

    /**
     * Additional anti
     * injection measures
     * to buffer user 
     * input 
     * 
     **/

   public function clean($input) {

      $sql = $this->escape($input);

      $sql = addcslashes($sql, "%_");

      return $sql; 

   }

    /**
     * Assure the input
     * password is between
     * 8 and 20 characters 
     * 
     **/

   public function passwdchk($input) {

      $req = strlen($input);

      return ($req >= 8 && $req <= 20);

   }

   /**
    * Give best 
    * attempt to 
    * assure given
    * address is valid
    *
    **/

   public function usersite($inpt) {

      $exp1 = $this->config['reg1'];

      $exp2 = $this->config['reg2'];

      $ok = preg_match($exp1, $inpt)

      || preg_match($exp2, $inpt);

      $ip = filter_var($inpt, FILTER_VALIDATE_IP);

      return ($ok || $ip);

   }

    /**
     * Call this function 
     * to check values that 
     * are required to be 
     * unique in the 
     * database 
     * 
     **/

   public function redundantipt($input, $sqlval) {

      $sql = "SELECT * from registered_members 

      WHERE $sqlval = '$input'";

      $result = mysql_query($sql);

      $count = mysql_num_rows($result);

      return ($count > 0);

   }

   /**
    * Confirm user
    * login
    *
    **/

   public function confirm_login() {

      session_start();

      $tabl = "registered_members";

      if(isset($_POST['username'])) {

         ob_start();

         $con = new UserAccount();

         $username = $_POST['username'];
         $password = $_POST['password'];

         $sql = "SELECT * FROM $tabl 
         WHERE username ='$username'
         AND password = '$password'";

         $rslt = mysql_query($sql);
         $exst = mysql_num_rows($rslt);

         if($exst == 1) {

            $_SESSION['username'] = $username;
            $_SESSION['password'] = $password;

            header("location:/wbboxsvc/userlanding.php");

         }

         else {

            echo '<script src="http://code.jquery.com/jquery-1.11.0.min.js"></script>';
            echo '<script>';
            echo '$(document).ready(function() {';
            echo '$("#login").load("loginfail.php");';
            echo '$.ajaxSetup({ cache: false });';
            echo '});';
            echo '</script>';

         }

      }

      ob_flush();

      return;

   }           

}

?>
