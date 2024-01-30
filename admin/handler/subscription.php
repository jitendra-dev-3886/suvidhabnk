<?php
session_start();
require_once('../../Db/config.php');
require("../include/Auth.php");


//-----Subscription Plan List Admin-------//
    
    if(isset($_POST['pageid']) && $_POST['pageid'] == 1){
  
  $sql = "
SELECT * FROM subscription_plan
";

$result = mysqli_query($con, $sql) or die("SQL Query Failed.");
$userdata = "";

  $userdata .= '<table id="example1" class="table table-bordered table-striped">
        
                  <thead>
                  <tr>
                    <th>Plan Id</th>
                    <th>Plan Name</th>
                    <th>Plan Type</th>
                    <th>Interval Type</th>
                    <th>Intervals</th>
                    <th>Amount</th>
                    <th>Status</th>
                    <th>Date</th>
                    <th>Action</th>
                  </tr>
                  </thead>
                  <tbody>';

              while($row = mysqli_fetch_assoc($result)){
                  
                  
                $userdata .= "<tr>
                    <td>{$row['PLAN_ID']}</td>
                    <td>{$row['PLAN_NAME']}</td>
                    <td>{$row['PLAN_TYPE']}</td>
                    <td>{$row['INTERVAL_TYPE']}</td>
                    <td>{$row['INTERVALS']} {$row['INTERVAL_TYPE']}</td>
                    <td>{$row['AMOUNT']} Rs</td>
                    <td>{$row['STATUS']}</td>
                    <td>{$row['DATE']}</td>
                    <td><button type='button' class='btn btn-primary'><i class='fas fa-pen'></i></button> <button type='button' class='btn btn-danger deletebtn' data-id='{$row['ID']}'><i class='fas fa-trash'></i></button></td>
                    
                 </tr>";
              }
    $userdata .= " </tfoot>
                  
                </table>";
              

    echo $userdata;
}

//-----Subscription Plan List date Filter-------//

if(isset($_POST['pageid']) && $_POST['pageid'] == 2){
    
    $fromdate = $_POST['formdate'];
    $todate = $_POST['todate'];

 $i = 1;

  
  $sql = "
SELECT * FROM subscription_plan WHERE STATUS != 'COMPLETED' AND date(DATE) BETWEEN '{$fromdate}' AND '{$todate}'
";

$result = mysqli_query($con, $sql) or die("SQL Query Failed.");
$userdata = "";


  $userdata .= '<table id="example1" class="table table-bordered table-striped">
        
                  <thead>
                  <tr>
                    <th>Plan Id</th>
                    <th>Plan Name</th>
                    <th>Plan Type</th>
                    <th>Interval Type</th>
                    <th>Intervals</th>
                    <th>Amount</th>
                    <th>Status</th>
                    <th>Date</th>
                    <th>Action</th>
                  </tr>
                  </thead>
                  <tbody>';

              while($row = mysqli_fetch_assoc($result)){
                  
                  
                $userdata .= "<tr>
                    <td>{$row['PLAN_ID']}</td>
                    <td>{$row['PLAN_NAME']}</td>
                    <td>{$row['PLAN_TYPE']}</td>
                    <td>{$row['INTERVAL_TYPE']}</td>
                    <td>{$row['INTERVALS']} {$row['INTERVAL_TYPE']}</td>
                    <td>{$row['AMOUNT']}</td>
                    <td>{$row['STATUS']}</td>
                    <td>{$row['DATE']}</td>
                    <td><button type='button' class='btn btn-primary'><i class='fas fa-pen'></i></button> <button type='button' class='btn btn-danger'><i class='fas fa-trash'></i></button></td>
                    
                 </tr>";
              }
    $userdata .= " </tfoot>
                  
                </table>";
    

    echo $userdata;
}


//-----Subscription Plan List Admin-------//
    
    if(isset($_POST['pageid']) && $_POST['pageid'] == 3){
  
  $fromdate = $_POST['formdate'];
  $todate = $_POST['todate'];
  
  $sql = "
SELECT * FROM subscription WHERE date(DATE) BETWEEN '$fromdate' AND '$todate'";

$result = mysqli_query($con, $sql) or die("SQL Query Failed.");
$userdata = "";
$i=1;

$userdata .= " <table id='example1' class='table table-bordered table-striped'>
                  <thead>
                  <tr>
                    <th>SL No</th>
                    <th>User Name</th>
                    <th>Mobile</th>
                    <th>Email</th>
                    <th>Subscription Id</th>
                    <th>Plan Name</th>
                    <th>Validity</th>
                    <th>Subscription Expiry date</th>
                    <th>Message</th>
                    <th>Status</th>
                    <th>Remark</th>
                    <th>Date</th>
                  </tr>
                  </thead>
                  <tbody>";
              while($row = mysqli_fetch_assoc($result)){
                  
                  $fetchplan = $con->query("SELECT * FROM subscription_plan WHERE ID = '{$row["PLAN_ROW_ID"]}'")->fetch_assoc();
                  
                $userdata .= "<tr>
                    <td>".$i++."</td>
                    <td>{$row['CUSTOMER_NAME']}</td>
                    <td>{$row['MOBILE']}</td>
                    <td>{$row['EMAIL']}</td>
                    <td>{$row['SUBSCRIPTION_ID']}</td>
                    <td>{$fetchplan['PLAN_NAME']}</td>
                    <td>{$fetchplan['INTERVALS']} {$fetchplan['INTERVAL_TYPE']}</td>
                    <td>{$row['EXPIRY_DATE']}</td>
                    <td>{$row['MESSAGE']}</td>
                    <td>{$row['STATUS']}</td>
                    <td>{$row['SUBS_REMARK']}</td>
                    <td>{$row['DATE']}</td>
                 </tr>";
              }
              
              
    $userdata .= "</tbody>
                </table>";

    echo $userdata;
}

///delete user record
if(isset($_POST['pageid']) && $_POST['pageid'] ==4){
    $userid=$_POST['delid'];
    $deletequery ="DELETE FROM `subscription_plan` WHERE `ID` = '$userid'";
    $run=mysqli_query($con,$deletequery);
    if($run){
        echo 1;
    }else{
        echo 0;
    }
}


?>