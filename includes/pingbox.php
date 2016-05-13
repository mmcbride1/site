<?php include('includes/takeoff.php'); ?>

<link rel="stylesheet" href="http://css-spinners.com/css/spinner/spinner.css" type="text/css">
<link rel="stylesheet" type="text/css" href="http://localhost/wbboxsvc/spin.css" media="screen" />

<script src="script/spinner.js"></script>

      <div id="pingboxtest-login">
      
         <h4 style='color:yellow;'>Perform Test</h4>
         
         <h5>Enter web/ip address</h5>
         
         <form name="pingbox" method="post">
         
            URL: <input name="url" type="text" id="url">
            
            <br></br>
            
            <input type="submit" name="Submit" value="ping!" onclick="wait('spinner');"> 

         </form>

      </div>

<div id="takeoff">

   <h1><?php takeoff(); ?></h1>

</div>
