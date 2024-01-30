<?php

include("../../Db/config.php");
if(count($_POST)>0){
	if($_POST['BBPS_type']==1){
$user_comm = $_POST['user_comm'];
$com_name = $_POST['company_name'];
$pack_name = $_POST['pack_name'];
$ser_name = $_POST['ser_name'];

// $sql = "INSERT INTO `commission_package`(`USER_TYPE`, `COMM_TYPE`, `COMPANY_NAME`) VALUES ('$USER_TYPE','$COMM_TYPE','$COMPANY_NAME')";

$sql = $con->query("INSERT INTO `commission_package`(`MAIN_OWNER`, `MAIN_OWNER_ID`, `OWNER`, `OWNER_ID`, `USER_TYPE`, `COMPANY_NAME`, `PACKAGE_NAME`, `SERVICES`, `COMM_TYPE`, `STATUS`)
VALUES ('ADMIN','1','1','1','$user_comm','$com_name','$pack_name','$ser_name','SLAB','Active')");

// echo "$sql";
// die();
// $result = $con->query($sql);


if($sql){
    echo "BBPS Online Commission Setup Succssfully Created .";
     
}else{
    echo "BBPS Online Commission Setup Doesn't Add Successfully!";
}
}
}
// display here Commission type : Agent

if(isset($_POST['id']) && $_POST['id'] == 1){
    
$i = 1;
$output = "";
$ar = ["EMI" , "DATACARDPREPAID" , "DIGITALVOUCHER" , "MUNICIPALITY" , "LPG" , "HOSPITAL" , "CABLE" , "TRAFFICCHALLAN" , "LANDLINE" , "POSTPAID" , "WATER", "INSURANCE" , "ELECTRICITY" , "BROADBAND" , "GAS" , "EMI"];
foreach($ar as $word){
    $allwords[] = "SERVICES LIKE 'OFFLINE_$word'";
}
      $res = $con->query("SELECT * FROM `commission_package` WHERE USER_TYPE='46' AND ".implode(" OR ", $allwords)." ORDER BY ID DESC");
    //   echo "SELECT * FROM `commission_package` WHERE USER_TYPE='46' AND ".implode(" OR ", $allwords)." ORDER BY ID DESC";
 if($res->num_rows >0){
    while($row = $res->fetch_assoc()){
    
    $output .= "<tr>
    
    <td>".$i++."</td>
    <td>{$row['PACKAGE_NAME']}</td>
    <td>{$row['SERVICES']}</td>
    <td>{$row['DATE']}</td>
    <td><a href='SetBBPSOfflineBBPSCommission.php?pack_id={$row['ID']}' class='badge badge-info right'>Go For Setup</a></td>
    <td><a href='#' class='fas fa-edit' name='edit' data-toggle='modal' data-target='#exampleModaledit' id='{$row['id']}'></a>&nbsp;  &nbsp; <a href='#deleteEmployeeModal' class='delete' data-id='{$row['ID']}' data-toggle='modal'><i class='fas fa-trash'></i></i></a></td>
    </tr>";
    
}
}
echo $output;

}

// display here Commission type : Company
if(isset($_POST['id']) && $_POST['id'] == 2){
    
$i = 1;
$output = "";
      $res = $con->query("SELECT * FROM `commission_package` WHERE USER_TYPE='company' AND SERVICES='OFFLINE_BBPS' ORDER BY ID DESC");
 if($res->num_rows >0){
    while($row = $res->fetch_assoc()){
    $output .= "<tr>
    <td>".$i++."</td>
    <td>{$row['COMPANY_NAME']}</td>
    <td>{$row['PACKAGE_NAME']}</td>
    <td>{$row['DATE']}</td>
    <td><span class='badge badge-info right'>Go For Setup</span></td>
    <td><a href='#' class='fas fa-edit' name='edit' data-toggle='modal' data-target='#exampleModaledit' id='{$row['id']}'></a>&nbsp;  &nbsp; <a href='#deleteEmployeeModal' class='delete' data-id='{$row['ID']}' data-toggle='modal'><i class='fas fa-trash'></i></i></a></td>
    </tr>";
    
}
}
echo $output;

}

// Delete query

if($_POST['type']==3){
		$id=$_POST['id'];
		$sql = $con->query("DELETE FROM `commission_package` WHERE ID=$id ");
		if ($sql){
		    echo 1;
		}else{
		    echo 0;
		};
	
	};


?>