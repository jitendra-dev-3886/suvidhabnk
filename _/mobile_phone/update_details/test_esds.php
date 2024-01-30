<?php

$image_url = 'https://www.hrcmulti.in/images/Adani.png';

$filename = $test.'_'.time().'.png';

$result = file_get_contents($image_url);

file_put_contents('samaritan/'.$filename, $result);
