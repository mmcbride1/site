<!-- logout.php -->

<?php

session_start();

session_unset();

session_destroy();

header("location:http://localhost/wbboxsvc/index.php");

?>
