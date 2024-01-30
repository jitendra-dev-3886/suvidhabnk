<?php
session_start();
// include("../config.php");
require_once('../../Db/config.php');

      $_SESSION["token_id"] = $token_id;
      $usid = $_SESSION['dtid']; 
      //  Display Code

if(isset($_POST['id']) && $_POST['id'] == 1){
    $fromdate = $_POST['formdate'];
    $todate = $_POST['todate'];
    
$query = "SELECT * FROM `fund_transfer` WHERE OWNER_ID = '$usid' AND WALLET_TYPE ='MAIN_BAL' AND date(DATE) between '$fromdate' and '$todate' ORDER BY ID DESC";
$query_run = mysqli_query($con,$query);

$output = "";

$i = 1;
$output .= " <table id='example1' class='table table-bordered table-striped'>
                  <thead>
                  <tr>
                    <th>Sr No</th>
                    <th>Date & Time</th>
                    <th>Member ID</th>
                    <th>Member Mobile No </th>
                    <th>Fund Type</th>
                    <th>Previous Balance</th>
                    <th>Amount</th>
                    <th>Remark</th>
                    <th>After Balance </th>
                  </tr>
                  </thead>
                  <tbody>";
while($rows = mysqli_fetch_assoc($query_run)){
    
    $user = $con->query("SELECT * FROM `user` WHERE ID = {$rows['TRANSFER_USER_ID']} AND OWNER_ID='$usid'")->fetch_assoc();
    
    $output .= "<tr>
    <td>".$i++."</td>
    <td>{$rows['DATE']}</td>
    <td>{$user['PARTNER_ID']}</td>
    <td>{$user['MOBILE']}</td>
    <td>{$rows['FUND_TYPE']}</td>
    <td>{$rows['USER_PREVIOUS_AMOUNT']}</td>
    <td>{$rows['AMOUNT']}</td>
    <td>{$rows['REMARK']}</td>
    <td>{$rows['USER_AFTER_AMOUNT']}</td>
    </tr>";
    
}

$output .= "</tbody> 
                </table>";

echo $output;

}


if(isset($_POST['id']) && $_POST['id'] == 2){
    
$query = "SELECT * FROM `fund_transfer` WHERE WALLET_TYPE ='AEPS_BAL' ORDER BY ID DESC";
$query_run = mysqli_query($con,$query);

$i = 1;
$output = "";

while($rows = mysqli_fetch_assoc($query_run)){
    
    $user = $con->query("SELECT * FROM `user` WHERE ID = '{$rows["TRANSFER_USER_ID"]}'")->fetch_assoc();
    
    $output .= "<tr>
    <td>".$i++."</td>
    <td>{$user['PARTNER_ID']}</td>
    <td>{$user['MOBILE']}</td>
    <td>{$rows['FUND_TYPE']}</td>
    <td>{$rows['USER_PREVIOUS_AMOUNT']}</td>
    <td>{$rows['AMOUNT']}</td>
    <td>{$rows['REMARK']}</td>
    <td>{$rows['USER_AFTER_AMOUNT']}</td>
    <td>{$rows['DATE']}</td>
    </tr>";
    
}

echo $output;

}

      
      
      
      
      
      
      
      
      ?>