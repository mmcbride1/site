<?php 

include('pingsite.php');
//include('someint.php');

class RequestQueue {

   function add($obj) {

      define('QUEUE', 21671);

      $q = msg_get_queue(QUEUE);

      //msg_send($q, 1, $m);

      //$obj = new SomeInt;

      $obj->name = 'foo';

      $obj->id = uniqid();

      if (msg_send($q, 1, $obj)) {

         echo "added to queue  \n";
      
         print_r(msg_stat_queue($q));

      }

      else {

         echo "could not add message to queue \n";

      }

   }

   /**

   function work() {

      define('QUEUE', 21671);

      $q = msg_get_queue(QUEUE);

      $msg_type = NULL;

      $msg = NULL;

      $max_msg_size = 512;

      while(msg_receive($q, 1, $msg_type, $max_msg_size, $msg)) {

         // * * //

//         echo "Message pulled from queue - id:{$msg->id}, name:{$msg->name} \n";

         // * task here * //

         $msg->set();

         $msg->window();

         $msg_type = NULL;
         
         $msg = NULL;

      }

   }
*/
}

//$var = new RequestQueue();

//$var->add('www.google.com');

//$var->add(new PingSite('www.google.com'));

//$var->work();
