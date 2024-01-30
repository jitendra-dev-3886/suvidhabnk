// <?php

// include("../includes/configuration.php");
// include("../includes/main_function.php");

//         if(isset($_POST['fname'])){
        
//         $fname = $_POST['fname'];
//         $lname = $_POST['lname'];
//         $mobile = $_POST['mobile']; 
//         $email = $_POST['email'];
//         $password = $_POST['password'];
//         // $tc = $_POST['tc'];
//         // $newsletter = $_POST['newsletter'];
//         $date = date("Y-m-d H:i:s");
//         $admin_email ="username@companyname.com";
//         // $user_failed_msg = "";
//         $rows = $con->query("select * from user where MOBILE='$mobile' and US_STATUS='Active'")->num_rows;
//         if($rows < 1){
//             $query = "INSERT INTO `user`(`MAIN_OWNER`, `MAIN_OWNER_ID`, `TOKEN_ID`, `USER_TYPE`, `OWNER_ID`, `SERVICES`, `FIRST_NAME`, `LAST_NAME`, `MOBILE`,
//             `EMAIL`, `MAIN_BAL`, `AEPS_BAL`, `ADDRESS`, `CITY`, `STATE`, `PIN`, `ADHAAR`, `PAN`, `RC_COMM`, `AEPS_COMM`, `DMT_COMM`, `US_STATUS`, `PASSWORD`, `OTP`, 
//             `LOGIN_AUTH`, `DATE`) VALUES ('Admin','1','','46','ADMIN','','$fname','$lname','$mobile','$email','0','0',
//             '','','','','','','','','','Active','$password','1','1','$date')";
//             $run_query = mysqli_query($con , $query);
         
//             if($run_query){
                        
//                     echo "Account created";
//                 }
//             else{
                
//                  echo "Error: 500";
//             }
//         }
//         else{
//                 echo "Failed: 403 Mobile Already Exist";
//         }
//     }




?>