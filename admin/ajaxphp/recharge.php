<?php

session_start();
require_once('../../Db/config.php');
require("../include/Auth.php");

//Recharge report code here........
    /*  error_reporting(E_ALL);
  ini_set("display_errors",1); */
    if(isset($_POST['pageid']) && $_POST['pageid'] == 4){
        
        $i = 1;

 $fromdate = $_POST['formdate'];
    $todate = $_POST['todate'];
    $status=$_POST['status'];
    
    if($status=='Success'){
        $status="AND LEFT(STATUS, 4) = 'Succ'";
    }else if($status=='Pending'){
        $status="AND LEFT(STATUS, 4) = 'Pend'";
    }else if($status=='Failed'){
        $status="AND LEFT(STATUS, 4) = 'Fail'";
    }
    
    
//  $sql = "SELECT * FROM recharge_transaction WHERE SERVICE = 'Prepaid' AND FILTER_DATE BETWEEN '$fromdate' AND '{$todate}' ORDER BY ID DESC LIMIT 100";
 $sql = "SELECT * FROM recharge_transaction WHERE SERVICE = '8' $status AND FILTER_DATE BETWEEN '$fromdate' AND '$todate' ORDER BY ID DESC LIMIT 100";
//  echo $sql;

$result = mysqli_query($con, $sql) or die("SQL Query Failed.");
$userdata = "";

  $userdata .= '<table id="example1" class="table table-bordered table-striped">
        
                  <thead>
                  <tr>
                        <th>SL No</th>
                        <th>Date</th>
                        <th>User</th>
                        <th>Transaction Details</th>
                        <th>Api</th>
                        <th>Status</th>
                        <th>Old Amount</th>
                        <th>Amount</th>
                        <th>New Amount </th>
                        <th>Recipt</th>
                        <th>Action</th>
                        <th>Api Response</th>
                  </tr>
                  </thead>
                  <tbody>';

              while($row = mysqli_fetch_assoc($result)){
                    $op = explode(",", $row['OPERATOR']);
                     $rc_id= $op['1'];
                     $opid = $op['0'];
                    // $st = explode(",", $row['STATUS']);
                    $service_id= $row['SERVICE'];
                    $user_id = $row['USER_ID'];
                    $refid = $row['REFERENCE_ID'];
                    $user= $con->query("SELECT * FROM `user` WHERE ID='$user_id'")->fetch_assoc();
                    $service = $con->query("SELECT * FROM `service_manager` WHERE `ID`='8'")->fetch_assoc(); 
                    $report = $con->query("SELECT * FROM `report` WHERE `REFERENCE_ID`='$refid'")->fetch_assoc(); 
                    $all_service=$service['SERVICE'];
                    $mb = $row['MOBILE'];
                    $status = $row['STATUS'];
                 
                $userdata .= "<tr>
                    <td>".$i++."</td>
                    <td>{$row['TIMESTAMP']} {$row['FILTER_DATE']}</td>
                    <td>{$user['PARTNER_ID']} {$user['FIRST_NAME']} {$user['LAST_NAME']} {$user['MOBILE']}</td>
                    <td><span>Recharge - $mb ($all_service)</span> <span>Ref. No.:</span>'$refid '/' $opid $status {$report['DEVICE']} {$report['IP_ADDRESS']}</td>
                    <td>{$rc_id}</td>
                    <td>{$row['STATUS']}</td>
                    <td>{$report['PREVIOUS_AMOUNT']}</td>
                    <td><span class='text'>{$row['AMOUNT']}</span></td>
                    <td>{$report['AFTER_AMOUNT']}</td>
                    <td><a target='_blank' href='Recipt/RechargeRecipt.php?refrence_id={$row['REFERENCE_ID']}'><i class='nav-icon fas fa-receipt'></i></a></td>
                    <td><a type='button' class='btn btn-info btn-xs edit_data' data-toggle='modal' data-target='#exampleModal' data-id='{$row['ID']}'>Action</a></td>
                    <td>{$row['RESPONSE']}</td>
                 </tr>";
              }
    $userdata .= " </tfoot>
                  
                </table>";
                
    echo $userdata;
        
        
    }
    

?>