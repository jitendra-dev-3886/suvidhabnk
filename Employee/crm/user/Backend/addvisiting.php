<?php
include('../includes/config.php');
include('userdata.php');

if($_POST["type"] == 5){
    
    $ch = curl_init();
    curl_setopt($ch,CURLOPT_URL,"http://ip-api.com/json");
    curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
    $response = curl_exec($ch);
    
    $longutude = $_POST["long"];
    $latitude = $_POST["lati"];
    $ipaddress = $_SERVER['REMOTE_ADDR'];
    $today=date("d-m-Y h:i:s A");  
    $name=$_POST['name'];
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
    
    if(isset($_FILES["shopimg"])){
        $shoimg = $_FILES["shopimg"];
        $imgname = $shoimg["name"];
        $imgtempname = $shoimg["tmp_name"];
        $dest = "../assets/shopimg/".$imgname;
    }

    
    $res = $con->query("INSERT INTO `visiting`(`USER_ID`, `NAME`, `MOBILE`, `EMAIL`, `STATE`, `DISTRICT`, `BLOCK`, `ADDRESS`, `SHOP_IMG`, `STATUS`, `DATE`, `TIME`, `REMARK`, `LONGUTUDE`, `LATITUDE`, `IP_ADDRESS`, `LOCATION`) VALUES 
    ('$id','$name','$mobile','$email','$state','$district','$block','$address','$imgname','$lead_status','$date','$time','$remark','$longutude','$latitude','$ipaddress','$response')");
    if($res)
    {
        $fetchData = $con->query("SELECT * FROM `lead` WHERE MOBILE='$mobile' ORDER BY ID DESC LIMIT 1")->fetch_assoc();   
        $row_id = $fetchData['ID'];
         move_uploaded_file($imgtempname,$dest);   
        $con->query("INSERT INTO `activity`(`LEAD_ID`,`USER_ID`, `DATE`, `TIME`, `DESCRIPTION`, `STATUS`) VALUES ('$row_id','$id','$date','$time','$remark','$lead_status')");
        
        echo 1;    
    }
    else{
    echo 0;
    }

}
?>