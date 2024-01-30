<?php
error_reporting(0);
// used to encrypt values
function encrypt_token($simple_string){
    $ciphering = "AES-128-CTR";
    $options   = 0;
    $encryption_iv = 'ThisIsSecrfdfdfetKeyForEncrytionByJisneYeBnaya!@#$%^&*()';
    $encryption_key = "WebSpidyxxwwe";
    $encryption = openssl_encrypt($simple_string, $ciphering, $encryption_key, $options, $encryption_iv);
    return base64_encode($encryption);
}

// used to decrypt values
function decrypt_token($encryption){
    $ciphering = "AES-128-CTR";
     $decryption_iv = 'ThisIsSecrfdfdfetKeyForEncrytionByJisneYeBnaya!@#$%^&*()';
     $decryption_key = "WebSpidyxxwwe";
    // Using openssl_decrypt() function to decrypt the data 
     $decryption = openssl_decrypt(base64_decode($encryption), $ciphering, $decryption_key, 0, $decryption_iv);
    return $decryption;
}

?>