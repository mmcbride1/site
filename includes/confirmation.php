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

      echo '<h2>ACCOUNT ACTIVATED</h2>';

      echo '<br></br>';

      echo "<h3>$activemsg1</h3>";

   }

   else {

      echo '<h2>PROBLEM WITH ACTIVATION</h2>';

      echo '<br></br>';

      echo "<h3>$activemsg2</h3>";

   }

}

?>

<div id="activeacct">

<?php activate() ?>

</div> <!-- end #activeacct -->
