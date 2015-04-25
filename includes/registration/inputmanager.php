<?php

class InputManager {

    /**
     * Assure the input
     * username is beteween
     * atleast 8 - 20 AN
     * characters
     * 
     **/

   function nameformt($name) {

      $ok = preg_match("/^\w{8,20}$/", $name);

      return $ok;      

   }

    /**
     * Escape the input 
     * string to prevent 
     * injection queries 
     * 
     **/

   function escape($input) {

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

   function clean($input) {

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

   function passwdchk($input) {

      $req = strlen($input);

      return ($req >= 8 && $req <= 20);

   }

    /**
     * Call this function 
     * to check values that 
     * are required to be 
     * unique in the 
     * database 
     * 
     **/

   function redundantipt($input, $sqlval) {

      $sql = "SELECT * from registered_members 

      WHERE $sqlval = '$input'";

      $result = mysql_query($sql);

      $count = mysql_num_rows($result);

      return ($count > 0);

   }           

}

?>
