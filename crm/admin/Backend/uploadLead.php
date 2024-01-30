<?php
include('../includes/config.php');

extract($_POST);

if($type==1){
  $today = date("y/d/m");
  $name=$_POST['name'];
    $uid=$_POST['type_user'];
    $mobile= $_POST['mobile'];
    $email = $_POST['email'];
    $state= $_POST['state'];
    $district= $_POST['district'];
    $block=$_POST['block'];
    $address=$_POST['address'];
    $date= $_POST['date'];
    $time=$_POST['time'];
    $lead_status= $_POST['lead_status'];
    $remark=$_POST['remark'];

    
    $res = $con->query("INSERT INTO `lead`(`USER_ID`,`NAME`, `MOBILE`, `EMAIL`, `STATE`, `DISTRICT`, `BLOCK`,`ADDRESS`, `STATUS`, `REMARK`,`FILTER_DATE`) VALUES ('$uid','$name','$mobile','$email','$state','$district','$block','$address','$lead_status','$remark','$today')");
    if($res)
    {
        $fetchData = $con->query("SELECT * FROM `lead` WHERE MOBILE='$mobile' ORDER BY ID DESC LIMIT 1")->fetch_assoc();   
        $row_id = $fetchData['ID'];
        if($date!=""){
            
            $con->query("INSERT INTO `activity`(`LEAD_ID`,`USER_ID`, `DATE`, `TIME`, `DESCRIPTION`, `STATUS`) VALUES ('$row_id','$uid','$date','$time','$remark','$lead_status')");
        }
        echo json_encode(1);    
    }
    else{
    echo json_encode(0);
    }


}
?>