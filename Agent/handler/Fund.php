<?php
error_reporting(0);
session_start();
$my_id = $_SESSION["UsId"];
include("../../Db/config.php");
include("../security/userInformation.php");
require("../Backend/Functions/all_function.php"); // for all report

include('function.php');
  $token_id = $_SESSION['token_id'];
  $my_id = $_SESSION['UsId'];
  
  if(isset($_POST['amount'])){
     $amount = filterThis($_POST['amount']);
     $fund_type = filterThis($_POST['payment_mode']);
     $refrence =  substr(str_shuffle("123457890QWERTYUIOPASDFGHJKLZXCVBNMasdfghjklqwertyuiopzxcvbnm") , 0 , 10);
    //  $refrence = filterThis($_POST['refrenceid']);
    //  $recipt = filterThis($_POST['recipt']);
        $img = $_FILES['recipt'];
        // print_r($_FILES['recipt']);
    $img_extension = strtolower(pathinfo($img['name'] , PATHINFO_EXTENSION));
    // echo $img_extension;
    //     exit;
    if($img_extension == "jpg" || $img_extension == "png" || $img_extension == "jpeg"){
        $path = "../assets/Uploaded_img/AddFund/".$refrence.".".$img_extension;
        $image = $refrence.".".$img_extension;
            move_uploaded_file($img['tmp_name'] , $path);
         $my_data = $con->query("SELECT * FROM `user` WHERE ID='$my_id' and US_STATUS='ACTIVE'")->fetch_assoc(); 
         $main_owner =  $my_data['MAIN_OWNER'];
         $main_owner_id =  $my_data['MAIN_OWNER_ID'];
         $transfer_owner_id =  $my_data['TRANSFER_USER_ID'];
         $owner_id =  $my_data['OWNER_ID'];
         $my_bal =  $my_data['MAIN_BAL']; //previous bal
         $my_update_bal =  $my_data['USER_AFTER_AMOUNT'];
         $user_id =  $my_data['ID'];
    
         $user_data = $con->query("SELECT * FROM `user` WHERE ID='$my_id' and US_STATUS='ACTIVE'")->fetch_assoc(); 
         $user_bal =  $user_data['MAIN_BAL'];
         $date = date("Y-m-d");
        // $req_fund = "INSERT INTO `fund`(`MAIN_OWNER`, `MAIN_OWNER_ID`, `OWNER_ID`, `USER_ID`, `REFFRENCE_ID`, `AMOUNT`, `FUND_TYPE`, `REMARK`, `STATUS`,`RECIEPT`, `PAYMENT_MODE`, `DATE`) VALUES ('Admin','1','admin','$my_id','$refrence','$amount','Offline Requested','Pending Request','Pending','$image','$fund_type','$date')";
        $req_fund = "INSERT INTO `fund`(`MAIN_OWNER`, `MAIN_OWNER_ID`, `OWNER_ID`, `USER_ID`, `REFFRENCE_ID`, `AMOUNT`, `FUND_TYPE`, `REMARK`, `STATUS`, `RECIEPT`, `PAYMENT_MODE`, `DATE`) VALUES ('Admin', '1', 'ADMIN', '$my_id', '$refrence', '$amount', 'Offline Request','Pending Request', 'Pending', '$image', '$fund_type','$date')";
        
        $query_run = mysqli_query($con,$req_fund);
        if($query_run){
            
            echo json_encode(array("response_code"=>1 , "message"=>"Request Success"));
                //  header("location:../AddFund?&msg=successfully&desc=Amount is Requested to Your Owner");
        }else{
            echo json_encode(array("response_code"=>2 , "message"=>"Request Failed Try again.."));
                // header("location:../AddFund?&error=Alert&desc=Please Contact your Owner and resolved this transaction");
        }
    }else{
        echo json_encode(array("response_code"=>3 , "message"=>"Only JPG Or PNG File accepted .."));
    }
  }
        // echo json_encode(array("response_code"=>4 , "message"=>"rejected .."));
  
?>  