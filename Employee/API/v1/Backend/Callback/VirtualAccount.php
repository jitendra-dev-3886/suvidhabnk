<?php
// error_reporting(0);
include("../../../Db/config.php");
include("../Userinfo/getuserinfo.php");
include("../Functions/all_function.php");
include("../VirtualAccount/functions.php");

// // Takes raw data from the request
// $json = file_get_contents('php://input');

// insert the data into db 
$data = $_POST;

$con->query("INSERT INTO `aeps_callback_rspns`(`RESPONSE`, `TIME`) VALUES ('".json_encode($data)."' , '".date("Y-m-d g:i:s A")."')");

  $signature = $_POST["signature"];
  unset($data["signature"]);
  // $data now has all the POST parameters except signature
  ksort($data);  // Sort the $data array based on keys
  $postData = "";
  
  foreach ($data as $key => $value){
    if (strlen($value) > 0) {
      $postData .= $value;
    }
  }
  $hash_hmac = hash_hmac('sha256', $postData, "8bcab1d5a9ec7814de14c2580b62b059d2992060", true) ;
  // Use the clientSecret from the oldest active Key Pair.
  $computedSignature = base64_encode($hash_hmac);
  if ($signature == $computedSignature) {
      extract($_POST);
    // Proceed based on $event 
    if($isVpa == "1"){
        $vadt = $con->query("select * from virtual_account where UPI='$virtualVpaId'  order by ID DESC LIMIT 1 ")->fetch_assoc(); 
        $type = "UPI";
    }
    else{
        $vadt = $con->query("select * from virtual_account where ACCOUNT_NUM='$vAccountNumber' and VA_ID='$vAccountId'  order by ID DESC LIMIT 1 ")->fetch_assoc(); 
        $type = "VA";
    }
    extract($vadt);
    $pretxn = $con->query("select * from virtual_acc_transactions where REF_ID='$referenceId' and UTR='$utr' ")->num_rows;
    if($pretxn == 0){
        $con->query("INSERT INTO `virtual_acc_transactions`(`USER_ID`, `REF_ID`, `AMOUNT`, `UTR`, `STATUS`, `RESPONSE`) VALUES ('$USER_ID','$referenceId','$amount','$utr','$event','".json_encode($_POST , true)."')");
        if($event == "AMOUNT_COLLECTED"){
            $usdata = $con->query("select * from user where ID='$USER_ID' ")->fetch_assoc();
            $updateBal = $usdata['MAIN_BAL'] + $amount;
            if($updateBal != ""){
                $con->query("update user set MAIN_BAL='$updateBal' where ID='$USER_ID'");
               insert_allreport($USER_ID  ,$referenceId , "Fund Added By $type" , $usdata['MAIN_BAL']  , $updateBal , $amount , "Credit" , "Account Transaction" , "MAIN");
               give_va_com($referenceId , $USER_ID ,$usdata['USER_TYPE'] , "VIRTUAL_ACCOUNT");
                //send sms of the txn
                $sndam = number_format($amount , 2);
                $usbl = number_format($updateBal , 2);
                $usermb = substr($usdata['MOBILE'] , 7 , 10);
                $mbmsg = urlencode("INR $sndam has been Credited from your Paydeer.in A/C No *******$usermb  towards Virtual Account Txn. $referenceId. Main Wallet Avl BAL is INR $usbl. Team PayDeer");
                $smsrs2 = json_decode(sendSMS($user['MOBILE'] , $mbmsg , 1307164568497787783) , true);
      
            }
        }
    }
  } else {
    echo "Invaild Request";
  }
  
  
  

?>