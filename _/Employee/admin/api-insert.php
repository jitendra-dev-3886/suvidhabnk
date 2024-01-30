<?php
$msg="";
$msg1="";
include("config.php");

$NAME = $_POST['NAME'];
$WORKINGTYPE = $_POST['WORKINGTYPE'];
$WORKINGCRITERIA = $_POST['WORKINGCRITERIA'];
$REPORTINGTO = $_POST['REPORTINGTO'];


$sql = "INSERT INTO `department`(`NAME`, `WORKINGTYPE`, `WORKINGCRITERIA`, `REPORTINGTO`) VALUES 
('$NAME','$WORKINGTYPE','$WORKINGCRITERIA','$REPORTINGTO')";

$result = $conn->query($sql);

if($result){
    $msg="Department Add Successfully.";
    echo $msg;
    onsubmitProps.resetForm();
}else{
    $msg1="Department Doesn't Add Successfully!";
     echo $msg1;
     onsubmitProps.resetForm();
}
?>