<div id="login">

<form name="login-form" method="post">

username: <input name="username" type="text" id="username">

<br></br>

password: <input name="password" type="password" id="password">

<br></br>

<a href="http://localhost/wbboxsvc/forgotpassword/forgotpasswdlanding.php" style="position:absolute;font-size:10px">forgot password?</a>

<br></br>

<input type="submit" name="Submit" value="Login">

</form>
 
</div>

<div id="login-failed">

<?php

include('validator.php');

include('useraccount.php');

$validate = new Validator();

$validate->confirm_login();

?>

</div>
