<?php
session_start();
require_once('../../Db/config.php');
require("../include/Auth.php");

$id = $_SESSION['UsId'];
date_default_timezone_set("Asia/Calcutta");   //India time (GMT+5:30)
 $actiondate =  date('d-m-Y H:i:s');
if(isset($_POST['pageid']) && $_POST['pageid'] == 6){

$i = 1;
$sql = "SELECT * FROM `ticket` WHERE `STATUS`='Pending' ORDER BY ID DESC";
$result = mysqli_query($con, $sql) or die("SQL Query Failed.");
$userdata = "";


  $userdata .= '<table id="example1" class="table table-bordered table-striped">
        
                  <thead>
                  <tr>
                    <th>Ticket Id</th>
                    <th>Member Id</th>
                    <th>Member Mobile</th>
                    <th>Remark</th>
                    <th>ActionDate</th>
                    <th>Status</th>
                    <th>View Complain</th>
                  </tr>
                  </thead>
                  <tbody>';
              while($row = mysqli_fetch_assoc($result)){
                   $Us_id=$row['USER_ID'];
                   $transid=$row['ID'];
                   $user_Data = $con->query("SELECT * FROM `user` WHERE ID='$Us_id'")->fetch_assoc();
  
                $userdata .= "<tr>
                    <td>{$row['ID']}</td>
                    <td>{$user_Data['PARTNER_ID']}</td>
                    <td>{$user_Data['MOBILE']}</td>
                    <td>{$row['REMARK']}</td>
                    <td>{$row['ACTION_DATE']}</td>
                    <td><span id='resbtn'>{$row['STATUS']}</span></td>
                    <td><button type='button' id='view_complain' data-cid='{$row['ID']}' data-toggle='modal' data-target='#complainmodal'>View Complain</button> </td>
                 </tr>";
              }
    $userdata .= " </tfoot>
                  
                </table>";
                
               
    echo $userdata;
}



if(isset($_POST['pageid']) && $_POST['pageid'] == 1){

$eid = $_POST["eid"];
$complain = $con->query("SELECT * FROM `ticket` WHERE ID = '$eid' ORDER BY ID DESC")->fetch_assoc();
$userdata = "";


                $userdata .= "<ul class='list-group'>
  <li class='list-group-item'>Ticket Id : ".$complain['ID']."</li>
  <li class='list-group-item'>Ticket Date : ".$complain['ISSUE_DATE']."</li>
  <li class='list-group-item'>Transaction Date : ".$complain['TRANSACTION_DATE']."</li>
  <li class='list-group-item'>Department : ".$complain['DEPARTMENT']."</li>
  <li class='list-group-item'>Subject : ".$complain['SUBJECT']."</li>
  <li class='list-group-item'>Description : ".$complain['DESCRIPTION']."</li>
  <li class='list-group-item'>Proof : <img src='/Agent/dist/img/TicketRise/{$complain['PROOF']}' width='100'/></li>
  <span id='resbtn'>
  <input type='button' class='btn-primary transfer_tic' data-id='{$complain['ID']}' data-empid='{$complain['EMPLOYEE_ID']}' id='transferTicket' value='Transfer' data-toggle='modal' data-target='#transfermodal'/>";
  if($complain['STATUS'] != 'Resolve'){
 $userdata .= "<input type='button' id='update_ticket' data-toggle='modal' data-mid='{$complain['ID']}' data-status='{$complain['STATUS']}' data-target='#myModal' class='btn-danger update' value='Update'/>";
  }
  $userdata .= "</span>
</ul>";
                    
                
               
    echo $userdata;
}



// Ticket Transfer'
if(count($_POST)>0){
	if($_POST['type']==1){
             $userid =$_POST['id'];
             $empId =$_POST['empId'];
             $remark =$_POST['remark'];
            //   echo "UPDATE `ticket` SET `EMPLOYEE_ID`='$empId' WHERE ID='$userid'"; die();
             $query2 = $con->query("UPDATE `ticket` SET `EMPLOYEE_ID`='$empId',REMARK='$remark',ACTION_DATE='$actiondate' WHERE ID = '$userid'");
             if($query2){
              echo 1;
             }else{
                  echo 0;
              }
              
}
} 
// Ticket Update
if($_POST['update_hid'] == 3){      
             $status =$_POST['status'];
             $remark =$_POST['remark'];
             $user_id =$_POST['id'];
            //   echo "UPDATE `ticket` SET `STATUS`='$status' WHERE ID='$user_id'"; die();
             $query2 = $con->query("UPDATE `ticket` SET `STATUS`='$status',REMARK='$remark',ACTION_DATE='$actiondate' WHERE ID='$user_id'");
             if($query2){
              echo 1;
             }else{
                  echo "Failed";
              }
              
}
  ?>