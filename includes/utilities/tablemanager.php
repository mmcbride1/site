<?php

include('/var/www/html/wbboxsvc/includes/registration/useraccount.php');

class TableManager {

   /* database connection */

   var $db;

   /**
     * Construct
     *
     * Make the wbbox 
     * database connection
     * 
     **/

   function __construct() {

      $this->db = new UserAccount();

   }

   /**
     * Get the datetime 
     * right now
     * 
     **/

   function now() {

      return $this->db->tmpdate();

   }

   /**
     * Delete any record
     * in the tmp 
     * registration db
     * that is equal to 
     * or older than 3 
     * days
     * 
     **/

   function diff() {

      $now = $this->now();

      $sql = "DELETE FROM members 

      WHERE DATEDIFF(date, '$now') >= 3";

      mysql_query($sql);

      return;

   }

}

?>
