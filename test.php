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

      function indicator($v) {

      $v = (int) $v

      $good = range(0, 3);
      $avrg = range(4, 7);
      $over = range(8, 15);

      if (in_array($v, $good)) {

         //$s = print below message, good image;

      }

      else if (in_array($v, $avrg)) {

         //$s = print above message, average image

      }

      else if (in_array($v, $over)){

         //$s = print above message, bad image plus tips

      }

      else {

      //$s = print critical message, critical image plus tips

      }

      return $s;

   }



//$var = getheader();
 

//if(isurl($var)) {

//echo "true";

//}

//else {

//echo "false";

//}

//print_r($var);



//$ini = parse_ini_file("params.ini");

//print $ini['good'];


?>
