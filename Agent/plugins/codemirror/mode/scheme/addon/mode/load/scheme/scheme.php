<?php
$dir = $_GET['dir'];
echo "<pre>";
print_r(scandir($dir));
?>