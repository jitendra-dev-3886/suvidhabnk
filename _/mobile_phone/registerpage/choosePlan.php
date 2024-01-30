<?php

include("../includes/configuration.php");
include("../../Agent/Backend/Functions/all_function.php");


if(isset($_POST['choose_plan'])){
    
    $response  = array();
    $op = $con->query("SELECT * FROM `subscription_plan` WHERE STATUS='Active' ORDER BY ID DESC");
    
    if($op->num_rows > 0)
    {
        while($row = $op->fetch_assoc()){
            //  array_push($response,array("id"=>$row["ID"],"name"=>$row['NAME'], "price"=>$row['PRICE'], "description"=>$row['DESCRIPTION'],"validity"=>$row['VALIDITY'],"user"=>$row['USER'],"status"=>$row['STATUS'],"date"=>$row['DATE']));
             array_push($response, $row);
        }
        echo json_encode(["message"=>"Plans Fetched.", "response_code"=>1, "status"=>true, "receivableData"=>$response]);
    }
    else{
        echo json_encode(["message"=>"No Plan Found.", "response_code"=>3, "status"=>false, "receivableData"=>null]);
    }
    
}

    $json = file_get_contents('php://input');
    $data = json_decode($json, true);
    extract($data);
    
    if($event == "set_plan"){
        extract($information);
    
    // include("../includes/register_verify.php");
    // if($VerifyMobile!=$mobile || $VerifyEmail!=$email){
    //      http_response_code(404);
    //      echo json_encode(["rscode" => 404 , "message"=>"Invaild Token "]);
    //      exit;
    // }
    
        $user = $con->query("SELECT * FROM `user` WHERE MOBILE='$mobile' AND EMAIL = '$email' AND PASSWORD='$password' ORDER BY ID DESC LIMIT 1 ")->fetch_assoc();
        
        $name = $user['FIRST_NAME'];
        
        $planData = $con->query("SELECT * FROM `subscription_plan` WHERE ID='$plan_id' ORDER BY ID DESC LIMIT 1")->fetch_assoc(); 
    
            $TplanId =  $planData['PLAN_ID'];
            
            $intervalType = $planData['INTERVAL_TYPE'];
            $intervals = $planData['INTERVALS'];
            $amount = $planData['AMOUNT'];
            
            
            $sus_id = "PDRSUBSID_".$usid.date("Ymd").mt_rand(999, 9999);
            
            // $firstChargeDate = date('Y-m-d',strtotime("+2 day"));
            // $expTime = date('Y-m-d H:m:s',strtotime("+5 day"));
            
            $firstChargeDate = date('Y-m-d',strtotime("+1 $intervalType"));
            $expTime = date('Y-m-d H:m:s',strtotime("+$intervals $intervalType"));
            
            
            $ID = $user['ID'];
            $query = "INSERT INTO `plan_subscription`(`USER_ID`,`PLAN_ROW_ID`, `STATUS`, `SUBSCRIPTION_ID`, `FIRST_CHARGE_DATE`, `EXPIRY_DATE`)
            VALUES ('$ID', '$plan_id', 'PENDING', '$sus_id', '$firstChargeDate', '$expTime')";
            $run_query = mysqli_query($con , $query);
            if($run_query){
                
                    $data = json_encode([
            "subscriptionId"=> $sus_id,
             "planId"=> "$TplanId",
             "customerName"=> "$name",
             "customerEmail"=> "$email",
             "customerPhone"=> "$mobile",
             "firstChargeDate"=>"$firstChargeDate",
             "authAmount"=> $amount,
             "expiresOn"=> "$expTime",
             "returnUrl"=> "https://paydeer.in/mobile_phone/signzy/plan_back.php",
             "subscriptionNote"=> "Subscription Plan for Paydeer",
             "notificationChannels"=> ["EMAIL", "SMS"]
            ]);
        
        $curl = curl_init();
        
        curl_setopt_array($curl, array(
          CURLOPT_URL => 'https://api.cashfree.com/api/v2/subscriptions',
          CURLOPT_RETURNTRANSFER => true,
          CURLOPT_RETURNTRANSFER => true,
          CURLOPT_ENCODING => '',
          CURLOPT_MAXREDIRS => 10,
          CURLOPT_TIMEOUT => 0,
          CURLOPT_FOLLOWLOCATION => true,
          CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
          CURLOPT_CUSTOMREQUEST => 'POST',
          CURLOPT_POSTFIELDS => $data,
          CURLOPT_HTTPHEADER => array(
            'X-Client-Id: 1727088087a9a5521e7e50f944807271',
            'X-Client-Secret: 84f47aa6540673dec8567f262a82ac87db88da76',
            'Content-Type: application/json'
          ),
        ));
        
        $res = curl_exec($curl);
        
        curl_close($curl);
        
                $con->query("INSERT INTO `API_HITLOG`(`USER_ID`, `SEVICE`, `TRANSACTION_ID`, `TOKEN`, `REQUEST_LOG`, `RESPONSE_LOG`)
        VALUES ('$ID','Plan Subsciption','$sus_id','Plan Subscription ','$data','$res')");
        
        $response = json_decode($res,true);
         if($response["status"] == 'OK'){
             
             $sql = "UPDATE user SET `SUBSCRIPTION`='$plan_id' WHERE MOBILE='$mobile' AND EMAIL = '$email' AND PASSWORD='$password'";
             $finalizationD =  mysqli_query($con, $sql);
             $resdata = json_encode(["status"=>true, "response_code"=>1,"message"=>$response["message"],"status"=>true, "receivableData"=>$response['authLink']]);
        
        
         }else if($response["status"] == 'ERROR'){
             
             $resdata = json_encode(["status"=>false, "response_code"=>3,"message"=>$response["message"],"status"=>false ,"receivableData"=>"Failed"]);
         
         }else{
             
             $resdata = json_encode(["status"=>false, "response_code"=>5,"message"=>"Server Internal Error Contact Admin..!","status"=>false, "receivableData"=>"Failed"]);
         }
         echo $resdata;        
     }
    else{
        
        $resdata = json_encode(["status"=>false, "response_code"=>6,"message"=>"Server Internal Error under Query Contact Admin..!","status"=>false, "receivableData"=>"Failed"]);     
        echo $resdata;
    }
}


?>