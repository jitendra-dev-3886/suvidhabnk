<?php

session_start();
require_once('../../Db/config.php');
require("../include/Auth.php");


$usid = $_SESSION['UsId']; 

$duser = $con->query("SELECT * FROM user WHERE OWNER_ID='$usid'")->fetch_assoc();

$duserid = $duser["ID"];
$dusertype = $duser["USER_TYPE"];

// $myuser = $con->query("SELECT * FROM `user` WHERE ID='$my_id'")->fetch_assoc();
// $user_type = $myuser['USER_TYPE'];


if(isset($_POST['pageid']) && $_POST['pageid'] == 0){

  
  $sql = "SELECT * FROM user WHERE OWNER_ID='$usid' ORDER BY ID DESC";

$result = mysqli_query($con, $sql) or die("SQL Query Failed.");

$duserrr = $con->query("SELECT * FROM user WHERE ID='$usid'")->fetch_assoc();
$duserrr_type=$duserrr['USER_TYPE'];
// echo $duserrr_type;
if($duserrr_type=='47'){



$userdata = "";


  $userdata .= '<table id="example1" class="table table-bordered table-striped">
        
                  <thead>
                  <tr>
                    <th>Member ID</th>
                    <th>Full Name</th>
                    <th>Mobile</th>
                    <th>Type</th>
                    <th>Owner</th>
                    <th>Profile</th>
                    <th>Status</th>
                    <th>Action</th>
                  </tr>
                  </thead>
                  <tbody>';

              while($row = mysqli_fetch_assoc($result)){
                  $ownerid = $row["OWNER_ID"];
                  $usertype = $con->query("SELECT * FROM user_type WHERE ID = '{$row['USER_TYPE']}'")->fetch_assoc();
                  $userowner = $con->query("SELECT * FROM user WHERE ID = '$ownerid'")->fetch_assoc();
                  
                  if($userowner != ""){
        $ownername = $userowner["FIRST_NAME"].' '.$userowner["LAST_NAME"];
    }else{
         $ownername = "Admin";
    }
                  
                $userdata .= "<tr>
                    <td>{$row['PARTNER_ID']}</td>
                    <td>{$row['FIRST_NAME']} {$row['LAST_NAME']}</td>
                    <td>{$row['MOBILE']}</td>
                    <td>{$usertype['NAME']}</td>
                    <td>$ownername</td>
                    <td><span class='badge badge-info right' id='mbtn' style='cursor:pointer;' data-mid='{$row['ID']}' data-toggle='modal' data-target='.bd-example-modal-lg'>View Profile</span></td>
                    <td>{$row['US_STATUS']}</td>
                    <td>
                       <a href='ParticularUserLedger?mid={$row['ID']}' target='_blank' class='btn btn-success showledger'>Show Transactions</a>
                    </td> 

                 </tr>";
              }
    $userdata .= " </tfoot>
                  
                </table>";
                
    echo $userdata;
    
    
}else if($duserrr_type=='48'){
    $userdata = "";


  $userdata .= '<table id="example1" class="table table-bordered table-striped">
        
                  <thead>
                  <tr>
                    <th>Member ID</th>
                    <th>Full Name</th>
                    <th>Mobile</th>
                    <th>Type</th>
                    <th>Owner</th>
                    <th>Profile</th>
                    <th>Status</th>
                    <th>Action</th>
                    <th>Retailer List</th>
                  </tr>
                  </thead>
                  <tbody>';

              while($row = mysqli_fetch_assoc($result)){
                  $ownerid = $row["OWNER_ID"];
                  $usertype = $con->query("SELECT * FROM user_type WHERE ID = '{$row['USER_TYPE']}'")->fetch_assoc();
                  $userowner = $con->query("SELECT * FROM user WHERE ID = '$ownerid'")->fetch_assoc();
                  
                  if($userowner != ""){
        $ownername = $userowner["FIRST_NAME"].' '.$userowner["LAST_NAME"];
    }else{
         $ownername = "Admin";
    }
                  
                $userdata .= "<tr>
                    <td>{$row['PARTNER_ID']}</td>
                    <td>{$row['FIRST_NAME']} {$row['LAST_NAME']}</td>
                    <td>{$row['MOBILE']}</td>
                    <td>{$usertype['NAME']}</td>
                    <td>$ownername</td>
                    <td><span class='badge badge-info right' id='mbtn' style='cursor:pointer;' data-mid='{$row['ID']}' data-toggle='modal' data-target='.bd-example-modal-lg'>View Profile</span></td>
                    <td>{$row['US_STATUS']}</td>
                    <td>
                       <a href='ParticularUserLedger?mid={$row['ID']}' target='_blank' class='btn btn-success showledger'>Show Transactions</a>
                    </td> 
                    <td>
                       <a href='MemberList1?ownerid={$row['ID']}' target='_blank' class='btn btn-info showledger'>Show Retailer</a>
                    </td>
                 </tr>";
              }
    $userdata .= " </tfoot>
                  
                </table>";
                
    echo $userdata;
}    
    
    
    
    
    
    }
    
    //-----admin aeps report-------//
    
    if(isset($_POST['pageid']) && $_POST['pageid'] == 1){
        $fromdate = $_POST['formdate'];
    $todate = $_POST['todate'];
  
  $sql = "SELECT * FROM aeps_transactions WHERE USER_ID='$duserid' AND TRANS_TYPE = 'CW' AND FILTER_DATE between '$fromdate' and '$todate' ORDER BY ID DESC";

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
                  
             $user1 = $con->query("SELECT PARTNER_ID FROM user WHERE ID = '{$row["USER_ID"]}'")->fetch_assoc();
                  
                $userdata .= "<tr>
                    <td>".$i++."</td>
                    <td>{$row['TIMESTAMP']} {$row['FILTER_DATE']}</td>
                    <td>{$user1['PARTNER_ID']}</td>
                    <td>{$row['MOBILE']}</td>
                    <td>{$row['REFFRENCE_ID']}</td>
                    <td>{$row['AMOUNT']}</td>
                    <td>{$row['STATUS']}</td>
                    <td><a target='_blank' href='Recipt/AePsRecipt.php?refrence_id={$row['REFFRENCE_ID']}'><i class='nav-icon fas fa-receipt'></i></a></td>
                    
                 </tr>";
              }
    $userdata .= " </tfoot>
                  
                </table>";
              

    echo $userdata;
}



// Aeps Ministatement Report 


if(isset($_POST['pageid']) && $_POST['pageid'] == 5){
  $fromdate = $_POST['formdate'];
    $todate = $_POST['todate'];
  $sql = "
SELECT * FROM aeps_transactions WHERE USER_ID='$duserid' AND TRANS_TYPE = 'MS' AND FILTER_DATE between '$fromdate' and '$todate' ORDER BY ID DESC
";

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
                    
                    <th>Status</th>
                    <th>Recipt</th>
                  </tr>
                  </thead>
                  <tbody>';

              while($row = mysqli_fetch_assoc($result)){
                  
             $user1 = $con->query("SELECT PARTNER_ID FROM user WHERE ID = '{$row["USER_ID"]}'")->fetch_assoc();
                  
                $userdata .= "<tr>
                    <td>".$i++."</td>
                    <td>{$row['TIMESTAMP']} {$row['FILTER_DATE']}</td>
                    <td>{$user1['PARTNER_ID']}</td>
                    <td>{$row['MOBILE']}</td>
                    <td>{$row['REFFRENCE_ID']}</td>
                    <td>{$row['STATUS']}</td>
                    <td><a target='_blank' href='Recipt/AePsRecipt.php?refrence_id={$row['REFFRENCE_ID']}'><i class='nav-icon fas fa-receipt'></i></a></td>
                    
                 </tr>";
              }
    $userdata .= " </tfoot>
                  
                </table>";
              

    echo $userdata;
}



// Aeps Balance Enquery Report code here


if(isset($_POST['pageid']) && $_POST['pageid'] == 6){
     $fromdate = $_POST['formdate'];
    $todate = $_POST['todate'];
  
  $sql = "SELECT * FROM aeps_transactions WHERE USER_ID='$duserid' AND TRANS_TYPE = 'BE' AND FILTER_DATE between '$fromdate' and '$todate' ORDER BY ID DESC";

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
                    <th>Status</th>
                    <th>Recipt</th>
                  </tr>
                  </thead>
                  <tbody>';

              while($row = mysqli_fetch_assoc($result)){
                  
             $user1 = $con->query("SELECT PARTNER_ID FROM user WHERE ID = '{$row["USER_ID"]}'")->fetch_assoc();
                  
                $userdata .= "<tr>
                    <td>".$i++."</td>
                    <td>{$row['TIMESTAMP']} {$row['FILTER_DATE']}</td>
                    <td>{$user1['PARTNER_ID']}</td>
                    <td>{$row['MOBILE']}</td>
                    <td>{$row['REFFRENCE_ID']}</td>
                    <td>{$row['STATUS']}</td>
                    <td><a target='_blank' href='Recipt/AePsRecipt.php?refrence_id={$row['REFFRENCE_ID']}'><i class='nav-icon fas fa-receipt'></i></a></td>
                    
                 </tr>";
              }
    $userdata .= " </tfoot>
                  
                </table>";
              

    echo $userdata;
}
    
    
    
     //-----admin DMT report-------//
    
    if(isset($_POST['pageid']) && $_POST['pageid'] == 2){
        $fromdate = $_POST['formdate'];
    $todate = $_POST['todate'];
        
$i = 1;

  $sql = "
SELECT * FROM dmt_transactions WHERE USER_ID='$duserid' AND FILTER_DATE between '$fromdate' and '$todate' ORDER BY ID DESC
";

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
                  
             $user1 = $con->query("SELECT PARTNER_ID FROM user WHERE ID = {$row['USER_ID']}")->fetch_assoc();
                  
                $userdata .= "<tr>
                    <td>".$i++."</td>
                    <td>{$row['TIMESTAMP']} {$row['FILTER_DATE']}</td>
                    <td>{$user1['PARTNER_ID']}</td>
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


//E-tax report code here........
    
    if(isset($_POST['pageid']) && $_POST['pageid'] == 3){
         $fromdate = $_POST['formdate'];
         $todate = $_POST['todate'];
        $type =  $_POST['type'];
        $i = 1;
        
        if($_POST['type'] == "Pancard"){
  $sql = "
SELECT * FROM pan_transaction WHERE USER_ID = '$duserid' AND date(DATE) between '$fromdate' and '$todate' ORDER BY ID DESC
";

$result = mysqli_query($con, $sql) or die("SQL Query Failed.");
$userdata = "";


  $userdata .= '<table id="example1" class="table table-bordered table-striped">
        
                  <thead>
                  <tr>
                    <th>Sr. No.</th>
                    <th>Date and Time</th>
                    <th>No of Coupon</th>
                    <th>Amount</th>
                    <th>RT Comm.</th>
                    <th>DT Comm</th>
                    <th>Remark</th>
                    <th>Status</th>
                  </tr>
                  </thead>
                  <tbody>';

              while($row = mysqli_fetch_assoc($result)){
                  
                 
                $userdata .= "<tr>
                    <td>".$i++."</td>
                    <td>{$row['DATE']}</td>
                    <td>{$row['NUMBER_OF_COUPON']}</td>
                    <td>{$row['AMOUNT']}</td>
                    <td>{$row['RT_COMM']}</td>
                    <td>{$row['DT_COMM']}</td>
                    <td>{$row['REMARK']}</td>
                    <td>{$row['STATUS']}</td>
                   
                 </tr>";
              }
    $userdata .= " </tfoot>
                  
                </table>";
}

if($_POST['type'] != "Pancard"){

  $sql = "
SELECT * FROM etax WHERE USER_ID = '$duserid' AND TYPE = '$type' AND date(DATE) BETWEEN '$fromdate' and '$todate' ORDER BY ID DESC";


$result = mysqli_query($con, $sql) or die("SQL Query Failed.");
$userdata = "";


  $userdata .= '<table id="example1" class="table table-bordered table-striped">
        
                  <thead>
                  <tr>
                    <th>Sr. No.</th>
                    <th>Date and Time</th>
                    <th>Name</th>
                    <th>Mobile No.</th>
                    <th>Reference Id</th>
                    <th>Type</th>
                    <th>Status</th>
                    <th>Remark</th>
                  </tr>
                  </thead>
                  <tbody>';

              while($row = mysqli_fetch_assoc($result)){
                 
                $userdata .= "<tr>
                    <td>".$i++."</td>
                    <td>{$row['DATE']}</td>
                    <td>{$row['NAME']}</td>
                    <td>{$row['MOBILE']}</td>
                    <td>{$row['REFERENCE_ID']}</td>
                    <td>{$row['TYPE']}</td>
                    <td>{$row['STATUS']}</td>
                    <td>{$row['REMARK']}</td>
                   
                 </tr>";
              }
    $userdata .= " </tfoot>
                  
                </table>";
                
    
    
}
        echo $userdata;
        
    }


//Recharge report code here........
    
    if(isset($_POST['pageid']) && $_POST['pageid'] == 4){
         $fromdate = $_POST['formdate'];
    $todate = $_POST['todate'];
        
        $i = 1;

  $sql = "
SELECT * FROM recharge_transaction WHERE USER_ID='$duserid' AND SERVICE = 'Prepaid' AND FILTER_DATE between '$fromdate' and '$todate' ORDER BY ID DESC
";

$result = mysqli_query($con, $sql) or die("SQL Query Failed.");
$userdata = "";


  $userdata .= '<table id="example1" class="table table-bordered table-striped">
        
                  <thead>
                  <tr>
                       <th>SL No</th>
                        <th>Mobile</th>
                        <th>Operator</th>
                        <th>Amount</th>
                        <th>Status</th>
                        <th>Message</th>
                        <th>Refrence id</th>
                        <th>Operator id</th>
                        <th>Date &amp; Time</th>
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
                    <td>{$row['TIMESTAMP']} {$row['FILTER_DATE']}</td>
                    <td><a target='_blank' href='Recipt/RechargeRecipt.php?refrence_id={$row['REFERENCE_ID']}'><i class='nav-icon fas fa-receipt'></i></a></td>
                    
                 </tr>";
              }
    $userdata .= " </tfoot>
                  
                </table>";
                
    echo $userdata;
        
        
    }
    
    
//DTH report code here........
    
    if(isset($_POST['type']) && $_POST['type'] == 'DTH'){
        
        $i = 1;
        $type = $_POST['type'];
        if($_POST['formdate'] != '' && $_POST['todate'] != ''){
        $formdate = $_POST['formdate'];
        $todate = $_POST['todate'];
        $filter = "AND FILTER_DATE BETWEEN '$formdate' AND '$todate'";
        }

  $sql = "
SELECT * FROM recharge_transaction WHERE USER_ID='$duserid' AND SERVICE = '$type' $filter ORDER BY ID DESC
";

$result = mysqli_query($con, $sql) or die("SQL Query Failed.");
$userdata = "";


  $userdata .= '<table id="example1" class="table table-bordered table-striped">
        
                  <thead>
                  <tr>
                       <th>SL No</th>
                        <th>Mobile</th>
                        <th>Operator</th>
                        <th>Amount</th>
                        <th>Status</th>
                        <th>Message</th>
                        <th>Refrence id</th>
                        <th>Operator id</th>
                        <th>Date &amp; Time</th>
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
                    <td>{$row['TIMESTAMP']} {$row['FILTER_DATE']}</td>
                    <td><a target='_blank' href='Recipt/RechargeRecipt.php?refrence_id={$row['REFERENCE_ID']}'><i class='nav-icon fas fa-receipt'></i></a></td>
                    
                 </tr>";
              }
    $userdata .= " </tfoot>
                  
                </table>";
                
    echo $userdata;
        
        
    }
    
    
//UPI Transaction report code here........
    
    if(isset($_POST['type']) && $_POST['type'] == 'UPI'){
        
        $i = 1;
        $type = $_POST['type'];
        if($_POST['formdate'] != '' && $_POST['todate'] != ''){
        $formdate = $_POST['formdate'];
        $todate = $_POST['todate'];
        $filter = "AND FILTER_DATE BETWEEN '$formdate' AND '$todate'";
        }

  $sql = "
SELECT * FROM upi_transactions WHERE USER_ID='$duserid' $filter ORDER BY ID DESC
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
                    <td> {$row['TIMESTAMP']} {$row['FILTER_DATE']}</td>
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
    
    
     //X-DMT report code here
    
    if(isset($_POST['pageid']) && $_POST['pageid'] == 7){
          $fromdate = $_POST['formdate'];
    $todate = $_POST['todate'];
 $i = 1;        

  
  $sql = "
SELECT * FROM xdmt_transactions WHERE USER_ID='$duserid' AND FILTER_DATE between '$fromdate' and '$todate' ORDER BY ID DESC 
";

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
    
    
    // Aeps Adhaarpay Report code here


if(isset($_POST['pageid']) && $_POST['pageid'] == 8){
     $fromdate = $_POST['formdate'];
    $todate = $_POST['todate'];
  
  $sql = "
SELECT * FROM aeps_transactions WHERE USER_ID='$duserid' AND `TRANS_TYPE` = 'M' AND FILTER_DATE between '$fromdate' and '$todate' ORDER BY ID DESC
";

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
                    <th>Status</th>
                    <th>Recipt</th>
                  </tr>
                  </thead>
                  <tbody>';

              while($row = mysqli_fetch_assoc($result)){
                  
             $user1 = $con->query("SELECT PARTNER_ID FROM user WHERE ID = '{$row["USER_ID"]}'")->fetch_assoc();
                  
                $userdata .= "<tr>
                    <td>".$i++."</td>
                    <td>{$row['TIMESTAMP']} {$row['FILTER_DATE']}</td>
                    <td>{$user1['PARTNER_ID']}</td>
                    <td>{$row['MOBILE']}</td>
                    <td>{$row['REFFRENCE_ID']}</td>
                    <td>{$row['STATUS']}</td>
                    <td><a target='_blank' href='Recipt/AePsRecipt.php?refrence_id={$row['REFFRENCE_ID']}'><i class='nav-icon fas fa-receipt'></i></a></td>
                    
                 </tr>";
              }
    $userdata .= " </tfoot>
                  
                </table>";
              

    echo $userdata;
}
    
    
    
    
    
?>