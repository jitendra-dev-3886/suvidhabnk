<?php
    
include("../../../Db/config.php");
include("../Userinfo/getuserinfo.php");
include("../Functions/all_function.php");

$json = file_get_contents('php://input');
$information = json_decode($json, true);
    
$status = $information['data']['payment']['payment_status'];
$order_id = $information['data']['order']['order_id'];

    
if($json!="" || $json!=null){

        $insert_report = "INSERT INTO `plan_callback`(`RESPONSE`) VALUES ('$json')";
        $con->query($insert_report);
}
    
    
    
if($status == "SUCCESS"){
        
    $mysql_qry = "select * FROM wallet_cashfree WHERE `ORDER_ID`='$order_id' AND `TRANSACTION_STATUS`='Pending'  ORDER BY ID DESC LIMIT 1";
    $result = mysqli_query($con ,$mysql_qry);
    if(mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_array($result);
        $usid = $row['USER_ID'];
        
        orderStatus($usid, $order_id);
        
    }    
}

function orderStatus($user_id, $reference_id){
    global $con;
    
    
    $curl = curl_init();
    curl_setopt_array($curl, array(
      CURLOPT_URL => 'https://api.cashfree.com/pg/orders/'.$reference_id,
      CURLOPT_RETURNTRANSFER => true,
      CURLOPT_ENCODING => '',
      CURLOPT_MAXREDIRS => 10,
      CURLOPT_TIMEOUT => 0,
      CURLOPT_FOLLOWLOCATION => true,
      CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
      CURLOPT_CUSTOMREQUEST => 'GET',
      CURLOPT_HTTPHEADER => array(
        'x-client-id: 218328201f9655106e2614470e823812',
        'x-client-secret: ce6d2be6d1c250f8c77b727abcc1839e3696b98c',
        'x-api-version: 2022-01-01'
      ),
    ));
    
    $response = curl_exec($curl);
    curl_close($curl);
    $dataRecived = json_decode($response, true);
    
        $status = "FAILED";
        if(strpos(strtolower($dataRecived['order_status']), 'paid') !== false){
            
            
            $status = "SUCCESS";
            
            
            $addData = $con->query("SELECT * FROM `wallet_cashfree` WHERE USER_ID='$user_id' AND ORDER_ID='$reference_id' AND TRANSACTION_STATUS ='$status' ORDER BY ID DESC LIMIT 1")->fetch_assoc();
            $amount = $addData['ORDER_AMOUNT'];
            $user = $con->query("SELECT * FROM `user` WHERE ID='$user_id'")->fetch_assoc();
            $old_bal = $user['MAIN_BAL'];
            $us_bal  = $user['MAIN_BAL']+$amount;
            $con->query("update user set MAIN_BAL='$us_bal' where ID='$user_id'");
            $sql = "UPDATE wallet_cashfree SET `TRANSACTION_STATUS`='$status', `PREVIOUS_BALANACE`='$old_bal', `CLOSING_BALANACE`='$us_bal' WHERE USER_ID='$user_id' AND ORDER_ID='$reference_id' ORDER BY ID DESC LIMIT 1";
            $finalizationD =  mysqli_query($con, $sql);
            insert_allreport($user_id  ,$reference_id , "Add Fund (Cashfree)" , $old_bal  , $us_bal , $amount , "Credit" , "Add Fund Transaction (CashFree)");
        }
        
    }

?>