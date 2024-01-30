<?php
session_start();
include("../../../../Db/config.php");
include("../../Userinfo/getuserinfo.php");
include("../../Functions/all_function.php");
include("../../Auth/userdata.php");
include("bbps_function.php"); // for use of GetOperators 

$json = file_get_contents('php://input');
$postedData = json_decode($json, true);
if($json !=null && $json !="" && $postedData !=null && $postedData !="" ){
    extract($postedData);
}



// error_reporting(E_ALL);
// ini_set("display_errors" , 1);

 function array2xmladd( $array, $xml = false , $root="billFetchResponse") {

    // Test if iteration
    if ( $xml === false ) {
      $xml = new SimpleXMLElement('<'.$root.'/>');
    }
    
    // Loop through array
    // echo "fun \n";
    $i=0;
    foreach( $array as $key => $value ) {
        // echo $i."\n";
        if($i == 0 && !is_int($key)){
            $subel = $key;
        }
        else{
            $subel = "info";
        }
        // Another array? Iterate
        if ( is_array( $value ) ) {
            if(is_int($key)){
              array2xmladd( $value, $xml->addChild("$subel") );
            }
            else{
              array2xmladd( $value, $xml->addChild("removeit") );
            }
        } else {
          $xml->addChild( $key, $value );
        }
        $i++;
    }
    
    // echo "funend \n";
    // Return XML
    $old = ["<removeit>", "</removeit>"];
    $new   = ["", ""];

    return str_replace($old,$new, explode("\n", $xml->asXML(), 2)[1]);
    // return $xml->asXML();
}

 function array2xmlbll( $array, $xml = false , $root="billFetchResponse") {

    // Test if iteration
    if ( $xml === false ) {
      $xml = new SimpleXMLElement('<'.$root.'/>');
    }
    
    // Loop through array
    // echo "fun \n";
    $i=0;
    foreach( $array as $key => $value ) {
        // echo $key."\n";
        if(!is_int($key)){
            $subel = $key;
        }
        else{
            $subel = "option";
        }
        
        // Another array? Iterate
        if ( is_array( $value ) ) {
            if(is_int($key)){
                // echo $key;
              array2xmlbll( $value, $xml->addChild("$subel") );
            }
            else{
              array2xmlbll( $value, $xml->addChild($key) );
            }
        }
        else {
          $xml->addChild( $key, $value );
        }
        $i++;
    }
    
    // echo "funend \n";
    // Return XML
    $old = ["<removeit>", "</removeit>" , "<amountOptions><option>" , "</option></amountOptions>"];
    $new   = ["", "" , "<amountOptions>" , "</amountOptions>" ];

    return str_replace($old,$new, explode("\n", $xml->asXML(), 2)[1]);
    // return $xml->asXML();
}

$reqID = generateRandomString();

if(isset($_POST['paybill']) || $paybill =="paybill"){
    
    
    $billid = $_POST['billerid'];
    if($billid == ""){
        $billid = $billerid;
    }
    $inputdt = $_POST['inputdata'];
    if($inputdt == ""){
        $inputdt = $inputdata;
    }
    if($billfetchrefid == ""){
        $billfetchrefid = $_POST['billfetchrefid'];
    }
    
    if($opname == ""){
        $opname = $_POST['op_name'];
    }
    if($category == ""){
        $category = $_POST['category'];
    }
    
    $billdtjson = $_POST['billdata'];
    if($billdtjson == ""){
        $billdtjson = $billdata;
    }
    else{
        $billdata = json_decode($billdtjson , true);
    }
    // $bill_amt = $billdata['response']['billerResponse']['billAmount'];
    // $amount = number_format($billdata['response']['billerResponse']['billAmount'] / 100, 2, '.', '');
    
    if($_POST['customAmount']!=""){
        $customAmount = $_POST['customAmount'];
    }
    
    if($customAmount == ""){
        $amount = $billdata['response']['billerResponse']['billAmount'];
    }else{
        $amount = $customAmount;
        $amount = $amount*100;
    }
    

    $indt="";
    foreach($inputdt as $input){
        if($input['prmval'] == ""){
                
                $msg = "Please enter ".$input['prmname']." Value.";
                echo '{"refid":"","response":{"responseCode":"001","errorInfo":{"error":{"errorCode":"E136","errorMessage":"'.$msg.'"}}}}';
                exit;
            
                // echo json_encode(["response_code"=>500 , "message"=>"Please enter ".$input['prmname']." Value." ]);               
            //   exit;
            break;
        }
        $indt .=" <input>
                     <paramName>". $input['prmname']."</paramName>
                     <paramValue>".$input['prmval']."</paramValue>
                  </input>";
    }
    
    
    $additional = $billdata['response']['additionalInfo'];
    if($additional == "" || $additional == null){
        $additional = $additionalInfo;
    }
    
    // print_r($additional);
    
    // echo json_encode($additional);
    
    $billerResponse = $billdata['response']['billerResponse'];
    if($billerResponse == "" || $billerResponse == null){
        $billerResponse = $billerResponse;
    }
    
    
    
    
    $billerResponsexml = array2xmlbll($billerResponse, false , 'billerResponse');
    // $additionalxml = array2xmladd( $additional, false  , 'additionalInfo');
    
    foreach($additional as $input){
        $additionalxml .=" <info>
                     <infoName>". $input['infoName']."</infoName>
                     <infoValue>".$input['infoValue']."</infoValue>
                  </info>";
    }
    
    // $additionalxml = arrayToXml( $additional);
    // print_r($additionalxml);
    // exit;
    
    
$fetchreq = '<?xml version="1.0" encoding="UTF-8"?>
<billPaymentRequest>
    <agentId>CC01AC14AGTU00000001</agentId>
    <billerAdhoc>true</billerAdhoc>
     <agentDeviceInfo>
      <ip>'.$_SERVER['REMOTE_ADDR'].'</ip>
      <initChannel>AGT</initChannel>
      <mac>01-23-45-67-89-ab</mac>
     </agentDeviceInfo>
   <customerInfo>
      <customerMobile>'.$user['MOBILE'].'</customerMobile>
      <customerEmail></customerEmail>
      <customerAdhaar></customerAdhaar>
      <customerPan></customerPan>
   </customerInfo>
    <billerId>'.$billid.'</billerId>
   <inputParams>
            '.$indt.'
   </inputParams>
        '.$billerResponsexml.'
      <additionalInfo> '.$additionalxml.' </additionalInfo>
    <amountInfo>
        <amount>'.$amount.'</amount>
        <currency>356</currency>
        <custConvFee>0</custConvFee>
        <amountTags></amountTags>
    </amountInfo>
    
    <paymentMethod>
        <paymentMode>Cash</paymentMode>
        <quickPay>N</quickPay>
        <splitPay>N</splitPay>
    </paymentMethod>
    <paymentInfo>
        <info>
            <infoName>Remarks</infoName>
            <infoValue>Received</infoValue>
        </info>
    </paymentInfo>
</billPaymentRequest>';
            
            
    // echo $fetchreq;
    // exit;
        
// validation of user tpin
// $userPin = $con->query("select * from tpin where USER_ID='$usid' AND STATUS='active'");

// if($userPin->num_rows == 0){
//           echo json_encode(array("response_code"=>  400 , "message" => "Your M-Pin is Blank. Please set tpin first then continue the transaction."));
//              exit;
//         }
//         else{
//             $pinData =$userPin->fetch_assoc();
//             $Tpin = $pinData['TPIN'];
//             if($Tpin == ""){
//               echo json_encode(array("response_code"=>  400 , "message" => "Your M-Pin is Blank. Please set tpin first then continue the transaction."));
//               exit;
//             }
//             if($Tpin != $tpin){
//               echo json_encode(array("response_code"=>  400 , "message" => "Your M-Pin is wrong. Please try again later. 3 Unsuccessfull attemps will temporarily block your account."));
//               exit;
//             }
//         }
//  $billfetchrefid =  "NSD".date("Ymd").mt_rand(999 , 9999);
    
$amount = $amount/100;            
$user_bal = $user['MAIN_BAL']-$amount;
if($user_bal >= 0){
    $insert_report = "INSERT INTO `pay_bill_api`(`MESSAGE`, `FETCH_RESPONSE` ,  `STATUS`, `SEND_DATA` ,`CATEGORY`, `OP_NAME`, `TIMESTAMP` , `RESPONSE_CODE`, `RESPONSE`,`OPERATORID`, `ACKNO` , `USER_ID` , `REFFRENCE_ID` , `CA_NUM` , `OPERATOR` ,`AMOUNT`, `MODE` , `FILTER_DATE`) VALUES 
('' ,'$billdtjson', 'Pending', '$fetchreq' ,'$category' ,'$opname' ,'".date("g:i:s A")."' ,'','','', '',  '$usid' , '$billfetchrefid'  ,'$canumber'  , '$billid' , '$amount' , 'ONLINE' , '".date("Y-m-d")."')";
    
    
        $deduct_bal = "update user set MAIN_BAL='$user_bal' where ID='$usid'";
        if($con->query($insert_report) && $con->query($deduct_bal) ){
            
          $url = "https://api.billavenue.com/billpay/extBillPayCntrl/billPayRequest/xml";
          $response = calltoapi($url , $fetchreq , $billfetchrefid);
          echo $response;
          $con->query("INSERT INTO `API_HITLOG`(`USER_ID`, `SEVICE`, `TRANSACTION_ID`, `TOKEN`, `REQUEST_LOG`, `RESPONSE_LOG`) VALUES ('$usid','BILLBBPS','$billfetchrefid','$tkn','$fetchreq','$response')");
          
          $rstl = json_decode($response , true);
              $rs_code = $rstl['responseCode']; 
              $msg = $rstl['responseReason'];
              $akno = $rstl['approvalRefNumber'];
              $opid = $rstl['txnRefId'];
              
                
              if($rs_code == "000"){
                  $st = "Success";
                insert_allreport($usid  ,$billfetchrefid , "BBPS" , $user['MAIN_BAL']  , $user_bal , $amount , "Debit" , "BBPS Transaction" , "MAIN");
                
                give_bbps_com($billfetchrefid , $usid ,$ustypeid , strtoupper(str_replace(" " , "" ,$category)));
              }
              else{
                  $st = "Failed";
              }
              
              $con->query("update pay_bill_api set STATUS='$st',RESPONSE_CODE='$rs_code' ,  RESPONSE='".str_replace("'" , "\'" , $response)."' , ACKNO='$akno' ,OPERATORID='$opid'  where REFFRENCE_ID='$billfetchrefid' ");
              if($rs_code != 000){
                  $con->query("update user set MAIN_BAL='".$user['MAIN_BAL']."' where ID='$usid' ");
              }
    //{"responseCode":"000","responseReason":"Successful","txnRefId":"CC012306BAAE00029095","requestId":"8Q4318RK8ITGB1XU3ED7TERZXCZZ2TM2IRB","approvalRefNumber":"12345037","txnRespType":"FORWARD TYPE RESPONSE","inputParams":{"input":[{"paramName":"a","paramValue":"10"},{"paramName":"a b","paramValue":"20"},{"paramName":"a b c","paramValue":"30"},{"paramName":"a b c d","paramValue":"40"},{"paramName":"a b c d e","paramValue":"50"}]},"CustConvFee":"0","RespAmount":"100000","RespBillDate":"2016-07-01","RespBillNumber":"12303037","RespBillPeriod":"Jul","RespCustomerName":"Ashish","RespDueDate":"2016-07-30"}

        }
        else{
            echo json_encode(array("status"=>false,"response_code"=>  500 , "message"=>"Internel Server Error."));
        }
    }
    else{
        echo json_encode(array("status"=>false, "response_code"=>  400 , "message"=>"You have not sufficient balance.. Please add balance."));
    }
    
}


?>