<?php include('variables/variables.php'); ?>

<div id="nav">

   <p><?php echo $navmessage ?></p>

   <ul>

      <?php if(!empty($_SESSION['username'])) { ?>

      <li><a href="includes/logout.php">Log Out</a></li>

      <li><a href="userlanding.php">Manage Account</a></li>

      <?php } ?>

      <li><a href="index.php">Ping</a></li>

   </ul>

</div> <!-- end #nav -->
