<script src="popup2.js"></script> 

<div id="box">

<table width="300" border="0" align="center" cellpadding="0" cellspacing="1" bgcolor="#CCCCCC">
<tr>
<form name="form1" method="post">
<td>
<table width="100%" border="0" cellpadding="3" cellspacing="1" bgcolor="#FFFFFF">
<tr>
<td colspan="3"><strong>enter web address</strong></td>
</tr>
<tr>
<td width="78">URL</td>
<td width="6">:</td>
<td width="294"><input name="url" type="text" id="url"></td>
</tr>
<tr>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td><input type="submit" name="Submit" value="test"></td>
</tr>
</table>
</td>
</form>
</tr>
</table>

</div><!-- end #box -->

<?php

  include('pingsite.php');

  /*
   * Just include a simple
   * alert box with the 
   * site params 
   */

  function takeoff() {

     session_start();

     $url = $_POST['url'];

     $web = new PingSite($url);

     $_SESSION['web'] = $web;
       
  }

?>

<h1><?php takeoff(); ?></h1>
