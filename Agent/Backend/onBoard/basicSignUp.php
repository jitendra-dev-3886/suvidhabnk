<?php


include("../../../Db/config.php");
include("../Functions/all_function.php");
// include("enc.php");
include("onEnc.php");
include("uploader.php");


if(isset($_POST['aadhaarNum'])){
    
    
$dir='../../assets/profileImage/';
$dirDoc='../../assets/documents/';


$profilePic = $_POST['profileImage'];

$aadhaarImage = $_POST['aadhaarImage'];
$panImage = $_POST['panImage'];
$passbookImage = $_POST['passbookImage'];
$gstImage = $_POST['gstImage'];



$fullAddress = $_POST['fullAddress'];
$state = $_POST['state'];
$district = $_POST['district'];
$block = $_POST['block'];
$pincode = $_POST['pincode'];
$fullName = $_POST['fullName'];
$email = $_POST['email'];
$aadhaarNum = $_POST['aadhaarNum'];
$mobile = decrypt($_POST['mobile']);
$secret = $_POST['secret'];
$password = $_POST['password'];
$mpin = decrypt($_POST['mpin']);

$img_extenion1 = "png";



$exoStatus = $con->query("SELECT * FROM `exoStatusCallback` WHERE MOBILE='8240193509' and STATUS='Success' ORDER BY ID DESC LIMIT 1")->fetch_assoc();

$timestamp = date("Y-m-d H:i:s");
$from_time = strtotime($exoStatus['TIME']);
$to_time = strtotime($timestamp);
$totalTime =  round(abs($to_time - $from_time) / 60,2);
if($totalTime=="" || $totalTime==null || $totalTime>=20){
    echo json_encode(["status"=>false, "response_code"=>43, "message"=>"Time out, Re register again"]);
    exit;
}

$exoCred = $con->query("SELECT * FROM `exotelAppCred` WHERE ID='1' ORDER BY ID ASC LIMIT 1")->fetch_assoc();
if($exoCred['APP_SECRET']!=$secret){
    echo json_encode(["status"=>false, "response_code"=>43, "message"=>"Un Authorized, Try it all over again"]);
    exit;
}

if($con->query("SELECT * FROM `user` WHERE MOBILE='$mobile' and US_STATUS='Active'")->num_rows != 0){
    echo json_encode(["status"=>false, "response_code"=>44, "message"=>"Account Already exists"]);
    exit;
}


$profile = uploadImage($profilePic, $dir);


if($_POST['FullKyc']=="FullKyc"){
    $aadhaarImageName = uploadImage($aadhaarImage, $dirDoc);
    $panImageName = uploadImage($panImage, $dirDoc);
    $passbookImageName = uploadImage($passbookImage, $dirDoc);
    $gstImageName = uploadImage($gstImage, $dirDoc);
}


    
$array = array("jpg"  , "jpeg" , "png");
if(in_array($img_extenion1 , $array)){
    
    
    $imageGivenPath = "https://paydeer.in/Agent/assets/profileImage/".$profile;
    
    $mysql_qry = "select * FROM user WHERE MOBILE ='$mobile' AND US_STATUS='Deactive' ORDER BY ID DESC LIMIT 1";
        $result = mysqli_query($con ,$mysql_qry);
        if(mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_array($result);
            extract($row);
            
            
            if($_POST['FullKyc']=="FullKyc"){
                    $sqlFullKyc = "INSERT INTO `full_kyc`( `USER_ID`, `PAN_IMAGE`, `AADHAAR_IMAGE`, `GST_IMAGE`, `PASS_CANCHQ`) VALUES ('$ID','$panImageName','$aadhaarImageName', '$gstImageName', '$passbookImageName')";
                    $finalizationKyc =  mysqli_query($con, $sqlFullKyc);
                    if(!$finalizationKyc){
                        echo json_encode(["message"=>"Full Kyc is down, contact admin", "response_code"=>444, "status"=>false]);
                        exit;
                    }
            }
            
            $payoutData = $con->query("SELECT * FROM `payout_users` WHERE US_ID='$ID' ORDER BY ID DESC LIMIT 1")->fetch_assoc();
            $neededVerifiedBank = $payoutData['VERIFY_RESPONSE'];
            
            $query = "INSERT INTO `register_user_data`(`VIDEO_DATA`, `VIDEO_URL`, `BANK_DATA`, `PAN_DATA`, `PAN_PDF`, `PAN_XML`, `PAN_NO`, `PAN_NAME`, `AADHAAR_DATA`, `MOBILE`, `EMAIL`, `ACCOUNT_VERIFICATION`, `USER_ID`)
            VALUES ('$videoInfo','$videoUrl','$bankInfo','$panInfo','$pan_pdf','$pan_xml','$pan_number','$pan_name','$aadharInfo','$mobile','$email','$neededVerifiedBank','$ID')";
            $run_query = mysqli_query($con , $query);
            if($run_query){
                
                

                $sql = "UPDATE user SET `FIRST_NAME`='$fullName',`LAST_NAME`='', `DISTRICT`='$district', `BLOCK`='$block', `EMAIL`='$email', `PARTNER_ID`='PDRT".$ID."' , `ADDRESS`='$fullAddress', `ADHAAR_PIC`='$imageGivenPath', `CITY`='$fullAddress',`STATE`='$state',`PIN`='$pincode',`ADHAAR`='$aadhaarNum',`PAN`='$pan_number',`US_STATUS`='Active', `PASSWORD`='$password' WHERE ID='$ID'";
                $finalizationD =  mysqli_query($con, $sql);
                
                $sqlPin = "INSERT INTO `tpin`( `USER_ID`, `TPIN`, `STATUS`) VALUES ('$ID','$mpin','active')";
                
                
                $finalizationP =  mysqli_query($con, $sqlPin);
    
                if($finalizationD && $finalizationP){
                
                
                
                    
                
                    $rowB = mysqli_fetch_array($result);
                    extract($rowB);

    
                    $beneName = $bankInformation['beneName'];
                    $beneAdd = $bankInformation['beneAdd'];
                    $beneAcc = $bankInformation['beneAcc'];
                    $beneIFSC = $bankInformation['beneIFSC'];
                    
                    $query_p = "INSERT INTO `user_profile`(`MAIN_OWNER`, `MAIN_OWNER_ID`, `OWNER_ID`, `USER_ID`, `ALTERNATE_PHONE_NO`, `DOB`, `GENDER`, `COUNTRY`, `STATE`,`PROFILE_IMG`,`FACEBOOK_URL`,`TWITTER_URL`,`LINKEDIN_URL`,`INSTAGRAM_URL`,`DRIBBLE_BOX_URL`,`DROPBOX_URL`,`GOOGLE_PLUS_URL`,`PINTEREST_URL`,`SKYPE_URL`,`VINE_URL`,`AADHAR_CARD_NO`,`PAN_CARD_NO`,`BANK`,`B_NAME`,`AC_HOLDER_NAME`,`AC_NUM`,`IFSC_CODE`,`PASSBOOK`)
                    VALUES ('$main_owner','$main_owner_id','$main_owner_id','$ID','','$u_dob','$u_gender','$country','$state','$imageGivenPath','','','','','','','','','','','$uid','$pan_number','','$beneAdd','$beneName','$beneAcc','$beneIFSC','')";
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
else{
    echo json_encode(["status"=>false, "response_code"=>45, "message"=>"Profile Picture image should only be JPG, JPEG OR PNG Only"]);
    exit;
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