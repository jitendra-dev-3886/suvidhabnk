<?php
session_start();
require_once('../../Db/config.php');
require("../include/Auth.php");

$id = $_SESSION['UsId'];

if(isset($_POST['pageid']) && $_POST['pageid'] == 1){
    $fromdate = $_POST['formdate'];
    $todate = $_POST['todate'];

 $i = 1;
  
  $sql = "SELECT * FROM aeps_transactions WHERE USER_ID = '$id' AND FILTER_DATE between '$fromdate' and '$todate' ORDER BY ID DESC";

$result = mysqli_query($con, $sql) or die("SQL Query Failed.");
$userdata = "";


  $userdata .= '<table id="example1" class="table table-bordered table-striped">
        
                  <thead>
                  <tr>
                    <th>Sr. No.</th>
                    <th>Date and Time</th>
                    <th>Member Id.</th>
                    <th>Member Mobile No.</th>
                    <th>Transaction Id.</th>
                    <th>Transaction Amount</th>
                    <th>Transaction type</th>
                    <th>Status</th>
                    <th>Recipt</th>
                  </tr>
                  </thead>
                  <tbody>';

              while($row = mysqli_fetch_assoc($result)){
                  
                  if($row['TRANS_TYPE'] == "MS"){
                      $href = "href='Recipt/AePsRecipt.php?refrence_id={$row['REFFRENCE_ID']}'";
                  }else{
                      
                      $href = "href='Recipt/AePsRecipt.php?refrence_id={$row['REFFRENCE_ID']}'";
                  }
                 
                $userdata .= "<tr>
                    <td>".$i++."</td>
                    <td>{$row['FILTER_DATE']} {$row['TIMESTAMP']}</td>
                    <td>{$user['PARTNER_ID']}</td>
                    <td>{$row['MOBILE']}</td>
                    <td>{$row['REFFRENCE_ID']}</td>
                    <td>{$row['AMOUNT']}</td>
                    <td>{$row['TRANS_TYPE']}</td>
                    <td>{$row['STATUS']}</td>
                    <td><a target='_blank' $href ><i class='nav-icon fas fa-receipt'></i></a></td>
                    
                 </tr>";
              }
    $userdata .= " </tfoot>
                  
                </table>";
                
               
    echo $userdata;
}
    
    
    
    
    
    
    if(isset($_POST['pageid']) && $_POST['pageid'] == 3){
        $fromdate = $_POST['formdate'];
        $todate = $_POST['todate'];
        
  $i = 1;
        
  $sql = "SELECT * FROM payout_transaction WHERE USER_ID = '$id' AND FILTER_DATE between '$fromdate' and '$todate' ORDER BY ID DESC";

$result = mysqli_query($con, $sql) or die("SQL Query Failed.");
$userdata = "";


  $userdata .= '<table id="example1" class="table table-bordered table-striped">
        
                  <thead>
                  <tr>
                     <th>Sr. No.</th>
                    <th>Date and Time</th>
                    <th>Member Id.</th>
                    <th>Member Mobile No.</th>
                    <th>Transaction Id.</th>
                    <th>Transaction Amount</th>
                    <th>Status</th>
                    <th>Recipt</th>
                  </tr>
                  </thead>
                  <tbody>';

              while($row = mysqli_fetch_assoc($result)){
                  
                $userdata .= "<tr>
                    <td>".$i++."</td>
                    <td>{$row['FILTER_DATE']} {$row['TIMESTAMP']}</td>
                    <td>{$user['PARTNER_ID']}</td>
                    <td>{$user['MOBILE']}</td>
                    <td>{$row['REFFRENCE_ID']}</td>
                    <td>{$row['AMOUNT']}</td>
                    <td>{$row['STATUS']}</td>
                    <td><a target='_blank' href='Recipt/PayoutRecipt.php?refrence_id={$row['REFFRENCE_ID']}'><i class='nav-icon fas fa-receipt'></i></a></td>
                    
                 </tr>";
              }
    $userdata .= " </tfoot>
                  
                </table>";
                
                
    echo $userdata;
        
        
    }
    
    
    // dmt report start here
    
    if(isset($_POST['pageid']) && $_POST['pageid'] == 2){
        $fromdate = $_POST['formdate'];
    $todate = $_POST['todate'];
        
 $i = 1;        

  
  $sql = "SELECT * FROM dmt_transactions WHERE USER_ID = '$id' AND FILTER_DATE between '$fromdate' and '$todate' ORDER BY ID DESC";

$result = mysqli_query($con, $sql) or die("SQL Query Failed.");
$userdata = "";


  $userdata .= '<table id="example1" class="table table-bordered table-striped">
        
                  <thead>
                  <tr>
                     <th>Sr. No.</th>
                    <th>Date</th>
                    <th>Time</th>
                    <th>Member Id.</th>
                    <th>Member Mobile No.</th>
                    <th>Transaction Id.</th>
                    <th>Transaction Amount</th>
                    <th>Status</th>
                    <th>Recipt</th>
                  </tr>
                  </thead>
                  <tbody>';

              while($row = mysqli_fetch_assoc($result)){
                 
                $userdata .= "<tr>
                    <td>".$i++."</td>
                    <td>".$row['FILTER_DATE']."</td>
                    <td>".$row['TIMESTAMP']."</td>
                    <td>{$user['PARTNER_ID']}</td>
                    <td>{$row['MOBILE']}</td>
                    <td>{$row['REFFRENCE_ID']}</td>
                    <td>{$row['AMOUNT']}</td>
                    <td>{$row['STATUS']}</td>
                    <td><a target='_blank' href='Recipt/DMTRecipt.php?refrence_id={$row['REFFRENCE_ID']}'><i class='nav-icon fas fa-receipt'></i></a></td>
                    
                 </tr>";
              }
    $userdata .= " </tfoot>
                  
                </table>";
                
             
    

    echo $userdata;
        
    }
    
    //X-DMT report code here
    
    if(isset($_POST['pageid']) && $_POST['pageid'] == 5){
        $fromdate = $_POST['formdate'];
        $todate = $_POST['todate'];
 $i = 1;        

  
  $sql = "SELECT * FROM xdmt_transactions WHERE USER_ID = '$id' AND FILTER_DATE between '$fromdate' and '$todate' ORDER BY ID DESC ";

$result = mysqli_query($con, $sql) or die("SQL Query Failed.");
$userdata = "";


  $userdata .= '<table id="example1" class="table table-bordered table-striped">
        
                  <thead>
                  <tr>
                     <th>Sr. No.</th>
                    <th>Date and Time</th>
                    <th>Member Id.</th>
                    <th>Member Mobile No.</th>
                    <th>Transaction Id.</th>
                    <th>Transaction Amount</th>
                    <th>Status</th>
                    <th>Recipt</th>
                  </tr>
                  </thead>
                  <tbody>';

              while($row = mysqli_fetch_assoc($result)){
                 
                $userdata .= "<tr>
                    <td>".$i++."</td>
                    <td>{$row['TIMESTAMP']}</td>
                    <td>{$user['PARTNER_ID']}</td>
                    <td>{$row['MOBILE']}</td>
                    <td>{$row['REFFRENCE_ID']}</td>
                    <td>{$row['AMOUNT']}</td>
                    <td>{$row['STATUS']}</td>
                    <td><a target='_blank' href='Recipt/XDMT_Reciept.php?refrence_id={$row['REFFRENCE_ID']}'><i class='nav-icon fas fa-receipt'></i></a></td>
                    
                 </tr>";
              }
    $userdata .= " </tfoot>
                  
                </table>";
                
             
    

    echo $userdata;
        
    }
    
    //Recharge report code here........
    
    if(isset($_POST['pageid']) && $_POST['pageid'] == 4){
         $fromdate = $_POST['formdate'];
        $todate = $_POST['todate'];
        
        $i = 1;
       $type = $_POST["type"];
  
  $sql = "SELECT * FROM recharge_transaction WHERE USER_ID = '$id' AND SERVICE = '$type' AND FILTER_DATE between '$fromdate' and '$todate' ORDER BY ID DESC";


$result = mysqli_query($con, $sql) or die("SQL Query Failed.");
$userdata = "";


  $userdata .= '<table id="example1" class="table table-bordered table-striped">
        
                  <thead>
                  <tr>
                       <th>Sr. No</th>
                        <th>Mobile</th>
                        <th>Operator</th>
                        <th>Amount</th>
                        <th>Status</th>
                        <th>Message</th>
                        <th>Refrence id</th>
                        <th>Operator id</th>
                        <th>Date</th>
                        <th>Time</th>
                        <th>Recipt</th>
                  </tr>
                  </thead>
                  <tbody>';

              while($row = mysqli_fetch_assoc($result)){
                    $op = explode(",", $row['OPERATOR']);
                    $st = explode(",", $row['STATUS']);
                $userdata .= "<tr>
                    <td>".$i++."</td>
                    <td>{$row['MOBILE']}</td>
                    <td>{$op[0]}</td>
                    <td>{$row['AMOUNT']}</td>
                    <td>{$st[0]}</td>
                    <td>{$row['STATUS']}</td>
                    <td>{$row['REFERENCE_ID']}</td>
                    <td>{$row['OPERATOR_ID']}</td>
                    <td>{$row['FILTER_DATE']}</td>
                    <td>{$row['TIMESTAMP']}</td>
                    <td><a target='_blank' href='Recipt/RechargeRecipt.php?refrence_id={$row['REFERENCE_ID']}&service=$type'><i class='nav-icon fas fa-receipt'></i></a></td>
                    
                 </tr>";
              }
    $userdata .= " </tfoot>
                  
                </table>";
                
              
    echo $userdata;
        
        
    }
    
    //Login History code here........
    
    if(isset($_POST['pageid']) && $_POST['pageid'] == 6){
         $fromdate = $_POST['formdate'];
        $todate = $_POST['todate'];
        
        $i = 1;
  
  $sql = "SELECT * FROM `login_history` WHERE USER_ID = '$id' ORDER BY ID DESC LIMIT 10";


$result = mysqli_query($con, $sql) or die("SQL Query Failed.");
$userdata = "";


  $userdata .= '<table id="example1" class="table table-bordered table-striped">
        
                  <thead>
                  <tr>
                        <th>Time Stamp</th>
                        <th>IP Address</th>
                        <th>Browser</th>
                        <th>OS</th>
                        <th>Device</th>
                        <th>City</th>
                        <th>Message</th>
                  </tr>
                  </thead>
                  <tbody>';

              while($row = mysqli_fetch_assoc($result)){
                  
                $userdata .= "<tr>
                    <td>{$row['LOGIN_DATE']} {$row['LOGIN_TIME']}</td>
                    <td>{$row['IP_ADDRESS']}</td>
                    <td>{$row['BROWSER']}</td>
                    <td>{$row['OPERATING_SYSTEM']}</td>
                    <td>{$row['DEVICE']}</td>
                    <td>{$row['CITY']}</td>
                    <td>{$row['MESSAGE']}</td>
                    
                 </tr>";
              }
    $userdata .= " </tfoot>
                  
                </table>";
                
              
    echo $userdata;
        
        
    }
    
    
    //----- UPI report-------//
    
    if(isset($_POST['type']) && $_POST['type'] == "UPI"){
       $fromdate = $_POST['formdate'];
        $todate = $_POST['todate']; 
        
$i = 1;

  $sql = "
SELECT * FROM upi_transactions WHERE USER_ID = '$id'AND FILTER_DATE between '$fromdate' and '$todate' ORDER BY ID DESC
";

$result = mysqli_query($con, $sql) or die("SQL Query Failed.");
$userdata = "";

  $userdata .= '<table id="example1" class="table table-bordered table-striped">
        
                  <thead>
                  <tr>
                    <th>Sr. No.</th>
                    <th>Date and Time </th>
                    <th>Member Id.</th>
                    <th>Member Mobile No.</th>
                    <th>Member Name</th>
                    <th>UPI Id</th>
                    <th>Transaction Id.</th>
                    <th>Transaction Amount</th>
                    <th>API</th>
                    <th>Status</th>
                    <th>Recipt</th>
                  </tr>
                  </thead>
                  <tbody>';

              while($row = mysqli_fetch_assoc($result)){
                  
             $user1 = $con->query("SELECT PARTNER_ID FROM user WHERE ID = {$row['USER_ID']}")->fetch_assoc();
                    $st = explode("," , $row['STATUS']);
                $userdata .= "<tr>
                    <td>".$i++."</td>
                    <td> {$row['TIMESTAMP']}</td>
                    <td>{$user1['PARTNER_ID']}</td>
                    <td>{$user1['MOBILE']}</td>
                    <td>{$row['NAME']}</td>
                    <td>{$row['UPI_ID']}</td>
                    <td>{$row['REFFRENCE_ID']}</td>
                    <td>{$row['AMOUNT']}</td>
                    <td>{$row['APINAME']}</td>
                    <td>{$row['STATUS']}</td>
                    <td><a target='_blank' href='Recipt/UPIRecipt.php?refrence_id={$row['REFFRENCE_ID']}'><i class='nav-icon fas fa-receipt'></i></a></td>
                    
                 </tr>";
              }
    $userdata .= " </tfoot>
                  
                </table>";
                
    echo $userdata;
}
    
    
    
    
    
    
?>