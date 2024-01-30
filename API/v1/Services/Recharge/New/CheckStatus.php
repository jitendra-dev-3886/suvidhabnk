<?php
error_reporting(0);
session_start();
include("../../../../../Db/config.php");

$time = date("Y-m-d g:i:s A");
if(isset($_GET['api_key'])){
    
    $api_key = $_GET['api_key'];
    $register_mobile = $_GET['register_mobile'];
    $txn_id = $_GET['txn_id'];
    $ip = $_SERVER['REMOTE_ADDR'];


        // check api key validation 
        if($con->query("select * from user where API_KEY='$api_key'")->num_rows != 1){
             echo json_encode(["HTTPCode" => 404 , "ResponseCode" => 1 , "Message" => "Unauthorized Access." , "Status"=>"Access Denied"]);
             exit;
        }
        
        $api_user = $con->query("select * from user where API_KEY='$api_key' ORDER BY ID DESC LIMIT 1")->fetch_assoc();
        $api_user_bal = $api_user['MAIN_BAL'];
        $api_userMobile = $api_user['MOBILE'];
        
        
        //check ip validation 
        if($ip !=$api_user['IP']){
            echo json_encode(["HTTPCode" => 403 , "ResponseCode" => 2 , "Message" => "Unauthorized IP Address. Update your ip : $ip" , "Status"=>"Access Denied"]);
            exit;
        }
        
        //check mobile validation
        if($api_userMobile != $register_mobile){
            echo json_encode(["HTTPCode" => 404 , "ResponseCode" => 3 , "Message" => "Mobile number not matched." , "Status"=>"Access Denied"]);
            exit;
        }
        
        // check user status validation 
        if(strtolower($api_user['US_STATUS']) != "active"){
             echo json_encode(["HTTPCode" => 200 , "ResponseCode" => 4 , "Message" => "Your account has been suspended. Contact to Api Provider." , "Status"=>"Account Suspended"]);
            exit;
        }
        
        
        //  check for duplicatie refrence id 
        $rechRows  = $con->query("select * from recharge_transaction where REFERENCE_ID='$txn_id'")->num_rows;
          if($rechRows >= 1){
              $status = $rechRows['STATUS'];
            echo json_encode(["HTTPCode" => 200 , "ResponseCode" => 15 , "Message" => "Your Transaction for Transaction ID : $txn_id is Status : $status." , "Status"=>$status]);
            exit;
          }
        
}

?>