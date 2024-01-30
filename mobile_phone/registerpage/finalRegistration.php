<?php
    
    include("../includes/configuration.php");
    include("../../Agent/Backend/Functions/all_function.php");
    $json = file_get_contents('php://input');
    // Converts it into a PHP object
    $data = json_decode($json, true);
    
    
    
    // createVirtualAccount("868745");

    extract($data);
    if($event == "finalRegistration"){
        
        extract($information);
        
        
        //aadhaar info
        $aadharInfo = json_encode($aadhaarData);
        $full_address = $aadhaarData[result][address];
        $u_dob = $aadhaarData[result][dob];
        $u_gender = $aadhaarData[result][gender];
        $u_name = $aadhaarData[result][name];
        $u_photo = $aadhaarData[result][photo];
        $uid = $aadhaarData[result][uid];
        $address = $aadhaarData[result][splitAddress][addressLine];
        $city = $aadhaarData[result][splitAddress][city][0];
        $country = $aadhaarData[result][splitAddress][country][0];
        $district= $aadhaarData[result][splitAddress][district][0];
        $state= $aadhaarData[result][splitAddress][state][0][0];
        $pincode= $aadhaarData[result][splitAddress][pincode];
        
        
        //digiPullDocument
        $panInfo = json_encode($digiPullDocument);
        $pan_pdf = $digiPullDocument[result][pdf];
        $pan_xml = $digiPullDocument[result][xml];
        $pan_name = $digiPullDocument[essentials][name];
        $pan_number = $digiPullDocument[essentials][panNumber];
        
        
        //videoKycCallBack
        $videoInfo = json_encode($videoKycCallBack);
        $videoUrl = $videoKycCallBack[video];
        $matchImage =  $videoKycCallBack[matchImageFaceMatch];
        
        //bankInformation
        $bankInfo = json_encode($bankInformation);
        
        
        // include("../includes/register_verify.php");
        // if($VerifyMobile!=$mobile || $VerifyEmail!=$email){
        //   http_response_code(404);
        //   echo json_encode(["rscode" => 404 , "message"=>"Invaild Token "]);
        //   exit;
        // }
        
        
        
        $mysql_qry = "select * FROM user WHERE MOBILE ='$mobile' AND EMAIL = '$email' AND US_STATUS='Deactive' ORDER BY ID DESC LIMIT 1";
        $result = mysqli_query($con ,$mysql_qry);
        if(mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_array($result);
            extract($row);
            
            
            $payoutData = $con->query("SELECT * FROM `payout_users` WHERE US_ID='$ID' ORDER BY ID DESC LIMIT 1")->fetch_assoc();
            $neededVerifiedBank = $payoutData['VERIFY_RESPONSE'];
            
            $query = "INSERT INTO `register_user_data`(`VIDEO_DATA`, `VIDEO_URL`, `BANK_DATA`, `PAN_DATA`, `PAN_PDF`, `PAN_XML`, `PAN_NO`, `PAN_NAME`, `AADHAAR_DATA`, `MOBILE`, `EMAIL`, `ACCOUNT_VERIFICATION`, `USER_ID`)
            VALUES ('$videoInfo','$videoUrl','$bankInfo','$panInfo','$pan_pdf','$pan_xml','$pan_number','$pan_name','$aadharInfo','$mobile','$email','$neededVerifiedBank','$ID')";
            $run_query = mysqli_query($con , $query);
            if($run_query){
                
                $sql = "UPDATE user SET `FIRST_NAME`='$u_name',`LAST_NAME`='', `PARTNER_ID`='PDRT".$ID."' , `ADDRESS`='$address', `ADHAAR_PIC`='$u_photo', `CITY`='$city',`STATE`='$state',`PIN`='$pincode',`ADHAAR`='$uid',`PAN`='$pan_number',`US_STATUS`='Deactive', `PASSWORD`='$password' WHERE ID='$ID'";
                $finalizationD =  mysqli_query($con, $sql);
                
                $sqlPin = "INSERT INTO `tpin`( `USER_ID`, `TPIN`, `STATUS`) VALUES ('$ID','$m_pin','active')";
                
                $finalizationP =  mysqli_query($con, $sqlPin);
                
                if($finalizationD && $finalizationP){
                
                    $rowB = mysqli_fetch_array($result);
                    extract($rowB);

    
                    $beneName = $bankInformation['beneName'];
                    $beneAdd = $bankInformation['beneAdd'];
                    $beneAcc = $bankInformation['beneAcc'];
                    $beneIFSC = $bankInformation['beneIFSC'];
                    
                    $query_p = "INSERT INTO `user_profile`(`MAIN_OWNER`, `MAIN_OWNER_ID`, `OWNER_ID`, `USER_ID`, `ALTERNATE_PHONE_NO`, `DOB`, `GENDER`, `COUNTRY`, `STATE`,`PROFILE_IMG`,`FACEBOOK_URL`,`TWITTER_URL`,`LINKEDIN_URL`,`INSTAGRAM_URL`,`DRIBBLE_BOX_URL`,`DROPBOX_URL`,`GOOGLE_PLUS_URL`,`PINTEREST_URL`,`SKYPE_URL`,`VINE_URL`,`AADHAR_CARD_NO`,`PAN_CARD_NO`,`BANK`,`B_NAME`,`AC_HOLDER_NAME`,`AC_NUM`,`IFSC_CODE`,`PASSBOOK`)
                    VALUES ('$main_owner','$main_owner_id','$main_owner_id','$ID','','$u_dob','$u_gender','$country','$state','$u_photo','','','','','','','','','','','$uid','$pan_number','','$beneAdd','$beneName','$beneAcc','$beneIFSC','')";
                    $run_query_profile = mysqli_query($con , $query_p);
                    
                    echo json_encode(["message"=>"Account Successfully Registered", "response_code"=>1, "status"=>true, "receivableData"=>$ID]);
                    createVirtualAccount($ID);
                }
                else{
                    echo json_encode(["message"=>"System Internal Error 444. Contact Admin", "response_code"=>444, "status"=>false]);
                }
            }
            else{
                echo json_encode(["message"=>"System Internal Error 222. Contact Admin", "response_code"=>222, "status"=>false]);
            }
        }
        else{
            echo json_encode(["message"=>"Unauthorised, Start again from first stage.", "response_code"=>200, "status"=>false]);
        }
        
    }
    
function createVirtualAccount($usid){
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
    // echo $result."\n";
    $response = json_decode($result, true);
    $subCode = $response['subCode'];
    $msg = $response['message'];
    $acc = $response['data']['accountNumber'];
    $ifsc = $response['data']['ifsc'];
    if($subCode == 200){
        $con->query("INSERT INTO `virtual_account`(`USER_ID`, `ACCOUNT_NUM`, `IFSC`, `VA_ID`) VALUES ('$usid','$acc','$ifsc','$vaid')");
        createupi($usid);
    }
        
}


function createupi($usid){
    global $con;
    
     $vauser = $con->query("select * from virtual_account where USER_ID='$usid'");
     
    $us = $con->query("select * from user where ID='$usid'")->fetch_assoc();
    $url = "https://cac-api.cashfree.com/cac/v1/createVA";
    $vaid = $us['MOBILE'];
    $data = json_encode([
            "virtualVpaId"=> strtoupper(str_replace(" " , "" ,$us['FIRST_NAME'])), 
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
    // echo $result;
    $response = json_decode($result, true);
    $subCode = $response['subCode'];
    $msg = $response['message'];
    $vap = $response['data']['vpa'];
    if($subCode == 200){
        $con->query("update `virtual_account` set UPI='$vap' , UPI_RESPONSE='$result'  where USER_ID='$usid'");
    }
}



?>