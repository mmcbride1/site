<?php include('variables/variables.php'); ?>

<div id="nav">

   <p><?php echo $navmessage ?></p>

   <ul>

      <?php if(!empty($_SESSION['username'])) { ?>

      <li><a href="includes/logout.php">Log Out</a></li>

      <?php } ?>

   </ul>

</div> <!-- end #nav -->
