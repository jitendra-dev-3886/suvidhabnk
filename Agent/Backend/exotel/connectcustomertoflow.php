<?php

$api_key    = "6aa913167a3058fbd0aa5af9762010273eb340c6fee8948a"; 
$api_token  = "0c8d6d4e8c86f55936664274fbebcdaef8745aa62f8a8776"; 
$exotel_sid = "paydeer2"; 

#Link to developer portal  for connect to flow  https://developer.exotel.com/api/#call-customer
$post_data = array(
    'From'     => "07428274282",
    'To'       => "8240193509",
    'Url'      => "http://my.exotel.in/exoml/start/<flow_id>",
    'CallType' => "trans" 
);
#Replace <subdomain> with the region of your account
#<subdomain> of Singapore cluster is @api.exotel.com
#<subdomain> of Mumbai cluster is @api.in.exotel.com
$url = "https://" . $api_key . ":" . $api_token . "@<subdomain>/v1/Accounts/" . $exotel_sid . "/Calls/connect"; 
$ch  = curl_init();
curl_setopt($ch, CURLOPT_VERBOSE, 1);
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_FAILONERROR, 0);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($post_data)); 
$http_result = curl_exec($ch); 
curl_close($ch); 
print "Response = ".print_r($http_result);
?>
