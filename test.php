<?php

include('codes.php');
/*
     function getheader() {

      $beat = "http://somebullshitsite.com";

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

$var = getheader();

print_r($var);

*/

//$ini = parse_ini_file("params.ini");

//print $ini['good'];

$n = '888';

$c = new StatusCodes();

$a = $c->getcodes();

if(array_key_exists($n, $a)) {

print("$n:$a[$n]");

}

else {

print "code not found";

}

?>
