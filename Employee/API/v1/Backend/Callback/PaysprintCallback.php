<?php
// error_reporting(0);
include("../../../Db/config.php");
include("../Userinfo/getuserinfo.php");
include("../Functions/all_function.php");
// include("../../../../connection/config.php");
// include("../../include/fetch_data.php");
// include("../function/main_function.php");
// include("../cms/function.php"); // this is commented because it has some error


// // Takes raw data from the request
$json = file_get_contents('php://input');
$time = date("Y-m-d g:i:s A");
$Data = json_decode($json);


// insert the data into db 
$con->query("INSERT INTO `aeps_callback_rspns`(`RESPONSE`, `TIME`) VALUES ('$json','$time')");
// by default our response is Failed to API.
$status = 200;
$msg = "success";




// Update Recharge Transaction
if($Data->event == "RECHARGE_SUCCESS"){
      $param = $Data->param;
    $ref_id = $param->referenceid;
    $msg = $param->message;
    $operatorid = $param->operatorid;
    
    if($con->query("update recharge_transaction set RESPONSE='".str_replace("'" , "\'" , $json)."' , STATUS='Success,$msg' , OPERATOR_ID='$operatorid'  where REFERENCE_ID='$ref_id'")){
        // $dt = $con->query("select * from recharge_transaction where REFERENCE_ID='$ref_id'")->fetch_assoc();
        //  $user = $con->query("select * from user where ID='".$dt['USER_ID']."' ")->fetch_assoc();
        //     $old_bal = $user['MAIN_BAL'];
        //     $new_bal = $old_bal + $dt['AMOUNT'];
        //     $sql = "UPDATE user SET MAIN_BAL='$new_bal' WHERE ID='".$dt['USER_ID']."'";
        //     mysqli_query($con, $sql);
        //     insert_allreport($dt['USER_ID']  ,$ref_id , "Recharge Refund" , $old_bal  , $new_bal , $dt['AMOUNT'] , "Credit" , "Recharge Refund Transaction" , "MAIN");
        //      refund_rech_com($ref_id , $dt['USER_ID'] ,46);
        $status = 200;
        $msg = "Success";
    }
}


// Update Recharge Transaction
if($Data->event == "RECHARGE_FAILURE"){
    $param = $Data->param;
    $ref_id = $param->referenceid;
    $msg = $param->message;
    $operatorid = $param->operatorid;
    
    if($con->query("update recharge_transaction set RESPONSE='".str_replace("'" , "\'" , $json)."' , STATUS='Failed,$msg' where REFERENCE_ID='$ref_id'")){
        $dt = $con->query("select * from recharge_transaction where REFERENCE_ID='$ref_id'")->fetch_assoc();
         $user = $con->query("select * from user where ID='".$dt['USER_ID']."' ")->fetch_assoc();
            $old_bal = $user['MAIN_BAL'];
            $new_bal = $old_bal + $dt['AMOUNT'];
            $sql = "UPDATE user SET MAIN_BAL='$new_bal' WHERE ID='".$dt['USER_ID']."'";
            mysqli_query($con, $sql);
            insert_allreport($dt['USER_ID']  ,$ref_id , "Recharge Refund" , $old_bal  , $new_bal , $dt['AMOUNT'] , "Credit" , "Recharge Refund Transaction" , "MAIN");
             refund_rech_com($ref_id , $dt['USER_ID'] ,46);
        $status = 200;
        $msg = "Success";
    }
}


// Accept CMS Transaction 
if($Data->event == "CMS_BALANCE_INQUIRY"){
    $param = $Data->param;
    $ref_id = $param->referenceid;
    $amount = $param->amount;
    $dateTime = $param->datetime;
    if($con->query("update `cms_transaction`set AMOUNT='$amount' , DATETIME='$dateTime' ,RESPONSE='$json' where REFFRENCE_ID='$ref_id'")){
        $dt = $con->query("select * from cms_transaction where REFFRENCE_ID='$ref_id'")->fetch_assoc();
        // give_cms_com($ref_id , $dt['US_ID'] , $dt['US_TYPE']);
        $status = 200;
        $msg = "Success";
    }
}

// Update CMS Transaction 
if($Data->event == "CMS_BALANCE_COMMISSON"){
    $param = $Data->param;
    $ref_id = $param->referenceid;
    $biller = $param->billerName;
    $ackno = $param->ackno;
    $dateTime = $param->datetime;
    if($con->query("update `cms_transaction` set BILLER_NAME='$biller' , ACKNO='$ackno' , COM_RESPONSE='$json' where REFFRENCE_ID='$ref_id' ")){
        $status = 200;
        $msg = "Success";
    }
}

// Accept CMS Transaction 
if($Data->event == "FINO_CMS_BALANCE_DEBIT"){
    $param = $Data->param;
    $ref_id = $param->referenceid;
    $amount = $param->amount;
    $dateTime = $param->datetime;
    if($con->query("update `cms_transaction`set AMOUNT='$amount' , DATETIME='$dateTime' ,RESPONSE='$json' where REFFRENCE_ID='$ref_id'")){
        $dt = $con->query("select * from cms_transaction where REFFRENCE_ID='$ref_id'")->fetch_assoc();
        give_cms_com($ref_id , $dt['US_ID'] , $dt['US_TYPE']);
        $status = 200;
        $msg = "Success";
    }
}

// Accept CMS Transaction 
if($Data->event == "FINO_CMS_BALANCE_INQUIRY"){
    $param = $Data->param;
    $ref_id = $param->referenceid;
    $amount = $param->amount;
    $dateTime = $param->datetime;
    if($con->query("update `cms_transaction`set AMOUNT='$amount' , DATETIME='$dateTime' ,RESPONSE='$json' where REFFRENCE_ID='$ref_id'")){
        $dt = $con->query("select * from cms_transaction where REFFRENCE_ID='$ref_id'")->fetch_assoc();
        // give_cms_com($ref_id , $dt['US_ID'] , $dt['US_TYPE']);
        $status = 200;
        $msg = "Success";
    }
}

// Update CMS Transaction 
if($Data->event == "FINO_CMS_BALANCE_COMMISSON"){
    $param = $Data->param;
    $ref_id = $param->referenceid;
    $biller = $param->billerName;
    $ackno = $param->ackno;
    $dateTime = $param->datetime;
    if($con->query("update `cms_transaction` set BILLER_NAME='$biller' , ACKNO='$ackno' , COM_RESPONSE='$json' where REFFRENCE_ID='$ref_id' ")){
        $status = 200;
        $msg = "Success";
    }
}
// Response Success to API If everything worked fine.



//Micro Atm Transaction
if($Data->event == "MATMBE" || $Data->event == "MATM"){

    $param = $Data->param;
    $boolstatus = $param->status;
    $response = $param->txnstatus;
    $message = $param->message;
    $transAmount = $param->amount;
    $balAmount = $param->balance;
    $bankRrn = $param->bankrrn;
    $txnid = $param->txnrefrenceNo;
    $transType = $param->transactiontype;
    $bankName = $param->bankName;
    $type = $param->transactiontype;
    $cardNumber = $param->cardnumber;
    $cardType = $param->cardType;
    $terminalId = $param->ackno;
    $reference = $param->txnrefrenceNo;
    
    if($message=="Decline"){
        $message = "Failure";
    }

    if($response == 1){
        callToRecon($reference , "success");
    }
    else{
       callToRecon($reference , "failed");
    }
    

    if($type == "MATMCW"){
        $mytxntype = "ATMCW";
        $mytype = "WDLS";
    $con->query("UPDATE `micro_atm` SET `RESPONSE`='$response',`TRANSAMOUNT`='$transAmount',`BALAMOUNT`='$balAmount',`BANKRRN`='$bankRrn',`TRANSTYPE`='$mytxntype',`TYPE`='$mytype',`CARDNUMBER`='$cardNumber',`CARDTYPE`='$cardType',`TERMINALLD`='$terminalId',`BANKNAME`='$bankName' WHERE TXNID='$reference' ");
        
    }else if($type == "MATMBE"){
        $transAmount = "0";
        $mytxntype = "ATMBE";
        $mytype = "BAL";
        $con->query("UPDATE `micro_atm` SET `RESPONSE`='$response',`TRANSAMOUNT`='0',`BALAMOUNT`='$balAmount',`BANKRRN`='$bankRrn',`TRANSTYPE`='$mytxntype',`TYPE`='$mytype',`CARDNUMBER`='$cardNumber',`CARDTYPE`='$cardType',`TERMINALLD`='$terminalId',`BANKNAME`='$bankName' WHERE TXNID='$reference' ");
    }
    
    $microAtmReport = $con->query("SELECT * FROM `micro_atm` where TXNID='$reference' ")->fetch_assoc();  
    $user_id = $microAtmReport['USER_ID'];
    $user_status = $microAtmReport['USER_STATUS'];
    
    
    $user = $con->query("select * from user where ID='$user_id' ")->fetch_assoc();
    if($type == "MATMCW" && $response ==1 ){
            $old_bal = $user['AEPS_BAL'];
            $new_bal = $old_bal + $transAmount;
            $sql = "UPDATE user SET AEPS_BAL='$new_bal' WHERE ID='$user_id'";
            mysqli_query($con, $sql);
            insert_allreport($user_id  ,$reference , "ATM" , $old_bal  , $new_bal , $transAmount , "Atm Withdraw" , "Micro Atm Transaction");
            give_matm_com($reference , $user_id , $user_status);
    
    }else if($type == "MATMBE"){
         // fetch user to update balance
        insert_allreport($user_id  ,$reference , "ATM" , $user['AEPS_BAL']  , $user['AEPS_BAL'] , $transAmount , "Enquiry" , "Micro Atm Transaction");
    }
}


if($Data->event == "MERCHANT_STATUS_ONBOARD"){
    
    $param = $Data->param;
    $mobile = $param->mobile;
    $alternate_mobile = $param->alternate_mobile;
       
    $name = $param->name;
    $firmname = $param->firmname;
    $shopaddress = $param->shopaddress;
    $dob = $param->dob;
    $fathername = $param->fathername;
    $email = $param->email;
    $pincode = $param->pincode;
    $address = $param->address;
    $city = $param->city;
    $state = $param->state;
    $pannumber = $param->pannumber;
    $statusV = $param->status;
    $merchantcode = $param->merchantcode;
    $refno = $param->refno;
    $partnerid = $param->partnerid;
    $txnid = $param->txnid;
    $is_icici_kyc  =$param->is_icici_kyc;
    
    
    $mysql_qry = "select * FROM aeps_merchant WHERE MOBILE ='$mobile'";
    $result = mysqli_query($con ,$mysql_qry);
    if(mysqli_num_rows($result) > 0) {
        
        if($con->query("update `aeps_merchant` set STATUS='$statusV', REF_NO='$refno', TXN_ID='$txnid', PARTNERID='$partnerid', MERCHANTCODE='$merchantcode', IS_ICICI_KYC='$is_icici_kyc' where MOBILE='$mobile' ")){
            $status = 200;
            $msg = "Success";
        }
        
    }
    else{
        $time = date("Y-m-d g:i:s A");
        $user = $con->query("SELECT * FROM `user` WHERE MOBILE='$mobile' ORDER BY ID DESC LIMIT 1")->fetch_assoc(); 
        
        $owner = $user['MAIN_OWNER'];
        $owner_id = $user['OWNER_ID'];
        
        $query = "INSERT INTO `aeps_merchant`(`REF_NO`, `TXN_ID`, `STATUS`, `MOBILE`, `PARTNERID`, `MERCHANTCODE`, `IS_ICICI_KYC`, `TIMESTAMP`, `OWNER`, `OWNER_ID`)
            VALUES ('$refno','$txnid','$statusV','$mobile','$partnerid','$merchantcode','$is_icici_kyc','$time','$owner','$owner_id')";
        $run_query = mysqli_query($con , $query);
        if($run_query){
            $status = 200;
            $msg = "Success";
        }
        
    }
    
    
    // "bank":{"Bank1":"Active","Bank2":"Inactive","Bank3":"Inactive"}
    
}


// Commission Function defination start here

//CMS Commisssion function
function give_cms_com($ref_id , $user_id , $usertype){
      global $con;
    // echo "CMS com working \n";
$time = date("Y-m-d g:i:s A");
        $user_type_rows = $con->query("select * from user_type ")->num_rows;
        $trans = $con->query("select * from cms_transaction where REFFRENCE_ID='$ref_id'")->fetch_assoc();
        $user = $con->query("select * from user  where ID='$user_id' and USER_TYPE='$usertype'")->fetch_assoc();
        $owner = $user['OWNER_ID'];
        $crnt_bal = $user['MAIN_BAL'];
        $com_id = $user['CMS_COMM'];
        
        //check slab commission package
          $cm_pk_rw = $con->query("select * from slab_commission where COMM_PACK_ID='$com_id' order by ID asc");
        //   code for fetch perticuler slab for transaction amount
            while($dt = $cm_pk_rw->fetch_assoc()){
                    if($trans['AMOUNT'] >= $dt['MIN_AMOUNT'] && $trans['AMOUNT']  <= $dt['MAX_AMOUNT']){
                        $plan_id = $dt['ID'];
                        break;
                    }
                }
            // get full detail of the slab row
            $pack = $con->query("select * from slab_commission where ID='$plan_id'")->fetch_assoc();
            
           //check commision type 
        if($pack['TYPE'] == "PERCENTAGE"){
            $com = $pack['AMOUNT'];
            //check amount commission type
            if($pack['AMOUNT_TYPE'] == "DEBIT"){
                $com_amount = ($trans['AMOUNT']/100)*$com;
                $gst = ($com_amount/100)*$pack['GST'];
                $tds = ($com_amount/100)*$pack['TDS'];
                $givenCom = $com_amount-$gst-$tds;
                $update_bal = $crnt_bal-$givenCom;
            }
            else{
                $com_amount = ($trans['AMOUNT']/100)*$com;
                $gst = ($com_amount/100)*$pack['GST'];
                $tds = ($com_amount/100)*$pack['TDS'];
                $givenCom = $com_amount-$gst-$tds;
                $update_bal = $crnt_bal+$givenCom;
            }
        }
        else if($pack['TYPE'] == "FLAT"){
              $com = $pack['AMOUNT'];
              if($pack['AMOUNT_TYPE'] == "DEBIT"){
                $com_amount = $com;
                $gst = ($com_amount/100)*$pack['GST'];
                $tds = ($com_amount/100)*$pack['TDS'];
                $givenCom = $com_amount-$gst-$tds;
                $update_bal = $crnt_bal-$givenCom;
              }
              else{
                $com_amount = $com;
                $gst = ($com_amount/100)*$pack['GST'];
                $tds = ($com_amount/100)*$pack['TDS'];
                $givenCom = $com_amount-$gst-$tds;
                $update_bal = $crnt_bal+$givenCom;
              }
        }
        else{
            $com_amount = 0;
            $gst = 0;
            $tds = 0;
            $givenCom = 0;
            $update_bal = $crnt_bal;
        }
        $con->query("update user set MAIN_BAL='$update_bal'  where ID='$user_id' and USER_TYPE='$usertype'");
         $con->query("INSERT INTO `commission_report`(`SERVICE`, `REFFRENCE`, `USER_ID`, `USER_TYPE`, `AMOUNT`, `COMMISSION`,`GST` ,`TDS`, `TIME`) 
                    VALUES ('CMS','$ref_id','$user_id','$usertype','".$trans['AMOUNT']."','$givenCom','$gst' ,'$tds' ,'$time')");
        insert_allreport($user_id  ,$ref_id , "CMS Commission" ,$crnt_bal , $update_bal , $givenCom , "Credit" , "CMS Transaction Commission", $ip_address, $device);
        if(strtolower($owner) != "admin"){
            $i = 1;
            while($user_type_rows >= $i){
                $i++;
                     $user2 = $con->query("select * from user  where ID='$owner'")->fetch_assoc();
                    $owner2 = $user2['OWNER_ID'];
                    $us_type = $user2['USER_TYPE'];
                    $crnt_bal = $user2['MAIN_BAL'];
                    $com2_id = $user2['CMS_COMM'];
                    // give commision to owner 
                        //check slab commission package
                          $cm_pk_rw = $con->query("select * from slab_commission where COMM_PACK_ID='$com2_id' order by ID asc");
                        //   code for fetch perticuler slab for transaction amount
                            while($dt = $cm_pk_rw->fetch_assoc()){
                                    if($trans['AMOUNT'] >= $dt['MIN_AMOUNT'] && $trans['AMOUNT']  <= $dt['MAX_AMOUNT']){
                                        $plan_id = $dt['ID'];
                                        break;
                                    }
                                }
                            // get full detail of the slab row
                            $pack = $con->query("select * from slab_commission where ID='$plan_id'")->fetch_assoc();
                           //check commision type 
                        if($pack['TYPE'] == "PERCENTAGE"){
                            $com = $pack['AMOUNT'];
                            //check amount commission type
                            if($pack['AMOUNT_TYPE'] == "DEBIT"){
                                $com_amount = ($trans['AMOUNT']/100)*$com;
                                $gst = ($com_amount/100)*$pack['GST'];
                                $tds = ($com_amount/100)*$pack['TDS'];
                                $givenCom = $com_amount-$gst-$tds;
                                $update_bal = $crnt_bal-$givenCom;
                            }
                            else{
                                $com_amount = ($trans['AMOUNT']/100)*$com;
                                $gst = ($com_amount/100)*$pack['GST'];
                                $tds = ($com_amount/100)*$pack['TDS'];
                                $givenCom = $com_amount-$gst-$tds;
                                $update_bal = $crnt_bal+$givenCom;
                            }
                        }
                        else if($pack['TYPE'] == "FLAT"){
                              $com = $pack['AMOUNT'];
                              if($pack['AMOUNT_TYPE'] == "DEBIT"){
                                $com_amount = $com;
                                $gst = ($com_amount/100)*$pack['GST'];
                                $tds = ($com_amount/100)*$pack['TDS'];
                                $givenCom = $com_amount-$gst-$tds;
                                $update_bal = $crnt_bal-$givenCom;
                              }
                              else{
                                $com_amount = $com;
                                $gst = ($com_amount/100)*$pack['GST'];
                                $tds = ($com_amount/100)*$pack['TDS'];
                                $givenCom = $com_amount-$gst-$tds;
                                $update_bal = $crnt_bal+$givenCom;
                              }
                        }
                        else{
                            $com_amount = 0;
                            $gst = 0;
                            $tds = 0;
                            $givenCom = 0;
                            $update_bal = $crnt_bal;
                        }
                        $con->query("update user set MAIN_BAL='$update_bal'  where ID='$owner'");
                         $con->query("INSERT INTO `commission_report`(`SERVICE`, `REFFRENCE`, `USER_ID`, `USER_TYPE`, `AMOUNT`, `COMMISSION`,`GST` ,`TDS`, `TIME`) 
                                    VALUES ('CMS','$ref_id','$owner','$us_type','".$trans['AMOUNT']."','$givenCom','$gst' ,'$tds' ,'$time')");
                        insert_allreport($owner  ,$ref_id , "CMS Commission" ,$crnt_bal , $update_bal , $givenCom , "Credit" , "CMS Transaction Commission", $ip_address, $device);
                    $owner = $owner2;
                    if(strtolower($owner2) == "admin"){
                        break;
                    }
            }
        }
    
    // return true;
}

function callToRecon($ref , $status){
    global $con;
    $paysprint = $con->query("SELECT * FROM `paysprint_api` WHERE ID='1' and STATUS='ACTIVE'")->fetch_assoc();

        $arr = array(
            "reference"=>"$ref",
            "status"=>"$status",
            );
            
        $data_tkn = encryptForRecon($arr);
        $sendData = array(
            "body"=>$data_tkn,
            );
            
        $main_body = json_encode($sendData , true);
        $token = create_tokenForRecon();
        $curl = curl_init();
        curl_setopt_array($curl, [

          CURLOPT_URL => $paysprint['URL']."/api/v1/service/matm/threeway/update",
          CURLOPT_RETURNTRANSFER => true,
          CURLOPT_ENCODING => "",
          CURLOPT_MAXREDIRS => 10,
          CURLOPT_TIMEOUT => 30,
          CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
          CURLOPT_CUSTOMREQUEST => "POST",
          CURLOPT_POSTFIELDS => $main_body,
          CURLOPT_HTTPHEADER => [
             "Content-Type: application/json",
            "Authorisedkey:".$paysprint['AUTHORISED_KEY'],
            "Token:".$token
            ],
        ]);
    
        $response = curl_exec($curl);
        $err = curl_error($curl);
        curl_close($curl);
        $deta  = json_decode($response);
        $mymsg = $deta->message;
        $rs_code = $deta->response_code;
        if($rs_code != 1){
            callToRecon($ref , $status);
        }

        $con->query("INSERT INTO `atm_recon_response`(`DATA`, `RESPONSE`) VALUES ('".json_encode($arr)."','$response')");
        return $response;
}

function create_tokenForRecon(){
    global $con;
    $paysprint = $con->query("SELECT * FROM `paysprint_api` WHERE ID='1' and STATUS='ACTIVE'")->fetch_assoc();
    
    $rand = "PDR".date("ds").mt_rand(9999 , 100000);
    $time  = time();
    $data = array(
     "timestamp"=>$time, 
      "partnerId"=> $paysprint['PARTNER_ID'], 
      "reqid"=> "$rand"
    
    );
      // Create token header as a JSON string
    $header = json_encode(['typ' => 'JWT', 'alg' => 'HS256']);
    $payload = json_encode($data);
    $base64UrlHeader = str_replace(['+', '/', '='], ['-', '_', ''], base64_encode($header));
    $base64UrlPayload = str_replace(['+', '/', '='], ['-', '_', ''], base64_encode($payload));
    $signature = hash_hmac('sha256', $base64UrlHeader . "." . $base64UrlPayload, $paysprint['JWT_KEY'] , true);
    $base64UrlSignature = str_replace(['+', '/', '='], ['-', '_', ''], base64_encode($signature));
    $jwt = $base64UrlHeader . "." . $base64UrlPayload . "." . $base64UrlSignature;
    return $jwt;
    // echo $paysprint['JWT_KEY'] ;
}

function encryptForRecon($data){
global $con;
$paysprint = $con->query("SELECT * FROM `paysprint_api` WHERE ID='1' and STATUS='ACTIVE'")->fetch_assoc();

$key = $paysprint['KEY'];  
$iv=   $paysprint['KEY_IV'];            
$datapost = $data;
$cipher  =   openssl_encrypt(json_encode($datapost,true), 'AES-128-CBC', $key, $options=OPENSSL_RAW_DATA, $iv);
$body=       base64_encode($cipher);
return $body;
}


function give_matm_com($ref_id , $user_id , $usertype){
     global $con;
    // echo "M-ATM com working \n";
       $time = date("Y-m-d g:i:s A");
        $user_type_rows = $con->query("select * from user_type ")->num_rows;
        $trans = $con->query("select * from micro_atm where TXNID='$ref_id'")->fetch_assoc();
        
        //fetch user and its owner distributer and master distributer
        $user = $con->query("select * from user  where ID='$user_id' and USER_TYPE='46'")->fetch_assoc();
        $ds_id = $user['OWNER_ID'];
        $ds_data =  $con->query("select * from user  where ID='$ds_id' and USER_TYPE='47'")->fetch_assoc();
        $ms_id = $ds_data['OWNER_ID'];
        $ms_data =  $con->query("select * from user  where ID='$ms_id' and USER_TYPE='48'")->fetch_assoc();
        
        //fetch balance of all
        $us_AEPS_BAL = $user['AEPS_BAL'];
        $ds_AEPS_BAL = $ds_data['AEPS_BAL'];
        $ms_AEPS_BAL = $ms_data['AEPS_BAL'];
        
        //fetch commission package id of retailer
        $com_id = $user['M_ATM_COMM'];
        //check slab commission package
          $cm_pk_rw = $con->query("select * from slab_commission where COMM_PACK_ID='$com_id' order by ID asc");
        //code for fetch perticuler slab for transaction amount
            while($dt = $cm_pk_rw->fetch_assoc()){
                    if($trans['TRANSAMOUNT'] >= $dt['MIN_AMOUNT'] && $trans['TRANSAMOUNT']  <= $dt['MAX_AMOUNT']){
                        $plan_id = $dt['ID'];
                        break;
                    }
                }
                // echo $trans['TRANSAMOUNT'];
                // exit;
            // get full detail of the slab row
            $pack = $con->query("select * from slab_commission where ID='$plan_id'")->fetch_assoc();

        //check commision type 
        if($pack['TYPE'] == "PERCENTAGE"){
            $com = $pack['AMOUNT'];
            $charge = $pack['CHARGE'];
            $ds_com = $pack['DS_COM'];
            $ms_com = $pack['MS_COM'];
            
            //check amount commission type
            if($pack['AMOUNT_TYPE'] == "DEBIT"){
                $com_amount = ($trans['TRANSAMOUNT']/100)*$com; // user commission
                $ds_com_amount = ($trans['TRANSAMOUNT']/100)*$ds_com; // ds commission
                $ms_com_amount = ($trans['TRANSAMOUNT']/100)*$ms_com; // ms commission
                
                //User Balance Managment//
                $charge_amount = ($trans['TRANSAMOUNT']/100)*$charge;
                $crnt_bal = $us_AEPS_BAL - $charge_amount;
                $gst = ($com_amount/100)*$pack['GST'];
                $tds = ($com_amount/100)*$pack['TDS'];
                $givenCom = $com_amount-$gst-$tds;
                $update_bal = $crnt_bal-$givenCom;
                
                //Ds Balance Managment//
                $ds_gst = ($ds_com_amount/100)*$pack['GST'];
                $ds_tds = ($ds_com_amount/100)*$pack['TDS'];
                $ds_givenCom = $ds_com_amount-$ds_gst-$ds_tds;
                $ds_update_bal = $ds_AEPS_BAL-$ds_givenCom;
                
                
                //Ds Balance Managment//
                $ms_gst = ($ms_com_amount/100)*$pack['GST'];
                $ms_tds = ($ms_com_amount/100)*$pack['TDS'];
                $ms_givenCom = $ms_com_amount-$ms_gst-$ms_tds;
                $ms_update_bal = $ms_AEPS_BAL-$ms_givenCom;
            }
            else{
                $com_amount = ($trans['TRANSAMOUNT']/100)*$com; // user commission
                $ds_com_amount = ($trans['TRANSAMOUNT']/100)*$ds_com; // ds commission
                $ms_com_amount = ($trans['TRANSAMOUNT']/100)*$ms_com; // ms commission
                
               //User Balance Managment//
                $charge_amount = ($trans['TRANSAMOUNT']/100)*$charge;
                $crnt_bal = $us_AEPS_BAL - $charge_amount;
                $gst = ($com_amount/100)*$pack['GST'];
                $tds = ($com_amount/100)*$pack['TDS'];
                $givenCom = $com_amount-$gst-$tds;
                $update_bal = $crnt_bal+$givenCom;
                
                //Ds Balance Managment//
                $ds_gst = ($ds_com_amount/100)*$pack['GST'];
                $ds_tds = ($ds_com_amount/100)*$pack['TDS'];
                $ds_givenCom = $ds_com_amount-$ds_gst-$ds_tds;
                $ds_update_bal = $ds_AEPS_BAL+$ds_givenCom;
                
                
                //Ds Balance Managment//
                $ms_gst = ($ms_com_amount/100)*$pack['GST'];
                $ms_tds = ($ms_com_amount/100)*$pack['TDS'];
                $ms_givenCom = $ms_com_amount-$ms_gst-$ms_tds;
                $ms_update_bal = $ms_AEPS_BAL+$ms_givenCom;
            }
        }
        else if($pack['TYPE'] == "FLAT"){
            $com = $pack['AMOUNT'];
            $charge = $pack['CHARGE'];
            $ds_com = $pack['DS_COM'];
            $ms_com = $pack['MS_COM'];
            
              if($pack['AMOUNT_TYPE'] == "DEBIT"){
                $com_amount = $com; // user commission 
                $ds_com_amount = $ds_com; // ds commission 
                $ms_com_amount = $ms_com; //ms commission
                
                // User Balance Managment//
                $charge_amount = $charge;
                $crnt_bal = $us_AEPS_BAL - $charge_amount;
                $gst = ($com_amount/100)*$pack['GST'];
                $tds = ($com_amount/100)*$pack['TDS'];
                $givenCom = $com_amount-$gst-$tds;
                $update_bal = $crnt_bal-$givenCom;
                
                //Ds Balance Managment// 
                $ds_gst = ($ds_com_amount/100)*$pack['GST'];
                $ds_tds = ($ds_com_amount/100)*$pack['TDS'];
                $ds_givenCom = $ds_com_amount-$ds_gst-$ds_tds;
                $ds_update_bal = $ds_AEPS_BAL-$ds_givenCom;
                
                //Ms Balance Managment//
                $ms_gst = ($ms_com_amount/100)*$pack['GST'];
                $ms_tds = ($ms_com_amount/100)*$pack['TDS'];
                $ms_givenCom = $ms_com_amount-$ms_gst-$ds_tds;
                $ms_update_bal = $ms_AEPS_BAL-$ms_givenCom;
                
              }
              else{
                $com_amount = $com; // user commission 
                $ds_com_amount = $ds_com; // ds commission 
                $ms_com_amount = $ms_com; //ms commission
                
                // User Balance Managment//
                $charge_amount = $charge;
                $crnt_bal = $us_AEPS_BAL - $charge_amount;
                $gst = ($com_amount/100)*$pack['GST'];
                $tds = ($com_amount/100)*$pack['TDS'];
                $givenCom = $com_amount-$gst-$tds;
                $update_bal = $crnt_bal+$givenCom;
                
                //Ds Balance Managment// 
                $ds_gst = ($ds_com_amount/100)*$pack['GST'];
                $ds_tds = ($ds_com_amount/100)*$pack['TDS'];
                $ds_givenCom = $ds_com_amount-$ds_gst-$ds_tds;
                $ds_update_bal = $ds_AEPS_BAL+$ds_givenCom;
                
                //Ms Balance Managment//
                $ms_gst = ($ms_com_amount/100)*$pack['GST'];
                $ms_tds = ($ms_com_amount/100)*$pack['TDS'];
                $ms_givenCom = $ms_com_amount-$ms_gst-$ds_tds;
                $ms_update_bal = $ms_AEPS_BAL+$ms_givenCom;
                
              }
        }
        else{
             // User Balance Managment//
            $com_amount = 0;
            $charge_amount = 0;
            $crnt_bal = $us_AEPS_BAL;
            $gst = 0;
            $tds = 0;
            $givenCom = 0;
            $update_bal = $crnt_bal;
            
            //Ds Balance Managment// 
            $ds_gst = 0;
            $ds_tds = 0;
            $ds_givenCom = 0;
            $ds_update_bal = $ds_AEPS_BAL;
            
            //Ms Balance Managment//
            $ms_gst = 0;
            $ms_tds = 0;
            $ms_givenCom = 0;
            $ms_update_bal = $ms_AEPS_BAL;
        }
        
        // below is all required parameter to check any calculation error. Uncomment the below to check and confirm the values.
        
        // echo json_encode([
        // "com"=> number_format($givenCom , 2),
        // "ds_com"=> number_format($ds_givenCom , 2),
        // "ms_com"=> number_format($ms_givenCom  , 2),
        // "gst" => number_format($gst, 2),
        // "tds" => number_format($tds  , 2),
        // "ds_gst"=> number_format($ds_gst , 2),
        // "ds_tds"=> number_format($ds_tds , 2),
        // "ms_gst"=> number_format($ms_gst , 2),
        // "ms_tds"=> number_format($ms_tds , 2),
        // "opBal" => number_format($us_AEPS_BAL , 2),
        // "dsopBal" => number_format($ds_AEPS_BAL , 2),
        // "msopBal" => number_format($ms_AEPS_BAL , 2),
        // "charge" => number_format($charge_amount , 2),
        // "clBal" => number_format($update_bal , 2),
        // "ds_clBal" => number_format($ds_update_bal , 2),
        // "ms_clBal" => number_format($ms_update_bal , 2),
        // ]);
        
        //update the user main balance
        $con->query("update user set AEPS_BAL='$update_bal'  where ID='$user_id' ");
        $con->query("update user set AEPS_BAL='$ds_update_bal'  where ID='$ds_id' ");
        $con->query("update user set AEPS_BAL='$ms_update_bal'  where ID='$ms_id' ");
        
        //Inser into commission report
         $con->query("INSERT INTO `commission_report`(`SERVICE`, `REFFRENCE`, `USER_ID`, `USER_TYPE`, `AMOUNT`, `COMMISSION`,`GST` ,`TDS`, `TIME`) 
                    VALUES ('M-ATM','$ref_id','$user_id','46','".$trans['TRANSAMOUNT']."','$givenCom','$gst' ,'$tds' ,'$time')");
         
         $con->query("INSERT INTO `commission_report`(`SERVICE`, `REFFRENCE`, `USER_ID`, `USER_TYPE`, `AMOUNT`, `COMMISSION`,`GST` ,`TDS`, `TIME`) 
                    VALUES ('M-ATM','$ref_id','$ds_id','47','".$trans['TRANSAMOUNT']."','$ds_givenCom','$ds_gst' ,'$ds_tds' ,'$time')");
        
         $con->query("INSERT INTO `commission_report`(`SERVICE`, `REFFRENCE`, `USER_ID`, `USER_TYPE`, `AMOUNT`, `COMMISSION`,`GST` ,`TDS`, `TIME`) 
                    VALUES ('M-ATM','$ref_id','$ms_id','48','".$trans['TRANSAMOUNT']."','$ms_givenCom','$ms_gst' ,'$ms_tds' ,'$time')");
        
        // Insert All Report
        // insert_allreport($user_id  ,$ref_id , "M-ATM Charge" ,$us_AEPS_BAL , $crnt_bal , $charge_amount , "Debit" , "M-ATM Transaction Charge");
        insert_allreport($user_id  ,$ref_id , "M-ATM Commission" ,$crnt_bal , $update_bal , $givenCom , $pack['AMOUNT_TYPE'] , "M-ATM Transaction Commission");
        insert_allreport($ds_id  ,$ref_id , "M-ATM Commission" ,$ds_AEPS_BAL , $ds_update_bal , $ds_givenCom , $pack['AMOUNT_TYPE'] , "M-ATM Transaction Commission");
        insert_allreport($ms_id  ,$ref_id , "M-ATM Commission" ,$ms_AEPS_BAL , $ms_update_bal , $ms_givenCom , $pack['AMOUNT_TYPE'] , "M-ATM Transaction Commission");
        
    // return true;
}

echo json_encode(['status'=>$status, 'msg'=>$msg]);

?>