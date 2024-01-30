<?php
session_start();
$my_id = $_SESSION["UsId"];

include("../../Db/config.php");
include("../Backend/Functions/all_function.php");
include("../../test_api/whatsapp_api.php");


if($_POST['mem_type']==1){
	    
	    $partner_id = "SUVID".mt_rand(10000,99999);
       
     mkdir("../assets/Documents/".$partner_id);
     
     
    $utype= $_POST['utype'];
    $memfname= $_POST['memfname'];
	   $memlname= $_POST['memlname'];
	   $mobile= $_POST['mobile'];
	   $email= $_POST['email'];
	   
	   $date= $_POST['date'];
	   $faddress= $_POST['faddress'];
	   $state= $_POST['state'];
	   $city= $_POST['city'];
	   $pincode= $_POST['pincode'];
	   $adharno= $_POST['adharno'];
	    $panno= $_POST['panno'];
	   
	   $mempass= $_POST['mempass'];
	  
	   
	   $acholder_name = $_POST['acholder_name'];
	   $acc_no = $_POST['acc_no'];
	   $ifsc= $_POST['ifsc'];
	   $bankName = $_POST['bankName'];
	   
	   
	   $aepspack = $_POST['aepspack'];
	   $dmtpack = $_POST['dmtpack'];
	   $adhaarpaypack = $_POST['adhaarpaypack'];
	   $bbpspack = $_POST['bbpspack'];
	   $payoutpack = $_POST['payoutpack'];
	   $matmpack = $_POST['matmpack'];
	   $rechargepack = $_POST['rechargepack'];
	   
	   
	   
	   
	   
	   $reciver="91$mobile";
	   $msg="Dear $memfname $memlname, Your Suvidha Bankio Login ID is $mobile, and Password is $mempass, Thanks-Suvidha BANKio Team";
	   
	   
	   //Profile Pic Upload
	   if(isset($_FILES['upldprofile'])){
	   $profile_name = $_FILES['upldprofile']['name'];
    $profile_tmp = $_FILES['upldprofile']['tmp_name'];

    $target = "../assets/Documents/".$partner_id."/".$profile_name;
     
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
	   
	   
	   
	   
	   
	    //Adhaar Pic Upload
	   if(isset($_FILES['adharpic_back'])){
	   $adhaar_name_back = $_FILES['adharpic_back']['name'];
    $adhaar_tmp_back = $_FILES['adharpic_back']['tmp_name'];

    $target = "../assets/Documents/".$partner_id."/".$adhaar_name_back;
     
      move_uploaded_file($adhaar_tmp_back,$target);
	   }
	   
	   
	   
	   
     
 $sql= $con->query("INSERT INTO `user`(`MAIN_OWNER`, `MAIN_OWNER_ID`, `TOKEN_ID`, `USER_TYPE`, `PARTNER_ID`, `OWNER_ID`, `SERVICES`, `FIRST_NAME`, `LAST_NAME`, `MOBILE`, `EMAIL`, `MAIN_BAL`, `AEPS_BAL`, `ADDRESS`, `CITY`, `STATE`, `PIN`, `ADHAAR`, `ADHAAR_PIC`,`PAN`, `RC_COMM`, `AEPS_COMM`, `AADHAR_COMM`, `DMT_COMM`, `BBPS_COMM`, `PAYOUT_COMM`, `M_ATM_COMM`, `US_STATUS`, `PASSWORD`, `SUBSCRIPTION`, `OTP`, `LOGIN_AUTH`) VALUES ('Admin','1','New Account','$utype','$partner_id','$my_id','','$memfname','$memlname','$mobile','$email','0','0','$faddress','$city','$state','$pincode','$adhaar_name', '$adhaar_name_back','$pan_name','$rechargepack','$aepspack','$adhaarpaypack','$dmtpack','$bbpspack','$payoutpack','$matmpack','Active','$mempass','','1','1')");
//  echo "INSERT INTO `user`(`MAIN_OWNER`, `MAIN_OWNER_ID`, `TOKEN_ID`, `USER_TYPE`, `PARTNER_ID`, `OWNER_ID`, `SERVICES`, `FIRST_NAME`, `LAST_NAME`, `MOBILE`, `EMAIL`, `MAIN_BAL`, `AEPS_BAL`, `ADDRESS`, `CITY`, `STATE`, `PIN`, `ADHAAR`, `PAN`, `RC_COMM`, `AEPS_COMM`, `AADHAR_COMM`, `DMT_COMM`, `PAYOUT_COMM`, `M_ATM_COMM`, `US_STATUS`, `PASSWORD`, `SUBSCRIPTION`, `OTP`, `LOGIN_AUTH`) VALUES ('Admin','1','New Account','$utype','$partner_id','$my_id','','$memfname','$memlname','$mobile','$email','0','0','$faddress','$city','$state','$pincode','$adhaar_name','$pan_name','','','','','','','Active','$mempass','','1','1')";
$id = mysqli_insert_id($con);

// $sql1 = $con->query("INSERT INTO `user_profile`(`PROFILE_IMG`, `MAIN_OWNER`, `MAIN_OWNER_ID`, `OWNER_ID`, `USER_ID`, `ALTERNATE_PHONE_NO`, `DOB`, `GENDER`, `COUNTRY`, `STATE`, `FACEBOOK_URL`, `TWITTER_URL`, `LINKEDIN_URL`, `INSTAGRAM_URL`, `DRIBBLE_BOX_URL`, `GOOGLE_PLUS_URL`, `PINTEREST_URL`, `SKYPE_URL`, `VINE_URL`, `AADHAR_CARD_NO`, `PAN_CARD_NO`, `BANK`, `B_NAME`, `AC_HOLDER_NAME`, `AC_NUM`, `IFSC_CODE`, `PASSBOOK`) VALUES('$profile_name','ADMIN','1','1','','$mobile','','','','$state','','','','','','','','','','','$adharno','$panno','$bankName','$bankName','$acholder_name','$acc_no','$ifsc','')");
$sql1 = $con->query("INSERT INTO `user_profile`(`PROFILE_IMG`, `MAIN_OWNER`, `MAIN_OWNER_ID`, `OWNER_ID`, `USER_ID`, `ALTERNATE_PHONE_NO`, `DOB`, `GENDER`, `COUNTRY`, `STATE`, `FACEBOOK_URL`, `TWITTER_URL`, `LINKEDIN_URL`, `INSTAGRAM_URL`, `DRIBBLE_BOX_URL`, `BLOCK`, `DISTRICT`, `LAND_MARK`, `ACCOUNT_TYPE`, `UPI_ID`, `AADHAR_CARD_NO`, `PAN_CARD_NO`, `BANK`, `B_NAME`, `AC_HOLDER_NAME`, `AC_NUM`, `IFSC_CODE`, `PASSBOOK`, `PASSPORT_PIC`, `OTHER_DOCS`) VALUES ('$profile_name','ADMIN','1','$my_id','$id','$mobile','','','','$state','','','','','','','','','','','$adharno','$panno','$bankName','$bankName','$acholder_name','$acc_no','$ifsc','','','')");

if($sql){
        //   echo"MemberAdd Successfully Added";
        echo "1";
        whatsapp_msg($reciver,$msg);
       }else{
        //   echo"Failed To Add !";
        echo "0";
       }
// if($sql1){
//         //   echo"MemberAdd Successfully Added";
//         echo "1";
//       }else{
//         //   echo"Failed To Add !";
//         echo "0";
//       }
     
}

?>