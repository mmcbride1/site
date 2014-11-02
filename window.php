<link rel="stylesheet" type="text/css" href="window.css" media="screen" />

<?php

  // include main class //

  include('pingsite.php');

  session_start();

  $sts = $_SESSION['web'];

  /*
   * Just include a simple
   * alert box with the 
   * site params 
   */

  function stats() {

     return $GLOBALS['sts']->display();

  }

  function scale() { 

     return $GLOBALS['sts']->infotime();

  }

?>

</head>

   <body>

      <!--<div id="wrapper">-->

<?php include('includes/window_header.php') ?>

<div id="timemsg">

<?php echo scale(); ?>

</div>

<div id="stats">

<p>statistics:</p>

<?php echo stats(); ?>

</div>

<?php include('includes/explain.php') ?>

   </body>

</html>
