<?php

session_start();
require_once('../../Db/config.php');

// ini_set('display_errors', 1);
// ini_set('display_startup_errors', 1);
// error_reporting(E_ALL);
    extract($_POST);
    
     if(isset($aepspack)){
    if($con->query("update user set AEPS_COMM='$aepspack' , XDMT='$xdmtpack' , DMT_COMM='$dmtpack' , UPI_COMM='$upipack',AADHAR_COMM='$adhaarpaypack' where ID='$userid'")){
        $con->query("update user_comm set OFFLINE_WATER='$offlinewaterpack' , OFFLINE_ELECTRICITY='$offlineelcpack'  where USER_ID='$userid' ");
     
        echo 200;
    }
    else{
        echo 500;
    }
    }
    
    
    if(isset($name)){
       $run = $con->query("update user set FIRST_NAME='$name',PARTNER_ID='$memberid',OWNER_ID='$owner',MOBILE='$mobile',EMAIL='$email',ADHAAR='$adhaarno',PAN='$panno' where ID='$userid' ");
     if($run){
        echo 200;
    }
    else{
        echo 500;
    }
    
    }
    
    if(isset($address)){
       $run = $con->query("update user set ADDRESS='$address',STATE='$state',CITY='$city',BLOCK='$block',PIN='$pincode' where ID='$userid' ");
     if($run){
        echo 200;
    }
    else{
        echo 500;
    }
    
    }
    if(isset($officeaddress)){
       $run = $con->query("update user set OFFICE_ADDRESS='$officeaddress',STATE='$state',CITY='$city',BLOCK='$block',PIN='$pincode',VALID='$validation' where ID='$userid' ");
     if($run){
        echo 200;
    }
    else{
        echo 500;
    }
    
    }
    
    if(isset($_FILES["profilepic"]["name"])){
        
        $filepicname = $_FILES["profilepic"]["name"];
        $filetmpname = $_FILES["profilepic"]["tmp_name"];
        if (!file_exists("../assets/userprofilepic/".$userid)) {
          mkdir("../assets/userprofilepic/".$userid, 0777, true);
}
        $path = "../assets/userprofilepic/".$userid."/".$filepicname;
        $filenewname = "https://paydeer.in/Agent/assets/userprofilepic/".$userid."/".$filepicname;
       $run = $con->query("update user set ADHAAR_PIC='$filenewname' where ID='$userid' ");
     if($run){
         $fetchimg = $con->query("select * from user where ID='$userid' ")->fetch_assoc();
         unlink("../assets/userprofilepic/".basename($fetchimg["ADHAAR_PIC"]));
         move_uploaded_file($filetmpname,$path);
        echo 200;
    }
    else{
        echo 500;
    }
    
    }
    
    
    if(isset($_FILES["aadharpic"]["name"])){
        
        $filepicname = $_FILES["aadharpic"]["name"];
        $filetmpname = $_FILES["aadharpic"]["tmp_name"];
        if (!file_exists("../assets/useradhaarpic/".$userid)) {
          mkdir("../assets/useradhaarpic/".$userid, 0777, true);
}
        $path = "../assets/useradhaarpic/".$userid."/".$filepicname;
        $filenewname = "https://paydeer.in/Agent/assets/useradhaarpic/".$userid."/".$filepicname;
       $run = $con->query("update user set ADHAAR_CARD='$filenewname',VALID2='$validation2' where ID='$userid' ");
     if($run){
         $fetchimg = $con->query("select * from user where ID='$userid' ")->fetch_assoc();
         unlink("../assets/useradhaarpic/".$userid."/".basename($fetchimg["ADHAAR_CARD"]));
         move_uploaded_file($filetmpname,$path);
        echo 200;
    }
    else{
        echo 500;
    }
    
    }
    
    
    if(isset($_FILES["agreementpic"]["name"])){
        
        $filepicname = $_FILES["agreementpic"]["name"];
        $filetmpname = $_FILES["agreementpic"]["tmp_name"];
        if (!file_exists("../assets/useragreement/".$userid)) {
          mkdir("../assets/useragreement/".$userid, 0777, true);
}
        $path = "../assets/useragreement/".$userid."/".$filepicname;
        $filenewname = "https://paydeer.in/Agent/assets/useragreement/".$userid."/".$filepicname;
       $run = $con->query("update user set AGREEMENT_PIC='$filenewname',VALID5='$validation5' where ID='$userid' ");
     if($run){
         $fetchimg = $con->query("select * from user where ID='$userid' ")->fetch_assoc();
         unlink("../assets/useragreement/".$userid."/".basename($fetchimg["AGREEMENT_PIC"]));
         move_uploaded_file($filetmpname,$path);
        echo 200;
    }
    else{
        echo 500;
    }
    
    }
    
    
    if(isset($_FILES["panpic"]["name"])){
        
        $filepicname = $_FILES["panpic"]["name"];
        $filetmpname = $_FILES["panpic"]["tmp_name"];
        if (!file_exists("../assets/userpanpic/".$userid)) {
          mkdir("../assets/userpanpic/".$userid, 0777, true);
}
        $path = "../assets/userpanpic/".$userid."/".$filepicname;
        $filenewname = "https://paydeer.in/Agent/assets/userpanpic/".$userid."/".$filepicname;
       $run = $con->query("update user set PAN_PIC='$filenewname',VALID3='$validation3' where ID='$userid' ");
     if($run){
         $fetchimg = $con->query("select * from user where ID='$userid' ")->fetch_assoc();
         unlink("../assets/userpanpic/".$userid."/".basename($fetchimg["PAN_PIC"]));
         move_uploaded_file($filetmpname,$path);
        echo 200;
    }
    else{
        echo 500;
    }
    
    }
    
    
    if(isset($_FILES["bankpasspic"]["name"])){
        
        $filepicname = $_FILES["bankpasspic"]["name"];
        $filetmpname = $_FILES["bankpasspic"]["tmp_name"];
        if (!file_exists("../assets/userbank_passbook/".$userid)) {
          mkdir("../assets/userbank_passbook/".$userid, 0777, true);
}
        $path = "../assets/userbank_passbook/".$userid."/".$filepicname;
        $filenewname = "https://paydeer.in/Agent/assets/userbank_passbook/".$userid."/".$filepicname;
       $run = $con->query("update user set BANKPASSBOOK_PIC='$filenewname',VALID4='$validation4' where ID='$userid' ");
     if($run){
         $fetchimg = $con->query("select * from user where ID='$userid' ")->fetch_assoc();
         unlink("../assets/userbank_passbook/".$userid."/".basename($fetchimg["BANKPASSBOOK_PIC"]));
         move_uploaded_file($filetmpname,$path);
        echo 200;
    }
    else{
        echo 500;
    }
    
    }
    
    if(isset($email)){
       $run = $con->query("update user set EMAIL='$email' where ID='$userid' ");
     if($run){
         createva($userid);
        $vauser = $con->query("select * from virtual_account where USER_ID='$userid'")->fetch_assoc();
         createUPIID($vauser['ID']);
        echo 200;
    }
    else{
        echo 500;
    }
    
    }
    

function createva($usid){
    $createAccount = "createAccount";
    $data=["createAccount" => $createAccount, "usid" => $usid ];
    $url = "https://paydeer.in/Agent/Backend/VirtualAccount/main";
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
    $result = curl_exec($ch);
    // echo $result;
    $response = json_decode($result, true);
    // echo $resonse;
        
}
function createUPIID($usid){
    $data=["pageid" => 1, "usid" => $usid ];
    $url = "https://paydeer.in/Agent/Backend/VirtualAccount/main";
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
    $result = curl_exec($ch);
    // echo $result;
    $response = json_decode($result, true);
    // echo $resonse;
}
