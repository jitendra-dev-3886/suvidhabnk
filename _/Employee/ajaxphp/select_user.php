<?php

session_start();
require_once('../../Db/config.php');
require("../include/Auth.php");

if(isset($_POST['pageid']) && $_POST['pageid'] == 0){

  
  $sql = "SELECT * FROM `user` where US_STATUS='Active' ORDER BY `ID` DESC";

$result = mysqli_query($con, $sql) or die("SQL Query Failed.");
$userdata = "";


  $userdata .= '<table id="example1" class="table table-bordered table-striped">
        
                  <thead>
                  <tr>
                    <th>Member ID</th>
                    <th>Full Name</th>
                    <th>Mobile</th>
                    <th>Email</th>
                    <th>Type</th>
                    <th>Owner</th>
                    <th>Profile</th>
                    <th>Status</th>
                    <th>Owner ID</th>
                    <th>City </th>
                    <th>Pincode</th>
                    <th>Joining Date</th>
                    <th>Subscription</th>
                    <th>Pan</th>
                    <th>Aadhaar</th>
                    <th>Remaining Days</th>
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
                    <td>{$row['EMAIL']}</td>
                    <td>{$usertype['NAME']}</td>
                    <td>$ownername</td>
                    <td><span class='badge badge-info right' id='mbtn' style='cursor:pointer;' data-mid='{$row['ID']}' data-toggle='modal' data-target='.bd-example-modal-lg'>View Profile</span></td>
                    <td>{$row['US_STATUS']}</td>
                    
                    <td>{$userowner['PARTNER_ID']}</td>
                    <td>{$row['CITY']}</td>
                    <td>{$row['PIN']}</td>
                    <td>{$row['DATE']}</td>
                    <td>{$row['SUBSCRIPTION']}</td>
                    <td>{$row['ADHAAR']}</td>
                    <td>{$row['PAN']}</td>
                    <td>{$row['']}</td>
                 </tr>";
              }
    $userdata .= " </tfoot>
                  
                </table>";
                
    echo $userdata;
    
    
    }
    
   // Distributor list for inactive user 
   
   
   if(isset($_POST['pageid']) && $_POST['pageid'] == 9){

  
  $sql = "
SELECT * FROM user WHERE USER_TYPE = '47' AND US_STATUS = 'Deactive' ORDER BY ID DESC
";

$result = mysqli_query($con, $sql) or die("SQL Query Failed.");
$userdata = "";


  $userdata .= '<table id="example1" class="table table-bordered table-striped">
        
                  <thead>
                  <tr>
                    <th>Member ID</th>
                    <th>Full Name</th>
                    <th>Mobile</th>
                    <th>Email</th>
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
                    <td>{$row['EMAIL']}</td>
                    <td>$ownername</td>
                    <td><span class='badge badge-info right' id='mbtn' style='cursor:pointer;' data-mid='{$row['ID']}' data-toggle='modal' data-target='.bd-example-modal-lg'>View Profile</span></td>
                    <td>{$row['US_STATUS']}</td>
                    <td><button type='button' data-did='{$row['ID']}' id='dtdelbtn' class='btn btn-danger'><i class='fas fa-trash'></i></button></td>
                 </tr>";
              }
    $userdata .= " </tfoot>
                  
                </table>";
                
    echo $userdata;
    
    
    }
    
    
    
     // Retailer list for inactive user 
   
   
   if(isset($_POST['type']) && $_POST['type'] == "rtverify"){

  
  $sql = "
SELECT * FROM user WHERE USER_TYPE = '46' AND US_STATUS = 'Deactive' ORDER BY ID DESC
";

$result = mysqli_query($con, $sql) or die("SQL Query Failed.");
$userdata = "";


  $userdata .= '<table id="example1" class="table table-bordered table-striped">
        
                  <thead>
                  <tr>
                    <th>Member ID</th>
                    <th>Full Name</th>
                    <th>Mobile</th>
                    <th>Email</th>
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
                    <td>{$row['EMAIL']}</td>
                    <td>$ownername</td>
                    <td><span class='badge badge-info right' id='mbtn' style='cursor:pointer;' data-mid='{$row['ID']}' data-toggle='modal' data-target='.bd-example-modal-lg'>View Profile</span></td>
                    <td>{$row['US_STATUS']}</td>
                    <td><button type='button' data-rid='{$row['ID']}' id='rtdelbtn' class='btn btn-danger'><i class='fas fa-trash'></i></button></td>
                 </tr>";
              }
    $userdata .= " </tfoot>
                  
                </table>";
                
    echo $userdata;
    
    
    }
    
    
    
    //-----admin UPI report-------//
    
    if(isset($_POST['type']) && $_POST['type'] == "UPI"){
        
$i = 1;
 $fromdate = $_POST['formdate'];
    $todate = $_POST['todate'];
    
  $sql = "
SELECT * FROM upi_transactions WHERE FILTER_DATE BETWEEN '{$fromdate}' AND '{$todate}' ORDER BY ID DESC
";

$result = mysqli_query($con, $sql) or die("SQL Query Failed.");
$userdata = "";

  $userdata .= '<table id="example1" class="table table-bordered table-striped">
        
                  <thead>
                  <tr>
                    <th>Sr. No.</th>
                    <th>Date </th>
                    <th>Time </th>
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
                    <td> {$row['FILTER_DATE']}</td>
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
    
    
    
    
    //-----admin aeps report-------//
    
    if(isset($_POST['pageid']) && $_POST['pageid'] == 1){
  
    $fromdate = $_POST['formdate'];
    $todate = $_POST['todate'];
    
  $sql = "
SELECT * FROM aeps_transactions WHERE TRANS_TYPE = 'CW' AND FILTER_DATE BETWEEN '{$fromdate}' AND '{$todate}' ORDER BY ID DESC
";

$result = mysqli_query($con, $sql) or die("SQL Query Failed.");
$userdata = "";

  $userdata .= '<table id="example1" class="table table-bordered table-striped">
        
                  <thead>
                  <tr>
                    <th>Sr. No.</th>
                    <th>Date </th>
                    <th>Time </th>
                    <th>Member Id.</th>
                    <th>Member Mobile No.</th>
                    <th>Transaction Id.</th>
                    <th>Transaction Amount</th>
                    <th>Status</th>
                    <th>Msg</th>
                    <th>Recipt</th>
                  </tr>
                  </thead>
                  <tbody>';
$i=1;
              while($row = mysqli_fetch_assoc($result)){
                  
             $user1 = $con->query("SELECT PARTNER_ID FROM user WHERE ID = '{$row["USER_ID"]}'")->fetch_assoc();
                  $st = explode("," , $row['STATUS']);
                $userdata .= "<tr>
                    <td>".$i++."</td>
                    <td>{$row['FILTER_DATE']}</td>
                    <td> {$row['TIMESTAMP']}</td>
                    <td>{$user1['PARTNER_ID']}</td>
                    <td>{$row['MOBILE']}</td>
                    <td>{$row['REFFRENCE_ID']}</td>
                    <td>{$row['AMOUNT']}</td>
                    <td>{$st[0]}</td>
                    <td>{$st[1]}</td>
                    <td><a target='_blank' href='Recipt/AePsRecipt.php?refrence_id={$row['REFFRENCE_ID']}&type=CW'><i class='nav-icon fas fa-receipt'></i></a></td>
                    
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
SELECT * FROM aeps_transactions WHERE TRANS_TYPE = 'MS' AND FILTER_DATE BETWEEN '{$fromdate}' AND '{$todate}' ORDER BY ID DESC
";

$result = mysqli_query($con, $sql) or die("SQL Query Failed.");
$userdata = "";

  $userdata .= '<table id="example1" class="table table-bordered table-striped">
        
                  <thead>
                  <tr>
                    <th>Sr. No.</th>
                     <th>Date </th>
                    <th>Time </th>
                    <th>Member Id.</th>
                    <th>Member Mobile No.</th>
                    <th>Transaction Id.</th>
                     <th>Status</th>
                    <th>Msg</th>
                    <th>Recipt</th>
                  </tr>
                  </thead>
                  <tbody>';
$i=1;
              while($row = mysqli_fetch_assoc($result)){
                  
             $user1 = $con->query("SELECT PARTNER_ID FROM user WHERE ID = '{$row["USER_ID"]}'")->fetch_assoc();
                    $st = explode("," , $row['STATUS']);
                $userdata .= "<tr>
                    <td>".$i++."</td>
                     <td>{$row['FILTER_DATE']}</td>
                    <td> {$row['TIMESTAMP']}</td>
                    <td>{$user1['PARTNER_ID']}</td>
                    <td>{$row['MOBILE']}</td>
                    <td>{$row['REFFRENCE_ID']}</td>
                     <td>{$st[0]}</td>
                    <td>{$st[1]}</td>
                    <td><a target='_blank' href='Recipt/AePsMinistatment.php?refrence_id={$row['REFFRENCE_ID']}&type=MS'><i class='nav-icon fas fa-receipt'></i></a></td>
                    
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
    
  $sql = "
SELECT * FROM aeps_transactions WHERE TRANS_TYPE = 'BE' AND FILTER_DATE BETWEEN '{$fromdate}' AND '{$todate}' ORDER BY ID DESC
";

$result = mysqli_query($con, $sql) or die("SQL Query Failed.");
$userdata = "";

  $userdata .= '<table id="example1" class="table table-bordered table-striped">
        
                  <thead>
                  <tr>
                    <th>Sr. No.</th>
                     <th>Date </th>
                    <th>Time </th>
                    <th>Member Id.</th>
                    <th>Member Mobile No.</th>
                    <th>Transaction Id.</th>
                     <th>Status</th>
                    <th>Msg</th>
                    <th>Recipt</th>
                  </tr>
                  </thead>
                  <tbody>';
$i=1;
              while($row = mysqli_fetch_assoc($result)){
                  
             $user1 = $con->query("SELECT PARTNER_ID FROM user WHERE ID = '{$row["USER_ID"]}'")->fetch_assoc();
                    $st = explode("," , $row['STATUS']);
                $userdata .= "<tr>
                    <td>".$i++."</td>
                     <td>{$row['FILTER_DATE']}</td>
                    <td> {$row['TIMESTAMP']}</td>
                    <td>{$user1['PARTNER_ID']}</td>
                    <td>{$row['MOBILE']}</td>
                    <td>{$row['REFFRENCE_ID']}</td>
                     <td>{$st[0]}</td>
                    <td>{$st[1]}</td>
                    <td><a target='_blank' href='Recipt/AePsRecipt.php?refrence_id={$row['REFFRENCE_ID']}&type=BE'><i class='nav-icon fas fa-receipt'></i></a></td>
                    
                 </tr>";
              }
    $userdata .= " </tfoot>
                  
                </table>";
              

    echo $userdata;
}
    
    
    
     //-----admin DMT report-------//
    
    if(isset($_POST['pageid']) && $_POST['pageid'] == 2){
        
$i = 1;

 $fromdate = $_POST['formdate'];
    $todate = $_POST['todate'];

  $sql = "
SELECT * FROM dmt_transactions WHERE FILTER_DATE BETWEEN '{$fromdate}' AND '{$todate}' ORDER BY ID DESC
";

$result = mysqli_query($con, $sql) or die("SQL Query Failed.");
$userdata = "";

  $userdata .= '<table id="example1" class="table table-bordered table-striped">
        
                  <thead>
                  <tr>
                    <th>Sr. No.</th>
                      <th>Date </th>
                    <th>Time </th>
                    <th>Member Id.</th>
                    <th>Member Mobile No.</th>
                    <th>Transaction Id.</th>
                    <th>Transaction Amount</th>
                     <th>Status</th>
                    <th>Recipt</th>
                    <th>API</th>
                  </tr>
                  </thead>
                  <tbody>';

              while($row = mysqli_fetch_assoc($result)){
                  
             $user1 = $con->query("SELECT PARTNER_ID FROM user WHERE ID = {$row['USER_ID']}")->fetch_assoc();
                    $st = explode("," , $row['STATUS']);
                $userdata .= "<tr>
                    <td>".$i++."</td>
                     <td>{$row['FILTER_DATE']}</td>
                    <td> {$row['TIMESTAMP']}</td>
                    <td>{$user1['PARTNER_ID']}</td>
                    <td>{$row['MOBILE']}</td>
                    <td>{$row['REFFRENCE_ID']}</td>
                    <td>{$row['AMOUNT']}</td>
                      <td>{$st[0]}</td>
                    <td><a target='_blank' href='Recipt/DMTRecipt.php?refrence_id={$row['REFFRENCE_ID']}'><i class='nav-icon fas fa-receipt'></i></a></td>
                    <td>{$row['APINAME']}</td>
                    
                 </tr>";
              }
    $userdata .= " </tfoot>
                  
                </table>";
                
    echo $userdata;
}


//Recharge report code here........
    
    if(isset($_POST['pageid']) && $_POST['pageid'] == 4){
        
        $i = 1;

 $fromdate = $_POST['formdate'];
    $todate = $_POST['todate'];
    
 $sql = "
SELECT * FROM recharge_transaction WHERE SERVICE = 'Prepaid' AND FILTER_DATE BETWEEN '$fromdate' AND '{$todate}' ORDER BY ID DESC
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
                          <th>Date </th>
                        <th>Time </th>
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
                    <td>{$st[1]}</td>
                    <td>{$row['REFERENCE_ID']}</td>
                    <td>{$row['OPERATOR_ID']}</td>
                     <td>{$row['FILTER_DATE']}</td>
                    <td> {$row['TIMESTAMP']}</td>
                    <td><a target='_blank' href='Recipt/RechargeRecipt.php?refrence_id={$row['REFERENCE_ID']}'><i class='nav-icon fas fa-receipt'></i></a></td>
                    
                 </tr>";
              }
    $userdata .= " </tfoot>
                  
                </table>";
                
    echo $userdata;
        
        
    }
    
//Recharge DTH report code here........
    
    if(isset($_POST['pageid']) && $_POST['pageid'] == 10){
        
        $i = 1;

 $fromdate = $_POST['formdate'];
    $todate = $_POST['todate'];
    
 $sql = "
SELECT * FROM recharge_transaction WHERE SERVICE = 'DTH' AND FILTER_DATE BETWEEN '{$fromdate}' AND '{$todate}' ORDER BY ID DESC
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
                          <th>Date </th>
                        <th>Time </th>
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
                    <td>{$st[1]}</td>
                    <td>{$row['REFERENCE_ID']}</td>
                    <td>{$row['OPERATOR_ID']}</td>
                     <td>{$row['FILTER_DATE']}</td>
                    <td> {$row['TIMESTAMP']}</td>
                    <td><a target='_blank' href='Recipt/RechargeRecipt.php?refrence_id={$row['REFERENCE_ID']}'><i class='nav-icon fas fa-receipt'></i></a></td>
                    
                 </tr>";
              }
    $userdata .= " </tfoot>
                  
                </table>";
                
    echo $userdata;
        
        
    }
    
    
     //X-DMT report code here
    
    if(isset($_POST['pageid']) && $_POST['pageid'] == 7){
 $i = 1;        

$fromdate = $_POST['formdate'];
    $todate = $_POST['todate'];

  $sql = "
SELECT * FROM xdmt_transactions WHERE date(TIMESTAMP) BETWEEN '{$fromdate}' AND '{$todate}' ORDER BY ID DESC
";

$result = mysqli_query($con, $sql) or die("SQL Query Failed.");
$userdata = "";


  $userdata .= '<table id="example1" class="table table-bordered table-striped">
        
                  <thead>
                  <tr>
                     <th>Sr. No.</th>
                      <th>Date </th>
                    <th>Time </th>
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
                     <td>{$row['FILTER_DATE']}</td>
                    <td> {$row['TIMESTAMP']}</td>
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
    
    
    // Aeps Adhaarpay Report code here


if(isset($_POST['pageid']) && $_POST['pageid'] == 8){
  
  $fromdate = $_POST['formdate'];
    $todate = $_POST['todate'];
    
  $sql = "
SELECT * FROM aeps_transactions WHERE TRANS_TYPE = 'M' AND FILTER_DATE BETWEEN '{$fromdate}' AND '{$todate}' ORDER BY ID DESC
";

$result = mysqli_query($con, $sql) or die("SQL Query Failed.");
$userdata = "";

  $userdata .= '<table id="example1" class="table table-bordered table-striped">
        
                  <thead>
                  <tr>
                    <th>Sr. No.</th>
                     <th>Date </th>
                    <th>Time </th>
                    <th>Member Id.</th>
                    <th>Member Mobile No.</th>
                    <th>Transaction Id.</th>
                    <th>Amount.</th>
                    <th>Status</th>
                    <th>Msg</th>
                    <th>Recipt</th>
                  </tr>
                  </thead>
                  <tbody>';
$i=1;
              while($row = mysqli_fetch_assoc($result)){
                  
             $user1 = $con->query("SELECT PARTNER_ID FROM user WHERE ID = '{$row["USER_ID"]}'")->fetch_assoc();
                    $st = explode("," , $row['STATUS']);
                $userdata .= "<tr>
                    <td>".$i++."</td>
                     <td>{$row['FILTER_DATE']}</td>
                    <td> {$row['TIMESTAMP']}</td>
                    <td>{$user1['PARTNER_ID']}</td>
                    <td>{$row['MOBILE']}</td>
                    <td>{$row['REFFRENCE_ID']}</td>
                    <td>{$row['AMOUNT']}</td>
                      <td>{$st[0]}</td>
                    <td>{$st[1]}</td>
                    <td><a target='_blank' href='Recipt/AePsRecipt.php?refrence_id={$row['REFFRENCE_ID']}&type=M'><i class='nav-icon fas fa-receipt'></i></a></td>
                    
                 </tr>";
              }
    $userdata .= " </tfoot>
                  
                </table>";
              

    echo $userdata;
}
    
    
    
    
    
?>