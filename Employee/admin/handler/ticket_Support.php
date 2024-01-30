<?php
session_start();
require_once('../../Db/config.php');
require("../include/Auth.php");

$id = $_SESSION['UsId'];
date_default_timezone_set("Asia/Calcutta");   //India time (GMT+5:30)
 $actiondate =  date('d-m-Y H:i:s');
if(isset($_POST['pageid']) && $_POST['pageid'] == 6){

$i = 1;
$result = $con->query("SELECT * FROM `ticket` WHERE `STATUS` = 'Pending' OR `STATUS` = 'Under Process' ORDER BY `ID` DESC");

  $userdata .= '';
  
              while($row = $result->fetch_assoc()){
                  
                  $fetchuser = $con->query("SELECT PARTNER_ID,MOBILE FROM user WHERE ID = '{$row['USER_ID']}'")->fetch_assoc();
                 
                $userdata .= "<tr>
                    <td>".$i++."</td>
                    <td>{$row['TICKET_ID']}</td>
                    <td>{$fetchuser['PARTNER_ID']}</td>
                    <td>{$fetchuser['MOBILE']}</td>
                    <td>{$row['DEPARTMENT']}</td>
                    <td>{$row['TRANSACTION_ID']}</td>
                    <td>{$row['TRANSACTION_DATE']}</td>
                    <td>{$row['DESCRIPTION']}</td>
                    <td>";
                    
                    if($row['PROOF']==''){ 
                        $userdata .= "Not Uploaded";
                    }else{
                        
                        $userdata .= "<a href='/Agent/dist/img/TicketRise/{$row['PROOF']}' class='btn btn-sm btn-primary' download>Download</a>"; 
                     } 
                    
                    $userdata .= "</td>
                    <td><span id='resbtn'>{$row['STATUS']}</span></td>
                    <td>{$row['ISSUE_DATE']}</td>
                    <td><button type='button' id='view_complain' data-cid='{$row['ID']}' data-toggle='modal' data-target='#complainmodal' class='btn btn-sm btn-primary'>View Complain</button></td>
                 </tr>";
              }
                
               
    echo $userdata;
}

if(isset($_POST['pageid']) && $_POST['pageid'] == 2){

$i = 1;
$sql = "SELECT * FROM `ticket` WHERE STATUS = 'Resolve' ORDER BY ID DESC";
$result = mysqli_query($con, $sql) or die("SQL Query Failed.");
$userdata = "";


              while($row = mysqli_fetch_assoc($result)){
                  
                 $fetchuser = $con->query("SELECT PARTNER_ID,MOBILE FROM user WHERE ID = '{$row['USER_ID']}'")->fetch_assoc();
                 
                $userdata .= "<tr>
                    <td>".$i++."</td>
                    <td>{$row['TICKET_ID']}</td>
                    <td>{$fetchuser['PARTNER_ID']}</td>
                    <td>{$fetchuser['MOBILE']}</td>
                    <td>{$row['DEPARTMENT']}</td>
                    <td>{$row['TRANSACTION_ID']}</td>
                    <td>{$row['TRANSACTION_DATE']}</td>
                    <td>{$row['DESCRIPTION']}</td>
                    <td>";
                    
                    if($row['PROOF']==''){ 
                        $userdata .= "Not Uploaded";
                    }else{
                        
                        $userdata .= "<a href='/Agent/dist/img/TicketRise/{$row['PROOF']}' class='btn btn-sm btn-primary' download>Download</a>"; 
                     } 
                    
                    $userdata .= "</td>
                    <td><span id='resbtn'>{$row['STATUS']}</span></td>
                    <td>{$row['ISSUE_DATE']}</td>
                    
                 </tr>";
              }
   
               
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