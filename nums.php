<?php

function rng($num) {

if ($num >= 0 && $num <= 3) {

   echo "GOOD";

}

else if ($num > 3 && $num <= 7){

   echo "AVERAGE";

}

else if ($num > 7 && $num <= 15) {

   echo "BAD";

}

else {

   echo "CRITICAL";

   }

}

$num = 2.22333;

rng($num);

?>
