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

   public function __construct() {

      $this->inputmanager = new Validator();

      $this->config = $this->configuration();

      $this->validation = $this->validate();            

   }

    /**
     * If needed, return 
     * post array
     **/

   public function userinfo() {

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

   public function badinput() {

      return $this->validation;

   }

    /**
     * Parse configuration
     * file for use by 
     * class methods
     * 
     **/

   private function configuration() {

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

   public function passwd() {

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

   public function username() {

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

   public function ruseript($inpt, $val) {

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

   public function usermail() {

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

   public function sites() {

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
     * Return a list of
     * all, if any of user
     * sites-to-be-monitored
     * that do not meet 
     * validation criteria
     * 
     **/

   public function invalidsite() {

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

   private function validate() {

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

   public function adduseraccount() {

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
