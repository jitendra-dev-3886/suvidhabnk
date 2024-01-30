<?php

    include("../includes/config.php");
    include("../includes/imagepaths.php");

$data = "mbjhskjfhklsncklasnkdsnvjkcnsdkcmklasncksadkcn";
$data = base64_decode($data);


            $imageName = generateRandomString(12);
            $insertion = $InsertProfilePath.$imageName.".png";
            
            file_put_contents("$insertion" ,$data);




function generateRandomString($length) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}

?>