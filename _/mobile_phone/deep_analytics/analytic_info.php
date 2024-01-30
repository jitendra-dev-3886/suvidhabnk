<?php
$date = date("Y-m-d");
$last_date = date('Y-m-d',strtotime("-1 days"));

$last_week = date('Y-m-d',strtotime("-1 week"));

$last_week_last = date('Y-m-d',strtotime("-2 week"));

$last_month = date('Y-m-d',strtotime("-1 month"));

$last_month_last = date('Y-m-d',strtotime("-2 month"));



$id = $_POST['user_id'];
$on_day = $_POST['on_day'];
$type = $_POST['type'];
$type_small = strtolower($_POST['type']);
$day_small = strtolower($_POST['on_day']);
$user_type = $_POST['user_type'];
$token_id = $_POST['token'];

$amount = 0;
$earning = 0;
$transaction = 0;


$amount_last = 0;
$earning_last = 0;
$transaction_last = 0;

include("../includes/config.php");
$mysql_qry = "select * FROM user WHERE ID ='$id' AND TOKEN_ID = '$token_id'";
$result = mysqli_query($con ,$mysql_qry);
if(mysqli_num_rows($result) > 0) {
    
}else{
    
    $rs = json_encode(array("message"=>"Session Expired", "response_code"=>999, "status"=>false));
    echo $rs;
    return;
}


    if($day_small=="daily"){
        
        $dateConditionDate .= " AND DATE LIKE '%$date%' ";
        $dateConditionLastDate .= " AND DATE LIKE '%$last_date%' ";
        
        
        $dateConditionTimeStamp .= " AND TIMESTAMP LIKE '%$date%' ";
        $dateConditionLastTimeStamp .= " AND TIMESTAMP LIKE '%$last_date%' ";
        
    
        $dateConditionTime .= " AND TIME LIKE '%$date%' ";
        $dateConditionLastTime .= " AND TIME LIKE '%$last_date%' ";
        
        
        
        $dateConditionFilterDate .= " AND FILTER_DATE LIKE '%$date%' ";
        $dateConditionLastFilterDate .= " AND FILTER_DATE LIKE '%$last_date%' ";
        
        
    }
    
    if($day_small=="weekly"){
        
        $dateConditionDate .= " AND DATE BETWEEN '$last_week%' AND '$date%' ";
        $dateConditionLastDate .= " AND DATE BETWEEN '$last_week_last%' AND '$last_week%' ";
        
        
    
        $dateConditionTimeStamp .= " AND TIMESTAMP BETWEEN '$last_week%' AND '$date%' ";
        $dateConditionLastTimeStamp .= " AND TIMESTAMP BETWEEN '$last_week_last%' AND '$last_week%' ";
        
    
        $dateConditionTime .= " AND TIME BETWEEN '$last_week%' AND '$date%' ";
        $dateConditionLastTime .= " AND TIME BETWEEN '$last_week_last%' AND '$last_week%' ";
        
        
        
        $dateConditionFilterDate .= " AND FILTER_DATE BETWEEN '$last_week%' AND '$date%' ";
        $dateConditionLastFilterDate .= " AND FILTER_DATE BETWEEN '$last_week_last%' AND '$last_week%' ";
    
        
        
    }
    
    if($day_small=="monthly"){
        
        $dateConditionDate .= " AND DATE BETWEEN '$last_month%' AND '$date%' ";
        $dateConditionLastDate .= " AND DATE BETWEEN '$last_month_last%' AND '$last_month%' ";
        
        
        $dateConditionTimeStamp .= " AND TIMESTAMP BETWEEN '$last_month%' AND '$date%' ";
        $dateConditionLastTimeStamp .= " AND TIMESTAMP BETWEEN '$last_month_last%' AND '$last_month%' ";
        
    
        $dateConditionTime .= " AND TIME BETWEEN '$last_month%' AND '$date%' ";
        $dateConditionLastTime .= " AND TIME BETWEEN '$last_month_last%' AND '$last_month%' ";
        
        
        
        $dateConditionFilterDate .= " AND FILTER_DATE BETWEEN '$last_month%' AND '$date%' ";
        $dateConditionLastFilterDate .= " AND FILTER_DATE BETWEEN '$last_month_last%' AND '$last_month%' ";
        
    
        
    }


if($type_small=="recharge"){
    
    //current
    $recharge = $con->query("SELECT * FROM `recharge_transaction` WHERE USER_ID ='$id' ".$dateConditionTimeStamp." AND USER_TYPE='$user_type'");
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
    
    $comm = $con->query("SELECT * FROM `commission_report` WHERE USER_ID ='$id' AND USER_TYPE='$user_type' ".$dateConditionTime." AND SERVICE LIKE '%recharge%'");
    if($comm->num_rows > 0){
        while($row = $comm->fetch_assoc()){
            $earning_balance = $row["COMMISSION"];
            $earning = $earning+$earning_balance;
        }
    }
    
    
    //last
    
    $recharge = $con->query("SELECT * FROM `recharge_transaction` WHERE USER_ID ='$id' ".$dateConditionLastTimeStamp." AND USER_TYPE='$user_type'");
    if($recharge->num_rows > 0){
        while($row = $recharge->fetch_assoc()){

            $small_value = strtolower($row['STATUS']);
            if (strpos($small_value, 'success') !== false || strpos($small_value, 'sucess') !== false) {
            $transaction_last++;
            $balance = $row["AMOUNT"];
            $amount_last = $amount_last+$balance;          
            
            }
        
        }
    }
    
    $comm = $con->query("SELECT * FROM `commission_report` WHERE USER_ID ='$id' AND USER_TYPE='$user_type' ".$dateConditionLastTime." AND SERVICE LIKE '%recharge%'");
    if($comm->num_rows > 0){
        while($row = $comm->fetch_assoc()){
            $earning_balance = $row["COMMISSION"];
            $earning_last = $earning_last+$earning_balance;
        }
    }

}
else if($type_small=="bbps"){
    
    //current
    $recharge = $con->query("SELECT * FROM `pay_bill_api` WHERE ".$dateConditionFilterDate." AND USER_ID ='$id'");
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
    
    //last
    $recharge = $con->query("SELECT * FROM `pay_bill_api` WHERE ".$dateConditionLastFilterDate." AND USER_ID ='$id'");
    if($recharge->num_rows > 0){
        while($row = $recharge->fetch_assoc()){
            
            $small_value = strtolower($row['STATUS']);
            if (strpos($small_value, '1') !== false || strpos($small_value, 1) !== false) {
                
            $transaction_last++;
            $balance = $row["AMOUNT"];
            $amount_last = $amount_last+$balance;          
            
            }
        }
    }
    
    $comm = $con->query("SELECT * FROM `commission_report` WHERE USER_ID ='$id' AND USER_TYPE='$user_type' ".$dateConditionTime." AND SERVICE LIKE '%bbps%'");
    if($comm->num_rows > 0){
        while($row = $comm->fetch_assoc()){
            $earning_balance = $row["COMMISSION"];
            $earning = $earning+$earning_balance;
        }
    }
    
    
    
    
    $comm = $con->query("SELECT * FROM `commission_report` WHERE USER_ID ='$id' AND USER_TYPE='$user_type' ".$dateConditionLastTime." AND SERVICE LIKE '%bbps%'");
    if($comm->num_rows > 0){
        while($row = $comm->fetch_assoc()){
            $earning_balance = $row["COMMISSION"];
            $earning_last = $earning_last+$earning_balance;
        }
    }
    
}

else if($type_small=="micro atm"){
    
    $atm = $con->query("SELECT * FROM `micro_atm` WHERE USER_ID ='$id' ".$dateConditionDate." AND USER_TYPE='$user_type' ");
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
    
    $atm = $con->query("SELECT * FROM `micro_atm` WHERE USER_ID ='$id' ".$dateConditionLastDate." AND USER_TYPE='$user_type' ");
    if($atm->num_rows > 0){
        while($row = $atm->fetch_assoc()){
            
            $small_value = strtolower($row['RESPONSE']);
            if (strpos($small_value, 'success') !== false || strpos($small_value, 'sucess') !== false) {
               $transaction_last++;
               $balance = $row["TRANSAMOUNT"];
               $amount_last = $amount_last+$balance;  
            }
        }
    }
    
    
    $comm = $con->query("SELECT * FROM `commission_report` WHERE USER_ID ='$id' AND USER_TYPE='$user_type' ".$dateConditionTime." AND SERVICE LIKE '%atm%'");
    if($comm->num_rows > 0){
        while($row = $comm->fetch_assoc()){
            $earning_balance = $row["COMMISSION"];
            $earning = $earning+$earning_balance;
        }
    }
    
    
    //last
    $comm = $con->query("SELECT * FROM `commission_report` WHERE USER_ID ='$id' AND USER_TYPE='$user_type' ".$dateConditionLastTime." AND SERVICE LIKE '%atm%'");
    if($comm->num_rows > 0){
        while($row = $comm->fetch_assoc()){
            $earning_balance = $row["COMMISSION"];
            $earning_last = $earning_last+$earning_balance;
        }
    }
    
    
}

else if($type_small=="aeps"){
    $aeps = $con->query("SELECT * FROM `aeps_transactions` WHERE USER_ID ='$id' ".$dateConditionFilterDate." AND USER_TYPE='$user_type' ");
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
    
    $aeps = $con->query("SELECT * FROM `aeps_transactions` WHERE USER_ID ='$id' ".$dateConditionLastFilterDate." AND USER_TYPE='$user_type' ");
    if($aeps->num_rows > 0){
        while($row = $aeps->fetch_assoc()){
            
            $small_value = strtolower($row['STATUS']);
            if (strpos($small_value, '1') !== false || strpos($small_value, 1) !== false) {
                $transaction_last++;
                $balance = $row["AMOUNT"];
                $amount_last = $amount_last+$balance;  
            }
        }
    }
    
    $comm = $con->query("SELECT * FROM `commission_report` WHERE USER_ID ='$id' AND USER_TYPE='$user_type' ".$dateConditionTime." AND SERVICE LIKE '%aeps%'");
    if($comm->num_rows > 0){
        while($row = $comm->fetch_assoc()){
            $earning_balance = $row["COMMISSION"];
            $earning = $earning+$earning_balance;
        }
    }
    
    
    //Last
    
    
    $comm = $con->query("SELECT * FROM `commission_report` WHERE USER_ID ='$id' AND USER_TYPE='$user_type' ".$dateConditionLastTime." AND SERVICE LIKE '%aeps%'");
    if($comm->num_rows > 0){
        while($row = $comm->fetch_assoc()){
            $earning_balance = $row["COMMISSION"];
            $earning_last = $earning_last+$earning_balance;
        }
    }
    
    
}

else if($type_small=="dmt"){
    
    $aeps = $con->query("SELECT * FROM `dmt_transactions` WHERE USER_ID ='$id' ".$dateConditionFilterDate." AND USER_TYPE='$user_type' ");
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
    
    $aeps = $con->query("SELECT * FROM `dmt_transactions` WHERE USER_ID ='$id' ".$dateConditionLastFilterDate." AND USER_TYPE='$user_type' ");
    if($aeps->num_rows > 0){
        while($row = $aeps->fetch_assoc()){
            
            $small_value = strtolower($row['STATUS']);
            if (strpos($small_value, 'success') !== false || strpos($small_value, 'sucess') !== false) {
                $transaction_last++;
                $balance = $row["AMOUNT"];
                $amount_last = $amount_last+$balance;
            }
        }
    }
    
    $comm = $con->query("SELECT * FROM `commission_report` WHERE USER_ID ='$id' AND USER_TYPE='$user_type' ".$dateConditionTime." AND SERVICE LIKE '%dmt%'");
    if($comm->num_rows > 0){
        while($row = $comm->fetch_assoc()){
            $earning_balance = $row["COMMISSION"];
            $earning = $earning+$earning_balance;
        }
    }
    
    
    //Last
    
    
    $comm = $con->query("SELECT * FROM `commission_report` WHERE USER_ID ='$id' AND USER_TYPE='$user_type' ".$dateConditionLastTime." AND SERVICE LIKE '%dmt%'");
    if($comm->num_rows > 0){
        while($row = $comm->fetch_assoc()){
            $earning_balance = $row["COMMISSION"];
            $earning_last = $earning_last+$earning_balance;
        }
    }

}

else if($type_small=="all"){
    
    //current
    $recharge = $con->query("SELECT * FROM `recharge_transaction` WHERE USER_ID ='$id' ".$dateConditionTimeStamp." AND USER_TYPE='$user_type'");
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
    
    $recharge = $con->query("SELECT * FROM `recharge_transaction` WHERE USER_ID ='$id' ".$dateConditionLastTimeStamp." AND USER_TYPE='$user_type'");
    if($recharge->num_rows > 0){
        while($row = $recharge->fetch_assoc()){

            $small_value = strtolower($row['STATUS']);
            if (strpos($small_value, 'success') !== false || strpos($small_value, 'sucess') !== false) {
            $transaction_last++;
            $balance = $row["AMOUNT"];
            $amount_last = $amount_last+$balance;          
            
            }
        
        }
    }
    
    
    //current
    $recharge = $con->query("SELECT * FROM `pay_bill_api` WHERE ".$dateConditionFilterDate." AND USER_ID ='$id'");
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
    
    //last
    $recharge = $con->query("SELECT * FROM `pay_bill_api` WHERE ".$dateConditionLastFilterDate." AND USER_ID ='$id'");
    if($recharge->num_rows > 0){
        while($row = $recharge->fetch_assoc()){
            
            $small_value = strtolower($row['STATUS']);
            if (strpos($small_value, '1') !== false || strpos($small_value, 1) !== false) {
                
            $transaction_last++;
            $balance = $row["AMOUNT"];
            $amount_last = $amount_last+$balance;          
            
            }
        }
    }
    
    
    $atm = $con->query("SELECT * FROM `micro_atm` WHERE USER_ID ='$id' ".$dateConditionDate." AND USER_TYPE='$user_type' ");
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
    
    $atm = $con->query("SELECT * FROM `micro_atm` WHERE USER_ID ='$id' ".$dateConditionLastDate." AND USER_TYPE='$user_type' ");
    if($atm->num_rows > 0){
        while($row = $atm->fetch_assoc()){
            
            $small_value = strtolower($row['RESPONSE']);
            if (strpos($small_value, 'success') !== false || strpos($small_value, 'sucess') !== false) {
               $transaction_last++;
               $balance = $row["TRANSAMOUNT"];
               $amount_last = $amount_last+$balance;  
            }
        }
    }
    
    $aeps = $con->query("SELECT * FROM `aeps_transactions` WHERE USER_ID ='$id' ".$dateConditionFilterDate." AND USER_TYPE='$user_type' ");
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
    
    $aeps = $con->query("SELECT * FROM `aeps_transactions` WHERE USER_ID ='$id' ".$dateConditionLastFilterDate." AND USER_TYPE='$user_type' ");
    if($aeps->num_rows > 0){
        while($row = $aeps->fetch_assoc()){
            
            $small_value = strtolower($row['STATUS']);
            if (strpos($small_value, '1') !== false || strpos($small_value, 1) !== false) {
                $transaction_last++;
                $balance = $row["AMOUNT"];
                $amount_last = $amount_last+$balance;  
            }
        }
    }
    
    $aeps = $con->query("SELECT * FROM `dmt_transactions` WHERE USER_ID ='$id' ".$dateConditionFilterDate." AND USER_TYPE='$user_type' ");
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
    
    $aeps = $con->query("SELECT * FROM `dmt_transactions` WHERE USER_ID ='$id' ".$dateConditionLastFilterDate." AND USER_TYPE='$user_type' ");
    if($aeps->num_rows > 0){
        while($row = $aeps->fetch_assoc()){
            
            $small_value = strtolower($row['STATUS']);
            if (strpos($small_value, 'success') !== false || strpos($small_value, 'sucess') !== false) {
                $transaction_last++;
                $balance = $row["AMOUNT"];
                $amount_last = $amount_last+$balance;
            }
        }
    }
    
    $comm = $con->query("SELECT * FROM `commission_report` WHERE USER_ID ='$id' AND USER_TYPE='$user_type' ".$dateConditionTime."");
    if($comm->num_rows > 0){
        while($row = $comm->fetch_assoc()){
            $earning_balance = $row["COMMISSION"];
            $earning = $earning+$earning_balance;
        }
    }
    
    
    
    //old
    $comm = $con->query("SELECT * FROM `commission_report` WHERE USER_ID ='$id' AND USER_TYPE='$user_type' ".$dateConditionLastTime."");
    if($comm->num_rows > 0){
        while($row = $comm->fetch_assoc()){
            $earning_balance = $row["COMMISSION"];
            $earning_last = $earning_last+$earning_balance;
        }
    }
    
}


    $rs = json_encode(array("message"=>"Analytics Data Fetched", "response_code"=>1, "status"=>true, "current_transaction"=>$transaction,"last_transaction"=>$transaction_last,"current_business"=>"₹ ".$amount,"last_business"=>"₹ ".$amount_last,"current_earning"=>"₹ ".$earning,"last_earning"=>"₹ ".$earning_last));
    echo $rs;
    return;





?>