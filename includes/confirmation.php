<?php 

session_start();

include('variables/variables.php'); 
include('includes/registration/useraccount.php');

function activate() {

   global $activemsg1;
   global $activemsg2;

   $connection = new UserAccount();

   $active = $connection->confirmuserinfo();

   if($active == 0) {

      echo '<h3>ACCOUNT ACTIVATED</h3>';

      echo "<h4>$activemsg1</h4>";

   }

   else {

      echo '<h3>PROBLEM WITH ACTIVATION</h3>';

      echo "<h4>$activemsg2</h4>";

   }

}

?>

<div id="activeacct">

   <?php activate() ?>

   <form action="http://localhost/wbboxsvc/index.php">

      <input type="submit" value="Sign in at WontBlinkBox">

   </form>

</div> 
