<?php

session_start();
require_once('../../Db/config.php');

    extract($_POST);
    if($con->query("update user set RC_COMM='$rcpack' , AEPS_COMM='$aepspack' ,US_STATUS='$ustatus', SUBSCRIPTION='$subsplan', DMT_COMM='$dmtpack' , UPI_COMM='$upipack',FASTAG_COMM='$fastagpack', BBPS_COMM='$bbpspack' , PAYOUT_COMM='$payoutpack' ,AADHAR_COMM='$adhaarpaypack', MOBILE='$newmobile', EMAIL='$newemail' where ID='$userid'")){
        echo 200;
        
        $ar = ["VIRTUAL_ACCOUNT" , "EMI" , "DATACARDPREPAID" , "DIGITALVOUCHER" , "MUNICIPALITY" , "LPG" , "HOSPITAL" , "CABLE" , "TRAFFICCHALLAN" , "LANDLINE" , "POSTPAID" , "WATER", "INSURANCE" , "ELECTRICITY" , "BROADBAND" , "GAS" ];
        foreach($ar as $word){
            if(isset($_POST[$word])){
                $con->query("update user_comm set $word='".$_POST[$word]."' where USER_ID='$userid' ");
            }
        }
        
        foreach($ar as $wrd){
             $word = "OFFLINE_".$wrd;
            if(isset($_POST[$word])){
                $con->query("update user_comm set $word='".$_POST[$word]."' where USER_ID='$userid' ");
            }
        }
    }
    else{
        echo 500;
    }

