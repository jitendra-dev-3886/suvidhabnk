<?php
session_start();
include("../../../../Db/config.php");
include("../../Userinfo/getuserinfo.php");
include("../../Functions/all_function.php");
// include("../../Auth/userdata.php");
include("bbps_function.php"); // for use of GetOperators 

// error_reporting(E_ALL);
// ini_set("display_errors" , 1);


$reqID = generateRandomString();


if(isset($_POST['refid'])){
    $refid = $_POST['refid'];
    $opid = $_POST['opid'];
    $desc = $_POST['desc'];
    $desp = $_POST['desp'];
    
        $fetchreq = '<complaintRegistrationReq>
                        <complaintType>Transaction</complaintType>
                           <participationType />
                           <agentId />
                           <txnRefId>'.$opid.'</txnRefId>
                           <billerId />
                           <complaintDesc>'.$desc.'</complaintDesc>
                           <servReason />
                           <complaintDisposition>'.$desp.'</complaintDisposition> 
                        </complaintRegistrationReq>';
                    // echo $fetchreq;
                    
    $insert_report = "INSERT INTO `bbps_complains`(`REF_ID`, `OP_ID`, `COMPLAIN_ID`, `STATUS`, `SEND_DATA`) 
    VALUES ('$refid','$opid','','Pending','$fetchreq')";

                if($con->query($insert_report)){
                            // echo $fetchreq;
                            // exit;
                            
                            $url = "https://stgapi.billavenue.com/billpay/extComplaints/register/xml";
                            $response = calltoapi($url , $fetchreq , $reqID);
                            echo $response;
                              
                              $rstl = json_decode($response , true);
                              $rs_code = $rstl['responseCode']; 
                              $msg = $rstl['responseReason'];
                              $complaintId = $rstl['complaintId'];
                              

                      $con->query("update bbps_complains set RESPONSE='".str_replace("'" , "\'" , $response)."'  , COMPLAIN_ID='$complaintId'  where REF_ID='$refid' ");
                      if($rs_code == "000"){
                        $con->query("update pay_bill_api set COMPLAIN='YES' where REFFRENCE_ID='$refid' ");
                      }
                        
                            // echo json_encode(["refid"=> $reqID,"response"=> json_decode($response , true)]);
                            
            }
        else{
                echo json_encode(array("response_code"=>  500 , "message"=>"Some internel server error. We are fixing it"));
            }
}




if(isset($_POST['checkrefid'])){
    $ref_id = strip_tags($_POST['checkrefid']);
    // echo "wokr";
    $transaction = $con->query("select * from bbps_complains where COMPLAIN_ID='$ref_id'")->fetch_assoc();
    // if(strtolower($transaction['STATUS']) != "pending"){
    //     echo json_encode(array("status"=>false,"response_code"=>  500 , "message"=>"Status already checked."));
    //       exit;
    // }
    
    $fetchreq = '<complaintTrackingReq>
                     <complaintType>Transaction</complaintType>
                     <complaintId>'.$ref_id.'</complaintId>
                    </complaintTrackingReq>';
            
    // echo $fetchreq;
    // exit;
    
    $url = "https://stgapi.billavenue.com/billpay/extComplaints/track/xml";
//  echo $transaction['REF_ID'];
// exit;
    $response = calltoapi($url , $fetchreq , $reqID);
    
      $rstl = json_decode($response , true);
      $rs_code = $rstl['responseCode']; 
      $msg = $rstl['responseReason'];
      $complaintStatus = $rstl['complaintStatus'];
      
      if($rs_code == "000" && $complaintStatus != ""){
        $con->query("update bbps_complains set STATUS='$complaintStatus'  where COMPLAIN_ID='$ref_id' ");
      }
      
              
    echo $response;
    // echo json_encode(["refid"=> $opid,"response"=> json_decode($response , true)]);
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
        $con->query("update pay_bill_api set STATUS='$status',RESPONSE_CODE='$rs_code' ,  CHECK_RESPONSE='".str_replace("'" , "\'" , $response)."' , SEND_DATA='$fetchreq' , ACKNO='$akno' ,OPERATORID='$opid'  where REFFRENCE_ID='$ref_id' ");
      }
      
              
    echo $response;
    // echo json_encode(["refid"=> $opid,"response"=> json_decode($response , true)]);
}




?>