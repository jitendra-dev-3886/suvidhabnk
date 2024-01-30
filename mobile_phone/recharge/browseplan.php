<?php
//Create By Arif
include("../includes/config.php");
include("../includes/fetch_data.php");

$api = new Browse_Plan();
$circle = "Delhi NCR";
$op = $_POST['operator'];
$response = $api->Get_Browse_Plan($circle,$op);
$result = json_decode($response,true);
$FULLTT = $result['info']['FULLTT'];
$TOPUP = $result['info']['TOPUP'];
$Dataplan = $result['info']['3G/4G'];
$RateCutter = $result['info']['RATE CUTTER'];
$Romaing = $result['info']['Romaing'];

$myVal = array(
                    "FULLTT"=>$FULLTT,
                    "TOPUP"=>$TOPUP,
                    "DATAPLAN"=>$Dataplan,
                    "RATECUTTER"=>$RateCutter,
                    "ROAMING"=>$Romaing
                );
echo json_encode($myVal);

class Browse_Plan
{


public static function create_token()
   {
    global $paysprint;
    $rand = mt_rand(9999 , 100000);
    $time  = time();
    $data = array(
     "timestamp"=>$time, 
      "partnerId"=> $paysprint['PARTNER_ID'], 
      "reqid"=> "$rand"
    
    );
    $header = json_encode(['typ' => 'JWT', 'alg' => 'HS256']);
    $payload = json_encode($data);
    $base64UrlHeader = str_replace(['+', '/', '='], ['-', '_', ''], base64_encode($header));
    $base64UrlPayload = str_replace(['+', '/', '='], ['-', '_', ''], base64_encode($payload));
    $signature = hash_hmac('sha256', $base64UrlHeader . "." . $base64UrlPayload, $paysprint['JWT_KEY'] , true);
    $base64UrlSignature = str_replace(['+', '/', '='], ['-', '_', ''], base64_encode($signature));
    $jwt = $base64UrlHeader . "." . $base64UrlPayload . "." . $base64UrlSignature;
    return $jwt;
   }
                
public function Get_Browse_Plan($circle,$op)

   {
   global $paysprint;
   global $con;
   $base_url = "https://api.paysprint.in";
   
   $data = json_encode(array(
                    "circle"=>$circle,
                   "op"=> $op
                 ));

   $curl = curl_init();
   $tkn = Browse_Plan::create_token();
   curl_setopt_array($curl, [
   CURLOPT_URL => "$base_url/api/v1/service/recharge/hlrapi/browseplan",
   CURLOPT_RETURNTRANSFER => true,
   CURLOPT_ENCODING => "",
   CURLOPT_MAXREDIRS => 10,
   CURLOPT_TIMEOUT => 30,
   CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
   CURLOPT_POSTFIELDS => $data,
   CURLOPT_CUSTOMREQUEST => "POST",
   CURLOPT_HTTPHEADER => [
   "Accept: application/json",
   "Content-Type: application/json",
   "Authorisedkey:".$paysprint['AUTHORISED_KEY'],
   "Token: ".$tkn
   ],
  ]);
   return $response = curl_exec($curl);
  }
 
 
}

?>