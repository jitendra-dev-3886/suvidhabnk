<?php

include("../Db/config.php");
include("Backend/Functions/all_function.php");

$i = 1;

if(isset($_POST['pageid']) && $_POST['pageid'] == 1){
    
    $fetch_id = $con->query("select ID from employee order by ID desc")->fetch_assoc();
    $id = $fetch_id["ID"]+1;
    
$emp_id = "PYD000".$id;
$department = $_POST['emp_department'];
$emp_name = $_POST['name'];
$mobile = $_POST['mobile'];
$reporting_manager = $_POST['r_manager'];
$email = $_POST['email'];
$address = $_POST['address'];
$state = $_POST['state'];
$district = $_POST['district'];
$block = $_POST['block'];
$lstate = $_POST['lstate'];
$ldist = $_POST['ldist'];
$lblock = $_POST['lblock'];
$menulist = $_POST['sidebarmenu'];
$password = rand(10000000,99999999);
$tmp_id = 1307163843064913554;
$message = urlencode("Congratulations !! Welcome PayDeer Services PVT. LTD. Your Registration is Successfully in PayDeer Your Member I'd Details mention below:- Member ID :- $emp_id Password :- $password Pin :- $password Thank you for join us Team PayDeer");
$subject = "Employee Registration Paydeer Service Pvt Ltd.";
$emessage = "Congratulations !! Welcome PayDeer Services PVT. LTD. Your Registration is Successfully in PayDeer Your Employee Details mention below:- Employee ID :- $emp_id Password :- $password Thank you for join us Team PayDeer";

$result = $con->query("INSERT INTO `employee`(`DEPARTMENT`, `EMPLOYEE_ID`, `EMPLOYEE_NAME`, `MOBILE`, `EMAIL`,`ADDRESS`, `STATE`, `CITY`, `BLOCK`, `LOOKING_STATE`, `LOOKING_CITY`, `LOOCKING_BLOCK`, `REPORTING_MANAGER`, `MENU_LIST`, `PASSWORD`, `STATUS`) VALUES 
('$department','$emp_id','$emp_name','$mobile','$email','$address','$state','$district','$block','$lstate','$ldist','$lblock','$reporting_manager','$menulist','$password','Active')");

if($result){
sendSMS($mobile, $message , $tmp_id);
SendMail($email,$emessage , $subject);
    echo 1;
}else{
     echo 0;
}

}

?>