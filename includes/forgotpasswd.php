<h2>FORGOT PASSWORD</h2>

<div id="forgotpasswordbox" style="font-family: 'Play', sans-serif;border-radius:7px;">

<table width="300" border="0" align="center" cellpadding="0" cellspacing="1" bgcolor="#CCCCCC" style="outline: 1px solid #9900CC;">
<tr>
<form name="forgotpassword" method="post">
<td>
<table width="100%" border="0" cellpadding="3" cellspacing="1" bgcolor="#000" style="color:white;">
<tr>
<td colspan="3" bgcolor="yellow" style="outline: 1px solid black"><strong><font color="#F3C">Enter Email Address</font></strong></td>
</tr>
<tr>
<td width="78">email address</td>
<td width="6">:</td>
<td width="294"><input name="fpemail" type="text" id="fpemail"></td>
</tr>
<tr>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td><input type="submit" name="Submit" value="send password update link"></td>
</tr>
</table>
</td>
</form>
</tr>
</table>

</div><!-- end #box -->

<?php 

$email = $_POST['fpemail'];

?>

<div id="forgotpasswdrtn">

<?php include('includes/registration/useraccount.php'); 

$connect = new UserAccount();

$fgtpasswd = $connect->fgtpasswdconf($email);

?>

</div>
