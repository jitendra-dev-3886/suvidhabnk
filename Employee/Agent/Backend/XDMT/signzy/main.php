<?php
session_start();
include("../../../../Db/config.php");
include("../../Userinfo/getuserinfo.php");
include("../../Functions/all_function.php");
include("../../Auth/userdata.php");



$srst = $con->query("select * from service_status where ID='1'")->fetch_assoc();
if($srst['XDMT'] != "ON"){
    echo json_encode(array("rscode"=>  500 , "message"=>"This service is temporarily down."));
    exit;
}



// verify bene
if(isset($_POST['verify_bene'])){
$beneid = $_POST['beneid'];
$bene = $con->query("select * from cashfree_beneficiary where BENEID='$beneid'")->fetch_assoc();
extract($bene);
 $data = json_encode([
                 "task"=>"bankTransfer",
                 "essentials" =>[
                 "beneficiaryName"=> $NAME,
                 "beneficiaryAccount"=> $ACCOUNT,
                 "beneficiaryMobile"=> $MOBILE,
                 "beneficiaryIFSC"=>$IFSC
                 ],
                ]);
$user_bal = $user['MAIN_BAL']-3;
if($user_bal >= 0){
    $auth = getsignzyAuthLive();
    $token = $auth['id'];
    $patronId = $auth['userId'];
    $url = "https://signzy.tech/api/v2/patrons/$patronId/bankaccountverifications";
            $curl = curl_init();
            curl_setopt_array($curl, array(
              CURLOPT_URL => $url,
              CURLOPT_RETURNTRANSFER => true,
              CURLOPT_ENCODING => "",
              CURLOPT_MAXREDIRS => 10,
              CURLOPT_TIMEOUT => 30,
              CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
              CURLOPT_CUSTOMREQUEST => "POST",
              CURLOPT_POSTFIELDS => $data,
              CURLOPT_HTTPHEADER => array(
                "authorization: $token",
                "content-type: application/json"
              ),
            ));
            
            $response = curl_exec($curl);
            $err = curl_error($curl);
            curl_close($curl);
            // echo $response;
            $rspns = json_decode($response , true);
            $benename = $rspns['result']['bankTransfer']['beneName'];
            $bankrrn = $rspns['result']['bankTransfer']['bankRRN'];
            $active = $rspns['result']['active'];
            
            
            
            if($benename != ""){
                $benename = $benename;
            }
            else{
                $benename = $NAME;
            }
            $con->query("update cashfree_beneficiary set VERIFY_RESPONSE='$response' , NAME='$benename'  where BENEID='$beneid'");
            
            if($bankrrn!="" && $active!=""){
                echo json_encode(["message"=>"Success", "response_code"=>1, "status"=>true, "receivableData"=>$rspns]);
            }
            else{
                echo json_encode(["message"=>"Failed", "response_code"=>2, "status"=>false, "receivableData"=>$rspns]);
            }
        if($rspns['id'] != ""){
              $user = $con->query("select * from user where ID='$usid'")->fetch_assoc();
                   $update_bal = $user['MAIN_BAL'] - 3;
                   $con->query("update user set MAIN_BAL='$update_bal' where ID='$usid' ");
              insert_allreport($usid  ,$rspns['id'] , "DMT Account Verify" , $user['MAIN_BAL']  , $update_bal ,3 , "Debit" , "DMT Account verification charge", "MAIN");
              
                 $refid = $rspns['id'];
               $usermb = substr($user['MOBILE'] , 7 , 10);
                 $mbmsg = urlencode("INR 3.00 has been Debited from your Paydeer.in A/C No *******$usermb  towards DMT Account verification Txn. $refid. Main Wallet Avl BAL is INR $update_bal. Team PayDeer");
                  $smsrs2 = json_decode(sendSMS($user['MOBILE'] , $mbmsg , 1307164568497787783) , true);



            }
        }
    else{
        echo json_encode(["message"=>"You have not sufficient balance.. Please add balance.", "response_code"=>2, "status"=>false, "receivableData"=>null]);
    }
}
