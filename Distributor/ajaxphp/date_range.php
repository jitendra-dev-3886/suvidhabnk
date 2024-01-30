<?php

session_start();
require_once('../../Db/config.php');
require("../include/Auth.php");

if(isset($_POST['pageid']) && $_POST['pageid'] == 1){
    
    $fromdate = $_POST['formdate'];
    $todate = $_POST['todate'];

 $i = 1;

  
  $sql = "
SELECT * FROM aeps_transactions WHERE FILTER_DATE BETWEEN '{$fromdate}' AND '{$todate}'
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


if(isset($_POST['pageid']) && $_POST['pageid'] == 5){
    
    $fromdate = $_POST['formdate'];
    $todate = $_POST['todate'];

 $type = $_POST['type'];
     
     $id = $_POST['id'];
    if($type == "MAIN"){
        $filterquery = "and  WALLET='MAIN'";
    }
    else{
        $filterquery = "and  WALLET='AEPS'";
    }
    
   if($id != ""){
        $userid = $id;
    }else{
        $userid = $usid;
        
    }
    
    $sql = "SELECT * FROM report WHERE USER_ID = '$userid' $filterquery AND TRANS_DATE BETWEEN '{$fromdate}' AND '{$todate}'";
// echo $sql;

    $result = mysqli_query($con, $sql);
    $userdata="";
      $userdata .= '<table id="example1" class="table table-bordered table-striped">
        
                  <thead>
                  <tr>
                        <th>Sr No</th>
                        <th>Date & Time</th>
                        <th>Member ID</th>
                        <th>Service Type</th>
                        <th>Ref Id</th>
                        <th>Credit</th>
                        <th>Debit</th>
                        <th>Balance</th>
                  </tr>
                  </thead>
                  <tbody>';
$i=1;
    while ($row = mysqli_fetch_assoc($result))
    {
        if(strtolower($row['FUND_TYPE']) == "debit"){
            $fnd = "<td>0</td><td>{$row['AMOUNT']}</td>";
        }
        else if(strtolower($row['FUND_TYPE']) == "credit"){
            $fnd = "<td>{$row['AMOUNT']}</td><td>0</td>";
        }
        else{
            $fnd = "<td>0</td><td>0</td>";
        }
        $userdata .= "<tr>
                    <td>" . $i++ . "</td>
                    <td>{$row['TRANS_DATE']} {$row['TRANS_TIME']}</td>
                    <td>{$user['PARTNER_ID']}</td>
                    <td>{$row['TRANS_TYPE']}</td>
                    <td>{$row['REFERENCE_ID']}</td>
                    $fnd
                    <td>{$row['AFTER_AMOUNT']}</td>
                   
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



?>