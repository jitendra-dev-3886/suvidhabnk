<?php
session_start();
include("../../../../Db/config.php");
include("../../Userinfo/getuserinfo.php");
include("../../Functions/all_function.php");
include("../../Auth/userdata.php");
include("bbps_function.php"); // for use of GetOperators 

error_reporting(E_ALL);
ini_set("display_errors" , 1);


$reqID = generateRandomString();


if(isset($_POST['billbillers'])){
    
    $mysql_qry = "SELECT * FROM `bill_Billers` order by ID DESC";
    
    $result = array();
        
    $op = $con->query("SELECT * FROM `bill_Billers` order by ID DESC");
    if($op->num_rows > 0){
     while($row = $op->fetch_assoc()){
        $row['RESPONSE'] = json_decode($row['RESPONSE'], true);
        array_push($result, $row);
     }
    }
    
    echo json_encode($result);
    exit();
}


if(isset($_POST['fetch_operator'])){
    //Passing the category value in this post;
    $service = $_POST['fetch_operator'];
    
    $billers = $con->query("SELECT * FROM `bill_Billers` where BILLER_ID='$service' order by ID DESC LIMIT 1");
    if($billers->num_rows == 0){
        $fetchreq = '<?xml version="1.0" encoding="UTF-8"?><billerInfoRequest><billerId>'.$service.'</billerId></billerInfoRequest>';
        // echo $reqID;
        $response = calltosimapi($fetchreq , $reqID);
        $rslt = json_decode($response , true);
        if($rslt['responseCode'] == "000"){
            $con->query("INSERT INTO `bill_Billers`(`BILLER_ID`, `RESPONSE`) VALUES ('$service','$response')");
        }
        echo $response;
    }
    else{
        $billersdt = $billers->fetch_assoc();
        echo $billersdt['RESPONSE'];
    }

    //  if($op_data != ""){
    //      echo json_encode(["response_code"=>1 , "message"=>"operator fetched" , "result" => $allOperator]);
    //   }
    //   else{
    //      echo json_encode(["response_code"=>500 , "message"=>"Error in fetching " , "result" => ""]);
    //   }
}

if(isset($_POST['fetchbill'])){
    $billid = $_POST['billerid'];
    
    $inputdt = $_POST['inputdata'];
    $indt="";
    foreach($inputdt as $input){
        if($input['prmval'] == ""){
                echo json_encode(["response_code"=>500 , "message"=>"Please enter ".$input['prmname']." Value." ]);               
              exit;
            break;
        }
        $indt .=" <input>
                     <paramName>". $input['prmname']."</paramName>
                     <paramValue>".$input['prmval']."</paramValue>
                  </input>";
    }
$fetchreq = "<billFetchRequest>
   <agentId>CC01CC01513515340681</agentId>
   <agentDeviceInfo>
      <ip>".$_SERVER['REMOTE_ADDR']."</ip>
      <initChannel>AGT</initChannel>
      <mac>01-23-45-67-89-ab</mac>
   </agentDeviceInfo>
   <customerInfo>
      <customerMobile>9898990084</customerMobile>
      <customerEmail></customerEmail>
      <customerAdhaar></customerAdhaar>
      <customerPan></customerPan>
   </customerInfo>
   <billerId>$billid</billerId>
   <inputParams>
           $indt
   </inputParams>
</billFetchRequest>";
            
    // echo $fetchreq;
    // exit;
    
    $url = "https://stgapi.billavenue.com/billpay/extBillCntrl/billFetchRequest/xml";

    $response = calltoapi($url , $fetchreq , $reqID);
    // echo $response;/
    echo json_encode(["refid"=> $reqID,"response"=> json_decode($response , true)]);
}



if(isset($_POST['check_status'])){
    $ref_id = $_POST['ref_id'];
    // echo "wokr";
    $transaction = $con->query("select * from pay_bill_api where REFFRENCE_ID='$ref_id'")->fetch_assoc();
    // if(strtolower($transaction['STATUS']) != "pending"){
    //     echo json_encode(array("status"=>false,"response_code"=>  500 , "message"=>"Status already checked."));
    //       exit;
    // }
    $opid =$transaction['OPERATORID'];
    
    $fetchreq = '<?xml version="1.0" encoding="UTF-8"?>
                    <transactionStatusReq>
                     <trackType>TRANS_REF_ID</trackType>
                     <trackValue>'.$opid.'</trackValue>
                    </transactionStatusReq>';
            
    // echo $fetchreq;
    // exit;
    
    $url = "https://stgapi.billavenue.com/billpay/transactionStatus/fetchInfo/xml";

    $response = calltoapi($url , $fetchreq , $opid);
    
      $rstl = json_decode($response , true);
      $rs_code = $rstl['responseCode']; 
      $msg = $rstl['responseReason'];
      $akno = $rstl['txnList']['approvalRefNumber'];
      $opid = $rstl['txnList']['txnReferenceId'];
      $status = $rstl['txnList']['txnStatus'];
      if($rs_code != "" && $status != ""){
        $con->query("update pay_bill_api set STATUS='$status',RESPONSE_CODE='$rs_code' ,  CHECK_RESPONSE='".str_replace("'" , "\'" , $response)."' , ACKNO='$akno' ,OPERATORID='$opid'  where REFFRENCE_ID='$ref_id' ");
      }
      
              
    echo $response;
    // echo json_encode(["refid"=> $opid,"response"=> json_decode($response , true)]);
}




?>