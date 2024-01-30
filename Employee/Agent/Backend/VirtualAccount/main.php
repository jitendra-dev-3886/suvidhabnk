<?php
session_start();
// error_reporting(E_ALL);
// ini_set("display_errors" , 1);
include("../../../Db/config.php");
include("../Userinfo/getuserinfo.php");
include("../Functions/all_function.php");

if(isset($_POST['createAccount'])){
    $usid= $_POST['usid'];
    $vauser = $con->query("select * from virtual_account where USER_ID='$usid' and ACCOUNT_NUM = '' and UPI = '' ");
    if($vauser->num_rows != 0){
        echo json_encode(["subCode" => 300 , "message"=> "Account already exisit"]);
        exit;
    }
    
       if($vauser->num_rows == 0){
           //check exist va user
           $checkva = fetchVPAuser($usid);
           $vars = json_decode($checkva , true);
           if($vars['subCode'] == 404){
               $checkva = createVirtualAccount($usid , $requestId);
               $vars = json_decode($checkva , true);
               $acc = $vars['data']['accountNumber'];
                $ifsc = $vars['data']['ifsc'];
                $vaid = $vars['data']['vAccountId'];
                $vaacms = $upirs['message'];
                if($vars['subCode'] == 200){
                    $con->query("INSERT INTO `virtual_account`(`USER_ID`, `ACCOUNT_NUM`, `IFSC`, `VA_ID` , `RESPONSE`) VALUES ('$usid','$acc','$ifsc','$vaid' , '$checkva')");
                }
           }
           else if($vars['subCode'] == 200){
                $acc = $vars['data']['virtualAccountNumber'];
                $ifsc = $vars['data']['ifsc'];

                $vaacms = $upirs['message'];
                $con->query("INSERT INTO `virtual_account`(`USER_ID`, `ACCOUNT_NUM`, `IFSC`, `VA_ID` , `RESPONSE`) VALUES ('$usid','$acc','$ifsc','$vaid' , '$checkva')");
           }
           
        // check upi
          $checkupi = fetchUPIuser($usid);
           $upirs = json_decode($checkupi , true);
           if($upirs['subCode'] == 404){
            //   echo "work";
               $checkupi = createupi($usid , $requestId);
            //   echo $checkupi;
               $upirs = json_decode($checkupi , true);
                $vap = $upirs['data']['vpa'];
                $vaupicms = $upirs['message'];
                $upaid = $upirs['virtualVpaId'];
                if($upirs['subCode'] == 200){
                    $con->query("update `virtual_account` set VPAID='$upaid'  , UPI='$vap' , UPI_RESPONSE='$checkupi'  where USER_ID='$usid'");    
                    // echo "update `virtual_account` set VPAID='$upaid'  , UPI='$vap' , UPI_RESPONSE='$checkupi'  where USER_ID='$usid'";
                }
           }
           else if($upirs['subCode'] == 200){
            //   echo "work";
                $vaupicms = $upirs['message'];
                $vap = $upirs['data']['virtualVPA'];
                $upaid = $upirs['data']['virtualVpaId'];
                // echo "update `virtual_account` set VPAID='$upaid'  , UPI='$vap' , UPI_RESPONSE='$checkupi'  where USER_ID='$usid'";
                $con->query("update `virtual_account` set VPAID='$upaid'  , UPI='$vap' , UPI_RESPONSE='$checkupi'  where USER_ID='$usid'");
           }
           
            echo json_encode(["subCode" => 200 , "message"=> "Successfully Created. "]);
      }
       
       
    // $us = $con->query("select * from user where ID='$usid'")->fetch_assoc();
    // $url = "https://cac-api.cashfree.com/cac/v1/createVA";
    // $vaid = $us['MOBILE'];
    // $data = json_encode([
    //         "vAccountId"=> $vaid, 
    //         "name"=> $us['FIRST_NAME'], 
    //         "phone"=> $us['MOBILE'], 
    //         "email"=> $us['EMAIL']
            
    //     ]);
    // // echo $data;
    // $token = create_cashfree_token_cac();
    // // print_r($token);
    // // exit;
    // $headers = array(
    //     'Content-Type:application/json',
    //     'Authorization: Bearer ' . $token
    // );

    // $ch = curl_init();
    // curl_setopt($ch, CURLOPT_URL, $url);
    // curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    // curl_setopt($ch, CURLOPT_POST, true);
    // curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    // curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
    // curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
    // curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
    // curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    // curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
    // $result = curl_exec($ch);
    // echo $result;
    // $response = json_decode($result, true);
    // $subCode = $response['subCode'];
    // $msg = $response['message'];
    // $acc = $response['data']['accountNumber'];
    // $ifsc = $response['data']['ifsc'];
    // if($subCode == 200){
    //     $con->query("INSERT INTO `virtual_account`(`USER_ID`, `ACCOUNT_NUM`, `IFSC`, `VA_ID` , `RESPONSE`) VALUES ('$usid','$acc','$ifsc','$vaid' , '$result')");
    // }
    

}

// if(isset($_POST['createupi'])){
//     $usid= $_POST['usid'];
//      $vauser = $con->query("select * from virtual_account where USER_ID='$usid'");
//     if($vauser->num_rows == 0){
//         echo json_encode(["subCode" => 300 , "message"=> "Account not found. Please create virtual account first. "]);
//         exit;
//     }
    
//     $us = $con->query("select * from user where ID='$usid'")->fetch_assoc();
//     $url = "https://cac-api.cashfree.com/cac/v1/createVA";
//     $vaid = $us['MOBILE'];
//     $data = json_encode([
//             "virtualVpaId"=> strtoupper(str_replace(" " , "" ,$us['FIRST_NAME'])).mt_rand(999 , 9999), 
//             "name"=> $us['FIRST_NAME'], 
//             "phone"=> $us['MOBILE'], 
//             "email"=> $us['EMAIL']
            
//         ]);
//         // echo $data;
//     $token = create_cashfree_token_cac();
//     // print_r($token);
//     // exit;
//     $headers = array(
//         'Content-Type:application/json',
//         'Authorization: Bearer ' . $token
//     );

//     $ch = curl_init();
//     curl_setopt($ch, CURLOPT_URL, $url);
//     curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
//     curl_setopt($ch, CURLOPT_POST, true);
//     curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
//     curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
//     curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
//     curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
//     curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
//     curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
//     $result = curl_exec($ch);
//     echo $result;
//     $response = json_decode($result, true);
//     $subCode = $response['subCode'];
//     $msg = $response['message'];
//     $vap = $response['data']['vpa'];
//     if($subCode == 200){
//         $con->query("update `virtual_account` set UPI='$vap' , UPI_RESPONSE='$result'  where USER_ID='$usid'");
//     }
// }


    
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


if(isset($_POST["pageid"]) && $_POST["pageid"] == 1){
    $vid = $_POST["usid"];
    $vauser = $con->query("select * from virtual_account where ID='$vid'")->fetch_assoc();
    $upiid = $vauser["UPI"];
    $url = "https://cac-api.cashfree.com/cac/v1/createQRCode?virtualVPA=$upiid";
    $token = create_cashfree_token_cac();
    $headers = array(
        'Authorization: Bearer ' . $token
    );

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
    $result = curl_exec($ch);
    $response = json_decode($result, true);
    $subCode = $response['subCode'];
    $msg = $response['message'];
    
    $con->query("INSERT INTO `API_HITLOG`(`USER_ID`, `SEVICE`, `TRANSACTION_ID`, `TOKEN`, `REQUEST_LOG`, `RESPONSE_LOG`) VALUES ('$usid','createqr','','$token','$data','$result')");
    if($subCode == 200){
         $con->query("update `virtual_account` set QR_RESPONSE='$result'  where ID='$vid'");
         echo json_encode(["response_code" => 1, "message" => $msg , "status" => true]);
    }else{
        echo json_encode(["response_code" => 3, "message" => $msg , "status" => false]);
    }
}

if(isset($_POST['displayQR'])){

include("../Auth/userdata.php");
    
$virtual_acc = $con->query("SELECT * FROM `virtual_account` WHERE USER_ID='$usid' ORDER BY ID DESC LIMIT 1")->fetch_assoc();
$qrres = json_decode($virtual_acc["QR_RESPONSE"],true);
$qrimg  = $qrres["qrCode"];
if($qrimg == null || $qrimg==""){
    echo json_encode(["status"=>false, "response_code"=>5, "message"=>"No QR Code Available for you, Please contact admin."]);
    exit;
}
else{
    echo json_encode(["status"=>true, "response_code"=>1, "message"=>"Qr Code Availbe", "receivableData"=>$qrimg]);
    exit;
}

}



?>