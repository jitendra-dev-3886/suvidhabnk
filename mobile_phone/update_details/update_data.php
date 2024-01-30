<?php
    
    include("../includes/config.php");
    include("../includes/imagepaths.php");
    
    if(isset($_POST['update_profile_details'])){
        
        $id = $_POST['id'];
        $user_type_id = $_POST['user_type_id'];
        $mobile = $_POST['mobile'];
        $password = $_POST['password'];
        $f_name = $_POST['f_name'];
        $l_name = $_POST['l_name'];
        $a_number = $_POST['a_number'];
        $dob = $_POST['dob'];
        $gender = $_POST['gender'];
        $country = $_POST['country'];
        $state = $_POST['state'];
        $pin = $_POST['pin'];
        $address = $_POST['address'];
        $token_id = $_POST['token'];
        
        
        
        $mysql_qry = "select * FROM user WHERE MOBILE ='$mobile' AND PASSWORD = '$password' AND TOKEN_ID = '$token_id'";
        $result = mysqli_query($con ,$mysql_qry);
        if(mysqli_num_rows($result) > 0) {
            
            $sql = "UPDATE `user` SET `FIRST_NAME`='$f_name',`LAST_NAME`='$l_name',`ADDRESS`='$address',`CITY`='$address',`STATE`='$state',`PIN`='$pin' WHERE ID='$id' AND MOBILE='$mobile' AND PASSWORD='$password'";
            mysqli_query($con, $sql);
            
             $row = mysqli_fetch_array($result);
            
        $mysql = "select * FROM user_profile WHERE USER_ID ='$id'";
        $my_result = mysqli_query($con ,$mysql);
        if(mysqli_num_rows($my_result) > 0) {
            //update_older
            $sql_profile = "UPDATE `user_profile` SET `ALTERNATE_PHONE_NO`='$a_number',`DOB`='$dob',`GENDER`='$gender',`COUNTRY`='$country',`STATE`='$state' WHERE USER_ID='$id'";
            mysqli_query($con, $sql_profile);   
            
                $myArr = array(
                "status" =>true,
                "message" =>"Profile Updated",
                "code"=>0
                );

            echo json_encode($myArr);
            
        }
        else{
            
            $main_owner = $row['MAIN_OWNER'];
            $main_owner_id = $row['MAIN_OWNER_ID'];
         
            $query = "INSERT INTO `user_profile`(`MAIN_OWNER`, `MAIN_OWNER_ID`, `OWNER_ID`, `USER_ID`, `ALTERNATE_PHONE_NO`, `DOB`, `GENDER`, `COUNTRY`, `STATE`,`PROFILE_IMG`,`FACEBOOK_URL`,`TWITTER_URL`,`LINKEDIN_URL`,`INSTAGRAM_URL`,`DRIBBLE_BOX_URL`,`DROPBOX_URL`,`GOOGLE_PLUS_URL`,`PINTEREST_URL`,`SKYPE_URL`,`VINE_URL`,`AADHAR_CARD_NO`,`PAN_CARD_NO`,`BANK`,`B_NAME`,`AC_HOLDER_NAME`,`AC_NUM`,`IFSC_CODE`,`PASSBOOK`)
            VALUES ('$main_owner','$main_owner_id','$main_owner_id','$id','$a_number','$dob','$gender','$country','$state','','','','','','','','','','','','','','','','','','','')";
            $run_query = mysqli_query($con , $query);
        
                $myArr = array(
                "status" =>true,
                "message" =>"Profile Updated",
                "code"=>0
                );

            echo json_encode($myArr);

            
        }
            
            
            
            
        }else{
            
                $myArr = array(
                "status" =>false,
                "message" =>"Credentails unsatisfied",
                "code"=>0
                );

            echo json_encode($myArr);
            
            
        }
    
        
    }


    if(isset($_POST['update_social_media'])){
        
        $id = $_POST['id'];
        $user_type_id = $_POST['user_type_id'];
        $mobile = $_POST['mobile'];
        $token_id = $_POST['token'];
        $password = $_POST['password'];
        $facebook_url = $_POST['facebook_url'];
        $twitter_url = $_POST['twitter_url'];
        $linkedin_url = $_POST['linkedin_url'];
        $instagram_url = $_POST['instagram_url'];
        $dribble_box_url = $_POST['dribble_box_url'];
        $dropbox_url = $_POST['dropbox_url'];
        $google_plus = $_POST['google_plus'];
        $pintrest = $_POST['pintrest'];
        $skype_url = $_POST['skype_url'];
        $vine_url = $_POST['vine_url'];
        
        
                $mysql_qry = "select * FROM user WHERE MOBILE ='$mobile' AND PASSWORD = '$password' AND TOKEN_ID = '$token_id'";
        $result = mysqli_query($con ,$mysql_qry);
        if(mysqli_num_rows($result) > 0) {
            
            
        $mysql = "select * FROM user_profile WHERE USER_ID ='$id'";
        $my_result = mysqli_query($con ,$mysql);
        if(mysqli_num_rows($my_result) > 0) {
            //update_older
            $sql_profile = "UPDATE `user_profile` SET `FACEBOOK_URL`='$facebook_url',`TWITTER_URL`='$twitter_url',`LINKEDIN_URL`='$linkedin_url',`INSTAGRAM_URL`='$instagram_url',`DRIBBLE_BOX_URL`='$dribble_box_url',`DROPBOX_URL`='$dropbox_url',`GOOGLE_PLUS_URL`='$google_plus',
            `PINTEREST_URL`='$pintrest',`SKYPE_URL`='$skype_url',`VINE_URL`='$vine_url' WHERE USER_ID='$id'";
            mysqli_query($con, $sql_profile);   
            
                $myArr = array(
                "status" =>true,
                "message" =>"Social Media Updated",
                "code"=>0
                );

            echo json_encode($myArr);
            
        }
        else{
            
            $main_owner = $row['MAIN_OWNER'];
            $main_owner_id = $row['MAIN_OWNER_ID'];
         
            $query = "INSERT INTO `user_profile`(`MAIN_OWNER`, `MAIN_OWNER_ID`, `OWNER_ID`, `USER_ID`, `ALTERNATE_PHONE_NO`, `DOB`, `GENDER`, `COUNTRY`, `STATE`,`PROFILE_IMG`,`FACEBOOK_URL`,`TWITTER_URL`,`LINKEDIN_URL`,`INSTAGRAM_URL`,`DRIBBLE_BOX_URL`,`DROPBOX_URL`,`GOOGLE_PLUS_URL`,`PINTEREST_URL`,`SKYPE_URL`,`VINE_URL`,`AADHAR_CARD_NO`,`PAN_CARD_NO`,`BANK`,`B_NAME`,`AC_HOLDER_NAME`,`AC_NUM`,`IFSC_CODE`,`PASSBOOK`)
            VALUES ('$main_owner','$main_owner_id','$main_owner_id','$id','$a_number','$dob','$gender','$country','$state','','$facebook_url','$twitter_url','$linkedin_url','$instagram_url','$dribble_box_url','$dropbox_url','$google_plus','$pintrest','$skype_url','$vine_url','','','','','','','','')";
            $run_query = mysqli_query($con , $query);
        
                $myArr = array(
                "status" =>true,
                "message" =>"Profile Updated",
                "code"=>0
                );

            echo json_encode($myArr);

            
        }
            
            
        
        }else{
            
                $myArr = array(
                "status" =>false,
                "message" =>"Credentails unsatisfied",
                "code"=>0
                );

            echo json_encode($myArr);
            
            
        }

        
    }


    if(isset($_POST['update_my_password'])){
        
        $id = $_POST['id'];
        $user_type_id = $_POST['user_type_id'];
        $mobile = $_POST['mobile'];
        $token_id = $_POST['token'];
        $password = $_POST['password'];
        $new_password = $_POST['new_password'];
            
            
        $mysql_qry = "select * FROM user WHERE MOBILE ='$mobile' AND PASSWORD = '$password' AND TOKEN_ID = '$token_id'";
        $result = mysqli_query($con ,$mysql_qry);
        if(mysqli_num_rows($result) > 0) {
            
            
            
            //update_older
            $sql_profile = "UPDATE `user` SET `PASSWORD`='$new_password' WHERE ID='$id'";
            mysqli_query($con, $sql_profile);   
            
                $myArr = array(
                "status" =>true,
                "message" =>"Password Updated",
                "code"=>0
                );

            echo json_encode($myArr);
            
            
    
        
        }else{
            
                $myArr = array(
                "status" =>false,
                "message" =>"Credentails unsatisfied",
                "code"=>0
                );

            echo json_encode($myArr);
            
            
        }
            
            
        }


    if(isset($_POST['profile_picture'])){
        
        $p_image =  $_POST['profile_picture'];
        $id = $_POST['id'];
        $password = $_POST['password'];
        $token = $_POST['token'];
        
        
        $mysql_qry = "select * FROM user WHERE ID ='$id' AND PASSWORD = '$password' AND TOKEN_ID= '$token'";
        $result = mysqli_query($con ,$mysql_qry);
        if(mysqli_num_rows($result) > 0) {
            
            $data = base64_decode($p_image);
            $imageName = generateRandomString(12).".png";
            $insertion = $InsertProfilePath.$imageName;
            file_put_contents("$insertion" ,$data);
            
            
            $check_qry = "select * FROM `user_profile` WHERE USER_ID ='$id'";
            $check = mysqli_query($con ,$check_qry);
            if(mysqli_num_rows($check) == 0) {
            
            $query = "INSERT INTO `user_profile`(`MAIN_OWNER`, `MAIN_OWNER_ID`, `OWNER_ID`, `USER_ID`, `ALTERNATE_PHONE_NO`, `DOB`, `GENDER`, `COUNTRY`, `STATE`,`PROFILE_IMG`,`FACEBOOK_URL`,`TWITTER_URL`,`LINKEDIN_URL`,`INSTAGRAM_URL`,`DRIBBLE_BOX_URL`,`DROPBOX_URL`,`GOOGLE_PLUS_URL`,`PINTEREST_URL`,`SKYPE_URL`,`VINE_URL`,`AADHAR_CARD_NO`,`PAN_CARD_NO`,`BANK`,`B_NAME`,`AC_HOLDER_NAME`,`AC_NUM`,`IFSC_CODE`,`PASSBOOK`)
            VALUES ('$main_owner','$main_owner_id','$main_owner_id','$id','$a_number','$dob','$gender','$country','$state','','$facebook_url','$twitter_url','$linkedin_url','$instagram_url','$dribble_box_url','$dropbox_url','$google_plus','$pintrest','$skype_url','$vine_url','','','','','','','','')";
            $run_query = mysqli_query($con , $query);
                
            }
            
            
            $sql_profile = "UPDATE `user_profile` SET `PROFILE_IMG` ='$imageName' WHERE USER_ID='$id'";
            if(mysqli_query($con, $sql_profile)){
                    
            $myArr = array(
                "status"=>true,
                "response_code"=>1,
                "message"=>"Profile Picture updated",
                "txnstatus"=>1
                );
            echo json_encode($myArr);      
                
            }else{
                
                $myArr = array(
                "status"=>false,
                "response_code"=>2,
                "message"=>"Failed due to internal server issue",
                "txnstatus"=>2
                );
            echo json_encode($myArr);
                
            }   
        
            
            
            
        }
        else{
            
            $myArr = array(
                "status"=>false,
                "response_code"=>0,
                "message"=>"You are not authorised",
                "txnstatus"=>0
                );
            echo json_encode($myArr);
        }
        
        
        
    }
    
    
    function save_base64_image($base64_image_string, $output_file_without_extension, $path_with_end_slash="" ) {

    $splited = explode(',', substr( $base64_image_string , 5 ) , 2);
    $mime=$splited[0];
    $data=$splited[1];
    $mime_split_without_base64=explode(';', $mime,2);
    $mime_split=explode('/', $mime_split_without_base64[0],2);
    if(count($mime_split)==2)
    {
        $extension=$mime_split[1];
        if($extension=='jpeg')$extension='jpg';
        $output_file_with_extension=$output_file_without_extension.'.'.$extension;
    }
    file_put_contents( $path_with_end_slash . $output_file_with_extension, base64_decode($data) );
    return $output_file_with_extension;
}



function generateRandomString($length) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}

?>