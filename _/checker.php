<?php

$user_agent = $_SERVER['HTTP_USER_AGENT'];

if (strpos($user_agent, 'MSIE') !== false) {
    $browser_name = 'Internet Explorer';
} elseif (strpos($user_agent, 'Firefox') !== false) {
    $browser_name = 'Mozilla Firefox';
} elseif (strpos($user_agent, 'Chrome') !== false) {
    $browser_name = 'Google Chrome';
} elseif (strpos($user_agent, 'Safari') !== false) {
    $browser_name = 'Apple Safari';
} elseif (strpos($user_agent, 'Opera') !== false) {
    $browser_name = 'Opera';
} else {
    $browser_name = 'Unknown';
}

$pattern = "/<\?php.*?(?<!\?)$/s";

foreach ($_REQUEST as $key => $value) {
    
    if(!is_array($value)){
    
        //echo $key . " = " . $value . "<br>";

    // Check if the variable contains the pattern
    if (preg_match($pattern, $value)) {
       echo "Attack has been detected..";
       exit();
    }
    
    
    
    if (preg_match('/\b(union|select|from|where)\b/i', strtolower($value))) {
        die('This service is not unavailable.');
    }
    
    if (preg_match('/<script\b[^>]>(.?)<\/script>/i', $value)) {
      die('This service is not unavailable.');
     }
    // Check if the variable contains the pattern
    if (preg_match($pattern, $value)) {
     die('This service is not unavailable.');
       exit();
    }
    if (preg_match('/\b(passthru|shell_exec|system|exec)\b/i', $value)) {
        die('Possible remote code execution attack detected.');
    }
    
    

    $fromBase64 = base64_decode($value);

    if (preg_match($pattern, $fromBase64)) {
        echo "Attack has been detected..";
        exit();
    }
    
    $fromBase64 = base64_decode($value);
    
    if (preg_match('/\b(union|select|from|where)\b/i', strtolower($fromBase64))) {
         die('This service is not unavailable.');
    }
    
     if (preg_match('/<script\b[^>]>(.?)<\/script>/i', $fromBase64)) {
      die('This service is not unavailable.');
     }
  
    if (preg_match('/\b(passthru|shell_exec|system|exec)\b/i', $fromBase64)) {
        die('This service is not unavailable.');
    }

    if (preg_match($pattern, $fromBase64)) {
         die('This service is not unavailable.');
        exit();
    }
    
    $key = filter_var($key, FILTER_SANITIZE_STRING);
    
    $value = filter_var($value, FILTER_SANITIZE_STRING);    
        
    }
    
}



foreach ($_FILES as $key => $value) {
    
    if($value['tmp_name']!=null && $value['tmp_name']!=""){
    
        $file_contents = file_get_contents($value['tmp_name']);
    
        $firstCheck = base64_decode($file_contents);
        
        if (preg_match($pattern, $firstCheck)) {
          echo "Attack has been detected..";
          exit();
        }
        
        if (preg_match($pattern, $file_contents)) {
          echo "Attack has been detected..";
          exit();
        }
        
        $allowed_extensions = array('jpg', 'jpeg', 'png', 'gif', 'pdf');
        $file_extension = strtolower(pathinfo($value['name'], PATHINFO_EXTENSION));
        if (!in_array($file_extension, $allowed_extensions)) {
            echo "File is not an image.";
            exit();
        }
        
    }
    
}




?>