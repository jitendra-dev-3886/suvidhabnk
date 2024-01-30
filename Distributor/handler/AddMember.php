<?php
session_start();
include("../../Db/config.php");
include("../Backend/Functions/all_function.php");
include("../../test_api/whatsapp_api.php");

$us_id = $_SESSION['UsId'];

$tokenid = md5();

if(count($_POST)>0){
	if($_POST['mem_type']==1){
	    
	    $partner_id = "PDDT".mt_rand(10000,99999);

     mkdir("../assets/Documents/".$partner_id);
       
	   $memfname= $_POST['memfname'];
	   $memlname= $_POST['memlname'];
	   $mobile= $_POST['mobile'];
	   $email= $_POST['email'];
	   $mempass= $_POST['mempass'];
	   
	   $date= $_POST['date'];
	   $faddress= $_POST['faddress'];
	   $state= $_POST['state'];
	   $city= $_POST['city'];
	   $pincode= $_POST['pincode'];
	   $adharno= $_POST['adharno'];
	   
	   $acholder_name = $_POST['acholder_name'];
	   $acc_no = $_POST['acc_no'];
	   $ifsc= $_POST['ifsc'];
	   $bankName = $_POST['bankName'];
	  
	   
	   
	   //Profile Pic Upload
	   if(isset($_FILES['upldprofile'])){
	   $profile_name = $_FILES['upldprofile']['name'];
    $profile_tmp = $_FILES['upldprofile']['tmp_name'];

    $target = "../assets/Documents/".$partner_id."/".$pan_name;
     
      move_uploaded_file($profile_tmp,$target);
	   }
	   
	    //Pan Pic Upload
	   if(isset($_FILES['panpic'])){
	   $pan_name = $_FILES['panpic']['name'];
    $pan_tmp = $_FILES['panpic']['tmp_name'];

    $target = "../assets/Documents/".$partner_id."/".$pan_name;
     
      move_uploaded_file($pan_tmp,$target);
	   }
	   
	   //Adhaar Pic Upload
	   if(isset($_FILES['adharpic'])){
	   $adhaar_name = $_FILES['adharpic']['name'];
    $adhaar_tmp = $_FILES['adharpic']['tmp_name'];

    $target = "../assets/Documents/".$partner_id."/".$adhaar_name;
     
      move_uploaded_file($adhaar_tmp,$target);
	   }
 
 
 $reciver="91$mobile";
	   $msg="Dear $memfname $memlname, Your Suvidha Bankio Login ID is $mobile, and Password is $mempass, Thanks-Suvidha BANKio Team";
	   
    
	  
       $sql= $con->query("INSERT INTO `user`(`MAIN_OWNER`, `MAIN_OWNER_ID`, `TOKEN_ID`, `USER_TYPE`, `PARTNER_ID`, `OWNER_ID`, `SERVICES`, `FIRST_NAME`, `LAST_NAME`,
       `MOBILE`, `EMAIL`, `MAIN_BAL`, `AEPS_BAL`, `ADDRESS`, `CITY`, `STATE`, `PIN`, `ADHAAR`, `PAN`, `RC_COMM`, `AEPS_COMM`, `AADHAR_COMM`, `DMT_COMM`,
       `PAYOUT_COMM`, `M_ATM_COMM`, `USER_LIMIT`, `CMS_COMM`, `US_STATUS`, `PASSWORD`, `SUBSCRIPTION`, `OTP`, `LOGIN_AUTH`, `DATE`, `XDMT`) VALUES ('Admin','1','New Account','47','$partner_id','$us_id',''
       ,'$memfname','$memlname','$mobile','$email','0','0','$faddress','$city','$state','$pincode','$adharno','$panno','','','','','','','','','','Deactive','$password','1','1','$date','')");
       $id = mysqli_insert_id($con);
       
       $sql1 = $con->query("INSERT INTO `user_profile`(`PROFILE_IMG`, `MAIN_OWNER`, `MAIN_OWNER_ID`, `OWNER_ID`, `USER_ID`, `ALTERNATE_PHONE_NO`, `DOB`, `GENDER`, `COUNTRY`, `STATE`, `FACEBOOK_URL`, `TWITTER_URL`, `LINKEDIN_URL`, `INSTAGRAM_URL`, `DRIBBLE_BOX_URL`, `DROPBOX_URL`, `GOOGLE_PLUS_URL`, `PINTEREST_URL`, `SKYPE_URL`, `VINE_URL`, `AADHAR_CARD`, `PAN_CARD`, `BANK`, `B_NAME`, `AC_HOLDER_NAME`, `AC_NUM`, `IFSC_CODE`, `PASSBOOK`) VALUES 
       ('$profile_name','ADMIN','1','$us_id','$id','$mobile','','','','$state','','','','','','','','','','','$adhaar_name','$pan_name','$bankName','$bankName','$acholder_name','$acc_no','$ifsc','')");
       
       if($sql){
           echo"MemberAdd Successfully Added";
       }else{
           echo"Failed To Add !";
       }
       
        if($sql1){
           echo"Profile Successfully Added";
           whatsapp_msg($reciver,$msg);
       }else{
           echo"Failed To Add !";
       }
}else{
    echo "Something went Wrongs";
}
}
