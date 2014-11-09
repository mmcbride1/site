<link rel="stylesheet" type="text/css" href="window.css" media="screen" />

<?php

  /* include main class */

  include('pingsite.php');

  /* start the session */

  session_start();

  /* get the req object */

  $sts = $_SESSION['web'];

  /**
   * Just include a simple
   * alert box with the 
   * site params 
   **/

  function stats() {

     return $GLOBALS['sts']->display();

  }

  /**
   * Display the 
   * rendering time
   * status message
   **/

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

<?php

/* get load time */

$t = $GLOBALS['sts']->gettime();

/* display tips if needed */

if($t > 7) {

   include('includes/tips.php');

} 

?>

<?php include('includes/explain.php') ?>

<?php include('includes/footer.php') ?>

<?php session_destroy(); ?>

   </body>

</html>
