<?php
session_start();
require_once('../../Db/config.php');
require("../include/Auth.php");

if(isset($_POST['pageid']) && $_POST['pageid'] == 0){
     $fromdate = $_POST['formdate'];
     $todate = $_POST['todate'];

 $i = 1;
 
  $sql = "SELECT * FROM fastag_transaction WHERE date(DATE) BETWEEN '$fromdate' AND '$todate' ORDER BY ID DESC";

$result = mysqli_query($con, $sql) or die("SQL Query Failed.");
$userdata = "";
// echo $member;
  $userdata .= '<table id="example1" class="table table-bordered table-striped">
        
                  <thead>
                  <tr>
                    <th>Sr. No.</th>
                    <th>Member ID</th>
                    <th>Date and Time</th>
                    <th>Oprator Name</th>
                    <th>Amount</th>
                    <th>Operator Id</th>
                    <th>Refference Id</th>
                    <th>Status</th>
                  </tr>
                  </thead>
                  <tbody>';

              while($row = mysqli_fetch_assoc($result)){
                   $response_data = json_decode($row['RESPONSE'],true); 
                   $response_check_data = json_decode($row['CHECK_RESPONSE'],true); 
                   $OIPID = $row['OPERATORID'];
                   $op_data = $response_data['operatorid'];
                   $op_check_data = $response_check_data['operatorid'];
                   if($OIPID !== null){
                       $opid = $OIPID;
                   }else if($op_data !== null){
                       $opid = $op_data;
                   }else{
                       $opid = $op_check_data;
                   }
                       
                   $memberId=$row['USER_ID'];
                   $memid=$con->query("SELECT * FROM `user` WHERE ID='$memberId'")->fetch_assoc();
                $userdata .= "<tr>
                    <td>".$i++."</td>
                    <td>{$memid['PARTNER_ID']}</td>
                    <td>{$row['DATE']}</td>
                    <td>{$row['OP_NAME']}</td>
                    <td>{$row['AMOUNT']}</td>
                    <td>{$opid}</td>
                    <td>{$row['REFFRENCE_ID']}</td>
                    <td>{$row['STATUS']}</td>
                   
                 </tr>";
              }
    $userdata .= " </tfoot>
                  
                </table>";
                

    echo $userdata;
}


if(isset($_POST['pageid']) && $_POST['pageid'] == 1){

 $fromdate = $_POST['formdate'];
  $todate = $_POST['todate'];
 $i = 1;

  $sql = "SELECT * FROM fastag_transaction WHERE date(DATE) BETWEEN '{$fromdate}' AND '{$todate}'";
  $response_data = json_decode($sql['RESPONSE'],true);


$result = mysqli_query($con, $sql) or die("SQL Query Failed.");
$userdata = "";


  $userdata .= '<table id="example1" class="table table-bordered table-striped">
        
                  <thead>
                  <tr>
                    <th>Sr. No.</th>
                    <th>Member ID.</th>
                    <th>Date and Time</th>
                    <th>Oprator Name</th>
                    <th>Amount</th>
                    <th>Operator Id</th>
                    <th>Refference Id</th>
                    <th>Status</th>
                  </tr>
                  </thead>
                  <tbody>';

              while($row = mysqli_fetch_assoc($result)){
                   $memberId=$row['USER_ID'];
                   $memid=$con->query("SELECT * FROM `user` WHERE ID='$memberId'")->fetch_assoc();
                $userdata .= "<tr>
                    <td>".$i++."</td>
                    <td>{$memid['PARTNER_ID']}</td>
                    <td>{$row['DATE']}</td>
                    <td>{$row['OP_NAME']}</td>
                    <td>{$row['AMOUNT']}</td>
                    <td>{$response_data['operatorid']}</td>
                    <td>{$row['REFFRENCE_ID']}</td>
                    <td>{$row['STATUS']}</td>
                   
                 </tr>";
              }
    $userdata .= " </tfoot>
                  
                </table>";
                

    echo $userdata;
}