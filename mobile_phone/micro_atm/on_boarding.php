<?php




if(isset($_POST['first_name'])){
    
        include("../includes/config.php");
        $user_id = $_POST['user_id'];
        $first_name = $_POST['first_name'];
        $last_name = $_POST['last_name'];
        $email = $_POST['email'];
        $mobile = $_POST['mobile'];
        $aadhaar_no = $_POST['aadhaar_no'];
        $pan_no = $_POST['pan_no'];
        $serial_no = $_POST['serial_no'];
        $front_aadhaar = $_POST['front_aadhaar'];
        $back_aadhaar = $_POST['back_aadhaar'];
        $front_pan = $_POST['front_pan'];
        $back_pan = $_POST['back_pan'];
        $serial_image = $_POST['serial_image'];
        $date = date("Y-m-d H:i:s");
        
        $serial_name = generateRandomString(10).'_serial.png';
        $front_aadhaar_name = generateRandomString(10).'front_aadhaar.png';
        $back_aadhaar_name = generateRandomString(10).'back_aadhaar.png';
        $front_pan_name = generateRandomString(10).'front_pan.png';
        $back_pan_name = generateRandomString(10).'back_pan.png';
        
            
            $InsertProfilePath = "images/";
            
            //front _aadhaar    
            $data = base64_decode($front_aadhaar);
            $insertion = $InsertProfilePath.$front_aadhaar_name;
            file_put_contents("$insertion" ,$data);
            
            
            //back aadhaar
            $data = base64_decode($back_aadhaar);
            $insertion = $InsertProfilePath.$back_aadhaar_name;
            file_put_contents("$insertion" ,$data);
            
            
            //front pan    
            $data = base64_decode($front_pan);
            $insertion = $InsertProfilePath.$front_pan_name;
            file_put_contents("$insertion" ,$data);
            
            
            //back pan
            $data = base64_decode($back_pan);
            $insertion = $InsertProfilePath.$back_pan_name;
            file_put_contents("$insertion" ,$data);
            
            //serial image
            $data = base64_decode($serial_image);
            $insertion = $InsertProfilePath.$serial_name;
            file_put_contents("$insertion" ,$data);
            

        
        $mysql_qry = "select * FROM `bankit_matm` WHERE MOBILE ='$mobile'";
        $result = mysqli_query($con ,$mysql_qry);
        if(mysqli_num_rows($result) > 0) {
            
            $sql = "UPDATE `bankit_matm` SET `USER_ID`='$user_id', `FIRST_NAME`='$first_name',`LAST_NAME`='$last_name',`SERIAL_NUMBER`='$serial_no',`SERIAL_NUMBER_PHOTO`='$serial_name',`ADDHAR_FRONT`='$front_aadhaar_name',`ADDHAR_BACK`='$back_aadhaar_name',`PAN_FRONT`='$front_pan_name',`PAN_BACK`='$back_pan_name',`EMAIL`='$email',`STATUS`='PENDING',`DATE`='$date',`AADHAAR_NO`='$aadhaar_no',`PAN_NO`='$pan_no' WHERE MOBILE='$mobile'";
        $updation = mysqli_query($con, $sql);
             
             if($updation){       
                $myArr = array(
                "status" =>true,
                "message" =>"Re-Applied for OnBoarding"
                );

                echo json_encode($myArr);
             }else{
                $myArr = array(
                "status" =>false,
                "message" =>"Failed to Re-Apply for OnBoarding"
                );
                echo json_encode($myArr);
            }
            
            
            
    
        }
        else{
            
            $query = "INSERT INTO `bankit_matm`(`USER_ID`,`FIRST_NAME`, `LAST_NAME`, `SERIAL_NUMBER`, `SERIAL_NUMBER_PHOTO`,`AADHAAR_NO`,`PAN_NO`, `ADDHAR_FRONT`, `ADDHAR_BACK`, `PAN_FRONT`, `PAN_BACK`, `MOBILE_NUMBER`, `EMAIL`, `STATUS`, `DATE`)
            VALUES ('$user_id','$first_name','$last_name','$serial_no','$serial_name','$aadhaar_no','$pan_no','$front_aadhaar_name','$back_aadhaar_name','$front_pan_name','$back_pan_name','$mobile','$email','PENDING','$date')";
            $insertion = $run_query = mysqli_query($con , $query);
            
            if($insertion){
            
                $myArr = array(
                "status" =>true,
                "message" =>"Applied for OnBoarding"
                );
                echo json_encode($myArr);
                
            }else{
                $myArr = array(
                "status" =>false,
                "message" =>"Failed to Apply for OnBoarding"
                );
                echo json_encode($myArr);
                
            }
            
            
        }
    
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