<?php
function uploadImage($imageString, $imageName){
    $InsertProfilePath = "";
    $data = base64_decode($imageString);
    // $extension = explode('/', getMIMETYPE($imageString))[1];
    $extension = "png";
    $imageName = $imageName.generateRandomString(5).".".$extension;
    $insertion = $InsertProfilePath.$imageName;
    file_put_contents("$insertion" ,$data);
    return $imageName;
}

function getMIMETYPE($base64string){
    $imgdata = base64_decode($base64string);
    $f = finfo_open();
    $mime_type = finfo_buffer($f, $imgdata, FILEINFO_MIME_TYPE);   
    return $mime_type;
}

function generateRandomString($length) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}