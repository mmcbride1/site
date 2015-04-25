<?php

session_start();

include_once('includes/registration/useraccount.php');

$connection = new UserAccount();

$active = $connection->confirmuserinfo();

if($active == 0) {

echo '<h2>ACCOUNT ACTIVATED</h2>';

}

else {

echo '<h2>PROBLEM WITH ACTIVATION</h2>';

}

?>
