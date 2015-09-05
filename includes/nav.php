<?php include('variables/variables.php'); ?>

<div id="nav">

   <p><?php echo $navmessage ?></p>

   <ul>

      <?php if(empty($_SESSION['username'])) { ?>

      <li><a href="loginlanding.php">Log In</a></li>

      <?php } else { ?>

      <li><a href="includes/logout.php">Log Out</a></li>

      <?php } ?>

      <li><a href="index.php">Home</a></li> 

   </ul>

</div> <!-- end #nav -->
