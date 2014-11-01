<link rel="stylesheet" type="text/css" href="window.css" media="screen" />

<?php

//  include('queue.php');
  include('work.php');

  // include main class //

//  include('pingsite.php');

  /*
   * Just include a simple
   * alert box with the 
   * site params 
   */

  function stats() {

     session_start();
       
     $sts = $_SESSION['web'];

//     $r = new WorkQ();

//     $r->work();

     #$sts->window();

     return $sts->display();

  }

?>

</head>

   <body>

      <!--<div id="wrapper">-->

<?php include('includes/window_header.php') ?>

<div id="stats">

<h1><?php echo stats(); ?></h1>

</div>

   </body>

</html>
