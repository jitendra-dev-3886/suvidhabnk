<?php

session_start();
require_once('../../Db/config.php');

if(isset($_POST['rcpack'])){
    extract($_POST);
    if($con->query("update user set RC_COMM='$rcpack' , AEPS_COMM='$aepspack' , DMT_COMM='$dmtpack' , PAYOUT_COMM='$payoutpack' ,AADHAR_COMM='$adhaarpaypack' where ID='$userid'")){
        echo 200;
    }
    else{
        echo 500;
    }
}


if(isset($_POST['submitml'])){
    extract($_POST);
    if($con->query("update user set US_STATUS='$ustatus' , SUBSCRIPTION='$subsplan' where ID='$userid'")){
        echo 200;
    }
    else{
        echo 500;
    }
}
