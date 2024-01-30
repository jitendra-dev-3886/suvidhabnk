<?php
session_start();
include("../../../../Db/config.php");
include("../../Userinfo/getuserinfo.php");
include("../../Functions/all_function.php");
include("../../Auth/userdata.php");

// $usid = $_SESSION['UsId']; 
    
    
if(isset($_POST["page"]) && $_POST["page"] == 1){
     

$insurance_type = $_POST["insurance_type"];
$vowner = $_POST["vowner"];
$whatsappmob = $_POST["whatsappmob"];
$vehichleNumber = $_POST["vnum"];

$singzyData = getsignzyAuthLive();
extract($singzyData);

$refrence = "PDR".$usid.date("Ymd").mt_rand(999, 9999);
 $arr = array(
        "task" => "detailedSearch",
    "essentials"=> [
      "vehicleNumber"=> "$vehichleNumber",
      "signzyID"=> ""
    ]
    
    );
    
    //   "blacklistCheck"=> true,
    
    
    
    $postData = json_encode($arr);
    
    $header = array(
    "Authorization: $id",
    "accept: */*",
    "accept-language: en-US,en;q=0.8",
    "content-type: application/json"
      );
      
    
 $curl = curl_init();

curl_setopt_array($curl, array(
  CURLOPT_URL => "https://signzy.tech/api/v2/patrons/$userId/vehicleregistrations",
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => "",
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 30,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => "POST",
  CURLOPT_POSTFIELDS => $postData,
  CURLOPT_HTTPHEADER => $header,
));

$response = curl_exec($curl);

$err ="cURL error : ". curl_error($curl);

curl_close($curl);

$errors = json_decode($response);



    $errorCode = $errors->error->statusCode;
    $errorMessage =$errors->error->message;
    if($errorMessage=="" || $errorMessage==null){
       echo json_encode(["message"=>"Response Recieved", "response_code"=>1, "status"=>true, "receivableData"=>$errors,"requestedData"=>json_decode($postData)]);
    }
    else{
        echo json_encode(["message"=>$errorMessage, "response_code"=>300, "status"=>false]);
    }

}


 if(isset($_POST["page"]) && $_POST["page"] == 2){
     

$vehcData = $_POST['vehcData']; // can be posted  what recieved and updated directly in the database 
$reqdata = $_POST['reqData']; // can be posted  what recieved and updated directly in the database 
$insurance_type = $_POST["insurance_type"];
$vowner = $_POST["insurance_ownername"];
$whatsappmob = $_POST["insurance_wno"];
$vehichleNumber = $_POST["insurance_vno"];

$cuser = $con->query("SELECT * FROM `user` WHERE ID = '$usid'")->fetch_assoc();
        $charge = $con->query("SELECT * FROM `etax_commission` WHERE SERVICE='Insurance'")->fetch_assoc();
        $chargeamt = $charge["CHARGE"];

        if($cuser["MAIN_BAL"] >= $chargeamt){
            
            $after_amt = $cuser["MAIN_BAL"]-$chargeamt;
           $sql = $con->query("INSERT INTO `vehicle_registration`(`INSURANCE_TYPE`, `VEHICLE_OWNER`, `WHATSAPP_NUMBER`, `VEHICLE_NUMBER`, `REQUEST_DATA`, `RESPONSE_DATA`,`INSURANCE_DOC`, `RT_COMM`, `DT_COMM`,`REMARK`, `STATUS`, `USER_ID`) VALUES 
            ('$insurance_type','$vowner','$whatsappmob','$vehichleNumber','$reqdata','$vehcData', '', '', '','', 'Pending','$usid')");
            
           if($sql){
            $con->query("UPDATE user SET MAIN_BAL='$after_amt' WHERE ID = '$usid'");
            insert_allreport($usid  ,$vehichleNumber , "INSURANCE" , $cuser["MAIN_BAL"]  , $after_amt , $chargeamt , "Debit" , "INSURANCE Transaction", "MAIN");
          echo json_encode(["message"=>"Vehicle Registration Successfull..!", "response_code"=>1, "status"=>true]);
        }else{
            echo json_encode(["message"=>"Vehicle Registration Unsuccessfull..!", "response_code"=>3, "status"=>false]);
        }
          
        }else{
             echo json_encode(["message"=>"Insuficiant balance for vehicle registration ! Please add fund..!", "response_code"=>400, "status"=>false]);
        }

        
        
 }     
   
?>