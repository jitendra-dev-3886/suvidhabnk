<?php

$array = json_decode($jsonString, true);

extract($array); // now you have a local $order variable
echo $order['custom']; // etc...

extract($order); // now you have local variables $id, $status, etc
echo $id;

?>