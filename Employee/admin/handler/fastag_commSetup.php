<?php

include("../../Db/config.php");

if(count($_POST)>0){
	if($_POST['Fastag_type']==1){
$user_comm = $_POST['user_comm'];
$com_name = $_POST['company_name'];
$pack_name = $_POST['pack_name'];

// $sql = "INSERT INTO `commission_package`(`USER_TYPE`, `COMM_TYPE`, `COMPANY_NAME`) VALUES ('$USER_TYPE','$COMM_TYPE','$COMPANY_NAME')";

$sql = $con->query("INSERT INTO `commission_package`(`MAIN_OWNER`, `MAIN_OWNER_ID`, `OWNER`, `OWNER_ID`, `USER_TYPE`, `COMPANY_NAME`, `PACKAGE_NAME`, `SERVICES`, `COMM_TYPE`, `STATUS`)
VALUES ('ADMIN','1','1','1','$user_comm','$com_name','$pack_name','Fastag','SLAB','Active')");

// echo "$sql";
// die();
// $result = $con->query($sql);


if($sql){
    echo "Fastag Commission Setup Succssfully Created .";
     
}else{
    echo "Fastag Commission Setup Doesn't Add Successfully!";
}
}
}
// display here Commission type : Agent

if(isset($_POST['id']) && $_POST['id'] == 1){
    
$i = 1;
$output = "";
      $res = $con->query("SELECT * FROM `commission_package` WHERE USER_TYPE='46' AND SERVICES='Fastag' ORDER BY ID DESC");
      
 if($res->num_rows >0){
     
    while($row = $res->fetch_assoc()){
    
    $output .= "<tr>
    
    <td>".$i++."</td>
    <td>{$row['PACKAGE_NAME']}</td>
    <td>{$row['DATE']}</td>
    <td><a href='SetBBPSFasTagCommission.php?pack_id={$row['ID']}' class='badge badge-info right'>Go For Setup</a></td>
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
      $res = $con->query("SELECT * FROM `commission_package` WHERE USER_TYPE='company' AND SERVICES='Fastag' ORDER BY ID DESC");
      
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
if(count($_POST)>0){
	if($_POST['type']==3){
		$id=$_POST['id'];
		$sql = "DELETE FROM `commission_package` WHERE ID=$id ";
		if (mysqli_query($con, $sql)) {
			echo $id;
		} 
		else {
			echo "Error: " . $sql . "<br>" . mysqli_error($conn);
		}
		mysqli_close($conn);
	}
}


//Go For Setup Code for Fastag 


 if(isset($_POST["pageid"]) && $_POST["pageid"] == 1)  
 {  
      $packid = $_POST['packId'];
      $start_range = mysqli_real_escape_string($con, $_POST["start_range"]);  
      $end_range = mysqli_real_escape_string($con, $_POST["end_range"]);  
      $retailer_comm = mysqli_real_escape_string($con, $_POST["retailer_comm"]);  
      $charges = mysqli_real_escape_string($con, $_POST["charges"]);  
      $amount_type = mysqli_real_escape_string($con, $_POST["amount_type"]);  
      $distributor_comm = mysqli_real_escape_string($con, $_POST["distributor_comm"]);  
      $gst = mysqli_real_escape_string($con, $_POST["gst"]);  
      $tds = mysqli_real_escape_string($con, $_POST["tds"]);
      $comm_type = mysqli_real_escape_string($con, $_POST["comm_type"]);
      
      $query = "INSERT INTO `slab_commission`(`MAIN_OWNER`, `MAIN_OWNER_ID`, `OWNER`, `OWNER_ID`, `COMM_PACK_ID`, `MIN_AMOUNT`, `MAX_AMOUNT`, `TDS`, `GST`, `TYPE`, `AMOUNT_TYPE`, `AMOUNT`, `STATUS`, `CHARGE`, `DS_COM`, `MS_COM`) 
      VALUES ('ADMIN','1','1','1','$packid','$start_range','$end_range','$tds','$gst','$comm_type','$amount_type','$retailer_comm','0','$charges','$distributor_comm','0')";  
      
      if(mysqli_query($con, $query))  
            {  
           echo '<script type="text/javascript">alert("Fastag Commission Created")  
           location.replace("fastag_commSetup.php?pack_id='.$packid.'")
</script>';

      }else{
           echo '<script type="text/javascript">alert("Failed to Create Fastag Commission")  
             location.replace("fastag_commSetup.php")
</script>';
          
      }   
 } 
 
 //delete query
 
  if(isset($_POST["pageid"]) && $_POST["pageid"] == 2)  
 { 

function delete(){
  global $con;

  $ID = $_POST["ID"];

 mysqli_query($con, "DELETE FROM `slab_commission` WHERE ID = $ID");
  echo "DATA DELETE SUCCESSFULLY";
}

if(isset($_POST["action"])){
  // Choose a function depends on value of $_POST["action"]
  if($_POST["action"] == "delete"){
    delete();
  }
}

}


?>