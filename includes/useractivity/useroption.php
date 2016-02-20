<?php

include('useraccount.php');

/* CLASS: UserOption */

class UserOption {

   /* user's registered sites */

   private $site = array();

   /* user and account status */

   var $user;
   var $stat;
   
   /* input validation */

   var $validator;

   /**
    * Construct
    *
    * Initialize database.
    * Set user and validators
    **/

   public function __construct($args) {

      $conn = new UserAccount();

      $this->user = $args;

      $this->validator = new Validator();

   }
   
   /**
    * Retrieve the number
    * of registered sites
    * or addresses for 
    * this user
    *
    **/
    
   public function sitecount() {
    
      return count($this->site);
    
   }
   
   /**
    * Print this site
    * if no others exist
    *
    **/
    
   public function echonlysite() {
    
      return $this->site[0]; 
   
   }
   
   /**
    * Display the list
    * of user sites or
    * addresses
    *
    **/
    
   public function displaysite() {
   
      $this->site = $this->site_select();
   
   }
   
   /**
    * Retrieve the state
    * of the user account
    *
    **/
    
   public function state() {
   
      return $this->stat;
   
   }
   
   /**
    * SELECT all sites
    * or addresses 
    * registered to this
    * user
    *
    **/
    
    private function site_select() {
    
        $sql = "SELECT site FROM
        
        registered_members WHERE
        
        username = '$this->user'";
        
        $r = mysql_query($sql);
        
        $row = mysql_fetch_assoc($r);
        
        $sites = explode(",", $row['site']);
        
        return $sites;
        
   }
        
   /**
    * SELECT the user's
    * current state of 
    * account
    *
    **/
    
    public function status() {
    
       $sql = "SELECT active FROM
       
       registered_members WHERE
       
       username = '$this->user'";
       
       $r = mysql_query($sql);
       
       $row = mysql_fetch_assoc($r);
       
       return (int) $row['active'];
       
   }
       
   /**
    * Deactivate this
    * user
    *
    **/
    
   public function deactivate_user() {
   
      $sql = "UPDATE 
      
      registered_members
      
      SET active = 0 
      
      WHERE username = '$this->user'";
      
      mysql_query($sql);
      
      return;
      
   }
      
   /**
    * Activate this 
    * user
    *
    **/
    
   public function activate_user() {
   
      $sql = "UPDATE
      
      registered_members
      
      SET active = 1
      
      WHERE username = '$this->user'";
      
      mysql_user($sql);
      
      $this->stat = $this->state();  
   
   }
   
   /**
    * Activate/Deactivate
    * this user
    *
    **/
    
   public function updstate() {
    
      $tg = ($this->status() == 0) ? 1 : 0;
      
      $sql = "UPDATE registered_members
      
      SET active = $tg WHERE 
      
      username = '$this->user'";
      
      mysql_query($sql);
      
      return;    
    
   }
   
   /**
    * PAGE SPECIFIC:
    * combine the site
    * and/or address list 
    * as a check box
    *
    **/
    
   public function checkbox() {

      if (count($this->site) == 1) {

         echo $this->echonlysite();

      }

      else {
    
      foreach($this->site as $s) {
      
         echo '<input type="checkbox" 

         name="delete_list[]" 

         value="'.$s.'"> '.$s.'<br>';

              }
         
         }
      
    } 
    
   /**
    * Remove the given
    * site or address
    * from the user's
    * account
    *
    **/
    
    public function removesite($list) {
    
       $diff = array_diff($this->site, $list);
       
       $namestr = implode(",", $diff);
       
       $sql = "UPDATE registered_members
       
       SET site = '$namestr' WHERE
       
       username = '$this->user'";
       
       mysql_query($sql);
       
       return;  
    
    }
    
    /**
     * Add the given
     * site or address
     * to the user's
     * account
     *
     **/
     
   public function addsite($ipt) {
   
      if ($this->validator->usersite($ipt)) {  # PLEASE CHANGE THIS FUNCTION NAME IN VALIDATOR
      
         array_push($this->site, $ipt);
         
         $namestr = implode(",", $this->site);
         
         $namestr = $this->validator->clean($namestr);
         
         $sql = "UPDATE registered_members
         
         SET site = '$namestr' WHERE
         
         username = '$this->user'";
         
         mysql_query($sql);
         
         return 0;
      
      }
      
      else {
      
         return 1;
      
      }   
   
   } 

}

?>
