<?php

include('useraccount.php');

class Registration {

   /* class assignments */

   var $config;
   var $validation;
   var $inputmanager;

    /**
     * Construct 
     *
     * Set the object that
     * handles Anti-Injection
     * and proper user input.
     * Use the current 
     * configuration and 
     * validate user input 
     **/

   function __construct() {

      $this->inputmanager = new InputManager();

      $this->config = $this->configuration();

      $this->validation = $this->validate();            

   }

    /**
     * If needed, return 
     * post array
     **/

   function userinfo() {

      return $_POST;

   }

    /**
     * Error messages will
     * be assigned to this
     * value if user input
     * does not meet set 
     * criteria 
     * 
     **/

   function badinput() {

      return $this->validation;

   }

    /**
     * Parse configuration
     * file for use by 
     * class methods
     * 
     **/

   function configuration() {

      $f = "includes/expr.ini";

      return parse_ini_file($f);

   }

    /**
     * Use the input 
     * manager to assure
     * password is of 
     * proper format
     * 
     **/

   function passwd() {

      $pass = $_POST['password'];

      $p = $this->inputmanager;

      return $p->passwdchk($pass);

   }

    /**
     * Use the input
     * manager to assure 
     * username is of 
     * proper format
     * 
     **/

   function username() {

      $correctformat = $this->inputmanager;

      $name = $_POST['name'];

      return $correctformat->nameformt($name);

   }

    /**
     * Post input 
     * confirmation to 
     * assure username 
     * does not already 
     * exist in the 
     * database 
     * 
     **/

   function ruseript($inpt, $val) {

      $origformat = $this->inputmanager;

      $name = $_POST[$inpt];

      return $origformat->redundantipt($name, $val);

   }

    /**
     * Assure user email
     * is valid and is of
     * proper format
     * 
     **/

   function usermail() {

      $mail = $_POST['mail'];

      $dmn = substr($mail, strpos($mail, '@') + 1);

      $fmt = filter_var($mail, FILTER_VALIDATE_EMAIL);

      return checkdnsrr($dmn) && $fmt;

   }      

    /**
     * Check if sites 
     * to-be-monitored
     * list exceeds set
     * limit of monitorable
     * sites
     * 
     **/

   function sites() {

      $addr = $_POST['site'];

      $list = explode(",", $addr);

      $list = array_map('trim', $list);
      
      if(count($list) > 5) {

         return array($this->config['max']);

      }

      else {

         return $list;

      }

   }

    /**
     * Assure site
     * to-be-monitored
     * given by user is
     * valid and is of
     * proper format
     * 
     **/

   function usersite($inpt) {

      $exp1 = $this->config['reg1'];

      $exp2 = $this->config['reg2'];

      $ok = preg_match($exp1, $inpt) 

      || preg_match($exp2, $inpt);

      $ip = filter_var($inpt, FILTER_VALIDATE_IP);

      return ($ok || $ip);

   }  

    /**
     * Return a list of
     * all, if any of user
     * sites-to-be-monitored
     * that do not meet 
     * validation criteria
     * 
     **/

   function invalidsite() {

      $base = "";

      foreach($this->sites() as $s) {

         if(!$this->usersite($s)) {

            $base .= $s.", \n";

         }

      }

      return rtrim($base, ", \n");

   }

    /**
     * Execute all check
     * methods to validate 
     * all user input
     * 
     **/

   function validate() {

      $url = $this->invalidsite();

      $usr = $this->config['user'];
      $paz = $this->config['pass'];
      $web = $this->config['site'];
      $eml = $this->config['mail'];
      $mln = $this->config['sitx'];

      $pas = $_POST['password'];
      $ras = $_POST['rassword'];

      if(!$this->username()) {

         return $usr;        

      }

      else if(!$this->passwd()) {

         return $paz;

      }

      else if($this->passwd() && ($pas != $ras)) {

         return "passwords do not match";

      }

      else if(!empty($url)) {

         return $web."\n".$url.". ".$mln;

      }

      else if(!$this->usermail()) {

         return $eml;

      }

      else {

         return "";

      }

   }

    /**
     * Execute all post
     * input validation
     * methods to assure 
     * user account will 
     * be unique 
     * 
     **/

   function adduseraccount() {

      $usr = new UserAccount();

      if(!$usr->access()) {

         return "connection failure!";

      }

      if($this->ruseript('name', 'username')) {

         return "username already exists";

      }

      else if($this->ruseript('mail', 'email')) {

         return "email already exists";

      }

      else {

         $usr->insertuserinfo($_POST);

         return;

      }

   }    

}

?>
