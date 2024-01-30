<?php
session_start();
require_once('../../Db/config.php');
require("../include/Auth.php");

    
    if(isset($_POST['pageid']) && $_POST['pageid'] == 2){
    
    $fromdate = $_POST['formdate'];
    $todate = $_POST['todate'];

 $i = 1;

  $sql = "
SELECT * FROM dmt_transactions WHERE FILTER_DATE BETWEEN '{$fromdate}' AND '{$todate}'
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
                    <td>{$row['TIMESTAMP']}</td>
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


if(isset($_POST['pageid']) && $_POST['pageid'] == 3){
    
    $fromdate = $_POST['formdate'];
    $todate = $_POST['todate'];

 $i = 1;
  
  $sql = "
SELECT * FROM payout_transaction WHERE FILTER_DATE BETWEEN '{$fromdate}' AND '{$todate}'
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
                  
                  $user1 = $con->query("SELECT PARTNER_ID,MOBILE FROM user WHERE ID = {$row['USER_ID']}")->fetch_assoc();
                 
                $userdata .= "<tr>
                    <td>".$i++."</td>
                    <td>{$row['TIMESTAMP']}</td>
                    <td>{$user1['PARTNER_ID']}</td>
                    <td>{$user1['MOBILE']}</td>
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


if(isset($_POST['pageid']) && $_POST['pageid'] == 4){
    
    $fromdate = $_POST['formdate'];
    $todate = $_POST['todate'];

 $i = 1;
  $sql = "
SELECT * FROM recharge_transaction WHERE FILTER_DATE BETWEEN '{$fromdate}' AND '{$todate}'
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
                    <td>{$row['TIMESTAMP']}</td>
                    <td><a target='_blank' href='Recipt/RechargeRecipt.php?refrence_id={$row['REFERENCE_ID']}'><i class='nav-icon fas fa-receipt'></i></a></td>
                    
                 </tr>";
              }
    $userdata .= " </tfoot>
                  
                </table>";
                
               
    echo $userdata;
}


if(isset($_POST['pageid']) && $_POST['pageid'] == 5){
    
    $fromdate = $_POST['formdate'];
    $todate = $_POST['todate'];

 $type = $_POST['type'];
     $id = $_POST['id'];
     
    if($type == "MAIN"){
        $filterquery = "where WALLET='MAIN'";
        $am = "ALL_MAIN";
    }
    else{
        $filterquery = "where WALLET='AEPS'";
        $am = "ALL_AEPS";
    }
    

    $sql = "SELECT * FROM report $filterquery AND USER_ID = '$id' AND TRANS_DATE BETWEEN '{$fromdate}' AND '{$todate}' order by ID desc";
// echo "SELECT * FROM report WHERE USER_ID = '$id' $filterquery ORDER BY ID DESC LIMIT {$offset},{$limit_per_page}";
    $result = mysqli_query($con, $sql);
    $userdata = "";

    $userdata .= '<table id="example1" class="table table-bordered table-striped">
        
                  <thead>
                  <tr>
                        <th>SL No</th>
                        <th>Timestamp</th>
                        <th>Member ID</th>
                        <th>Service Type</th>
                        <th>Ref Id</th>
                        <th>Credit</th>
                        <th>Debit</th>
                        <th>Remain Bal</th>
                  </tr>
                  </thead>
                  <tbody>';
$i=1;
    while ($row = mysqli_fetch_assoc($result))
    {
         if(strtolower($row['FUND_TYPE']) == "debit"){
            $fnd = "<td>0</td><td>".number_format($row['AMOUNT'] ,2)."</td>";
        }
        else if(strtolower($row['FUND_TYPE']) == "credit"){
            $fnd = "<td>".number_format($row['AMOUNT'] ,2)."</td><td>0</td>";
        }
        else{
            $fnd = "<td>0</td><td>0</td>";
        }
        
        $usdt = $con->query("select * from user where ID='".$row['USER_ID']."' ")->fetch_assoc();
        if(strtolower($row['USER_ID']) == "admin"){
            $prtnerid = "ADMIN";
        }
        else{
            $prtnerid = $usdt['PARTNER_ID'];
        }
        $userdata .= "<tr>
                    <td>" . $i++ . "</td>
                    <td>{$row['TRANS_DATE']} {$row['TRANS_TIME']}</td>
                    <td>{$prtnerid}</td>
                    <td>{$row['TRANS_TYPE']}</td>
                    <td>{$row['REFERENCE_ID']}</td>
                    $fnd
                    <td>".number_format($row["AFTER_AMOUNT"] , 2)."</td>
                   
                 </tr>";
    }
    $userdata .= " </tfoot>
                  
                </table>";


    echo $userdata;


}

//xdmt date range

if(isset($_POST['pageid']) && $_POST['pageid'] == 6){
    
    $fromdate = $_POST['formdate'];
    $todate = $_POST['todate'];

 $i = 1;

  $sql = "
SELECT * FROM xdmt_transactions WHERE FILTER_DATE BETWEEN '{$fromdate}' AND '{$todate}'
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
                    <td>{$row['TIMESTAMP']}</td>
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

//xdmt date range

if(isset($_POST['pageid']) && $_POST['pageid'] == 7){
    
    $fromdate = $_POST['formdate'];
    $todate = $_POST['todate'];

 $i = 1;

  $sql = "
SELECT * FROM xdmt_transactions WHERE TRANS_TYPE = 'M' AND FILTER_DATE BETWEEN '{$fromdate}' AND '{$todate}'
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
                    <td><a target='_blank' href='Recipt/AePsRecipt.php?refrence_id={$row['REFFRENCE_ID']}'><i class='nav-icon fas fa-receipt'></i></a></td>
                    
                 </tr>";
              }
    $userdata .= " </tfoot>
                  
                </table>";
                
    

    echo $userdata;
}


if(isset($_POST['pageid']) && $_POST['pageid'] == 8){
    
    $fromdate = $_POST['formdate'];
    $todate = $_POST['todate'];

 $i = 1;

  $sql = "SELECT * FROM aeps_transactions WHERE TRANS_TYPE = 'MS' AND FILTER_DATE BETWEEN '{$fromdate}' AND '{$todate}'";

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
                    <td>{$row['TIMESTAMP']}</td>
                    <td>{$user1['PARTNER_ID']}</td>
                    <td>{$row['MOBILE']}</td>
                    <td>{$row['REFFRENCE_ID']}</td>
                    <td>{$row['STATUS']}</td>
                    <td><a target='_blank' href='Recipt/AePsMinistatment.php?refrence_id={$row['REFFRENCE_ID']}&type=MS'><i class='nav-icon fas fa-receipt'></i></a></td>
                    
                 </tr>";
              }
    $userdata .= " </tfoot>
                  
                </table>";
                  
                
    

    echo $userdata;
}


if(isset($_POST['pageid']) && $_POST['pageid'] == 9){
    
    $fromdate = $_POST['formdate'];
    $todate = $_POST['todate'];

 $i = 1;

  $sql = "SELECT * FROM aeps_transactions WHERE TRANS_TYPE = 'M' AND FILTER_DATE BETWEEN '{$fromdate}' AND '{$todate}'";

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
                    <td>{$row['TIMESTAMP']}</td>
                    <td>{$user1['PARTNER_ID']}</td>
                    <td>{$row['MOBILE']}</td>
                    <td>{$row['REFFRENCE_ID']}</td>
                    <td>{$row['STATUS']}</td>
                    <td><a target='_blank' href='Recipt/AePsMinistatment.php?refrence_id={$row['REFFRENCE_ID']}&type=MS'><i class='nav-icon fas fa-receipt'></i></a></td>
                    
                 </tr>";
              }
    $userdata .= " </tfoot>
                  
                </table>";
                  
                
    

    echo $userdata;
}

// UPI Date range report

if(isset($_POST['type']) && $_POST['type'] == "UPI"){
    
    $fromdate = $_POST['formdate'];
    $todate = $_POST['todate'];

 $i = 1;

  $sql = "SELECT * FROM upi_transactions WHERE FILTER_DATE BETWEEN '{$fromdate}' AND '{$todate}'";

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