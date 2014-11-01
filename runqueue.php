<?php

include('queue.php');
include('work.php');

$obj = new PingSite('www.spryinc.com');

$r = new RequestQueue();
$r->add($obj);

$w = new WorkQ();
$w->work();

?>
