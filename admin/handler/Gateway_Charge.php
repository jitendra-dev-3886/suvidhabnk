<?php

session_start();
require_once('../../Db/config.php');
require("../include/Auth.php");
    
    // update bank details code
  if(isset($_POST['id']) && $_POST['id'] == 9){
    

// $uid=$_POST['updateid'];
$uid='1';
$c_credit=$_POST['c_credit'];
$c_debit=$_POST['c_debit'];
$c_wallet=$_POST['c_wallet'];
$c_netbank=$_POST['c_netbank'];
$date=date('Y-m-d H:i:s');




$sql ="UPDATE `payment_gateway_charge` SET `CREDIT_CARD`='$c_credit' , `DEBIT_CARD`='$c_debit', `WALLETS`='$c_wallet',`NET_BANK`='$c_netbank', `DATE_TIME`='$date' WHERE ID='$uid'";
$run = mysqli_query($con,$sql);
// echo $sql;


if($run){
    echo 1;
}else{
    echo 0;
}

}
?>