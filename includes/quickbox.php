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

<link rel="stylesheet" href="http://css-spinners.com/css/spinner/spinner.css" type="text/css">
<link rel="stylesheet" type="text/css" href="spin.css" media="screen" />

<script src="script/spinner.js"></script>

<div id="box">

   <fieldset>

      <div id="pingboxtest">
      
         <h4 style='color:yellow;'>Perform Test</h4>
         
         <h5>Enter web/ip address</h5>
         
         <form name="pingbox" method="post">
         
            URL: <input name="url" type="text" id="url">
            
            <br></br>
            
            <input type="submit" name="Submit" value="ping!" onclick="wait('spinner');"> 

         </form>

      </div>
      
      <br></br>
      
      <div id="pingboxmonitor">
      
         <form action="http://localhost/wbboxsvc/register.php">
         
            <h4>Long Term Monitoring</h4>

            <input type="submit" value="sign up!"></td>
            
         </form>   
      
      </div>
      
      <?php include('includes/slideshow.php'); ?>

   </fieldset>

</div>

<div id="spinner" class="spinner-loader" style="display:none">

   <!-- #none -->

</div>

<div id="takeoff">

   <h1><?php takeoff(); ?></h1>

</div>
