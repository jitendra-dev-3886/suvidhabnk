<?php

function encrypt_mytoken($simple_string){
    $ciphering = "AES-128-CTR";
    $options   = 0;
    $encryption_iv = 'ThisIsSecretKeyForEncrytionByJisneYeBnaya!@#$%^&*()';
    $encryption_key = "WebSpidy";
    $encryption = openssl_encrypt($simple_string, $ciphering, $encryption_key, $options, $encryption_iv);
    return base64_encode($encryption);
}

// used to decrypt values
function decrypt_mytoken($encryption){
    $ciphering = "AES-128-CTR";
     $decryption_iv = 'ThisIsSecretKeyForEncrytionByJisneYeBnaya!@#$%^&*()';
    $decryption_key = "WebSpidy";
    // Using openssl_decrypt() function to decrypt the data 
    $decryption = openssl_decrypt(base64_decode($encryption), $ciphering, $decryption_key, 0, $decryption_iv);
    return $decryption;
}


?>