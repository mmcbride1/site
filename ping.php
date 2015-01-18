<?php

include('pingserv.php');

/* start */

session_start();

/* get object */

$sts = $_SESSION['web'];

/* get request stats */

function pingstats() {

   return $GLOBALS['sts']->display();

}

?>

</head>

   <body>
   
<div id="pingstat">

<?php echo pingstats(); ?>

</div>

<?php session_destroy(); ?>

   </body>
   
</html>
