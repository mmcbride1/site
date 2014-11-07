<?php

include('codes.php');

     function getheader() {

      $beat = "http://vgkjbnjnbgojtnbo4je";

      $ch = curl_init();

      curl_setopt_array($ch, array(

      CURLOPT_URL => $beat,
      CURLOPT_RETURNTRANSFER => true

      ));

      curl_exec($ch);

      $stat = curl_getinfo($ch);

      curl_close($ch);

      return $stat;

   }

      function geturli($var) {

      $u = $var['url'];

      $u = explode("/", $u);

      return $u[2];

   }


      function isurl($var) {

      $u = geturli($var);

      return @fopen($u, 'r');

   }


$var = getheader();
 

if(isurl($var)) {

echo "true";

}

else {

echo "false";

}

print_r($var);



//$ini = parse_ini_file("params.ini");

//print $ini['good'];


?>
