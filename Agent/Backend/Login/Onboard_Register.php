<?php
session_start();
include("../../../Db/config.php");
// include("../../include/Auth.php");
include("../Userinfo/getuserinfo.php");
include("../Functions/all_function.php");
include("../../../test_api/mail/index.php");
include("../../../test_api/whatsapp_api.php");

$sess_id = $_SESSION['UsId'];

// error_reporting(0);
// error_reporting(E_ALL);
// ini_set("display_errors" , 1);



if(isset($_POST['type']) && $_POST['type'] == 1){



$dir='../../dist/img/Userdoc';

// aadhar_front 2 upload
$image2 = $_FILES['aadhar_front'];
$img_name2 = $image2['name'];
$img_extenion2 = pathinfo($img_name2 , PATHINFO_EXTENSION);
$img_tmp2 = $image2['tmp_name'];
$dest2 = "$dir/". $img_name2;

// aadhar_back 3 upload
$image3 = $_FILES['aadhar_back'];
$img_name3 = $image3['name'];
$img_extenion3 = pathinfo($img_name3 , PATHINFO_EXTENSION);
$img_tmp3 = $image3['tmp_name'];
$dest3 = "$dir/" . $img_name3;

// pancard Form upload
$image5 = $_FILES['pancard'];
$img_name5 = $image5['name'];
$img_extenion5 = pathinfo($img_name5 , PATHINFO_EXTENSION);
$img_tmp5 = $image5['tmp_name'];
$dest5 = "$dir/" . $img_name5;

// profile Photo upload
$image6 = $_FILES['profile'];
$img_name6 = $image6['name'];
$img_extenion6 = pathinfo($img_name6 , PATHINFO_EXTENSION);
$img_tmp6 = $image6['tmp_name'];
$dest6 = "$dir/" . $img_name6;

// passport_pic size Photo upload
/*$image7 = $_FILES['passport_pic'];
$img_name7 = $image7['name'];
$img_extenion7 = pathinfo($img_name7 , PATHINFO_EXTENSION);
$img_tmp7 = $image7['tmp_name'];
$dest7 = "$dir/" . $img_name7;

// other_docs size Photo upload
$image8 = $_FILES['other_docs'];
$img_name8 = $image8['name'];
$img_extenion8 = pathinfo($img_name8 , PATHINFO_EXTENSION);
$img_tmp8 = $image8['tmp_name'];
$dest8 = "$dir/" . $img_name8;
**/
        
        $user_type = mysqli_real_escape_string($con, $_POST['u_type']);
        $parter_id = rand(1111111111,9999999999);

// if($user_type == "46"){
//     $custom_id = "BC$parter_id";
// }elseif($user_type == "47"){
//     $custom_id = "DT$parter_id";
// }else{
//     $custom_id = "Custom Id Not Found";
// }

$number = mysqli_real_escape_string($con,$_POST['mobile']);
$alredy = $con->query("select * from user where MOBILE='$number'")->num_rows;

if($alredy == 0){
    $custom_id = "SUVIDBA".mt_rand(10000,99999);
    $str_rand=rand();
    $token_id = md5($str_rand);
    // $password = mt_rand(10000,99999);
    $password = mysqli_real_escape_string($con,$_POST['pass']);
    $fullname = $_POST['fname'].' '.$_POST['lname']; 
    $email = mysqli_real_escape_string($con,$_POST['email']);

    $user_data = [
         'TOKEN_ID' =>$token_id,
         'PARTNER_ID' =>$custom_id,
         'USER_TYPE' =>$user_type ,
         'FIRST_NAME' => mysqli_real_escape_string($con,$_POST['fname']),
         'LAST_NAME' => mysqli_real_escape_string($con,$_POST['lname']),
         'MOBILE' => $number,
         'EMAIL' => mysqli_real_escape_string($con,$_POST['email']),
         'ADDRESS' => mysqli_real_escape_string($con,$_POST['address']),
         'CITY' => mysqli_real_escape_string($con,$_POST['city']),
         'STATE' => mysqli_real_escape_string($con,$_POST['state']),
         'PIN' => mysqli_real_escape_string($con,$_POST['pincode']),
         'ADHAAR' => $img_name2,
         'ADHAAR_PIC' => $img_name3,
         'PAN' => $img_name5,
         'PASSWORD' => $password,
         'OTP' => "2",
         'LOGIN_AUTH' => "1",
         'US_STATUS' => "Deactive",
         'RC_COMM' =>"85",
         'AEPS_COMM'=>"83",
         'AADHAR_COMM'=>"84",
         'DMT_COMM' =>"89",
         'PAYOUT_COMM' => "88",
         ];
         
         
          $array = array("jpg"  , "jpeg" , "png", "pdf");
            if(in_array($img_extenion2 , $array) && in_array($img_extenion3 , $array) && in_array($img_extenion5 , $array) && in_array($img_extenion6 , $array)){

              $cols = implode(',', array_keys($user_data));
              $vals = implode("','",array_values($user_data));
              
            //  echo "INSERT INTO user ($cols) VALUES ('$vals')";
            //  exit;
          $user_sql = $con->query("INSERT INTO user ($cols) VALUES ('$vals')");
        //   echo "This user query is running properly"."INSERT INTO user ($cols) VALUES ('$vals')";
          
          
        //  $inc_Insert = mysqli_query($user_sql, $con);
         if($user_sql){
                    $reciver="91$number";
                    $subject="Your Login Credentials";
                    $to = $email;
                    $msg = 'Congratulation! Dear '.$fullname.' , You are registered on Suvidhabnk Your Mobile number is:'.$number.'  Password '.$password.'';
                    // smtp_mailer($to, $subject, $msg);
                     whatsapp_msg($reciver,$msg);

          $us_dt = $con->query("select * from user where MOBILE='$number' ORDER BY ID DESC LIMIT 1")->fetch_assoc();
          //echo "this user mobile fetch query is running"."select * from user where MOBILE='$number' ORDER BY ID DESC LIMIT 1";
          $currentUser = $us_dt['ID'];
          //echo "current user data is able to fetch".$currentUser;
          
          $user_profile = [
             'USER_ID' =>$currentUser,
             'DOB' =>mysqli_real_escape_string($con,$_POST['dob']),
             'GENDER' => mysqli_real_escape_string($con,$_POST['gender']),
             'DISTRICT' => mysqli_real_escape_string($con,$_POST['district']),
             'BANK' => mysqli_real_escape_string($con,$_POST['bankname']),
             'AC_NUM' => mysqli_real_escape_string($con,$_POST['account_no']),
             'IFSC_CODE' => mysqli_real_escape_string($con,$_POST['ifsc_code']),
             'B_NAME' => mysqli_real_escape_string($con,$_POST['branch']),
             'ACCOUNT_TYPE' => mysqli_real_escape_string($con,$_POST['account_type']),
             'UPI_ID' => mysqli_real_escape_string($con,$_POST['upi_id']),
             'AADHAR_CARD_NO' =>mysqli_real_escape_string($con,$_POST['aadhar_no']), 
             'PAN_CARD_NO' => mysqli_real_escape_string($con,$_POST['pan_no']),
             'PROFILE_IMG' => $img_name6,
         ];
         
         
          $cols_profilekey = implode(',', array_keys($user_profile));
          //echo "user profile key is running".$cols_profilekey;
          $vals_profilevalue = implode("','",array_values($user_profile));
          //echo "user profile value is running".$vals_profilevalue;
          
         $con->query("INSERT INTO `user_profile` ($cols_profilekey) VALUES ('$vals_profilevalue')");
         
            //echo "This section of query in user profile is running"."INSERT INTO `user_profile` ($cols_profilekey) VALUES ('$vals_profilevalue')";
            
            
            // insert code user_profile here
            

            move_uploaded_file($img_tmp2, $dest2);
            move_uploaded_file($img_tmp3, $dest3);
            move_uploaded_file($img_tmp4, $dest4);
            move_uploaded_file($img_tmp5, $dest5);
            move_uploaded_file($img_tmp6, $dest6);
            move_uploaded_file($img_tmp7, $dest7);
            move_uploaded_file($img_tmp8, $dest8);

             echo json_encode(array("response_code" => 1,'message' =>'Congratulation..! User Has Been Created','status'=>true));
        
         }else{
           
             echo json_encode(array("response_code" => 3,'message' =>'Failed To Created User','status'=>false));
             
         }
         
          	}else{
                 echo json_encode(["response_code"=> 4,"message"=>"Invalid Extension Only Jpg,png,jpeg","status"->false,]);
    }
}else{
     echo json_encode(array("response_code" => 6,'message' =>'User Already Exits','status'=>false));
    }

             
}



?>