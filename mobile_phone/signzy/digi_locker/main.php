<?php

include("../../my_curls/myCurl.php");

  $url = "https://preproduction.signzy.tech/api/v2/patrons/615a9b8bf0e8db4b7319302c/converters";

   $postData = json_encode(array(
       "task"=> "pdftojpg",
            "essentials"=> [
            "urls"=> ["https:\/\/files.signzy.tech\/api\/files\/291330149\/download\/452a9d5ceaca4f26bfc010efbd1c301563dd7c1bf6684a83a62d0804ce973350.pdf"],
            "ttl"=> "2 hrs"
            ]
    ));
    
  $header = array(
    "Authorization: LGBIUuYto0R4onIRPHIt14fKnxA8Cc6EMRLKsJl9yGBjCzqUtuYdqwTga5JBob4o",
    "accept: */*",
    "accept-language: en-US,en;q=0.8",
    "content-type: application/json"
  );    
    
  echo postCurl($postData, $url, $header);

?>