<?php

include("config.php");

$department = $_POST['department'];
$emp_id = $_POST['emp_id'];
$desgination = $_POST['desgination'];
$emp_name = $_POST['emp_name'];
$office_num = $_POST['office_num'];
$personal_num = $_POST['personal_num'];
$personal_email = $_POST['personal_email'];
$office_email = $_POST['office_email'];
$working_state = $_POST['working_state'];
$working_city = $_POST['working_city'];
$working_block = $_POST['working_block'];
$residence_address = $_POST['residence_address'];
$state = $_POST['state'];
$city = $_POST['city'];
$pincode = $_POST['pincode'];

$sql = "INSERT INTO `employee`(`DEPARTMENT`, `EMPLOYEE_ID`, `DESGINATION`, `EMPLOYEE_NAME`, `OFFICE_NUMBER`, `PERSONAL_NUMBER`, `PERSONAL_EMAIL`, `OFFICE_EMAIL`, `WORKING_STATE`, `WORKING_CITY`, `WORKING_BLOCK`, `RESIDENCE_ADDRESS`, `STATE`, `CITY`, `PINCODE`) VALUES 
('$department','$emp_id','$desgination','$emp_name','$office_num','$personal_num','$personal_email','$office_email','$working_state','$working_city','$working_block','$residence_address','$state','$city','$pincode')";

$result = $conn->query($sql);

if($result){
    echo "Employee Add Successfully.";
}else{
     echo "Employee Doesn't Add Successfully!";
}

?>