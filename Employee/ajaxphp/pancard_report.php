<?php
session_start();
require_once('../../Db/config.php');
require("../include/Auth.php");

 $i = 1;

if(isset($_POST['pageid']) && $_POST['pageid'] == 1){
    $fromdate = $_POST['formdate'];
    $todate = $_POST['todate'];

  $sql = "
SELECT * FROM pan_transaction WHERE date(DATE) BETWEEN '$fromdate' AND '$todate' ORDER BY ID DESC
";

$result = mysqli_query($con, $sql) or die("SQL Query Failed.");
$userdata = "";


  $userdata .= '<table id="example1" class="table table-bordered table-striped">
        
                  <thead>
                  <tr>
                    <th>Sr. No.</th>
                    <th>Member Id</th>
                    <th>Date and Time</th>
                    <th>No of Coupon</th>
                    <th>Amount</th>
                    <th>Transaction ID</th>
                    <th>RT Comm.</th>
                    <th>DT Comm</th>
                    <th>Status</th>
                  </tr>
                  </thead>
                  <tbody>';

              while($row = mysqli_fetch_assoc($result)){
                   $userId = $row['USER_ID'];
                   $users = $con->query("SELECT * FROM `user` WHERE ID='$userId'")->fetch_assoc();
                $userdata .= "<tr>
                    <td>".$i++."</td>
                    <td>{$users['PARTNER_ID']}</td>
                    <td>{$row['DATE']}</td>
                    <td>{$row['NUMBER_OF_COUPON']}</td>
                    <td>{$row['AMOUNT']}</td>
                    <td>{$row['TRANSACTION_ID']}</td>
                    <td>{$row['RT_COMM']}</td>
                    <td>{$row['DT_COMM']}</td>
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

  $sql = "
SELECT * FROM pan_transaction WHERE date(DATE) BETWEEN '$fromdate' AND '$todate' ORDER BY ID DESC
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
                    <td>{$row['STATUS']}</td>
                   
                 </tr>";
              }
    $userdata .= " </tfoot>
                  
                </table>";
                
               
    echo $userdata;
}
    
    
 ?>