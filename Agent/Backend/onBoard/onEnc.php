<?php

$key = "tHeApAcHe6410111";

function encrypt($data) {
    global $key;
    return base64_encode(openssl_encrypt($data, "aes-128-ecb", $key, OPENSSL_RAW_DATA));
}

function decrypt($data) {
    global $key;
    return openssl_decrypt(base64_decode($data), "aes-128-ecb", $key, OPENSSL_RAW_DATA);
}


?>