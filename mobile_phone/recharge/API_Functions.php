<?php
// Created By Arif Billah
class API_Functions {
    
public static function send_sms_otp($mobile,$message,$tempid) {
    $secret_key = "e0b04669-e4f2-4d36-ae5c-a3adf5c61427";
    $message = urlencode($message);
    $url = "http://sms.bulksmsind.in/v2/sendSMS?username=aropay&message=$message&sendername=AROCSP&smstype=TRANS&numbers=$mobile&apikey=$secret_key&peid=1201160075655012053&templateid=$tempid";
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: text/xml'));
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
$result = curl_exec($ch);
return $result;
   
}


public function roffer_plan_simple($op,$circle){
$curl = curl_init();
curl_setopt_array($curl, array(
  CURLOPT_URL => "https://www.roffer.in/api/plans.php?token=Fi2eFSBBQR0j2cmR5JNsB7VmqD7BqCrwliRr1SsG&cricle=$circle&operator=$op",
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => '',
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 0,
  CURLOPT_FOLLOWLOCATION => true,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => 'GET',
  CURLOPT_HTTPHEADER => array(
    'Cookie: PHPSESSID=9g6vqb592l0qpnnk08n9lj6sk6'
  ),
));
$response = curl_exec($curl);
curl_close($curl);
return  $response;
    
}

public function roffer_plan_roffer($op,$mobile){
$curl = curl_init();
curl_setopt_array($curl, array(
  CURLOPT_URL => "https://www.roffer.in/api/roffer.php?token=Fi2eFSBBQR0j2cmR5JNsB7VmqD7BqCrwliRr1SsG&offer=roffer&mobile=$mobile&operator=$op",
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => '',
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 0,
  CURLOPT_FOLLOWLOCATION => true,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => 'GET',
  CURLOPT_HTTPHEADER => array(
    'Cookie: PHPSESSID=9g6vqb592l0qpnnk08n9lj6sk6'
  ),
));
$response = curl_exec($curl);
curl_close($curl);
return  $response;
    
}

public function dth_plan_roffer($op,$vcnumber){
  $curl = curl_init();
  curl_setopt_array($curl, array(
  CURLOPT_URL => "https://www.roffer.in/api/DthRoffer.php?token=Fi2eFSBBQR0j2cmR5JNsB7VmqD7BqCrwliRr1SsG&offer=roffer&mobile=$vcnumber&operator=$op",
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => '',
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 0,
  CURLOPT_FOLLOWLOCATION => true,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => 'GET',
  CURLOPT_HTTPHEADER => array(
    'Cookie: PHPSESSID=9g6vqb592l0qpnnk08n9lj6sk6'
  ),
));
$response = curl_exec($curl);
curl_close($curl);
return  $response;
    
}

public function dth_plan($op,$vcnumber){
    
  $curl = curl_init();
  curl_setopt_array($curl, array(
  CURLOPT_URL => "https://www.roffer.in/api/dthplans.php?token=Fi2eFSBBQR0j2cmR5JNsB7VmqD7BqCrwliRr1SsG&operator=$op",
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => '',
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 0,
  CURLOPT_FOLLOWLOCATION => true,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => 'GET',
  CURLOPT_HTTPHEADER => array(
    'Cookie: PHPSESSID=9g6vqb592l0qpnnk08n9lj6sk6'
  ),
));
$response = curl_exec($curl);
curl_close($curl);
return  $response;
    
}



}

?>