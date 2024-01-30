<?php
session_start();
require_once('../../Db/config.php');
require("../include/Auth.php");
 
  if(isset($_POST['pageid']) && $_POST['pageid'] == 1){
        
$i = 1;

  $sql = "SELECT * FROM recharge_transaction ORDER BY ID DESC";

$result = mysqli_query($con, $sql) or die("SQL Query Failed.");
$userdata = "";

  $userdata .= '<table id="example1" class="table table-bordered table-striped">
        
                  <thead>
                  <tr>
                    <th>Sr. No.</th>
                    <th>Date & Time </th>
                    <th>Member Mobile No.</th>
                    <th>Transaction Id.</th>
                    <th>Transcation Amount</th>
                    <th>Operator</th>
                    <th>Status</th>
                    <th>View Details</th>
                  </tr>
                  </thead>
                  <tbody>';

              while($row = mysqli_fetch_assoc($result)){
                  
             $user1 = $con->query("SELECT REFERENCE_ID,MOBILE FROM user WHERE ID = '{$row["USER_ID"]}'")->fetch_assoc();
             
             

             $response_data = json_decode($row['SEND_DATA'],true);
                $userdata .= "<tr>
                    <td>".$i++."</td>
                    <td> {$row['FILTER_DATE']}</td>
                    <td>{$user1['MOBILE']}</td>
                    <td>{$user1['REFERENCE_ID']}</td>
                    <td>{$row['AMOUNT']}</td>
                    <td>{$row['OPERATOR']}</td>
                    <td>{$row['STATUS']}</td>
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
SELECT * FROM recharge_transaction WHERE USER_ID='$usid' $whr AND date(TIMESTAMP) BETWEEN '{$fromdate}' AND '{$todate}'
";


$result = mysqli_query($con, $sql) or die("SQL Query Failed.");
$userdata = "";


 $userdata .= '<table id="example1" class="table table-bordered table-striped">
        
                  <thead>
                  <tr>
                   <tr>
                    <th>Sr. No.</th>
                    <th>Date & Time </th>
                    <th>Member Mobile No.</th>
                    <th>Transaction Id.</th>
                    <th>Transcation Amount</th>
                    <th>Operator</th>
                    <th>Status</th>
                    <th>View Details</th>
                  </tr>
                  </thead>
                  <tbody>';

              while($row = mysqli_fetch_assoc($result)){
                  
             $user1 = $con->query("SELECT REFERENCE_ID FROM user WHERE ID = {$row['USER_ID']}")->fetch_assoc();
                    $st = explode("," , $row['STATUS']);
                $userdata .= "<tr>
                   <td>".$i++."</td>
                    <td> {$row['FILTER_DATE']}</td>
                    <td>{$user1['MOBILE']}</td>
                    <td>{$user1['REFERENCE_ID']}</td>
                    <td>{$row['AMOUNT']}</td>
                    <td>{$row['OPERATOR']}</td>
                    <td>{$row['STATUS']}</td>
                 </tr>";
              }
    $userdata .= " </tfoot>
                  
                </table>";
                
              

    echo $userdata;
}



    
 ?>