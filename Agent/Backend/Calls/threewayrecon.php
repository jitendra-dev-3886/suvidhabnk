<?php
session_start();
include("../../../Db/config.php");
include("../Userinfo/getuserinfo.php");
include("../Functions/all_function.php");
// include("../../Auth/userdata.php");
// require("function.php");
error_reporting(E_ALL);
ini_set("display_errors" , 1);
$time = date("Y-m-d g:i:s A");


echo"<pre>";
//3:48:56 PM

$txns = $con->query("select * from aeps_transactions where API='FINGPAY' and (THREEWAY_HIT='NO' or THREEWAY_RS='') LIMIT 5 ");

if($txns->num_rows != 0){
    while($txndata = $txns->fetch_assoc()){
        // print_r($txndata);
        $starr = explode("," , $txndata['STATUS']);
        if($txndata['TIMESTAMP'] < date("g:i:s A")){
            // echo "work<br>";
            $end = strtotime($txndata['TIMESTAMP']);
            $time = new DateTime($txndata['TIMESTAMP']);
            $timediff = $time->diff(new DateTime());
            $min = $timediff->format('%i');
            if($min > 30){
            $response = $txndata['RESPONSE'];
            $refrence = $txndata['REFFRENCE_ID'];
            $trans = $txndata['TRANS_TYPE'];
            $usid = $txndata['USER_ID'];
            // echo $refrence."\n";
            
                   
                $rtData = $con->query("select * from user where ID='".$usid."'")->fetch_assoc();
                $merchnt =$rtData['MOBILE'];
                
                $rslt = json_decode($response , true); 
                $status = $rslt['status'];
                $message = $rslt['message'];
                $stcode = $rslt['statusCode'];
                $fptxnid = $rslt['data']['fpTransactionId'];
                $bnkRRN = $rslt['data']['bankRRN'];
                $txnrscode = $rslt['data']['responseCode'];
                $txnst = $rslt['data']['transactionStatus'];
              
              $jsonDt = '[{"serviceType":"'.$trans.'","merchantTransactionId":"'.$refrence.'",
                            "fingpayTransactionId":"'.$fptxnid.'",
                            "transactionRrn":"'.$bnkRRN.'",
                            "responseCode":"'.$txnrscode.'",
                            "transactionDate":"'.date("d-m-Y").'"
                            }]';
                            
                echo $jsonDt."<br>";
            echo hitrecon($refrence , 969 , "SVDH".$merchnt , $jsonDt,$dc="");
            
            // $con->query("update aeps_transactions set THREEWAY_HIT='".str_replace("'" , "\'" , $response)."'  where REFFRENCE_ID='$refrence' ");
            
        // print_r($txndata);
        }
      }
    }
}
else{
    echo "no txn";
}



function hitrecon($ref , $mcid , $mcloginid , $json,$dc=""){
     global $con , $usid;
        $post = json_decode($json , true); // Request String
        $method = "POST"; // Method

        $simpleString = "Suvidhaad322d8298cdc16350fdc6d7cb0d9835e67354b87c93a427b602b44f069e0d875f";
        $hashgen = base64_encode(hash("sha256", $json.$simpleString, TRUE));
        $header = ['txnDate:'.date('Y/m/d H:i:s'),
            'hash:'.$hashgen,
            'superMerchantLoginId:Suvidhaad',
            'superMerchantid:969',
            'Content-Type: text/plain'];
        


        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => "https://fpanalytics.tapits.in/fpcollectservice/api/threeway/aggregators",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_SSL_VERIFYPEER => true,
            CURLOPT_SSL_VERIFYHOST => 2,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => $method,
            CURLOPT_POSTFIELDS => $json,
            CURLOPT_HTTPHEADER => $header
        ));
        $result = curl_exec($curl);
        $array = json_decode($result, true);
        
        // echo $hashgen."\n\n\n <br><br><br>";
        // echo $result."<br>";
        // print_r($header);
        // echo "<br>";
        // print_r($array);
        // exit;
        // echo $array['data'][0]['responseCode'];
        if($array['apiStatus'] == "true"){
            $con->query("update aeps_transactions set THREEWAY_HIT='YES', THREEWAY_RS='$result' where  REFFRENCE_ID='$ref'");
        }
        // echo "INSERT INTO `API_HITLOG`(`USER_ID`, `SEVICE`, `TRANSACTION_ID`, `TOKEN`, `REQUEST_LOG`, `RESPONSE_LOG`) VALUES ('$usid','AepsFingpayRecon','$ref','$token','$json','".str_replace("'" ,"\'" ,$result)."')";
     $con->query("INSERT INTO `API_HITLOG`(`USER_ID`, `SEVICE`, `TRANSACTION_ID`, `TOKEN`, `REQUEST_LOG`, `RESPONSE_LOG`) VALUES ('$usid','AepsFingpayRecon','$ref','".json_encode($header , true)."','$json','".str_replace("'" ,"\'" ,$result)."')");
        return $result;
}
            
            




