<?php 

   include('pingsite.php');
   include('pingserv.php');
   
   /*
   * Parse the conf
   * file that lists
   * the regular 
   * expression patterns
   * used in this file
   */

  function expr() {

     return parse_ini_file('expr.ini');

  }
  
  /*
   * Check if entry
   * argument is a
   * valid ip address
   */

  function isip($ip) {

     $v = filter_var($ip, FILTER_VALIDATE_IP);

     return $v;

  }
  
  /*
   * Check if entry
   * argument is a 
   * valid web address
   */

  function isweb($url) {

     $ini = expr();

     $p1 = $ini['reg1'];
     $p2 = $ini['reg2'];

     if (preg_match($p1, $url) || preg_match($p2, $url)) {

        return true;

     }

     else {

        return false;

     }

  }

  /*
   * Just include a simple
   * window with the 
   * response params and 
   * additional info.
   * If entry arg is an
   * ip, display the ping
   * window, else display 
   * the site window
   */

  function takeoff() {

     /* grab posted address */

     if(isset($_POST['url'])) {

        $url = $_POST['url'];

        if(isip($url)) {

           $web = new PingServ($url);

        }

        else if(isweb($url)) {

           $web = new PingSite($url);

        }

        else {

           include('includes/invalid.php');

           $web = NULL;

           session_destroy();

        }

        $_SESSION['web'] = $web;

    }

  }
   
?>
