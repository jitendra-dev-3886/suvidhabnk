<?php

include("../includes/config.php");

$id = $_POST['user_id'];
$user_type = $_POST['user_type'];
$token_id = $_POST['token'];
$response  = array();
$mysql_qry = "select * FROM user WHERE ID ='$id' AND TOKEN_ID = '$token_id'";
$result = mysqli_query($con ,$mysql_qry);
if(mysqli_num_rows($result) > 0) {
    
}else{
    
    echo json_encode($response);
    return;
}



$date = date("Y-m-d");
$startDate = date('Y-m-d',strtotime("-1 week"));
$amount = 0;
$fromDate= $_POST['fromDate'];
$toDate= $_POST['toDate'];

if($fromDate != "" && $toDate != ""){

    $n = date('Y-m-d', strtotime( $toDate . " +1 days"));
    $startTime = $fromDate; 
    $endTime = $n;  
}
else{
    
$startTime = $startDate; 
$endTime = date('Y-m-d', strtotime("+1 day")); 
    
}

$begin = new DateTime($startTime);
$end = new DateTime($endTime);

$on_day = $_POST['on_day'];
$type = $_POST['type'];
$type_small = strtolower($_POST['type']);
$day_small = strtolower($_POST['on_day']);

$interval = DateInterval::createFromDateString('1 day');
$period = new DatePeriod($begin, $interval, $end);


if($type_small=="recharge"){
    
    foreach ($period as $dt) {
    $amount = 0;
    $curr =  $dt->format("Y-m-d");
    $recharge = $con->query("SELECT * FROM `recharge_transaction` WHERE USER_ID ='$id' AND TIMESTAMP LIKE '%$curr%' ORDER BY ID ASC");
    if($recharge->num_rows > 0){
        while($row = $recharge->fetch_assoc()){
            $small_value = strtolower($row['STATUS']);
            if (strpos($small_value, 'success') !== false || strpos($small_value, 'sucess') !== false) {
               $transaction++;
               $balance = $row["AMOUNT"];
               $amount = $amount+$balance;            
            }
        }
    }
    
        if($amount!=0){
            array_push($response,array("date"=>$curr,"amount"=>$amount));
        }
    }
    
    
}

else if($type_small=="bbps"){
    
    foreach ($period as $dt) {
    $amount = 0;
    $curr =  $dt->format("Y-m-d");
    
    $recharge = $con->query("SELECT * FROM `pay_bill_api` WHERE USER_ID ='$id' AND FILTER_DATE LIKE '%$curr%'  ORDER BY ID ASC");
    if($recharge->num_rows > 0){
        while($row = $recharge->fetch_assoc()){
            
            $small_value = strtolower($row['STATUS']);
            if (strpos($small_value, '1') !== false || strpos($small_value, 1) !== false) {
            
            $transaction++;
            $balance = $row["AMOUNT"];
            $amount = $amount+$balance;
            
            }
        }
    }
    
        if($amount!=0){
            array_push($response,array("date"=>$curr,"amount"=>$amount));
        }
    }

}

else if($type_small=="micro atm"){
    
    foreach ($period as $dt) {
    $amount = 0;
    $curr =  $dt->format("Y-m-d");
    
    $atm = $con->query("SELECT * FROM `micro_atm` WHERE USER_ID ='$id' AND DATE LIKE '%$curr%' ORDER BY ID ASC ");
    if($atm->num_rows > 0){
        while($row = $atm->fetch_assoc()){
            
            $small_value = strtolower($row['RESPONSE']);
            if (strpos($small_value, 'success') !== false || strpos($small_value, 'sucess') !== false) {
                $transaction++;
                $balance = $row["TRANSAMOUNT"];
                $amount = $amount+$balance;   
            }
        }
    }
    
        if($amount!=0){
            array_push($response,array("date"=>$curr,"amount"=>$amount));
        }
    }

}

else if($type_small=="aeps"){
    
    foreach ($period as $dt) {
    $amount = 0;
    $curr =  $dt->format("Y-m-d");
    
    $aeps = $con->query("SELECT * FROM `aeps_transactions` WHERE USER_ID ='$id' AND FILTER_DATE LIKE '%$curr%' ORDER BY ID ASC ");
    if($aeps->num_rows > 0){
        while($row = $aeps->fetch_assoc()){
            
            $small_value = strtolower($row['STATUS']);
            if (strpos($small_value, '1') !== false || strpos($small_value, 1) !== false) {
                $transaction++;
                $balance = $row["AMOUNT"];
                $amount = $amount+$balance;   
            }
        }
    }
    
        if($amount!=0){
            array_push($response,array("date"=>$curr,"amount"=>$amount));
        }
    }

}

else if($type_small=="dmt"){
    
    foreach ($period as $dt) {
    $amount = 0;
    $curr =  $dt->format("Y-m-d");
    
    $aeps = $con->query("SELECT * FROM `dmt_transactions` WHERE USER_ID ='$id' AND FILTER_DATE LIKE '%$curr%' ORDER BY ID ASC");
    if($aeps->num_rows > 0){
        while($row = $aeps->fetch_assoc()){
            
            $small_value = strtolower($row['STATUS']);
            if (strpos($small_value, 'success') !== false || strpos($small_value, 'sucess') !== false) {
              $transaction++;
              $balance = $row["AMOUNT"];
              $amount = $amount+$balance;
            }
        }
    }
    
        if($amount!=0){
            array_push($response,array("date"=>$curr,"amount"=>$amount));
        }
    }

}

else if($type_small=="all"){
    
 foreach ($period as $dt) {
    $amount = 0;
    $curr =  $dt->format("Y-m-d");
    $recharge = $con->query("SELECT * FROM `recharge_transaction` WHERE USER_ID ='$id' AND TIMESTAMP LIKE '%$curr%' ORDER BY ID ASC");
    if($recharge->num_rows > 0){
        while($row = $recharge->fetch_assoc()){
            $small_value = strtolower($row['STATUS']);
            if (strpos($small_value, 'success') !== false || strpos($small_value, 'sucess') !== false) {
               $transaction++;
               $balance = $row["AMOUNT"];
               $amount = $amount+$balance;            
            }
        }
    }
    
    $recharge = $con->query("SELECT * FROM `pay_bill_api` WHERE USER_ID ='$id' AND FILTER_DATE LIKE '%$curr%'  ORDER BY ID ASC");
    if($recharge->num_rows > 0){
        while($row = $recharge->fetch_assoc()){
            
            $small_value = strtolower($row['STATUS']);
            if (strpos($small_value, '1') !== false || strpos($small_value, 1) !== false) {
            
            $transaction++;
            $balance = $row["AMOUNT"];
            $amount = $amount+$balance;
            
            }
        }
    }
    
    
    $atm = $con->query("SELECT * FROM `micro_atm` WHERE USER_ID ='$id' AND DATE LIKE '%$curr%' ORDER BY ID ASC ");
    if($atm->num_rows > 0){
        while($row = $atm->fetch_assoc()){
            
            $small_value = strtolower($row['RESPONSE']);
            if (strpos($small_value, 'success') !== false || strpos($small_value, 'sucess') !== false) {
                $transaction++;
                $balance = $row["TRANSAMOUNT"];
                $amount = $amount+$balance;   
            }
        }
    }
    
    
    $aeps = $con->query("SELECT * FROM `aeps_transactions` USER_ID ='$id' AND WHERE FILTER_DATE LIKE '%$curr%' ORDER BY ID ASC ");
    if($aeps->num_rows > 0){
        while($row = $aeps->fetch_assoc()){
            
            $small_value = strtolower($row['STATUS']);
            if (strpos($small_value, '1') !== false || strpos($small_value, 1) !== false) {
                $transaction++;
                $balance = $row["AMOUNT"];
                $amount = $amount+$balance;   
            }
        }
    }
    
    $aeps = $con->query("SELECT * FROM `dmt_transactions` WHERE USER_ID ='$id' AND FILTER_DATE LIKE '%$curr%' ORDER BY ID ASC");
    if($aeps->num_rows > 0){
        while($row = $aeps->fetch_assoc()){
            
            $small_value = strtolower($row['STATUS']);
            if (strpos($small_value, 'success') !== false || strpos($small_value, 'sucess') !== false) {
              $transaction++;
              $balance = $row["AMOUNT"];
              $amount = $amount+$balance;
            }
        }
    }
    
    
    if($amount!=0){
        array_push($response,array("date"=>$curr,"amount"=>$amount));
    }
    
}   
}
echo json_encode($response);
return;

?>