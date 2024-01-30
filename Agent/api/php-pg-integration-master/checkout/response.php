<?php
session_start();
include_once("../../../../Db/config.php");

include("../../../Backend/Userinfo/getuserinfo.php");
include("../../../Backend/Functions/all_function.php");
// $usid = $_SESSION['UsId'];
// $usid = 123;
// echo '<script type ="text/JavaScript">';  
// echo 'alert("'.$usid.'")';  
// echo '</script>'; 
include("function.php");
// error_reporting(E_ALL);
// ini_set("display_errors" , 1);
// exit;
$secretkey = "ce6d2be6d1c250f8c77b727abcc1839e3696b98c";
// 		 $secretkey = "03aad79a42df46d8e0145c5b1ff76512ec3440ec";
 $orderId = $_POST["orderId"];
 $orderAmount = $_POST["orderAmount"];
 $referenceId = $_POST["referenceId"];
 $txStatus = $_POST["txStatus"];
 $paymentMode = $_POST["paymentMode"];
 $txMsg = $_POST["txMsg"];
 $txTime = $_POST["txTime"];
 $signature = $_POST["signature"];
 $data = $orderId.$orderAmount.$referenceId.$txStatus.$paymentMode.$txMsg.$txTime;
 $hash_hmac = hash_hmac('sha256', $data, $secretkey, true) ;
 $computedSignature = base64_encode($hash_hmac);

?>



<!DOCTYPE html>
<html>
<head>
	<title>Cashfree - PG Response Details</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
<body>
	<h1 align="center">Response</h1>
	<!--<h1 align="center">PG Response</h1>-->

	<?php  
		 if ($signature == $computedSignature) {
                $data_wallet_cashfree=$con->query("select * from wallet_cashfree where ORDER_ID='$orderId'")->fetch_assoc();
                $user_id = $data_wallet_cashfree['USER_ID'];
                $_SESSION['UsId'] = $data_wallet_cashfree['USER_ID'];
                
                $userdet=$con->query("select * from user where ID='".$data_wallet_cashfree['USER_ID']."'")->fetch_assoc();
                $_SESSION["Token"] = $userdet['TOKEN_ID'];
                
                

        	 	
        if($data_wallet_cashfree['TRANSACTION_STATUS'] != "Pending"){
            echo '<h1>Txn already completed Click to go back. <a href="https://suvidhabnk.com/Agent/">Click Here</a></h1>';
            exit;
        }

                if($txStatus =='SUCCESS'){
                
                    $new_bal=$userdet['MAIN_BAL']+$data_wallet_cashfree['ORDER_AMOUNT'];
                    
                    $up_us_main=$con->query("update user set `MAIN_BAL`='$new_bal' where `ID`='$user_id'");
                    insert_allreport($user_id  ,$orderId , "Wallet Add"  ,$userdet['MAIN_BAL'] , $new_bal , $data_wallet_cashfree['ORDER_AMOUNT'] ,  "Credit" , "Wallet Add Transaction Commission" , "MAIN");
                
                    
                    switch($paymentMode){
                        case $paymentMode == "CREDIT_CARD": $ser="walletcreditcard";
                        break;
                        case ($paymentMode == "PREPAID_CARD" || $paymentMode == "DEBIT_CARD") : $ser="walletdebitcard";
                        break;
                        case $paymentMode == "NET_BANKING" : $ser="walletnetbanking";
                        break;
                        case ($paymentMode == "Wallet" || $paymentMode == "JioMoney"|| $paymentMode == "olaMoney"|| $paymentMode == "AIRTEL_MONEY"|| $paymentMode == "MobiKwik"|| $paymentMode == "FreeCharge") : $ser="walletwallet";
                        break;
                        default : $ser="";
                        break;
                    }
                    if($ser != ""){
                        givecom($orderId , $user_id , 46 , $ser);
                    }
                    
                }
                
                $update_wallet_cashfree=$con->query("update `wallet_cashfree` set `REFERENCE_ID`='$referenceId', `TRANSACTION_STATUS`='$txStatus', `PAYMENT_MODE`='$paymentMode' ,`MESSAGE`='$txMsg',`TRANSACTION_TIME`='$txTime',`PREVIOUS_BALANACE`='$user_main',`CLOSING_BALANACE`='$new_bal' where `ORDER_ID`='$orderId'");


	 ?>
	<div class="container"> 
	<div class="panel panel-success">
	  <div class="panel-heading">Signature Verification Successful</div>
	  <div class="panel-body">
	  	<!-- <div class="container"> -->
	 		<table class="table table-hover">
			    <tbody>
			      <tr>
			        <td>Order ID</td>
			        <td><?php echo $orderId; ?></td>
			      </tr>
			      <tr>
			        <td>Order Amount</td>
			        <td><?php echo $orderAmount; ?></td>
			      </tr>
			      <tr>
			        <td>Reference ID</td>
			        <td><?php echo $referenceId; ?></td>
			      </tr>
			      <tr>
			        <td>Transaction Status</td>
			        <td><?php echo $txStatus; ?></td>
			      </tr>
			      <tr>
			        <td>Payment Mode </td>
			        <td><?php echo $paymentMode; ?></td>
			      </tr>
			      <tr>
			        <td>Message</td>
			        <td><?php echo $txMsg; ?></td>
			      </tr>
			      <tr>
			        <td>Transaction Time</td>
			        <td><?php echo $txTime; ?></td>
			      </tr>
			    </tbody>
			</table>
		<!-- </div> -->

	   </div>
	</div>
	 Go to Dashboard <a href="https://suvidhabnk.com/Agent/">Click Here</a>
	</div>
	 <?php   
	  	} else {
	 
	 ?>
	  <div class="panel-heading">Signature Verification failed</div>
    	Go to Dashboard <a href="https://suvidhabnk.com/Agent/">Click Here</a>
    	</div>
	<?php	
	 	}
        $con->query("INSERT INTO `API_HITLOG`(`USER_ID`, `SEVICE`, `TRANSACTION_ID`, `TOKEN`, `REQUEST_LOG`, `RESPONSE_LOG`) VALUES ('$user_id','Cashfree','$orderId','$token','$main_body','".json_encode($_POST , true)."')");


?>




</body>
</html>



