<?php
session_start();
require_once('../../Db/config.php');
require("../include/Auth.php");

$id = $_SESSION['UsId'];

    //Recharge report code here........
    
    if(isset($_POST['pageid']) && $_POST['pageid'] == 4){
         $fromdate = $_POST['formdate'];
        $todate = $_POST['todate'];
        
        $i = 1;
       $type = $_POST["type"];
  
  $sql = "SELECT * FROM payout_transaction WHERE USER_ID='$id' ORDER BY ID DESC";


$result = mysqli_query($con, $sql) or die("SQL Query Failed.");
$userdata = "";


  $userdata .= '<table id="example" class="table table-bordered table-striped">
        
                  <thead>
                  <tr>
                        <th>SL No</th>
                        <th>Full Name</th>
                        <th>Account</th>
                        <th>IFSC</th>
                        <th>Amount</th>
                        <th>Status</th>
                        <th>Refrence id</th>
                        <th>TimeStamp</th>
                        <th>Check Status</th>
                  </tr>
                  </thead>
                  <tbody>';

              while($row = mysqli_fetch_assoc($result)){
                   $userid = $row['USER_ID'];
                   $pusers = $con->query("select * from payout_users where US_ID='$userid' order by ID Desc")->fetch_assoc();
                    $op = explode(",", $row['OPERATOR']);
                    $st = explode(",", $row['STATUS']);
                $userdata .= "<tr>
                    <td>".$i++."</td>
                    <td>{$pusers['NAME']}</td>
                    <td>{$pusers['ACCOUNT']}</td>
                    <td>{$pusers['IFSC']}</td>
                    <td>{$row['AMOUNT']}</td>
                    <td>{$row['STATUS']}</td>
                    <td>{$row['REFFRENCE_ID']}</td>
                    <td>{$row['TIMESTAMP']}</td>
                     <td onclick='check_status({$row['REFFRENCE_ID']})><i class='ti-pencil-alt' style='font-size:20px;'></i>Check</td>

                 </tr>";
              }
    $userdata .= " </tfoot>
                  
                </table>";
                
              
    echo $userdata;
        
        
    }
    
    if(isset($_POST['pageid']) && $_POST['pageid'] == 5){
         $fromdate = $_POST['formdate'];
        $todate = $_POST['todate'];
        
        $i = 1;
       $type = $_POST["type"];
  
  $sql = "SELECT * FROM special_payout_transaction WHERE user_id='$id' ORDER BY ID DESC";


$result = mysqli_query($con, $sql) or die("SQL Query Failed.");
$userdata = "";


  $userdata .= '<table id="example" class="table table-bordered table-striped">
        
                  <thead>
                  <tr>
                        <th>SL No</th>
                        <th>Full Name</th>
                        <th>Account</th>
                        <th>IFSC</th>
                        <th>Amount</th>
                        <th>Transaction id</th> 
                        <th>Status</th> 
                        <th>UTR</th> 
                        <th>TimeStamp</th>
                        <th>Action</th>
                  </tr>
                  </thead>
                  <tbody>';

              while($row = mysqli_fetch_assoc($result)){
                   $pusers = $con->query("select * from special_payout where user_id='$id' order by ID Desc")->fetch_assoc();
                    $bankName = $pusers['bankName'];;
                    $accNumber = $pusers['acc'];;
                    $ifsc = $pusers['ifsc'];;
                    
                $userdata .= "<tr>
                    <td>".$i++."</td>
                    <td>{$bankName}</td>
                    <td>{$accNumber}</td>
                    <td>{$ifsc}</td>
                    <td>{$row['amount']}</td>
                    <td>{$row['transaction_id']}</td>
                    <td>{$row['status']}</td>
                    <td>{$row['utr']}</td>
                    <td>{$row['trans_date']} - {$row['trans_time']}</td>
                    <td>{$row['action_date']}</td>

                 </tr>";
              }
    $userdata .= " </tfoot>
                  
                </table>";
                
              
    echo $userdata;
        
        
    }
    
    
    
//     if(isset($_POST['pageid']) && $_POST['pageid'] == 4){
//          $fromdate = $_POST['formdate'];
//         $todate = $_POST['todate'];
        
//         $i = 1;
//       $type = $_POST["type"];
  
//   $sql = "SELECT * FROM recharge_transaction WHERE USER_ID = '$id' AND SERVICE = '$type' AND FILTER_DATE between '$fromdate' and '$todate' ORDER BY ID DESC";


// $result = mysqli_query($con, $sql) or die("SQL Query Failed.");
// $userdata = "";


//   $userdata .= '<table id="example1" class="table table-bordered table-striped">
        
//                   <thead>
//                   <tr>
//                       <th>Sr. No</th>
//                         <th>Mobile</th>
//                         <th>Operator</th>
//                         <th>Amount</th>
//                         <th>Status</th>
//                         <th>Message</th>
//                         <th>Refrence id</th>
//                         <th>Operator id</th>
//                         <th>Date</th>
//                         <th>Time</th>
//                         <th>Recipt</th>
//                   </tr>
//                   </thead>
//                   <tbody>';

//               while($row = mysqli_fetch_assoc($result)){
//                     $op = explode(",", $row['OPERATOR']);
//                     $st = explode(",", $row['STATUS']);
//                 $userdata .= "<tr>
//                     <td>".$i++."</td>
//                     <td>{$row['MOBILE']}</td>
//                     <td>{$op[0]}</td>
//                     <td>{$row['AMOUNT']}</td>
//                     <td>{$st[0]}</td>
//                     <td>{$row['STATUS']}</td>
//                     <td>{$row['REFERENCE_ID']}</td>
//                     <td>{$row['OPERATOR_ID']}</td>
//                     <td>{$row['FILTER_DATE']}</td>
//                     <td>{$row['TIMESTAMP']}</td>
//                     <td><a target='_blank' href='Recipt/RechargeRecipt.php?refrence_id={$row['REFERENCE_ID']}&service=$type'><i class='nav-icon fas fa-receipt'></i></a></td>
                    
//                  </tr>";
//               }
//     $userdata .= " </tfoot>
                  
//                 </table>";
                
              
//     echo $userdata;
        
        
//     }
    
    
?>