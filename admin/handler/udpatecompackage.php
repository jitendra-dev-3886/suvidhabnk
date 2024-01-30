<?php

session_start();
require_once('../../Db/config.php');
include('../../test_api/mail/index.php');
$userid=$_POST["userid"];

    extract($_POST);
    if($con->query("update user set API_ACCESS='$api_access', RC_COMM='$rcpack' , AEPS_COMM='$aepspack' ,US_STATUS='$ustatus', SUBSCRIPTION='$subsplan', DMT_COMM='$dmtpack' , UPI_COMM='$upipack',FASTAG_COMM='$fastagpack', BBPS_COMM='$bbpspack' , PAYOUT_COMM='$payoutpack' ,AADHAR_COMM='$adhaarpaypack', MOBILE='$newmobile', EMAIL='$newemail' where ID='$userid'")){
         //echo 200;
        
        $ar = ["VIRTUAL_ACCOUNT" , "EMI" , "DATACARDPREPAID" , "DIGITALVOUCHER" , "MUNICIPALITY" , "LPG" , "HOSPITAL" , "CABLE" , "TRAFFICCHALLAN" , "LANDLINE" , "POSTPAID" , "WATER", "INSURANCE" , "ELECTRICITY" , "BROADBAND" , "GAS" ];
        foreach($ar as $word){
            if(isset($_POST[$word])){
                $con->query("update user_comm set $word='".$_POST[$word]."' where USER_ID='$userid' ");
                // echo "update user_comm set $word='".$_POST[$word]."' where USER_ID='$userid'";
                // exit;
            };
        };
        
        foreach($ar as $wrd){
             $word = "OFFLINE_".$wrd;
            if(isset($_POST[$word])){
                $con->query("update user_comm set $word='".$_POST[$word]."' where USER_ID='$userid' ");
            //    echo "update user_comm set $word='".$_POST[$word]."' where USER_ID='$userid'" ;
              //  exit;
            };
        };
    }else{
        echo 500;
    };


// error_reporting(E_ALL);
// init_set("display_errors",1);

extract($_POST);

if(isset($aepspack)){
    // echo "update user set AEPS_COMM='$aepspack' , DMT_COMM='$dmtpack' , AADHAR_COMM='$adhaarpaypack', RC_COMM='$rcpack',PAYOUT_COMM='$payoutpack' ,BBPS_COMM='$onlineBbps', UPI_COMM='$upipack' where ID='$userid'";
    // if($con->query("update user set AEPS_COMM='$aepspack' , DMT_COMM='$dmtpack' , BBPS_COMM='', PAYOUT_COMM='', AADHAR_COMM='$adhaarpaypack', RC_COMM='$rcpack', LIC_COMM='', CMS_COMM='', BUS_COMM='' where ID='$userid'")){
    if($con->query("update user set AEPS_COMM='$aepspack' , DMT_COMM='$dmtpack' , AADHAR_COMM='$adhaarpaypack', RC_COMM='$rcpack',PAYOUT_COMM='$payoutpack' ,BBPS_COMM='$onlineBbps', UPI_COMM='$upipack' where ID='$userid'")){
        $con->query("update user_comm set OFFLINE_WATER='$offlinewaterpack' , OFFLINE_ELECTRICITY='$offlineelcpack'  where USER_ID='$userid'");
        echo 200;
    }else{
        echo 500;
    };
    };
    
    
    if(isset($fname)){
       $run = $con->query("update user set FIRST_NAME='$fname',`LAST_NAME`='$lname',PARTNER_ID='$memberid',OWNER_ID='$owner',MOBILE='$mobile',EMAIL='$email' where ID='$userid' ");
              $con->query("update user_profile set AADHAR_CARD_NO='$adhaarno',PAN_CARD_NO='$panno' where USER_ID='$userid'");
     if($run){
        echo 200;
    }else{
        echo 500;
    };
    
    };
    
    if(isset($address)){
       $run = $con->query("update user set ADDRESS='$address',STATE='$state',CITY='$city',PIN='$pincode' where ID='$userid' ");
              $con->query("update user_profile set DISTRICT='$block' where USER_ID='$userid'");
     if($run){
        echo 200;
    }else{
        echo 500;
    };
    
    };

    
    if(isset($_FILES["profilepic"]["name"])){
        
        $filepicname = $_FILES["profilepic"]["name"];
        $filetmpname = $_FILES["profilepic"]["tmp_name"];
        if (!file_exists("../../Agent/dist/img/Userdoc/".$userid)) {
          mkdir("../../Agent/dist/img/Userdoc/".$userid, 0777, true);
         }
        $path = "../../Agent/dist/img/Userdoc/".$userid."/".$filepicname;
        $filenewname = "https://suvidhabnk.com/Agent/dist/img/Userdoc/".$userid."/".$filepicname;
 
        $profile = $con->query("SELECT * FROM `user_profile` WHERE USER_ID='$userid'")->fetch_assoc();
         if($profile['USER_ID'] =='' || $profile['USER_ID'] == null){
                $insert_report = "INSERT INTO `user_profile`(`USER_ID`) VALUES ('$userid')";
                $con->query($insert_report);
            }

       $run = $con->query("update user_profile set PROFILE_IMG='$filenewname' where USER_ID='$userid' ");
     if($run){
         $fetchimg = $con->query("select * from user_profile where USER_ID='$userid' ")->fetch_assoc();
         unlink("../../Agent/dist/img/Userdoc/".basename($fetchimg["PROFILE_IMG"]));
         move_uploaded_file($filetmpname,$path);
        echo 200;
    }else{
        echo 500;
    };
    
    };
    
    
    if(isset($_FILES["aadharpic"]["name"])){
        
        $filepicname = $_FILES["aadharpic"]["name"];
        $filetmpname = $_FILES["aadharpic"]["tmp_name"];
        if (!file_exists("../../Agent/dist/img/Userdoc/".$userid)) {
          mkdir("../../Agent/dist/img/Userdoc/".$userid, 0777, true);
}
        $path = "../../Agent/dist/img/Userdoc/".$userid."/".$filepicname;
        $filenewname = "https://suvidhabnk.com/Agent/dist/img/Userdoc/".$userid."/".$filepicname;
       $run = $con->query("update user set ADHAAR='$filenewname' where ID='$userid' ");
     if($run){
         $fetchimg = $con->query("select * from user where ID='$userid' ")->fetch_assoc();
         unlink("../../Agent/dist/img/Userdoc/".$userid."/".basename($fetchimg["ADHAAR"]));
         move_uploaded_file($filetmpname,$path);
        echo 200;
    }else{
        echo 500;
    };
    
    };
    
    
    if(isset($_FILES["aadharback"]["name"])){
        
        $filepicname = $_FILES["aadharback"]["name"];
        $filetmpname = $_FILES["aadharback"]["tmp_name"];
        if (!file_exists("../../Agent/dist/img/Userdoc/".$userid)) {
          mkdir("../../Agent/dist/img/Userdoc/".$userid, 0777, true);
}
        $path = "../../Agent/dist/img/Userdoc/".$userid."/".$filepicname;
        $filenewname = "https://suvidhabnk.com/Agent/dist/img/Userdoc/".$userid."/".$filepicname;
       $run = $con->query("update user_profile set PROFILE_IMG='$filenewname' where USER_ID='$userid' ");
     if($run){
         $fetchimg = $con->query("select * from user where ID='$userid' ")->fetch_assoc();
         unlink("../../Agent/dist/img/Userdoc/".$userid."/".basename($fetchimg["PROFILE_IMG"]));
         move_uploaded_file($filetmpname,$path);
        echo 200;
    }else{
        echo 500;
    };
    
    };
    
    
    if(isset($_FILES["panpic"]["name"])){
        
        $filepicname = $_FILES["panpic"]["name"];
        $filetmpname = $_FILES["panpic"]["tmp_name"];
        if (!file_exists("../../Agent/dist/img/Userdoc/".$userid)) {
          mkdir("../../Agent/dist/img/Userdoc/".$userid, 0777, true);
}
        $path = "../../Agent/dist/img/Userdoc/".$userid."/".$filepicname;
        $filenewname = "https://suvidhabnk.com/Agent/dist/img/Userdoc/".$userid."/".$filepicname;
       $run = $con->query("update user set PAN='$filenewname' where ID='$userid' ");
     if($run){
         $fetchimg = $con->query("select * from user where ID='$userid' ")->fetch_assoc();
         unlink("../../Agent/dist/img/Userdoc/".$userid."/".basename($fetchimg["PAN"]));
         move_uploaded_file($filetmpname,$path);
        echo 200;
    }else{
        echo 500;
    };
    
    };
    
    
    if(isset($_FILES["bankpasspic"]["name"])){
        
        $filepicname = $_FILES["bankpasspic"]["name"];
        $filetmpname = $_FILES["bankpasspic"]["tmp_name"];
        if (!file_exists("../../Agent/dist/img/Userdoc/".$userid)) {
          mkdir("../../Agent/dist/img/Userdoc/".$userid, 0777, true);
}
        $path = "../../Agent/dist/img/Userdoc/".$userid."/".$filepicname;
        $filenewname = "https://suvidhabnk.com/Agent/dist/img/Userdoc/".$userid."/".$filepicname;
      $run = $con->query("update user set ADHAAR_PIC='$filenewname' where ID='$userid' ");
     if($run){
         $fetchimg = $con->query("select * from user where ID='$userid' ")->fetch_assoc();
         unlink("../../Agent/dist/img/Userdoc/".$userid."/".basename($fetchimg["ADHAAR_PIC"]));
         move_uploaded_file($filetmpname,$path);
        echo 200;
    }else{
        echo 500;
    };
    
    };

if(isset($_POST["usst"])){   
    $usst = $_POST["usst"]; // Retrieve the value of $usst from $_POST
    if(strtolower($usst) == "active"){
        $update = "Deactive";
    }else{
        $update = "Active";
    }

    if(isset($_POST["usst"])){ // Check if $_POST[$usst] is set
        $main =  $con->query("UPDATE user SET US_STATUS='$usst' WHERE ID='$userid'");
        if($main){
            $ud = $con->query("SELECT * FROM user WHERE ID='$userid'")->fetch_assoc();
            $email = $ud["EMAIL"];
            $subject = "Retailer Verification Status";
            $msg = "You have been successfully verified";
            smtp_mailer($email,$subject,$msg);
            
            echo 200;
        }else{
            echo 500; // output giving this section
        }
    }else{
        echo 500;
    }
};


?>