<?php
session_start();
require_once('../../Db/config.php');
require("../include/Auth.php");
include("function.php");
include("../Backend/Userinfo/getuserinfo.php");
include("../Backend/Functions/all_function.php");
include("../Backend/Auth/userdata.php");
$id = $_SESSION['UsId'];

date_default_timezone_set("Asia/Calcutta");   //India time (GMT+5:30)
 $reqDate =  date('d-m-Y H:i:s');



// Insert Code
if(isset($_POST['device'])){

$device=filterThis($_POST['device']);
$quantity=filterThis($_POST['quantity']);
$status=Pending;

    $sql="INSERT INTO `m_atm`(`USER_ID`, `DEVICE_NAME`, `QUANTITY`, `STATUS`) VALUES ('$usid','$device', '$quantity', '$status')";
    if(mysqli_query($con,$sql)){
    echo json_encode(["status"->true,"response_code"=>1]);
		} 
		else {
			   echo json_encode(["status"->false,"response_code"=>5]);
  		 }
}




// M-ATM report start here
    
    if(isset($_POST['pageid']) && $_POST['pageid'] == 2){
        $fromdate = $_POST['formdate'];
    $todate = $_POST['todate'];
        
 $i = 1;        

  
  $sql = "SELECT * FROM m_atm WHERE USER_ID = '$id' AND date(DATE) between '$fromdate' and '$todate' ORDER BY ID DESC";
//   $sql = "SELECT * FROM m_atm WHERE date(DATE) between '$fromdate' and '$todate' ORDER BY ID DESC";

$result = mysqli_query($con, $sql) or die("SQL Query Failed.");
$userdata = "";


  $userdata .= '<table id="example1" class="table table-bordered table-striped">
        
                  <thead>
                  <tr>
                     <th>Sr. No.</th>
                    <th>Device Name</th>
                    <th>Quantity</th>
                    <th>Status</th>
                    <th>Date & Time</th>
                  </tr>
                  </thead>
                  <tbody>';

              while($row = mysqli_fetch_assoc($result)){
                 
                $userdata .= "<tr>
                    <td>".$i++."</td>
                    <td>".$row['DEVICE_NAME']."</td>
                    <td>".$row['QUANTITY']."</td>
                    <td>{$row['STATUS']}</td>
                    <td>{$row['DATE']}</td>
                 </tr>";
              }
    $userdata .= " </tfoot>
                  
                </table>";
                
             
    

    echo $userdata;
        
    }
?>
