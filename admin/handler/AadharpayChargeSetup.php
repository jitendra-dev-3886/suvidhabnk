<?php
include('../../Db/config.php');

 if(count($_POST)>0){
	if($_POST['type']==1){
	    
      $packid = $_POST['packId'];
      $start_range = mysqli_real_escape_string($con, $_POST["start_range"]);  
      $end_range = mysqli_real_escape_string($con, $_POST["end_range"]);  
      $charges = mysqli_real_escape_string($con, $_POST["charges"]);  
      $comm_type = mysqli_real_escape_string($con, $_POST["comm_type"]);
      $amount_type = mysqli_real_escape_string($con, $_POST["amount_type"]);  
      $retailer_comm = mysqli_real_escape_string($con, $_POST["retailer_comm"]);  
      $distributor_comm = mysqli_real_escape_string($con, $_POST["distributor_comm"]);  
      $gst = mysqli_real_escape_string($con, $_POST["gst"]);  
      $tds = mysqli_real_escape_string($con, $_POST["tds"]);
      
      $query = "INSERT INTO `slab_commission`(`MAIN_OWNER`, `MAIN_OWNER_ID`, `OWNER`, `OWNER_ID`, `COMM_PACK_ID`, `MIN_AMOUNT`, `MAX_AMOUNT`, `TDS`, `GST`, `TYPE`, `AMOUNT_TYPE`, `AMOUNT`, `STATUS`, `CHARGE`, `DS_COM`, `MS_COM`) 
      VALUES ('ADMIN','1','1','1','$packid','$start_range','$end_range','$tds','$gst','$comm_type','$amount_type','$retailer_comm','0','$charges','$distributor_comm','0')";  
      
      
    //   $query = "INSERT INTO `slab_commission`(`MAIN_OWNER`, `MAIN_OWNER_ID`, `OWNER`, `OWNER_ID`, `COMM_PACK_ID`, `MIN_AMOUNT`, `MAX_AMOUNT`, `TDS`, `GST`, `TYPE`, `AMOUNT_TYPE`, `AMOUNT`, `STATUS`, `CHARGE`, `DS_COM`, `MS_COM`) 
    //   VALUES ('ADMIN','1','1','1','$packid','$start_range','$end_range','$tds','$gst','$comm_type','$amount_type','$retailer_comm','0','$charges','$distributor_comm','0')"; 
      
    //   echo $query;
    //   die();
      
		if (mysqli_query($con, $query)) {
			echo json_encode(array("statusCode"=>200));
		} 
		else {
		    echo 'Failed to Add';
		}
	}
}
 //display query

if(isset($_POST['id']) && $_POST['id'] == 1){
    
$i = 1;
$output = "";
$com_pack_id= $_POST['pid'];
    $res= $con->query("SELECT * FROM `slab_commission` WHERE COMM_PACK_ID='$com_pack_id' ORDER BY ID DESC");
 if($res->num_rows >0){
    while($row = $res->fetch_assoc()){
    
    $output .= "<tr>

    <td>".$i++."</td>
    <td>{$row['MIN_AMOUNT']}</td>
    <td>{$row['MAX_AMOUNT']}</td>
    <td>{$row['CHARGE']}</td>
    <td>{$row['AMOUNT']}</td>
    <td>{$row['DS_COM']}</td>
    <td>{$row['GST']}</td>
    <td>{$row['TDS']}</td>
    <td>{$row['TYPE']}</td>
    <td>{$row['DATE']}</td>
    <td>{$row['MAIN_OWNER']}</td>
    <td><a href='SetAePsServicesAdharPayCommission1.php?rid={$row['ID']}' class='fas fa-edit'></a>
<a href='#deleteEmployeeModal' class='delete' data-id='{$row['ID']}' data-toggle='modal'><i class='fas fa-trash'></i></i></a></td>
    </tr>";
    
}
}
echo $output;

}
 //display query
  // Delete query
if(count($_POST)>0){
	if($_POST['type']==3){
		$id=$_POST['id'];
		$sql = "DELETE FROM `slab_commission` WHERE ID=$id ";
		if (mysqli_query($con, $sql)) {
			echo $id;
		} 
		else {
			echo "Error: " . $sql . "<br>" . mysqli_error($conn);
		}
		mysqli_close($conn);
	}
}


?>
