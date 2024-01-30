<?php
include('../includes/config.php');
include('userdata.php');


extract($_POST);

if($type==1){
    
    

            
    $today=date("Y/m/d");  

    $name=$_POST['name'];
    $uid=$_POST['uid'];
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

    
    $res = $con->query("INSERT INTO `lead`(`USER_ID`,`NAME`, `MOBILE`, `EMAIL`, `STATE`, `DISTRICT`, `BLOCK`,`ADDRESS`, `STATUS`, `REMARK`,`FILTER_DATE`) VALUES ('$id','$name','$mobile','$email','$state','$district','$block','$address','$lead_status','$remark','$today')");
    if($res)
    {
        $fetchData = $con->query("SELECT * FROM `lead` WHERE MOBILE='$mobile' ORDER BY ID DESC LIMIT 1")->fetch_assoc();   
        $row_id = $fetchData['ID'];
            
            $con->query("INSERT INTO `activity`(`LEAD_ID`,`USER_ID`, `DATE`, `TIME`, `DESCRIPTION`, `STATUS`) VALUES ('$row_id','$id','$date','$time','$remark','$lead_status')");
        echo 1;    
    }
    else{
    echo 0;
    }
    
   
        


}
?>