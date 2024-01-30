<?php
// error_reporting(E_ALL);
// ini_set("display_errors" ,1);
include("../../../Db/config.php");
include("../Functions/all_function.php");

    $json = file_get_contents('php://input');
    // Converts it into a PHP object
    $data = json_decode($json, true);
    

    extract($data);
    if($event == "finalRegistration"){
        
        extract($information);
        $user =   $con->query("select * from register_user_data where REQ_ID='$requestId' ")->fetch_assoc();
        $ID = $user['USER_ID'];
        
        $mysql_qry = "select * FROM user WHERE ID='$ID' AND US_STATUS='Deactive' ORDER BY ID DESC LIMIT 1";
        // echo $mysql_qry;
        $result = mysqli_query($con ,$mysql_qry);
        if(mysqli_num_rows($result) > 0) {
                $usdata = $con->query($mysql_qry)->fetch_assoc();
                $parid = "PDDT".$ID;
                $sql = "UPDATE user SET `PARTNER_ID`='$parid' ,  `PASSWORD`='$password' WHERE ID='$ID'";
                $finalizationD =  mysqli_query($con, $sql);
                
                $sqlPin = "INSERT INTO `tpin`( `USER_ID`, `TPIN`, `STATUS`) VALUES ('$ID','$mpin','active')";
                
                $finalizationP =  mysqli_query($con, $sqlPin);
                
                if($finalizationD && $finalizationP){
                   $vauser = $con->query("select * from virtual_account where VA_ID='".$usdata['MOBILE']."' and ACCOUNT_NUM<>'' ");
                   $vauserdata = $vauser->fetch_assoc();
                   if($vauser->num_rows == 1){
                       $con->query("update virtual_account set USER_ID='$ID' where VA_ID='".$usdata['MOBILE']."' ");
                        $con->query("update register_user_data set VIRTUAL_ACC='".$vauserdata['RESPONSE']."'     where REQ_ID='$requestId' ");
                        $con->query("update register_user_data set VIRTUAL_UPI='".$vauserdata['UPI_RESPONSE']."' where REQ_ID='$requestId' ");
                       echo json_encode(["message"=>"Account Successfully Registered. Login to access", "response_code"=>1, "status"=>true, "receivableData"=>$ID]);
                       exit;
                   }
                   
                   if($vauser->num_rows == 0){
                       //check exist va user
                       $checkva = fetchVPAuser($ID);
                       $vars = json_decode($checkva , true);
                       if($vars['subCode'] == 404){
                           $checkva = createVirtualAccount($ID , $requestId);
                           $vars = json_decode($checkva , true);
                           $acc = $vars['data']['accountNumber'];
                            $ifsc = $vars['data']['ifsc'];
                            $vaid = $vars['data']['vAccountId'];
                            $vaacms = $upirs['message'];
                            if($subCode == 200){
                                $con->query("INSERT INTO `virtual_account`(`USER_ID`, `ACCOUNT_NUM`, `IFSC`, `VA_ID` , `RESPONSE`) VALUES ('$ID','$acc','$ifsc','$vaid' , '$checkva')");
                            }
                       }
                       else if($vars['subCode'] == 200){
                            $acc = $vars['data']['virtualAccountNumber'];
                            $ifsc = $vars['data']['ifsc'];
                            $vaid = $vars['data']['vAccountId'];
                            $vaacms = $upirs['message'];
                            $con->query("INSERT INTO `virtual_account`(`USER_ID`, `ACCOUNT_NUM`, `IFSC`, `VA_ID` , `RESPONSE`) VALUES ('$ID','$acc','$ifsc','$vaid' , '$checkva')");
                       }
                       
                        $con->query("update register_user_data set VIRTUAL_ACC='$checkva' where REQ_ID='$requestId' ");
                    // check upi
                      $checkupi = fetchUPIuser($ID);
                       $upirs = json_decode($checkupi , true);
                       if($upirs['subCode'] == 404){
                           $checkupi = createupi($ID , $requestId);
                           $upirs = json_decode($checkupi , true);
                            $vap = $upirs['data']['vpa'];
                            $vaupicms = $upirs['message'];
                            $upaid = $upirs['virtualVpaId'];
                            if($subCode == 200){
                                $con->query("update `virtual_account` set VPAID='$upaid'  , UPI='$vap' , UPI_RESPONSE='$checkupi'  where USER_ID='$ID'");                          
                            }
                       }
                       else if($upirs['subCode'] == 200){
                            $vaupicms = $upirs['message'];
                            $vap = $upirs['data']['virtualVPA'];
                            $upaid = $upirs['data']['virtualVpaId'];
                            // echo "update `virtual_account` set VPAID='$upaid'  , UPI='$vap' , UPI_RESPONSE='$checkupi'  where USER_ID='$usid'";
                            $con->query("update `virtual_account` set VPAID='$upaid'  , UPI='$vap' , UPI_RESPONSE='$checkupi'  where USER_ID='$ID'");
                       }
                    $con->query("update register_user_data set VIRTUAL_UPI='$checkupi' where REQ_ID='$requestId' ");
                       
                   }
                   
                  if($vap != "" && $acc != ""){
                        echo json_encode(["message"=>"Account Successfully Registered. Login to access", "response_code"=>1, "status"=>true, "receivableData"=>$vars ,"receivableData2"=>$upirs]);
                  }
                  else {
                        echo json_encode(["message"=>"Virtual Account not created \n VA Error : $vaacms \n UPI Error : $vaupicms", "response_code"=>201, "status"=>false , "receivableData"=>$vars ,"receivableData2"=>$upirs  ]);
                  }
                }
                else{
                    echo json_encode(["message"=>"System Internal Error 444. Contact Admin", "response_code"=>444, "status"=>false]);
                }
        }
        else{
            echo json_encode(["message"=>"Unauthorised, Start again from first stage.", "response_code"=>200, "status"=>false]);
        }
        
    }
    
    
    
    
    
function fetchVPAuser($id){
          global $con;
    $us = $con->query("select * from user where ID='$id'")->fetch_assoc();
    $vaid = $us['MOBILE'];
    $url = "https://cac-api.cashfree.com/cac/v1/va/$vaid";
    // $data = json_encode([
    //         "virtualVPAId"=> $vaid, 
    //         "vAccountId"=> $vaid,
            
    //     ]);
        // echo $data;
    $token = create_cashfree_token_cac();
    // print_r($token);
    // exit;
    $headers = array(
        'Content-Type:application/json',
        'Authorization: Bearer ' . $token
    );
// echo $url;
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_POST, false);
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
    $result = curl_exec($ch);
    $response = json_decode($result, true);
    $subCode = $response['subCode'];
    $msg = $response['message'];
    $acc = $response['data']['accountNumber'];
    $ifsc = $response['data']['ifsc'];
    
    $con->query("INSERT INTO `API_HITLOG`(`USER_ID`, `SEVICE`, `TRANSACTION_ID`, `TOKEN`, `REQUEST_LOG`, `RESPONSE_LOG`) VALUES ('$id','fetchVPAuser','','$token','','$result')");
    // $con->query("update register_user_data set VIRTUAL_ACC='$result' where REQ_ID='$requestId' ");
    if($subCode == 200){
        // $con->query("INSERT INTO `virtual_account`(`USER_ID`, `ACCOUNT_NUM`, `IFSC`, `VA_ID` , `RESPONSE`) VALUES ('$usid','$acc','$ifsc','$vaid' , '$result')");
        // createupi($usid , $requestId);
    }
    return $result;
}
    
    
    
    
function fetchUPIuser($id){
          global $con;
    $us = $con->query("select * from user where ID='$id'")->fetch_assoc();
    $vaid = strtoupper(str_replace(" " , "" ,$us['FIRST_NAME'])).substr($us['MOBILE'] , 0 , 5);
    $url = "https://cac-api.cashfree.com/cac/v1/va/$vaid";
   
    $token = create_cashfree_token_cac();
    // print_r($token);
    // exit;
    $headers = array(
        'Content-Type:application/json',
        'Authorization: Bearer ' . $token
    );
// echo $url;
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_POST, false);
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
    $result = curl_exec($ch);
    $response = json_decode($result, true);
    $subCode = $response['subCode'];
    $msg = $response['message'];
    $vap = $response['data']['vpa'];
    
    $con->query("INSERT INTO `API_HITLOG`(`USER_ID`, `SEVICE`, `TRANSACTION_ID`, `TOKEN`, `REQUEST_LOG`, `RESPONSE_LOG`) VALUES ('$id','fetchUPIuser','','$token','','$result')");
    // $con->query("update register_user_data set VIRTUAL_ACC='$result' where REQ_ID='$requestId' ");
    if($subCode == 200){
        // $con->query("update `virtual_account` set UPI='$vap' , UPI_RESPONSE='$result'  where USER_ID='$usid'");
    }
    return $result;
}
    
function createVirtualAccount($usid , $requestId){
    global $con;
    $us = $con->query("select * from user where ID='$usid'")->fetch_assoc();
    $url = "https://cac-api.cashfree.com/cac/v1/createVA";
    $vaid = $us['MOBILE'];
    $data = json_encode([
            "vAccountId"=> $vaid, 
            "name"=> $us['FIRST_NAME'], 
            "phone"=> $us['MOBILE'], 
            "email"=> $us['EMAIL']
            
        ]);
        // echo $data;
    $token = create_cashfree_token_cac();
    // print_r($token);
    // exit;
    $headers = array(
        'Content-Type:application/json',
        'Authorization: Bearer ' . $token
    );

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
    $result = curl_exec($ch);
    $response = json_decode($result, true);
    $subCode = $response['subCode'];
    $msg = $response['message'];
    $acc = $response['data']['accountNumber'];
    $ifsc = $response['data']['ifsc'];
    
    $con->query("INSERT INTO `API_HITLOG`(`USER_ID`, `SEVICE`, `TRANSACTION_ID`, `TOKEN`, `REQUEST_LOG`, `RESPONSE_LOG`) VALUES ('$usid','createVirtualAccount','','$token','$data','$result')");
    if($subCode == 200){
        // $con->query("INSERT INTO `virtual_account`(`USER_ID`, `ACCOUNT_NUM`, `IFSC`, `VA_ID` , `RESPONSE`) VALUES ('$usid','$acc','$ifsc','$vaid' , '$result')");
        // createupi($usid , $requestId);
    }
        
    return $result;
}


function createupi($usid , $requestId){
    global $con;
    
    $vauser = $con->query("select * from virtual_account where USER_ID='$usid'");
    $us = $con->query("select * from user where ID='$usid'")->fetch_assoc();
    $url = "https://cac-api.cashfree.com/cac/v1/createVA";
    $vaid = $us['MOBILE'];
    $vpaid = strtoupper(str_replace(" " , "" ,$us['FIRST_NAME'])).substr($us['MOBILE'] , 0 , 5);
    $data = json_encode([
            "virtualVpaId"=> $vpaid, 
            "name"=> $us['FIRST_NAME'], 
            "phone"=> $us['MOBILE'], 
            "email"=> $us['EMAIL']
            
        ]);
    // echo $data;
    $token = create_cashfree_token_cac();
    // print_r($token);
    // exit;
    $headers = array(
        'Content-Type:application/json',
        'Authorization: Bearer ' . $token
    );

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
    $result = curl_exec($ch);
    $response = json_decode($result, true);
    $subCode = $response['subCode'];
    $msg = $response['message'];
    $vap = $response['data']['vpa'];
    $response['virtualVpaId'] = $vpaid;
    
    $con->query("INSERT INTO `API_HITLOG`(`USER_ID`, `SEVICE`, `TRANSACTION_ID`, `TOKEN`, `REQUEST_LOG`, `RESPONSE_LOG`) VALUES ('$usid','createupi','','$token','$data','$result')");
    if($subCode == 200){
        // $con->query("update `virtual_account` set UPI='$vap' , UPI_RESPONSE='$result'  where USER_ID='$usid'");
    }
    return json_encode($response);
}



?>