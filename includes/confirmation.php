<?php 

session_start();

include('variables/variables.php'); 
include('includes/registration/useraccount.php');

function activate() {

   $connection = new UserAccount();

   $active = $connection->confirmuserinfo();

   if($active == 0) {

      echo '<h2>ACCOUNT ACTIVATED</h2>';

   }

   else {

      echo '<h2>PROBLEM WITH ACTIVATION</h2>';

   }

}

?>

<div id="activeacct">

<?php activate() ?>

<h2><?php echo $activemsg1 ?></h2>

</div> <!-- end #activeacct -->
