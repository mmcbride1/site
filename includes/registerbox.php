<script src="http://code.jquery.com/jquery-1.11.0.min.js"></script>

<script>

function invalidmsg(msg) {

   var user = document.getElementById('user');
   
   user.style.display = 'block';
   
   document.write(msg + "<br >");
   
   document.write("<br >");

};

</script>

<div id="registerbox" style="font-family: 'Play', sans-serif">

<table width="300" border="0" align="center" cellpadding="0" cellspacing="1" bgcolor="#CCCCCC" style="outline: 1px solid #9900CC">
<tr>
<form name="register" method="post">
<td>
<table width="100%" border="0" cellpadding="3" cellspacing="1" bgcolor="#FFFFFF">
<tr>
<td colspan="3" bgcolor="#FFFF99" style="outline: 1px solid black"><strong><font color="#9900CC">Register!</font></strong></td>
</tr>
<tr>
<td width="78">username</td>
<td width="6">:</td>
<td width="294"><input name="name" type="text" id="name"></td>
</tr>
<tr>
<td width="78">password</td>
<td width="6">:</td>
<td width="294"><input name="password" type="password" id="password"></td>
</tr>
<tr>
<td width="78">repeat password</td>
<td width="6">:</td>
<td width="294"><input name="rassword" type="password" id="rassword"></td>
</tr>
<tr>
<td width="78">site(s)</td>
<td width="6">:</td>
<td width="294"><input name="site" type="text" id="site"></td>
</tr>
<tr>
<td width="78">email</td>
<td width="6">:</td>
<td width="294"><input name="mail" type="text" id="mail"></td>
</tr>
<tr>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td><input type="submit" name="Submit" value="sign-up"></td>
</tr>
</table>
</td>
</form>
</tr>
</table>

</div><!-- end #box -->

<?php

include('registration/registration.php');

session_start();

/*
 * Accept user input
 * and produce invalid
 * input warnings if 
 * necessary. Otherwise
 * add the user account
 *
 */

function doadduser() {

   if(isset($_POST['name'])) {
   
      $regstr = new Registration();
      
      $usrinpt = $regstr->badinput();
      
      if(empty($usrinpt)) {
      
         $acct = $regstr->adduseraccount();
         
         if(empty($acct)) {
         
            header('location:register.php');
         
         }
         
         else {
         
            echo "<script>invalidmsg(\"$acct\")</script>"; 
         
         }   
      
      }
      
      else {
      
         $usrinpt = str_replace(array("\r", "\n"), '', $usrinpt);
         
         echo "<script>invalidmsg(\"$usrinpt\")</script>";   
      
      }
   
   }
   
   else {
   
      return;
   
   }

}
 
?>

<div id="user"><h3><?php doadduser(); ?></h3></div>

<?php session_destroy(); ?>
