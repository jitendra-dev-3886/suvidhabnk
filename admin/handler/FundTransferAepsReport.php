<?php
session_start();
// include("../config.php");
require_once('../../Db/config.php');

      $_SESSION["token_id"] = $token_id;
      
      //  Display Code

if(isset($_POST['id']) && $_POST['id'] == 1){
    
$query = "SELECT * FROM `fund_transfer` WHERE WALLET_TYPE ='AEPS_BAL' ORDER BY ID DESC";
$query_run = mysqli_query($con,$query);

$i = 1;
$output = "";

while($rows = mysqli_fetch_assoc($query_run)){
    
    $user = $con->query("SELECT * FROM `user` WHERE ID = {$rows['TRANSFER_USER_ID']}")->fetch_assoc();
    
    $output .= "<tr>
    
    <td>".$i++."</td>
    <td>{$user['PARTNER_ID']}</td>
    <td>{$user['MOBILE']}</td>
    <td>{$rows['DATE']}</td>
    <td>{$rows['FUND_TYPE']}</td>
    <td>{$rows['REF_ID']}</td>
    <td>{$rows['USER_PREVIOUS_AMOUNT']}</td>
    <td>{$rows['AMOUNT']}</td>
    <td>{$rows['REMARK']}</td>
    <td>{$rows['USER_AFTER_AMOUNT']}</td>
    </tr>";
    
}

echo $output;

}

if(isset($_POST['id']) && $_POST['id'] == 2){
    
$query = "SELECT * FROM `fund_transfer` WHERE WALLET_TYPE ='MAIN_BAL' ORDER BY ID DESC";
$query_run = mysqli_query($con,$query);

$i = 1;
$output = "";

while($rows = mysqli_fetch_assoc($query_run)){
    
    $user = $con->query("SELECT * FROM `user` WHERE ID = {$rows['TRANSFER_USER_ID']}")->fetch_assoc();
    
    $output .= "<tr>
    
    <td>".$i++."</td>
    <td>{$user['PARTNER_ID']}</td>
    <td>{$user['MOBILE']}</td>
    <td>{$rows['FUND_TYPE']}</td>
    <td>".number_format((float)$rows['USER_PREVIOUS_AMOUNT'], 2, '.', '')."</td>
    <td>{$rows['AMOUNT']}</td>
    <td>{$rows['REMARK']}</td>
    <td>".number_format((float)$rows['USER_AFTER_AMOUNT'], 2, '.', '')."</td>
    <td>{$rows['DATE']}</td>
    </tr>";
    
}

echo $output;

}

      
      
      
      
      
      
      
      
      ?>