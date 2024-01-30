<?php
session_start();
// include("../config.php");
require_once('../../Db/config.php');

      $_SESSION["token_id"] = $token_id;
      
      //  Display Code

if(isset($_POST['id']) && $_POST['id'] == 1){
    
     $fromdate = $_POST['fromdate'];
    $todate = $_POST['todate'];
    
$query = "SELECT * FROM `fund_transfer` WHERE WALLET_TYPE ='MAIN_BAL' AND date(DATE) BETWEEN '{$fromdate}' AND '{$todate}' ORDER BY ID DESC";
$query_run = mysqli_query($con,$query);

$i = 1;
$output = "";

$output .= " <table id='example1' class='table table-bordered table-striped'>
                  <thead>
                  <tr>
                    <th>SL No</th>
                    <th>Member ID</th>
                    <th>Member Mobile No </th>
                    <th> Date </th>
                    <th>Fund Type</th>
                    <th>Transaction Id</th>
                    <th> Previous Balance</th>
                    <th>Amount</th>
                    <th>Remark</th>
                    <th> After Balance </th>
                  </tr>
                  </thead>
                  <tbody>";

while($rows = mysqli_fetch_assoc($query_run)){
    
    $user = $con->query("SELECT * FROM `user` WHERE ID = '{$rows["TRANSFER_USER_ID"]}'")->fetch_assoc();
    
    $output .= "<tr>
    
    <td>".$i++."</td>
    <td>{$user['PARTNER_ID']}</td>
    <td>{$user['MOBILE']}</td>
    <td>{$rows['DATE']}</td>
    <td>{$rows['FUND_TYPE']}</td>
    <td>{$rows['REF_ID']}</td>
    <td>".number_format((float)$rows['USER_PREVIOUS_AMOUNT'], 2, '.', '')."</td>
    <td>{$rows['AMOUNT']}</td>
    <td>{$rows['REMARK']}</td>
    <td>".number_format((float)$rows['USER_AFTER_AMOUNT'], 2, '.', '')."</td>
    </tr>";
    
}

$output .= "</tbody> 
                </table>";


echo $output;

}


if(isset($_POST['id']) && $_POST['id'] == 2){
    $fromdate = $_POST['fromdate'];
    $todate = $_POST['todate'];
    
$query = "SELECT * FROM `fund_transfer` WHERE WALLET_TYPE ='AEPS_BAL' AND date(DATE) BETWEEN '{$fromdate}' AND '{$todate}' ORDER BY ID DESC";
$query_run = mysqli_query($con,$query);

$i = 1;
$output = "";

$output .= " <table id='example1' class='table table-bordered table-striped'>
                  <thead>
                  <tr>
                    <th>SL No</th>
                    <th>Member ID</th>
                    <th>Member Mobile No </th>
                    <th> Date </th>
                    <th>Fund Type</th>
                    <th>Transaction Id</th>
                    <th> Previous Balance</th>
                    <th>Amount</th>
                    <th>Remark</th>
                    <th> After Balance </th>
                  </tr>
                  </thead>
                  <tbody>";

while($rows = mysqli_fetch_assoc($query_run)){
    
    $user = $con->query("SELECT * FROM `user` WHERE ID = '{$rows["TRANSFER_USER_ID"]}'")->fetch_assoc();
    
    $output .= "<tr>
    
    <td>".$i++."</td>
    <td>{$user['PARTNER_ID']}</td>
    <td>{$user['MOBILE']}</td>
    <td>{$rows['DATE']}</td>
    <td>{$rows['FUND_TYPE']}</td>
    <td>{$rows['REF_ID']}</td>
    <td>".number_format((float)$rows['USER_PREVIOUS_AMOUNT'], 2, '.', '')."</td>
    <td>{$rows['AMOUNT']}</td>
    <td>{$rows['REMARK']}</td>
    <td>".number_format((float)$rows['USER_AFTER_AMOUNT'], 2, '.', '')."</td>
    </tr>";
    
}

$output .= "</tbody> 
                </table>";

echo $output;

}
if(isset($_POST['id']) && $_POST['id'] == 3){
    
    $fromdate = $_POST["formdate"];
    $todate = $_POST["todate"];
    
$query = "SELECT * FROM `fund_transfer` WHERE WALLET_TYPE ='MAIN_BAL' AND date(DATE) BETWEEN '$fromdate' AND '$todate' ORDER BY ID DESC";
$query_run = mysqli_query($con,$query);

$i = 1;
$output = "";

$output .= " <table id='example1' class='table table-bordered table-striped'>
                  <thead>
                  <tr>
                    <th>SL No</th>
                    <th>Member ID</th>
                    <th>Member Mobile No </th>
                    <th> Date </th>
                    <th>Fund Type</th>
                    <th>Transaction Id</th>
                    <th> Previous Balance</th>
                    <th>Amount</th>
                    <th>Remark</th>
                    <th> After Balance </th>
                  </tr>
                  </thead>
                  <tbody>";

while($rows = mysqli_fetch_assoc($query_run)){
    
    $user = $con->query("SELECT * FROM `user` WHERE ID = '{$rows["TRANSFER_USER_ID"]}'")->fetch_assoc();
    
    $output .= "<tr>
    
     <td>".$i++."</td>
    <td>{$user['PARTNER_ID']}</td>
    <td>{$user['MOBILE']}</td>
    <td>{$rows['DATE']}</td>
    <td>{$rows['FUND_TYPE']}</td>
    <td>{$rows['REF_ID']}</td>
    <td>".number_format((float)$rows['USER_PREVIOUS_AMOUNT'], 2, '.', '')."</td>
    <td>{$rows['AMOUNT']}</td>
    <td>{$rows['REMARK']}</td>
    <td>".number_format((float)$rows['USER_AFTER_AMOUNT'], 2, '.', '')."</td>
    </tr>";
    
}

$output .= "</tbody> 
                </table>";


echo $output;

}
if(isset($_POST['id']) && $_POST['id'] == 4){
    
     $fromdate = $_POST["formdate"];
    $todate = $_POST["todate"];
    
$query = "SELECT * FROM `fund_transfer` WHERE WALLET_TYPE ='AEPS_BAL' AND date(DATE) BETWEEN '$fromdate' AND '$todate' ORDER BY ID DESC";
$query_run = mysqli_query($con,$query);

$i = 1;
$output = "";

$output .= " <table id='example1' class='table table-bordered table-striped'>
                  <thead>
                  <tr>
                    <th>SL No</th>
                    <th>Member ID</th>
                    <th>Member Mobile No </th>
                    <th> Date </th>
                    <th>Fund Type</th>
                    <th>Transaction Id</th>
                    <th> Previous Balance</th>
                    <th>Amount</th>
                    <th>Remark</th>
                    <th> After Balance </th>
                  </tr>
                  </thead>
                  <tbody>";

while($rows = mysqli_fetch_assoc($query_run)){
    
    $user = $con->query("SELECT * FROM `user` WHERE ID = '{$rows["TRANSFER_USER_ID"]}'")->fetch_assoc();
    
    $output .= "<tr>
    
     <td>".$i++."</td>
    <td>{$user['PARTNER_ID']}</td>
    <td>{$user['MOBILE']}</td>
    <td>{$rows['DATE']}</td>
    <td>{$rows['FUND_TYPE']}</td>
    <td>{$rows['REF_ID']}</td>
    <td>".number_format((float)$rows['USER_PREVIOUS_AMOUNT'], 2, '.', '')."</td>
    <td>{$rows['AMOUNT']}</td>
    <td>{$rows['REMARK']}</td>
    <td>".number_format((float)$rows['USER_AFTER_AMOUNT'], 2, '.', '')."</td>
    </tr>";
    
}

$output .= "</tbody> 
                </table>";


echo $output;

}

      
      
      ?>