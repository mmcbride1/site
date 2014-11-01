<?php

include('pingsite.php');

//include('queue.php');

class WorkQ {

 public function work() {

      define('QUEUE', 21671);

      $q = msg_get_queue(QUEUE);

      $msg_type = NULL;

      $msg = NULL;

      $max_msg_size = 512;

      while(msg_receive($q, 1, $msg_type, $max_msg_size, $msg)) {

         // * * //

  //       echo "Message pulled from queue - id:{$msg->id}, name:{$msg->name} \n";

         // * task here * //

         $msg->set();

         $msg_type = NULL;

         $msg = NULL;

      }

   }

}

