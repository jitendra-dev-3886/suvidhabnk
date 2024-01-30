<?php  
 //fetch.php  
 include("config.php");
 
$USER_TYPE=$_POST['USER_TYPE'];
$COMM_TYPE=$_POST['COMM_TYPE'];
$COMPANY_NAME=$_POST['COMPANY_NAME'];

	$sql = "UPDATE `commission_package` SET `USER_TYPE`='$USER_TYPE', `COMM_TYPE`='$COMM_TYPE',
	`COMPANY_NAME`='$COMPANY_NAME',
	 WHERE ID=$ID";
	 
	if (mysqli_query($conn, $sql)) {
		echo json_encode(array("statusCode"=>200));
	} 
	else {
		echo json_encode(array("statusCode"=>201));
	}
	mysqli_close($conn);
 ?>