<div id="login">

<form name="login-form" method="post">

username: <input name="username" type="text" id="username">

<br></br>

password: <input name="password" type="password" id="password">

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
