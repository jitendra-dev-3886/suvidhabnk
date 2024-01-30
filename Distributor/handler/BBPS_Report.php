<?php

session_start();
require_once('../../Db/config.php');
require("../include/Auth.php");
 $usid = $_SESSION['UsId']; 
 $duser = $con->query("SELECT * FROM user WHERE OWNER_ID='$usid'")->fetch_assoc();

$duserid = $duser["ID"];

 
  if(isset($_POST['pageid']) && $_POST['pageid'] == 1){
      $fromdate = $_POST['formdate'];
      $todate = $_POST['todate'];
$i = 1;
$mode = $_POST["mode"];
$type = $_POST["category"];

if($mode != ''){
    $whr = "AND MODE='$mode'";
}else if($type != ''){
    $whr = "AND CATEGORY='$type'";
    
}else{
    $whr = "";
    
}

  $sql = "
SELECT * FROM pay_bill_api WHERE USER_ID='$duserid' $whr AND FILTER_DATE between '$fromdate' and '$todate' ORDER BY ID DESC
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
                    <th>Category</th>
                    <th>Operator</th>
                    <th>Operator Id</th>
                    <th>Transaction Id.</th>
                    <th>Transaction Amount</th>
                    <th>Status</th>
                    <th>Remark</th>
                    <th>Action Date</th>
                    <th>Recipt</th>
                  </tr>
                  </thead>
                  <tbody>';

              while($row = mysqli_fetch_assoc($result)){
                  
             $user1 = $con->query("SELECT PARTNER_ID,MOBILE FROM user WHERE ID = {$row['USER_ID']}")->fetch_assoc();
                    $st = explode("," , $row['STATUS']);
                $userdata .= "<tr>
                    <td>".$i++."</td>
                    <td> {$row['FILTER_DATE']}</td>
                    <td> {$row['TIMESTAMP']}</td>
                    <td>{$user1['PARTNER_ID']}</td>
                    <td>{$user1['MOBILE']}</td>
                    <td>{$row['CATEGORY']}</td>
                    <td>{$row['OP_NAME']}</td>
                    <td>{$row['OPERATORID']}</td>
                    <td>{$row['REFFRENCE_ID']}</td>
                    <td>{$row['AMOUNT']}</td>
                    <td>{$row['STATUS']}</td>
                    <td>{$row['REMARK']}</td>
                    <td>{$row['ACTION_DATE']}</td>
                    <td><a target='_blank' href='Recipt/BBPSReciept.php?refrence_id={$row['REFFRENCE_ID']}'><i class='nav-icon fas fa-receipt'></i></a></td>
                    
                 </tr>";
              }
    $userdata .= " </tfoot>
                  
                </table>";
                
    echo $userdata;
}


if(isset($_POST['pageid']) && $_POST['pageid'] == 2){
    
    $fromdate = $_POST['formdate'];
    $todate = $_POST['todate'];
    $mode = $_POST["mode"];

 $i = 1;

  $sql = "
SELECT * FROM pay_bill_api WHERE USER_ID='$duserid' $whr AND FILTER_DATE BETWEEN '{$fromdate}' AND '{$todate}'
";


$result = mysqli_query($con, $sql) or die("SQL Query Failed.");
$userdata = "";


 $userdata .= '<table id="example1" class="table table-bordered table-striped">
        
                  <thead>
                  <tr>
                    <th>Sr. No.</th>
                    <th>Date </th>
                    <th>Member Id.</th>
                    <th>Member Mobile No.</th>
                    <th>Category</th>
                    <th>Operator</th>
                    <th>Operator Id</th>
                    <th>Transaction Id.</th>
                    <th>Transaction Amount</th>
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
                    <td>{$row['CATEGORY']}</td>
                    <td>{$row['OP_NAME']}</td>
                    <td>{$row['OPERATORID']}</td>
                    <td>{$row['REFFRENCE_ID']}</td>
                    <td>{$row['AMOUNT']}</td>
                    <td>{$row['STATUS']}</td>
                    <td><a target='_blank' href='Recipt/BBPSReciept.php?refrence_id={$row['REFFRENCE_ID']}'><i class='nav-icon fas fa-receipt'></i></a></td>
                    
                 </tr>";
              }
    $userdata .= " </tfoot>
                  
                </table>";
                
              

    echo $userdata;
}



    
 ?>