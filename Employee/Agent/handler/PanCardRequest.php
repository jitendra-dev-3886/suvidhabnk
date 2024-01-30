<?php
session_start();
require_once('../../Db/config.php');

include("../Backend/Userinfo/getuserinfo.php");
include("../Backend/Functions/all_function.php");
include("../Backend/Auth/userdata.php");
include("function.php");



if(isset($_POST['no_of_cpn1'])){
   
   
   $no_cpn_price =  filterThis($_POST['no_of_cpn1']);
   $no_cpn2 =  filterThis($_POST['no_of_cpn2']);
   
   if($no_cpn_price <= 0){
        echo json_encode(["status"=>false,"response_code"=>3,"message"=>"Enter valid coupons"]);
        exit;
   }
   if($no_cpn2 <= 0){
        echo json_encode(["status"=>false,"response_code"=>3,"message"=>"Enter valid coupons"]);
        exit;
   }
   
   $qry=$con->query("SELECT * FROM `pan_coupon` WHERE ID='1'")->fetch_assoc();
   
//   $total = $no_cpn_price * $no_cpn2;

   $total = $qry['COUPON_PRICE'] * $no_cpn2;
   $total_coupon_price =  $total;
   
   $fetch_myData = $con->query("SELECT * FROM `user` WHERE ID='$usid'")->fetch_assoc();
   $myMainBal = $fetch_myData['MAIN_BAL'];
   
   if($myMainBal >= $total_coupon_price){
       
    $myAvlBal = $myMainBal - $total_coupon_price;
    
    $refrence = date("Ymdhis").substr(str_shuffle("234567890qwertyuiopasdf1234567890wertyuiodfvgbhjnghjklzxcvbnmQWERTYUIOPASDFGHJKLZXCVBNM") , 0 , 4);
   
   $cpnqry=$con->query("INSERT INTO `pan_transaction`(`TRANSACTION_ID`,`USER_ID`, `NUMBER_OF_COUPON`, `AMOUNT`, `RT_COMM`, `DT_COMM`, `STATUS`) VALUES ('$refrence','$usid','$no_cpn2','$total_coupon_price','0','0','Pending')");
   if($cpnqry){
       
        $con->query("UPDATE `user` SET `MAIN_BAL`='$myAvlBal' WHERE ID='$usid'");
       insert_allreport($usid  ,$refrence , "PAN Coupon Request Transaction" , $myMainBal  , $myAvlBal , $total_coupon_price , "Debit" , "PAN Coupon Request Transaction" , "MAIN");
       echo json_encode(["status"=>true,"response_code"=>1,"message"=>"Pancard Requested Successfully"]);
    
       
   }else{
        echo json_encode(["status"=>false,"response_code"=>3,"message"=>"Pancard Requested Unsuccessfull..!"]);
    }
    
   }else{
       echo json_encode(["status"=>false,"response_code"=>3,"message"=>"Insufficent Balance"]);
   }
}
?>