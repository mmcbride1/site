<?php 

include('someint.php');

class RequestQueue {

   function add() {

      define('QUEUE', 21671);

      $q = msg_get_queue(QUEUE);

      //msg_send($q, 1, $m);

      $obj = new SomeInt;

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

   function work() {

//      define('QUEUE', 21671);

      $q = msg_get_queue(QUEUE);

      $msg_type = NULL;

      $msg = NULL;

      $max_msg_size = 512;

      while(msg_receive($q, 1, $msg_type, $max_msg_size, $msg)) {

         // * * //

         echo "Message pulled from queue - id:{$msg->id}, name:{$msg->name} \n";

         // * task here * //

         $t = $msg->get();

         file_put_contents("test.txt", "$t\n", FILE_APPEND);

         $msg_type = NULL;
         
         $msg = NULL;

      }

   }

}

$obj = new RequestQueue();

$obj->add();

$obj->add();

$obj->work();
