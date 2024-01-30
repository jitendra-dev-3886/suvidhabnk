<?php

include("../../../Db/config.php");
$json = file_get_contents('php://input');

if($json!=null || $json!=""){
    
    $data = json_decode($json);
    $mobile_number = str_replace("+91","",$data->mobile_number);
    $applicationId = $data->application_id;
    $status = $data->status;
    $check =  $con->query("INSERT INTO `exoStatusCallback`(`RESPONSE`, `MOBILE`, `STATUS`) VALUES ('$json','$mobile_number','$status')");
    if($status=="success" && $applicationId=="3547a3584f6e46128e0fb4927cee48fc"){
      
       $Mrows = $con->query("select * from user where MOBILE='$mobile_number' ")->num_rows;
       if($Mrows<1){
           
           $partnerid = "PDRT".substr($mobile_number,0,5);
           $query = "INSERT INTO `user`(`MAIN_OWNER`, `MAIN_OWNER_ID`, `TOKEN_ID`, `USER_TYPE`, `PARTNER_ID`, `OWNER_ID`, `SERVICES`, `FIRST_NAME`, `LAST_NAME`, `MOBILE`,
            `EMAIL`, `MAIN_BAL`, `AEPS_BAL`, `ADDRESS`, `CITY`, `STATE`, `PIN`, `ADHAAR`, `PAN`, `RC_COMM`, `AEPS_COMM`, `DMT_COMM`, `US_STATUS`, `PASSWORD`, `OTP`, 
            `LOGIN_AUTH`, `SUBSCRIPTION`) VALUES ('Admin','1','','46', '$partnerid','ADMIN','','$fname','$lname','$mobile_number','$us_email','0','0',
            '','','','','','','','','','Deactive','$password','1','1','-1')";
           
           mysqli_query($con , $query);
           
       }
       
    }
    
    // {"application_id":"3547a3584f6e46128e0fb4927cee48fc","country_code":"IN","mobile_number":"+918240193509","reason":"","status":"success","timestamp":"2022-06-22T13:32:36Z","verification_id":"96e1baec0b9f437ea33cbea51dfb7fae"}
    
    
}
else{
    $check =  $con->query("INSERT INTO `exoStatusCallback`(`RESPONSE`) VALUES ('Empty')");
}


?>