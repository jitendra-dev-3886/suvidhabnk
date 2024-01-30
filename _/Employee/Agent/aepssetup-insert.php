<?php

include("../../Db/config.php");

$user_comm = $_POST['user_comm'];
$com_name = $_POST['company_name'];
$pack_name = $_POST['pack_name'];

// $sql = "INSERT INTO `commission_package`(`USER_TYPE`, `COMM_TYPE`, `COMPANY_NAME`) VALUES ('$USER_TYPE','$COMM_TYPE','$COMPANY_NAME')";

$sql ="INSERT INTO `commission_package`(`MAIN_OWNER`, `MAIN_OWNER_ID`, `OWNER`, `OWNER_ID`, `USER_TYPE`, `COMPANY_NAME`, `PACKAGE_NAME`, `SERVICES`, `COMM_TYPE`, `STATUS`)
VALUES ('ADMIN','1','1','1','$user_comm','$com_name','$pack_name','Aeps','slab','Active') ";

$result = $conn->query($sql);

if($result){
   echo "AePsServicesAePsCommissionSetup Add Successfully.";
 }else{
   echo "AePsServicesAePsCommissionSetup Doesn't Add Successfully!";
}


?>