<?php

include("../../../Db/config.php");
include("../Userinfo/getuserinfo.php");
include("../Functions/all_function.php");
include("../Auth/userdata.php");
include("../../../mobile_phone/includes/imagepaths.php");


if(isset($_POST['bankDetails'])){
    $user_id = $user['ID'];
    
// $dir='../ProfileImages';
$dir='../../../Dashboard/User/assets/banks/new';

mkdir($dir);	
// adhaarfront 2 upload
$image2 = $_FILES['aadhaar'];
$aadhaar = $image2['name'];
$img_extenion1 = pathinfo($aadhaar , PATHINFO_EXTENSION);
$img_tmp2 = $image2['tmp_name'];
$dest2 = "$dir/". $aadhaar;

// adhaarback 3 upload
$image3 = $_FILES['passbook'];
$passbook = $image3['name'];
$img_extenion2 = pathinfo($passbook , PATHINFO_EXTENSION);
$img_tmp3 = $image3['tmp_name'];
$dest3 = "$dir/" . $passbook;

// pan  upload
$image4 = $_FILES['pan'];
$pan = $image4['name'];
$img_extenion3 = pathinfo($pan , PATHINFO_EXTENSION);
$img_tmp4 = $image4['tmp_name'];
$dest4 = "$dir/" . $pan;
    
$array = array("jpg"  , "jpeg" , "png", "pdf", "");
if(in_array($img_extenion1 , $array) && in_array($img_extenion2 , $array) && in_array($img_extenion3 , $array) && in_array($img_extenion4 , $array) && in_array($img_extenion5 , $array) && in_array($img_extenion6 , $array) ){
 
$bankDetails  = json_decode($_POST['bankDetails'], true);
extract($bankDetails);

    $sql = "UPDATE user_profile SET AADHAAR='$AADHAAR', AADHAR_CARD_NO ='$AADHAR_CARD_NO', PAN= '$PAN' , PAN_CARD_NO ='$PAN_CARD_NO', BANK='$BANK', B_NAME='$B_NAME', AC_HOLDER_NAME ='$AC_HOLDER_NAME', AC_NUM='$AC_NUM', IFSC_CODE='$IFSC_CODE', PASSBOOK ='$PASSBOOK' WHERE USER_ID='$user_id'";
        if(mysqli_query($con, $sql)){
            
            move_uploaded_file($img_tmp2, $dest2);
            move_uploaded_file($img_tmp3, $dest3);
            move_uploaded_file($img_tmp4, $dest4);
            
            
            $myArr = array(
            "status" =>true,
            "message" =>"Updated",
            "response_code"=>1
        );
        echo json_encode($myArr);
    }   
    
}
else{
    
    $myArr = array(
        "status" =>false,
        "message" =>"Only Jpg, Jpeg ,Png Images are allowed",
        "response_code"=>3
    );
    echo json_encode($myArr);
    
}
    
}


?>