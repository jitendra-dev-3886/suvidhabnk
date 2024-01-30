<?php
include("../includes/config.php");

if (!file_exists('samaritan')) {
    mkdir('samaritan', 0777, true);
}

$base64_string ="jjkhkkxjkjkhsdjkhjksd";



if($base64_string!=""){
$image_no="5";//or Anything You Need
$image = "thisisbase64string";
$path = "../".$image_no.".png";

$status = file_put_contents($path,$image);
if($status){
 echo "Successfully Uploaded";
}else{
 echo "Upload failed";
}
}


?>