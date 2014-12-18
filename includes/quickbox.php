<link rel="stylesheet" href="http://css-spinners.com/css/spinner/spinner.css" type="text/css">
<link rel="stylesheet" type="text/css" href="spin.css" media="screen" />

<script type="text/javascript">

    function wait(target) {

       document.getElementById('takeoff').style.visibility = 'hidden';

       document.getElementById(target).style.display = 'block';

       return false;

    }

</script>

<div id="box">

<table width="300" border="0" align="center" cellpadding="0" cellspacing="1" bgcolor="#CCCCCC">
<tr>
<form name="form1" method="post">
<td>
<table width="100%" border="0" cellpadding="3" cellspacing="1" bgcolor="#FFFFFF">
<tr>
<td colspan="3"><strong>enter web/ip address</strong></td>
</tr>
<tr>
<td width="78">URL</td>
<td width="6">:</td>
<td width="294"><input name="url" type="text" id="url"></td>
</tr>
<tr>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td><input type="submit" name="Submit" value="ping" onclick="wait('spinner');"></td>
</tr>
</table>
</td>
</form>
</tr>
</table>

</div><!-- end #box -->

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

     /* start session */

     session_start();

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

           echo "<div id='msg'>";
           echo "<h2>request not valid</h2>";
           echo "<p>please try again!</p>";
           echo "</div>";

           $web = NULL;

           session_destroy();

        }

        $_SESSION['web'] = $web;

    }
   
  }

?>

<div id="spinner" class="spinner" style="display:none;">

</div>

<div id="takeoff">

<h1><?php takeoff(); ?></h1>

</div>
