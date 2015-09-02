<?php

   session_start();

   include('useroption.php');

   $user = $_SESSION['username'];

   $option = new UserOption($user);

   $option->updstate();

?>
