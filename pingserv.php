<?php

class PingServ {

   /* struct and configuration */
   
   var $ip;
   var $cf;
   var $rq;
   var $cd;
   
   /**
    * Constructor
    *
    * Initialize the 
    * incoming request
    * address, retreive 
    * stats and render
    * response window 
    **/
    
    function __construct($arg) {
    
       /* get the request ip */
       
       $this->ip = $arg;
       
       /* configure */
       
       $this->cf = $this->conf();
       
       /* collect response */
       
       $this->cd = $this->ping();
       
       /* render request */
       
       $this->pingwindow();
      
    }
    
    /**
     * Set the
     * parameters 
     * needed to carry 
     * out the 
     * required tasks
     **/
     
     function conf() {
     
        $ini = parse_ini_file('params.ini');
        
        return $ini;
     
     }
     
     /**
      * Send request 
      * to server and
      * store response 
      * output along with
      * execution code
      **/
      
      function ping() {
      
         $out = array();
         
         $cmd = "ping -c 1 $this->ip";
         
         exec($cmd, $out, $rtn);
         
         $this->rq = $out;
         
         return $rtn;
      
      }
      
      /**
       * Depending on
       * execution code
       * from request,
       * set the proper
       * html 
       **/
       
       function code($code) {
       
          /* indicators */
          
          $r = $this->cf['png1'];
          $u = $this->cf['png2'];
          $g = $this->cf['img1'];
          $b = $this->cf['img2'];
          
          /* check and display */
          
          if($code == 0) {
          
             echo '<h3>'.$r.$g.'</h3>';
          
          }
          
          else {
          
             echo '<h3>'.$u.$b.'</h3>';
          
          }
          
          return;
       
       }
       
       /**
        * Display the 
        * request response
        * to the screen
        **/
        
        function display() {
        
           foreach($this->rq as $r) {
           
              echo "<h3>$r\n</h3>";
           
           }
           
           $this->code($this->cd);
           
           return;
        
        }
        
        /**
         * Execute above 
         * through and AJAX 
         * function in order
         * to assure fastest
         * possible results
         **/
         
         function pingwindow() {
         
             /* create window */

             echo '<script src="http://code.jquery.com/jquery-1.11.0.min.js"></script>';
             echo '<script src="window.js"></script>';
             echo "<script>loadStyle('window.css');</script>";
             echo '<script>';
             echo '$(document).ready(function() {';
             echo '$("#takeoff").load("ping.php");';
             echo '$.ajaxSetup({ cache: false });';
             echo '});';
             echo '</script>';

         } 
    
      }

?>
