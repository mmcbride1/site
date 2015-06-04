<?php

include('useraccount.php');

class RequestChain {

   /* number of records to read */

   private $limit = 100;

   /**
    * Construct
    *
    * Connect to the
    * underlying 
    * userdata
    *
    **/

   public function __construct() {

      $conn = new UserAccount();

   }

   /**
    * Explode the url
    * list as readable
    * array of values 
    *
    **/

   private function url($lst) {

      return explode(",", $lst);

   }

   /**
    * Create the request
    * type object from
    * address input
    *
    **/

   private function type($addr) {

      $case = filter_var($addr, FILTER_VALIDATE_IP);

      if($case) {

         return new ServerRequest($addr);

      }

      else {

         return new WebsiteRequest($addr);

      }

   }

   /**
    * Utility function:
    * add max/min
    * to array for 
    * access
    *
    **/

   private function range() {

      $data = array();

      for($i = 1; $i<= 2; $i++) {

         array_push($data, $this->id($i));

      }

      return $data;

   }

   /**
    * Utility function:
    * build the max/min
    * query
    *
    **/

   private function id($i) {

      $tb = "registered_members";

      $id = ($i == 1) ? "MIN(id)" : "MAX(id)";

      $rst = mysql_query("SELECT $id FROM $tb");

      return mysql_fetch_row($rst)[0];

   }

   /**
    * Select rows between
    * the given max/min
    * values as records to
    * parse. This should keep
    * no more than $limit #
    * of records in memory at 
    * one time 
    *
    **/

   private function userdata($min, $lim) {

      $sql = "SELECT * FROM 

      registered_members WHERE

      id >= $min AND id < $lim";

      $rst = mysql_query($sql);

      return $rst;

   }

   /**
    * Send the alert 
    * message if 
    * required
    *
    **/

   private function sysalert($to, $msg) {

      $SUBJ = "WontBlinkBox Monitoring Notification";

      $alrt = new Messenger();

      if(!empty($msg)) {

         return $alrt->sendmail($to, $msg, $SUBJ);

      }

      else {

         return;

      }

   }

   /**
    * Underloop:
    * for each row given,
    * request the addresses
    * under the site column.
    * If any issue is
    * uncovered, send alert
    *
    **/

   private function dataloop($set) {

      $data = array();

      while($row = mysql_fetch_assoc($set)) {

         $data[] = $row;

         foreach($this->url($row['site']) as $site) {

            $out = $this->type(trim($site))->monitor();

            $this->sysalert($row['email'], $out);   

         }

      }

      return;

   }

   /**
    * Mainloop:
    * for each set of
    * records determined
    * by the limit value,
    * execute the underloop
    *
    **/

   private function baseloop() {

      $r = $this->range();

      for($i = $r[0]; $i < $r[1]; $i = $i + $limit) {

         $ptn = $i + $limit;

         $set = $this->userdata($i, $ptn);

         $this->dataloop($set);   

      }

      return;

   }

}

?>
